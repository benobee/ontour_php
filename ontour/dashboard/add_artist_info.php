<?php session_start(); ?>
<?php ob_start(); ?>
<?php
include_once "dbconnect.php";
include_once"handler.php";
include_once "classes.php";
			
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$id = $_POST['dbid']; 
$famous = $_POST['famous'];
$buzz = $_POST['buzz'];
$url = $_POST['url'];
$mb_id = $_POST['mb_id'];

mysqli_query($con,"
		UPDATE band_names 		
		SET 
		famous = '$famous',
		buzz = '$buzz',
		image = '$url',
		mb_id = '$mb_id'
		WHERE id = '$id'");			
		
mysqli_close($con);	
?>
