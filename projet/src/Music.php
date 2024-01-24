<?php

class Music
{
    private $title;
    private $artist;
    private $genre;
    private $releaseYear;
    private $image;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->artist = $data['by'];
        $this->genre = $data['genre'];
        $this->releaseYear = $data['releaseYear'];
        $this->image = $data['img'];
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
}
