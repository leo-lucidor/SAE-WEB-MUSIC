<?php

    function update_utilisateur($pdo, $nom, $mdp, $email, $id_utilisateur){
        try {
            $smtp = $pdo->prepare("UPDATE Utilisateur SET Nom_utilisateur = :Nom_utilisateur, Mot_de_passe = :Mot_de_passe, Email = :Email WHERE ID_Utilisateur = :ID_Utilisateur");
            $smtp->bindParam(':Nom_utilisateur', $nom);
            $smtp->bindParam(':Mot_de_passe', $mdp);
            $smtp->bindParam(':Email', $email);
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->execute();
            echo 'modif user';
        } catch (PDOException $e) {
            echo 'erreur update user';
        }
    }
    
    function update_artiste($pdo, $nom, $id_artiste){
        try {
            $smtp = $pdo->prepare("UPDATE Artiste SET Nom = :Nom WHERE ID_Artiste = :ID_Artiste");
            $smtp->bindParam(':Nom', $nom);
            $smtp->bindParam(':ID_Artiste', $id_artiste);
            $smtp->execute();
            echo 'modif artiste';
        } catch (PDOException $e) {
            echo 'erreur update artiste';
        }
    }

    function note_Existe($pdo, $id_utilisateur, $id_album){
        try {
            $smtp = $pdo->prepare("SELECT * FROM Note WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Album', $id_album);
            $smtp->execute();
            $result = $smtp->fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur note existe';
        }
    }

    function favorisAlbumExiste($pdo, $id_utilisateur, $id_album){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Album WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Album', $id_album);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

    function favorisMusiqueExiste($pdo, $id_utilisateur, $id_Musique){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Musique WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Musique = :ID_Musique");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Musique', $id_Musique);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }

    function favorisArtisteExiste($pdo, $id_utilisateur, $id_artiste){
        try {
            $smtp=$pdo->prepare("SELECT * FROM Favoris_Artiste WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Artiste = :ID_Artiste");
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Artiste', $id_artiste);
            $smtp->execute();
            $result = $smtp -> fetchAll();
            if(count($result) == 0){
                return false;
            }
            else{
                return true;
            }
        }
        catch (PDOException $e) {
            echo 'erreur favoris existe';
        } 
    }


    function getPlaylistTitreLikeUser($pdo, $id_utilisateur) {
        try {
            $stmt = $pdo->prepare("SELECT ID_Playlist FROM Playlist WHERE ID_Utilisateur = ? AND Nom = Titres Likés");
            $stmt->bindParam(1, $id_utilisateur);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération de la playlist Titres Likés : " . $e->getMessage();
            return false;
        }
    }

    function insertMusicPlaylistFavoris(PDO $pdo, int $idMusique, int $idPlaylist) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Musique_Playlist (ID_Musique, ID_Playlist) VALUES (?, ?)");
            $stmt->bindParam(1, $idMusique);
            $stmt->bindParam(2, $idPlaylist);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la musique dans la playlist : " . $e->getMessage();
            return false;
        }
    
        
    }

    function deleteMusicPlaylistFavoris(PDO $pdo, int $idMusique, int $idPlaylist) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Musique_Playlist WHERE ID_Musique = ? AND ID_Playlist = ?");
            $stmt->bindParam(1, $idMusique);
            $stmt->bindParam(2, $idPlaylist);
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la musique dans la playlist : " . $e->getMessage();
            return false;
        }
    }
    

    function update_favoris_album($pdo, $id_utilisateur, $id_album){
        try {
            $verif_favoris = favorisAlbumExiste($pdo, $id_utilisateur, $id_album);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Album (ID_Utilisateur, ID_Album) VALUES (:ID_Utilisateur, :ID_Album)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Album WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris album';
        }
    }

    function update_favoris_musique($pdo, $id_utilisateur, $id_musique){
        try {
            $verif_favoris = favorisMusiqueExiste($pdo, $id_utilisateur, $id_musique);
            $idPlaylist = getPlaylistTitreLikeUser($pdo, $id_utilisateur);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Musique (ID_Utilisateur, ID_Musique) VALUES (:ID_Utilisateur, :ID_Musique)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Musique', $id_musique);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Musique WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Musique = :ID_Musique");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Musique', $id_musique);
                $smtp->execute();
                insertMusicPlaylistFavoris($pdo, $id_musique, $idPlaylist);
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris musique';
        }
    }

    function update_favoris_artiste($pdo, $id_utilisateur, $id_artiste){
        try {
            $verif_favoris = favorisArtisteExiste($pdo, $id_utilisateur, $id_artiste);
            if($verif_favoris == false){
                $smtp = $pdo->prepare("INSERT INTO Favoris_Artiste (ID_Utilisateur, ID_Artiste) VALUES (:ID_Utilisateur, :ID_Artiste)");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Artiste', $id_artiste);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("DELETE FROM Favoris_Artiste WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Artiste = :ID_Artiste");
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Artiste', $id_artiste);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update favoris artiste';
        }
    }


    function update_note($pdo, $note, $id_utilisateur, $id_album){
        try {
            $verif_note = note_Existe($pdo, $id_utilisateur, $id_album);
            if($verif_note == false){
                $smtp = $pdo->prepare("INSERT INTO Note (Valeur, ID_Utilisateur, ID_Album) VALUES (:Valeur, :ID_Utilisateur, :ID_Album)");
                $smtp->bindParam(':Valeur', $note);
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
            else{
                $smtp = $pdo->prepare("UPDATE Note SET Valeur = :Valeur WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
                $smtp->bindParam(':Valeur', $note);
                $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
                $smtp->bindParam(':ID_Album', $id_album);
                $smtp->execute();
            }
        }
        catch (PDOException $e) {
            echo 'erreur update note';
        }               
    }
