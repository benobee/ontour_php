<?php session_start(); ?>
<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <title>On Tour</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ot.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 

<body class="default-venue">

<style>
		.default-venue {
		background: url("img/newsroom.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.paper {
		background: url("img/sheet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		width: 100%;
		}
		.navbar-iin {
		margin: 0px;
		width: 100%;
		border: 0px;
		}
		.ot-button{
		background: #2D2D2D;
		color: white;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.75;
		}
		.ot-text{
		color:white;
		}
		.venue-details{
		background: rgba(0, 0, 0, 0.20);
		color: #FCF7E4;
		vertical-align:text-middle;
		opacity: 0.93;
		padding:25px;
		border-bottom-left-radius:8px;
		border-bottom-right-radius:8px;
		}
</style>

	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">
	<link rel="icon" type="image/png" href="img/favicon.jpg">

	<!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
	
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";
		
if (mysqli_connect_errno())
    {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

$email = $_SESSION['username'];
$phone = $_POST['phone'];
$first = $_POST['first'];
$last = $_POST['last'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);

$link = "signup.php";

  if($password !== $confirm_password)
	{			
		echo '<div class = "container">
		<div class = "jumbotron paper" style="border-radius:4px;">
		<div class = "navbar navbar-iin">
		<div class = "navbar-text"><h2 style="color:#4C0000;"><span class = "fa fa-info-circle"></span> Oh Dude... </h2></div>
		</div>
					
		<p style="color:black;font-family:oswald;"> The passwords didn\'t match. Please try again. </p>
					
		<div class = "navbar">
		<a class = "btn btn-info pull-left ot-button" href="'.$link.'"><h6>Return to <span class = "fa fa-gear"></span> Create Password</h6></a>	
		</div>		
		</div></div>';
	}			
elseif ($password == $confirm_password)
	{
		mysqli_query($con,"UPDATE users SET password = '$password', first_name ='$first', last_name ='$last', confirmed = '1', phone='$phone' WHERE username = '$email'");
		header("Location: http://www.ontour.voyage/");
	}
					
mysqli_close($con);	
?>

</body>
</html>