<?php 
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');

$idTable = filter($_GET['idTable']);
$table = new TemplateReserveTables();
$dataBookingTable = $table->getReservedDateOfTable($idTable);
$tableName = $table->nameOfTable($idTable);
if($dataBookingTable != []) {
    echo '<h3 class="">Table '.$tableName .'</h3>';
    echo '<ul>';

    foreach($dataBookingTable as $value) {
       echo '<li>Réserver le '.formatDateHeureFr($value['dateReserve']).' jusqu\'à '.justHeureFr($value['endOfReserve']).'.</li>';
    }
    echo '</ul>';
} else {
    echo '<h3 class="">Table '.$tableName.'</h3>';
    echo '<article>Aucune réservation pour le moment.</article>';
}



echo '<a href="'.findTargetRoute(122).'">Retour</a>';