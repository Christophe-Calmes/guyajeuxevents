<?php
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$tables = new TemplateReserveTables();
echo '<section class="flex-rows">';
    echo '<article>';
        $tables->displayTableForUser ($idNav);
    echo '</article>';
    echo '<aside>';
        $tables->schedulingShopping ();
    echo '</aside>';
echo '<section>';