<?php
Class SQLCarousel {
    public function nbrValidPicture () {
        $select = "SELECT count(`id`) as `nbrPicture` 
        FROM `shopPicture` 
        WHERE `valid` = 1;";
        $dataNumber = ActionDB::select($select, [], 1);
        return $dataNumber[0]['nbrPicture'];
    }
    protected function dataAdminPicture() {
        
    }
}