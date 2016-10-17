<?php session_start(); ?>
<?php ob_start(); ?>
<?php

require_once "dbconnect.php";
require_once "handler.php";
include_once "classes.php";

if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
$thename = $_SESSION['getthename'];
$parent = $_SESSION['personid'];
$user = $_SESSION['username'];
$artist_id = $_POST['artist_id'];

$find = mysqli_query($con,"SELECT * FROM band_names WHERE name = '$thename'");
while($row = mysqli_fetch_assoc($find))
	{
		$number = $row['id'];
	}
	
mysqli_query($con,"INSERT INTO bands (band_id, member, admin, parent, category)	
VALUES
('$number','$user','1','$number','1')");

mysqli_close($con);

?>