<?php session_start(); 

/*    if (isset($_COOKIE['Ulog']))
     {
      $_SESSION['MM_Username'] = $_COOKIE['UName']; 
      $_SESSION['MM_UserGroup'] = $_COOKIE['UGroup'];	      
      $_SESSION['MM_UserID'] = $_COOKIE['UID'];	      
      $_SESSION['MM_log'] = $_COOKIE['Ulog'];	 
     } 
     */
?>

<html>
<head>
<title>CPE Hainaut-Namur</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Rudi REZ" />
<script type="text/javascript" src="styleswitcher.js"></script>
</head>

<body bgcolor="#0000a0">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="logo_cpehn" style="position:absolute; left:5px; top:5px; width:70px; height:70px; z-index:-1">
   <img src="./images/CPE_logo3.png" width=70 height=70> 
</div>

<div id="intitule_cpehn" style="position:absolute; right:30px; top:5px; z-index:-2">
   <img src="./images/cpehn_intitule.png" > 
</div>

<div id="cpehn_link1" style="position:absolute; left:100px; bottom:-15px; z-index:1">	
	  <FORM method=GET action="cpehn_page_accueil.php" target="page">
	  	 <INPUT type=submit name=btnG VALUE="Accueil" style="width:80px; height:20px;font-size:12px;"> 
	  </FORM>
</div>
<div id="cpehn_link1" style="position:absolute; left:190px; bottom:-15px; z-index:1">	
	  <FORM method=GET action="cpehn_page_principale.php" target="page">
	     <INPUT type=submit name=btnG VALUE="Domaines" style="width:80px; height:20px;font-size:12px;">
	  </FORM>
</div>
<div id="cpehn_link1" style="position:absolute; left:280px; bottom:-15px; z-index:1">	
	  <FORM method=GET action="cpehn_page_VeilleTechno.php" target="page">
	     <INPUT type=submit name=btnG VALUE="Veille technologique" style="width:130px; height:20px;font-size:12px;">
	  </FORM>
</div>

<div id="cpehn_link1" style="position:absolute; left:420px; bottom:-15px; z-index:1">	
	  <FORM method=GET action="cpehn_page_contact.php" target="page">
	     <INPUT type=submit name=btnG VALUE="Contact" style="width:70px; height:20px;font-size:12px;">
	  </FORM>
</div>

<div id='cpehn_link2' style='position:absolute; left:600px; top:2px; z-index:1'>
<!--			<div class="fb-follow" data-href="https://www.facebook.com/587535844595400" data-show-faces="true" data-width="450"></div>  -->
 	<a href="http://www.facebook.com/pages/CPEHN/587535844595400" target="_blank"> <img src="../images/fb_petit.png" alt="FaceBook" BORDER="0"><a>  
</div>

<div id='cpehn_link2' style='position:absolute; left:600px; top:30px; z-index:1'>
  <a href="http://www.linkedin.com/company/cpe-hn" target="_blank"> <img src="../images/linkedin_petit.png" alt="LinkedIn" BORDER="0"><a>
</div>

<div id='cpehn_link2' style='position:absolute; left:600px; top:55px; z-index:1 '>
   <a href="https://twitter.com/Rudi_Rez" class="twitter-follow-button" data-show-count="false" data-lang="fr" data-show-screen-name="false">Suivre @Rudi_Rez</a>
   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>





<?php
  $_SESSION['PrevUrl']= "www.cpehn.be";
  if (isset($_SESSION['MM_UserGroup']))
    {
      $loginStrGroup = $_SESSION['MM_UserGroup'];	
      $loginUsername = $_SESSION['MM_Username'];
      echo "<div id='cpehn_user1' style='position:absolute; Left:120px; top:5px; width:350px; height:20px; z-index:1; color:#f0f0f0'>";
    	echo "  Bonjour ".$loginUsername." vous êtes ";
      if ($loginStrGroup=='user')  {echo"Utilisateur"; }
      if ($loginStrGroup=='admin') {echo" Administrateur"; }
      if ($loginStrGroup=='formateur') {echo" Formateur"; }
      if ($loginStrGroup=='participant') {echo" Participant"; }

    	echo "</div>";

		// ------------------ LOGOFF pour tout les utilisateurs loggé --------------------------
		  echo "<div id='cpehn_link1' style='position:absolute; left:400px; top:5px; z-index:1'>";	
	    echo "<FORM method=GET action='../XAdmin/logoff.php' target='page'>";
	    echo "<INPUT type=submit name=btnG VALUE='LogOff' style='width:70px; height:20px;font-size:12px;'>";
//	 echo "cookies : ".$_COOKIE['UName']." - ".$_COOKIE['UGroup']." - ".$_COOKIE['UID'];
//	 echo "<br>session : ".$_SESSION['MM_Username']." - ".$_SESSION['MM_UserGroup']." - ".$_SESSION['MM_UserID']." - ".$_SESSION['MM_log'];
//	 echo "<br> path : ".session_save_path()." - id: ".session_id();
	 	
	    echo "</FORM>";
		  echo"</div>";

		// ------------------ EDITION DE SON COMPTE pour tout les utilisateurs loggé --------------------------
		  echo "<div id='cpehn_link1' style='position:absolute; left:120px; top:25px; z-index:1'>";	
	    echo "<FORM method=GET action='../XAdmin/editcompte.php' target='page'>";
	    echo " <INPUT type=submit name=btnG VALUE='votre compte' style='width:90px; height:20px;font-size:12px;'>";
	    echo "</FORM>";
		  echo"</div>";
		  
		// ------------------ Disponibilité de la bibliothèque pour tout les utilisateurs loggé --------------------------
		  echo " <div id='cpehn_link1' style='position:absolute; left:500px; bottom:-15px; z-index:1'>
	             <FORM method=GET action='../Bibliotheque/cpehn_page_biblio.php' target='page'>
          	     <INPUT type=submit name=btnG VALUE='Bibliotheque' style='width:90px; height:20px;font-size:12px;'>
               </FORM>
     		     </div>";


		// ------------------ Listes des tables et mailing pour ADMINISTRATEUR loggé --------------------------
      if ($loginStrGroup == 'admin')
       {
		    echo "<div id='cpehn_link1' style='position:absolute; left:210px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../XAdmin/cpehn_admin.php' target='page'>";
	      echo " <INPUT type=submit name=btnG VALUE='Administration' style='width:90px; height:20px;font-size:12px;'>";
	      echo "</FORM>";
		    echo"</div>";

		    echo "<div id='cpehn_link1' style='position:absolute; left:390px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../mailing/cpehn_mailing.php' target='page'>";
	      echo " <INPUT type=submit name=btnG VALUE='Mailing' style='width:90px; height:20px;font-size:12px;'>";
	      echo "</FORM>";
		    echo"</div>";
       }                             
       
       
       
		// ------------------ Pointage des présences pour le participant loggé --------------------------
      if ($loginStrGroup == 'participant') 
       {
       	require_once ("./admin/connectioncpehn.php");
        $link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
        mysql_select_db(nom_BASE,$link);     	
       	$table = 'usercpehn';
  			$user_ID = $_SESSION['MM_UserID'];
  			$query = "SELECT ID,actif FROM $table WHERE ID=$user_ID LIMIT 0 , 300";
  			if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
       	$dbrow = mysql_fetch_row($dbresult) ; $user_actif = $dbrow[1];

		    echo "<div id='cpehn_link1' style='position:absolute; left:500px; top:3px; z-index:1'>";	
		    echo "<FORM method=GET action='../formations/cpehn_presences_arrivee.php' target='page'>";
	      echo " <INPUT "; if ($user_actif == 0) {echo "disabled";}; echo" type=submit name=btnG VALUE='arrivé' style='width:60px; height:20px;font-size:12px; color:blue;'>";
	      echo "</FORM>";
		    echo"</div>";

		    echo "<div id='cpehn_link1' style='position:absolute; left:500px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../formations/cpehn_presences_depart.php' target='page'>";
	      echo " <INPUT "; if ($user_actif==0) {echo "disabled";}; echo" type=submit name=btnG VALUE='départ' style='width:60px; height:20px;font-size:12px; color:blue; '>";
	      echo "</FORM>";
		    echo"</div>";

		    echo "<div id='cpehn_link1' style='position:absolute; left:580px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../formations/cpehn_absence.php' target='page'>";
	      echo " <INPUT "; if ($user_actif==0) {echo "disabled";}; echo" type=submit name=btnG VALUE='absence' style='width:60px; height:20px;font-size:12px; color:blue; '>";
	      echo "</FORM>";
		    echo"</div>";

 		    echo "<div id='cpehn_link1' style='position:absolute; left:200px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../formations/cpehn_presences_liste_participant.php' target='page'>";
	      echo " <INPUT "; if ($user_actif==0) {echo "disabled";}; echo" type=submit name=btnG VALUE='pointages' style='width:70px; height:20px;font-size:12px; color:black; '>";
	      echo "</FORM>";
		    echo"</div>";

 		    echo "<div id='cpehn_link1' style='position:absolute; left:580px; top:3px; z-index:1; color:#f0f0f0'>";	
		    echo "<FORM  >";
	      echo " <INPUT type=submit name=btnG VALUE='code :' style='width:40px; height:20px;font-size:12px;'>";
	      $ID_pointage = $user_ID*100000+date("y",time())*1000+date("z",time());
	      echo $ID_pointage;
	      echo "</FORM>";
		    echo"</div>";

		   }
    // ------------------ Gestion des formation pour le coordonnateur loggé --------------------------
      if (($loginStrGroup == 'coordonnateur') or ($loginStrGroup == 'admin')) 
       {
		    echo "<div id='cpehn_link1' style='position:absolute; left:300px; top:25px; z-index:1'>";	
		    echo "<FORM method=GET action='../formations/cpehn_Gestformation.php' target='page'>";
	      echo " <INPUT type=submit name=btnG VALUE='Formations' style='width:90px; height:20px;font-size:12px;'>";
	      echo "</FORM>";
		    echo"</div>";
		   }		   
    }
  else
    {
    	echo "<div id='Layer11' style='position:absolute; right:5px; bottom:10px; width:20px; height:20px; z-index:1'>";
    	echo "   <a href='./XAdmin/login.php' target='page'> <img src='/images/keys.gif' width='20' height='20' border='0'>	</a>";
    	echo "</div>";
    }
?>

</body>
 


</html>