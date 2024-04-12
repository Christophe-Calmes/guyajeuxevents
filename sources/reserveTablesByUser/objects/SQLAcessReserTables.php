<?php
function testScheduling ($time, $interval, $cas) {
    switch ($cas) {
        case 1:
            if($time >= $interval) {
                return 1;
            } else {
                return 0;
            }
        case 2:
            if($time <= $interval) {
                return 1;
            } else {
                return 0;
            }
    }
}
Class SQLAcessReserTables {
    protected function scheduleShop () {
        $select = "SELECT `dayOfWeekW`, `openMorning`, `closeMorning`, `openAfternoon`, `closeAfternoon`, `closeDay` FROM `shopOpeingHours`;";
        return ActionDB::select($select, [], 1);
    }
    public function openCloseDayShop ($openOrClose, $dayOfWeek) {
        $update = "UPDATE `shopOpeingHours` SET `closeDay` = :closeDay WHERE `dayOfWeekW` = :dayOfWeekW";
        $param = [['prep'=>':closeDay', 'variable'=>$openOrClose],
                ['prep'=>':dayOfWeekW', 'variable'=>$dayOfWeek]];
        return ActionDB::access($update, $param, 1);
    }
    public function changeSchedulingShop ($param){
        $update="UPDATE `shopOpeingHours` SET `openMorning`=:openMorning,`closeMorning`=:closeMorning,`openAfternoon`=:openAfternoon,`closeAfternoon`=:closeAfternoon,`closeDay`=:closeDay WHERE `dayOfWeekW` = :dayOfWeekW;";
        return ActionDB::access($update, $param, 1);
    }
    private function updateNumberOfChair () {
        $select ="SELECT SUM(`max`) AS `totalOfChair` FROM `gamesTables` WHERE `valid`=1;";
        $data =  ActionDB::select($select, [], 1);
        $param = [['prep'=>':numberOfChair', 'variable'=>$data[0]['totalOfChair']]];
        $insert ="INSERT INTO `maxOfChair`( `numberOfChair`) VALUES (:numberOfChair);";
        return ActionDB::access($insert, $param, 1);
    }
    public function readNumberOfChair () {
        $select = "SELECT `numberOfChair`, `dateCreat` FROM `maxOfChair` ORDER BY `dateCreat` DESC LIMIT 1;";
        return ActionDB::select($select, [], 1);
    }
    public function insertTable ($param) {
        $insert = "INSERT INTO `gamesTables`( `name`, `max`, `PositionTable`, `pictureOfTable`) VALUES (:name, :max, :PositionTable, :pictureOfTable)";
        ActionDB::access($insert, $param, 1); 
        return $this->updateNumberOfChair ();
    }
    protected function getTables ($valid) {
        $select="SELECT `id`, `name`, `max`, `PositionTable`, `pictureOfTable`, `valid` FROM `gamesTables` WHERE `valid`=:valid ORDER BY `PositionTable`;";
        $param= [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function getPictureOfTable ($id){
        $select="SELECT `pictureOfTable` FROM `gamesTables` WHERE `id` =:id;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        $namePicture =  ActionDB::select($select, $param, 1);
        return $namePicture[0]['pictureOfTable'];
    }
    public function updateTable ($param){
        $update="UPDATE `gamesTables` SET `name`=:name,`max`=:max,`PositionTable`=:PositionTable,`pictureOfTable`=:pictureOfTable,`valid`=:valid WHERE `id`=:id";
        ActionDB::access($update, $param, 1);  
        return $this->updateNumberOfChair ();
    }
    public function updateJusteTableNoPicture ($param) {
        $update="UPDATE `gamesTables` SET `name`=:name,`max`=:max,`PositionTable`=:PositionTable,`valid`=:valid WHERE `id`=:id";
        ActionDB::access($update, $param, 1);
        return  $this->updateNumberOfChair ();
    }
    protected function getConsommationByValid ($valid) {
        $select = "SELECT `id`, `name`, `valid` FROM `consommations` WHERE `valid` =  :valid ORDER BY `name` ;";
        $param= [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function insertNewConsommation ($param) {
        $insert = "INSERT INTO `consommations`(`name`) VALUES (:name)";
        ActionDB::access($insert, $param, 1);
    }
    public function inverseConsommation($id) {
        $select = "SELECT `valid` FROM `consommations` WHERE `id` = :id;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        $valid = ActionDB::select($select, $param, 1);
        if($valid[0]['valid'] == 1) {
            $update = "UPDATE `consommations` SET`valid`= 0 WHERE `id`=:id";
        } else {
            $update = "UPDATE `consommations` SET`valid`= 1 WHERE `id`=:id";
        }
        return ActionDB::access($update, $param, 1);
    }
    public function delInvalidConsommation($id) {
        $delete="DELETE FROM `consommations` WHERE `id`=:id AND `valid`=0;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        return ActionDB::access($delete, $param, 1);
    }
    protected function getActivityByValid ($valid) {
        $select = "SELECT `id`, `name`, `valid` FROM `activity` WHERE `valid` =  :valid ORDER BY `name` ;";
        $param= [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function insertNewActivity ($param) {
        $insert = "INSERT INTO `activity`(`name`) VALUES (:name)";
        ActionDB::access($insert, $param, 1);
    }
    public function inverseValidActivity($id) {
        $select = "SELECT `valid` FROM `activity` WHERE `id` = :id;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        $valid = ActionDB::select($select, $param, 1);
        if($valid[0]['valid'] == 1) {
            $update = "UPDATE `activity` SET`valid`= 0 WHERE `id`=:id";
        } else {
            $update = "UPDATE `activity` SET`valid`= 1 WHERE `id`=:id";
        }
        return ActionDB::access($update, $param, 1);
    }
    public function delInvalidActivity($id) {
        $delete="DELETE FROM `activity` WHERE `id`=:id AND `valid`=0;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        return ActionDB::access($delete, $param, 1);
    }
    protected function abstractParam($tableName) {
        $select ="SELECT `id`, `name`, `valid` FROM `{$tableName}` WHERE `valid`=1 ORDER BY `name`";
        return ActionDB::select($select, [], 1);
    }
    private function weekOfDay($dateTime){
        $date = new DateTime($dateTime);
        return $date->format('w');
    }
    private function openingDay($dayOfWeek){
        $select="SELECT `closeDay` FROM `shopOpeingHours` WHERE `dayOfWeekW` = :dayOfWeekW;";
        $param =[['prep'=>':dayOfWeekW', 'variable'=>$dayOfWeek]];
        $data = ActionDB::select($select, $param, 1);
        if($data[0]['closeDay']==0) {
            return true;
        } else {
            return false;
        }
    }
    public function schedulingIntervall($dayOfWeek, $dateTime) {
        $select ="SELECT `openMorning`, `closeMorning`, `openAfternoon`, `closeAfternoon` FROM `shopOpeingHours` WHERE `dayOfWeekW` = :dayOfWeekW;";
        $param =[['prep'=>':dayOfWeekW', 'variable'=>$dayOfWeek]];
        $data = ActionDB::select($select, $param, 1);
        $Reserve = new DateTime($dateTime);
        $time = $Reserve->format("H:i:s");
        $mark = [1, 1];
        $controles = array();
        if($time <= $data[0]['closeMorning']) {
            array_push($controles, testScheduling ($time, $data[0]['openMorning'], 1));
            array_push($controles, testScheduling ($time, $data[0]['closeMorning'], 2)); 
        } 
        if($time >= $data[0]['openAfternoon']) {
            array_push($controles, testScheduling ($time, $data[0]['openAfternoon'], 1));
            array_push($controles, testScheduling ($time, $data[0]['closeAfternoon'], 2));
        }
        if($time < $data[0]['openMorning'] ) {
            $controles = [3, 3];
        }
        if($time > $data[0]['closeAfternoon'] ) {
            $controles = [4, 4];
        }
        if(($time > $data[0]['closeMorning'])&&($time < $data[0]['openAfternoon'])) {
            $controles = [5, 5];
        }
        if($controles == $mark) {
            return 1;
        } else {    
            return 0;
        }
    }
    public function controleDoublonReservation($idTable, $dateReserve, $endOfReserve){
        $select="SELECT COUNT(id) AS `total`
        FROM `reserveTables` 
        WHERE `idTable`= :idTable AND `valid`=1  AND `dateReserve` <= :dateReserve AND `endOfReserve`>= :endOfReserve;";
        $param=[['prep'=>':idTable', 'variable'=>$idTable],
            ['prep'=>':dateReserve', 'variable'=>$dateReserve],
            ['prep'=>':endOfReserve', 'variable'=>$endOfReserve],];
        $data = ActionDB::select($select,$param,1);
        if($data[0]['total'] == 0) {
            return 0;
        } else {
            return 1;
        }
    }
    public function getReservedDateOfTable($idTable) {
        $select="SELECT `dateReserve`, `endOfReserve`
        FROM `reserveTables`
        WHERE `idTable`=:idTable AND `reserveTables`.`valid`=1
        ORDER BY `dateReserve`;";
        $param=[['prep'=>':idTable', 'variable'=>$idTable],];
        return ActionDB::select($select, $param, 1);
    }
    public function checkAReserveDate($dateTime) {
        $dayOfWeek = $this->weekOfDay($dateTime);
        $opening = $this->openingDay($dayOfWeek);
        if($opening) {
            return $this->schedulingIntervall($dayOfWeek, $dateTime);
        } else {
            return $opening;
        }
        
    }
    public function addReservedTableByUser($param){
            $insert = "INSERT INTO `reserveTables`
            ( `idUser`, `idTable`, `numberPeople`, `comment`, `dateReserve`, `endOfReserve`, `idActivity`, `idConsommation`) 
            VALUES 
            (:idUser, :idTable, :numberPeople, :comment, :dateReserve, :endOfReserve, :idActivity, :idConsommation)";
        ActionDB::access($insert, $param, 1);
    }
    private function dateOfLastDay() {
        $dateOfTheDay = new DateTime();
        $dateOfTheDay = $dateOfTheDay->modify('-24 hours');
        $date = $dateOfTheDay->format('Y-m-d H:i');
        return $date;
    }
    public function archiveReserveOfTable() {
        $update = "UPDATE `reserveTables` 
        SET `valid`=0 
        WHERE `endOfReserve`<DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY);";
        return ActionDB::access($update, [], 1);
    }
    public function trashArchiveOfBooking() {
        /*$delete = "DELETE FROM `reserveTables`
        WHERE `dateReserve`<DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)";*/
        $delete = "DELETE FROM `reserveTables` WHERE `endOfReserve` < DATE_ADD(NOW(), INTERVAL -6 HOUR);";
        return ActionDB::access($delete, [], 1);
    }
    public function nameOfTable($idTable) {
        $select = "SELECT `name` FROM `gamesTables` WHERE `id`=:idTable";
        $param=[['prep'=>':idTable', 'variable'=>$idTable],];
        $name =  ActionDB::select($select, $param, 1);
        return $name[0]['name'];
    }
    protected function bookingOneUser($idUser, $valid){
        $select = "SELECT `reserveTables`.`id`, `idUser`, `idTable`, `gamesTables`.`name` AS `nameTable` ,`dateCreat`, `pictureOfTable`, 
        `dateUpdate`, `numberPeople`, `comment`, `dateReserve`, 
        `endOfReserve`, `idActivity`, `activity`.`name` AS `nameActivity`, `idConsommation`, `consommations`.`name` AS `nameConsommation`, `reserveTables`.`valid` 
        FROM `reserveTables`
        INNER JOIN `activity` ON `activity`.`id`=`idActivity`
        INNER JOIN `consommations` ON `consommations`.`id`=`idConsommation`
        INNER JOIN `gamesTables` ON `gamesTables`.`id`=`idTable`
        WHERE `gamesTables`.`valid` = 1 AND `idUser`=:idUser AND `reserveTables`.`valid`=:valid AND `dateReserve`>=:dateOfday;";
             $dateOfTheDay = new DateTime();
             $date = $dateOfTheDay->format('Y-m-d H:i');
        $param =[['prep'=>':idUser', 'variable'=>$idUser],
                 ['prep'=>':dateOfday', 'variable'=>$date],
                ['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);   
    }
    public function delReservationByUser($param) {
       $delete = "DELETE FROM `reserveTables` WHERE `id`=:id AND `idUser`=:idUser";
       return ActionDB::access($delete, $param, 1); 
    }
    public function getNumberOfReservationsTables($valid) {
        $date = $this->dateOfLastDay();
        $countReserve ="SELECT COUNT(`id`) AS `numberReserveTables` FROM `reserveTables` WHERE `valid`= :valid AND `dateReserve`>:dateReserve;";
        $param = [['prep'=>':valid', 'variable'=>$valid],
        ['prep'=>':dateReserve', 'variable'=>$date]];
        $dataCount = ActionDB::select($countReserve, $param, 1);
        return $dataCount[0]['numberReserveTables'];
    }
    protected function getReservationsTables($firstPage, $byPages, $valid) {
        $select = "SELECT `reserveTables`.`id`, `reserveTables`.`idUser`, `idTable`, `reserveTables`.`dateCreat`, `reserveTables`.`dateUpdate`, `numberPeople`, `comment`, `dateReserve`, `endOfReserve`, `idActivity`, `idConsommation`, `reserveTables`.`valid`,
        `gamesTables`.`name` AS `nameTable`, `pictureOfTable`, 
        `activity`.`name` AS `nameActivity`,
        `consommations`.`name` AS `nameConsommation`,
        `prenom`, `nom`, `login`, `idEvent`
        FROM `reserveTables`
        INNER JOIN `activity` ON `activity`.`id`=`idActivity`
        INNER JOIN `consommations` ON `consommations`.`id`=`idConsommation`
        INNER JOIN `gamesTables` ON `gamesTables`.`id`=`idTable`
        INNER JOIN `guyagraines`.`users` ON `reserveTables`.`idUser` = `guyagraines`.`users`.`idUser`
        WHERE `gamesTables`.`valid` = 1 AND `reserveTables`.`valid`= :valid
        ORDER BY `dateReserve` LIMIT {$firstPage}, {$byPages};";
        $param= [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    protected function getTitleEvent ($idEvent) {
        $select = "SELECT  `title` FROM `internalEvents` WHERE `id` = :idEvent";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        $data = ActionDB::select($select, $param, 1);
        return $data[0]['title'];

    }
    public function cancelBookingTableByAdmin($id) {
        $update = "UPDATE `reserveTables` SET `valid`= 0 WHERE `id`= :id";
        $param = [['prep'=>':id', 'variable'=>$id]];
        return ActionDB::access($update, $param, 1);
    }
    public function BookingInProgress($idUser) {
        $param=[['prep'=>':idUser','variable'=>$idUser]];
        $selectRole = "SELECT`role` FROM `users` WHERE `idUser` = :idUser";
        $userRole = ActionDB::select($selectRole, $param, 0);
        if($userRole[0]['role'] == 3) {
            $limit = 180;
        } else {
            $limit = 12;
        }
        $select = "SELECT COUNT(`id`) AS `totalOfBooking` FROM `reserveTables` WHERE `idUser` = :idUser AND `valid` = 1;";
        $countBooking = ActionDB::select($select, $param, 1);
        if($countBooking[0]['totalOfBooking'] > $limit) {
            return 1;
        } else {
            return 0;
        }
    }
    public function numberBookingInProgress($idUser) {
        $param=[['prep'=>':idUser','variable'=>$idUser]];
        $select = "SELECT COUNT(`id`) AS `totalOfBooking` FROM `reserveTables` WHERE `idUser` = :idUser AND `valid` = 1;";
        $countBooking = ActionDB::select($select, $param, 1);
        return $countBooking[0]['totalOfBooking'];
    }
    public function delReservedTableInEventCase ($startEvent, $endEvent, $idTable) {
        $param = [['prep'=>':dateReserve', 'variable'=>$startEvent],
                    ['prep'=>':endOfReserve', 'variable'=>$endEvent],
                    ['prep'=>':idTable', 'variable'=>$idTable]];
        $delete = "DELETE FROM `reserveTables`
        WHERE (
            `dateReserve` BETWEEN :dateReserve AND :endOfReserve
            OR `endOfReserve` BETWEEN :dateReserve AND :endOfReserve
            OR (:dateReserve BETWEEN `dateReserve` AND `endOfReserve`)
            OR (:endOfReserve BETWEEN `dateReserve` AND `endOfReserve`)
        )
        AND `idTable` = :idTable;";
        return ActionDB::access($delete, $param, 1);
    }
    public function numberOfChairOfOneTable($idTable) {
        $select = "SELECT `max` FROM `gamesTables` WHERE `id` = :idTable";
        $param = [['prep'=>':idTable', 'variable'=>$idTable]];
        $dataMax = ActionDB::select($select, $param, 1);
        return $dataMax[0]['max'];
    }
    public function affectedIdEvent($param) {
        $update = "UPDATE `reserveTables` 
                SET `idEvent`=:idEvent 
                WHERE `idTable` = :idTable 
                AND`idUser`=:idUser 
                AND `dateReserve`=:dateReserve 
                AND `endOfReserve`=:endOfReserve";
        return ActionDB::access($update, $param, 1);
    }
    public function sortTableEvent ($idEvent) {
        $select = "SELECT  `idTable`
        FROM `reserveTables` 
        WHERE `idEvent` = :idEvent;";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        return ActionDB::select($select, $param, 1);
    }
    public function deleteTableEvent ($idEvent) {
        $delete = "DELETE FROM `reserveTables` WHERE `idEvent`=:idEvent;";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        return ActionDB::access($delete, $param, 1);
    }
    protected function selectAllMembres() {
        $sql = new SelectRequest(['idUser', 'prenom', 'nom', 'login'],
                                 'users', [
                                    ['champs'=>'role', 'operator'=>'=', 'param'=>1],
                                    ['champs'=>'valide', 'operator'=>'=', 'param'=>1]]);
        $select = $sql->requestSelect(0);
        return ActionDB::select($select, []);
    }
    public function affectedTableForUser($param) {
        $update = "UPDATE `reserveTables` SET `idUser`=:idUser WHERE `id`=:id";
        return ActionDB::access($update, $param, 1);
    }
}