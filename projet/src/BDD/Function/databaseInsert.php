<?php

function insertUser(PDO $pdo,String $userName, String $usePassword, String $userEmail) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Utilisateur (Nom_utilisateur, Mot_de_passe, Email) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $usePassword);
            $stmt->bindParam(3, $userEmail);
            $stmt->execute();

            $idUt = get_id_utlisateur($pdo, $userEmail);
            insertPlaylist($pdo,"Titres Likés", $idUt);

            return $idUt;
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage();
    }
}  

