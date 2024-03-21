<?php 
Class SQLEvents {
    protected function nextEvent () {
       $select = "SELECT  `id`, `dateEvent`, `title`, `description`, `picture`, `contribution`, `numberMax`
       FROM `internalEvents` 
       WHERE `publish` =1 AND `valid` = 1 AND `archive` = 0 
       ORDER BY `dateEvent` ASC 
       LIMIT 6";
       return ActionDB::select($select, [], 1);
    }
    public function countEvent ($archive, $valid) {
        $select = "SELECT COUNT(`id`) AS `numberOfEvent` 
        FROM `internalEvents`
        WHERE `archive`= :archive AND `valid`=:valid";
        $param = [['prep'=>':archive', 'variable'=>$archive],
                  ['prep'=>':valid', 'variable'=>$valid]];
        $dataNumber = ActionDB::select($select, $param, 1);
        return $dataNumber[0]['numberOfEvent'];
    }
    protected function readEventPagination($firstPage, $parPage, $archive, $valid) {
        $select="SELECT `id`, `dateCreat`, `dateUpdate`, `dateEvent`, `title`, `description`, 
        `picture`, `numberMax`, `contribution`, `publish`, `archive`, `valid`, `sucess`, 
        `prenom`, `nom`
        FROM `internalEvents`
        INNER JOIN `guyagraines`.`users` ON `internalEvents`.`idAuthor` = `guyagraines`.`users`.`idUser`
        WHERE `archive`= :archive AND `valid`=:valid
        ORDER BY `dateEvent` ASC
        LIMIT {$firstPage}, {$parPage};";
        $param = [['prep'=>':archive', 'variable'=>$archive],
                    ['prep'=>':valid', 'variable'=>$valid]];
        return ActionDB::select($select, $param, 1);
    }
    public function unvalidEvent($id) {
        $update ="UPDATE `internalEvents` SET `dateUpdate`= CURRENT_TIMESTAMP, `valid` = 0 WHERE `id`=:id";
        $param=[['prep'=>':id', 'variable'=>$id]];
        return ActionDB::access($update, $param, 1);
    }
    public function validEvent($id) {
        $update ="UPDATE `internalEvents` SET `dateUpdate`= CURRENT_TIMESTAMP, `valid` = 1 WHERE `id`=:id";
        $param=[['prep'=>':id', 'variable'=>$id]];
        return ActionDB::access($update, $param, 1);
    }
    protected function readOneEvent($id) {
        $select = "SELECT `id`, `idAuthor`, `dateCreat`, `dateUpdate`, `dateEvent`, `title`, 
        `description`, `picture`, `numberMax`, `contribution`, `publish`, `archive`, `valid`, 
        `sucess`, `prenom`, `nom`
        FROM `internalEvents`
        INNER JOIN `guyagraines`.`users` ON `internalEvents`.`idAuthor` = `guyagraines`.`users`.`idUser`
        WHERE `id` = :id;";
        $param=[['prep'=>':id', 'variable'=>$id]];
        return ActionDB::select($select, $param, 1);
    }
    public function getNamePictureEvent($id) {
        $select="SELECT `picture` 
        FROM `internalEvents` 
        WHERE `id`=:id";
        $param=[['prep'=>':id', 'variable'=>$id]];
        $namePicture = ActionDB::select($select, $param, 1);
        return $namePicture[0]['picture'];
    }
    protected function numberUserOnEvent($idEvent) {
        $select = "SELECT COUNT(`idUser`) AS `registrationTotal` FROM `reserveEvents` WHERE `idEvent`=:idEvent;";
        $param=[['prep'=>':idEvent', 'variable'=>$idEvent]];
        $namePicture = ActionDB::select($select, $param, 1);
        return $namePicture[0]['registrationTotal'];
    }
    protected function listRegistered($idEvent) {
        $select = "SELECT `login`, `guyagraines`.`users`.`idUser` 
        FROM `reserveEvents`
        INNER JOIN `guyagraines`.`users` ON `reserveEvents`.`idUser` = `users`.`idUser`
        WHERE `idEvent`= :idEvent
        ORDER BY `dateRegistration` ASC;";
        $param=[['prep'=>':idEvent', 'variable'=>$idEvent]];
        return  ActionDB::select($select, $param, 1);
    }
    public function userIsRegistredOnEvent ($idUser, $idEvent) {
        $select="SELECT COUNT(`idUser`) AS `total` 
        FROM `reserveEvents` 
        WHERE `idEvent`=:idEvent AND `idUser`=:idUser;";
        $param=[['prep'=>':idEvent', 'variable'=>$idEvent],
                ['prep'=>':idUser', 'variable'=>$idUser]];
        $data = ActionDB::select($select, $param, 1);
        if($data[0]['total'] == 1) {
            return true;
        } else {
            return false;
        }

    }
    public function signUpEventUser($param){
        $insert="INSERT INTO `reserveEvents`( `idEvent`, `idUser`) 
        VALUES (:idEvent, :idUser);";
        return ActionDB::access($insert, $param, 1);
    }
    public function unsubscribeUser($param){
        $insert="DELETE FROM `reserveEvents` 
        WHERE `idEvent`=:idEvent AND `idUser`=:idUser;";
        return ActionDB::access($insert, $param, 1);
    }
    protected function getSoldOut($idEvent) {
        $select="SELECT `numberMax`, COUNT(`idUser`) AS `total`
        FROM `internalEvents`
        INNER JOIN `reserveEvents` ON `reserveEvents`.`idEvent` = `internalEvents`.`id`
        WHERE `internalEvents`.`id`=:idEvent;";
        $param=[['prep'=>':idEvent', 'variable'=>$idEvent]];
        $totalAndNumberMax = ActionDB::select($select, $param, 1);
        if(($totalAndNumberMax[0]['numberMax'] <= $totalAndNumberMax[0]['total'])&&($totalAndNumberMax[0]['total'] !=0)){
            return false;
        } else {
            return true;
        }
    }
    public function delAdminUserEvent($idEvent, $idUser) {
        $delete="DELETE FROM `reserveEvents` WHERE `idEvent`=:idEvent AND `idUser`=:idUser";
        $param=[['prep'=>':idEvent', 'variable'=>$idEvent],
                ['prep'=>':idUser', 'variable'=>$idUser]];
        return ActionDB::access($delete, $param,1);
    }
    public function delAllUserOnOneEvent($id) {
        $delete="DELETE FROM `reserveEvents` WHERE `idEvent`=:idEvent;";
        $param=[['prep'=>':idEvent', 'variable'=>$id]];
        return ActionDB::access($delete, $param,1);
    }
    protected function selectAllTables() {
        $select ="SELECT `id`, `name`, `max` FROM `gamesTables` WHERE `valid` = 1;";
        return ActionDB::select($select, [], 1);
    }
}