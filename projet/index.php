<?php

require 'vendor/autoload.php';
require 'src/Autoloader.php';

// Utiliser l'autoloader pour charger automatiquement les classes
Autoloader::register();

$file = fopen('extrait.yml', 'r');

// Initialiser un tableau pour stocker les données
$data = [];

$dico = [];

// Lire le fichier ligne par ligne
while (($line = fgets($file)) !== false) {
    $elem = explode(':', $line, 2);
    if ($elem[0] == '- by'){
        $data[] = $dico;
        $dico = [];
    }
    $dico[] = $elem[1];
}

fclose($file);

// Vérifier si des données existent
if (!empty($data)) {
    // Parcourir chaque entrée musicale
    foreach ($data as $entry) {
        $lien_img = explode(' ', $entry[3]);
        $entry[3] = "images/".$lien_img[1];
        echo '<div>';
        echo '<h2>' . htmlspecialchars($entry[6]) . '</h2>';
        echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($entry[0]) . '</p>';
        echo '<p><strong>Genre:</strong> ' . htmlspecialchars($entry[2]) . '</p>';
        echo '<p><strong>Année de sortie:</strong> ' . htmlspecialchars($entry[5]) . '</p>';
        if ($entry[3] != null){
            echo '<img src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette">';
        } else {
            echo '<img src="images/default.png" alt="Image de la pochette">';
        }
        echo '</div>';
        // $music = new Music($entry);
        // echo '<div>';
        // echo '<h2>' . htmlspecialchars($music->getTitle()) . '</h2>';
        // echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($music->getArtist()) . '</p>';
        // echo '<p><strong>Genre:</strong> ' . implode(', ', $music->getGenre()) . '</p>';
        // echo '<p><strong>Année de sortie:</strong> ' . $music->getReleaseYear() . '</p>';
        // echo '<img src="' . htmlspecialchars($music->getImage()) . '" alt="Image de la pochette">';
        // echo '</div>';
        // echo '<hr>';
    }
} else {
    echo '<p>Aucune donnée trouvée.</p>';
}

function parseMusicBlock($block)
{
    $lines = explode("\n", $block);
    $entry = [];

    foreach ($lines as $line) {
        // Supprimer les espaces en début et fin de ligne
        $line = trim($line);

        // Ignorer les lignes vides ou celles commençant par '#'
        if ($line !== '' && strpos($line, '#') !== 0) {
            // Diviser la ligne en clé et valeur
            $parts = explode(':', $line, 2);

            // Vérifier si la ligne contient une clé et une valeur
            if (count($parts) === 2) {
                // Supprimer les espaces en début et fin de clé et valeur
                $key = trim($parts[0]);
                $value = trim($parts[1]);

                // Ajouter au tableau associatif
                $entry[$key] = $value;
            }
        }
    }

    return $entry;
}
