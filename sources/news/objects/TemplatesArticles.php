<?php
require('SqlAcessNews.php');
require('functions/functionDateTime.php');
Class TemplateArticle extends SQLAcessNews {
    public $pictureDirectory;
    public function __construct()
    {
        $this->pictureDirectory = 'sources/pictures/picturesNews/';
    }
    public function displayLastArticle() {
        $dataLastArticle=$this->selectLastArticle();
       $text = str_replace('ulStart','<ul class="listClass">',$dataLastArticle[0]['text']);
       $textBR = str_replace('*', '<br/>', $text);
       $stepUl = str_replace('ulEnd','</ul>',$textBR);
       $stepLI = str_replace('listStart','<li>', $stepUl);
       $setpEndLI = str_replace('liEnd','</li>', $stepLI);
       $stepStrong = str_replace('strongStart', '<strong class="dayweek">', $setpEndLI);
       $finalText = str_replace('EndStrong', ' </strong>', $stepStrong);
      
        if($dataLastArticle) {
            echo'<div class="indexArticle">
            <div class="TitleNews"><h3 class="subTitleSite">'.$dataLastArticle[0]['title'].'</h3>
                    
            </div>
                    <div class="pictureNews"><img class="imgNews" src="'.$this->pictureDirectory.$dataLastArticle[0]['picture'].'" alt="'.$dataLastArticle[0]['title'].'"/></div>
                    <div class="textNews">
                    <p class="dateNews">Le '.brassageDate($dataLastArticle[0]['creat_date']).'</p>
                    <p class="styleListNews">'.$finalText.'</p>
                    </div>
              
                </div>';
        } else {
            echo 'No article';
        }
        
    }
}