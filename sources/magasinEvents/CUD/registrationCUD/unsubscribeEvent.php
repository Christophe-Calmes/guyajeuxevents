<?php
//encodeRoutage(39)
require('../sources/magasinEvents/objects/sqlEvents.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['idEvent']));
$mark = [1];
if($mark == $controlePostData) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser($_POST);
    print_r($param);
    $registeredUserOnEvent = new SQLEvents();
    $registeredUserOnEvent->unsubscribeUser($param);
    return header('location:../index.php?message=Votre inscription est enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'inscription&idNav='.$idNav);
} 
