<?php
Class SendEmailForEvent extends FindEmail {
    private $idEvent;
    private $param;
    private $idUser;
    private $header;
    public function __construct($idUser, $idEvent)
    {
        $this->idEvent = $idEvent;
        $this->param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        $this->idUser = $idUser;
        $this->header = 'From: no-reply@guyajeux.com';
    }
    private function findTitleEvent(){
        $select = "SELECT `dateEvent`,  `title` 
        FROM `internalEvents` 
        WHERE `id` = :idEvent 
        AND `valid` = 1 
        AND `archive` = 0;";
        return ActionDB::select($select, $this->param, 1);
    }
    public function sendEventEmail($statusEvent) {
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
        // $statusEvent = true => subscribe, false => unsibscribe
        $dataEvent = $this->findTitleEvent();
        if(!empty($dataEvent)) {
            $to = $this->findEmailToUserId($this->idUser);
            if(!empty($to)) {
                $objet = $dataEvent[0]['title'];
                $dateEvent = frenchDate($dataEvent[0]['dateEvent']);
                if($statusEvent) {
                    $message = "Vous êtes inscrit à l'événement {$dataEvent[0]['title']} le {$dateEvent}. 
                    Pensez à le noter dans votre agenda.";
                } else {
                    $message = "Vous êtes désinscrit à l'événement {$dataEvent[0]['title']} le {$dateEvent}. 
                    Pensez à le noter dans votre agenda.";
                }
                return mail($to, $objet, $message, $this->header);
            } else {
                return false;
            }
            
        } else {
            return false;
        } 
    }
}