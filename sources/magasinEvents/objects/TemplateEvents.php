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
    private function templateOneEvent($value, $picturePath) {
        $finalText = $this->presentationText($value['description'], 'listClass');
        if($value['contribution'] == 0) {
            $contribution = 'Gratuit';
        } else {
            $contribution = $value['contribution'];
        }
            echo'<h2 class="subTitleSite titleEventItem">'.$value['title'].'</h2>';
            echo '<article>';
                echo '<p class="bold">Le '.brassageDate($value['dateEvent']).'</p>';
                echo '<p class="textEvents">'.$finalText.'</p>';
                echo '<p>Nombre de participant max : '.$value['numberMax'].' personnes</p>';
                echo '<p>Participation aux frais : '.$contribution.' €</p>';
            echo '</article>';
            echo '<img class="imgNews" src="'.$picturePath.$value['picture'].'" alt="illustration de'.$value['title'].'"/>';
        
    }
    private function templateEvent($variable) {
        $picturePath='sources/pictures/picturesEvents/';
        echo '<div class="gallery">';
        foreach ($variable as $value) {
            echo '<div class="item">';
            $this->templateOneEvent($value, $picturePath);
            echo '</div>';
        };
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
            echo '<div class="item">';
                $this->templateOneEvent($value, $picturePath);
                    echo '<form class="form-AdmiEvent" action="'.encodeRoutage($routage).'" method="post">
                    <input type="hidden" name="id" value="'.$value['id'].'"/>
                    <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$buttonMessage.'</button>
                    </form>';
                    echo '<a  href="'.findTargetRoute(112).'&idEvent='.$value['id'].'">Modifier</a>';
            echo '</div>';
        }
        echo '</div>';
    }
    public function adminEvents($firstPage, $parPage, $archive, $valid, $idNav, $routage) {
        $dataEvents = $this->readEventPagination($firstPage, $parPage, $archive, $valid);
        $this->templateAdminEvent($dataEvents, $idNav, $routage);
    }
    private function updateFormEvent($data, $idNav) {
        echo '<h1 class="subTitleSite">Modifier un événements</h1>
    <form class="flex-colonne-form" action="'.encodeRoutage(37).'" method="post" enctype="multipart/form-data">
    <label class="bold" for="title">Titre événement</label>
    <input type="text" id="title" name="title" value="'.$data['title'].'"/>
    <label class="bold" for="dateEvent">Le jour et l\'heure de votre événement</label>
    <input type="datetime-local" id="dateEvent" name="dateEvent" value="'.$data['dateEvent'].'"/>
    <label class="bold" for="description">Votre événement</label>
<textarea class="textAreaNew" id="description" name="description" rows="25" cols="50">
'.$data['description'].'
</textarea>
        <aside class="flex-colonne-form">
            <label class="bold" for="numberMax">Nombre maximum de participants</label>
            <input type="number" id="numberMax" name="numberMax" min="1" max="25" value="'.$data['numberMax'].'"/>
            <label class="bold" for="contribution">Participation au frais en €</label>
            <input type="number" id="numberMax" name="contribution" min="0" max="50" value="'.$data['contribution'].'"/>
            <label class="bold" for="publish">Publier</label>
            <select id="publish" name="publish">'; 
            optionSelect($data['publish']);
        echo'</select>
            <label class="bold" for="valid">Valider</label>
            <select id="valid" name="valid">
            '; 
            optionSelect($data['valid']);
        echo'
            </select>
            <label class="bold" for="archive">Archiver</label>
            <select id="archive" name="archive">
            '; 
            optionSelect($data['archive']);
        echo'
            </select>
            
            <label class="bold" for="picture">Image d\'illustration de l\'événement ?</label>
            <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
        </aside>
        <input type="hidden" name="id" value="'.$data['id'].'"/>
    <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
    </form>';
    }
    public function templateUpdateEvent($id, $idNav) {
        $dataEvent = $this->readOneEvent($id);
        echo '<div class="gallery">';
            echo '<div class="item">';
                $this->templateOneEvent($dataEvent[0], 'sources/pictures/picturesEvents/');
            echo '</div>';
        echo '</div>';
        echo '<article>';
        $this->updateFormEvent($dataEvent[0], $idNav);
        echo '</article>';

    }
    private function registrationUserOnEvent($idEvent, $numberMax){
        $listOfLoginRegistration=$this->listRegistered($idEvent);
        $numberUserOnEvent = $this->numberUserOnEvent($idEvent);
        echo '<p>Nombre d\'inscrit : '.$numberUserOnEvent.' / '.$numberMax.'</p>';
        echo '<ul>';
        foreach($listOfLoginRegistration as $value) {
            echo '<li>'.$value['login'].'</li>';
        }
        echo '</ul>';
    }
    public function registrationOneEvent(){
        $dataNextEvent = $this->nextEvent ();
   
        $picturePath='sources/pictures/picturesEvents/';
        echo '<div class="gallery">';
        foreach ($dataNextEvent as $value) {
            echo '<div class="item">';
            $this->templateOneEvent($value, $picturePath);
            $this->registrationUserOnEvent($value['id'], $value['numberMax']);
            echo '</div>';
        };
        echo '</div>';
       
    }
}