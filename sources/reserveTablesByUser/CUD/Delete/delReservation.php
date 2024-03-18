<?php
//encodeRoutage(51)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');

if($checkId->controleInteger($_POST['numberPeople']) == 1) {
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser($_POST);
    $delReservation = new SQLAcessReserTables();
    $delReservation->delReservationByUser($param);
    return header('location:../index.php?message=Réservation effacé correctement&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'annulation&idNav='.$idNav);
}

