<?php
function deleteAlbum(PDO $pdo, int $idAlbum) {
    try {
        // delete dans favoris
        $stmt = $pdo->prepare("DELETE FROM Album_Playlist WHERE ID_Album = ?");
        $stmt->bindParam(1, $idAlbum);
        $stmt->execute();

        // delete dans Album
        $stmt = $pdo->prepare("DELETE FROM Album WHERE ID_Album = ?");
        $stmt->bindParam(1, $idAlbum);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'album : " . $e->getMessage();
        return false;
    }
}

function deleteArtiste(PDO $pdo, int $idArtiste) {
    try {
        // delete dans Artiste
        $stmt = $pdo->prepare("DELETE FROM Artiste WHERE ID_Artiste = ?");
        $stmt->bindParam(1, $idArtiste);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de l'artiste : " . $e->getMessage();
        echo "l'artiste est dans un album, impossible de le supprimer";
        return false;
    }
}
?>