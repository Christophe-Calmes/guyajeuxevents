<article>
    <h1 class="subTitleSite">Ajouter une image</h1>
    <form class="flex-colonne-form" action="<?=encodeRoutage(60)?>" method="post" enctype="multipart/form-data">
    <label for="legend">Légende de l'image ?</label>
    <input type="text" id="legend" name="legend" placeholder="Le texte qui explique l'image ?"/>
    <label for="orderPicture">Ordre d'apparition ?</label>
    <input id="orderPicture" type="number" name="orderPicture" mini="0" max="124"/>
    <label for="picture">Nouvelle image dans le carousel ?</label>
    <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
    </form>
</article>