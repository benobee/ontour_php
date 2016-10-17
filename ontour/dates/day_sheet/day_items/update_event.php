<?php session_start(); ?>
<?php ob_start(); ?>
<?php

include "dbconnect.php";
include "handler.php";
include "classes.php";
	
session_start();
		
if (mysqli_connect_errno())
  {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
if ($_COOKIE["eventID"])
	{
		$id = $_COOKIE["eventID"];
	}
	
$sun = $_SESSION['nameid'];

$status = $_POST['event_status'];
$type = $_POST['event_type'];

$venue = $_POST['event_address'];
list($venue_name) = explode(",", $venue);
 
$event_contact = $_POST['event_contact'];
$phone = $_POST['event_contact_phone'];
$email = $_POST['event_contact_email'];

$address = $_POST['event_street_number'];
$no_characters = "'";
$venue = str_replace($no_characters, "", $_POST['event_address']);
list($venue_name) = explode(",", $venue);

$city = $_POST['event_locality'];
$state = $_POST['event_administrative_area_level_1'];
$postal = $_POST['event_postal_code'];
$country = $_POST['event_country'];
$time = $_POST['event_date'] . " " . $_POST['event_time'];

mysqli_query($con,"UPDATE events
 
SET 
event_status = '$status',
event_type = '$type',
event_contact = '$event_contact',
event_contact_phone = '$phone',
event_contact_email = '$email',
event_time = '$time',
event_locality = '$city',
event_administrative_area_level_1 = '$state',
event_postal_code = '$postal',
event_country = '$country',
event_business_name = '$venue_name',
event_street_number = '$address',
event_route = '$_POST[event_route]',
event_details = '$_POST[event_details]'

WHERE id = '$id'");

mysqli_close($con);

?>

