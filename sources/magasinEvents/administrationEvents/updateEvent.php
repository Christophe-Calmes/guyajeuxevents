<?php
require('sources/magasinEvents/objects/TemplateEvents.php');
$idEvent = filter($_GET['idEvent']);
$event = new TemplateEvents ();
$event->templateUpdateEvent($idEvent, $idNav);