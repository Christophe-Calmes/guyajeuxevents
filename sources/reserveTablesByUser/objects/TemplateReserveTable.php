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
        echo '<form action="'.encodeRoutage(45).'" method="post">';
        echo '<input type="hidden" name="id" value="'.$value['id'].'"/>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$buttonMessage.'</button>';
        echo '</form>';
      }

    }

    public function displayTableForUser ($idNav) {
        $dataValidTable = $this->getTables (1);
        print_r($dataValidTable);
        echo '<style>';
        foreach($dataValidTable as $value) {
            echo '#hiddenForm'.$value['PositionTable'].' {
                padding-top: 0.5em;
                padding-bottom: 0.2em;
                top: 35%;
                left: 35%;
                background-color: var(--main-background-MagicForm);
                -webkit-box-shadow: var(--main-shadow);
                box-shadow: var(--main-shadow);
                position: absolute;
                width: 30%;
                display: none;
                /* border: 1px solid black; */
                border: var(--main-border);
                border-radius: var(--main-radius);
                z-index: 2;
              }
              #magic'.$value['PositionTable'].'{

              }';
        }
        echo '</style>';

        foreach($dataValidTable as $value) {
            echo '<div>
            <button type="button" id="magic'.$value['PositionTable'].'" class="open">Ouvrir '.$value['name'].'</button>
            </div>
            <div id="hiddenForm'.$value['PositionTable'].'">
                <form action="'.encodeRoutage(44).'" method="post">
                    <input type="hidden" name="idTable" value="'.$value['id'].'"/>
                    <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Inscription</button>
                </form>
            </div>';
        }
        echo '<script type="text/javascript" defer>';
        foreach($dataValidTable as $value) {
           
            echo 'let jeckyl'.$value['id'].' = document.getElementById("magic'.$value['PositionTable'].'");
            let magax'.$value['id'].' = document.getElementById("hiddenForm'.$value['PositionTable'].'");
            let open'.$value['PositionTable'].' = false;
            jeckyl'.$value['id'].'.addEventListener("click", function(){
              if(!open'.$value['PositionTable'].') {
                jeckyl'.$value['id'].'.innerText = "Fermer '.$value['name'].'";
                magax'.$value['id'].'.style.display = "block";
                open'.$value['PositionTable'].' = true;
              } else {
                jeckyl'.$value['id'].'.innerText = "Ouvrir '.$value['name'].'";
                magax'.$value['id'].'.style.display = "none";
                open'.$value['PositionTable'].' = false;
              }

              return open'.$value['PositionTable'].';
            });';
         
        }
        echo '</script>';
    }

}