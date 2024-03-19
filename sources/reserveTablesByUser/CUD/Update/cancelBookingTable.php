<?php 
//encodeRoutage(53)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
if($checkId->controleInteger($_POST['id'])) {
    $cancelBooking = new SQLAcessReserTables();
    $cancelBooking->cancelBookingTableByAdmin(filter($_POST['id']));
    return header('location:../index.php?message=Réservation annulée&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur réservation introuvable&idNav='.$idNav);
}