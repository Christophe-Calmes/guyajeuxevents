<?php 
Class SQLEvents {
    protected function nextEvent () {
       $select = "SELECT  `dateEvent`, `title`, `description`, `picture`, `contribution`, `numberMax`
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
}