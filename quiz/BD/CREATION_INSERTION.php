<?php

d<?php

try {
    $pdo = new PDO('sqlite:your_database_name.sqlite3');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Table Artiste
    $pdo->exec("CREATE TABLE IF NOT EXISTS Artiste (
        ID_Artiste INTEGER PRIMARY KEY,
        Nom TEXT,
        Bio TEXT,
        Date_de_naissance DATE
    )");

    // Table Album
    $pdo->exec("CREATE TABLE IF NOT EXISTS Album (
        ID_Album INTEGER PRIMARY KEY,
        Titre TEXT,
        Date_de_sortie DATE,
        Genre TEXT, -- ou ID_Genre INTEGER si la table Genre est utilisée
        Pochette TEXT,
        ID_Artiste INTEGER,
        FOREIGN KEY (ID_Artiste) REFERENCES Artiste(ID_Artiste)
    )");

    // Table Utilisateur
    $pdo->exec("CREATE TABLE IF NOT EXISTS Utilisateur (
        ID_Utilisateur INTEGER PRIMARY KEY,
        Nom_utilisateur TEXT,
        Mot_de_passe TEXT,
        Email TEXT
    )");

    // Table Playlist
    $pdo->exec("CREATE TABLE IF NOT EXISTS Playlist (
        ID_Playlist INTEGER PRIMARY KEY,
        Nom TEXT,
        ID_Utilisateur INTEGER,
        FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur)
    )");

    // Table Genre
    $pdo->exec("CREATE TABLE IF NOT EXISTS Genre (
        ID_Genre INTEGER PRIMARY KEY,
        Nom_du_genre TEXT
    )");

    // Table Note
    $pdo->exec("CREATE TABLE IF NOT EXISTS Note (
        ID_Note INTEGER PRIMARY KEY,
        Valeur INTEGER,
        ID_Utilisateur INTEGER,
        ID_Album INTEGER,
        FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID_Utilisateur),
        FOREIGN KEY (ID_Album) REFERENCES Album(ID_Album)
    )");

    echo "Tables créées avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}



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
