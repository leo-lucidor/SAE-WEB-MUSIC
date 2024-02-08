<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <li class="navbar-item"><a href="index.php?action=explorer&search=Tout">Tout</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Titres">Titres</a></li>
                <li class="navbar-item active"><a href="index.php?action=explorer&search=Artistes">Artistes</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Albums">Albums</a></li>
                <li class="navbar-item"><a href="index.php?action=explorer&search=Playlists">Playlists</a></li>
            </ul>
        </nav>
    </div>
    <?php
    // Vérifier si des données existent
    if (!empty($artistes)) {
            // Parcourir chaque entrée musicale
            foreach ($artistes as $entry) {
                $lien_img = explode(' ', $entry[0]);

                $imgVerif = get_img_album_with_artist_name(getPdo(), $entry[0]);

                $path = './images/ARTISTES/';
                $imgArtiste = trim($entry[0]).'.jpg';
                $imgArtisteCondition = checkFileNameExists($path, $imgArtiste);

                if ($imgArtisteCondition){
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ARTISTES/' . trim($entry[0]) . '.jpg" alt="Image de la pochette"></a>';
                } else if ($imgVerif != null && !$imgArtisteCondition){
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/' . trim($imgVerif) . '" alt="Image de la pochette"></a>';
                } else {
                    echo '<a href="index.php?action=artiste&id='. trim($entry[1]) .'"><img class="img-artiste" src="./images/ALBUMS/default.jpg" alt="Image de la pochette"></a>';
                }
                echo '<p>' . htmlspecialchars($entry[0]) . '</p>';
            }
        } else {
            echo '<p>Aucune donnée trouvée.</p>';
        }
    ?>
</div>

