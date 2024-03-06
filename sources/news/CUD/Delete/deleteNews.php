<?php
//encodeRoutage(32)
require('../sources/news/objects/SqlAcessNews.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
$mark = [1];
if($controlePostData == $mark) {
    $namePicture = new SQLAcessNews();
    $namePictureToDelete = $namePicture->getPicture (filter($_POST['id']));
    $pathPictureToDelete = '../sources/pictures/picturesNews/'.$namePictureToDelete[0]['picture'];
    $namePicture->delArticle(filter($_POST['id']));
    if(file_exists($pathPictureToDelete)) {
        unlink($pathPictureToDelete);
    } 
    
   header('location:../'.findTargetRoute(104));
} else {
    header('location:../index.php?message=Suppression impossible&idNav='.$idNav);
}




