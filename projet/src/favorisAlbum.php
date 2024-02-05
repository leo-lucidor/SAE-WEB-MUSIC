<?php

require 'BDD/Function/databaseGet.php';
require 'BDD/Function/databaseUpdate.php';
require 'src/provider/pdo.php';
$pdo = getPdo();

$mailUser = $_SESSION['mail'];
$idUser = get_id_with_email($pdo, $mailUser);
$idAlbum = $_REQUEST['idAlbum'];

update_favoris_album($pdo, $idUser, $idAlbum);
header('Location: index.php?action=album&id='.$idAlbum);