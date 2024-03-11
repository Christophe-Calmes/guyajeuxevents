<?php
Class SQLAcessReserTables {
    protected function scheduleShop () {
        $select = "SELECT `dayOfWeekW`, `openMorning`, `closeMorning`, `openAfternoon`, `closeAfternoon`, `closeDay` FROM `shopOpeingHours`;";
        return ActionDB::select($select, [], 1);
    }
    public function openCloseDayShop($openOrClose, $dayOfWeek) {
        $update = "UPDATE `shopOpeingHours` SET `closeDay` = :closeDay WHERE `dayOfWeekW` = :dayOfWeekW";
        $param = [['prep'=>':closeDay', 'variable'=>$openOrClose],
                ['prep'=>':dayOfWeekW', 'variable'=>$dayOfWeek]];
        return ActionDB::access($update, $param, 1);
    }
    public function changeSchedulingShop($param){
        $update="UPDATE `shopOpeingHours` SET `openMorning`=:openMorning,`closeMorning`=:closeMorning,`openAfternoon`=:openAfternoon,`closeAfternoon`=:closeAfternoon,`closeDay`=:closeDay WHERE `dayOfWeekW` = :dayOfWeekW;";
        return ActionDB::access($update, $param, 1);
    }
}
