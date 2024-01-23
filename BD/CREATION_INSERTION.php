<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera contacts.sqlite3
  $file_db=new PDO('sqlite:contacts.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  $file_db->exec("CREATE TABLE IF NOT EXISTS contacts ( 
    id INTEGER PRIMARY KEY,
    nom TEXT,
    prenom TEXT,
    time INTEGER)");


  $file_db->exec("CREATE TABLE IF NOT EXISTS scores (
    id INTEGER PRIMARY KEY,
    score INTEGER,
    time INTEGER,
    contact_id INTEGER,
    FOREIGN KEY(contact_id) REFERENCES contacts(id))");


  $contacts=array(
    array('nom' => 'LAVENANT',
      'prenom' => 'Jordan',
      'time' =>  strtotime('17-01-2024')),
    array('nom' => 'LUCIDOR',
      'prenom' => 'Léo',
      'time' =>  strtotime('17-01-2024')),
    array('nom' => 'DALAIGRE',
      'prenom' => 'Cristophe',
      'time' =>  strtotime('17-01-2024'))
    );

  $scores=array(
    array('score' => 10,
      'time' =>  strtotime('17-01-2024'),
      'contact_id' => 1),
    array('score' => 20,
      'time' =>  strtotime('17-01-2024'),
      'contact_id' => 2),
    array('score' => 30,
      'time' =>  strtotime('17-01-2024'),
      'contact_id' => 3)
    );
  
  $insert="INSERT INTO contacts (nom, prenom, time) VALUES (:nom, :prenom , :time)";
  $stmt=$file_db->prepare($insert);
  // on lie les parametres aux variables
  $stmt->bindParam(':nom',$nom);
  $stmt->bindParam(':prenom',$prenom);
  $stmt->bindParam(':time',$time);

  $insert="INSERT INTO scores (score, time, contact_id) VALUES (:score, :time , :contact_id)";
  $stmt=$file_db->prepare($insert);
  // on lie les parametres aux variables
  $stmt->bindParam(':score',$score);
  $stmt->bindParam(':time',$time);
  $stmt->bindParam(':contact_id',$contact_id);

  foreach ($contacts as $c){
    $nom=$c['nom'];
    $prenom=$c['prenom'];
    $time=$c['time'];
    $stmt->execute();
  }
  
  foreach ($scores as $s){
    $score=$s['score'];
    $time=$s['time'];
    $contact_id=$s['contact_id'];
    $stmt->execute();
  }

  echo "Insertion en base reussie !";

  // on ferme la connexion
  $file_db=null;

}catch(PDOException $ex){
    echo $ex->getMessage();
}
