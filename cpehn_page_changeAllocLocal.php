<?php
$editFormAction = $_SERVER['PHP_SELF']; 	

$ListeLocaux = array(1 => 'Réfectoire','Salle 2','Salle 3','Salle 4','Salle 5','Salle 6','Local 10','Salle 18','Local 19','Salle CA','Salle Table ronde',' ');

 if (isset($_POST['SwArchive'])) { $archive = 1;}    /// afficher les archives des occopations ou pas.
 														else { if (isset($_POST['hideArchive'])) { $archive = 0;}
 																															  else { $archive = 0;} 
 																 }

 if (isset($_GET['DelAllocID'])) 
    {
    	$DAllocID = $_GET['DelAllocID'];
  		require ("./XAdmin/connectioncpehn.php");
			$link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
  		mysql_select_db(nom_BASE,$link);
  		$table = 'locaux';
  		$query = "DELETE FROM $table WHERE `ID`=".$DAllocID." LIMIT 1"; 
  		if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
//			echo "efface allocation nr :".$DAllocID." <br>";
    } 

 if (isset($_POST['AddAllocID'])) 
    {
    	$ADate = $_POST['Aeventyear']."-".$_POST['Aeventmounth']."-".$_POST['Aeventday'];   $ADdatedb = date ("Y-m-d", strtotime($ADate));
    	$AAmPm = $_POST['AeventAmPm'];
    	$AFormation = $_POST['AddFormation'];
    	$ALocal = $_POST['AddLocal'];
    	$AComment = $_POST['AddComment'];
  		require ("./XAdmin/connectioncpehn.php");
			$link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
  		mysql_select_db(nom_BASE,$link);
  		$table = 'locaux';
  		$query = 'INSERT INTO `cpehn001`.`locaux` (`ID`, `date`, `AmPm`, `Evenement`, `local`, `comment`) VALUES (NULL, \''.$ADdatedb.'\', \''.$AAmPm.'\', \''.addslashes ($AFormation).'\', \''.$ALocal.'\', \''.addslashes ($AComment).'\');';
  		if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
// 			echo "Ajoute allocation du :".$ADate." <br>";
    } 


 if (isset($_POST['modif'])) // modification des 2 pages d'affichage des occupations des salles pour le matin et le midi
{
	$Ntexte1 = $_POST['texte1'];	
	$Aujourdhui =  date("Y-m-d");  
// cette partie doit etre le même dans le fichier cpehn_page_AllocLocal.php	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
require ("./XAdmin/connectioncpehn.php");
$link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
mysql_select_db(nom_BASE,$link);
$table = 'locaux';
$locaux_matin = 0;
$locaux_midi = 0;
$query = "SELECT * FROM $table WHERE `date` = '".$Aujourdhui."' ORDER BY  `locaux`.`date` ASC "; 
if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }

	$nbr_lignes = mysql_num_rows($dbresult);  

	$listeformations_top  = "<html><head> <meta http-equiv='content-type' content='text/html; charset=iso-8859-1' /> </head>";
	$listeformations_top .= "<body>";
	$listeformations_top .= "<br>"; //.$nbr_lignes."<br>";

	$listeformations_matin ="<table align=center border=0>";
	$listeformations_midi ="<table align=center border=0>";
	while($dbrow = mysql_fetch_row($dbresult))
    {
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="matin" )) {$listeformations_matin .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &rArr; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_matin = 1;}
			if (($dbrow[1] == $Aujourdhui) AND ($dbrow[2] =="midi" ))  {$listeformations_midi  .= "<tr><td><h2>".$dbrow[3]."</h2></td><td style='width:80px'> <h3> &rArr; </h3> </td><td> <h3>".$dbrow[4]." ".$dbrow[5]."</h3> </td></tr>"; $locaux_midi = 1;}
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
					
	$TableauFormations="<?php ";
	$TableauFormations .= '$Ntexte1 = "'.$Ntexte1.' ";';
	$TableauFormations .= "?> ";			
	$handle = fopen ('AllocLocal_table.php', 'w');
	fwrite ($handle, $TableauFormations); 
	fclose($handle);			
    } 
  else
		{
			$filename = "AllocLocal_info.php";
			$handle = fopen($filename, "rb");
			$listeformations = fread($handle, filesize($filename));
			fclose($handle);			

			include 'AllocLocal_table.php'; 
  	}

?>

<html>
<head>
	<title>CPE Hainaut-Namur</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Rudi REZ" />
</head>

<body>

<h1>Modification des information affichées</h1>

<? echo "<FORM method='post' ACTION='".$editFormAction."' >"; ?>
Texte déroulant : <input type="text" name="texte1" value="<? echo $Ntexte1; ?>" SIZE='100'> <br><br>
<INPUT name='modif' type='submit' id='submit_post' value='Actualiser le panneaux d affichage '>
</form>

<!-- Tableau des allocations des locaux -->
<div style='position:absolute; left:1000px; top:30px; width:200px; z-index:1 color:black; border-style:solid; border-width: 0pt;'>
<table border=1>
	<tr><th>Liste des locaux</th></tr>
<?php  foreach ($ListeLocaux as $key => $value)	 {	echo "<tr><td>".$value." </td></tr>";	}	?>
</table>	
</div>

<!-- Table des allocations des jours d'occupation des locaux --------------------------------------------------------------------------->
<div style='position:absolute; left:30px; top:150px; width:600px; z-index:1 color:black; border-style:solid; border-width: 1pt;'>
<b><u>gestion des allocations des locaux</u></b>
<br><br>
<? echo "<FORM method='post' ACTION='".$editFormAction."' >"; 
$actualday= date("d");
$actualmounth= date("m");
$actualyear= date("Y");
$mois = array(1 =>'Jan','Fev','Mar','Apr','May','Jun','Jul','Aou','Sept','Oct','Nov','Dec');
echo" Date :  "; 	     
echo " <SELECT name='Aeventday'> ";
for ($i = 1; $i <= 31; $i++) {  echo"<OPTION value='".$i."' ".(($i==$actualday)? "SELECTED" : "" )." >".$i."</option>";}
echo "</select>";
echo " <SELECT name='Aeventmounth'> ";
for ($i = 1; $i <= 12; $i++)	{ echo " <OPTION value='".$i."' ".(($i==$actualmounth)? "SELECTED" : "" )."  >".$mois[$i]."</option>";      	}
echo "</select>";
echo " <SELECT name='Aeventyear'> ";
for ($i = $actualyear; $i <= $actualyear+2; $i++) {echo " <OPTION value='".$i."' ".(($i==$actualyear)? "SELECTED" : "" )." >".$i."</option>"; 	}
echo "</select> ";
?>
<SELECT name='AeventAmPm'> 
 <OPTION value='matin'  SELECTED >matin</option>
 <OPTION value='midi'  >midi</option>
</select>
<br>
Activité : <input type="text" name="AddFormation" > 
 - Local : 
 <?php
 echo " <SELECT name='AddLocal'> ";
       foreach ($ListeLocaux as $key => $value)	 {  echo"<OPTION value='".$value."' ".(($value==$ListeLocaux[1])? "SELECTED" : "" )." >".$value."</option>";}
       echo "</select>";
 ?>
<br> Commentaire : <input type="text" name="AddComment" size="50"> <br>
<INPUT name='AddAllocID' type='submit' id='submit_post' value='Ajouter'>
</form>

-----------------------------------------------------------------------------------------------------<br><br>

<?php
  require ("./XAdmin/connectioncpehn.php");
  $link = mySql_connect(nom_SERVEUR,nom_USER,nom_PASSE);
  mysql_select_db(nom_BASE,$link);
  $table = 'locaux';
  $query = "SELECT * FROM $table ORDER BY  `locaux`.`date` ASC "; 
  if(!($dbresult = mysql_query($query,$link)))  {    print(" j'peu pas faire le query, ".mysql_error()." - query etait : $query <br>");  }
  
  $nbr_lignes = mysql_num_rows($dbresult);
print(" Liste des allocations des locaux ");

print("<TABLE BORDER='1' style='font-size:16px;' >");
print("<tr height='25' align='left' bgcolor='#CFD095'> <b></th><th><th> Date </th><th>  </th><th> Activité </th><th> Local </th><th> Commentaire </th></b></tr> ");
$index_record = 0;
$Aujourdhui =  date("Y-m-d");   
// echo" - now : ".$Aujourdhui." <br>";
while($dbrow = mysql_fetch_row($dbresult))
    {
			if ($dbrow[1] >= $Aujourdhui or ($archive==1)) 
				{
				$index_ID = $dbrow[0];
				if ($old_date != $dbrow[1]) {	print("<tr height='5'><td bgcolor='#d0d0d0' colspan=6></td></tr> ");}
 				$old_date = $dbrow[1];
      	print("<tr height='20' valign='center'> ");
      	if ($dbrow[1] >= $Aujourdhui) {print("<td height='20'> <a href='".$editFormAction."?DelAllocID=".$dbrow[0]."' target='_self'> <img src='./images/trash.gif' width='16' height='16' border='0'>	</a> </td>");}
				else {print("<td height='20'> &nbsp </td>");}
				if ($dbrow[1] == $Aujourdhui) {print("<td height='20' bgcolor='#00b000'><b>".$dbrow[1]."&nbsp</b></td>");} else {print("<td height='20'>".$dbrow[1]."&nbsp</td>");}
				print("<td height='20'>".$dbrow[2]."&nbsp</td><td height='20'>".$dbrow[3]."&nbsp</td><td height='20'>".$dbrow[4]."&nbsp</td><td height='20'>".$dbrow[5]."&nbsp</td>");
				print( "</tr>");
				}
	  $index_record++;
	} 
print("</table>");
mySql_close($link);
if ($archive==0) { print ("<FORM method='post' ACTION='".$editFormAction."' ><INPUT name='SwArchive' type='submit' id='submit_post' value='Voir les archives'> </form>");}
if ($archive==1) { print ("<FORM method='post' ACTION='".$editFormAction."' ><INPUT name='hideArchive' type='submit' id='submit_post' value='Cacher les archives'> </form>");}
?>

</div>

</body>

</html>