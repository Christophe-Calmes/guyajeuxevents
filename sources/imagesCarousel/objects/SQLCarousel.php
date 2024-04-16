<?php
Class SQLCarousel {
    protected $picturePath;
    public function __construct()
    {
        $this->picturePath = 'sources/pictures/picturesCarousel/';        
    }
    public function nbrValidPicture () {
        $select = "SELECT count(`id`) as `nbrPicture` 
        FROM `shopPicture` 
        WHERE `valid` = 1;";
        $dataNumber = ActionDB::select($select, [], 1);
        return $dataNumber[0]['nbrPicture'];
    }
    protected function dataAdminPicture ($premier, $parPage) {
        $select ="SELECT `id`, `pictureName`, `legend`, `date_creat`, `date_update`, `orderPicture`, `valid` 
        FROM `shopPicture` 
        ORDER BY `orderPicture` ASC 
        LIMIT {$premier}, {$parPage};";
    
        return ActionDB::select($select, [], 1);
    }
    public function deletePicture ($idPicture, $param) {
        $delete = "DELETE FROM `shopPicture` WHERE `id`=:id";
        ActionDB::access($delete, $param, 1);
    }
    public function getpictureName ($idPicture) {
        $select = "SELECT `pictureName` 
        FROM `shopPicture` 
        WHERE `id` = :id;";
        $param = [['prep'=>':id', 'variable'=>$idPicture]];
        $data = ActionDB::select($select, $param, 1);
        if(!empty($data)) {
            return $data[0]['pictureName'];
        } else {
            return false;
        }
    }
    public function updatePicture ($param) {
        $update = "UPDATE `shopPicture` SET 
        `legend`=:legend,
        `date_update`=CURRENT_TIMESTAMP,
        `orderPicture`=:orderPicture,
        `valid`=:valid
        WHERE `id` = :id";
        return ActionDB::access($update, $param, 1);
    }
    public function firstPicture () {
        $select = "SELECT  `pictureName`, `legend`
        FROM `shopPicture` 
        WHERE `valid`= 1 
        ORDER BY `orderPicture` ASC 
        LIMIT 1;";
        return ActionDB::select($select, [], 1);
    }
    public function listPictureJS () {
        $select = "SELECT `pictureName`, `legend` 
        FROM `shopPicture` 
        WHERE `valid` = 1 
        ORDER BY`orderPicture`;";
        $dataPicture = ActionDB::select($select, [], 1);
        foreach($dataPicture as $key =>$value) {
            $dataPicture [$key]['pictureName'] = $this->picturePath.$value['pictureName'];
        }
        return $dataPicture;
    }
}