<?php
// encodeRoutage(62)
require ('../sources/imagesCarousel/objects/SQLCarousel.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
array_push($controlePostData, $checkId->controleInteger($_POST['orderPicture']));
array_push($controlePostData, sizePost($_POST['legend'], 180));
$mark = [1, 1, 0];
if($controlePostData == $mark) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $updatePicture = new SQLCarousel ();
    $updatePicture->updatePicture ($param);
    header('location:../index.php?message=Image modifié&idNav='.$idNav);
} else {
    header('location:../index.php?message=Modification de l\'image impossible&idNav='.$idNav);
}