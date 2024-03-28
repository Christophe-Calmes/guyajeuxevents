<?php
//encodeRoutage(50)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('../sources/comEmail/objets/FindEmail.php');
require('../sources/comEmail/objets/EmailForReservedTable.php');
$checkDateShedulingShop = new SQLAcessReserTables();
$dateReverseByCustomer = filter($_POST['dateReserve']);
$dateTime = new DateTime(filter($_POST['dateReserve']));
$date = $dateTime->format('Y-m-d');
$dateTime->modify(filter($_POST['endOfReserve']));
$_POST['endOfReserve']=$dateTime->format('Y-m-d\TH:i');
$controlePostData = array();
$mark = [0, 1, 1, 1, 1, 0, 1, 1, 1, 0];
array_push($controlePostData, $checkDateShedulingShop->BookingInProgress($checkId->idUser($_SESSION)));
array_push($controlePostData, $checkId->controleInteger($_POST['numberPeople']));
array_push($controlePostData, $checkId->controleInteger($_POST['idTable']));
array_push($controlePostData, $checkId->controleInteger($_POST['idActivity']));
array_push($controlePostData, $checkId->controleInteger($_POST['idConsommation']));
array_push($controlePostData, sizePost($_POST['comment'], 750));
array_push($controlePostData, $_POST['endOfReserve']>filter($_POST['dateReserve']));
array_push($controlePostData, $checkDateShedulingShop->checkAReserveDate(filter($_POST['dateReserve'])));
array_push($controlePostData, $checkDateShedulingShop->checkAReserveDate(filter($_POST['endOfReserve'])));
array_push($controlePostData,$checkDateShedulingShop->controleDoublonReservation(filter($_POST['idTable']),filter($_POST['dateReserve']), filter($_POST['endOfReserve'])));
if($mark == $controlePostData){
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser ($_POST);
    $checkDateShedulingShop->addReservedTableByUser($param);
    $sendEmail = new SendEmailForReservedTable ($param[7]['variable'], $param[0]['variable'], $param[3]['variable']);
    $sendEmail->sendEmailBookingTable(true);
    return header('location:../index.php?message=Réservation enregistré correctement&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Soucis horraire de réservation&idNav='.$idNav);
}