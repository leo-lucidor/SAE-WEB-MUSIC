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
       // require 'src/provider/pdo.php';
        $pdo = getPdo();
        ?>
        <link rel="stylesheet" href="./css/playlist.css">
        <div class="container-btn-playlist">
            <a class="btn-retour" href="index.php?action=accueil"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>
            <?php
                $nomUser = get_pseudo_with_id($pdo, $this->idUtilisateur);
                echo '<p class="titre-playlist">'. trim($this->nom) .'<span class="nom-user">Par '. trim($nomUser) .'</span></p>';
            ?>
            <a class="btn-ajouter" href="#"><img src="./images/ajouter.png" alt="ajouter une musique a la playlist"></a>
        </div>
        <?php
    }
}
?>