<?
header('Content-Type: text/html; charset=ISO-8859-1'); // écrase l'entête utf-8 envoyé par php
ini_set( 'default_charset', 'ISO-8859-1' );
?><html>
	<head> 
		<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' /> 
		
		<style type="text/css">		
.anima1 {
  animation-duration: 2s;
  animation-name: slidein1;
}

.anima2 {
	animation-delay: 2s;
  animation-duration: 3s;
  animation-direction: normal;
  animation-name: slidein2;
}

.anima3 {
	animation-delay: 4s;
  animation-duration: 2s;
  animation-direction: normal;
  animation-name: slidein3;
}

.anima4 {
	animation-delay: 6s;
  animation-duration: 3s;
  animation-direction: normal;
  animation-name: slidein4;
}

.anima5 {
	animation-delay: 8s;
  animation-duration: 3s;
  animation-direction: normal;
  animation-name: slidein5;
}

@keyframes slidein1 {  from {    left:0px; top:0px;  }  to {   left:50px; top:120px;  } }
@keyframes slidein2 {  from {    left:0px; top:0px;  }  to {   left:650px; top:130px;  } }
@keyframes slidein3 {  from {    left:0px; top:0px;  }  to {   left:80px; top:400px;  } }
@keyframes slidein4 {  from {    left:0px; top:0px;  }  to {   left:450px; top:350px;  } }



@keyframes slidein5 {
    0%   { left:0px; top:0px;}
    25%  { left:600px; top:50px;}
    50%  { left:100px; top:200px;}
    75%  { left:800px; top:350px;}
    100% { left:850px; top:500px;}
}

@keyframes flash {
	0% {
		opacity: .4;
	}
	100% {
		opacity: 1;
	}
}
</style>		
		
		
	</head>
	<body>
		<div style='position:absolute; left:150px; top:0px; width:1200px; z-index:1 text-align:center; color:black; border-style:solid; border-width: 0pt;'>
				<h3> Nos formations pour demandeur d'emploi</h3>
				
				<div class="anima1" style="position:absolute; left:50px; top:120px; width:350px; border-radius: 15px 15px 1px 15px; border:0px solid gray; background: #ffffff; ">
					Soudeur
					<center><img src="./images/soudeur.jpg" alt="drone" width="300" style="position:relative; border-radius: 15px 15px 1px 15px;"></center>
				</div>

				<div class="anima2" style="position:absolute; left:650px; top:130px; width:350px; border-radius: 15px 15px 1px 15px; border:0px solid gray; background: #ffffff; ">
					Télématicien
					<center><img src="./images/telematique.jpg" alt="drone" width="300" style="position:relative; border-radius: 15px 15px 1px 15px;"></center>
				</div>

				<div class="anima3" style="position:absolute; left:80px; top:400px; width:350px; border-radius: 15px 15px 1px 15px; border:0px solid gray; background: #ffffff; ">
					Informaticien
					<center><img src="./images/informatique.jpg" alt="drone" width="300" style="position:relative; border-radius: 15px 15px 1px 15px;"></center>
				</div>

				<div class="anima4"style="position:absolute; left:450px; top:350px; width:350px; border-radius: 15px 15px 1px 15px; border:0px solid gray; background: #ffffff; ">
					Agent de méthode
					<center><img src="./images/methode.jpg" alt="drone" width="300" style="position:relative; border-radius: 15px 15px 1px 15px;"></center>
				</div>

				<div class="anima5"style="position:absolute; left:850px; top:500px; width:350px; border-radius: 15px 15px 1px 15px; border:0px solid gray; background: #ffffff; ">
					Dessinateur d'études
					<center><img src="./images/CAODAO.jpg" alt="drone" width="300" style="position:relative; border-radius: 15px 15px 1px 15px;"></center>
				</div>

		</div>
	</body>
</html>