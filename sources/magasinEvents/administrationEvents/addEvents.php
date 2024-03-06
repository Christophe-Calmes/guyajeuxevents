<article>
    <h1 class="subTitleSite">Ajouter un événements</h1>
    <form class="flex-colonne-form" action="<?=encodeRoutage(34)?>" method="post" enctype="multipart/form-data">
    <label class="bold" for="title">Titre événement</label>
    <input type="text" id="title" name="title" placeholder="Titre de votre news"/>
    <label class="bold" for="dateEvent">Le jour et l'heure de votre événement</label>
    <input type="datetime-local" id="dateEvent" name="dateEvent"/>
    <label class="bold" for="description">Votre événement</label>
<textarea class="textAreaNew" id="description" name="description" rows="25" cols="50">
</textarea>
        <aside class="flex-colonne-form">
            <label class="bold" for="numberMax">Nombre maximum de participants</label>
            <input type="number" id="numberMax" name="numberMax" min="1" max="25" value="10"/>
            <label class="bold" for="contribution">Participation au frais en €</label>
            <input type="number" id="numberMax" name="contribution" min="5" max="50" value="12"/>
            <label class="bold" for="publish">Publier</label>
            <select id="publish" name="publish">
                <option value="0">Non</option>
                <option value="1" selected>Oui</option>
            </select>
            <label class="bold" for="picture">Image d'illustration de l'événement ?</label>
            <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
        </aside>
 
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
    </form>
</article>
