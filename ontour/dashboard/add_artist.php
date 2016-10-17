<?php session_start();	?>
<?php ob_start(); ?>
<?php

require "dbconnect.php";
require "handler.php";
include "classes.php";

if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$first = $_SESSION['first_name'];
$last = $_SESSION['last_name'];	
$user = $_SESSION['username'];
$artist_id = $_POST['artist_id'];
$parent = $_SESSION['personid'];
$thename = addslashes($_POST['artist_name']);
$sun = $_SESSION['username'];
$_SESSION['getthename'] = $thename;
	
mysqli_query($con,"INSERT INTO band_names (name,parent,artist_id)	
VALUES
('$thename','$parent','$artist_id')");

include "add_artist_two.php";


?>