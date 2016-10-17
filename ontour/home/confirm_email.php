<?php
require_once 'google/appengine/api/mail/Message.php';
use \google\appengine\api\mail\Message;

$to = $_POST['email'];
$subject = 'On Tour Email Verification';		
$userinfo = mysqli_query($con,"SELECT * FROM users WHERE username = '$email'");

$telltext = 'VERIFICATION LINK: http://www.ontour.voyage/signup.php?number='.md5($number).'*'.$to.'?route="confirm"';
$insttext = 'Click the link to verify your email.';
		
$messagetext = 'ON TOUR VERIFICATION - '.$insttext.' '.$telltext;
		
try{
	$message = new Message();
	$message->setSender("webmaster@ontour.voyage");
	$message->addTo($to);
	$message->setSubject($subject);
	$message->setTextBody($messagetext);
	$message->send();
	
} catch (InvalidArgumentException $e){
  // ...
}

?>		