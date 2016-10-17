<?php ob_start(); ?>
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";

	$number = rand();
	$email = $_POST['email'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	$pass = md5($_POST['password']);

	$password = md5($_POST['password']);
	$confirm_password = md5($_POST['confirm_password']);

	mysqli_query($con,"INSERT INTO users (username, first_name, last_name, password, active, email_confirm)	
	VALUES ('$email','$first','$last','$pass','1','$number')");
	
	require_once 'google/appengine/api/mail/Message.php';
	use \google\appengine\api\mail\Message;

	$to = $_POST['email'];
	$subject = 'On Tour Email Verification';		
	$userinfo = mysqli_query($con,"SELECT * FROM users WHERE username = '$email'");

	$telltext = 'VERIFICATION LINK: http://www.ontour.voyage/?number='.md5($number).'*'.$to.'&route=confirm';
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