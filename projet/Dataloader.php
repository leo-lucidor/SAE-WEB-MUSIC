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
                Nom TEXT,
                Bio TEXT,
                Date_de_naissance DATE
            )");

            // Table Album
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Album (
                ID_Album INTEGER PRIMARY KEY AUTOINCREMENT,
                Titre TEXT,
                Date_de_sortie DATE,
                Genre TEXT,
                Pochette TEXT,
                ID_Artiste INTEGER,
                FOREIGN KEY (ID_Artiste) REFERENCES Artiste(ID_Artiste)
            )");

            // Table Utilisateur
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS Utilisateur (
                ID_Utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                Nom_utilisateur TEXT,
                Mot_de_passe TEXT,
                Email TEXT
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
                Nom_du_genre TEXT
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

    public function insertAlbum(array $albumData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Album (Titre, Date_de_sortie, Genre, Pochette, ID_Artiste) VALUES (?, ?, ?, ?, (SELECT ID_Artiste FROM Artiste WHERE Nom = ?))");
            $stmt->bindParam(1, $albumData['title']);
            $stmt->bindParam(2, $albumData['releaseYear']);
            $stmt->bindParam(3, implode(', ', $albumData['genre']));
            $stmt->bindParam(4, $albumData['img']);
            $stmt->bindParam(5, $albumData['parent']);
            $stmt->execute();
            echo "Album ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'album : " . $e->getMessage();
        }
    }

    public function insertArtist(array $artistData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Artiste (Nom, Bio, Date_de_naissance) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $artistData['name']);
            $stmt->bindParam(2, $artistData['bio']);
            $stmt->bindParam(3, $artistData['birth']);
            $stmt->execute();
            echo "Artiste ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'artiste : " . $e->getMessage();
        }
    }

    public function insertGenre(array $genreData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Genre (Nom_du_genre) VALUES (?)");
            $stmt->bindParam(1, $genreData['name']);
            $stmt->execute();
            echo "Genre ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du genre : " . $e->getMessage();
        }
    }

    public function insertUser(array $userData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Utilisateur (Nom_utilisateur, Mot_de_passe, Email) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $userData['username']);
            $stmt->bindParam(2, $userData['password']);
            $stmt->bindParam(3, $userData['email']);
            $stmt->execute();
            echo "Utilisateur ajouté avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
        }
    }

    public function insertPlaylist(array $playlistData): void {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Playlist (Nom, ID_Utilisateur) VALUES (?, (SELECT ID_Utilisateur FROM Utilisateur WHERE Nom_utilisateur = ?))");
            $stmt->bindParam(1, $playlistData['name']);
            $stmt->bindParam(2, $playlistData['parent']);
            $stmt->execute();
            echo "Playlist ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la playlist : " . $e->getMessage();
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


    public function insertDataIntoDatabase(Dataloader $dataloader, array $data): void {
        foreach ($data as $entry) {
            $albumData = [
                'title' => $entry['title'],
                'releaseYear' => $entry['releaseYear'],
                'genre' => $entry['genre'],
                'img' => $entry['img'],
                'parent' => $entry['parent'],
            ];

            $artistData = [
                'name' => $entry['parent'],
                'bio' => '', // Modify this based on your data
                'birth' => '', // Modify this based on your data
            ];

            // Insert artist if not already in the database
            $dataloader->insertArtist($artistData);

            // Insert album
            $dataloader->insertAlbum($albumData);
        }
    }

    function getdata() : Array {
        $file = fopen('extrait.yml', 'r');
        $dico = [];
        $data = [];
    
         // Lire le fichier ligne par ligne
         while (($line = fgets($file)) !== false) {
            $elem = explode(':', $line, 2);
            if ($elem[0] == '- by'){
                if (!empty($dico)){
                    $data[] = $dico;
                    $dico = [];
                }
            }
            $dico[] = $elem[1];
        }
        fclose($file);
        return $data;
    }
}
?>
