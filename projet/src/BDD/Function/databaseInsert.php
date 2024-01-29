<?php
class UtilisateurInsert {
    public function insertUser(PDO $pdo, String $mail, String $pseudo, String $password){
        try{
            $stmt = $pdo->prepare("INSERT INTO Utilisateur (Email, Nom_utilisateur, Mot_de_passe) VALUES (:Email, :Nom_utilisateur, :Mot_de_passe)");
            $stmt->bindParam(':Email', $mail);
            $stmt->bindParam(':Nom_utilisateur', $pseudo);
            $stmt->bindParam(':Mot_de_passe', $password);
            $stmt->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
}

