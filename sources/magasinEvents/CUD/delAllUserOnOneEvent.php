<?php
// encodeRoutage(55)
require('../sources/magasinEvents/objects/sqlEvents.php');
print_r($_POST);
$delAllUser = new SQLEvents ();
if($checkId->controleInteger(filter($_POST['id']))) {
    $delAllUser->delAllUserOnOneEvent(filter($_POST['id']));
    return header('location:../index.php?message=Tous les utilisateurs sont désincrit&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Erreur événement introuvable&idNav='.$idNav);
}