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
            header('Location: index.php?action=compte&erreur=Erreur lors de la modification de l\'utilisateur');
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
            header('Location: index.php?action=editerArtiste&idArtiste='. $id_artiste .'&erreur=Erreur lors de la modification de l\'artiste');
        }
    }
