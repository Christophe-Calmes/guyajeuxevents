<h3 class="subTitleSite">Vos tables réservées</h3>
<?php
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$checkIdUser = new Controles();
$idUser = $checkIdUser->idUser($_SESSION);
$bookingTableByUser = new TemplateReserveTables();
$bookingTableByUser->displayAndAdminBookingTableByUser($idUser, $idNav);
