<?php
//  encodeRoutage(60)
require('../functions/functionToken.php');
print_r($_POST);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['orderPicture']));
array_push($controlePostData, sizePost($_POST['legend'], 180));
$mark = [1, 0];
if(($controlePostData == $mark)&&(controlePicture($_FILES, 500000))) {
    echo '<br/>';
    print_r($_FILES);
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['pictureName'] = $namePicture;
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
    echo '<br/>';
    print_r($param);
} else {
    return header('location:../index.php?message=Soucis d\'enregistrement');
}