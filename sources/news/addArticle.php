<article>
    <h1 class="subTitleSite">Ajouter une news</h1>
    <form class="flex-colonne-form" action="<?=encodeRoutage(30)?>" method="post" enctype="multipart/form-data">
    <label for="title">Titre news</label>
    <input type="text" id="title" name="title" placeholder="Titre de votre news"/>
    <label for="text">Rédiger votre news</label>
    <textarea class="textAreaNew" id="text" name="text" rows="35" cols="50">
    <?php
        $dayWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        $displayBlackboard = '';
        for ($i=0; $i < count($dayWeek) ; $i++) { 
$displayBlackboard = $displayBlackboard.'
listStart
strongStart '.$dayWeek[$i].' :EndStrong
text activité semaine
liEnd
';
        }
echo 'ulStart'.$displayBlackboard.'ulEnd';
    ?>
    </textarea>
    <label for="publish">Publier</label>
    <select id="publish" name="publish">
        <option value="0">Non</option>
        <option value="1" selected>Oui</option>
    </select>
    <label for="picture">Image d'illustration de la news ?</label>
    <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
    <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
    </form>
</article>