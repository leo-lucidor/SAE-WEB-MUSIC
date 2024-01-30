<link rel="stylesheet" href="./css/accueil.css">
<script src="./js/search.js"></script>

<div class="container-milieu">
<div class="container-milieu-top">

<div class="container-milieu-top-left">
    <img class="logo" src="images/logo.png" alt="logo">
    <h1>Spotiut'O</h1>
    <div class="rechercher">
        <img class="search_icon" src="./images/search.svg" alt="">
        <input class="input_search" type="text" placeholder="Artistes, titres...">
        <img class="cross_icon" src="./images/cross.svg" alt="">
    </div>
</div>

<div class="container-milieu-top-right">
    <a href="#"><img class="img-active" src="./images/notificationVide.png" alt=""><img class="img-hidden" src="./images/notificationPlein.png" alt=""></a>
    <a href="index.php?action=compte"><img src="./images/profil.webp" alt=""></a>
</div>

<?php

require 'src/fonctionsExterne.php';
$fonctions = new Fonctions($data);

if ($_REQUEST['action'] == 'accueil') {     
    require 'src/accueil.php';
    $acceuil = new Accueil($data);
    $acceuil->afficher();
} else if ($_REQUEST['action'] == 'compte') {
    require 'src/compte.php';
} else if ($_REQUEST['action'] == 'bibliotheque') {
    require 'src/bibliotheque.php';
} else if ($_REQUEST['action'] == 'explorer') {
    require 'src/search.php';
    $search = new Recherche($data);
    $search->afficher();
} else if ($_REQUEST['action'] == 'favoris') {
    require 'src/favoris.php';
} else if ($_REQUEST['action'] == 'album') {
    $idAlbum = $_REQUEST['id'];
    $preAlbum = $fonctions->getAlbumFromData($idAlbum);
    // print_r($preAlbum);
    require 'src/album.php';
    $album = new Album($preAlbum[1], $preAlbum[6], $preAlbum[0], $preAlbum[5], $preAlbum[2], $preAlbum[3], $preAlbum[4]);
    $album->afficher();
    
} else if ($_REQUEST['action'] == 'playlist') {
    require 'src/playlist.php';
} else {
    require 'src/404.php';
}

?>
</div>

