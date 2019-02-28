<?php
    include_once("databaseManager.php");

    class News {        
        public function __construct($info){
            if(is_array($info)){
                $this->setFromArray($info);
            }else{
                $this->load($info);
            }
        }
        
        public function setFromArray($array){            
            if(is_array($array) && count($array) > 0){
                foreach($array as $key => $value){
                    $this->$key = $value;
                }
            }            
        }
        
        public function load($id){
            $db = DatabaseManager::getDb();    
            $requete = "Select * from web_cpehn_news where id = :id";
            $stmt = $db->prepare($requete);
            $stmt->execute(array(':id'=>$id));
            $this->setFromArray($stmt->fetch(PDO::FETCH_ASSOC));
        }
        
        public static function getNewsList(){
            $db = DatabaseManager::getDb();
            $requete = "Select * from web_cpehn_news";    
            $stmt = $db->prepare($requete);
            $stmt->execute();
            $news = array();
            while($ligne = $stmt->fetch(PDO::FETCH_ASSOC)){
                $news[] = $ligne;
            }            
            return $news;
        }
        
        public function delete(){
            $db = DatabaseManager::getDb();
            $requete = "delete from web_cpehn_news where id = :id";
            $stmt = $db->prepare($requete);
            $resultat = $stmt->execute(array(':id'=>$this->id));
            return $resultat;
        }
        
        public function save(){
            $db = DatabaseManager::getDb();    
            $requete = "insert into web_cpehn_news (titre, contenu, date_news, accueil) values (:titre, :contenu, :date_news, :accueil)";    
            $stmt = $db->prepare($requete);
            $resultat = $stmt->execute(
                array(
                    ':titre'=>$this->titre,
                    ':contenu'=>$this->contenu,
                    ':date_news'=>$this->date_news,
                    ':accueil'=>$this->accueil,
                    ':contenu'=>$this->contenu
                )
            );
            return $resultat;
        }
        
        public function update(){
            $db = DatabaseManager::getDb();            
            $requete = "update web_cpehn_news set titre = :titre, contenu = :contenu, date_news = :date_news, accueil = :accueil where id = :id";
            $stmt = $db->prepare($requete);
            $resultat = $stmt->execute(
                array(
                    ':titre'=>$this->titre,
                    ':id'=>$this->id,
                    ':date_news'=>$this->date_news,
                    ':accueil'=>$this->accueil,
                    ':contenu'=>$this->contenu)
                );            
            return $resultat;
        }
    }
