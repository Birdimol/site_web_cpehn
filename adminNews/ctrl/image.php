<?php

$action = 'liste';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

switch($action){
    case 'liste' :
            $images = Image::getImageList();
            include __DIR__.'/../view/image/liste_images.php';
        break;
    
    case 'ajouter' :
            include __DIR__.'/../view/image/ajouter_image.php';
        break;
    
    case 'supprimer_action' :
            unlink('public/img/'.$_GET['path']);
        
            $images = Image::getImageList();
            include __DIR__.'/../view/image/liste_images.php';
        break;
    
    case 'ajouter_action' :
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $message = '';
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (file_exists($target_file)) {
                $message .= "Ce fichier existe déjà.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $message .=  "Le fichier est trop gros.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $message .=  "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $message .= "Le fichier ". basename( $_FILES["image"]["name"]). " a été uploadé.";
                } else {
                    $message .= "Une erreur est survenue lors de l'upload.";
                }
            }
            
            $images = Image::getImageList();
            include __DIR__.'/../view/image/liste_images.php';
        break;
}

