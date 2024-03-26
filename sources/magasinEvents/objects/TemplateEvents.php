<?php
require('sources/magasinEvents/objects/sqlEvents.php');
require('sources/reserveTablesByUser/objects/TemplateReserveTable.php');
function unsubscribeUIserForm($idNav, $login, $idEvent, $idUser) {
    echo '<li>
    <form action="'.encodeRoutage(40).'" method="post">
        <input type="hidden" name="idEvent" value="'.$idEvent.'"/>
        <input type="hidden" name="idUser" value="'.$idUser.'"/>
        <button class="buttonForm red" type="submit" name="idNav" value="'.$idNav.'">Retirer  '.$login.'</button>
    </form>
    </li>';
}
Class TemplateEvents extends SQLEvents{
    protected function presentationText($data, $class) {
        $result = listHTML($data, $class);
        $result = lineBreak($result);
        $result = strongHTML($result);
        return $result;
    }
    private function formAddOneMemberOnEvent($idEvent, $idNav) {
        $data = $this->selectAllMembres();
        echo '<form class="flex-colonne" action="'.encodeRoutage(58).'" method="post">
                <label for="idUser">Listes des membres :</label>
                <select id="idUser" name="idUser">';
                foreach($data as $value) {
                    echo'<option value="'.$value['idUser'].'">'.$value['prenom'].' '.$value['nom'].'</option>';
                }
            echo'</select><div class="select-arrow"></div>
                <input type="hidden" name="idEvent" value="'.$idEvent.'"/>
            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Inscrire</button>
        </form>';

    }
    private function templateOneEvent($value, $picturePath) {
        $soldOut = null;
        $red = null;
        if(!$this-> getSoldOut($value['id'])){
            $soldOut = 'Complet -';
            $red = 'red';
        }
        $finalText = $this->presentationText($value['description'], 'listClass');
        if($value['contribution'] == 0) {
            $contribution = 'Gratuit';
        } else {
            $contribution = $value['contribution'];
        }
            echo'<h2 class="subTitleSite titleEventItem '.$red.'">'.$soldOut.$value['title'].'</h2>';
           
            echo '<article>';
                echo '<p class="bold">Le '.brassageDate($value['dateEvent']).'</p>';
                echo '<p class="bold">Heure du rendez-vous :'.justHeureFr($value['dateEvent']).'</p>';
                echo '<p class="bold">Fin de l\'événenement :'.justHeureFr($value['dateEndEvent']).'</p>';
                echo '<p class="textEvents">'.$finalText.'</p>';
                echo '<p>Nombre de participant max '.$value['numberMax'].' personnes</p>';
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
    
    public function adminEvents($firstPage, $parPage, $archive, $valid, $idNav, $routage) {
        $dataEvents = $this->readEventPagination($firstPage, $parPage, $archive, $valid);
        $this->templateAdminEvent($dataEvents, $idNav, $routage);
    }
    private function updateFormEvent($data, $idNav) {
        $numberOfChair = new TemplateReserveTables();
        echo '<h1 class="subTitleSite">Modifier un événements</h1>
            <form class="flex-colonne-form" action="'.encodeRoutage(37).'" method="post" enctype="multipart/form-data">
            <label class="bold" for="title">Titre événement</label>
            <input type="text" id="title" name="title" value="'.$data['title'].'"/>
            <label class="bold" for="dateEvent">Le jour et l\'heure de votre événement</label>
            <input type="datetime-local" id="dateEvent" name="dateEvent" value="'.$data['dateEvent'].'"/>
            <label class="bold" for="dateEndEvent">Horraire de fin de l\'événement ?</label>
            <input type="datetime-local" name="dateEndEvent" id="dateEndEvent" value="'.$data['dateEndEvent'].'"  required/>
            </div>
            <label class="bold" for="description">Votre événement</label>
<textarea class="textAreaNew" id="description" name="description" rows="25" cols="50">
'.$data['description'].'
</textarea>
        <aside class="flex-colonne-form">
            <label class="bold" for="numberMax">Nombre maximum de participants</label>
            <input type="number" id="numberMax" name="numberMax" min="1" max="'.$numberOfChair->readNumberOfChairAdmin().'" value="'.$data['numberMax'].'"/>
            <label class="bold" for="contribution">Participation au frais en €</label>
            <input type="number" id="numberMax" name="contribution" min="0" max="250" value="'.$data['contribution'].'"/>
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
        echo'</select>
            <label class="bold" for="picture">Image d\'illustration de l\'événement ?</label>
            <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
        </aside>';
        $numberOfChair->selectAbstractParam('activity', 'Activity', 'Vos activités prévus ?');
        $numberOfChair->selectAbstractParam('consommations', 'Consommation', 'Quelles type consommations ?');
        $dataTables = $this->selectAllTables();
            echo '<aside class="gallery3">';
            echo '<style>';
            foreach($dataTables as $value) {
               echo '.toggle'.$value['id'].' {
                    position : relative ;
                    display : inline-block;
                    width : 5.5em;
                    height : 1.6em;
                    background-color: var(--color-neutralBone);
                    border-radius: 30px;
                    border: 2px solid var(--color-blueOneChair);
                }
                .toggle'.$value['id'].':after {
                    content: "";
                    position: absolute;
                    width: 1.48em;
                    height: 1.48em;
                    border-radius: 50%;
                    background-color: var(--color-orange);
                    top: 1px;
                    left: 2px;
                    transition:  all 0.7s;
                }
                .checkedText'.$value['id'].' {
                    font-family: Arial, Helvetica, sans-serif;
                    font-weight: bold;
                    font-size: 0.8em;
                    display: flex;
                    padding-left: 0.2em;
                    padding-bottom: 0px;
                }
                .checkbox'.$value['id'].':checked + .toggle'.$value['id'].'::after {
                    left : 3.85em;
                    background-color: var(--color-green);
                }
                .checkbox'.$value['id'].':checked + .toggle'.$value['id'].' {
                    background-color: var(--color-darkGreen);
                }
                .checkbox'.$value['id'].' {
                    display : none;
                }';
            }
            echo '</style>';
            $tableForOneEvent = new SQLAcessReserTables();
            $idTables = $tableForOneEvent->sortTableEvent ($data['id']);
            $idTableSimple = array_column($idTables, 'idTable');
            foreach($dataTables as $value){   
                if(array_search($value['id'],$idTableSimple) !== FALSE) {
                $checked = 'checked';
               } else {
                $checked = null;
               }
                echo '<div class="itemCheckBox">';
                    echo '<label class="dayweek" for="idTable'.$value['id'].'">'.$value['name'].'<br/> Max personne = '.$value['max'].'</label>';
                    echo '<input type="checkbox" class="checkbox'.$value['id'].'" id="switch'.$value['id'].'" name="idTable'.$value['id'].'" '.$checked.'/>';
                    echo '<label for="switch'.$value['id'].'" class="toggle'.$value['id'].'">';
                    echo '<p class="checkedText'.$value['id'].'"></p>';
                echo '</div>';
            }
        echo '<input type="hidden" name="id" value="'.$data['id'].'"/>
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
        echo '<aside>
                <article>';
                echo '<ul class="adminEventList">';
                echo '<p>Nombre d\'inscrit: '.$numberUserOnEvent.' / '.$numberMax.'</p>';
                    if($numberUserOnEvent > 0) {
                        if(!$this->getSoldOut($idEvent)){
                            $a=0;
                        
                            while ($a <= $numberMax-1) {
                                echo '<li>'.$listOfLoginRegistration[$a]['login'].'</li>';
                                $a++;
                            }
                            $waitingList = array_slice($listOfLoginRegistration, $a);
                
                            if($numberUserOnEvent>$numberMax){echo'<li class="margin"><h4>Liste d\'attente :</h4></li>';}
                            foreach($waitingList as $value){
                                echo '<li>'.$value['login'].'</li>';
                            }
                        } else {
                     
                            foreach($listOfLoginRegistration as $value){
                                echo '<li>'.$value['login'].'</li>';
                            }
                      
                        }
                        echo '<ul>';
                    }
                    echo '</article>
        </aside>';
    }
    private function adminRegistrationUserOnEvent($idEvent, $numberMax, $idNav){

        $listOfLoginRegistration=$this->listRegistered($idEvent);
        $numberUserOnEvent = $this->numberUserOnEvent($idEvent);
        if($numberUserOnEvent>0){
            echo '<aside><h4>Administration inscrits</h4>
                <article>';
                echo '<ul class="adminEventList">';
                    if($numberUserOnEvent > 0) {
                        if(!$this->getSoldOut($idEvent)){
                            $a=0;
                            while ($a <= $numberMax-1) {
                                unsubscribeUIserForm($idNav, $listOfLoginRegistration[$a]['login'], $idEvent, $listOfLoginRegistration[$a]['idUser']);
                                $a++;
                            }
                            $waitingList = array_slice($listOfLoginRegistration, $a);
                            if($numberUserOnEvent>$numberMax){echo'<li class="margin"><h4>Liste d\'attente :</h4></li>';}
                            foreach($waitingList as $value){
                                unsubscribeUIserForm($idNav, $value['login'], $idEvent, $value['idUser']);
                            }
                        } else {
                            foreach($listOfLoginRegistration as $value){
                                unsubscribeUIserForm($idNav, $value['login'], $idEvent, $value['idUser']);
                            }
                        }
                        echo '<ul>';
                    }
                    echo '</article>
            </aside>';
        }    

    }
    private function addUserOnEvent($session, $idEvent, $idNav){
        $getIdUser = new Controles();
        $idUser = $getIdUser->idUser($session);
        $registred = $this->userIsRegistredOnEvent($idUser, $idEvent);
        if($registred) {
            echo '<form action="'.encodeRoutage(39).'" method="post">
                    <input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Désinscription</button>';
            echo '</form>';
        } else {
               echo '<form action="'.encodeRoutage(38).'" method="post">
                    <input type="hidden" name="idEvent" value="'.$idEvent.'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Inscription</button>';
            echo '</form>';
        }
    }
    public function registrationOneEvent($session, $idNav){
        $dataNextEvent = $this->nextEvent ();
   
        $picturePath='sources/pictures/picturesEvents/';
        echo '<div class="gallery">';
        foreach ($dataNextEvent as $value) {
            echo '<div class="item">';
            $this->templateOneEvent($value, $picturePath);
            $this->registrationUserOnEvent($value['id'], $value['numberMax']);
            $this->addUserOnEvent($session, $value['id'], $idNav);
            echo '</div>';
        };
        echo '</div>';
       
    }

    private function templateAdminEvent($variable, $idNav, $routage) {
        function buttonDelUserOnEvent ( $id, $idNav) {
                echo'<form action="'.encodeRoutage(55).'" method="post">
                <input type="hidden" name="id" value="'.$id.'"/>
                <button class="buttonForm red" type="submit" name="idNav" value="'.$idNav.'">Effacer tous les inscrits</button>
            </form>';
        }
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
                    echo '<article class="adminEventList">';
                        $this->formAddOneMemberOnEvent($value['id'], $idNav);
                        $this->registrationUserOnEvent($value['id'], $value['numberMax']);
                        $this->adminRegistrationUserOnEvent($value['id'], $value['numberMax'], $idNav);
                        buttonDelUserOnEvent($value['id'], $idNav);
                    echo '</article>';
            echo '</div>';

        }
        echo '</div>';
    }
    public function archiveEvent() {
        $update ="UPDATE internalEvents
        SET archive = 1
        WHERE dateEvent < DATE_SUB(CURRENT_DATE(), INTERVAL 2 DAY);";
        return ActionDB::access($update, [], 1);
    }
    public function creatEventsAndBookingTables ($idNav) {
        $numberOfChair = new TemplateReserveTables();
        echo '<article>
            <div>
                <form class="flex-colonne-form" action="'.encodeRoutage(34).'" method="post" enctype="multipart/form-data">
                <h1 class="subTitleSite">Ajouter un événements</h1>
                <label class="bold" for="title">Titre événement</label>
                <input type="text" id="title" name="title" placeholder="Titre de votre news"/>
                <label class="bold" for="dateEvent">Le jour et l\'heure de votre événement</label>
                <input type="datetime-local" id="dateEvent" name="dateEvent" required/>
                <label class="bold" for="dateEndEvent">Horraire de fin de l\'événement ?</label>
                    <input type="datetime-local" name="dateEndEvent" id="dateEndEvent" required/>
            </div>
        <label class="bold" for="description">Votre événement</label>
<textarea class="textAreaNew" id="description" name="description" rows="25" cols="50">
</textarea>
            <aside class="flex-colonne-form">
                <label class="bold" for="numberMax">Nombre maximum de participants</label>
                <input type="number" id="numberMax" name="numberMax" min="1" max="'.$numberOfChair->readNumberOfChairAdmin().'" value="10"/>
                <label class="bold" for="contribution">Participation au frais en €</label>
                <input type="number" id="numberMax" name="contribution" min="0" max="250" value="12"/>
                <label class="bold" for="publish">Publier</label>
                <select id="publish" name="publish">
                    <option value="0">Non</option>
                    <option value="1" selected>Oui</option>
                </select>
                <label class="bold" for="picture">Image d\'illustration de l\'événement ?</label>
                <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>';
            $numberOfChair->selectAbstractParam('activity', 'Activity', 'Vos activités prévus ?');
            $numberOfChair->selectAbstractParam('consommations', 'Consommation', 'Quelles type consommations ?');
            echo '</aside>';
            $dataTables = $this->selectAllTables();
            echo '<aside class="gallery3">';
            echo '<style>';
            foreach($dataTables as $value) {
               echo '.toggle'.$value['id'].' {
                    position : relative ;
                    display : inline-block;
                    width : 5.5em;
                    height : 1.6em;
                    background-color: var(--color-neutralBone);
                    border-radius: 30px;
                    border: 2px solid var(--color-blueOneChair);
                }
                .toggle'.$value['id'].':after {
                    content: "";
                    position: absolute;
                    width: 1.48em;
                    height: 1.48em;
                    border-radius: 50%;
                    background-color: var(--color-orange);
                    top: 1px;
                    left: 2px;
                    transition:  all 0.7s;
                }
                .checkedText'.$value['id'].' {
                    font-family: Arial, Helvetica, sans-serif;
                    font-weight: bold;
                    font-size: 0.8em;
                    display: flex;
                    padding-left: 0.2em;
                    padding-bottom: 0px;
                }
                .checkbox'.$value['id'].':checked + .toggle'.$value['id'].'::after {
                    left : 3.85em;
                    background-color: var(--color-green);
                }
                .checkbox'.$value['id'].':checked + .toggle'.$value['id'].' {
                    background-color: var(--color-darkGreen);
                }
                .checkbox'.$value['id'].' {
                    display : none;
                }';
            }
            echo '</style>';
            foreach($dataTables as $value){
                echo '<div class="itemCheckBox">';
                    echo '<label class="dayweek" for="idTable'.$value['id'].'">'.$value['name'].'<br/> Max personne = '.$value['max'].'</label>';
                    echo '<input type="checkbox" class="checkbox'.$value['id'].'" id="switch'.$value['id'].'" name="idTable'.$value['id'].'"/>';
                    echo '<label for="switch'.$value['id'].'" class="toggle'.$value['id'].'">';
                    echo '<p class="checkedText'.$value['id'].'"></p>';
                   
                echo '</div>';
            }
           
     
      echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Ajouter</button>';
      echo '</aside>
      </form>
    </article>';
    

    }
}