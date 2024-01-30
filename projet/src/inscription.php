<?php
require 'src/provider/pdo.php';

$pdo = getPdo();

$nom = $_POST['name'];
$mdp = $_POST['password'];
$email = $_POST['email'];

echo $nom;
echo '<br>';
echo $mdp;
echo '<br>';
echo $email;

insertUser($pdo, $nom, $mdp, $email);

$_SESSION['nom'] = $email;
$_SESSION['mdp'] = $mdp;

header('Location: index.php?action=accueil');

