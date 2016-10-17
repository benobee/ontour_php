<?php session_start(); ?>
<?php ob_start(); ?>
<?php

require "dbconnect.php";
require "handler.php";
include "classes.php";

if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$id = $_COOKIE["clickID"];

session_start();

$sun = $_SESSION['nameid'];
$show = mysqli_query($con,"SELECT * FROM shows WHERE id = '$id'");

	while($row = mysqli_fetch_assoc($show))
			{
				$showdate = $row['show_date'];	
			}
		
mysqli_query($con,"DELETE FROM shows WHERE id ='$id'");

mysqli_query($con,"DELETE FROM events WHERE event_date ='$showdate' AND session_username = '$sun'");

mysqli_query($con,"DELETE FROM show_config WHERE show_date ='$showdate' AND parent = '$sun'");

header("Location: dates.php");
	
// close connection 
mysqli_close($con);
?>

