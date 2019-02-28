<?php

$action = 'liste';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

switch($action){
    case 'liste' :
            $news = News::getNewsList();
            include __DIR__.'/../view/news/liste_news.php';
        break;
    
    case 'ajouter' :
            $images = Image::getImageList();
            include __DIR__.'/../view/news/ajouter_news.php';
        break;
    
    case 'ajouter_action' :        
            if(isset($_POST['accueil'])){
                if($_POST['accueil'] == 'on'){
                    $_POST['accueil'] = 1;
                }
            }else{
                $_POST['accueil'] = 0;
            }        
            $news = new News($_POST);
            $news->save();        
            $news = News::getNewsList();
            include __DIR__.'/../view/news/liste_news.php';
        break;
    
    case 'modifier' :
            $images = Image::getImageList();
            $new = new News($_GET['id']);            
            include __DIR__.'/../view/news/modifier_news.php';
        break;
    
    case 'modifier_action' :
            if(isset($_POST['accueil'])){
                if($_POST['accueil'] == 'on'){
                    $_POST['accueil'] = 1;
                }
            }else{
                $_POST['accueil'] = 0;
            } 
            $news = new News($_POST);
            $news->update();        
            $news = News::getNewsList();
            include __DIR__.'/../view/news/liste_news.php';
        break;
    
    case 'supprimer_action' :
            $news = new News($_GET['id']);
            $news->delete();        
            $news = News::getNewsList();
            include __DIR__.'/../view/news/liste_news.php';
        break;
}
