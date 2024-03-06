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
}