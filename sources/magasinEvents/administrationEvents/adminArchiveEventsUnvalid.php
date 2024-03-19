<?php
require('functions/functionPagination.php');
require ('sources/magasinEvents/objects/TemplateEvents.php');
$events = new TemplateEvents();
echo '<section><h1 class="subTitleSite">Administrer un événement archiver non valide</h1>';
if(isset($_GET['page'])&&(!empty($_GET['page']))){
    $currentPage = filter($_GET['page']);
} else {
    $currentPage = 1;
}
$parPage = 9;
$nbrEvents = $events->countEvent (1, 0);
$nbrPages = ceil($nbrEvents/$parPage);
$firstPage = ($currentPage * $parPage)-$parPage;
$events->adminEvents($firstPage, $parPage, 1, 0, $idNav, 36);
 
for ($page=1; $page <= $nbrPages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
echo '</section>';