<?php
// encodeRoutage(46)
require('../sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
$delInvalidActivity = new SQLAcessReserTables();
if($checkId->controleInteger($_POST['id'])) {
    $delInvalidActivity->delInvalidActivity(filter($_POST['id']));
    return header('location:../index.php?message=Activité Effacer&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur activité introuvable&idNav='.$idNav);
}
