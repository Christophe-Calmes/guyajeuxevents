<?php
//encodeRoutage(59)
require ('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForReservedTable.php');
print_r($_POST);
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
array_push($controlePostData, $checkId->controleInteger($_POST['idUser']));
$mark = [1, 1];
if($controlePostData == $mark) {
 
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
    $updateBooking = new SQLAcessReserTables();
    $updateBooking->affectedTableForUser($param);
    $findDataBooking = new FindEmail();
    $dataBooking = $findDataBooking->findInfoUserByReservedTable(filter($_POST['id']));
    $sendEmail = new SendEmailForReservedTable ($dataBooking[0]['idUser'], $dataBooking[0]['dateReserve'], $dataBooking[0]['idTable']);
    $sendEmail->sendEmailBookingTable(true);
    return header('location:../index.php?message=Changement de propriétaire ok&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Changement de propriétaire impossible&idNav='.$idNav);
}
