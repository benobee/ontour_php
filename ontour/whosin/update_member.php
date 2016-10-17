<?php session_start(); ?>
<?php ob_start(); ?>
<?php
require "dbconnect.php";
require "handler.php";

if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$id = $_COOKIE['memberID'];

mysqli_query($con,"UPDATE bands
		 
		SET 

		member = '$_POST[username]',
		role = '$_POST[role]',
		name = '$_POST[name]',
		phone = '$_POST[phone]',
		category = '$_POST[group]',
		admin = '$_POST[admin]'

		WHERE id = '$id'");

mysqli_close($con);
?>



