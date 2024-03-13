<?php 
//encodeRoutage(47)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
if(sizePost($_POST['name'], 30) == 0) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
    $addNewConsommation= new SQLAcessReserTables();
    $addNewConsommation->insertNewConsommation($param);
    return header('location:../index.php?message=Nouvelle consommation enregistré&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Nom de la consommation trop longue&idNav='.$idNav);
}