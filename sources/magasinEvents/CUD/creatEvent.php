<?php 
//encodeRoutage(34)
require('../functions/functionToken.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, $checkId->controleInteger($_POST['numberMax']));
array_push($controlePostData, $checkId->controleInteger($_POST['contribution']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['description'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['numberMax'], 25));
array_push($controlePostData, borneSelect($_POST['contribution'], 50));
$mark = [1,1,1,0,0,0,0,0];
if($mark == $controlePostData) {
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['picture'] = $namePicture;
    $parametre = new Preparation();
    $_POST['idAuthor']= $checkId->idUser($_SESSION);
    $param = $parametre->creationPrep($_POST);
    $sqlInsert = new InsertRequest();
    $insert = $sqlInsert->requestInsert($_POST, 5, 'internalEvents', 1);
  
    print_r($insert);
    print_r($_POST);
   if (file_exists('../sources/pictures/picturesEvents')) {
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesEvents/'.$namePicture)) {
            chmod($f, 0644);
            ActionDB::access($insert, $param, 1);
            return header('location:../index.php?message=Nouvelle article enregistré');
        } 
    } else {
        return header('location:../index.php?message=Le fichier destination n\'existe pas');
    }
    
} else {
    return header('location:../index.php?message=Soucis d\'enregistrement');
}
