<?php

if(isset($_COOKIE["nom"])) { $Visiteur_Nom = $_COOKIE["nom"]; setcookie("nom",$Visiteur_Nom, time()+86400*10,"/");
			     $Visiteur_Lieu= $_COOKIE["localisation"]; setcookie("localisation",$Visiteur_Lieu, time()+86400*10,"/");	}
                      else { $Visiteur_Nom = "??";}
?>

<HTML>
<HEAD>
  <title>Formation Assistant Informatique</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Rudi REZ" />
  <link rel="stylesheet" type="text/css" media="screen" href="formation.css" title="default" />
</HEAD>
<BODY BGCOLOR="WHITE">


<div id="accueil1" style="position:relative; left:50px; top:20px; z-index:1">
  <CENTER><B>Assistant Informatique 2015-2016</B> </CENTER>
  <ul>
  <li> Lieu : CPEHN - Charleroi - <A REF=http://www.cpee.be TARGET="_blank">WWW.cpee.be</A> </li>
  <li> Date : 16 septembre 20154 - 17 décembre 2015 </li>
  <li> Coordination : Rudi Réz - 071/36 11 32 - rr@cpee.be</li>
  <li> Secrétariat : Christine Bambusa - 071/36 11 31 - cb@cpee.be</li>

  
  </ul>
</div>

<div id="Ident1" style="position:absolute; left:50px; top:0px; z-index:1">
<?
 	if($Visiteur_Nom != "??") { echo" Bonjour. Vous êtes ".$Visiteur_Nom .", connecté de ".$Visiteur_Lieu ; }
			else       { echo" ";}
?>

</div>


<div id="planning1" style="position:relative; text-align:center; left:5px; top:30px; z-index:1">
<? 
  $file1 = "./planning/planningSemaine.php";  
	include $file1; 
?>
</div>




<div id="info1" style="position:relative; left:10px; top:150px; z-index:1">
<h2><u> Informations - actualités - offres d'emploi </u></h2>
<br>
<?php
  $actif_repertoire = "./OffreEmploi";
  chdir("./".$actif_repertoire);
  $mydir = opendir(".");
  while($entryname = readdir($mydir))
  
    { $fdate = date("d F Y", filemtime($entryname));
    	if (($entryname<>".") AND ($entryname<>"..")) { echo '<li><a href="'.$actif_repertoire.'/'.$entryname.'" > <span style="color:black">offre d\'emploi ['.$fdate.'] : '.$entryname.'</a><br>'; }
    }
  closedir($mydir);
?> 


  <HR WIDTH="95%" SIZE="1">
  <br>
</div>




</BODY>
</HTML>


