<?php
require_once 'google/appengine/api/mail/Message.php';
use \google\appengine\api\mail\Message;

$to = $_POST['username'];
$subject = "Password Reset";
$telltext = 'RESET PASSWORD LINK: http://www.ontour.voyage/home.php?number='.$number.'*'.$to;
$insttext = 'Click the link to reset your password.';
$messagetext = '
ON TOUR NOTIFICATION - '.$insttext.' '.$telltext;
		
// Always set content-type when sending HTML email
//$headers = "MIME-Version: 1.0" . "\r\n";
//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
//$headers .= 'From: OnTour Notification<webmaster@ontour.voyage>' . "\r\n";

try
{
	$message = new Message();
	$message->setSender("webmaster@ontour.voyage");
	$message->addTo($to);
	$message->setSubject($subject);
	$message->setTextBody($messagetext);
	$message->send();
} catch (InvalidArgumentException $e) 
{
  // ...
}
?>		