<?php


class Image{
    public $path;
    
    public static function getImageList(){
        $liste = array();
        if($dossier = opendir(__DIR__.'/../../images')){
            while(false !== ($fichier = readdir($dossier))){
                if($fichier != '.' && $fichier != '..' ){
                    $array = array();
                    $array['path'] = $fichier;
                    $liste[] = $array;
                }
            }
        }
        return $liste;
    }    
}

