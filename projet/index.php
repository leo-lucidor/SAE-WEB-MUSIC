<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiut'O</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
</head>
<body>

<?php

error_reporting(E_ERROR | E_PARSE);

require 'vendor/autoload.php';
require 'src/autoloader.php';
require 'src/provider/Dataloader.php';
require 'src/provider/Dataloader_function.php';
  
// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

session_start();
$dataloader = new Dataloader('database.sqlite3', 'extrait.yml');

// $dataloader->createTables();
// returnToBaseBDD($dataloader->getPdo());

$pdo = $dataloader->getPdo();
$data = getdata();

// print_r($data);

echo '<div class="container-all">';

if ($_REQUEST == null) {
    require 'src/login.php';  
} else if ($_REQUEST['erreur'] != null && $_REQUEST['action'] == 'login') {
    require 'src/login.php';
} else if ($_REQUEST['action'] == 'login') {
    require 'src/verifConnexion.php';
} else if ($_REQUEST['action'] == 'inscription') {
    require 'src/inscription.php';
} else if ($_REQUEST['action'] == 'VerifInscription'){
    require 'src/BDD/Function/databaseGet.php';
    $idUser = get_id_with_email($pdo, $_SESSION['mail']);
    $_SESSION['playlistUser'] = get_playlist_utilisateur($pdo, $idUser);
    header('Location: index.php?action=accueil');
} else if ($_REQUEST['action'] == 'deconnexion') {
    require 'src/provider/deconnexion.php';
} else if ($_REQUEST['action'] == 'modifierUser') {
    require 'src/updateUser.php'; 
} else if ($_REQUEST['action'] == 'modifierArtiste') {
    require 'src/updateArtiste.php';
}
else {
    require 'src/BDD/Function/databaseGet.php';
    $idUser = get_id_with_email($pdo, $_SESSION['mail']);
    $_SESSION['playlistUser'] = get_playlist_utilisateur($pdo, $idUser);
    require 'src/aside.php';
    require 'src/base.php';
} 

echo '</div>';
?>
<script src="./js/Carousel.js"></script>
</body>
</html>
