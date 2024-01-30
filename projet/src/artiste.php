<?php

class Artiste {
    private $id;
    private $nom;

    public function __construct($id, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function afficher(){
        echo 'artiste : '.$this->nom.'<br>';
    }
}