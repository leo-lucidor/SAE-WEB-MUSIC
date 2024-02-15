<?php
class Favoris 
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
        $pdo = getPdo();
        // $playlists = get_playlist_favoris($pdo, $_SESSION['idUser']);
        $playlists = [];
        $artistes = get_artistes_favoris($pdo, $_SESSION['idUser']);
        $titres = get_musiques_favoris($pdo, $_SESSION['idUser']);
        
?>
        <link rel="stylesheet" href="./css/search.css">

        <div class="container-milieu-bottom">
            <div class="div-navbar">
                <nav class="navbar">
                    <ul class="liste">
                        <?php
                            require 'src/search_filters/all_favoris.php';
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

<?php
    }
}
?>