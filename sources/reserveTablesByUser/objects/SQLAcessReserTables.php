<?php
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
    protected function readNumberOfChair () {
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
    public function insertNewActivity ($param) {
        $insert = "INSERT INTO `activity`(`name`) VALUES (:name)";
        ActionDB::access($insert, $param, 1);
    }
    protected function getActivityByValid ($valid) {
        $select = "SELECT `id`, `name`, `valid` FROM `activity` WHERE `valid` =  :valid ORDER BY `name` ;";
        $param= [['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
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
}
