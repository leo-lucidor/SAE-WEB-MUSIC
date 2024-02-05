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

    function update_note($pdo, $note, $id_utilisateur, $id_album){
        try {
        
            $smtp = $pdo->prepare("UPDATE Note SET Note = :Note WHERE ID_Utilisateur = :ID_Utilisateur AND ID_Album = :ID_Album");
            $smtp->bindParam(':Note', $note); 
            $smtp->bindParam(':ID_Utilisateur', $id_utilisateur);
            $smtp->bindParam(':ID_Album', $id_album);
            $smtp->execute();
        }
        catch (PDOException $e) {
            echo 'erreur update note';
        }               
    }
