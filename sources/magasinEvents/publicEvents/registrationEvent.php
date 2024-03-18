<?php
require('sources/magasinEvents/objects/TemplateEvents.php');
$publicEvent = new TemplateEvents ();
$publicEvent->registrationOneEvent($_SESSION, $idNav);
$publicEvent->archiveEvent();