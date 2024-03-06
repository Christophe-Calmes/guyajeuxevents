<?php
require('sqlEvents.php');
require ('functions/functionDateTime.php');
Class TemplateEvents extends SQLEvents{
    private function templateEvent($variable) {
        $picturePath='sources/pictures/picturesEvents/';
        echo '<div class="gallery">';
        foreach ($variable as $value) {
            echo '<div class="item">';
                echo'<h2 class="subTitleSite titleEventItem">'.$value['title'].'</h2>';
                echo '<article>';
                    echo '<p class="bold">Le '.brassageDate($value['dateEvent']).'</p>';
                    echo '<p class="textNews">'.$value['description'].'</p>';
                    echo '<p>Nombre de participant max : '.$value['numberMax'].' personnes</p>';
                    echo '<p>Participation aux frais : '.$value['contribution'].' €</p>';
                echo '</article>';
                echo '<img class="imgNews" src="'.$picturePath.$value['picture'].'" alt="illustration de'.$value['title'].'"/>';
            echo '</div>';
        }
        echo '</div>';
    }

    public function displayEventPublic() {
        $dataNextEvent = $this->nextEvent ();
       $this->templateEvent($dataNextEvent);
    }
}