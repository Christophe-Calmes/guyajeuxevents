<div>
<button type="button" id="magic" class="open">Ajouter un nouveau type de consommation ?</button>
</div>
<div id="hiddenForm">
<h3 class="subTitleSite">Ajouter une nouveau type de consommation ?</h3>
<form class="flex-colonne-form" action="<?=encodeRoutage(47)?>" method="post" enctype="multipart/form-data">
    <label for="name">Nom de la consommation ?</label>
    <input type="text" id="name" name="name" placeholder="Nom de la table"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>

<?php
include 'javaScript/magicButton.php';
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
$activity = new TemplateReserveTables();
$activity->displayAndAdminConsommation(1, $idNav);
$activity->displayAndAdminConsommation(0, $idNav);