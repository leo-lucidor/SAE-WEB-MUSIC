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
}
