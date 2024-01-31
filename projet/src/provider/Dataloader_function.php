<?php

// Path: projet/src/provider/dataloader_function.php

function get_All_genre_in_yml(array $data)
{
    $genre = [];
    foreach ($data as $entry) {
        if (!in_array($entry[2], $genre)) {
            $list = $entry[2];
            $list = separer_genre($list);
            foreach ($list as $value) {
                if (!in_array($value, $genre)) {
                    array_push($genre, $value);
                }
            }
        }
    }
    return $genre;
}

function get_artist_in_yml()
{
    $data = getdata();
    $artist = [];
    $artistBy = [];
    $artistParent = [];
    foreach ($data as $entry) {
        if (!in_array($entry[0], $artistBy)) {
            array_push($artistBy, $entry[0]);
        }
        if (!in_array($entry[4], $artistParent)) {
            array_push($artistParent, $entry[4]);
        }
    }
    array_push($artist, $artistBy);
    array_push($artist, $artistParent);
    return $artist;
}

function insertGenre(PDO $pdo): void
{
    $data = getdata();
    $genreList = get_All_genre_in_yml($data);
    foreach ($genreList as $genre) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Genre (Nom_du_genre) VALUES (:genreName)");
            $stmt->bindParam(':genreName', $genre);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion du genre : " . $e->getMessage() . "\n";
        }
    }
}

function insertArtist(PDO $pdo): void
{

    $artist = get_artist_in_yml();
    $artistBy = $artist[0];
    $artistParent = $artist[1];
    $allArtist = array_merge($artistBy, $artistParent);
    $allArtist = array_unique($allArtist);
    try {
        foreach ($allArtist as $nom) {
            $stmt = $pdo->prepare("INSERT INTO Artiste (Nom) VALUES (?)");
            $stmt->bindParam(1, $nom);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'artiste : " . $e->getMessage();
    }
}

function get_idGenre_with_nom(PDO $pdo, String $nom): int
{
    $stmt = $pdo->prepare("SELECT ID_Genre FROM Genre WHERE Nom_du_genre =?");
    $stmt->bindParam(1, $nom);
    $stmt->execute();
    $id = $stmt->fetch();
    return $id["ID_Genre"];
}

function get_id_utlisateur(PDO $pdo, String $email)
{
    $stmt = $pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = ?");
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $id = $stmt->fetch();
    return $id["ID_Utilisateur"];
}

function insertUser(PDO $pdo, String $userName, String $usePassword, String $userEmail)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO Utilisateur (Nom_utilisateur, Mot_de_passe, Email) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $userName);
        $stmt->bindParam(2, $usePassword);
        $stmt->bindParam(3, $userEmail);
        $stmt->execute();

        $idUt = get_id_utlisateur($pdo, $userEmail);
        insertPlaylist($pdo, "Titres Likés", $idUt);

        return $idUt;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
    }
}

function insert_into_listGenre(PDO $pdo, int $idAlbum, int $idGenre)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO listeGenre (ID_Genre,ID_Album) VALUES (?,?)");
        $stmt->bindParam(1, $idGenre);
        $stmt->bindParam(2, $idAlbum);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la liste de genre : " . $e->getMessage();
    }
}

function insertAlbum(PDO $pdo, int $idAlbum, String $albumName, int $albumDate, String $albumGenre, String $albumCover, String $ArtistBy, String $albumArtistParent)
{
    try {
        $stmt = $pdo->prepare("INSERT INTO Album (ID_Album, Titre, Date_de_sortie, Genre, Pochette, ID_Artiste_By, ID_Artiste_Parent) VALUES (?, ?, ?, ?, ?, (SELECT ID_Artiste FROM Artiste WHERE Nom = ?), (SELECT ID_Artiste FROM Artiste WHERE Nom = ?))");
        $stmt->bindParam(1, $idAlbum);
        $stmt->bindParam(2, $albumName);
        $stmt->bindParam(3, $albumDate);
        $stmt->bindParam(4, $albumGenre);
        $stmt->bindParam(5, $albumCover);
        $stmt->bindParam(6, $ArtistBy);
        $stmt->bindParam(7, $albumArtistParent);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de l'album : " . $e->getMessage();
    }
}

function get_id_genre(PDO $pdo, $genre)
{
    $stmt = $pdo->prepare("SELECT ID_Genre FROM Genre WHERE Nom_du_genre = ?");
    $stmt->bindParam(1, $genre);
    $stmt->execute();
    $id = $stmt->fetch();
    return $id;
}

function separer_genre($genre)
{
    $genre = str_replace(["[", "]"], "", $genre);
    // suppremer les espaces
    $genre = str_replace(" ", "", $genre);
    $genre = explode(",", $genre);
    return $genre;
}

function insertAllAlbum(PDO $pdo)
{
    $data = getdata();
    $album = [];
    foreach ($data as $entry) {
        $albumName = $entry[6];
        $date = $entry[5];
        $albumDate = (int) $entry[5];
        $genre = separer_genre($entry[2]);
        $res = "";

        for ($i = 0; $i < count($genre); $i++) {
            if ($i != count($genre) - 1) {
                $res .= $genre[$i];
                insert_into_listGenre($pdo, $entry[1], get_id_genre($pdo, $genre[$i])["ID_Genre"]);
                $res .= ", ";
            } else {
                insert_into_listGenre($pdo, $entry[1], get_id_genre($pdo, $genre[$i])["ID_Genre"]);
                $res .= $genre[$i];
            }
        }
        $genre = $res;

        $albumGenre = $genre;
        $albumId = $entry[1];
        $albumCover = $entry[3];
        $albumArtistBy = $entry[0];
        $albumArtistParent = $entry[4];
        array_push($album, $entry[4]);
        insertAlbum($pdo, $albumId, $albumName, $albumDate, $albumGenre, $albumCover, $albumArtistBy, $albumArtistParent);
    }
    return $album;

}
function insertPlaylist(PDO $pdo, String $nom, int $utilisateur): void
{
    try {
        $stmt = $pdo->prepare("INSERT INTO Playlist (Nom, ID_Utilisateur) VALUES (?, ?)");
        $stmt->bindParam(1, $nom);
        $stmt->bindParam(2, $utilisateur);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la playlist : " . $e->getMessage();
    }
}

function insertNote(PDO $pdo, array $noteData): void
{
    try {
        $stmt = $pdo->prepare("INSERT INTO Note (Valeur, ID_Utilisateur, ID_Album) VALUES (?, (SELECT ID_Utilisateur FROM Utilisateur WHERE Nom_utilisateur = ?), (SELECT ID_Album FROM Album WHERE Titre = ?))");
        $stmt->bindParam(1, $noteData['value']);
        $stmt->bindParam(2, $noteData['parent']);
        $stmt->bindParam(3, $noteData['album']);
        $stmt->execute();
        echo "Note ajoutée avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la note : " . $e->getMessage();
    }
}

function getdata(): array
{
    $file = fopen('extrait.yml', 'r');
    $dico = [];
    $data = [];
    while (($line = fgets($file)) !== false) {
        $elem = explode(':', $line, 2);
        if ($elem[0] == '- by') {
            if (!empty($dico)) {
                $data[] = $dico;
                $dico = [];
            }
        }
        if (count($elem) >= 2) {
            $dico[] = $elem[1];
        }
    }
    if (!empty($dico)) {
        $data[] = $dico;
    }
    fclose($file);
    return $data;
}

function insertAll(PDO $pdo)
{
    insertGenre($pdo);
    insertArtist($pdo);
    insertAllAlbum($pdo);
    insertUser($pdo, "JohnDoe", "123", "john.doe@example.com");
    insertUser($pdo, 'erwan', 'erwan', 'erwan.blandeau@gmail.com');
}

function deleteAllInBDD(PDO $pdo)
{
    $stmt = $pdo->prepare("DELETE FROM Note");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Playlist");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Utilisateur");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Musique");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Album");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Artiste");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM Genre");
    $stmt->execute();
    $stmt = $pdo->prepare("DELETE FROM listeGenre");
    $stmt->execute();
}

function returnToBaseBDD(PDO $pdo)
{
    deleteAllInBDD($pdo);
    insertAll($pdo);
}
