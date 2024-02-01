<?php
class Album
{
    private $id;
    private $title;
    private $artiste;
    private $year;
    private $genre;
    private $cover;
    private $parent;

    public function __construct($id, $title, $artiste, $year, $genre, $cover, $parent)
    {
        $this->id = $id;
        $this->title = $title;
        $this->artiste = $artiste;
        $this->year = $year;
        $this->genre = $genre;
        $this->cover = $cover;
        $this->parent = $parent;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title; 
    }

    public function getArtiste()
    {
        return $this->artiste;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function afficher(){
        echo '<link rel="stylesheet" href="./css/album.css">';

        echo '<div class="container-btn-album">';
            echo '<a class="btn-retour" href="index.php?action=accueil"><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
            echo '<p>' . trim($this->title) . ', de '. trim($this->artiste) . ', '. $this->year .' <span>'. $this->genre .'</span></p>';
            echo '<a class="btn-editer" href="#"><img src="./images/editer.png" alt="Editer album"></a>';
        echo '</div>';

        echo '<div class="container-milieu-album">';
            echo '<div class="container-milieu-bottom-left">';                
                echo '<img src="./images/ALBUMS/'. trim($this->cover) . '" alt="'. trim($this->title) . '">';
            echo '</div>';
            echo '<div class="container-milieu-bottom-right">';
                echo '<p>Les musiques de cet album</p>';
                echo '<div class="container-album-artiste">';
                $musiques = get_musique_in_album(getPdo(), $this->id);
                if (count($musiques) == 0){
                    echo '<p class="aucun-album">Aucune musique</p>';
                } else {
                    for ($i=0; $i < count($musiques); $i++) { 
                        $musique = $musiques[$i];
    
                        $pathAlbum = './images/musiques/';
                        $imgAlbum = $musique['Pochette'];
    
                        echo '<div class="container-album-unique-artiste">';
                            $numero = $i+1;
                            echo '<p class="numero-album">'.$numero .'</p>';
                            echo '<button class="lancer-music"><img src="./images/bouton-play.png" alt="logo play music"></button>';
                            echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                            echo '<div class="contenu-album">';
                                echo '<p class="titre-album">'.$musique['Titre'].'</p>';
                            echo '</div>';
                            echo '<button id="btn-ajouter-a-playlist" class="btn-ajouter-a-playlist"><img class="ajouter-music" src="./images/ajouter.png" alt="ajouter"></button>';
                            echo '<div class="container-ajouter">';
                                echo '<button class="btn-close"><img src="./images/croix.png" alt="close"></button>';
                                echo '<div class="container-ajouter-playlist">';
                                echo '<p>Ajouter à une playlist</p>';
                                    $playlists = get_playlist_with_id_utilisateur(getPdo(), get_id_with_email(getPdo(), $_SESSION['mail']));
                                    for ($j=0; $j < count($playlists); $j++) { 
                                        $playlist = $playlists[$j];
                                        echo '<a class="lien-playlist" href="index.php?action=ajouterMusicPlaylist&idMusique='. trim($musique['ID_Musique']) .'&idPlaylist='. trim($playlist['ID_Playlist']) .'&idAlbum='. trim($this->id) .'">'. $playlist['Nom'] .'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }   
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<script src="js/lancementMusicPageArtiste.js"></script>';
        echo '<script src="js/AjouterMusiqueDansPlaylist.js"></script>';
    }
}
?>