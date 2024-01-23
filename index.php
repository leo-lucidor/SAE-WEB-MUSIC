<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quizz</title>
    </head>
    <body>
        <?php

            // Importation des outils d'importation de données et de classes
            require_once('Classes/Provider/Dataloader.php');
            require 'Classes/autoloader.php'; 

            Autoloader::register(); 

            use Form\Type\Text;
            use Form\Type\Checkbox;
            use Form\Type\Radio;

            // Importation des données
            $json = new Dataloader('data/model.json');
            $data = $json->getData();

            // Création de la base de données
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
            } catch(PDOException $e) {
                echo $e->getMessage();
            }


            // Création d'objets Inputs à partir des questions des données importées
            $data_objects = array();
            foreach($data as $q) {
                $className = "Form\\Type\\" . ucfirst($q['type']);
                if ($q['type'] == "radio" || $q['type'] == "checkbox") {
                    $choices_object = array();
                    $choices = $q['choices'];
                    foreach($choices as $c) {
                        array_push($choices_object,new $className($q['name'], $q['required'] ?? false, $c['value'] ?? '', $q['id'] ?? ''));
                    }
                    array_push($data_objects,array("obj" => new $className($q['name'], $q['required'] ?? false, $q['value'] ?? '', $q['id'] ?? ''), "type" => $q['type'], "text" => $q['text'], "choices" => $choices_object));
                } else {
                    array_push($data_objects,array("obj" => new $className($q['name'], $q['required'] ?? false, $q['value'] ?? '', $q['id'] ?? ''), "type" => $q['type'], "text" => $q['text'], "answer" => $q['answer'] ?? ''));
                }
            }

            $question_total = 0;
            $question_correct = 0;
            $score_total = 0;
            $score_correct = 0;
            
            // Redirections en fonction de l'action
            // Interface initial de login
            session_start();
            if ($_REQUEST['action'] == '') {
                require 'Actions/login.php';
            }
            // Interface d'affichage du formulaire (quiz)
            else if ($_REQUEST['action'] == 'index') {
                require('BD/RECHERCHE_BD.php');
                $user = getUserWithName($_POST['nom'],$file_db);
                // Si l'utilisateur existe déjà dans la base de données
                if ($user == null) {
                    insertUser($_POST['nom'],$_POST['prenom'],$file_db);
                    echo "Utilisateur créé";
                }  
                // Si l'utilisateur n'existe pas dans la base de données
                else {
                    echo "Utilisateur déjà existant";
                }
                $_SESSION['nom'] = $_POST['nom'];
                $_SESSION['prenom'] = $_POST['prenom'];
                $_SESSION['id'] = getUserIdWithName("".$_POST['nom']."",$file_db);
                echo "<h1>Bonjour ".$_POST['prenom']." ".$_POST['nom']."</h1><br>";
                echo "Votre score maximal : ".getScoreWithUserId(getUserIdWithName("".$_POST['nom']."",$file_db),$file_db);
                // Affichage du formulaire
                require 'Actions/form.php';
                $form = new Form($data_objects);
                $form->buildForm();
            }   
            // Interface d'affichage des résultats
            else {  
                require 'Actions/submit.php';  
            }
        ?>
    </body>
</html>