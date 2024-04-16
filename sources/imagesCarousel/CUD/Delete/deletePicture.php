<?php 
// encodeRoutage(61)
require('../sources/imagesCarousel/objects/SQLCarousel.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
$mark = [1];
if($controlePostData == $mark) {
    $deletePicture = new SQLCarousel();
    $pictureName = $deletePicture->getpictureName(filter($_POST['id']));
    if($pictureName != false) {
        $pathPictureToDelete = '../sources/pictures/picturesCarousel/'.$pictureName;
        if(file_exists($pathPictureToDelete)) {
            unlink($pathPictureToDelete);
            $deletePicture->deletePicture($idPicture, [['prep'=>':id', 'variable'=>filter($_POST['id'])]]);
            header('location:../index.php?message=Picture effacé&idNav='.$idNav);
        } 
    } else {
        header('location:../index.php?message=Picture doesn\'t exist&idNav='.$idNav);
    }
} else {
    header('location:../index.php?message=Suppression impossible&idNav='.$idNav);
}
