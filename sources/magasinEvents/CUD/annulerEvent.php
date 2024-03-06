<?php
require('../sources/magasinEvents/objects/sqlEvents.php');
$annulationEvent= new SQLEvents();
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
$mark = [1];
if($mark == $controlePostData) {
    $annulationEvent->unvalidEvent(filter($_POST['id']));
    return header('location:../index.php?message=Evenement correctement annulé&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Annulation impossible&idNav='.$idNav);
}