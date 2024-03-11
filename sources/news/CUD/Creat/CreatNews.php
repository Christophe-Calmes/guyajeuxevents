<?php
//encodeRoutage(30)
require('../functions/functionToken.php');

$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['text'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
$mark = [1, 0, 0, 0];
if($mark == $controlePostData && controlePicture($_FILES, 75000)) {
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['picture'] = $namePicture;
    $parametre = new Preparation();
    $_POST['id_author']= $checkId->idUser($_SESSION);
    $param = $parametre->creationPrep($_POST);
    $sqlInsert = new InsertRequest();
    $insert = $sqlInsert->requestInsert($_POST, 3, 'articles', 1);
    if (file_exists('../sources/pictures/picturesNews')) {
    if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesNews/'.$namePicture)) {
        ActionDB::access($insert, $param, 1);
        chmod($f, 0644);
        return header('location:../index.php?message=Nouvel article enregistré');
    } 
} else {
    return header('location:../index.php?message=Le fichier destination n\'existe pas');
}
    
} else {
    return header('location:../index.php?message=Soucis d\'enregistrement');
}

