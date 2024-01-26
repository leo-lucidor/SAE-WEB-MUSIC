<?php

date_default_timezone_set('Europe/Paris');

try {
  function getUserWithName($nom,$file_db){
    $stmt=$file_db->query("SELECT * from contacts where nom='"
    .$nom."'");
    $pers=$stmt->fetchObject();
    return $pers;
  }

  function getScoreWithUserId($id,$file_db){
    $stmt=$file_db->query("SELECT score from scores where contact_id='".$id."'");
    $score=$stmt->fetchObject();
    return $score->score;
  }

  function getUserIdWithName($nom,$file_db){
    $stmt=$file_db->query("SELECT id from contacts where nom='"
    .$nom."'");
    $id=$stmt->fetchObject();
    return $id->id;
  }

  function insertScore($score,$contact_id,$file_db){
    $timestamp = time();
    $time = gmdate('Y-m-d H:m:s', $timestamp);
    $insert="INSERT INTO scores (score, time, contact_id) VALUES (:score, :time , :contact_id)";
    $stmt=$file_db->prepare($insert);
    // on lie les parametres aux variables
    $stmt->bindParam(':score',$score);
    $stmt->bindParam(':time',$time);
    $stmt->bindParam(':contact_id',$contact_id);
    $stmt->execute();
  }

  function insertUser($nom, $prenom, $file_db) {
    $timestamp = time();
    $time = gmdate('Y-m-d H:i:s', $timestamp);
    
    // Insertion dans la table contacts
    $insert_contact = "INSERT INTO contacts (nom, prenom, time) VALUES (:nom, :prenom, :time)";
    $stmt = $file_db->prepare($insert_contact);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':time', $time);
    $stmt->execute();
    
    // Récupération de l'id du dernier contact inséré
    $id = $file_db->lastInsertId();
    
    // Insertion dans la table scores
    $insert_score = "INSERT INTO scores (score, time, contact_id) VALUES (0, :time, :contact_id)";
    $stmt = $file_db->prepare($insert_score);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':contact_id', $id); // Correction : Utilisation de l'id du contact
    $stmt->execute();
  }

  function updateScore($contact_id, $new_score, $file_db) {
    echo "update";
    $timestamp = time();
    $time = gmdate('Y-m-d H:i:s', $timestamp);

    // Vérification si le contact existe
    $check_contact = "SELECT id FROM contacts WHERE id = :contact_id";
    $stmt_check = $file_db->prepare($check_contact);
    $stmt_check->bindParam(':contact_id', $contact_id);
    $stmt_check->execute();

    if ($new_score > getScoreWithUserId($contact_id,$file_db)) {
        // Le contact existe, mise à jour du score
        $update_score = "UPDATE scores SET score = :new_score, time = :time WHERE contact_id = :contact_id";
        $stmt_update = $file_db->prepare($update_score);
        $stmt_update->bindParam(':new_score', $new_score);
        $stmt_update->bindParam(':time', $time);
        $stmt_update->bindParam(':contact_id', $contact_id);
        $stmt_update->execute();
        echo "Votre score a été mis à jour";
    } else {
      echo "Votre score est inférieur à votre score maximal";
    }
  }
} catch(PDOException $e) {
  echo $e->getMessage();
}