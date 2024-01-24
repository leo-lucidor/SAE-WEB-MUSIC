<?php

require 'vendor/autoload.php';

// Utiliser l'autoloader pour charger automatiquement les classes
require 'src/Autoloader.php';

// Charger les données du fichier YAML
$data = yaml_parse_file('extrait.yml');

// Vérifier si des données existent
if (!empty($data)) {
    // Parcourir chaque entrée musicale
    foreach ($data as $entry) {
        $music = new Music($entry);
        echo '<div>';
        echo '<h2>' . htmlspecialchars($music->getTitle()) . '</h2>';
        echo '<p><strong>Artiste:</strong> ' . htmlspecialchars($music->getArtist()) . '</p>';
        echo '<p><strong>Genre:</strong> ' . implode(', ', $music->getGenre()) . '</p>';
        echo '<p><strong>Année de sortie:</strong> ' . $music->getReleaseYear() . '</p>';
        echo '<img src="' . htmlspecialchars($music->getImage()) . '" alt="Image de la pochette">';
        echo '</div>';
        echo '<hr>';
    }
} else {
    echo '<p>Aucune donnée trouvée.</p>';
}
