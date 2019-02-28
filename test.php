<?php
$editFormAction = $_SERVER['PHP_SELF']; 

function afficeXML($XDoc)
 {
	$System = array("NT 6.3"=>'Windows 8.1',"NT 6.2"=>'Windows 8',"NT 6.1"=>'Windows 7',"NT 6.0"=>'Windows Vista',"NT 5.2"=>'Windows Server 2003; Windows XP x64 Edition',
							 "NT 5.1"=>'Windows XP',"NT 5.01"=>'Windows 2000(SP1)',"NT 5.0"=>'Windows 2000',"NT 4.0"=>'Windows NT4.0',
							 "Android 4.2.1"=>'Android jelly bean 4.2.1',"Android 4.4.2"=>'Android KitKat 4.4.2'); 
	$Navig= array("MSIE 10.0"=>'Internet Explorer 10',"MSIE 9.0"=>'Internet Explorer 9',"MSIE 8.0"=>'Internet Explorer 8',"MSIE 7.0"=>'Internet Explorer 7',"MSIE 6.0"=>'Internet Explorer 6',
								"rv:11.0"=>'Internet Explorer 11',"Chrome"=>'Chrome',"Firefox"=>'Firefox'	);

	if(isset($_GET["IP"])) {$Ref_IP=$_GET["IP"]; } 

	echo"<u>contenu du fichier XML :</u><br>";
	$root = $XDoc->getElementsByTagName('Logs')->item(0); 
	$Items = $XDoc->getElementsByTagName('log'); 
	foreach ($Items as $item) 
	  {
			$Date = $item->getElementsByTagName('Date')->item(0)->nodeValue; 
			$IP = $item->getElementsByTagName('IP')->item(0)->nodeValue; 
			$User_agent = $item->getElementsByTagName('USER_AGENT')->item(0)->nodeValue; 
      if ( (!isset($Ref_IP)) or ($IP==$Ref_IP) ) 
      	{ 
					$Systeme = "autre";
					foreach ($System as $ident => $nom) 	{ if (preg_match(("/".$ident."/i"), $User_agent)) {$Systeme = $nom; } }
					$Navigateur = "autre";
					foreach ($Navig as $ident => $nom) 	{ if (preg_match(("/".$ident."/i"), $User_agent)) {$Navigateur = $nom; } }
					echo $Date." : ";
					echo "<a HREF=".$editFormAction."?liste&IP=".$IP." > -> </a><b>".$IP."</b> ( ".gethostbyaddr($IP).")";
					echo " / Nav: <b>".$Navigateur."</b> / OS: <b>".$Systeme."</b>";
					if ( ($Systeme == "autre") OR ($Navigateur == "autre") ) {echo " --> ".$User_agent."<br>";} else {echo "<br>";}
				}
	  }
echo "<br>**********************************************<br>";
}

?>


<html>
<head>
  <title>CPE Hainaut-Namur - Formations</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="author" content="Rudi REZ" />
  <link rel="stylesheet" type="text/css" media="screen" href="cpehn.css" title="default" />
  	<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

</head>

<body>
	

	
<?php	
	// modif du fichier de log - XML
	$fileName="log.xml";
	$XDoc_Logs = new DOMDocument( "1.0", "ISO-8859-15" );;
	if (file_exists($fileName)) { $XDoc_Logs->load($fileName);}
	 											 else { $root = $XDoc_Logs->createElement('Logs'); $XDoc_Logs->appendChild($root); echo "Le fichier $fileName n'existe pas."; }
	
	$root = $XDoc_Logs->getElementsByTagName('Logs')->item(0); 
	
	$serv = $_SERVER['HTTP_USER_AGENT'];
	$IPremote = $_SERVER['REMOTE_ADDR'];
	$Hostremote = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$LogDate = date("l d F Y , G:i:s");
//  echo $LogDate." --> [".$Hostremote."] : ".$serv."<br><br>";

	$xml_log = $XDoc_Logs->createElement( "log" );
	$xml_date = $XDoc_Logs->createElement( "Date", $LogDate );
	$xml_IP = $XDoc_Logs->createElement( "IP", $IPremote );
	$xml_svr = $XDoc_Logs->createElement( "USER_AGENT", $serv );

	$xml_log->appendChild( $xml_date );
	$xml_log->appendChild( $xml_IP );
	$xml_log->appendChild( $xml_svr );

	$root->appendChild( $xml_log );

//	$XDoc_Logs->save($fileName);

// Parse the XML.
	if(isset($_GET["liste"])) {	afficeXML($XDoc_Logs); } else { echo "test.php?liste <br>"; }
	
	
	
	$str = 'Un \'apostrophe\' en <strong>gras</strong> étage août';

	echo " HTML ENTITIES : ".$str." --> ".utf8_encode($str)." --> ".utf8_decode(utf8_encode($str));
	
?>	


	<textarea cols="80" id="editor2" name="editor2" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
	</textarea>

	<script>
		CKEDITOR.replace( 'editor2', {
			height: 260,
			/* Default CKEditor styles are included as well to avoid copying default styles. */
			contentsCss: [ 'http://cdn.ckeditor.com/4.6.2/full-all/contents.css', 'http://sdk.ckeditor.com/samples/assets/css/classic.css' ]
		} );
	</script>





	<textarea cols="80" id="editor1" name="editor1" rows="10" >&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;
	</textarea>

	<script>
		CKEDITOR.replace( 'editor1', {
			height: 260,
			width: 700,
		} );
	</script>


	


</body>
</html>
