<?php 
//encodeRoutage(53)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForReservedTable.php');
if($checkId->controleInteger($_POST['id'])) {
    $findDataBooking = new FindEmail();
    $dataBooking = $findDataBooking->findInfoUserByReservedTable(filter($_POST['id']));
    $delReservation = new SQLAcessReserTables();
    $sendEmail = new SendEmailForReservedTable ($dataBooking[0]['idUser'], $dataBooking[0]['dateReserve'], $dataBooking[0]['idTable']);
    $sendEmail->sendEmailBookingTable(false);
    $cancelBooking = new SQLAcessReserTables();
    $cancelBooking->cancelBookingTableByAdmin(filter($_POST['id']));
    return header('location:../index.php?message=Réservation annulée&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur réservation introuvable&idNav='.$idNav);
}