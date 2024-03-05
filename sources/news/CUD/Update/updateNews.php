<?php
//encodeRoutage(31)
$updateNews = "UPDATE `articles` 
SET `update_date`=CURRENT_TIMESTAMP(),`publish`=:publish,`valid`=:valid
WHERE `id`=:id";
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['publish']));
array_push($controlePostData, $checkId->controleInteger($_POST['valid']));
array_push($controlePostData, borneSelect($_POST['publish'], 1));
array_push($controlePostData, borneSelect($_POST['valid'], 1));
$mark = [1, 1, 0, 0];
print_r($controlePostData);
echo '<br/>';
print_r($mark);
if($mark == $controlePostData) {
    $parametre = new Preparation();
    $param = $parametre->creationPrep($_POST);
    ActionDB::access($updateNews, $param, 1);
    header('location:../index.php?message=news modifier&idNav='.$idNav);

} else {
    header('location:../index.php?message=Erreur lors de la modification&idNav='.$idNav);
}