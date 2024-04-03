<?php
function frenchDate($data) {
    if($data === null) {
        return 'No date';
    }
        setlocale(LC_ALL, "fr_FR");
        $dateDay = new DateTime($data);
        $formatter = new IntlDateFormatter(
        "fr_FR",
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE
    );
    return $formatter->format($dateDay);
}
Class SendEmailForReservedTable extends FindEmail {
    private $idUser;
    private $dateBooking;
    private $clearDate;
    private $header;
    private $idTable;
    public function __construct($idUser, $dateBooking , $idTable)
    {
        $this->idUser = $idUser;
        $this->dateBooking = $dateBooking;
        $this->clearDate = frenchDate($this->dateBooking);
        $this->header = 'From: no-reply@guyajeux.com';
        $this->idTable = $idTable;
    }
    private function findNameOfTable () {
        $param = [['prep'=>':idTable', 'variable'=>$this->idTable]];
        $select = "SELECT  `name` 
        FROM `gamesTables` 
        WHERE `valid` =1 AND `id`=:idTable";
        $dataNameTable = ActionDB::select($select, $param, 1);
        if(!empty($dataNameTable)){
            return $dataNameTable[0]['name'];
        } else {
            return false;
        }
    }
    public function sendEmailBookingTable($statusBooking) {
        $to = $this->findEmailToUserId ($this->idUser);
        $nameTable = $this->findNameOfTable ();
        if(!empty($to)&&(!empty($nameTable))) {
            if($statusBooking) {
                $message = 'Vous avez réserver la table '.$nameTable.'Pensez à le noter dans votre agenda.';
                    
            } else {
                $message = 'La réservertion de la table '.$nameTable.' a été annulé. Pensez à le noter dans votre agenda.';
            }
            $objet = 'Réservation guyajeux table'.$nameTable;
            return mail($to, $objet, $message, $this->header);
        } else {
            return false;
        }

    }

}