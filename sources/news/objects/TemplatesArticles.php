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
        if($dataLastArticle) {
            echo'<div class="indexArticle">
                    <div class="pictureNews"><img class="imgNews" src="'.$this->pictureDirectory.$dataLastArticle[0]['picture'].'" alt="'.$dataLastArticle[0]['title'].'"/></div>
                    <div class="textNews"><p>'.$dataLastArticle[0]['text'].'</p></div>
                    <div class="TitleNews"><h3 class="subTitleSite">'.$dataLastArticle[0]['title'].'</h3>
                        <p>Le '.brassageDate($dataLastArticle[0]['creat_date']).'</p>
                    </div>
                </div>';
        } else {
            echo 'No article';
        }
        
    }
}