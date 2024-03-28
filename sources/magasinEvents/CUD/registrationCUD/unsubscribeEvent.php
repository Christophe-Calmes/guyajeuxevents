<?php
//encodeRoutage(39)
require('../sources/magasinEvents/objects/sqlEvents.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
$mark = [1];
if($mark == $controlePostData) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser($_POST);
    $registeredUserOnEvent = new SQLEvents();
    $registeredUserOnEvent->unsubscribeUser($param);
    $sendEmail = new SendEmailForEvent($param[1]['variable'], $param[0]['variable']);
    $sendEmail->sendEventEmail(false);
    return header('location:../index.php?message=Votre inscription est enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'inscription&idNav='.$idNav);
} 
