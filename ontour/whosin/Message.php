
<?php
require_once 'google/appengine/api/mail/Message.php';

use \google\appengine\api\mail\Message;

if ($_POST['username'])
	{	
		$to = $_POST['username'];
	}
else
	{
		$to = $_SESSION['thememberemail'];
	}

$from = $name;
$subject = $artist . " Added You to The Roster";
		
$userinfo = mysqli_query($con,"SELECT * FROM users WHERE username = '$email'");
		while($row = mysqli_fetch_assoc($userinfo))
			{
				$ec = $row['confirmed'];
				$number_confirm = $row['email_confirm'];
			}
			
		if ($ec == 0)
			{
				$telltext = 'CONFIRM EMAIL: http://www.ontour.voyage/signup.php?number='.md5($number_confirm).'*'.$to;
				$insttext = $first.' '.$last.' has added you ('.$member . ' - ' . $role.') to the roster of '.$artist.' as '.$type.'. Confirm this email to join the lineup.';
			}
		else
			{	
				$telltext = 'LOGIN: http://www.ontour.voyage';
				$insttext = $first.' '.$last.' has added you ('.$member . ' - ' .$role.') to the roster of '.$artist.' as '.$type.'. Log in to view the dates that you\'ve been added to.';	
			}
			
$message = '
<html>
<head>
<title>ON TOUR MESSAGE</title>
<style>
@import url(http://fonts.googleapis.com/css?family=Oswald);
p {
font-family: "Oswald", sans-serif;
}
td{
font-family: "Oswald", sans-serif;
border-radius:4px;
padding:20px;
}
th{
font-family: "Oswald", sans-serif;
color:#FCF7E4;
border-radius:4px;
padding:20px;
}
a
{
background:#330A00;
color:#FCF7E4;
padding-left:5px;
padding-right:5px;
margin-right:10px;
}		
</style>
</head>
<body style="font-family: "Oswald", sans-serif;">
<table background="http://artisttoursupport.com/img/meet.jpg" style="width:100%;padding:10px;background-repeat:no-repeat;align:middle;">
<tr>
<th>
<img align="left" style="margin-bottom:20px;margin-left:10px;margin-top:22px;height:50px;width:50px;" src="http://www.artisttoursupport.com/img/logo.png" alt="OT">
		
<p style="margin-top:15px;">MESSAGE FROM:<br> 
'.$first.' '.$last.'</p>
</th>
<tr>
<td>		
<p style="background:#E6E6E6; padding:10px;border-radius:4px;">'.$inst.
'</p>'

.$tell.

'</td>
<tr>
</table>
</body>
</html>
';

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
	
} catch (InvalidArgumentException $e) {
  // ...
}

?>		