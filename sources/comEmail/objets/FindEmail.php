<?php
Class FindEmail {

    protected function findEmailToUserSession($session) {
        $param = [['prep'=>':token', 'variable'=>$session['tokenConnexion']]];
        $select = "SELECT  `email` 
        FROM `users` 
        WHERE `token`=:token AND `valide`=1 AND `role`=1";
        $DataEmail = ActionDB::select($select, $param, 0);
        if($DataEmail != []){
            return $DataEmail[0]['email'];
        } else {
            return false;
        }
    }
    protected function findEmailToUserId($idUser) {
        $param = [['prep'=>':idUser', 'variable'=>$idUser]];
        $select = "SELECT  `email` 
        FROM `users` 
        WHERE `idUser`=:idUser AND `valide`=1 AND `role`=1";
        $DataEmail = ActionDB::select($select, $param, 0);
        if($DataEmail != []){
           return $DataEmail[0]['email'];
        } else {
            return false;
        } 
    }
    public function findInfoUserByReservedTable($idBooking) {
        $select = "SELECT `idUser`, `idTable`,`dateReserve` 
                    FROM `reserveTables` 
                    WHERE `id` = :id AND `valid` = 1";
        $param = [['prep'=>':id', 'variable'=>$idBooking]];
        return ActionDB::select($select, $param, 1);
    }
}

