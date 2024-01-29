<?php
require 'src/BDD/Function/databaseGet.php';

$ligne1 = $_SESSION['pdo']["ligne1"];
$ligne2 = $_SESSION['pdo']["ligne2"];
$ligne3 = $_SESSION['pdo']["ligne3"];
$pdo = new PDO($ligne1);
$pdo->setAttribute($ligne2, $ligne3);


$nom = $_POST['email'];
$mdp = $_POST['password'];


$user = new Utilisateur();
$mdpVerif = $user->get_password_with_email($pdo, $nom);


if ($mdpVerif != $mdp){
    header('Location: index.php?erreur=identifiants ou mot de passe incorrect');
} else {
    $_SESSION['nom'] = $nom;
    $_SESSION['mdp'] = $mdp;
    header('Location: index.php?action=accueil');
}

echo $_SESSION['nom'];
echo $_SESSION['mdp'];