<?php

$pdo = getPdo();
require 'src/BDD/Function/databaseUpdate.php';


$titre = $_POST['titre'];
$dateSortie = $_POST['dateSortie'];
$genre = $_POST['genre'];
$pochette = $_POST['pochette'];
$nomArtiste = $_POST['nomArtiste'];
$nomParent = $_POST['nomParent'];

