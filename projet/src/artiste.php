<?php

class Artiste {
    private $id;
    private $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function afficher(){
        require 'src/provider/checkFichierDansDossier.php';
        echo '<link rel="stylesheet" href="./css/artiste.css">';

        echo '<div class="container-btn-album">';
            echo '<a class="btn-retour" href="index.php?action=accueil"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
            echo '<a class="btn-editer" href="index.php?action=editerArtiste&idArtiste='. trim($this->id) .'"><img src="./images/editer.png" alt="Editer album"></a>';
        echo '</div>';

        echo '<div class="container-milieu-album">';
            echo '<div class="container-milieu-bottom-left">';
                $imgVerif = get_img_album_with_artist_name(getPdo(), $this->nom);

                $path = './images/ARTISTES/';
                $imgArtiste = trim($this->nom).'.jpg';
                $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);
            
        
                // si l'image existe dans le dossier ARTISTES
                if ($imgArtisteCondition){
                    echo '<img src="./images/ARTISTES/'. trim($this->nom).'.jpg" alt="">';
                }
                // si l'image existe dans le dossier ALBUMS et existe dans le dossier ARTISTES
                else if ($imgVerif != null && !$imgArtisteCondition){
                    echo '<img src="./images/ALBUMS/'. trim($imgVerif).'" alt="">';
                }
                // si l'image n'existe pas dans le dossier ALBUMS et n'existe pas dans le dossier ARTISTES
                else if (!$imgArtisteCondition && $imgVerif == null) {
                    echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                } 
                else {
                    echo '<img src="./images/ARTISTES/'. trim($this->nom).'.jpg" alt="">';
                }
            echo '</div>';
            echo '<div class="container-milieu-bottom-right">';
                echo '<p>artiste : '.$this->nom.'</p>';
            echo '</div>';
        echo '</div>';

    }
}