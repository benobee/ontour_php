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
  
	{
		$id = $_SESSION['band_id'];
	}
		
mysqli_query($con,"DELETE FROM bands WHERE id ='$id'");
	
// close connection 
mysqli_close($con);
?>

