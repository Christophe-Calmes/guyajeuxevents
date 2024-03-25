<?php
//encodeRoutage(37)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
//print_r($_POST);
$idEvent = filter($_POST['id']);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, $checkId->controleInteger($_POST['numberMax']));
array_push($controlePostData, $checkId->controleInteger($_POST['contribution']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['description'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['numberMax'], 25));
array_push($controlePostData, borneSelect($_POST['contribution'], 50));
array_push($controlePostData, filter($_POST['dateEvent'])<filter($_POST['dateEndEvent']));
$mark = [1,1,1,0,0,0,0,0,1];
if($controlePostData == $mark) {
    $idTable = array();
$idUser = $checkId->idUser($_SESSION);
$_POST['endOfReserve']=filter($_POST['dateEndEvent']);
foreach ($_POST as $key => $value) {
    if(str_contains($key, 'idTable')) {
        array_push($idTable, ['idTable'=>substr($key, 7), 'start'=>filter($_POST['dateEvent']), 'end'=>$_POST['endOfReserve']]);
    }
}
foreach($idTable as $value) {
    $checkDateShedulingShop = new SQLAcessReserTables();
    $checkDateShedulingShop->delReservedTableInEventCase ($value['start'], $value['end'], $value['idTable']);
    $checkDateShedulingShop->deleteTableEvent ($idEvent);
    // sendEmail
    $param = [['prep'=>':idUser', 'variable'=>$idUser],
            ['prep'=>':idTable', 'variable'=>$value['idTable']],
            ['prep'=>':numberPeople', 'variable'=>$checkDateShedulingShop->numberOfChairOfOneTable($value['idTable']) ],
            ['prep'=>':comment', 'variable'=>filter($_POST['title'])],
            ['prep'=>':dateReserve', 'variable'=>$value['start']],
            ['prep'=>':endOfReserve', 'variable'=>$value['end']],
            ['prep'=>':idActivity', 'variable'=>filter($_POST['idActivity'])],
            ['prep'=>':idConsommation', 'variable'=>filter($_POST['idConsommation'])],];
        $checkDateShedulingShop->addReservedTableByUser($param);
        unset($_POST['idTable'.$value['idTable']]);
}
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
    `idAuthor`=:idAuthor,
    `dateEvent`=:dateEvent,
    `dateEndEvent` = :dateEndEvent,
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
    `idAuthor`=:idAuthor,
    `dateEvent`=:dateEvent,
    `dateEndEvent` = :dateEndEvent,
    `title`=:title,
    `description`=:description,
    `numberMax`=:numberMax,
    `contribution`=:contribution,
    `publish`=:publish,
    `archive`=:archive,
    `valid`=:valid
    WHERE `id`=:id";
}
    unset($_POST['idActivity']);
    unset($_POST['idConsommation']);
    unset($_POST['endOfReserve']);
    $_POST['idAuthor'] = $idUser;
    $parametre = new Preparation();
    $param = $parametre->creationPrep($_POST);
    print_r($param);
    echo '<br/>';
    print_r($update);
    ActionDB::access($update, $param, 1);
    foreach($idTable as $value) {
        // Affecter les réservations à l'ID de l'événement.
        $param = [['prep'=>':idUser', 'variable'=>$idUser],
        ['prep'=>':idTable', 'variable'=>$value['idTable']],
        ['prep'=>':dateReserve', 'variable'=>$value['start']],
        ['prep'=>':endOfReserve', 'variable'=>$value['end']],
        ['prep'=>':idEvent', 'variable'=>$idEvent]];
        $checkDateShedulingShop->affectedIdEvent($param);
    }
    header('location:../index.php?message=Evénement modifié&idNav='.$idNav.'&idEvent='.filter($_POST['id']));
} else {
   header('location:../index.php?message=Evénement non modifié&idNav='.$idNav.'&idEvent='.filter($_POST['id']));
}