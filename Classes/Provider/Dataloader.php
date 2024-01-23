<?php
    declare(strict_types=1);

    class Dataloader {

        private $url;

        public function __construct($url) {
            $this->url = $url;
        }

        // Fonction permettant de récupérer les données du fichier json
        public function getData() {
            $json = file_get_contents($this->url);
            $data = json_decode($json, true);
            return $data;
        }
    }
?>