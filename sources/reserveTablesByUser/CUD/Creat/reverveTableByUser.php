<?php
//encodeRoutage(44)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
if(sizePost($_POST['name'], 30) == 0) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
    $addNewActivity = new SQLAcessReserTables();
    $addNewActivity->insertNewActivity($param);
    return header('location:../index.php?message=Nouvelle activitée enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Nom de l\'activité trop longue&idNav='.$idNav);
}