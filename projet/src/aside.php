<?php
echo '<link rel="stylesheet" href="./css/popup.css">';

echo '<aside class="container-left">';
echo '<div class="container-left-top">';

echo '<h2 class="titre-menu">Menu rapide</h2>';

echo '<ul class="menu">';
    if ($_REQUEST['action'] == 'accueil'){
        echo '<li><img class="img-active" id="img-accueil-plein" src="./images/maisonPlein.png" alt=""><a id="btn-accueil" class="btn-accueil" href="#">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'bibliotheque'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-plein" src="./images/bibliothequePlein.png" alt=""><a id="btn-biblio" class="btn-biblio" href="#">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    } else if ($_REQUEST['action'] == 'explorer'){
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-plein" src="./images/explorerPlein.png" alt=""><a id="btn-explorer" class="btn-explorer" href="#">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }  else if ($_REQUEST['action'] == 'favoris') {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-plein" src="./images/coeurPlein.png" alt=""><a id="btn-favoris" class="btn-favoris" href="#">Favoris</a></li>';
    } else {
        echo '<li><img class="img-active" id="img-accueil-vide" src="./images/maisonVide.png" alt=""><a id="btn-accueil" class="btn-accueil" href="index.php?action=accueil">Accueil</a></li>';
        echo '<li><img class="img-active" id="img-explorer-vide" src="./images/explorerVide.png" alt=""><a id="btn-explorer" class="btn-explorer" href="index.php?action=explorer&search=Tout">Explorer</a></li>';
        echo '<li><img class="img-active" id="img-biblio-vide" src="./images/bibliothequeVide.png" alt=""><a id="btn-biblio" class="btn-biblio" href="index.php?action=bibliotheque">Bibliothèque</a></li>';
        echo '<li><img class="img-active" id="img-coeur-vide" src="./images/coeurVide.png" alt=""><a id="btn-favoris" class="btn-favoris" href="index.php?action=favoris">Favoris</a></li>';
    }
    
echo '</ul>';


echo '<div class="container-playlist">';

    
        $playlists = $_SESSION['playlistUser'];

        echo '<div class="container-playlist-top">';
            echo '<h2 class="titre-playlist">Playlists</h2>';
            echo '<button id="btnAddPlaylist" class="btn-creer-playlist">+</button>';
        echo '</div>';

        echo '<div id="playlistPopup" style="display: none;">';

            echo '<button id="btnClosePopup"><img src="./images/croix.png" alt=""></button>';
            echo '<form id="playlist-form" action="index.php?action=ajouterPlaylist" method="POST" class="form">';
                echo '<div class="form-group">';
                    echo '<label for="name">Nom de la playlist</label>';
                    echo '<input name="nomPlaylist" type="text" id="playlistName" placeholder="Nom de la playlist">';
                echo '</div>';
                echo '<button type="submit" id="btnSavePlaylist">Valider</button>';
            echo '</form>';

        echo '</div>';

        // erreur ajout playlist
        echo '<p class="erreur-ajout-playlist">'. $_REQUEST['erreurAjoutPlaylist'] .'</p>';

        if ($playlists == null || empty($playlists)){
            echo '<p class="aucune-playlist">Aucune playlist</p>';
        } else {
            for ($i = 0; $i < count($playlists); $i++) {
                if ($_REQUEST['idPlaylist'] == $playlists[$i]['ID_Playlist']){
                    echo '<a class="playlist playlist-actif" href="#">';
                } else {
                    echo '<a class="playlist" href="index.php?action=playlist&idPlaylist='. $playlists[$i]['ID_Playlist'] .'">';
                }
                    if (trim($playlists[$i]['Nom']) == 'Titres Likés'){
                        echo '<img src="./images/PLAYLIST/coup-coeur.jpg" alt="">';
                    } else {
                        echo '<img src="./images/ALBUMS/default.jpg" alt="">';
                    }
                    echo '<div class="container-playlist-bottom-text">';
                        echo '<p>'. $playlists[$i]['Nom'] .'</p>';
                        if (trim($playlists[$i]['Nom']) == 'Titres Likés'){
                            echo '<p>par Spotiut\'O</p>';
                        } else {
                            echo '<p>par '. trim($_SESSION['nom']) .'</p>';
                        }
                    echo '</div>';
                echo '</a>';
            }
        }

        echo '<script src="./js/AjouterPlaylist.js"></script>';
   
echo '</div>';


echo '</div>';

echo '</aside>';



