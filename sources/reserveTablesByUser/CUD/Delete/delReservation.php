<?php
//encodeRoutage(51)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForReservedTable.php');

if($checkId->controleInteger($_POST['id']) == 1) {
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser($_POST);
    $findDataBooking = new FindEmail();
    $dataBooking = $findDataBooking->findInfoUserByReservedTable(filter($_POST['id']));
    $delReservation = new SQLAcessReserTables();
    $sendEmail = new SendEmailForReservedTable ($dataBooking[0]['idUser'], $dataBooking[0]['dateReserve'], $dataBooking[0]['idTable']);
    $sendEmail->sendEmailBookingTable(false);
    $delReservation->delReservationByUser($param);
    return header('location:../index.php?message=Réservation effacé correctement&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis d\'annulation&idNav='.$idNav);
}

