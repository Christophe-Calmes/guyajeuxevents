<h3 class="subTitleSite">Réservation annulée</h3>
<?php
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
require ('functions/functionPagination.php');
$valid = 0;
$dashboardTables = new TemplateReserveTables();
//$dashboardTables->archiveReserveOfTable();
//$dashboardTables->trashArchiveOfBooking();
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
  $parPage = 9;
  $nbrTables = $dashboardTables->getNumberOfReservationsTables($valid);
  $pages = ceil($nbrTables/$parPage);
  $premier = ($currentPage * $parPage) - $parPage;
  $dashboardTables->displayReservationTablesAdmin($premier, $parPage, $idNav, $valid);

 for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }