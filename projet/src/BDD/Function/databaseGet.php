<?php

    function get_password_with_email(PDO $pdo, String $mail){
        try{
            $stmt = $pdo->prepare("SELECT Mot_de_passe FROM Utilisateur WHERE Email = :Email");
            $stmt->bindParam(':Email', $mail);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['Mot_de_passe'];
        } catch (PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    function get_password_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT password FROM utilisateur WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['password'];
    }

    function get_id_with_email(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT ID_Utilisateur FROM Utilisateur WHERE Email = :Email");
        $stmt->bindParam(':Email', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Utilisateur'];
    }

    function get_mail_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT mail FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['mail'];
    }

    function get_pseudo_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['pseudo'];
    }

    function get_pseudo_with_mail(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT pseudo FROM utilisateur WHERE mail = :mail");
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['pseudo'];
    }

    function get_id_with_pseudo(PDO $pdo, String $pseudo){
        $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE pseudo = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['id'];
    }

    function get_all_album(PDO $pdo){
        $stmt = $pdo->prepare("SELECT Titre,Date_de_sortie,Genre,Pochette,ID_Artiste_By,ID_Artiste_Parent, ID_Album FROM Album");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_albums_artiste(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Titre,Date_de_sortie,Genre,Pochette,ID_Artiste_By,ID_Artiste_Parent, ID_Album FROM Album WHERE ID_Artiste_By = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_artiste_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    function get_all_artiste(PDO $pdo){
        $stmt = $pdo->prepare("SELECT Nom,ID_Artiste FROM Artiste");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_all_genre(PDO $pdo){
        // $stmt = $pdo->prepare("SELECT Nom_du_genre FROM Genre WHERE Nom_du_genre IN (SELECT Genre FROM Album GROUP BY Genre ORDER BY COUNT(Genre))");
        $stmt = $pdo->prepare("SELECT Nom_du_genre FROM Genre");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    function get_genre_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom_du_genre FROM Genre WHERE ID_Genre = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_du_genre'];
    }

    function get_albums_with_genre(PDO $pdo, String $nom){
        $result = array();
        $albums = get_all_album($pdo);

        for ($i = 0; $i < count($albums); $i++){
            $genres = explode(',', $albums[$i]['Genre']);
            for ($j = 0; $j < count($genres); $j++){
                if (trim($genres[$j]) == $nom){
                    array_push($result, $albums[$i]);
                }
            }
        }
        return $result;
    }

    function get_img_album_with_artist_name(PDO $pdo, String $name){
        $stmt = $pdo->prepare("SELECT Pochette FROM Album WHERE ID_Artiste_By = (SELECT ID_Artiste FROM Artiste WHERE Nom = :name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Pochette'];
    }

    function get_nom_with_mail(PDO $pdo, String $mail){
        $stmt = $pdo->prepare("SELECT Nom_utilisateur FROM utilisateur WHERE Email = :Email");
        $stmt->bindParam(':Email', $mail);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom_utilisateur'];
    }

    function get_id_with_artist_name(PDO $pdo, String $name){
        $stmt = $pdo->prepare("SELECT ID_Artiste FROM Artiste WHERE Nom = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['ID_Artiste'];
    }

    function get_name_with_id(PDO $pdo, int $id){
        $stmt = $pdo->prepare("SELECT Nom FROM Artiste WHERE ID_Artiste = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['Nom'];
    }



    


