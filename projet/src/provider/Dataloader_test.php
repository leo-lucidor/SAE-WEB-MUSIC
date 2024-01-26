<?php

require 'Dataloader.php';
require 'Dataloader_function.php';

$dataloader = new Dataloader('database.sqlite3', 'extrait.yml');
$pdo = $dataloader->getPdo();
deleteAllInBDD($pdo);


?>