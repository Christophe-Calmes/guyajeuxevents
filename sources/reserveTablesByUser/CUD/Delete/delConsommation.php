<?php
//encodeRoutage(48)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$delInvalidActivity = new SQLAcessReserTables();
if($checkId->controleInteger($_POST['id'])) {
    $delInvalidActivity->delInvalidConsommation(filter($_POST['id']));
    return header('location:../index.php?message=Consommation Effacer&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur consommation introuvable&idNav='.$idNav);
}
