<?php session_start(); ?>
<?php ob_start(); ?>
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";
			
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$id = $_SESSION['username']; 

$artist_name = $_POST['artist_name'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$biz = addslashes($_POST['biz']);
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['biz_name'] = stripslashes($biz);
$_SESSION['phone'] = $phone;

if($_POST['password'])	
	{
		if ($password !== $confirm_password)
		{			
			echo '<div class = "container">
					<div class = "jumbotron paper" style="border-radius:4px;">
					<div class = "navbar navbar-iin">
					<div class = "navbar-text"><h2 style="color:#4C0000;"><span class = "fa fa-info-circle"></span> Oh Dude... </h2></div>
					</div>
					
					<p style="color:black;font-family:oswald;"> The passwords didn\'t match. Please try again. </p>
					
					<div class = "navbar">
						<a class = "btn btn-info pull-left ot-button" href="user_settings.php"><h6>Return to <span class = "fa fa-gear"></span> User Settings</h6></a>	
					</div>		
					</div></div>';
		}
		elseif ($password === $confirm_password)
		{
			mysqli_query($con,"UPDATE users SET password = '$password' WHERE username = '$id'");
			echo '<div class = "container">
					<div class = "jumbotron paper" style="border-radius:4px;">
					<div class = "navbar navbar-iin">
					<div class = "navbar-text"><h2 style="color:green;"><span class = "fa fa-check-circle"></span> Success!</h2></div>
					</div>
					
					<p style="color:black;"> Password Changed.</p>
							
					</div></div>';	
		}			
	}
else
	{	
		mysqli_query($con,"UPDATE users SET 
		phone = '$phone',
		first_name = '$first_name',
		last_name = '$last_name',
		business_name = '$biz'
		WHERE username = '$id'");			
	}	
	
mysqli_close($con);	
?>
