<?php 
session_start(); 
/* Mise à jour des occupations du jours en cours*/

header('Content-Type: text/html; charset=ISO-8859-1'); // écrase l'entête utf-8 envoyé par php
ini_set( 'default_charset', 'ISO-8859-1' );

function getisomonday($year, $week)   //   *************** fonction de détedtion du lundi de la semaine demandée
  {
        # check input
        $year = min ($year, 2038); $year = max ($year, 1970);
        $week = min ($week, 53); $week = max ($week, 1);
        # make a guess
        $monday = mktime (1,1,1,1,7*$week,$year);
        # count down to week
        while (strftime('%V', $monday) != $week)
                $monday -= 60*60*24*7;
        # count down to monday
        while (strftime('%u', $monday) != 1)
                $monday -= 60*60*24;
        # got it
        return $monday;
  }


include 'AllocLocal_table.php'; 
$Aujourdhui =  date("Y-m-d");  
// cette partie doit etre le même dans le fichier cpehn_page_AllocLocal.php	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
require ("./NAdmin/connectioncpehn.php"); $link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE); mysql_select_db(nom_BASE,$link);
$locaux_matin = 0;
$locaux_midi = 0;
$query = "SELECT * FROM locaux WHERE `date` = '".$Aujourdhui."' ORDER BY  `locaux`.`date` ASC "; 
if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }

	$nbr_lignes = mysql_num_rows($dbresult);  

	$listeformations_top  = "<? header('Content-Type: text/html; charset=ISO-8859-1'); ini_set( 'default_charset', 'ISO-8859-1' ); ?>";
	$listeformations_top .= "<html><head> <meta http-equiv='content-type' content='text/html; charset=iso-8859-1' /> </head>";
	$listeformations_top .= "<body>";
	$listeformations_top .= "<br>"; //.$nbr_lignes."<br>";

	$listeformations_matin ="<table align=center border=0>";
	$listeformations_midi ="<table align=center border=0>";
	while($dbrow = mysql_fetch_row($dbresult))
    {  // 	set('matin', 'Après-midi', 'journée', 'midi')
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="matin" )) {$listeformations_matin .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_matin = 1;}
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="Après-midi" ))  {$listeformations_midi  .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_midi = 1;}
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="journée" ))  {$listeformations_matin .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_matin = 1;
																																		 $listeformations_midi  .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_midi = 1; }
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="midi" ))  {$listeformations_midi  .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_midi = 1;}
		}  
		
		
		
		
	// Table des allocations des jours d'occupation des locaux des formations  -------------------------------------------------------------------------
 	 	
  $query = "SELECT * FROM formations  WHERE `verrou` LIKE 'off'";   if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
  $nbr_fields = mysql_num_fields($dbresult);  $nbr_lignes = mysql_num_rows($dbresult);
  while($dbrow = mysql_fetch_row($dbresult))
    {
    	$local = $dbrow[15]; $formation = $dbrow[1]; $Intitule = $dbrow[2]; $repertoire = $dbrow[13]; $ID_record = $dbrow[0];
    	$Intitule = "<span STYLE=' font-size: 24pt'>".$Intitule."</span>";
    	$fileName="./formations/formation".$ID_record.".xml";
			$Formation = new DomDocument();
 			$Formation->load($fileName);
			$Data = $Formation->getElementsByTagName('Formation')->item(0); 
		  $Modules = $Data->getElementsByTagName('Modules')->item(0);
		  $Liste_modules = $Modules->getElementsByTagName('module');
			foreach ($Liste_modules as $module) 
				{
					$ID = $module->getElementsByTagName('ID')->item(0)->textContent;
					$Mod_local[$ID] = utf8_decode($module->getElementsByTagName('Local')->item(0)->textContent);
//					echo $ID." ".$Mod_local[$ID]." ".$local."<br>";
				}		
    	$query2 = "SELECT * FROM modules ORDER BY `intitule` ASC";  if(!($dbresult2 = mysql_query($query2,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query2 <br>");  }	
 			while($dbrow2 = mysql_fetch_row($dbresult2))
     	{
				if ($dbrow2[4]!="cours")
					{
						$ID = $dbrow2[0];
						$Mod_local[$ID] = $local;
						// echo $ID." ".$Mod_local[$ID]." ".$local."<br>";
					}
		 	} 
		  $Planning = $Data->getElementsByTagName('planning')->item(0);
  		$statut = $Planning->getAttribute('statut');
  		$Liste_semaines = $Planning->getElementsByTagName('Semaine');

			foreach ($Liste_semaines as $semaine) 
				{
					$annee = $semaine->getElementsByTagName('annee')->item(0)->textContent;
					$NrSem = $semaine->getElementsByTagName('NrSemaine')->item(0)->textContent;
					$date = date('Y-m-d',getisomonday($annee, $NrSem));
					if ($date == $Aujourdhui)
						{
							$Lundi = $semaine->getElementsByTagName('Lundi')->item(0);
					  	$AM = $Lundi->getElementsByTagName('AM')->item(0)->textContent; if ($AM != "" and $AM != "conge") { $ind_date = $date."AM"; $listeformations_matin .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_matin = 1;} 
					  	$PM = $Lundi->getElementsByTagName('PM')->item(0)->textContent; if ($PM != "" and $PM != "conge") { $ind_date = $date."PM"; $listeformations_midi  .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$PM]."</h3> </td></tr>"; $locaux_midi = 1; }
						}
					$date = date('Y-m-d',getisomonday($annee, $NrSem)+3600*24*1);					
					if ($date == $Aujourdhui)
						{
							$Mardi = $semaine->getElementsByTagName('Mardi')->item(0);
					  	$AM = $Mardi->getElementsByTagName('AM')->item(0)->textContent; if ($AM != "" and $AM != "conge") { $ind_date = $date."AM"; $listeformations_matin .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_matin = 1;} 
					  	$PM = $Mardi->getElementsByTagName('PM')->item(0)->textContent; if ($PM != "" and $PM != "conge") { $ind_date = $date."PM"; $listeformations_midi  .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$PM]."</h3> </td></tr>"; $locaux_midi = 1; }
						}
					$date = date('Y-m-d',getisomonday($annee, $NrSem)+3600*24*2);					
					if ($date == $Aujourdhui)
						{
							$Mercredi = $semaine->getElementsByTagName('Mercredi')->item(0);
					  	$AM = $Mercredi->getElementsByTagName('AM')->item(0)->textContent; if ($AM != "" and $AM != "conge") { $ind_date = $date."AM"; $listeformations_matin .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_matin = 1;} 
					  	$PM = $Mercredi->getElementsByTagName('PM')->item(0)->textContent; if ($PM != "" and $PM != "conge") { $ind_date = $date."PM"; $listeformations_midi  .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$PM]."</h3> </td></tr>"; $locaux_midi = 1; }
						}
					$date = date('Y-m-d',getisomonday($annee, $NrSem)+3600*24*3);					
					if ($date == $Aujourdhui)
						{
							$Jeudi = $semaine->getElementsByTagName('Jeudi')->item(0);
					  	$AM = $Jeudi->getElementsByTagName('AM')->item(0)->textContent; if ($AM != "" and $AM != "conge") { $ind_date = $date."AM"; $listeformations_matin .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_matin = 1;} 
					  	$PM = $Jeudi->getElementsByTagName('PM')->item(0)->textContent; if ($PM != "" and $PM != "conge") { $ind_date = $date."PM"; $listeformations_midi  .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_midi = 1; }
						}
					$date = date('Y-m-d',getisomonday($annee, $NrSem)+3600*24*4);					
					if ($date == $Aujourdhui)
						{
							$Vendredi = $semaine->getElementsByTagName('Vendredi')->item(0);
					  	$AM = $Vendredi->getElementsByTagName('AM')->item(0)->textContent; if ($AM != "" and $AM != "conge") { $ind_date = $date."AM"; $listeformations_matin .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_matin = 1;} 
					  	$PM = $Vendredi->getElementsByTagName('PM')->item(0)->textContent; if ($PM != "" and $PM != "conge") { $ind_date = $date."PM"; $listeformations_midi  .= "<tr><td><h2>".$Intitule."</h2></td><td style='width:80px'> <h3> &thkap; </h3> </td><td> <h3>".$Mod_local[$AM]."</h3> </td></tr>"; $locaux_midi = 1; }
						}
	 			}
			}	
		
	$listeformations_matin .= "</table>";
	$listeformations_midi .= "</table>";

	if ($locaux_matin == 0) {$listeformations_matin = "<br><br><h3> * Pas de formation ce matin * </h3><br><br><img src='./images/CPE_logo3.png' alt='plan rez de chaussée' width='300'>";} 
	if ($locaux_midi == 0) {$listeformations_midi = "<br><br><h3> * Pas de formation cet après-midi * </h3><br><br><img src='./images/CPE_logo3.png' alt='plan rez de chaussée' width='300'>";} 

	if (($locaux_matin == 0) AND ($locaux_midi == 0)) { $listeformations_matin = "<br><br><h3> * Pas de formations aujourd'hui * </h3><br><br><img src='./images/CPE_logo3.png' alt='plan rez de chaussée' width='300'>";
																											$listeformations_midi = "<br><br><h3> * Pas de formations aujourd'hui * </h3><br><br><img src='./images/CPE_logo3.png' alt='plan rez de chaussée' width='300'>";} 

	$listeformations_bottom = " <div style='position:absolute; left:100px; bottom:20px; width:1300px; z-index:1; border-radius: 20px 20px 1px 20px; text-align:center; color:black; border-style:solid; border-width: 2pt;'>";
	$listeformations_bottom .= "  <marquee> <span style='color:black; font-style:italic; font-size:25pt;'> ---- ".$Ntexte1." --- </span></marquee>";
	$listeformations_bottom .= " </div>";
	$listeformations_bottom .= "</body></html>";

mySql_close($link);

$ListeLocaux_matin = $listeformations_top.$listeformations_matin.$listeformations_bottom;
$handle = fopen ('AllocLocal_matin.php', 'w');
fwrite ($handle, $ListeLocaux_matin); 
fclose($handle);	

$ListeLocaux_midi = $listeformations_top.$listeformations_midi.$listeformations_bottom;
$handle = fopen ('AllocLocal_midi.php', 'w');
fwrite ($handle, $ListeLocaux_midi); 
fclose($handle);	
// cette partie doit etre le même dans le fichier cpehn_page_AllocLocal.php	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
?>

<html>

<head>
<title>CPE Hainaut-Namur</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Rudi REZ" />

<script>
var EventCpt = 0;
var EventTimer = 0;
var timeBarTimer = 0;

// ********************************** fonction : rafraichisement du contenu  - occupation des locaux et informations
function loadXMLDoc()
{
EventCpt +=1;	
timeBarTimer = 0;
<?php if ($nbr_lignes==0){echo"EventTimer = 0; "; } ?>

if (window.XMLHttpRequest)  { xmlhttp=new XMLHttpRequest();  }  // code for IE7+, Firefox, Chrome, Opera, Safari
else   											{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");  }  // code for IE6, IE5 

xmlhttp.onreadystatechange=function()
  {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)    {    document.getElementById("Occupation").innerHTML=xmlhttp.responseText;    }
  }

// ----------------------------------------- affichage des infos de 10h00 à 11h59 et après 14h00
if ( EventTimer == 0) { switch(EventCpt%7) { 	case 0: xmlhttp.open("GET","AllocLocal_matin.php",true); break;
																							case 1: xmlhttp.open("GET","AllocLocal_midi.php",true); break;
																							case 2: xmlhttp.open("GET","AllocLocal_info1.php",true); break;
																							case 3: xmlhttp.open("GET","AllocLocal_info2.php",true); break;
																							case 4: xmlhttp.open("GET","AllocLocal_info3.php",true); break;
																							case 5: xmlhttp.open("GET","AllocLocal_info4.php",true); break;
																							case 6: xmlhttp.open("GET","AllocLocal_info5.php",true); break;
    																					default: xmlhttp.open("GET","AllocLocal_info3.php",true); break;
																						}
											}
	
// ----------------------------------------- affichage des occupations de salles de 8h00 à 9h59
if ( EventTimer == 1) { if ((EventCpt%3)==1) { xmlhttp.open("GET","AllocLocal_info2.php",true); } else { xmlhttp.open("GET","AllocLocal_matin.php",true); } }

// ----------------------------------------- affichage des occupations de salles de 12h00 à 13h59
if ( EventTimer == 2){ if ((EventCpt%3)==1) { xmlhttp.open("GET","AllocLocal_info2.php",true); } else { xmlhttp.open("GET","AllocLocal_midi.php",true); } }

xmlhttp.send();
}

function reloadinfo() 
{
	setInterval(function () {loadXMLDoc()}, 20000);
}

</script>

<style type="text/css">

body{
	color:#888;
	padding:0;
	margin:0;
	font: 72.5% 'Helvetica Neue', Helvetica, Arial, sans-serif; 
	background-image:url(locaux_bgimage.jpg);
}

h1 { /* Titre principal */
font-family:arial;
color:black;
font-size:2em;
}
h2 { /* Titre secondaire */
font-family:arial;
color:black;
font-size:3.5em;
}
h3 { /* Titre secondaire */
font-family:arial;
color:blue;
font-size:3.5em;
}

#conteneur { /* Conteneur global pour le centrage */
width:1600px;
height:900px;
margin:auto;
margin-top:20px;
text-align:center;
background-image: url("PageBlancheVoileBleue.jpg");
background-repeat: no-repeat;
border-style: solid;
border-width: 1px;
} 

#Titre { /* Conteneur du titre */
text-align:center;
font-family:arial;
font-size: 22px;
border:1px solid gray;
height:90px;
width:40%;
padding:10px;
margin-top:15px;
margin-left:30%;
}

#Occupation { /* Conteneur d'occupation des locaux */
 position: relative;
   	left: 00px;
    top: 00px;
text-align:center;
font-family:arial;
font-size: 15px;
border:1px solid gray;
border-radius: 20px 20px 1px 20px;
width:1500px;
height:750px;
padding:0px;
margin-left:50px;
}

#horloge { /* Conteneur de l'horloge */
 position: relative;
   	left: 20px;
    top: 20px;
font-family:arial;
border:0px solid gray;
color:black;
text-align:left;
font-size: 30px;
height:60px;
width:1560px;
}

#debug { /* Conteneur des info de debug */
 position: relative;
   	left: 20px;
    top: 10px;
font-family:arial;
border:0px solid gray;
color:black;
text-align:right;
font-size: 18px;
height:40px;
width:1545px;
}

#Bouton1 {
position: relative;
 		right: 10px;
    bottom: 5px;
font-family:arial;
border:0px solid gray;
color:black;
text-align:right;
font-size: 25px;
}

.monButton:active,hover,visited  {
	width:260px;
	height:35px;
	color: blue;
	background-color: darkgrey;
	border-radius:15px;
  font-weight: bold;
  font-size: 100%;
	}
	
.myButton {
	-moz-box-shadow: 3px 4px 0px 0px #899599;
	-webkit-box-shadow: 3px 4px 0px 0px #899599;
	box-shadow: 3px 4px 0px 0px #899599;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #bab1ba));
	background:-moz-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-webkit-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-o-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:-ms-linear-gradient(top, #ededed 5%, #bab1ba 100%);
	background:linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#bab1ba',GradientType=0);
	background-color:#ededed;
	-moz-border-radius:15px;
	-webkit-border-radius:15px;
	border-radius:15px;
	border:1px solid #d6bcd6;
	display:inline-block;
	cursor:pointer;
	color: blue;
	font-family:Arial;
  font-weight: bold;
  font-size: 100%;
	padding:7px 25px;
	text-decoration:none;
	text-shadow:0px 1px 0px #e1e2ed;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bab1ba), color-stop(1, #ededed));
	background:-moz-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-webkit-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-o-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:-ms-linear-gradient(top, #bab1ba 5%, #ededed 100%);
	background:linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bab1ba', endColorstr='#ededed',GradientType=0);
	background-color:#bab1ba;
}
.myButton:active {
	position:relative;
	top:1px;
}

.effect1{
	-webkit-box-shadow: 0 10px 6px -6px #777;
	   -moz-box-shadow: 0 10px 6px -6px #777;
	        box-shadow: 0 10px 6px -6px #777;
}

.effect2
{
  position: relative;
}
.effect2:before, .effect2:after
{
  z-index: -10;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width:300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}
.effect2:after
{
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}

</style>
</head>

<!-- Le corps du la page est ici  ----------------------------------------------------------------------------------------------->

<body onload="reloadinfo()">
	
<div id="conteneur" class="effect1">    <!-- Cadre global  -->
<!--
	<div id="Titre" class="effect1">		
  	<h1>Occupation des locaux</h1> 
  </div> 
-->
	<div id="horloge"></div>							<!-- Horloge - date et heure  -->
	<div id="debug"></div>							<!-- Affichage de données de debug pour mise au point  -->

	<div id="Occupation"> 								<!-- Contenu de du cadre : remplacé par un fichier php toute les 20 secondes  -->
		<br><br><br><img src="./images/CPE_logo3.png" alt="plan rez de chaussée" width="600">
	</div> 
	<div id="Bouton1">
		<a href="#" onclick="launchFullscreen(document.documentElement);" class="myButton">www.cpehn.be</a>  
  </div>

</div> 

 <!-- <button type="button" onclick="loadXMLDoc()">update Content</button> -->
 
<script>
	
// --------------------------- affichage de l'horloge -----------------------------	
var myVar=setInterval(function(){myTimer()},500);

function myTimer() {
    krucial = new Date;
    heure = krucial.getHours();
    min = krucial.getMinutes();
    sec = krucial.getSeconds();
    jour = krucial.getDate();
    mois = krucial.getMonth()+1;
    annee = krucial.getFullYear();
    weekday = krucial.getDay();
    timeBarTimer +=1;	
    periode = "°";
		if ((sec%2)==1) PtSec =  "."; else PtSec =  " ";

    if (weekday==1) wday ="Lundi"; 
    if (weekday==2) wday ="Mardi"; 
    if (weekday==3) wday ="Mercredi"; 
    if (weekday==4) wday ="Jeudi"; 
    if (weekday==5) wday ="Vendredi"; 
    if (weekday==6) wday ="Samedi"; 
    if (weekday==7) wday ="Dimanche"; 
    
    if (sec < 10) sec0 = "0"; else sec0 = "";
    if (min < 10) min0 = "0"; else min0 = "";
    if (heure < 10) heure0 = "0"; else heure0 = "";
    if (mois == 1) mois = "Janvier";
    if (mois == 2) mois = "Février";
    if (mois ==3)  mois = "Mars";
    if (mois == 4) mois = "Avril";
    if (mois == 5) mois = "Mai";
    if (mois == 6) mois = "Juin";
    if (mois == 7) mois = "Juillet";
    if (mois == 8) mois = "Août";
    if (mois == 9) mois = "Septembre";
    if (mois == 10) mois = "Octobre";
    if (mois == 11) mois = "Novembre";
    if (mois == 12) mois = "Décembre";
    if (jour == 1)  jour1 = "er"; else  jour1 = "";
    	
    EventTimer=0;
    <?php if ($locaux_matin == 1) {echo "if (heure==8 || heure==9) EventTimer = 1; ";}   ?> 	 	// pour l'affichage de l'occupation des salles du matin	
    <?php if ($locaux_midi == 1)  {echo "if (heure==12 || heure==13) EventTimer = 2;";}   ?> 	 	 	// pour l'affichage de l'occupation des salles de l'après midi
    
    if 	(EventTimer == 1) periode = ".";
    if 	(EventTimer == 2) periode = "..";
    	
    DinaHeure = "<div style='position:absolute; left:10px; top:2px z-index:1;'>" + wday +" "+ jour + jour1 + " " + mois + " " + annee + "</div> <div style='position:absolute; right:20px; top:2px z-index:1;'><span style='font-size:45px' ><b>" + heure0 + heure + ":" + min0 + min +"</b></span></div> <div style='position:absolute; right:10px; top:2px z-index:1;'><span style='font-size:45px' ><b>"+ PtSec +"</b></span></div>" ;
    which = DinaHeure
    document.getElementById("horloge").innerHTML = which;

// debug 
// InfoDebug = "<div><meter min='0' max='140' value='"+((EventCpt%7+1)*20)+"'></meter> "+ periode +" </div> ";
// InfoDebug = "<div><meter min='0' max='160' value='"+((timeBarTimer)*4)+"'></meter> "+ periode +" " + (EventCpt+1) + "/7</div> ";
InfoDebug = "<div><meter min='0' max='160' value='"+((timeBarTimer)*4)+"'></meter> "+ (EventCpt%7+1) + "/7</div> ";
which = InfoDebug
document.getElementById("debug").innerHTML = which;
// debug

}


</script>


<!-------------- gestion du full screen  ----------------------------------------------------------------------------------------------->

<!--    
    <button onclick="launchFullscreen(document.documentElement);" ID="sexyButton" class="monButton" >www.cpehn.be</button><br>
		<button onclick="exitFullscreen();" class="sexyButton">NS</button>   	<a href="http://www.cpehn.be/cpehn_page_AllocLocal.php" onclick="exitFullscreen();">www.cpehn.be</a>  
-->

  
<script>
// Find the right method, call on correct element
function launchFullscreen(element) {
  if(element.requestFullscreen)            {    element.requestFullscreen();  } 
  else if(element.mozRequestFullScreen)    {    element.mozRequestFullScreen();  } 
  else if(element.webkitRequestFullscreen) {    element.webkitRequestFullscreen();  } 
  else if(element.msRequestFullscreen)     {    element.msRequestFullscreen();  }
}

function exitFullscreen() {
  if(document.exitFullscreen)            {    document.exitFullscreen();  } 
  else if(document.mozCancelFullScreen)  {    document.mozCancelFullScreen();  } 
  else if(document.webkitExitFullscreen) {    document.webkitExitFullscreen();  }
}

// Events
document.addEventListener("fullscreenchange", function(e) {  console.log("fullscreenchange event! ", e);});
document.addEventListener("mozfullscreenchange", function(e) {  console.log("mozfullscreenchange event! ", e);});
document.addEventListener("webkitfullscreenchange", function(e) {  console.log("webkitfullscreenchange event! ", e);});
document.addEventListener("msfullscreenchange", function(e) {  console.log("msfullscreenchange event! ", e);});

</script>
<!---------------- gestion du full screen  ----------------------------------------------------------------------------------------------->

</body> 

</html>