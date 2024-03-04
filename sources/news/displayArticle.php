<?php 
require('objects/TemplatesArticles.php');
$lastArticle = new TemplateArticle();
$displayArticle = $lastArticle->displayLastArticle();