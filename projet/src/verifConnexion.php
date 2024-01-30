<?php
require 'src/BDD/Function/databaseGet.php';
require 'src/provider/pdo.php';


$mail = $_POST['email'];
$mdp = $_POST['password'];
$nom = get_nom_with_mail(getPdo(), $mail);

$pdo = getPdo();
$mdpVerif = get_password_with_email($pdo, $mail);

echo "test : ".$mdpVerif;


if ($mdpVerif != $mdp){
    header('Location: index.php?erreur=identifiants ou mot de passe incorrect');
} else {
    $_SESSION['mail'] = $mail;
    $_SESSION['mdp'] = $mdp;
    $_SESSION['nom'] = $nom;
    header('Location: index.php?action=accueil');
}

echo $_SESSION['mail'];
echo $_SESSION['mdp'];
echo $_SESSION['nom'];