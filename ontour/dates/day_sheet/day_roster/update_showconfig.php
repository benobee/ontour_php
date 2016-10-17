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

$sun = $_SESSION['nameid'];

$query2 = $handler->query("SELECT * FROM bands WHERE parent = '$sun' ORDER BY name");
$results = $query2->fetchALL(PDO::FETCH_ASSOC);
	
$parent = $_SESSION['nameid']; 
$member = $_POST[member];
$date = $_SESSION['showdate'];

foreach ($_POST['member'] as $going)
	{
	
		list($info) = explode("!", $going);
		
		list($date, $email) = explode(",", $info);
		
		mysqli_query($con,"INSERT INTO show_config (parent, member, show_date)	
		VALUES
		('$parent','$email','$date')");
		
	}
		
mysqli_close($con);	
?>
