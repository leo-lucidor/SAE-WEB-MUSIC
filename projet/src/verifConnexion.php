<?php
require 'src/BDD/Function/databaseGet.php';
require 'src/provider/pdo.php';

$pdo = getPdo();
$mail_username = $_POST['email_username'];
if (filter_var($mail_username, FILTER_VALIDATE_EMAIL)) {
    $mail = $mail_username;
    $username = get_nom_with_mail($pdo, $mail);
} else {
    $username = $mail_username;
    $mail = get_mail_with_username($pdo, $username);
}
$mdp = $_POST['password'];
$mdpVerif = get_password_with_email($pdo, $mail) || get_password_with_username($pdo, $username);

echo "test : ".$mdpVerif;


if ($mdpVerif != $mdp){
    header('Location: index.php?action=login&erreur=identifiants ou mot de passe incorrect');
} else {

    $_SESSION['mail'] = $mail;
    $_SESSION['mdp'] = $mdp;
    $_SESSION['nom'] = $username;
    header('Location: index.php?action=accueil');
}

echo $_SESSION['mail'];
echo $_SESSION['mdp'];
echo $_SESSION['nom'];