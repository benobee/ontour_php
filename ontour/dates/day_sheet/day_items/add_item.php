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

$thedate = date("Y-m-d H:i:s", strtotime($_POST['event_date'].$_POST['event_time']));

$address = $_POST[event_street_number] . " " . $_POST[event_route];
$business_name = $_POST[event_address];
list($name) = explode(",", $business_name);

				mysqli_query($con,"INSERT INTO events 
				(event_time,
				event_type, 
				event_details, 
				session_username, 
				event_date, 
				event_status, 
				event_name, 
				event_street_number, 
				event_route, 
				event_locality, 
				event_administrative_area_level_1, 
				event_postal_code, 
				event_country, 
				event_business_name,
				show_id)
				
				VALUES
				('$thedate',
				 '$_POST[event_type]',
				 '$_POST[event_details]',
				 '$_POST[session_username]',
				 '$_POST[show_date]',
				 '$_POST[event_status]',
				 '$_POST[event_name]',
				 '$_POST[event_street_number]',
				 '$_POST[event_route]',
				 '$_POST[event_locality]',
				 '$_POST[event_administrative_area_level_1]',
				 '$_POST[event_postal_code]',
				 '$_POST[event_country]',
				 '$name',
				 '$_POST[show_id]')");
	
$id = $_SESSION['parent'];
mysqli_close($con);
?>

