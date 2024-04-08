<?php
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$tables = new TemplateReserveTables();
$tables->archiveReserveOfTable();
echo '<section class="flex-rows">';
    echo '<article>';
        $tables->displayTableForUser ($idNav, 50, 125);
    echo '</article>';
    echo '<aside class="hoursOfShopping"><h3 class="subTitleSite">Les horaires de guyajeux</h3>';
        $tables->schedulingShopping ();
    echo '</aside>';
echo '<section>';
