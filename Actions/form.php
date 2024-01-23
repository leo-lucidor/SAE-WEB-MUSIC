<?php 

    declare(strict_types=1);

    class Form {
        private $data;

        public function __construct($data) {
            $this->data = $data;
        }

        // Fonction permettant d'interpréteer les objets inputs créée dans les classes 
        // et de les afficher dans le navigateur en html
        public function buildForm() {
            echo "<form action='Actions/submit.php' method='post'><ol>";
            foreach($this->data as $q) {
                echo "<li>";
                echo "<label for=". $q['obj']->getId() ."> " . $q['text'] . "</label><br>";
                if ($q['type'] == "radio" || $q['type'] == "checkbox") {
                    foreach($q['choices'] as $c) {
                        echo $c->render();
                        echo "<label>" . $c->getValue() . "</label><br>";
                    }
                } else {
                    echo $q['obj']->render();
                }
                echo "</li>";
            }
            echo "</ol><input type='submit' value='envoyer'></form>";
        }
    }
?>