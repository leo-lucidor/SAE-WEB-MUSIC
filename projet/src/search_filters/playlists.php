<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <li class="navbar-item"><a href="index.php?action=explorer&search=Tout">Tout</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Titres">Titres</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Artistes">Artistes</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Albums">Albums</a></li>
                <li class="navbar-item active"><a href="index.php?action=explorer&search=Playlists">Playlists</a></li>
            </ul>
        </nav>
    </div>
    <?php
    // Vérifier si des données existent
        if (!empty($playlists)) {
            // Parcourir chaque entrée musicale
            foreach ($playlists as $entry) {
                echo '<div class="search-result">';
                echo '<p>Playlist : ' . htmlspecialchars($entry[2]) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun résultat trouvé.</p>';
        }
    ?>
</div>