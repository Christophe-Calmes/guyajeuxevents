<?php
// encodeRoutage(58) - Gestionnaire
require('../sources/magasinEvents/objects/sqlEvents.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
array_push($controlePostData, $checkId->controleInteger($_POST['idUser']));
$mark = [1, 1];
$registeredUserOnEvent = new SQLEvents();
if($mark == $controlePostData && !$registeredUserOnEvent->userIsRegistredOnEvent (filter($_POST['idUser']), filter($_POST['idEvent']))) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $registeredUserOnEvent->signUpEventUser($param);
    $sendEmail = new SendEmailForEvent($param[1]['variable'], $param[0]['variable']);
    $sendEmail->sendEventEmail(true);
    return header('location:../index.php?message=Votre inscription est enregistré.&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Membre déjà inscrit.&idNav='.$idNav);
} 
