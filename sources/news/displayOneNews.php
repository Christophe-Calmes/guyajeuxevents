<?php 
require('sources/news/objects/TemplatesArticles.php');
$readOneArticle = new TemplateArticle();
$idArticle = filter($_GET['idArticle']);
$dataOneArticle = $readOneArticle->adminArticle($idArticle, $idNav);
