<?php
require('SqlAcessNews.php');
require('functions/functionDateTime.php');
require('functions/functionPresentationText.php');
Class TemplateArticle extends SQLAcessNews {
    public $pictureDirectory;
    public function __construct()
    {
        $this->pictureDirectory = 'sources/pictures/picturesNews/';
    }
    public function displayLastArticle() {
        $dataLastArticle=$this->selectLastArticle();
        $finalText = listHTML($dataLastArticle[0]['text'], 'listClass');
        $finalText = lineBreak($finalText);
        $finalText = strongHTML($finalText);
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