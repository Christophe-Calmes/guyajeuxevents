<?php
require('sources/imagesCarousel/objects/SQLCarousel.php');
Class displayCarousel extends SQLCarousel {
    private $picturePath;
    public function __construct()
    {
        $this->picturePath = 'sources/pictures/picturesCarousel/';
    }
    public function displayPicture ($premier, $parPage, $idNav) {
        $dataPicture = $this->dataAdminPicture ($premier, $parPage);
        echo '<div class="gallery">';
            foreach($dataPicture as $value) {
                echo '<div class="item">';
                    echo '<article>';
                        echo '<p>Nom image <br/>'.$value['pictureName'].'</p>';
                        if($value['valid']) {
                            echo '<p>Image valide</p>';
                        } else {
                            echo '<p>Image non valide</p>';
                        }
                        echo '<p>Ordre apparition : '.$value['orderPicture'].'</p>';
                        echo '<p>Date enregistrement : '.brassageDate($value['date_creat']).'</p>';
                        echo '<p>Date modification : '.brassageDate($value['date_update']).'</p>';
                        echo '<p>Legende associé : '.$value['legend'].'</p>';
                        echo '<img class="imgNews" src="'.$this->picturePath.$value['pictureName'].'" alt="'.$value['pictureName'].'"/>';
                        echo '<form action="'.encodeRoutage(61).'" method="post">
                        <input type="hidden" name="id" value="'.$value['id'].'"/>
                        <button class="buttonForm red" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>
                        </form>';
                        echo '<form class="flex-colonne-form" action="'.encodeRoutage(62).'" method="post">
                        <label for="orderPicture">Ordre d\'apparition ?</label>
                        <input id="orderPicture" type="number" name="orderPicture" value="'.$value['orderPicture'].'" mini="0" max="124"/>
                        <label for="legend">Légende de l\'image ?</label>
                        <input type="text" id="legend" name="legend" value="'.$value['legend'].'"/>
                        <label for="valid">Image valide ?</label>
                        <select name="valid">
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                        <input type="hidden" name="id" value="'.$value['id'].'"/>
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
                        </form>';

                    echo'</article>';
                echo '</div>';
            }
        echo '</div>';
    }
}