<?php

require 'src/provider/pdo.php';
$pdo = getPdo();

// require 'src/BDD/Function/databaseInsert.php';
require 'src/BDD/Function/databaseGet.php';

$mailUser = $_SESSION['mail'];
$nomPlaylist = $_POST['nomPlaylist'];

$idUser = get_id_with_email($pdo, $mailUser);


echo $nomPlaylist;
echo $mailUser;
echo $idUser;



insertPlaylist($pdo, $nomPlaylist, $idUser);
header('Location: index.php?action=accueil');