<?php
// encodeRoutage(38) - Membrer
require('../sources/magasinEvents/objects/sqlEvents.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
$mark = [1];
$registeredUserOnEvent = new SQLEvents();
$idUser = $checkId->idUser($_SESSION);
if($mark == $controlePostData && !$registeredUserOnEvent->userIsRegistredOnEvent ($idUser, filter($_POST['idEvent']))) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser($_POST);
    $registeredUserOnEvent->signUpEventUser($param);
    $sendEmail = new SendEmailForEvent($idUser, filter($_POST['idEvent']));
    $sendEmail->sendEventEmail(true);
    return header('location:../index.php?message=Votre inscription est enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'inscription&idNav='.$idNav);
} 
