<?php

class Music
{
    private $title;
    private $artist;
    private $genre;
    private $releaseYear;
    private $image;
    private $id;
    private $lienMusic;

    public function __construct($title, $artist, $genre, $releaseYear, $image, $id, $lienMusic)
    {
        $this->title = $title;
        $this->artist = $artist;
        $this->genre = $genre;
        $this->releaseYear = $releaseYear;
        $this->image = $image;
        $this->id = $id;
        $this->lienMusic = $lienMusic;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLienMusic()
    {
        return $this->lienMusic;
    }

    public function afficher(){
        $pdo = getPdo();
        ?>
        <link rel="stylesheet" href="css/musique.css">
        <div class="container-musique-top">
            <a href="javascript:history.back()" class="btn-retour"><img src="images/fleche-gauche.png" alt="retour"></a>
            <div class="container-contenu">
                <p class="titre-musique"><?php echo $this->title; ?></p>
                <p>|</p>
                <p class="artiste-musique"><?php echo $this->artist[0]; ?>
                    <span class="annee-musique"><?php echo $this->releaseYear; ?></span>
                    <span class="genre-musique"><?php echo $this->genre; ?></span>
                </p>
            </div>
        </div>
        <div class="container-musique-bottom">
            <img src="images/ALBUMS/<?php echo trim($this->image); ?>" alt="image musique" class="image-musique">
        </div>
        <?php
    }
}
