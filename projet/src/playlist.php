<?php

class Playlist {
    private $nom;
    private $id;
    private $idUtilisateur;
    private $listeMusique;

    public function __construct($id, $idUtilisateur, $nom, $listeMusique)
    {
        $this->nom = $nom;
        $this->id = $id;
        $this->idUtilisateur = $idUtilisateur;
        $this->listeMusique = $listeMusique;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getListeMusique()
    {
        return $this->listeMusique;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setListeMusique($listeMusique)
    {
        $this->listeMusique = $listeMusique;
    }

    public function afficher(){
        require 'src/provider/checkFichierDansDossier.php';
        $pdo = getPdo();
        ?>
        <link rel="stylesheet" href="./css/playlist.css">
        <div class="container-btn-playlist">
            <a class="btn-retour" href="index.php?action=accueil"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>
            <?php
                $nomUser = get_pseudo_with_id($pdo, $this->idUtilisateur);
                if (trim($this->nom) == "Titres Likés") {
                    echo '<p class="titre-playlist">'. trim($this->nom) .'<span class="nom-user">Par Spotiut\'O</span></p>';
                } else {
                    echo '<p class="titre-playlist">'. trim($this->nom) .'<span class="nom-user">Par '. trim($nomUser) .'</span></p>';
                }
            echo '<a class="btn-supprimer-top" href="index.php?action=deletePlaylist&idPlaylist='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer une playlist"></a>';
            ?>
        </div>
        <div class="container-musique">
            <?php
            if (count($this->listeMusique) == 0) {
                echo '<p class="aucune-musique">Aucune musique dans cette playlist</p>';
            } {
                $numero = 1;
                foreach ($this->listeMusique as $musique) {
                    $nomMusique = $musique['Titre'];
                    $nomArtiste = $musique['Nom'];
                    $nomArtiste = "Nom de l'artiste";

                    $idMusique = $musique['ID_Musique'];
                    $chemin = "./MUSIQUES/" .  trim($nomMusique) . ".mp3";
                    $cheminImage = "./images/MUSIQUES" .  trim($nomMusique) . ".jpg";
                    $cheminParDefaut = "./images/ALBUMS/default.jpg";
                    echo '<div class="container-album-unique-artiste">';
                            echo '<p class="numero-album">'. $numero .'</p>';
                            echo '<button class="lancer-music"><img src="./images/bouton-play.png" alt="logo play music"></button>';
                            echo '<img src="./images/ALBUMS/default.jpg" alt="">';
    
                            echo '<div class="contenu-album">';
                                echo '<p class="titre-album">'. $nomMusique .'</p>';
                                echo '<div class="container-contenu-album-bottom">';  
                                    echo '<span class="genre-album">'. $nomArtiste .'</span>';
                                echo '</div>';
                            echo '</div>';
                            echo '<a class="btn-supprimer" href="index.php?action=deleteMusiquePlaylist&idMusique='. trim($idMusique) .'&idPlaylist='. trim($this->id) .'"><img src="./images/croix.png" alt="supprimer une musique de la playlist"></a>';
                    echo '</div>';
                    $numero++;
                }
            }
            ?>
        </div>
        <?php
        echo '<script src="js/lancementMusicPageArtiste.js"></script>';
    }
}
?>