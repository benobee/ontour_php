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

$id = $_POST['nameid'];
$artist_name = $_POST['artist_name'];

mysqli_query($con,"UPDATE band_names SET name = '$artist_name' WHERE id = '$id'");

mysqli_close($con);	
?>
