<?php
class Recherche 
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

    public function setData($data)
    {
        $this->data = $data;
    }

    public function afficher()
    {
        require 'src/provider/checkFichierDansDossier.php';
        require 'src/provider/pdo.php';
        $pdo = getPdo();

        echo '<div class="container-milieu-bottom">';
        echo '<h2>Résultats de la recherche</h2>';
        
        $playlists = get_playlist_visible($pdo, $_SESSION['idUser']);
        $artistes = get_all_artiste($pdo);
        $this->$data = $data;

        echo '</div>';
    }
}
?>
