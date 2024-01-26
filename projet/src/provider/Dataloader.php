<?php

declare(strict_types=1);

class Dataloader {
    private $pdo;
    private $file;
    public function __construct(string $databaseName, string $file) {
        try {
            $this->pdo = new PDO('sqlite:' . "src/BDD/".$databaseName);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->file = $file;

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function createTables(): bool {
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
            return true;

        } catch (PDOException $e) {
            return false;
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
    
}
?>
