<?php

class Utilisateur{

    public function get_password_with_email(PDO $pdo, String $mail){
        try{
            $stmt = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateur WHERE Email = :Email");
            $stmt->bindParam(':Email', $mail);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['Mot_de_passe'];
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function get_password_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT password FROM utilisateur WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['password'];
    }

    public function get_id_with_email(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['id'];
    }

    public function get_mail_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT mail FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['mail'];
    }

    public function get_pseudo_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['pseudo'];
    }

    public function get_pseudo_with_mail(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['pseudo'];
    }

    public function get_id_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['id'];
    }


}