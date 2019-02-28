<?php
session_start();

if (isset($_GET['submit_clr']))                  // effacer les actions cloturées
  {
  	$nom_clr=$_GET['nom_clr'];
  	$annee_clr=$_GET['annee_clr'];
  	if ($nom_clr=="cpehn")
      { 
       if ('2010' == $annee_clr) // on vérifie si l'année est 2009 pour réinitialiser
			   {	    	
     	     // copie du fichier log
     	     $file = 'log.txt';
     	     $newfile = 'log'.date("dFY-Gis").'.txt';
     	     if (!copy($file, $newfile)) { echo "La copie du fichier $file n'a pas réussi...\n";}
     	     
     	     // réinitialisation du fichier log
     	     $handle = fopen ('log.txt', 'w+');
           $message = ' réinitialisation du log le '. date("l d F Y , G:i:s") . ' par '.$nom_clr.'<br>';
           fwrite ($handle, $message); 
           fclose($handle);
    	   }  
      }
    else
      {
      	echo "Commande refusé. Je ne vous connais pas! <br>";
        echo" Petit malin, tu n'a pas mieux à faire... <br>";
      }	  
  }

?>

<html>
<head>
<title>visualisation du fichier log</title>
<link href="cpehn.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body>
<h1>Visualisation du fichier de log</h1>
<br>
<? include 'log.txt'; ?>
<br>

<form name="clear_log" action="visulog.php" method="get">
Ton nom : <input name='nom_clr' type="text" />
Ton année de naissance : <input name='annee_clr' type="text" size="4" />
<input name='submit_clr' type="submit"  id='submit_clr' value="nettoyer" />

</form> 


</body>
</html>



