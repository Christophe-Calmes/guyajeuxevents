<?php
require('sources/Dashboards/objects/SQLDashboard.php');
require ('sources/reserveTablesByUser/objects/SQLAcessReserTables.php');
require('functions/functionDateTime.php');
Class TemplateDashboard extends SQLDashboard {
    function displayDashboardConsommations () {
       $dataDashboard = $this-> dataDashboard ();
       echo '<h3 class="subTitleSite">Type de consommations par jour :</h3>';
       echo '<div class="gallery">';
       foreach($dataDashboard as $value) {
        echo '<div class="item">';
            echo '<p class="titleEventItem displayDate">'.brassageDate($value['DDay']).'</p>';
            echo '<p>'.$value['name_Consommation'].'</p><p> nombre de personne lié : '.$value['number_Personnes_Consommation'].' </p>';
            echo '<p>Nombre de table lié : '.$value['number_Consommation'].'</p>';
        echo '</div>';
        }
       echo '</div>';

    }
    public function dashboardChairDayByDay() {
        $chairs = new SQLAcessReserTables ();
        $dataChairs = $chairs->readNumberOfChair ();
        $totalChairs = $dataChairs[0]['numberOfChair'];
        $dataBookingChair = $this->numberOfchairReserved ();
        echo '<h3 class="subTitleSite">Chaises réservées :</h3>';
        echo '<div class="flex-rows-simple">';
        foreach($dataBookingChair as $value) {
            echo '<aside class="titleEventItem displayDate">'.brassageDate($value['DDay']).'</li>';
            echo '<ul>';
                echo '<li class="subTitleSite">Nombre de chaises réservées</li>';
                echo '<li>10h - 12h : '.$value['Morning'].'/'.$totalChairs.' </li>';
                echo '<li>14h - 19h : '.$value['Afternoon'].'/'.$totalChairs.'</li>';
                echo '<li>19h - 00h : '.$value['Nigth'].'/'.$totalChairs.'</li>';
            echo '</ul>';
            echo '</aside>';
        }
        echo '</div>';
    }
    public function mamagementPurchase () { 
        $dataPurchase = $this->forecastInventoryManement ();
        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $DDay = $date->format('d F');
        $date->add(new DateInterval('P7D'));
        $D7Day = $date->format('d F');
        echo '<article class="flex-colonne paddingLeft">';
        echo '<h3 class="subTitleSite">Prévision type de consommation du '.BrassageDate($DDay).' au '.BrassageDate($D7Day).'</h3>';
        foreach($dataPurchase as $value) {
            echo '<h4 class="subTitleSite">'.$value['name_Consommation'].'</h4>
            <p> Personnes / tables : '.$value['total_Personnes_Consommation'].' / '.$value['number_Consommation'].'</p>';
        }
        echo '</article>';
    }
}