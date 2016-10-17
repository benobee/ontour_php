
<?php

require "dbconnect.php";
require "handler.php";
// Check connection
if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
session_start();

$id = $_SESSION['parent']; 
$sun = $_SESSION['username'];  
$name = $_POST[name];
$date = $_POST[show_date];
$parent = $_POST[owner];

list($name, $role, $email) = explode("-", $name);
 
mysqli_query($con,"INSERT INTO show_config (parent, members, show_date, name, role)				
				   VALUES ('$parent', '$email', '$date','$name','$role')");	

header("Location: show_view.php?id=" . $id);	

mysqli_close($con);

?>