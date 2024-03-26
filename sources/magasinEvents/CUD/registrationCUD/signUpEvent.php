<?php
// encodeRoutage(38) - Membrer
require('../sources/magasinEvents/objects/sqlEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
$mark = [1];
$registeredUserOnEvent = new SQLEvents();
if($mark == $controlePostData && !$registeredUserOnEvent->userIsRegistredOnEvent ($checkId->idUser($_SESSION), filter($_POST['idEvent']))) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser($_POST);
    $registeredUserOnEvent->signUpEventUser($param);
    return header('location:../index.php?message=Votre inscription est enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'inscription&idNav='.$idNav);
} 
