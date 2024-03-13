<?php
require('sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('functions/functionPresentationText.php');
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
                    <div class="maxTable">Maximum</div>
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
}