<?
header('Content-Type: text/html; charset=ISO-8859-1'); // écrase l'entête utf-8 envoyé par php
ini_set( 'default_charset', 'ISO-8859-1' );
?><html>
	<head> 
		<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' /> 
		<style type="text/css">
	
table { /* style de table */
	font-family:arial;
	color:black;
	font-size:20px;
}
	</style>
	</head>
	<body>
		<div style='position:absolute; left:250px; top:10px; width:1000px; z-index:1 text-align:center; font-size:14px; color:black; border-style:solid; border-width:0pt;'>
				<h2> <u>Formations en cours </u> <h2>
			<center>
		<? 
  		$file1 = $_SERVER['DOCUMENT_ROOT']."/planningGlobalSemaine.php";  
			include $file1; 
		?>
			</center>
		</div>

	</body>
</html>