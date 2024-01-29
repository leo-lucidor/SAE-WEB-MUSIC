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
        echo '<div class="container-milieu-bottom">';
        echo '<h2>Résultats de la recherche</h2>';
        
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
