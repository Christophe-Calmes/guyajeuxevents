<?php
//encodeRoutage(37)
$update = '';
if($_FILES && controlePicture($_FILES, 75000)) {
    require('../sources/magasinEvents/objects/sqlEvents.php');
    $pictureData = new SQLEvents();
    $namePicture = $pictureData->getNamePictureEvent(filter($_POST['id']));
    $pathPictureToDelete ='../sources/pictures/picturesEvents/'.$namePicture;
    if(file_exists($pathPictureToDelete)) {
        unlink($pathPictureToDelete);
    } 
    require('../functions/functionToken.php');
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['picture'] = $namePicture;
   if (file_exists('../sources/pictures/picturesEvents')) {
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesEvents/'.$namePicture)) {
                chmod($f, 0644);
        }
    }
    $update = "UPDATE `internalEvents` 
    SET `dateUpdate`=CURRENT_TIMESTAMP(),
    `dateEvent`=:dateEvent,
    `title`=:title,
    `description`=:description,
    `picture`=:picture,
    `numberMax`=:numberMax,
    `contribution`=:contribution,
    `publish`=:publish,
    `archive`=:archive,
    `valid`=:valid
    WHERE `id`=:id";
} else {
    $update = "UPDATE `internalEvents` 
    SET `dateUpdate`=CURRENT_TIMESTAMP(),
    `dateEvent`=:dateEvent,
    `title`=:title,
    `description`=:description,
    `numberMax`=:numberMax,
    `contribution`=:contribution,
    `publish`=:publish,
    `archive`=:archive,
    `valid`=:valid
    WHERE `id`=:id";
}
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, $checkId->controleInteger($_POST['numberMax']));
array_push($controlePostData, $checkId->controleInteger($_POST['contribution']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['description'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['valid'], 1));
array_push($controlePostData, borneSelect($_POST['archive'], 1));
array_push($controlePostData, borneSelect($_POST['numberMax'], 25));
array_push($controlePostData, borneSelect($_POST['contribution'], 50));
$mark = [1,1,1,0,0,0,0,0,0,0];
if($controlePostData == $mark) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep($_POST);
    print_r($param);
    echo '<br/>';
    print_r($update);
    ActionDB::access($update, $param, 1);
    header('location:../index.php?message=Evénement modifié&idNav='.$idNav.'&idEvent='.filter($_POST['id']));
} else {
    header('location:../index.php?message=Evénement non modifié&idNav='.$idNav.'&idEvent='.filter($_POST['id']));
}