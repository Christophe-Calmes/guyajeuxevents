<?php 
require('sources/imagesCarousel/objects/DisplayCarousel.php');
$pathPicture = "sources/pictures/picturesCarousel/";
$pictures = new SQLCarousel ();
$dataFirstPicture = $pictures->firstPicture ();
if(empty($dataFirstPicture)) {
    $pathPicture = "sources/pictures/";
    $dataFirstPicture[0]['pictureName'] = "guyajeuxLogo.webp";
    $dataFirstPicture[0]['legend'] = "Bienvenu chez Guyajeux ! L'univers des jeux de société";
}
?>
<article class="flex-rows-carousel">
<button type="button" id="back"><<</button>
  <figure>
  <figcaption>
        <h3 class="subTitleSite" id="legend"><?=$dataFirstPicture[0]['legend']?></h3>
    </figcaption>
    <img class="imgCarouselAuto" width="1000" height="1000" id="displayPicture" src="<?=$pathPicture.$dataFirstPicture[0]['pictureName']?>" alt="<?=$dataFirstPicture[0]['legend']?>"/>
  </figure>
  <button type="button" id="go">>></button>
</article>
<?php
include 'sources/imagesCarousel/JavaScript/carouselAuto.php';
?>

