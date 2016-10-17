<?php ob_start(); ?>
<?php session_start(); ?>
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";
$email = $_POST['username'];

$userinfo = mysqli_query($con,"SELECT * FROM users WHERE username = '$email' LIMIT 1");
while($row = mysqli_fetch_assoc($userinfo))
	{
		$number = md5($row['email_confirm']);
	}
?>									
<?php
include "Message_pw.php";
?>
