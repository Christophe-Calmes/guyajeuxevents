<?php
require('sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('functions/functionPresentationText.php');
require ('functions/functionDateTime.php');
function inputOpenClose ($open, $close, $nameOpen, $nameClose) {
    echo '<td>
    <label for="openMorning"></label>
    <input id="'.$nameOpen.'" name="'.$nameOpen.'" type="time" value="'.$open.'"/> - <label for="'.$nameClose.'"></label> <input id="'.$nameClose.'" name="'.$nameClose.'" type="time" value="'.$close.'"/>
</td>';
}


Class TemplateReserveTables extends SQLAcessReserTables {
   private $dayOfWeek;
   private $yes;
   private $pathPicture;

    public function __construct()
    {
        $this->dayOfWeek = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $this->yes=['Non', 'Oui'];
        $this->pathPicture ="sources/pictures/pictureTables/";
    }
    private function formAddOneMemberOnEvent($idReserveTable, $idNav) {
        $data = $this->selectAllMembres();
        echo '<form class="flex-colonne" action="'.encodeRoutage(59).'" method="post">
                <label for="idUser">Listes des membres :</label>
                <select id="idUser" name="idUser">';
                foreach($data as $value) {
                    echo'<option value="'.$value['idUser'].'">'.$value['prenom'].' '.$value['nom'].'</option>';
                }
            echo'<input type="hidden" name="id" value="'.$idReserveTable.'"/>
            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Affecter</button>
        </form>';

    }
    public function displayScheduleShop ($idNav) {
        $schedule = $this->scheduleShop ();
        echo '<table class="scheduleShop">';
        echo '<hr>
                <th>Jour de la semaine</th>
                <th>Matin</th>
                <th>Après midi</th>
                <th>Fermeture</th>
                <th>Modification</th>
            </hr>';
        
        foreach($schedule as $value) {
            echo '<form action="'.encodeRoutage(41).'" method="post">';
                echo'<tr>';
                echo '<td>'.$this->dayOfWeek[$value['dayOfWeekW']].'</td>';
                if($value['closeDay'] == 0) {
                    inputOpenClose ($value['openMorning'], $value['closeMorning'], 'openMorning', 'closeMorning');
                } else {
                    echo '<td>Fermer</td>';
                }
            
                if($value['closeDay'] == 0) {
                    inputOpenClose ($value['openAfternoon'], $value['closeAfternoon'], 'openAfternoon', 'closeAfternoon');
                } else {
                    echo '<td>Fermer</td>';
                }

                echo '<td>';
                    selectHTML($value['closeDay'], 'closeDay', $this->yes);
                echo'</td>';
                echo '<input type="hidden" name="dayOfWeekW" value="'.$value['dayOfWeekW'].'"/>';
                echo '<td><button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button></td>';
                echo '</tr>';
            echo '</form>';
        }
        echo'</table>';
    }
    public function readNumberOfChairAdmin() {
        $dataNumberOfChair = $this->readNumberOfChair ();
        return $dataNumberOfChair[0]['numberOfChair'];
    }
    public function arrayAdminTable($valid, $idNav) {
        
        $dataTable = $this->getTables($valid);
        $titlePanel = "Table non valide";
        if($valid ==1) {
            $titlePanel = "Table valide";
        } 
        if($dataTable !=[]){
            $pathPicture = "sources/pictures/pictureTables/";
            echo '<h2>'.$titlePanel.'</h2>';
            echo'<div class="adminTable">
                    <div class="nameTable">Nom</div>
                    <div class="maxTable">Maximum chaises : '.$this->readNumberOfChairAdmin().'</div>
                    <div class="PositionTable">Position</div>
                    <div class="pictureOfTable">Image table</div>
                    <div class="ValidTable">Table valide ?</div>
                    <div class="ButtonAdmin">Modification rapide</div>
                </div>';
            foreach($dataTable as $value) {
            echo'<form formAdmin" action="'.encodeRoutage(43).'" method="post" enctype="multipart/form-data">
            <div class="adminTable">
                    <div class="nameTable">
                    <label for="name">'.$value['name'].'</label>
                    <input type="text" name="name" value="'.$value['name'].'"/>
                    </div>
                    <div class="maxTable">
                    <label for="max">'.$value['max'].'</label>
                    <input type="number" name="max" value="'.$value['max'].'" min="1" max="99"/>
                    </div>
                    <div class="PositionTable">
                    <lable for="PositionTable">Position :'.$value['PositionTable'].'</lable>
                    <input type="number" id="PositionTable" name="PositionTable" min="0" max="99" value="'.$value['PositionTable'].'"/>
                    </div>
                    <div class="pictureOfTable">
                        <img class="vignette" src="'.$pathPicture.$value['pictureOfTable'].'" alt="'.$value['name'].'"/>
                        <label for="picture"></label>
                        <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
                    </div>
                    <div class="ValidTable">
                    <label for="valid"></label>
                        <select name="valid">';
                        optionSelect($value['valid']);
                        echo'</select>
                    </div>
                    <div class="ButtonAdmin">
                    <input type="hidden" name="id" value="'.$value['id'].'"/>
                    <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button></div>
                </div>
                </form>';
            }
        }
    }
   
    public function displayAndAdminActivity ($valid, $idNav){
        $dataActivity = $this->getActivityByValid ($valid);
        if(($valid == 1)&&($dataActivity != [])) {
            echo '<h3>Activité valide</h3>';
            $buttonMessage = "Invalider";
        } else if (($valid == 0)&&($dataActivity != [])){
            echo '<h3>Activité non valide</h3>';
            $buttonMessage = "Valider";
        }
      foreach($dataActivity as $value){
        echo '<div class="flex-rows">';
        echo '<form action="'.encodeRoutage(45).'" method="post">';
        echo '<input type="hidden" name="id" value="'.$value['id'].'"/>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$buttonMessage.' '.$value['name'].'</button>';
        echo '</form>';
        if($value['valid'] == 0){
            echo '<form action="'.encodeRoutage(46).'" method="post">';
            echo '<input type="hidden" name="id" value="'.$value['id'].'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Suppression de '.$value['name'].'</button>';
            echo '</form>';
        }
        echo '</div>';
      }

    }
    public function displayAndAdminConsommation ($valid, $idNav){
        $dataConsommation = $this->getConsommationByValid ($valid);
        if(($valid == 1)&&($dataConsommation != [])) {
            echo '<h3>Consommation valide</h3>';
            $buttonMessage = "Invalider";
        } else if (($valid == 0)&&($dataConsommation != [])){
            echo '<h3>Consommation non valide</h3>';
            $buttonMessage = "Valider";
        }
      foreach($dataConsommation as $value){
        echo '<div class="flex-rows">';
        echo '<form action="'.encodeRoutage(49).'" method="post">';
        echo '<input type="hidden" name="id" value="'.$value['id'].'"/>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$buttonMessage.' '.$value['name'].'</button>';
        echo '</form>';
        if($value['valid'] == 0){
            echo '<form action="'.encodeRoutage(48).'" method="post">';
            echo '<input type="hidden" name="id" value="'.$value['id'].'"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Suppression de '.$value['name'].'</button>';
            echo '</form>';
        }
        echo '</div>';
      }

    }
    public function selectAbstractParam($tableName, $fieldName, $label) {
        $data = $this->abstractParam($tableName);
        echo '<label class="bold"  for="id'.$fieldName.'">'.$label.'</label>';
        echo '<select name="id'.$fieldName.'">';
            foreach($data as $value){
                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            }
        echo '</select>';
    }
    public function currentAndFuturBookings($idTable, $targetRoute){

echo'<aside>
        <a href="'.findTargetRoute($targetRoute).'&idTable='.$idTable.'">Voir les réservations</a>
    </aside>';
    }

    public function displayTableForUser ($idNav, $routage, $targetRoute) {
        $dataValidTable = $this->getTables (1);
        echo '<style>';
        foreach($dataValidTable as $value) {
            echo '#hiddenForm'.$value['PositionTable'].' {
                padding:0.5em;
                top: 10%;
                left: 55%;
                background-color: var(--main-background-MagicForm);
                -webkit-box-shadow: var(--main-shadow);
                box-shadow: var(--main-shadow);
                position: absolute;
                width: 20vw;
                display: none;
                border: var(--main-border);
                border-radius: var(--main-radius);
                z-index: 2;
              }
              #magic'.$value['PositionTable'].'{

              }';
        }
        echo '@media only screen and (max-width: 768px) {';
            foreach($dataValidTable as $value) {
                echo '#hiddenForm'.$value['PositionTable'].' {
                    left: 20%;
                    width: 60vw;
                }';
            }
        echo '}';
        echo '</style>';
        echo '<div class="flex-colonne-left">';
        foreach($dataValidTable as $value) {
            $valueNumber = round(log($value['max']))+2;
            echo '<div>
            <button type="button" id="magic'.$value['PositionTable'].'" class="open">Ouvrir la table '.$value['name'].'</button>
            </div>
            
            <div id="hiddenForm'.$value['PositionTable'].'" class="flex-rows">';
            $this->currentAndFuturBookings($value['id'], $targetRoute);
        echo '<form class="flex-colonne-form" action="'.encodeRoutage($routage).'" method="post">
                <h3 class="subTitleSite">Table '.$value['name'].'</h3>
                <img class="modal" src="'.$this->pathPicture.$value['pictureOfTable'].'" alt=".'.$value['name'].'."/>
                <label class="bold" for="dateRserve">Le jour de votre réservation ?</label>
                <input type="datetime-local" id="dateReserve" name="dateReserve" required/>
                <label class="bold" for="endOfReserve">Horraire de fin de réservation</label>
                <input type="time" name="endOfReserve" id="endOfReserve" min="10:00" max="23:59" required/>
                <label class="bold" for="numberPeople">Réservation pour combien de personnes ?</label>
                <input type="number" id="numberPeople" name="numberPeople" min="1" value="'.$valueNumber.'" max="'.$value['max'].'"/>
                    <input type="hidden" name="idTable" value="'.$value['id'].'"/>'; 
                    $this->selectAbstractParam('activity', 'Activity', 'Vos activités prévus ?');
                    $this->selectAbstractParam('consommations', 'Consommation', 'Quelles type consommations ?');
            echo '<label class="bold" for="comment">Nous faire parvenir un commentaire ?</label>
<textarea class="textAreaNew" id="text" name="comment" rows="7" cols="30">
Pas de commentaire.
</textarea>';
            echo'<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Inscription</button>
                </form>';
        
    echo '</div>';
         
        }
        echo '</div>';
        echo '<script type="text/javascript" defer>';
        foreach($dataValidTable as $value) {
            echo 'let jeckyl'.$value['id'].' = document.getElementById("magic'.$value['PositionTable'].'");
            let magax'.$value['id'].' = document.getElementById("hiddenForm'.$value['PositionTable'].'");
            let open'.$value['PositionTable'].' = false;
            jeckyl'.$value['id'].'.addEventListener("click", function(){
              if(!open'.$value['PositionTable'].') {
                jeckyl'.$value['id'].'.innerText = "Fermer la table '.$value['name'].'";
                jeckyl'.$value['id'].'.style.backgroundColor = "#700B15";
                magax'.$value['id'].'.style.display = "block";
                open'.$value['PositionTable'].' = true;
              } else {
                jeckyl'.$value['id'].'.innerText = "Ouvrir la table '.$value['name'].'";
                jeckyl'.$value['id'].'.style.backgroundColor = "#03470D";
                magax'.$value['id'].'.style.display = "none";
                open'.$value['PositionTable'].' = false;
              }
              return open'.$value['PositionTable'].';
            });';
         
        }
        echo '</script>';
    }
    public function schedulingShopping () {
        $dataScheduling = $this->scheduleShop ();
        echo '<div class="shoppingHour">
                <div class="dayOfWeek">Jour de la semaine</div>
                <div class="OpenMorning">Ouverture matin</div>
                <div class="CloseMorning">Fermeture matin</div>
                <div class="OpenAfternoon">Ouverture après midi</div>
                <div class="CloseAfternoon">Fermeture</div>
              </div>';
       
        foreach($dataScheduling as $value) {
            if($value['closeDay'] == 0) {
                if(substr($value['closeAfternoon'],0,-3) == '23:59') {
                    $hour = '00:00';
                } else {
                    $hour = substr($value['closeAfternoon'],0,-3);
                }
                echo '<div class="shoppingHour">
                <div class="dayOfWeek">'.$this->dayOfWeek[$value['dayOfWeekW']].'</div>
                <div class="OpenMorning">'.substr($value['openMorning'],0,-3).'</div>
                <div class="CloseMorning">'.substr($value['closeMorning'],0,-3).'</div>
                <div class="OpenAfternoon">'.substr($value['openAfternoon'],0,-3).'</div>
                <div class="CloseAfternoon">'.$hour.'</div>
              </div>';
            } else {
                echo '<div class="red close">Fermeture le '.$this->dayOfWeek[$value['dayOfWeekW']].'</div>';
            }
        }
       
    }
    public function displayAndAdminBookingTableByUser($idUser, $idNav) {
        $dataBooking = $this->bookingOneUser($idUser, 1);
        echo '<article class="galleryReserveTable">';
        if($dataBooking !=[]) {
            foreach($dataBooking as $value) {
                echo '<div class="itemReserveTable">';
                    echo '<h3 class="subTitleSite">Table '.$value['nameTable'].' </h3>';
                    echo '<img class="modal" src="'.$this->pathPicture.$value['pictureOfTable'].'" alt=".'.$value['nameTable'].'."/>';
                    echo '<article class="reservedTable">';
                    echo '<p>Résevation : '.formatDateHeureFr($value['dateReserve']).' à '.justHeureFr($value['endOfReserve']).'.</p>';
                    echo '<p>Activité : '.$value['nameActivity'].'</p>';
                    echo '<p>Nombre de personnes prévus : '.$value['numberPeople'].'</p>';
                    echo '<p>Consommation principale prévus : '.$value['nameConsommation'].'</p>';
                    echo '<p>Commentaire :<br/>'.$value['comment'].'</p>';
                    echo '</article>';
                    echo'<form action="'.encodeRoutage(51).'" method="post">
                            <input type="hidden" name="id" value="'.$value['id'].'"/>
                            <button class="buttonForm red" type="submit" name="idNav" value="'.$idNav.'">Annuler réservation</button>
                        </form>';
                echo'</div>';  
                }
        } else{
            echo '<div class="itemReserveTable">';
                echo '<a href="'.findTargetRoute(128).'">Aller réserver une table</a>';
            echo'</div>'; 

        }
  
        echo '</article>';
    }
    public function displayReservationTablesAdmin($firstPage, $byPages, $idNav, $valid) {
        $dataReservationTables = $this->getReservationsTables($firstPage, $byPages, $valid);
        function buttonAnnuler ($valid, $id, $idNav) {
            if($valid == 1) {
                echo'<form action="'.encodeRoutage(53).'" method="post">
                <input type="hidden" name="id" value="'.$id.'"/>
                <button class="buttonForm red" type="submit" name="idNav" value="'.$idNav.'">Annuler réservation</button>
            </form>';
            } 
         
        }
        if($dataReservationTables !=[]) {
            echo '<article class="galleryReserveTable">';
            foreach($dataReservationTables as $value) {
           
                echo '<div class="itemReserveTable">';
              
                    echo '<h3 class="subTitleSite">Table '.$value['nameTable'].'</h3>';
                    if($value['idEvent'] != null) {
                        echo '<p class="dayweek">Réservation pour l\'événement : '.$this->getTitleEvent ($value['idEvent']).'</p>';
                    }
                    echo '<img class="modal" src="'.$this->pathPicture.$value['pictureOfTable'].'" alt=".'.$value['nameTable'].'."/>';
                    echo '<article class="reservedTable">';
                    echo '<p>Réservation au nom de : <strong>'.$value['prenom'].' '.$value['nom'].'</strong></p>';
                    echo '<p><strong>Résevation : '.formatDateHeureFr($value['dateReserve']).' à '.justHeureFr($value['endOfReserve']).'.</strong></p>';
                    echo '<p>Date de création : '.formatDateHeureFr($value['dateCreat']).'</p>';
                    echo '<p>Activité : '.$value['nameActivity'].'</p>';
                    echo '<p>Nombre de personnes prévus : '.$value['numberPeople'].'</p>';
                    echo '<p>Consommation principale prévus : '.$value['nameConsommation'].'</p>';
                    echo '<p>Commentaire :<br/>'.$value['comment'].'</p>';
                    echo '</article>';
                    buttonAnnuler ($valid, $value['id'], $idNav); 
                    if($value['idEvent'] == null) {
                        $this->formAddOneMemberOnEvent($value['id'], $idNav);
                    }
                echo'</div>';  
                }
            echo '</article>';

        } else {
            echo '<article>Aucune réservation de prévus actuellement</article>';
        }
        
    }

}