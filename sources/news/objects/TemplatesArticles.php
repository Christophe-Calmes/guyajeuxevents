<?php
require('SqlAcessNews.php');
require('functions/functionDateTime.php');
require('functions/functionPresentationText.php');


Class TemplateArticle extends SQLAcessNews {
    public $pictureDirectory;
    public $yes;
    public function __construct()
    {
        $this->pictureDirectory = 'sources/pictures/picturesNews/';
        $this->yes = ['Non', 'Oui'];

    }
    protected function presentationText($data, $class) {
        $result = listHTML($data, $class);
        $result = lineBreak($result);
        $result = strongHTML($result);
        return $result;
    }
    public function displayLastArticle() {
        $dataLastArticle=$this->selectLastArticle();
        
        if($dataLastArticle) {
            $finalText = $this->presentationText($dataLastArticle[0]['text'], 'listClass');
            echo'<div class="indexArticle">
            <div class="TitleNews"><h3 class="subTitleSite">'.$dataLastArticle[0]['title'].'</h3>   
            </div>
                    <div class="pictureNews"><img class="imgNews" src="'.$this->pictureDirectory.$dataLastArticle[0]['picture'].'" alt="'.$dataLastArticle[0]['title'].'"/></div>
                    <div class="textNews">
                    <p class="styleListNews">'.$finalText.'</p>
                    </div>
                </div>';
        } else {
            echo 'No article';
        }
        
    }
    public function displayTableAdminNews($variable, $idNav) {
        echo '<div class="tableAdminNews7">
                <div class="Id">Identité</div>
                <div class="Title">Titre news</div>
                <div class="CreatDate">Date de création</div>
                <div class="publish">Publier</div>
                <div class="Valid">Valide</div>
                <div class="Update">Date mise à jour</div>
                <div class="admin">Administration</div>
            </div>';
        foreach ($variable as $value) {
            $classRed = '';
            if($value['valid'] == 0) {
            $classRed = 'red';
            }
    echo '<form class="'.$classRed.' formAdmin" action="'.encodeRoutage(31).'" method="post">
    <div class="tableAdminNews7">
            <div class="Id">'.$value['prenom'].' '.$value['nom'].'</div>
            <div class="Title"><a class="link" href="'.findTargetRoute(105).'&idArticle='.$value['id'].'">'.$value['title'].'</a></div>
            <div class="CreatDate">'.brassageDate($value['creat_date']).'</div>
            <div class="publish">'.$this->yes[$value['publish']].'
                <label for="publish"></label>
                <select name="publish">';
            optionSelect($value['publish']);
        echo'</select>
            </div>
            <div class="Valid">'.$this->yes[$value['valid']].'
            <label for="valid"></label>
            <select name="valid">';
            optionSelect($value['valid']);
        echo'</select>
            </div>
                
            <div class="Update">'.brassageDate($value['update_date']).'</div>
            <div class="admin">
                <input type="hidden" name="id" value="'.$value['id'].'"/>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">update</button>
         
            </div>
        </div>
        </form>';
        }
    }
    public function adminArticle($idArticle, $idNav) {
        $dataArticle = $this->displayOneArticle($idArticle);
        if($dataArticle) {
            $finalText = $this->presentationText($dataArticle[0]['text'], 'listClass');
            
            echo'<div class="indexArticle">
            <div class="TitleNews"><h3 class="subTitleSite">'.$dataArticle[0]['title'].'</h3>   
            </div>
                    <div class="pictureNews"><img class="imgNews" src="'.$this->pictureDirectory.$dataArticle[0]['picture'].'" alt="'.$dataArticle[0]['title'].'"/></div>
                    <div class="textNews">
                    <p class="dateNews">Le '.brassageDate($dataArticle[0]['creat_date']).'</p>
                    <p class="styleListNews">'.$finalText.'</p>
                    </div>
                </div>';
            echo'<form action="'.encodeRoutage(32).'" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="'.$idArticle.'"/>
                    <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer '.$dataArticle[0]['title'].'</button>
                </form>';
            echo '<article>
                    <form class="flex-colonne-form" action="'.encodeRoutage(33).'" method="post" enctype="multipart/form-data">
                        <label for="title">Titre news</label>
                        <input type="text" id="title" name="title" value="'.$dataArticle[0]['title'].'"/>
                        <label for="text">Rédiger votre news</label>
                        <textarea class="textAreaNew" id="text" name="text" rows="35" cols="50">
                        '.$dataArticle[0]['text'].'
                        </textarea>
                        <label for="publish">Publier</label>
                        <select id="publish" name="publish">';
                            optionSelect($dataArticle[0]['publish']);
                        echo'</select>
                        <label for="valid">Valide</label>
                        <select id="valid" name="valid">';
                        optionSelect($dataArticle[0]['valid']);
                    echo'</select>
                        </select>
                        <label for="picture">Image d\'illustration de la news ?</label>
                        <input id="picture" type="file" name="picture" accept="image/png, image/jpeg, image/webp"/>
                        <input type="hidden" name="id" value="'.$dataArticle[0]['id'].'"/>
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
                    </form>
                  
            </article>';
        } else {
            echo 'No article';
        }
    }
}