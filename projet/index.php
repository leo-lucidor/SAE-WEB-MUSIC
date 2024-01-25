<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiut'O</title>
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
</head>
<body>

<?php

require 'vendor/autoload.php';
require 'src/autoloader.php';

// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

$file = fopen('extrait.yml', 'r');
$data = [];
$dico = [];

// Lire le fichier ligne par ligne
while (($line = fgets($file)) !== false) {
    $elem = explode(':', $line, 2);
    if ($elem[0] == '- by'){
        if (!empty($dico)){
            $data[] = $dico;
            $dico = [];
        }
    }
    $dico[] = $elem[1];
}
fclose($file);

echo '<div class="container-all">';

echo '<aside class="container-left">';
echo '<div class="container-left-top">';

echo '<ul class="menu">';
    if ($_REQUEST['action'] == ''){
        echo '<li><img class="img-active" id="img-accueil-plein" src="./images/maisonPlein.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'bibliotheque'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-plein" src="./images/bibliothequePlein.png" alt=""><a id="btn-biblio" class="btn-biblio" href="#">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    } else if ($_REQUEST['action'] == 'explorer'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-plein" src="./images/explorerPlein.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'favoris') {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-plein" src="./images/coeurPlein.png" alt=""><a id="btn-favoris" class="btn-favoris" href="#">Favoris</a></li>';
    } else if ($_REQUEST['action'] == 'compte'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    } else {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }
    
echo '</ul>';

echo '<div class="container-playlist">';
    echo '<div class="container-playlist-top">';
        echo '<h2 class="titre-playlist">Playlists</h2>';
        echo '<button class="btn-creer-playlist">+</button>';
    echo '</div>';

    echo '<ul class="container-playlist-bottom">';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<div class="container-playlist-bottom-text">';
                echo '<p>Playlist 1</p>';
                echo '<p>par Irvyn</p>';
            echo '</div>';
        echo '</a>';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<div class="container-playlist-bottom-text">';
                echo '<p>Playlist 2</p>';
            echo '</div>';
        echo '</a>';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<div class="container-playlist-bottom-text">';
                echo '<p>Playlist 3</p>';
            echo '</div>';
        echo '</a>';
    echo '</ul>';
echo '</div>';


echo '</div>';

echo '</aside>';


echo '<div class="container-milieu">';
echo '<div class="container-milieu-top">';

echo '<div class="container-milieu-top-left">';
    echo '<h1>Spotiut\'O</h1>';
    echo '<input class="rechercher" type="text" placeholder="🔍 Artistes, titres...">';
echo '</div>';

echo '<div class="container-milieu-top-right">';
    echo '<a href="#"><img class="img-active" src="./images/notificationVide.png" alt=""><img class="img-hidden" src="./images/notificationPlein.png" alt=""></a>';
    echo '<a href="index.php?action=compte"><img src="./images/profil.webp" alt=""></a>';
echo '</div>';

echo '</div>';



if ($_REQUEST['action'] == '') {     

echo '<div class="container-milieu-bottom">';

    // carousel pour les contenus 'concu pour toi'
    echo '<h2 class="titre-carousel">Conçu pour toi</h2>';
    echo '<div class="carousel-container">';
        echo '<button class="carousel-btn left-btn"><img src="./images/fleche-gauche.png" alt="fleche gauche"></button>';
        echo '<div class="carousel-wrapper">';

        // Vérifier si des données existent
        if (!empty($data)) {
            // Parcourir chaque entrée musicale
            foreach ($data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/".$lien_img[1];
                } else {
                    $entry[3] = "images/default.jpg";
                }
                echo '<div class="carousel-slide">';
                // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                echo '<a href="#"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
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
            if (!empty($data)) {
                // Parcourir chaque entrée musicale
                foreach ($data as $entry) {
                    $lien_img = explode(' ', $entry[3]);
                    if (!str_starts_with($lien_img[1], 'null')){
                        $entry[3] = "images/".$lien_img[1];
                    } else {
                        $entry[3] = "images/default.jpg";
                    }
                    echo '<div class="carousel-slide">';
                    // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                    // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                    // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                    echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                    echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                    echo '<a href="#"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
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
        if (!empty($data)) {
            // Parcourir chaque entrée musicale
            foreach ($data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/".$lien_img[1];
                } else {
                    $entry[3] = "images/default.jpg";
                }
                echo '<div class="carousel-slide">';
                // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                echo '<a href="#"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
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
        if (!empty($data)) {
            // Parcourir chaque entrée musicale
            foreach ($data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/".$lien_img[1];
                } else {
                    $entry[3] = "images/default.jpg";
                }
                echo '<div class="carousel-slide">';
                // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
                // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
                // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a class="img-fav" href="#"><img src="images/coeurVide.png" alt="Image favoris"></a>';
                echo '<a href="#"><img class="img-album" src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucune donnée trouvée.</p>';
        }

        echo '</div>';
        echo '<button class="carousel-btn right-btn"><img src="./images/fleche-droite.png" alt="fleche droite"></button>';
    echo '</div>';

echo '</div>';
} else if ($_REQUEST['action'] == 'compte') {
    require 'src/compte.php';
} else if ($_REQUEST['action'] == 'bibliotheque') {
    require 'src/bibliotheque.php';
} else if ($_REQUEST['action'] == 'explorer') {
    require 'src/explorer.php';
} else if ($_REQUEST['action'] == 'favoris') {
    require 'src/favoris.php';
} else {
    require 'src/404.php';
}


echo '</div>';
echo '</div>';
?>
<!-- <script src="./js/menu.js"></script> -->
<script src="./js/Carousel.js"></script>
</body>
</html>
