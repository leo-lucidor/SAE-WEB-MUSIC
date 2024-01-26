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
            echo '<a class="btn-retour" href="index.php?action="><img src="./images/fleche-gauche.png" alt="fleche gauche"></a>';
            echo '<a class="btn-editer" href="#"><img src="./images/editer.png" alt="Editer album"></a>';
        echo '</div>';

        echo '<div class="container-milieu-album">';
            echo '<div class="container-milieu-bottom-left">';
                echo '<img src="images/ALBUMS/'. trim($this->cover) . '" alt="'. trim($this->title) . '">';
            echo '</div>';
            echo '<div class="container-milieu-bottom-right">';
                echo '<p>Album : ' . $this->title . '</p>';
                echo '<p>Artiste : '. $this->artiste . '</p>';
                echo '<p>Année : '. $this->year . '</p>';
                echo '<p>Genre : '. $this->genre. '</p>';
            echo '</div>';
        echo '</div>';
    }
}
?>