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
