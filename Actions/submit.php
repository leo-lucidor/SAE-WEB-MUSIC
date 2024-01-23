<?php

    session_start();

    error_reporting(E_ERROR | E_PARSE);

    require_once('Classes\Provider\Dataloader.php');
    require('BD/RECHERCHE_BD.php');
    $json = new Dataloader('.\data\model.json');
    $questions = $json->getData();

    $question_total = 0;	
    $question_correct = 0;
    $score_total = 0;
    $score_correct = 0;

    echo "<h1> Voici la correction à vos réponses " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "</h1><br><br>";

    // Comparaisons entre les réponses de l'utilisateur et les réponses attendues
    foreach ($questions as $q) {
        if ($q['answer'] == $_POST[$q['name']])  {
            $question_correct++;
            $score_correct += $q['score'];
            
            echo "&#10004;&#65039; " .  $q['text'] . "<br>Votre réponse : " . $_POST[$q['name']] . "<br>Réponse correcte : " . $q['answer'] . "<br>";
        } else {
            echo "&#10060 " . $q['text'] . "<br>Votre réponse : " . $_POST[$q['name']] . "<br>Réponse correcte : " . $q['answer'] . "<br>";
        }
        echo "<br>";
        // Actualisation des scores
        $score_total += $q['score'];
        $question_total++;
    }
    // Affichage des scores
    echo "Réponses correctes: " . $question_correct . "/" . $question_total . "<br>";
    echo "Votre score: " . $score_correct . "/" . $score_total . "<br>";

    // Création de la base de données
    date_default_timezone_set('Europe/Paris');
    try{
        // le fichier de BD s'appellera contacts.sqlite3
        $file_db=new PDO('sqlite:contacts.sqlite3');
        $file_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
        updateScore(getUserIdWithName($_SESSION['nom'], $file_db),$score_correct,$file_db);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

