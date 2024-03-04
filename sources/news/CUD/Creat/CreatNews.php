<?php
//encodeRoutage(30)

$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['text'], 800));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
$mark = [1, 0, 0, 0];
print_r(controlePicture($_FILES, 75000));

/*
if($mark == $controlePostData) {
    $parametre = new Preparation();
    $_POST['id_author']= $checkId->idUser($_SESSION);
    $param = $parametre->creationPrep($_POST);
    $sqlInsert = new InsertRequest();
    $insert = $sqlInsert->requestInsert($_POST, count($_POST), 'articles', 1);
    //ActionDB::access($insert, $param, 1);
    //return header('location:../index.php?message=Nouvelle article enregistré');
} else {
    //return header('location:../index.php?message=Soucis d\'enregistrement');
}
*/
