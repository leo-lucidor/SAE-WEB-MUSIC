<?php

require 'BDD/Function/databaseGet.php';
require 'BDD/Function/databaseUpdate.php';
require 'src/provider/pdo.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idArtiste = $_REQUEST['idArtiste'];

update_favoris_artiste($pdo, $idUser, $idArtiste);
header('Location: index.php?action=artiste&id='.$idArtiste);