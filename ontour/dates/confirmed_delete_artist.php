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

$sun = $_POST['nameid'];
		
mysqli_query($con,"DELETE FROM shows WHERE session_username ='$sun'");

mysqli_query($con,"DELETE FROM events WHERE session_username = '$sun'");

mysqli_query($con,"DELETE FROM show_config WHERE parent = '$sun'");

mysqli_query($con,"DELETE FROM bands WHERE parent = '$sun'");

mysqli_query($con,"DELETE FROM band_names WHERE id = '$sun'");
	
// close connection 
mysqli_close($con);
?>
