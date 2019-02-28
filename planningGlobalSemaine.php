
<?php 



function Text_adapt($text)
{
	$Atext=stripslashes(htmlentities($text));
//	$Atext=stripslashes(htmlentities($text, ENT_QUOTES, "ISO8859-1"));
	return $Atext;
}

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
function affiche_cours($jour,$cours)   //   *************** fonction d'affichage du module
  {
   $today = mktime()+3600*1;
   if (abs($today - ($jour+3600*2 ))<3600*2)  {	echo '<td style="background-color:#FFDC9B; color:black">'; }
   else { if ($jour < $today)       { echo '<td style="background-color:#e8e8e8; color:#C2C2C2">'; }
	        if ($jour > $today)       { echo '<td style="background-color:#e8e8f8; color:black">'; }
	      } 
   //echo $jour;
   echo Text_adapt($cours).'&nbsp';
   echo '</td>';
  }
function affiche_formateur($jour,$cours)   //   *************** fonction d'affichage du module
  {
   $today = mktime()+3600*1;
   if (abs($today - ($jour+3600*2 ))<3600*2)  {	echo '<td style="background-color:#FFDC9B; color:black; font-size:70%;">'; }
   else { if ($jour < $today)       { echo '<td style="background-color:#e8e8e8; color:#C2C2C2; font-size:70%;">'; }
	        if ($jour > $today)       { echo '<td style="background-color:#f0f0f0; color:black; font-size:70%;">'; }
	      } 
//   echo intval(($jour-$today)/60);
   echo '&nbsp'.Text_adapt($cours);
   echo '</td>';
  } 
  
// ******************************************************************************************************************************************************  
  $Njour = array(1 => "Lundi",2 =>"Mardi",3 =>  "Mercredi",4 => "Jeudi",5 => "Vendredi" );
  $ind_week = date("W");
  $ind_annee = date("Y");
  $ind_monday = getisomonday($ind_annee, $ind_week);
  $ind_today = mktime (1,1,1);
  $ind_jour_today = date("N");
  $ind_tomorrow =  $ind_today + (1 * 24 * 60 * 60); 
  $ind_jour_tomorrow = date("N") +1 ;
  $ind_week2 = $ind_week;
  if ($ind_jour_tomorrow == 6) {$ind_jour_tomorrow =1; $ind_tomorrow =  $ind_today + (3 * 24 * 60 * 60);  $ind_week2 =$ind_week+1; }

 	$sem = $ind_week-$Semaine_debut;
 	if ($sem<0) {$sem = $sem + 53;}

// ----------- On prend les formations ouvertes ----------------------------------------- 	
 	
 	require ($_SERVER['DOCUMENT_ROOT']."/NAdmin/connectioncpehn.php");
  $link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
  mysql_select_db(nom_BASE,$link);
  $query = "SELECT * FROM `formations` WHERE `verrou` LIKE 'off'";
  if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
  $ind =0;
	while($dbrow = mysql_fetch_row($dbresult))  {  $ind++; $Répertoire[$ind] = $dbrow[13]; $ID_formation[$ind]=$dbrow[0]; $Intitule_Form[$ind]=$dbrow[2]; }
	$NbrFmt=$ind;
							
  //-------------- On recherche les cours et les lieux de chaque formation pour le jours en cours ----------------------

  for ($ind = 1; $ind <= $NbrFmt; $ind++) 
   {
//   echo $ind." : ".$Intitule_Form[$ind]." - "."./".$Répertoire[$ind]."/planning/formation.xml <br>";

 	  $fileName=$_SERVER['DOCUMENT_ROOT']."/".$Répertoire[$ind]."/planning/formation.xml";
// 	  echo $fileName."<br>";
		$Formation = new DomDocument();
 		$Formation->load($fileName);
		$Data = $Formation->getElementsByTagName('Formation')->item(0); 
		$Nom = $Data->getElementsByTagName('nom_formation')->item(0)->textContent;                     	$Intitule[$ind]=utf8_decode($Nom);
		$Dates = $Data->getElementsByTagName('dates')->item(0);
	   $Annee_start = $Dates->getElementsByTagName('annee_debut')->item(0)->textContent; 	
  	 $Semaine_start = $Dates->getElementsByTagName('Semaine_debut')->item(0)->textContent; 	
	   $Annee_end = $Dates->getElementsByTagName('annee_fin')->item(0)->textContent; 	
  	 $Semaine_end = $Dates->getElementsByTagName('Semaine_fin')->item(0)->textContent; 	
	   $Start_monday = getisomonday($Annee_start, $Semaine_start);
		$Nbr_modules = $Data->getElementsByTagName('Nbr_modules')->item(0)->textContent; 	
		$Lieu_Ref = utf8_decode($Data->getElementsByTagName('Lieu_principal')->item(0)->textContent); 	
	  $Modules = $Data->getElementsByTagName('Modules')->item(0);
  	$Liste_modules = $Modules->getElementsByTagName('module');
	  $Planning = $Data->getElementsByTagName('planning')->item(0);
  	$statut = $Planning->getAttribute('statut');
	  $Liste_semaines = $Planning->getElementsByTagName('Semaine');
		// ------------------------ Table des modules ---------------------------------------------    	
		foreach ($Liste_modules as $module) 
		{
			$ID = $module->getElementsByTagName('ID')->item(0)->textContent;
			$Intitule[$ID] = utf8_decode($module->getElementsByTagName('Intitule')->item(0)->textContent);
			$Formateur[$ID] = utf8_decode($module->getElementsByTagName('Formateur')->item(0)->textContent);
			$Lieu[$ID] = utf8_decode($module->getElementsByTagName('Lieu')->item(0)->textContent);
		}
 		require ($_SERVER['DOCUMENT_ROOT']."/NAdmin/connectioncpehn.php");
	  $link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
  	mysql_select_db(nom_BASE,$link);
	  $table = 'modules';
  	$query = "SELECT * FROM $table WHERE `type` != 'cours' ORDER BY `intitule` ASC";  if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }	
	 	while($dbrow = mysql_fetch_row($dbresult))
  	 {
				$ID = $dbrow[0];
				$Intitule[$ID] = $dbrow[1];
				$Formateur[$ID] = ""; // $dbrow2[4]." ".$dbrow2[3];
				$Lieu[$ID] = "";  //  $dbrow[3];
	 	 } 
		// --------------------------------------------------------------------------------------  
		
		foreach ($Liste_semaines as $semaine) 
		{
			$annee = $semaine->getElementsByTagName('annee')->item(0)->textContent;
			$NrSem = $semaine->getElementsByTagName('NrSemaine')->item(0)->textContent;

			if ( ($ind_week == $NrSem) AND ($ind_jour_today == 1) ) 
			   { $Lundi = $semaine->getElementsByTagName('Lundi')->item(0);
				   $Today_AM[$ind] = $Lundi->getElementsByTagName('AM')->item(0)->textContent;
				   $Today_PM[$ind] = $Lundi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week == $NrSem) AND ($ind_jour_today == 2) ) 
			   { $Mardi = $semaine->getElementsByTagName('Mardi')->item(0);
				   $Today_AM[$ind] = $Mardi->getElementsByTagName('AM')->item(0)->textContent;
				   $Today_PM[$ind] = $Mardi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week == $NrSem) AND ($ind_jour_today == 3) ) 
			   { $Mercredi = $semaine->getElementsByTagName('Mercredi')->item(0);
				   $Today_AM[$ind] = $Mercredi->getElementsByTagName('AM')->item(0)->textContent;
				   $Today_PM[$ind] = $Mercredi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week == $NrSem) AND ($ind_jour_today == 4) ) 
			   { $Jeudi = $semaine->getElementsByTagName('Jeudi')->item(0);
				   $Today_AM[$ind] = $Jeudi->getElementsByTagName('AM')->item(0)->textContent;
				   $Today_PM[$ind] = $Jeudi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week == $NrSem) AND ($ind_jour_today == 5) ) 
			   { $Vendredi = $semaine->getElementsByTagName('Vendredi')->item(0);
				   $Today_AM[$ind] = $Vendredi->getElementsByTagName('AM')->item(0)->textContent;
				   $Today_PM[$ind] = $Vendredi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
				 
			if ( ($ind_week2 == $NrSem) AND ($ind_jour_tomorrow == 1) ) 
			   { $Lundi = $semaine->getElementsByTagName('Lundi')->item(0);
				   $Tomorrow_AM[$ind] = $Lundi->getElementsByTagName('AM')->item(0)->textContent;
				   $Tomorrow_PM[$ind] = $Lundi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week2 == $NrSem) AND ($ind_jour_tomorrow == 2) ) 
			   { $Mardi = $semaine->getElementsByTagName('Mardi')->item(0);
				   $Tomorrow_AM[$ind] = $Mardi->getElementsByTagName('AM')->item(0)->textContent;
				   $Tomorrow_PM[$ind] = $Mardi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week2 == $NrSem) AND ($ind_jour_tomorrow == 3) ) 
			   { $Mercredi = $semaine->getElementsByTagName('Mercredi')->item(0);
				   $Tomorrow_AM[$ind] = $Mercredi->getElementsByTagName('AM')->item(0)->textContent;
				   $Tomorrow_PM[$ind] = $Mercredi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week2 == $NrSem) AND ($ind_jour_tomorrow == 4) ) 
			   { $Jeudi = $semaine->getElementsByTagName('Jeudi')->item(0);
				   $Tomorrow_AM[$ind] = $Jeudi->getElementsByTagName('AM')->item(0)->textContent;
				   $Tomorrow_PM[$ind] = $Jeudi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 	
			if ( ($ind_week2 == $NrSem) AND ($ind_jour_tomorrow == 5) ) 
			   { $Vendredi = $semaine->getElementsByTagName('Vendredi')->item(0);
				   $Tomorrow_AM[$ind] = $Vendredi->getElementsByTagName('AM')->item(0)->textContent;
				   $Tomorrow_PM[$ind] = $Vendredi->getElementsByTagName('PM')->item(0)->textContent; 
				 }			 					 
				 
  	}	 
  }  	



echo '<table border="1">';
    echo '  <tr style="background-color:#d0d0d0;"> <th></th>';
    for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<th width='250'>".$Intitule_Form[$ind]." </th>";}
    echo '  </tr>';
    echo '  <tr style="background-color:#b0b0b0;"> <th colspan='.($NbrFmt+1).' align="left">Aujourd\'hui '.$Njour[$ind_jour_today].' '.date('d/m/Y', $ind_today).'</th>';
    echo '  </tr>';
		echo ' <tr><th>Matin</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { affiche_cours($ind_today+(3600*8.5),$Intitule[$Today_AM[$ind]]); echo"</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Formateur</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td>".Text_adapt($Formateur[$Today_AM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Lieu</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td>".Text_adapt($Lieu[$Today_AM[$ind]])."</td>";}
		echo '</th>';
		echo '</tr>';

		echo ' <tr><th>Apr&#232;s-midi</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { affiche_cours($ind_today+(3600*13),$Intitule[$Today_PM[$ind]]); echo"</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>formateur</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td>".Text_adapt($Formateur[$Today_PM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Lieu</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td>".Text_adapt($Lieu[$Today_PM[$ind]])."</td>";}
		echo '</th>';
		echo '</tr>';
		echo '</th>';
		echo '</tr>';

    echo '  <tr style="background-color:#b0b0b0;"> <th colspan='.($NbrFmt+1).' align="left">Demain '.$Njour[$ind_jour_tomorrow].' '.date('d/m/Y', $ind_tomorrow).'</th>';
		echo ' <tr><th>Matin</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Intitule[$Tomorrow_AM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Formateur</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Formateur[$Tomorrow_AM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Lieu</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Lieu[$Tomorrow_AM[$ind]])."</td>";}
		echo '</th>';
		echo '</tr>';

		echo ' <tr><th>Apr&#232;s-midi</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Intitule[$Tomorrow_PM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Formateur</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Formateur[$Tomorrow_PM[$ind]])."</td>";}
		echo '</th>';
    echo '  <tr style="font-size:70%;"><th>Lieu</th>';
		for ($ind = 1; $ind <= $NbrFmt; $ind++)    { echo "<td style='color:#555555;'>".Text_adapt($Lieu[$Tomorrow_PM[$ind]])."</td>";}
		echo '</th>';
		echo '</tr>';
?>
</table>
