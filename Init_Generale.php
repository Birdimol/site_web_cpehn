<?php
// forcer le jeux de caract�re europ�en au navigateur
header('Content-Type: text/html; charset=ISO-8859-1'); // �crase l'ent�te utf-8 envoy� par php
ini_set( 'default_charset', 'ISO-8859-1' ); 

$loginFormAction = $_SERVER['PHP_SELF'];
$racine = "http://www.cpehn.be/";

$Reps_form=array("cybersecu"=>"cybersecu","informatique"=>"pcsupport", "telematique"=>"immotique", "dao"=>"dao", "soudeur"=>"soudeur", "qualite"=>"qualite", "Administratif"=>"AssAdmin" );


?>
