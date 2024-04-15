<?php
require('sources/imagesCarousel/objects/DisplayCarousel.php');
require ('functions/functionPagination.php');
require ('functions/functionDateTime.php');
$pictureManaging = new DisplayCarousel ();
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
$parPage = 3;
$nbrPicture = $pictureManaging->nbrValidPicture ();
$premier = ($currentPage * $parPage) - $parPage;

$pages = ceil($nbrPicture/$parPage);
for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }