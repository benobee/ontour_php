<?php session_start(); ?>
<?php ob_start(); ?>
<?php

include "dbconnect.php";
include "handler.php";
include "classes.php";
		
if ($_COOKIE["memberID"])
	{
		$id = $_COOKIE["memberID"];
	}
				
if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$email = $_SESSION['thememberemail'];
$band = $_SESSION['thememberband'];

mysqli_query($con,"DELETE FROM bands WHERE id ='$id'");

mysqli_query($con,"DELETE FROM show_config WHERE member = '$email' AND parent = '$band'");

?>


