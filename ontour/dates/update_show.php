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

$id = $_SESSION['parent'];
	
$venue = $_POST[event_address];
list($venue_name) = explode(",", $venue);
  
$sun = $_SESSION['username']; 

$status = $_POST['show_status'];
$show_contact = $_POST['show_contact'];
$show_contact_phone = $_POST['show_contact_phone'];
$show_contact_email = $_POST['show_contact_email'];
$show_type = $_POST['show_type'];
$tour = $_POST['show_tour'];
$show_location = $_POST['show_location'];

$address1 = $_POST[event_street_number];
$address2 = $_POST[event_route];
$no_characters = "'";
$venue = str_replace($no_characters, "", $_POST[event_address]);
list($venue_name) = explode(",", $venue);

$city = $_POST[event_locality];
$state = $_POST[event_administrative_area_level_1];
$postal = $_POST[event_postal_code];
$country = $_POST[event_country];
$capacity = $_POST[venue_capacity];

mysqli_query($con,"UPDATE shows
 
SET 
show_status = '$status',
show_type = '$show_type',
show_tour = '$tour',
venue_address = '$address1',
venue_route = '$address2',
show_venue ='$venue_name',
venue_country ='$country',
show_location ='$show_location',
venue_state ='$state',
venue_city ='$city',
venue_zipcode ='$postal',
show_contact = '$show_contact',
show_contact_phone = '$show_contact_phone',
show_contact_email = '$show_contact_email',
venue_capacity = '$capacity'

WHERE id = '$id'");
					
mysqli_close($con);

?>

