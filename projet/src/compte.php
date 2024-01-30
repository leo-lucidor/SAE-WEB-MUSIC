<?php

echo '<link rel="stylesheet" href="./css/compte.css">';

echo '<div class="container-compte">';

    echo '<h1>Compte</h1>';

    echo '<h2>Informations personnelles</h2>';
    echo '<p>Mail : '. $_SESSION['nom'] .'</p>';

    echo '<a href="/">Déconnexion</a>';

echo '</div>';
?>