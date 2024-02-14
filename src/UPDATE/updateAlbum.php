<?php

$pdo = getPdo();

require 'src/BDD/Function/databaseGet.php';
require 'src/BDD/Function/databaseUpdate.php';

$idAlbum = $_REQUEST['idAlbum'];
$titre = $_REQUEST['titre'];
$dateSortie = $_REQUEST['dateSortie'];
$genre = $_REQUEST['genre'];
$pochette = $_REQUEST['pochette'];
$idArtiste = $_REQUEST['idArtiste'];
$idParent = $_REQUEST['idParent'];

print_r($idAlbum);
print_r($titre);
print_r($dateSortie);
print_r($genre);
print_r($pochette);
print_r($idArtiste);
print_r($idParent);

if (empty($titre) || empty($dateSortie) || empty($genre) || empty($pochette) || empty($idArtiste) || empty($idParent)) {
    header('Location: index.php?action=editerAlbum&idAlbum='.$idAlbum.'&erreur=Veuillez remplir tous les champs');
    exit();
}

update_album($pdo, $titre, $dateSortie, $genre, $pochette, $idArtiste, $idParent, $idAlbum);
header('Location: index.php?action=editerAlbum&idAlbum='.$idAlbum);



