<?php 
     
     $to      = 'rr@cpee.be';
//     $to 		 .= ','.'rr@cpehn.be';
//     $to 		 .= ','.'cb@cpehn.be';
     
     $subject = 'essai de mail automatique par le site web';
     
     $headers ='From: cb@cpehn.be'."\n";
     $headers .='Reply-To: cb@cpehn.be'."\n";
     $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
     $headers .='Content-Transfer-Encoding: 8bit';

		$message = " hello CPEHN";	

     
     mail($to, $subject, $message, $headers);
     
     echo "mail ok! <br><br>";
     echo "de : ".$headers ."<br>";
     echo "à : ".$to."<br>";
     echo "sujet : ".$subject."<br>";
     echo "message : <br>";
     echo $message;
     
?> 
