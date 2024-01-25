<?php

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
    require 'src/accueil.php';
    $acceuil = new Accueil($data);
    // print_r($acceuil->getData());
    $acceuil->afficher();
} else if ($_REQUEST['action'] == 'compte') {
    require 'src/compte.php';
} else if ($_REQUEST['action'] == 'bibliotheque') {
    require 'src/bibliotheque.php';
} else if ($_REQUEST['action'] == 'explorer') {
    require 'src/explorer.php';
} else if ($_REQUEST['action'] == 'favoris') {
    require 'src/favoris.php';
} else if ($_REQUEST['action'] == 'album') {
    require 'src/album.php';
} else if ($_REQUEST['action'] == 'playlist') {
    require 'src/playlist.php';
} else {
    require 'src/404.php';
}


echo '</div>';

?>