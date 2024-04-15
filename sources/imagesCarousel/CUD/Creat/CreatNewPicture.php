<?php
//  encodeRoutage(60)
require('../functions/functionToken.php');
print_r($_POST);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['orderPicture']));
array_push($controlePostData, sizePost($_POST['legend'], 180));
$mark = [1, 0];
if(($controlePostData == $mark)&&(controlePicture($_FILES, 500000))) {
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['pictureName'] = $namePicture;
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
   if (file_exists('../sources/pictures/picturesCarousel')) {
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesCarousel/'.$namePicture)) {
            $sqlInsert = new InsertRequest();
            $insert = $sqlInsert->requestInsert($_POST, 3, 'shopPicture', 1);
            chmod($f, 0644);
            ActionDB::access($insert, $param, 1);
            return header('location:../index.php?message=Nouvelle image enregistré pour le carousel.');
        } 
    } else {
        return header('location:../index.php?message=Le fichier destination n\'existe pas');
    }
} else {
    return header('location:../index.php?message=Soucis d\'enregistrement');
}
