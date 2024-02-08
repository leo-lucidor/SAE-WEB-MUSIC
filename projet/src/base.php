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
    <?php
    if ($_REQUEST['action'] == 'compte'){
        echo '<a class="btn-compte" href="#"><img src="./images/userPlein.png" alt=""></a>';
    } else {
        echo '<a class="btn-compte" href="index.php?action=compte"><img src="./images/userVide.png" alt=""></a>';
    }
    ?>
</div>

</div>

<?php

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
    $pdo = getPdo();
    
    $idAlbum = $_REQUEST['id'];
    $preAlbum = get_album_with_id($pdo, $idAlbum);
    $nomArtiste = get_nom_artiste_with_id($pdo, $preAlbum['ID_Artiste_By']);
    require 'src/album.php';
    $album = new Album($idAlbum, $preAlbum['Titre'], $nomArtiste, $preAlbum['Date_de_sortie'], $preAlbum['Genre'], $preAlbum['Pochette'], $preAlbum['ID_Artiste_Parent']);
    $album->afficher();
} else if ($_REQUEST['action'] == 'artiste') {
    $pdo = getPdo();

    $idArtiste = $_REQUEST['id'];
    $nomArtiste = get_artiste_with_id($pdo, $idArtiste);
    require 'src/artiste.php';
    $artiste = new Artiste($idArtiste, $nomArtiste[0]);
    $artiste->afficher();
} else if ($_REQUEST['action'] == 'editerArtiste') {
    $pdo = getPdo();

    $idArtiste = $_REQUEST['idArtiste'];
    $nomArtiste = get_artiste_with_id($pdo, $idArtiste);
    require 'src/editerArtiste.php';
    $editerArtiste = new editerArtiste($idArtiste, $nomArtiste[0]);
    $editerArtiste->afficher();
} else if ($_REQUEST['action'] == 'playlist') {
    $pdo = getPdo();

    $idPlaylist = $_REQUEST['idPlaylist'];
    $playlist = get_playlist_with_id($pdo, $idPlaylist);
    $listeMusique = get_musique_with_idPlaylist($pdo, $idPlaylist);
    require 'src/playlist.php';
    $playlist = new Playlist($idPlaylist, $playlist['ID_Utilisateur'], $playlist['Nom'], $listeMusique);
    $playlist->afficher();
} else {
    require 'src/404.php';
}

?>

</div>

