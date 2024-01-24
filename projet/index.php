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
require 'src/Autoloader.php';
require 'Dataloader.php';

// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

$dataload = new Dataloader("database", "root");

$data = $dataload->getdata();
var_dump($data);

echo '<div class="container-all">';

echo '<aside class="container-left">';
echo '<div class="container-left-top">';

echo '<ul class="menu">';
    echo '<li><img class="img-active" id="img-accueil-plein" src="./images/maisonPlein.png" alt=""><img class="img-hidden" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><button id="btn-accueil" class="btn-accueil" href="#">Accueil</button></li>';
    echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><img class="img-hidden" id="img-explorer-plein" src="./images/explorerPlein.png" alt=""><button id="btn-explorer" class="btn-explorer" href="#">Explorer</button></li>';
    echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><img class="img-hidden" id="img-biblio-plein" src="./images/bibliothequePlein.png" alt=""><button id="btn-biblio" class="btn-biblio" href="#">Bibliothèque</button></li>';
echo '</ul>';

echo '<div class="container-playlist">';
    echo '<div class="container-playlist-top">';
        echo '<h2 class="titre-playlist">Playlists</h2>';
        echo '<button class="btn-creer-playlist">+</button>';
    echo '</div>';

    echo '<ul class="container-playlist-bottom">';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<p>Playlist 1</p>';
        echo '</a>';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<p>Playlist 2</p>';
        echo '</a>';
        echo '<a class="playlist">';
            echo '<img src="./images/default.jpg" alt="">';
            echo '<p>Playlist 3</p>';
        echo '</a>';
    echo '</ul>';
echo '</div>';


echo '</div>';

echo '</aside>';


echo '<div class="container-milieu">';
echo '<div class="container-milieu-top">';

echo '<div class="container-milieu-top-left">';
    echo '<h1>Spotiut\'O</h1>';
    echo '<input class="rechercher" type="text" placeholder="🔍 Rechercher">';
echo '</div>';

echo '<div class="container-milieu-top-right">';
    echo '<a href="#"><img class="img-active" src="./images/notificationVide.png" alt=""><img class="img-hidden" src="./images/notificationPlein.png" alt=""></a>';
    echo '<img src="./images/profil.webp" alt="">';
echo '</div>';

echo '</div>';

echo '<div class="container-milieu-bottom">';

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
        echo '<div class="album">';
        echo '<h2>' . htmlspecialchars($entry[6]) . '</h2>';
        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
        // echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
        // echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
        echo '<img src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette">';
        echo '</div>';
    }
} else {
    echo '<p>Aucune donnée trouvée.</p>';
}
echo '</div>';
echo '</div>';
echo '</div>';
?>
<script src="./js/menu.js"></script>
</body>
</html>
