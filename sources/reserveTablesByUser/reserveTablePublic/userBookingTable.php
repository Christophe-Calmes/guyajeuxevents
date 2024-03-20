<?php
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$checkIdUser = new Controles();
$idUser = $checkIdUser->idUser($_SESSION);
$bookingTableByUser = new TemplateReserveTables();
$numberBookingTables = $bookingTableByUser->numberBookingInProgress($idUser);
if($numberBookingTables == 0) {
    echo '<h3 class="subTitleSite">Aucune tables réservées </h3>';
} else if($numberBookingTables == 1) {
    echo '<h3 class="subTitleSite">Votre table réservée </h3>';
} else {
    echo '<h3 class="subTitleSite">Vos '.$numberBookingTables.' tables réservées </h3>';
}

$bookingTableByUser->displayAndAdminBookingTableByUser($idUser, $idNav);
