<div>
<button type="button" id="magic" class="open">Ouvrir le formulaire</button>
</div>
<div id="hiddenForm">
<form class="flex-colonne-form" action="<?=encodeRoutage(42)?>" method="post" enctype="multipart/form-data">
    <label for="name">Nom de la table</label>
    <input type="text" id="name" name="name" placeholder="Nom de la table"/>
    <label for="max">Nombre de personne maximum sur la table</label>
    <input type="number" id="max" name="max" min="1" max="20"/>
    <lable for="PositionTable">Position relative de la table noté de 0 à 99</lable>
    <input type="number" id="PositionTable" name="PositionTable" min="0" max="99"/>
    <label for="picture">Image d'illustration de la news ?</label>
    <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>
<?php
    include 'javaScript/magicButton.php';
