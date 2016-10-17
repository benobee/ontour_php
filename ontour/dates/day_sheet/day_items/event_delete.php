<?php session_start(); ?>
<?php ob_start(); ?>
<?php

include "dbconnect.php";
include "handler.php";
include "classes.php";
	
if ($_COOKIE["eventID"])
	{
		$id = $_COOKIE["eventID"];
	}
	
		
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
$parent_id = $_SESSION['parent'];
$parent_page = $_SESSION['parent_page'];
	
mysqli_query($con,"DELETE FROM events WHERE id = '$id'");

// close connection 
mysqli_close($con);
?>



