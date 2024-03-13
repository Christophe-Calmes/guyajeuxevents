<?php 
// encodeRoutage(49)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$verifyActivityValid = new SQLAcessReserTables();
if($checkId->controleInteger($_POST['id'])) {
    $verifyActivityValid->inverseConsommation(filter($_POST['id']));
    return header('location:../index.php?message=Activité modifiée&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur activité introuvable&idNav='.$idNav);
}

