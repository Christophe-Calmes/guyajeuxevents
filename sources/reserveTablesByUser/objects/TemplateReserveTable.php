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
}