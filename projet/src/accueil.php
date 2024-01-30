<?php
class Accueil 
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
        $this->data=$data;
    }

    public function afficher()
    {
        require 'src/BDD/Function/databaseGet.php';
        require 'src/provider/pdo.php';
        $pdo = getPdo();

        echo '<div class="container-milieu-bottom">';

            // carousel pour les artistes
            echo '<h2 class="titre-carousel">Artistes que vous pourrez aimez</h2>';
            echo '<div class="carousel-container">';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';


                $artistes = get_all_artiste($pdo);
                // Vérifier si des données existent
                if (!empty($artistes)) {
                    // Parcourir chaque entrée musicale
                    foreach ($artistes as $entry) {
                        echo '<div class="carousel-slide">';
                        echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                        echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                        echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-album" src="./images/ARTISTES/' . trim($entry[0]) . '.jpg" alt="Image de la pochette"></a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';
        
            // carousel pour les contenus 'concu pour toi'
            echo '<h2 class="titre-carousel">Conçu pour toi</h2>';
            echo '<div class="carousel-container">';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';

                $albums = get_all_album($pdo);
                // Vérifier si des données existent
                if (!empty($albums)) {
                    // Parcourir chaque entrée musicale
                    foreach ($albums as $entry) {
                        $lien_img = explode(' ', $entry[3]);
                        if (!str_starts_with($lien_img[1], 'null')){
                            $entry[3] = "images/ALBUMS/".trim($lien_img[1]);
                        } else {
                            $entry[3] = "images/ALBUMS/default.jpg";
                        }
                        echo '<div class="carousel-slide">';
                        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                        // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                        // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                        echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
                        echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                        echo '<a href="index.php?action=album&id='. trim($entry[5]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';

            // carousel pour les contenus 'concu pour toi'
            echo '<h2 class="titre-carousel">Vos mix préférés</h2>';
            echo '<div class="carousel-container">';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';

                    // Vérifier si des données existent
                    if (!empty($this->data)) {
                        // Parcourir chaque entrée musicale
                        foreach ($this->data as $entry) {
                            $lien_img = explode(' ', $entry[3]);
                            if (!str_starts_with($lien_img[1], 'null')){
                                $entry[3] = "images/ALBUMS/".$lien_img[1];
                            } else {
                                $entry[3] = "images/ALBUMS/default.jpg";
                            }
                            echo '<div class="carousel-slide">';
                            // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                            // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                            // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                            echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                            echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                            echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Aucune donnée trouvée.</p>';
                    }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';

            // carousel pour les contenus 'concu pour toi'
            echo '<h2 class="titre-carousel">Ecoutés récemment</h2>';
            echo '<div class="carousel-container">';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';

                // Vérifier si des données existent
                if (!empty($this->data)) {
                    // Parcourir chaque entrée musicale
                    foreach ($this->data as $entry) {
                        $lien_img = explode(' ', $entry[3]);
                        if (!str_starts_with($lien_img[1], 'null')){
                            $entry[3] = "images/ALBUMS/".$lien_img[1];
                        } else {
                            $entry[3] = "images/ALBUMS/default.jpg";
                        }
                        echo '<div class="carousel-slide">';
                        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                        // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                        // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                        echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                        echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                        echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';

            // carousel pour les contenus 'concu pour toi'
            echo '<h2 class="titre-carousel">Vos favoris</h2>';
            echo '<div class="carousel-container">';
                echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
                echo '<div class="carousel-wrapper">';

                // Vérifier si des données existent
                if (!empty($this->data)) {
                    // Parcourir chaque entrée musicale
                    foreach ($this->data as $entry) {
                        $lien_img = explode(' ', $entry[3]);
                        if (!str_starts_with($lien_img[1], 'null')){
                            $entry[3] = "images/ALBUMS/".$lien_img[1];
                        } else {
                            $entry[3] = "images/ALBUMS/default.jpg";
                        }
                        echo '<div class="carousel-slide">';
                        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                        // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                        // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                        echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                        echo '<a class="img-fav" href="#"><img src="images/coeurPlein.png" alt="Image favoris"></a>';
                        echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Aucune donnée trouvée.</p>';
                }

                echo '</div>';
                echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
            echo '</div>';

        echo '</div>';
    }
}
?>