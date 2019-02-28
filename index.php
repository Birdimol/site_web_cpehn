<?php
// Start the session
session_start();

// Set session variables
if (isset($_SESSION["secu_log"])) {$Secu_log = $_SESSION["secu_log"]; $Secu_nom = 	$_SESSION["secu_Nom"]; $Secu_prenom =$_SESSION["secu_Prenom"]; $Secu_Statut =$_SESSION["secu_Statut"];}
else {$Secu_log = "Nop"; $Secu_nom ="Nop"; $Secu_prenom ="Nop"; $Secu_Statut ="Nop";}
$_SESSION['originUrl']="http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
// $_SESSION['originUrl'] = "http://www.cpehn.be/formations/index.php";
?>

<html>
	
<head>
  <title>CPE Hainaut-Namur - Formations</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Rudi REZ" />
  <link rel="stylesheet" type="text/css" media="screen" href="formation.css" title="default" />
  <SCRIPT TYPE="text/javascript">
  	 function popup(mylink, windowname) 
  	  {
  	 	 if (! window.focus)return true; 
  	 	 var href; 
  	 	 if (typeof(mylink) == 'string')  href=mylink;  	 else href=mylink.href; 
  	 	 window.open(href, windowname, 'width=500,height=250,scrollbars=no,resizable=no,top=500,left=500'); 
  	 	 return false; 
  	 	}
  </SCRIPT>
  
</head>


<body>
 
<?
//  - ---------------------------- modif du fichier de log -------------------------------------------------------
$serv1 = split('[(;]',$_SERVER['HTTP_USER_AGENT']);
$message  = 'Visite du '. date("l d F Y , G:i:s").' - IP remote : ';
$message .= "<a href='http://www.db.ripe.net/whois?searchtext=".$_SERVER['REMOTE_ADDR']."' title='chech ip'>".$_SERVER['REMOTE_ADDR']." </a>";
$message .=' / '.gethostbyaddr($_SERVER['REMOTE_ADDR']).' - navigateur : '. $serv1[0]."<br>\n\r";
$handle = fopen ('log.txt', 'a+');
fwrite ($handle, $message); 
fclose($handle);

// ********************************************************************************************************************************
?>
<div ID="mainbody" class="mainbody">

<!--  Entete de page avec menu  ----------------------------------------------------------------------------------------------------------------->
<div class="cpehn_entete">

	<div id="cpehn_logo" style="position:relative; left:5px; top:5px; width:70px; height:70px; z-index:10;">
  	<img src="http://www.cpehn.be/images/logocpehn.jpg" width=70 height=70 > 
	</div>
<!--
	<div class="bouton1" style="position:relative; left:120px; top:-20px; z-index:10;">	
  	<a class="bouton1" HREF="cpehn_page_principale.php" target="page"> Accueil </a>
	</div>
	-->
	<div style="position:relative; left:100px; top:-40px; z-index:10;">	
	<ul class="menu">
 
    <li><a href="http://www.cpehn.be/formations/">Accueil</a></li>
    <li><a href="#">Demandeurs d'emploi</a>
        <ul>
            <li><a href="#" class="documents">Informatique</a></li>
            <li><a href="#" class="messages">Télématique</a></li>
            <li><a href="#" class="sign">SecureIT</a></li>
        </ul>
    </li>    
    <li><a href="#">Entreprises</a>
        <ul>
            <li><a href="#" class="documents">Cybersécurité</a></li>
            <li><a href="#" class="messages">Bureautique</a></li>
            <li><a href="#" class="sign">Drones</a></li>
        </ul>
    </li>
    <li><a href="#">Documentations</a></li>
    <li><a href="#">Offres d'emploi</a></li>
    <li><a href="#">Contact</a></li>
<?
	// <a href='../NAdmin/login.php'  class='sign' onClick=\"return popup(this, 'login')\" >Login</a>
if ($Secu_log == "Nop") { echo " <li><a href='../NAdmin/login.php' >Login</a>
																  	<ul>
																    	<li><a href='../NAdmin/NewCount.php' >Nouveau</a></li>
														        </ul>
    														 </li>";}
									 else { echo " <li><a href='../NAdmin/logout.php' class='sign'>Logout</a> 
																  	<ul>
																    	<li><a href='../NAdmin/editcompte.php' >Compte</a></li>
														        </ul>
    														 </li>";}
?>    														 

	</ul>
	</div>

	<div style="position:relative; left:450px; top:-100px; z-index:10;">	

    <? 
    	if ($Secu_Statut!="Nop" ) {echo "</b> bonjour ".$Secu_prenom." ".$Secu_nom." - vous êtes : ".$Secu_Statut."</b>"; }
    ?>
	</div>


</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--  Corps de la page  ------------------------------------------------------------------------------------------------------------------------------>
<div class="cpehn_body">
<div style=" height:800px;">	
	<br>
	<h1>Bienvenu sur le site des formations du CPE-HN</h1>
	<div class="cpehn_text">	
		Espace d'informations relatives aux formations du CPEHN			<br>
		<p>
		  Vous y trouverez les informations relatives aux formations en cours. informations générales, planning, offres d'emploi, syllabus,....	
		  Des informations sont publiques. D'autres sont étroitement liées aux formations. Vous devez vous enregistrer afin de recevoir les autorisations d'accès aux informations spécifiques de votre formation. 
		</p>
	<br>
<b><u>OBJECTIFS </u></b>
<ul>
	<li> Mise à disposition d'un site web axé sur les formations informatiques du CPEHN.
  <li> Mise à disposition d'un espace web pour les participants aux formations afin de s'initier à la programmation de site WEB.
  <li> Mise à disposition des syllabus de formation et de toutes autres informations utiles.
</ul>
	</div>			
	


	<div class="cpehn_cadre1" >
	<h2>Formations en cours </h4>
	<center>
<? 
  $file1 = $_SERVER['DOCUMENT_ROOT']."/planningGlobalSemaine.php";  
	include $file1; 
?>
	<br>
	</center>
	</div>

</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------->

<!--  Pied de page avec copyright cpehn  ----------------------------------------------------------------------------------------------------------------->
<div class="cpehn_pied">
	<div id="cpehn_pied1" style="position:relative; left:5px; top:5px; z-index:10;">	
	  Rue Chapelle Beaussart, 80 - bâtiment 15 - 6030 Charleroi -  Tél.: 32(0)71 36 11 31 - fax.: 32(0)71 36 15 00 -  WWW.cpehn.be - mail : <a href="mailto:info@cpehn.be">info@cpehn.be</a> - 
	  © cpehn 2017 <a href="visulog.php" title="" target="page">.</a>
	</div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------->

</div>

</body>

</html>
