<?php
require 'dbinfo.php';
$con = mysqli_connect("$dbhost","$dbuser","$dbpass","$dbname","$dbport","$dbsocket");
// Check connection
if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>

