<?php 
//encodeRoutage(41)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
if(count($_POST) == 2) {
    $controlePostData = array();
    array_push($controlePostData, $checkId->controleInteger($_POST['dayOfWeekW']));
    array_push($controlePostData, $checkId->controleInteger($_POST['closeDay']));
    array_push($controlePostData, borneSelect($_POST['dayOfWeekW'], 6));
    array_push($controlePostData, borneSelect($_POST['closeDay'], 1));
    echo '<br/>';
    print_r($controlePostData);
    $mark = [1,1, 0, 0];
    if($controlePostData == $mark){
        $changeScheldule = new SQLAcessReserTables();
        $changeScheldule->openCloseDayShop(filter($_POST['closeDay']), filter($_POST['dayOfWeekW']));
        return header('location:../index.php?message=Changement effectué&idNav='.$idNav);
    } else {
        return header('location:../index.php?message=Erreur&idNav='.$idNav);
    }
}
if(count($_POST) == 6) {
    // changement d'horraire et open/close
    $controlePostData = array();
    array_push($controlePostData, $checkId->controleInteger($_POST['dayOfWeekW']));
    array_push($controlePostData, $checkId->controleInteger($_POST['closeDay']));
    array_push($controlePostData,sizePost($_POST['openMorning'], 8));
    array_push($controlePostData,sizePost($_POST['closeMorning'], 8));
    array_push($controlePostData,sizePost($_POST['openAfternoon'], 8));
    array_push($controlePostData,sizePost($_POST['closeAfternoon'], 8));
    array_push($controlePostData, borneSelect($_POST['dayOfWeekW'], 6));
    array_push($controlePostData, borneSelect($_POST['closeDay'], 1));
    array_push($controlePostData,timeIntervalPositive ($_POST['openMorning'], $_POST['closeMorning']));
    array_push($controlePostData,timeIntervalPositive ($_POST['openAfternoon'], $_POST['closeAfternoon']));
    array_push($controlePostData,timeIntervalPositive ($_POST['closeMorning'], $_POST['openAfternoon']));
    array_push($controlePostData,timeIntervalPositive ($_POST['openMorning'], $_POST['closeAfternoon']));
    $mark = [1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1];
    if ($controlePostData == $mark) {
        $parametre = new preparation();
        $param = $parametre->creationPrep ($_POST);
        $changeScheldule = new SQLAcessReserTables();
        $changeScheldule->changeSchedulingShop($param);
        return header('location:../index.php?message=Changement effectué&idNav='.$idNav);
    } else {
        return header('location:../index.php?message=Erreur&idNav='.$idNav);
    }
} else {

    return header('location:../index.php?message=Erreur&idNav='.$idNav);
}