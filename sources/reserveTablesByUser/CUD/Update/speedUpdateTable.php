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
if ((controlePicture($_FILES, 90000)&&(count($_POST)==6))){
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
        if (file_exists('../sources/pictures/pictureTables')&&(count($_POST)==6)) {
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/pictureTables/'.$namePicture)) {
                $adminTable->updateTable($param);
                chmod($f, 0644);
                return header('location:../index.php?message=Table et image modifié&idNav='.$idNav);
            } else {
                return header('location:../index.php?message=Erreur&idNav='.$idNav);
            }
        }
} else if(count($_POST) == 5) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
    $adminTable->updateJusteTableNoPicture($param);
    return header('location:../index.php?message=Table modifié&idNav='.$idNav);
    
} else {
    return header('location:../index.php?message=Modification de la table impossible&idNav='.$idNav);
}
