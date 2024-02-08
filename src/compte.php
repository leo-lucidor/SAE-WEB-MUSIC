<?php

echo '<link rel="stylesheet" href="./css/compte.css">';

echo '<div class="container-compte">';

    echo '<form action="index.php?action=modifierUser" method="POST" class="container-info">';
        echo '<h2>Informations personnelles</h2>';
        echo '<input type="text" placeholder="Nom" name="nom" value="'. $_SESSION['nom'] .'">';
        echo '<input type="mail" placeholder="Mail" name="mail" value="'. $_SESSION['mail'] .'">';
        echo '<input type="password" name="mdp" placeholder="Mot de passe" value="'. $_SESSION['mdp'] .'">';
        echo '<input type="password" name="mdpVerif" placeholder="Confirmer mot de passe" value="'. $_SESSION['mdp'] .'">';

        if (isset($_REQUEST['erreur'])) {
            echo '<p class="erreur">'. $_REQUEST['erreur'] .'</p>';
            unset($_REQUEST['erreur']);
        }  

        echo '<input type="submit" value="Modifier">';
    echo '</form>';

    echo '<a href="index.php?action=deconnexion">Déconnexion</a>';

echo '</div>';
?>