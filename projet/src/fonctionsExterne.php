<?php
class Fonctions 
{
    private $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getAlbumFromData($idAlbum)
    {
        for ($i = 0; $i < count($this->data); $i++) {
            if ($this->data[$i][1] == $idAlbum) {
                return $this->data[$i];
            }
        }
        return null;
    }
}
?>