<?php
require('functions/functionPagination.php');
require ('sources/news/objects/TemplatesArticles.php');
echo '<section>';
if(isset($_GET['page'])&&(!empty($_GET['page']))){
    $currentPage = filter($_GET['page']);
} else {
    $currentPage = 1;
}
$parPage = 10;
$requetNombreNews = "SELECT COUNT(`id`) AS `numbreOfNews` FROM `articles`;";
$nbrNews = ActionDB::select($requetNombreNews, [], 1);
$nbrNews = $nbrNews[0]['numbreOfNews'];
$nbrPages = ceil($nbrNews/$parPage);
$firstPage = ($currentPage * $parPage)-$parPage;
$selectCurrentNewsForOneCurrentPage = "SELECT  
    `id`, `id_author`,`prenom`, `nom`, `title`, `text`, `creat_date`, `update_date`, `publish`, `picture`, `valid` 
    FROM `guyaEvents`.`articles` 
    INNER JOIN `guyagraines`.`users` ON `articles`.`id_author` = `guyagraines`.`users`.`idUser`
    ORDER BY `creat_date` DESC
    LIMIT {$firstPage}, {$parPage}";
$articleOfPage = ActionDB::select($selectCurrentNewsForOneCurrentPage, [], 1);
$displayNews = new TemplateArticle();
$displayNews->displayTableAdminNews($articleOfPage, $idNav);

for ($page=1; $page <= $nbrPages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
echo '</section>';