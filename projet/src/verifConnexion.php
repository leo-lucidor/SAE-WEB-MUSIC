<?php
// session_start();
require 'src/BDD/Function/databaseGet.php';

$nom = $_POST['email'];
$mdp = $_POST['password'];


$user = new Utilisateur();
$mdpVerif = $user->get_password_with_email($_SESSION['dataloader']->getPdo(), $nom);


if ($mdpVerif != $mdp){
    header('Location: index.php?erreur=identifiants ou mot de passe incorrect');
} else {
    $_SESSION['nom'] = $nom;
    $_SESSION['mdp'] = $mdp;
    header('Location: index.php?action=accueil');
}

echo $_SESSION['nom'];
echo $_SESSION['mdp'];