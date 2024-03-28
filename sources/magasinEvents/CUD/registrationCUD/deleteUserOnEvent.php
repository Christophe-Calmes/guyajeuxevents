<?php
//encodeRoutage(40)
require('../sources/magasinEvents/objects/sqlEvents.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idUser']));
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
$mark = [1, 1];
if($controlePostData == $mark) {
    $delUserOnEvent = new SQLEvents();
    $delUserOnEvent->delAdminUserEvent(filter($_POST['idEvent']), filter($_POST['idUser']));
    $sendEmail = new SendEmailForEvent(filter($_POST['idUser']), filter($_POST['idEvent']));
    $sendEmail->sendEventEmail(false);
    return header('location:../index.php?message=Utilisateur correctement effacé&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis interne&idNav='.$idNav);
}