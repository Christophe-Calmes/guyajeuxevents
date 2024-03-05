<?php
Class SQLAcessNews {
    protected function displayOneArticle($idArticle) {
        $select = "SELECT `id`, `id_author`, `title`, `text`, `creat_date`, `update_date`, `publish`, `picture`, `valid` 
        FROM `guyaEvents`.`articles`
        INNER JOIN `guyagraines`.`users` ON `articles`.`id_author` = `users`.`idUser`
        WHERE `id` = :idArticle";
    $param = [['prep'=>':idArticle', 'variable'=>$idArticle]];
          return ActionDB::select($select, $param, 1);
    }
    protected function selectLastArticle(){
        $select="SELECT `title`, `text`, `creat_date`, `picture` 
        FROM `articles` 
        WHERE `publish`=1 AND `valid`=1 ORDER BY `creat_date` DESC LIMIT 1";
        return ActionDB::select($select, [], 1);
    }
}