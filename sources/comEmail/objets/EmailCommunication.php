<?php
Class EmailCommunication {
    private $objet;
    private $message;
    private $header;
public function __construct($objet, $message)
        {
            // objet => string objet du email
            // message => contenus du message
            $this->objet = $objet;
            $this->message = $message;
            $this->header = 'noreply@guyajeux.com';
        }
    private function sendEmail ($emailRecipient) {
        return mail($emailRecipient, $this->objet, $this->message, $this->header);
    }
    public function findAndSendAnEmailToUserSession($session) {
        $param = [['prep'=>':token', 'variable'=>$session['tokenConnexion']]];
        $select = "SELECT  `email` 
        FROM `users` 
        WHERE `token`=:token AND `valide`=1 AND `role`=1";
        $DataEmail = ActionDB::select($select, $param, 0);
        if($DataEmail != []){
            $this->sendEmail($DataEmail[0]['email']);
        } else {
            return false;
        }
    }
    public function findAndSendAnEmailToUserId($idUser) {
        $param = [['prep'=>':idUser', 'variable'=>$idUser]];
        $select = "SELECT  `email` 
        FROM `users` 
        WHERE `idUser`=:idUser AND `valide`=1 AND `role`=1";
        $DataEmail = ActionDB::select($select, $param, 0);
        if($DataEmail != []){
            $this->sendEmail($DataEmail[0]['email']);
        } else {
            return false;
        } 
    }
}

