<?php

date_default_timezone_set('Europe/Paris');
try{
  // le fichier de BD s'appellera contacts.sqlite3
  $file_db=new PDO('sqlite:contacts.sqlite3');
  $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
  
  // on va tester le contenu de la table contacts
  $result=$file_db->query('SELECT * from contacts');
  foreach ($result as $m){
    echo "<br/>\n".$m['prenom'].' '.$m['nom'].' '.date('Y-m-d H:i:s',$m['time']);
  }

  $result=$file_db->query('SELECT * from scores');
  foreach ($result as $m){
    echo "<br/>\n".$m['score'].' '.date('Y-m-d H:i:s',$m['time']).' '.$m['contact_id'];
  }

  // on ferme la connexion
  $file_db=null;



}catch(PDOException $ex){
    echo $ex->getMessage();
}
