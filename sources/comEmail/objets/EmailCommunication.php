<?php
require('sources/comEmail/objets/FindEmail.php');
Class EmailCommunication extends FindEmail {
    private $objet;
    private $message;
    private $header;
public function __construct($objet, $message)
        {
            // objet => string objet du email
            // message => contenus du message
            $this->objet = $objet;
            $this->message = $message;
            $this->header = 'From: no-reply@guyajeux.com';
        }
    private function sendEmail ($emailRecipient) {
        return mail($emailRecipient, $this->objet, $this->message, $this->header);
    }
    public function sendSimpleEmailByIdUser($idUser) {
        $this->sendEmail($this->findEmailToUserId($idUser));
    }
    public function sendSimpleEmailByUserSession($session) {
        $this->sendEmail($this->findEmailToUserSession($session));
    }
}