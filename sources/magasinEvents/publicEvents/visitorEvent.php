<?php
require('sources/magasinEvents/objects/TemplateEvents.php');
$publicEvent = new TemplateEvents ();
$publicNextEvent = $publicEvent->displayEventPublic();
$publicEvent->archiveEvent();