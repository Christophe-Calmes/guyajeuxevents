<?php
//encodeRoutage(40)
require('../sources/magasinEvents/objects/sqlEvents.php');
print_r($_POST);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idUser']));
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
print_r($controlePostData);
$mark = [1, 1];
if($controlePostData == $mark) {
    $delUserOnEvent = new SQLEvents();
    $delUserOnEvent->delAdminUserEvent(filter($_POST['idEvent']), filter($_POST['idUser']));
    return header('location:../index.php?message=Utilisateur correctement effacé&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis interne&idNav='.$idNav);
}