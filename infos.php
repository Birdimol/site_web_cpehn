<html>

<head>
<title>infos</title>
<link  rel="stylesheet" type="text/css" href="fl200.css" >
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="120"; url=infos.php">
<style type="text/css">
</style>
</head>

<body>


<HR align=left size=2 width=100%>
<h1> Style texte : h1</h1>
<h2> Style texte : h2</h2>
<h3> Style texte : h3</h3>
<h4> Style texte : h4</h4>
<h5> Style texte : h5</h5>
<h6> Style texte : h6</h6>
Style texte : body
<br>
<HR align=left size=2 width=100%>

<? 
  echo" php self : ".$_SERVER['PHP_SELF']."<br>";
  echo" Gateway : ".$_SERVER['GATEWAY_INTERFACE']."<br>";
  echo" Serveur : ".$_SERVER['SERVER_NAME']."<br>";
  echo" software : ".$_SERVER['SERVER_SOFTWARE']."<br>";
  echo" protocol : ".$_SERVER['SERVER_PROTOCOL']."<br>";
  echo" method : ".$_SERVER['REQUEST_METHOD']."<br>";
  if(isset($_SERVER['REQUEST_TIME'])) { echo" Time : ".$_SERVER['REQUEST_TIME']."<br>"; }
  echo" query string : ".$_SERVER['QUERY_STRING']."<br>";
  echo" root : ".$_SERVER['DOCUMENT_ROOT']."<br>";
  echo" accept : ".$_SERVER['HTTP_ACCEPT']."<br>";
  if(isset($_SERVER['HTTP_ACCEPT_CHARSET'])) { echo" Accept charset : ".$_SERVER['HTTP_ACCEPT_CHARSET']."<br>"; }
  echo" Accept encoding : ".$_SERVER['HTTP_ACCEPT_ENCODING']."<br>";
  echo" Accept language : ".$_SERVER['HTTP_ACCEPT_LANGUAGE']."<br>";
  echo" connection : ".$_SERVER['HTTP_CONNECTION']."<br>";
  echo" referer : ".$_SERVER['HTTP_REFERER']."<br>";
  echo" User agent : ".$_SERVER['HTTP_USER_AGENT']."<br>";
  echo" Host : ".$_SERVER['HTTP_HOST']."<br>";
  echo" remote adr : ".$_SERVER['REMOTE_ADDR']."<br>";
  if(isset($_SERVER['REMOTE_HOST'])) { echo" Remote Host : ".$_SERVER['REMOTE_HOST']."<br>";}
  echo" Remote port : ".$_SERVER['REMOTE_PORT']."<br>";
  echo" Remote signature : ".$_SERVER['SERVER_SIGNATURE']."<br>";
  echo" script file : ".$_SERVER['SCRIPT_FILENAME']."<br>";
  echo" script name : ".$_SERVER['SCRIPT_NAME']."<br>";
  echo" URI : ".$_SERVER['REQUEST_URI']."<br>";
  if(isset($_SERVER['PHP_AUTH_DIGEST'])) { echo" Authorization : ".$_SERVER['PHP_AUTH_DIGEST']."<br>"; }
  if(isset($_SERVER['PHP_AUTH_USER'])) { echo" Auth user : ".$_SERVER['PHP_AUTH_USER']."<br>"; }
  if(isset($_SERVER['PHP_AUTH_PW'])) { echo" Auth PW : ".$_SERVER['PHP_AUTH_PW']."<br>"; }
  if(isset($_SERVER['AUTH_TYPE'])) { echo" Auth type : ".$_SERVER['AUTH_TYPE']."<br>"; }
  
?>

<HR align=left size=2 width=100%>
<?  
  echo " Nous sommes le ".date("l d F Y , G:i:s")."<br>";
  echo "Espace libre sur le disque".disk_free_space("/")." / ".disk_total_space("/")." octets <br>";
?>

<HR align=left size=2 width=100%>
<?  
phpinfo();
?>


</body>

</html>

	

