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



        $artistes = get_all_artiste($pdo);
        // Vérifier si des données existent
        if (!empty($artistes)) {
            // Parcourir chaque entrée musicale
            foreach ($artistes as $entry) {
                $lien_img = explode(' ', $entry[0]);

                $imgVerif = get_img_album_with_artist_name(getPdo(), $entry[0]);

                $path = './images/ARTISTES/';
                $imgArtiste = trim($entry[0]).'.jpg';
                $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);

                if ($imgArtisteCondition){
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ARTISTES/' . trim($entry[0]) . '.jpg" alt="Image de la pochette"></a>';
                } else if ($imgVerif != null && !$imgArtisteCondition){
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/' . trim($imgVerif) . '" alt="Image de la pochette"></a>';
                } else {
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/default.jpg" alt="Image de la pochette"></a>';
                }
                echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
            }
        } else {
            echo '<p>Aucune donnée trouvée.</p>';
        }
        
        // Vérifier si des données existent
        if (!empty($this->data)) {
            // Parcourir chaque entrée musicale
            foreach ($this->data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/ALBUMS/" . trim($lien_img[1]);
                } else {
                    $entry[3] = "images/ALBUMS/default.jpg";
                }
                
                echo '<div class="search-result">';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun résultat trouvé.</p>';
        }

        echo '</div>';
    }
}
?>
