<?
header('Content-Type: text/html; charset=ISO-8859-1'); // écrase l'entête utf-8 envoyé par php
ini_set( 'default_charset', 'ISO-8859-1' );
?><html>
	<head> 
		<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' /> 
	</head>
	<body>
		<div style='position:absolute; left:250px; top:10px; width:1000px; z-index:1 text-align:center; color:black; border-style:solid; border-width: 0pt;'>
			  <br>
			  <center><span style='color:black; font-style:italic; font-size:25pt;'>1er étage</span></center>
			  <img src="./images/plan_Etage.jpg" alt="plan rez de chaussée" width="900">
				<br><br><br>
			  <center><span style='color:black; font-style:italic; font-size:25pt;'>Rez de chaussée</span></center>
			  <img src="./images/plan_REZ_ici.jpg" alt="plan rez de chaussée" width="900">
		</div>
	</body>
</html>