<?php
require('sqlEvents.php');
require ('functions/functionDateTime.php');
require('functions/functionPresentationText.php');
Class TemplateEvents extends SQLEvents{
    protected function presentationText($data, $class) {
        $result = listHTML($data, $class);
        $result = lineBreak($result);
        $result = strongHTML($result);
        return $result;
    }
    private function templateEvent($variable) {
        $picturePath='sources/pictures/picturesEvents/';
        echo '<div class="gallery">';
        foreach ($variable as $value) {
            $finalText = $this->presentationText($value['description'], 'listClass');
            echo '<div class="item">';
                echo'<h2 class="subTitleSite titleEventItem">'.$value['title'].'</h2>';
                echo '<article>';
                    echo '<p class="bold">Le '.brassageDate($value['dateEvent']).'</p>';
                    echo '<p class="textNews">'.$finalText.'</p>';
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
    private function templateAdminEvent($variable, $idNav, $routage) {
        $picturePath='sources/pictures/picturesEvents/';
        if($routage == 36) {
            $buttonMessage = "Valider l'événement";
        } else {
            $buttonMessage = "Annuler événement";
        }
        echo '<div class="gallery">';
        foreach ($variable as $value) {
            $finalText = $this->presentationText($value['description'], 'listClass');
            echo '<div class="item">';
                echo'<h2 class="subTitleSite titleEventItem">'.$value['title'].'</h2>';
                echo '<article>';
                    echo '<p class="bold">Le '.brassageDate($value['dateEvent']).'</p>';
                    echo '<p class="textNews">'.$finalText.'</p>';
                    echo '<p>Nombre de participant max : '.$value['numberMax'].' personnes</p>';
                    echo '<p>Participation aux frais : '.$value['contribution'].' €</p>';
                echo '</article>';
                echo '<img class="imgNews" src="'.$picturePath.$value['picture'].'" alt="illustration de'.$value['title'].'"/>';
                echo '<form class="form-AdmiEvent" action="'.encodeRoutage($routage).'" method="post">
                <input type="hidden" name="id" value="'.$value['id'].'"/>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$buttonMessage.'</button>
                </form>';
            echo '</div>';
        }
        echo '</div>';
    }
    public function adminEvents($firstPage, $parPage, $archive, $valid, $idNav, $routage) {
        $dataEvents = $this->readEventPagination($firstPage, $parPage, $archive, $valid);
        $this->templateAdminEvent($dataEvents, $idNav, $routage);

    }
}