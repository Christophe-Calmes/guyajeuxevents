<div>
<button type="button" id="magic" class="open">Ajouter une nouvelle activité ?</button>
</div>
<div id="hiddenForm">
<form class="flex-colonne-form" action="<?=encodeRoutage(44)?>" method="post" enctype="multipart/form-data">
    <label for="name">Nom de l'activité ?</label>
    <input type="text" id="name" name="name" placeholder="Nom de la table"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>

<?php
include 'javaScript/magicButton.php';
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$activity = new TemplateReserveTables();
$activity->displayAndAdminActivity(1, $idNav);
$activity->displayAndAdminActivity(0, $idNav);