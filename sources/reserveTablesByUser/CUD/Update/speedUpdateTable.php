<?php
//encodeRoutage(43)
require('../functions/functionToken.php');
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
array_push($controlePostData, $checkId->controleInteger($_POST['max']));
array_push($controlePostData, $checkId->controleInteger($_POST['PositionTable']));
array_push($controlePostData, $checkId->controleInteger($_POST['valid']));
array_push($controlePostData, sizePost($_POST['name'], 30));
$mark = [ 1, 1, 1, 1, 0];
$adminTable = new SQLAcessReserTables();
$delPicture = false;
if (controlePicture($_FILES, 90000)){
    $namePictureOfTable = $adminTable->getPictureOfTable(filter($_POST['id']));
    $pathPictureOfTableToDelete='../sources/pictures/pictureTables/'.$namePictureOfTable;
        if(file_exists($pathPictureOfTableToDelete)) {
            unlink($pathPictureOfTableToDelete);
        } 
    $delPicture = true;
}
if($delPicture && ($mark == $controlePostData) && (controlePicture($_FILES, 90000))) {
        $namePicture = genToken(5).date('Y').filter($_FILES['picture']['name']);
        $_POST['pictureOfTable'] = $namePicture;
        $parametre = new Preparation();
        $param = $parametre->creationPrep ($_POST);
        if (file_exists('../sources/pictures/pictureTables')) {
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/pictureTables/'.$namePicture)) {
                $adminTable->updateTable($param);
                chmod($f, 0644);
                return header('location:../index.php?message=Nouvelle table enregistré&idNav='.$idNav);
            } else {
                return header('location:../index.php?message=Modifier l\'image&idNav='.$idNav);
            }
        }
} else {
    header('location:../index.php?message=Modification de la table impossible&idNav='.$idNav);
}