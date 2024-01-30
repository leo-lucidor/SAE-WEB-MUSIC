<?php
require 'src/BDD/Function/databaseGet.php';
require 'src/provider/pdo.php';


$nom = $_POST['email'];
$mdp = $_POST['password'];

$pdo = getPdo();
$mdpVerif = get_password_with_email($pdo, $nom);

echo "test : ".$mdpVerif;


if ($mdpVerif != $mdp){
    header('Location: index.php?erreur=identifiants ou mot de passe incorrect');
} else {
    $_SESSION['nom'] = $nom;
    $_SESSION['mdp'] = $mdp;
    header('Location: index.php?action=accueil');
}

echo $_SESSION['nom'];
echo $_SESSION['mdp'];