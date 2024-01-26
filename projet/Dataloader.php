<?php

declare(strict_types=1);

class Dataloader {
    private $pdo;
    private $file;   

    public function __construct(string $databaseName, string $file) {
        try {
            $this->pdo = new PDO('sqlite:' . $databaseName);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->file = $file;

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function createTables(): void {
        try {

              // Table Artiste
              $this->pdo->exec("CREATE TABLE IF NOT EXISTS Artiste (
                ID_Artiste INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom TEXT UNIQUE
            )");
          

            // Table Album
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Album (
                ID_Album INTEGER PRIMARY KEY AUTOINCREMENT,
                Titre TEXT UNIQUE,
                Date_de_sortie INTEGER NOT NULL CHECK (Date_de_sortie <= 2024) ,
                Genre TEXT,
                Pochette TEXT,
                ID_Artiste_By INTEGER,
                ID_Artiste_Parent INTEGER,
                FOREIGN KEY (ID_Artiste_By) REFERENCES Artiste(ID_Artiste),
                FOREIGN KEY (ID_Artiste_Parent) REFERENCES Artiste(ID_Artiste)
            )");

            // Table Utilisateur
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Utilisateur (
                ID_Utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_utilisateur TEXT UNIQUE,
                Mot_de_passe TEXT,
                Email TEXT UNIQUE
            )");

            // Table Album_Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Album_Playlist (
                ID_Album INTEGER,
                ID_Playlist INTEGER,
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album),
                FOREIGN KEY (ID_Playlist) REFERENCES Playlist(ID_Playlist)
            )");

            // Table Playlist
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Playlist (
                ID_Playlist INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom TEXT,
                ID_Utilisateur INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
            )");

            // Table Genre
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Genre (
                ID_Genre INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_du_genre TEXT UNIQUE
            )");

            // Table Note
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Note (
                ID_Note INTEGER PRIMARY KEY AUTOINCREMENT,
                Valeur INTEGER,
                ID_Utilisateur INTEGER,
                ID_Album INTEGER,
                FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
                FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
            )");

            echo "Tables créées avec succès.";

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    function get_All_genre_in_yml(array $data){
        $genre = [];
        foreach ($data as $entry) {
            if (!in_array($entry[2], $genre)) {
                $list = $entry[2];
                $list = $this->separer_genre($list);
                foreach ($list as $value) {
                    if (!in_array($value, $genre)){
                        array_push($genre, $value);
                    }
                }
            }
        }
        return $genre;
    }

    function get_artist_in_yml(){
        $data = $this->getdata();
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
    

    public function insertGenre(): void {
        $data = $this->getdata();
        $genreList = $this->get_All_genre_in_yml($data);
        foreach ($genreList as $genre) {
            try {
                $stmt = $this->pdo->prepare("INSERT INTO Genre (Nom_du_genre) VALUES (:genreName)");
                $stmt->bindParam(':genreName', $genre);
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Erreur lors de l'insertion du genre : " . $e->getMessage() . "\n";
            }
        }
    }


    public function insertArtist(): void {
    
        $artist = $this->get_artist_in_yml();
        $artistBy = $artist[0];
        $artistParent = $artist[1];
        $allArtist = array_merge($artistBy, $artistParent);
        $allArtist = array_unique($allArtist);
        try {
            foreach ($allArtist as $nom) {
                $stmt = $this->pdo->prepare("INSERT INTO Artiste (Nom) VALUES (?)");
                $stmt->bindParam(1, $nom);                
                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'artiste : " . $e->getMessage();
        }
    }
    
    public function get_id_utlisateur(String $email) {
        $stmt = $this->pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $id = $stmt->fetch();
        return $id["ID_Utilisateur"];
    }

    public function insertUser(String $userName, String $usePassword, String $userEmail) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Utilisateur (Nom_utilisateur, Mot_de_passe, Email) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $usePassword);
            $stmt->bindParam(3, $userEmail);
            $stmt->execute();

            $idUt = $this->get_id_utlisateur($userEmail);
            $this->insertPlaylist("Titres Likés", $idUt);

            return $idUt;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    }    




    public function insertAlbum(String $albumName, int $albumDate, String $albumGenre, String $albumCover, String $ArtistBy, String $albumArtistParent) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Album (Titre, Date_de_sortie, Genre, Pochette, ID_Artiste_By, ID_Artiste_Parent) VALUES (?, ?, ?, ?, (SELECT ID_Artiste FROM Artiste WHERE Nom = ?), (SELECT ID_Artiste FROM Artiste WHERE Nom = ?))");
            $stmt->bindParam(1, $albumName);
            $stmt->bindParam(2, $albumDate);
            $stmt->bindParam(3, $albumGenre);
            $stmt->bindParam(4, $albumCover);
            $stmt->bindParam(5, $ArtistBy);
            $stmt->bindParam(6, $albumArtistParent);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'album : " . $e->getMessage();
        }
    }

    public function get_id_genre($genre){
        $stmt = $this->pdo->prepare("SELECT ID_Genre FROM Genre WHERE Nom_du_genre = ?");
        $stmt->bindParam(1, $genre);
        $stmt->execute();
        $id = $stmt->fetch();
        return $id;
    }

    public function separer_genre($genre){
        $genre = str_replace(["[", "]"], "", $genre);
        // suppremer les espaces
        $genre = str_replace(" ", "", $genre);
        $genre = explode(",", $genre);
        return $genre;
    }    

    public function insertAllAlbum(){
        $data = $this->getdata();
        $album = [];
        foreach ($data as $entry) {
            $albumName = $entry[6];
            $date = $entry[5];            
            $albumDate = (int)$entry[5];
            $genre = $this->separer_genre($entry[2]);
            $res = "";

            for ($i = 0; $i < count($genre); $i++){
                if ($i != count($genre) - 1){
                    $res .= $genre[$i];
                    $res .= ", ";
                }
                else {
                    $res .= $genre[$i];
                }
            }
            $genre = $res;

            $albumGenre = $genre;
            $albumCover = $entry[3];
            $albumArtistBy = $entry[0];
            $albumArtistParent = $entry[4];
            array_push($album, $entry[4]);
            $this->insertAlbum($albumName, $albumDate, $albumGenre, $albumCover, $albumArtistBy, $albumArtistParent);
        }   
        return $album;

    }
    public function insertPlaylist(String $nom, int $utilisateur): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Playlist (Nom, ID_Utilisateur) VALUES (?, ?)");
            $stmt->bindParam(1, $nom);
            $stmt->bindParam(2, $utilisateur);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la playlist : ". $e->getMessage();
        }
    }

    public function insertNote(array $noteData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Note (Valeur, ID_Utilisateur, ID_Album) VALUES (?, (SELECT ID_Utilisateur FROM Utilisateur WHERE Nom_utilisateur = ?), (SELECT ID_Album FROM Album WHERE Titre = ?))");
            $stmt->bindParam(1, $noteData['value']);
            $stmt->bindParam(2, $noteData['parent']);
            $stmt->bindParam(3, $noteData['album']);
            $stmt->execute();
            echo "Note ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la note : " . $e->getMessage();
        }
    }

    function getdata(): array {
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

    function insertAll() {
        $this->createTables();
        $this->insertGenre();
        $this->insertArtist();
        $this->insertAllAlbum();
        $this->insertUser("JohnDoe", "123", "john.doe@example.com");
        $this->insertUser("JohnDoee", "123", "john.doe@example.co");
    }


    function deleteAllInBDD() {
        $stmt = $this->pdo->prepare("DELETE FROM Note");
        $stmt->execute();
        $stmt = $this->pdo->prepare("DELETE FROM Playlist");
        $stmt->execute();
        $stmt = $this->pdo->prepare("DELETE FROM Utilisateur");
        $stmt->execute();
        $stmt = $this->pdo->prepare("DELETE FROM Album");
        $stmt->execute();
        $stmt = $this->pdo->prepare("DELETE FROM Artiste");
        $stmt->execute();
        $stmt = $this->pdo->prepare("DELETE FROM Genre");
        $stmt->execute();
    }

    function returnToBaseBDD() {
        $this->deleteAllInBDD();
        $this->insertAll();
    }


    
}
?>
