<h2 class="subTitleSite">Les horraires de Guyajeux Salon de Provence</h2>
<?php
require ('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$shopHour = new TemplateReserveTables();
$shopHour->displayScheduleShop ($idNav);
