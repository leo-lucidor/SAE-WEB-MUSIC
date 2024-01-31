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
            ?>
            <a class="btn-ajouter" href="#"><img src="./images/ajouter.png" alt="ajouter une musique a la playlist"></a>
        </div>
        <div class="container-musique">
            <?php
            if (count($this->listeMusique) == 0) {
                echo '<p class="aucune-musique">Aucune musique dans cette playlist</p>';
            } {
                foreach ($this->listeMusique as $musique) {
                    $nomMusique = $musique->getTitle();
                    $nomArtiste = $musique->getArtist();
                    $id = $musique->getId();
                    $chemin = "./MUSIQUES/" .  trim($nomMusique) . ".mp3";
                    $cheminImage = "./images/MUSIQUES" .  trim($nomMusique) . ".jpg";
                    $cheminParDefaut = "./images/ALBUMS/default.jpg";
                    ?>
                    <div class="musique">
                        <div class="container-img-musique">
                            <img class="img-musique" src="<?php echo trim($cheminParDefaut) ?>" alt="image musique">
                        </div>
                        <div class="container-info-musique">
                            <p class="nom-musique"><?php echo $nomMusique ?></p>
                            <p class="nom-artiste"><?php echo $nomArtiste ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
}
?>