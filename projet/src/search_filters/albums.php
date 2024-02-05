<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <li class="navbar-item"><a href="index.php?action=explorer&search=Tout">Tout</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Titres">Titres</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Artistes">Artistes</a></li>
                <li class="navbar-item active"><a href="index.php?action=explorer&search=Albums">Albums</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Playlists">Playlists</a></li>
            </ul>
        </nav>
    </div>
    <?php
    // Vérifier si des données existent
        if (!empty($this->data)) {
            // Parcourir chaque entrée musicale
            foreach ($this->data as $entry) {
                $lien_img = explode(' ', $entry[3]);
                if (!str_starts_with($lien_img[1], 'null')){
                    $entry[3] = "images/ALBUMS/" . trim($lien_img[1]);
                } else {
                    $entry[3] = "images/ALBUMS/default.jpg";
                }
                
                echo '<div class="search-result">';
                echo '<p>' . htmlspecialchars($entry[6]) . '</p>';
                echo '<a href="index.php?action=album&id='. trim($entry[1]) .'"><img src="' . htmlspecialchars($entry[3]) . '" alt="Image de la pochette"></a>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun résultat trouvé.</p>';
        }
    ?>
</div>