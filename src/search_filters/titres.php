<div class="container-milieu-bottom">
    <div class="div-navbar">
        <nav class="navbar">
            <ul class="liste">
                <?php
                        if (!empty($titres || $artistes || $this->data || $playlists)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Tout'>Tout</a></li>";
                        }
                        if (!empty($titres)) {
                            echo "<li class='navbar-item active'><a href='index.php?action=explorer&search=Titres'>Titres</a></li>";
                        }
                        if (!empty($artistes)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Artistes'>Artistes</a></li>";
                        }
                        if (!empty($this->data)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Albums'>Albums</a></li>";
                        }
                        if (!empty($playlists)) {
                            echo "<li class='navbar-item'><a href='index.php?action=explorer&search=Playlists'>Playlists</a></li>";
                        }
                ?>
            </ul>
        </nav>
    </div>
    <?php
        if (!empty($titres)) {
    ?>
                <h2>Titres</h2>
                <div class="results">
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Artiste</th>
                                <th>Album</th>
                                <th>Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Parcourir chaque entrée musicale
                                foreach ($titres as $entry) {
                                    echo '<tr>';
                                    echo '<td>' . htmlspecialchars($entry[1]) . '</td>';
                                    $album = get_album_with_id(getPdo(), $entry[3]);
                                    $artiste = get_artiste_with_id(getPdo(), $album[5]);
                                    echo '<td>' . htmlspecialchars($artiste[0]) . '</td>';
                                    echo '<td>' . htmlspecialchars($album[0]) . '</td>';
                                    echo '<td> N/A </td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
</div>