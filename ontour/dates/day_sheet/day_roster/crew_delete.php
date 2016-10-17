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
  
if ($_COOKIE["memberID"]) 
	{
		$id = $_COOKIE["memberID"];
	}

mysqli_query($con,"DELETE FROM show_config WHERE id ='$id'");
header("Location: day_roster.php?id=". $_SESSION['roster']);
?>


