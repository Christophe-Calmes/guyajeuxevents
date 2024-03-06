<?php 
//print_r($_POST);

$update = '';
if($_FILES && controlePicture($_FILES, 75000)) {
    require('../sources/news/objects/SqlAcessNews.php');
    $namePicture = new SQLAcessNews();
    $namePictureToDelete = $namePicture->getPicture (filter($_POST['id']));
    $pathPictureToDelete = '../sources/pictures/picturesNews/'.$namePictureToDelete[0]['picture'];
    if(file_exists($pathPictureToDelete)) {
        unlink($pathPictureToDelete);
    } 
    
    require('../functions/functionToken.php');
    $namePicture = genToken (5).date('Y').filter($_FILES['picture']['name']);
    $_POST['picture'] = $namePicture;
   if (file_exists('../sources/pictures/picturesNews')) {
            if(move_uploaded_file($_FILES['picture']['tmp_name'], $f = '../sources/pictures/picturesNews/'.$namePicture)) {
                chmod($f, 0644);
        }
    }
    $update = "UPDATE `articles` 
    SET `title`= :title,
    `text`= :text,
    `update_date`=CURRENT_TIMESTAMP(),
    `publish`=:publish,
    `picture`=:picture,
    `valid`=:valid 
    WHERE `id`=:id";
} else {
    $update = "UPDATE `articles` 
    SET `title`= :title,
    `text`= :text,
    `update_date`=CURRENT_TIMESTAMP(),
    `publish`=:publish,
    `valid`=:valid 
    WHERE `id`=:id";
}
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, sizePost($_POST['title'], 60));
array_push($controlePostData, sizePost($_POST['text'], 10500));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['valid'], 1));
$mark = [1, 0, 0, 0, 0, 0];
if($controlePostData == $mark) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep($_POST);
    print_r($update);
    echo '<br/>';
    print_r($param);
    ActionDB::access($update, $param, 1);
    header('location:../index.php?message=news modifier&idNav='.$idNav.'&idArticle='.filter($_POST['id']));
} else {
    echo 'Pas Coucou';
}