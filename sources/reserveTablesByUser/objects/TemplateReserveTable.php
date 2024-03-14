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

    public function __construct()
    {
        $this->dayOfWeek = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $this->yes=['Non', 'Oui'];
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
    private function readNumberOfChairAdmin() {
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
    private function selectAbstractParam($tableName, $fieldName, $label) {
        $data = $this->abstractParam($tableName);
        echo '<label class="bold"  for="id'.$fieldName.'">'.$label.'</label>';
        echo '<select name="id'.$fieldName.'">';
            foreach($data as $value){
                echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            }
        echo '</select>';
    }

    public function displayTableForUser ($idNav) {
        $pathPicture ="sources/pictures/pictureTables/";
        $dataValidTable = $this->getTables (1);
        echo '<style>';
        foreach($dataValidTable as $value) {
            echo '#hiddenForm'.$value['PositionTable'].' {
                padding:0.5em;
                top: 15%;
                left: 55%;
                background-color: var(--main-background-MagicForm);
                -webkit-box-shadow: var(--main-shadow);
                box-shadow: var(--main-shadow);
                position: absolute;
                width: auto;
                display: none;
                border: var(--main-border);
                border-radius: var(--main-radius);
                z-index: 2;
              }
              #magic'.$value['PositionTable'].'{
              }';
        }
        echo '</style>';
        echo '<div class="flex-colonne-left">';
        foreach($dataValidTable as $value) {
            $valueNumber = round(log($value['max']))+2;
            echo '<div>
            <button type="button" id="magic'.$value['PositionTable'].'" class="open">Ouvrir la table '.$value['name'].'</button>
            </div>
            <div id="hiddenForm'.$value['PositionTable'].'" class="flex-rows">';
            echo'<aside>
                    <ul>';
                    $dataReserve = $this->getReservedDateOfTable($value['id']);
                    foreach($dataReserve as $valeur){
                        echo '<li>Réservé le '.formatDateHeureFr($valeur['dateReserve']).' jusqu\'a '.justHeureFr($valeur['endOfReserve']).' </li>';
                    }
                    echo '</ul>
                </aside>';
        echo '<form class="flex-colonne-form" action="'.encodeRoutage(50).'" method="post">
                <h3 class="subTitleSite">Table '.$value['name'].'</h3>
                <img class="modal" src="'.$pathPicture.$value['pictureOfTable'].'" alt=".'.$value['name'].'."/>
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
                echo '<div>Fermeture le '.$this->dayOfWeek[$value['dayOfWeekW']].'</div>';
            }
        }
       
    }

}