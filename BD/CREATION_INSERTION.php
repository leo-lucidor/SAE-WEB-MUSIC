<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera contacts.sqlite3
  $file_db=new PDO('sqlite:contacts.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

  // on supprime les tables si elles existent
  $file_db->exec("DROP TABLE IF EXISTS quiz");
  $file_db->exec("DROP TABLE IF EXISTS questions");
  $file_db->exec("DROP TABLE IF EXISTS contacts");
  $file_db->exec("DROP TABLE IF EXISTS scores");

  $file_db->exec("CREATE TABLE IF NOT EXISTS quiz (
    id INTEGER PRIMARY KEY,
    nomQuiz TEXT,
    meilleurScore INTEGER,
    tempsMoyen INTEGER,
    nbMaxQuesitons INTEGER
  )");

  $file_db->exec("CREATE TABLE IF NOT EXISTS contacts ( 
    id INTEGER PRIMARY KEY,
    nom TEXT,
    prenom TEXT
  )");

  $file_db->exec("CREATE TABLE IF NOT EXISTS scores (
    id INTEGER PRIMARY KEY,
    score INTEGER,
    time INTEGER,
    contact_id INTEGER,
    quiz_id INTEGER,
    FOREIGN KEY(contact_id) REFERENCES contacts(id),
    FOREIGN KEY(quiz_id) REFERENCES quiz(id)
  )");

  //table question
  $file_db->exec("CREATE TABLE IF NOT EXISTS questions (
    id INTEGER PRIMARY KEY,
    question TEXT,
    reponse INTEGER,
    quiz_id INTEGER,
    FOREIGN KEY(quiz_id) REFERENCES quiz(id)
  )");

  $quiz=array(
    array('nomQuiz' => 'Quiz1',
      'meilleurScore' => 10,
      'tempsMoyen' => 20,
      'nbMaxQuesitons' => 30),
    array('nomQuiz' => 'Quiz2',
      'meilleurScore' => 10,
      'tempsMoyen' => 20,
      'nbMaxQuesitons' => 30),
    array('nomQuiz' => 'Quiz3',
      'meilleurScore' => 10,
      'tempsMoyen' => 20,
      'nbMaxQuesitons' => 30)
  );


  $contacts=array(
    array('nom' => 'Lucidor',
      'prenom' => 'Léo'),
    array('nom' => 'Blandeau',
      'prenom' => 'Erwan'),
    array('nom' => 'Lavenant',
      'prenom' => 'Jordan'),
    array('nom' => 'Pilet',
      'prenom' => 'Colin')
    );

  $scores=array(
    array('score' => 10,
      'time' => 20,
      'contact_id' => 1,
      'quiz_id' => 1),
    array('score' => 20,
      'time' => 30,
      'contact_id' => 2,
      'quiz_id' => 1),
    array('score' => 30,
      'time' => 40,
      'contact_id' => 3,
      'quiz_id' => 1),
  );

  $questions=array(
    array('question' => 'Quelle est la couleur du cheval blanc d\'Henri IV ?',
      'reponse' => 1,
      'quiz_id' => 1),
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
