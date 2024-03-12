<?php
// encodeRoutage(42)
require('../functions/functionToken.php');
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['max']));
array_push($controlePostData, $checkId->controleInteger($_POST['PositionTable']));
array_push($controlePostData, sizePost($_POST['name'], 30));
$mark = [ 1, 1, 0];
if(($mark == $controlePostData)&&(controlePicture($_FILES, 90000))){
    $namePicture = genToken(5).date('Y').filter($_FILES['picture']['name']);
    $_POST['pictureOfTable'] = $namePicture;
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);

    if (file_exists('../sources/pictures/pictureTables')) {
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/pictureTables/'.$namePicture)) {
            $insertNewTable = new SQLAcessReserTables();
            $insertNewTable->insertTable($param);
            chmod($f, 0644);
            return header('location:../index.php?message=Nouvelle table enregistré&idNav='.$idNav);
        } else {
            return header('location:../index.php?message=Directory pictureTables missing&idNav='.$idNav);
        }
    }

} else {
    return header('location:../index.php?message=Erreurs&idNav='.$idNav);
}