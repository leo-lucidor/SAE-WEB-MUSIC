<?php

echo '<aside class="container-left">';
echo '<div class="container-left-top">';

echo '<h2 class="titre-menu">Menu rapide</h2>';

echo '<ul class="menu">';
    if ($_REQUEST['action'] == 'accueil'){
        echo '<li><img class="img-active" id="img-accueil-plein" src="./images/maisonPlein.png" alt=""><a id="btn-accueil" class="btn-accueil" href="#">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'bibliotheque'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-plein" src="./images/bibliothequePlein.png" alt=""><a id="btn-biblio" class="btn-biblio" href="#">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    } else if ($_REQUEST['action'] == 'explorer'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-plein" src="./images/explorerPlein.png" alt=""><a id="btn-explorer" class="btn-explorer" href="#">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'favoris') {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-plein" src="./images/coeurPlein.png" alt=""><a id="btn-favoris" class="btn-favoris" href="#">Favoris</a></li>';
    } else {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }
    
echo '</ul>';


echo '<div class="container-playlist">';

    
        $playlists = $_SESSION['playlistUser'];

        print_r("les playlists : ".$playlists);

        echo '<div class="container-playlist-top">';
            echo '<h2 class="titre-playlist">Playlists</h2>';
            echo '<button class="btn-creer-playlist">+</button>';
        echo '</div>';


        echo '<ul class="container-playlist-bottom">';
            echo '<a class="playlist" href="index.php?action=playlist">';
                echo '<img src="./images/PLAYLIST/coup-coeur.jpg" alt="">';
                echo '<div class="container-playlist-bottom-text">';
                    echo '<p>Coup de coeur</p>';
                    echo '<p>par Spotiut\'O</p>';
                echo '</div>';
            echo '</a>';
            echo '<a class="playlist" href="index.php?action=playlist">';
                echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                echo '<div class="container-playlist-bottom-text">';
                    echo '<p>Playlist 2</p>';
                    echo '<p>par '. trim($_SESSION['nom']) .'</p>';
                echo '</div>';
            echo '</a>';
            echo '<a class="playlist" href="index.php?action=playlist">';
                echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                echo '<div class="container-playlist-bottom-text">';
                    echo '<p>Playlist 3</p>';
                    echo '<p>par '. trim($_SESSION['nom']) .'</p>';
                echo '</div>';
            echo '</a>';
        echo '</ul>';
   
echo '</div>';


echo '</div>';

echo '</aside>';

