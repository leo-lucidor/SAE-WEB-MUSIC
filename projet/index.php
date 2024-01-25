<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiut'O</title>
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
</head>
<body>

<?php

require 'vendor/autoload.php';
require 'src/autoloader.php';

// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

$file = fopen('extrait.yml', 'r');
$data = [];
$dico = [];

// Lire le fichier ligne par ligne
while (($line = fgets($file)) !== false) {
    $elem = explode(':', $line, 2);
    if ($elem[0] == '- by'){
        if (!empty($dico)){
            $data[] = $dico;
            $dico = [];
        }
    }
    $dico[] = $elem[1];
}
fclose($file);

echo '<div class="container-all">';

require 'src/aside.php';
require 'src/base.php';

echo '</div>';
?>
<!-- <script src="./js/menu.js"></script> -->
<script src="./js/Carousel.js"></script>
</body>
</html>
