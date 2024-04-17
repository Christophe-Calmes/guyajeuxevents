<?php
Class SecuringConnections {
    
    private $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function ipIsProhibited () {
        $count = "SELECT COUNT(`id`) AS `nbrOfBan` FROM `banIP` WHERE `BanIP` = :banIP;";
        $param = [['prep'=>':banIP', 'variable'=>$this->ip]];
        $dataCount = ActionDB::select($count, $param, 0);
        $nbrBan = $dataCount[0]['nbrOfBan'];
        if($nbrBan == 0) {
            return false;
        }
        return true;
    }
    public function BanIP () {
        $count = "SELECT COUNT(`idConnexion`) AS `nbrConnexionFail` 
        FROM `journaux` 
        WHERE `ipUser` = :ipUser 
        AND `idUser` = 0 
        AND `okConnexion` = 0";
        $param = [['prep'=>':ipUser', 'variable'=>$this->ip]];
        $dataCount = ActionDB::select($count, $param, 0);
        $nbrFailConnection = $dataCount[0]['nbrConnexionFail'];
        if($nbrFailConnection >= 5) {
            $insert = "INSERT INTO `banIP`(`BanIP`) VALUES (:ipUser)";
            ActionDB::access($insert, $param, 0);
            return true;
        } 
        return false;
    }
}
