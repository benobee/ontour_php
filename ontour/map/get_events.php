<?php session_start();
require "dbconnect.php";
require "handler.php";
include "classes.php";
$today = $_SESSION['today'];
$sun = $_SESSION['nameid'];

$query = ("
SELECT 
id as show_id, 
show_location, 
show_type, 
show_date, 
show_venue, 
session_username, 
show_status, 
venue_address, 
venue_city, 
venue_state, 
venue_zipcode, 
venue_country, 
venue_route 

FROM shows 
WHERE session_username = '$sun'
AND
show_date >= '$today' 
ORDER BY show_date LIMIT 90");

$show_query = mysqli_query($con,$query);

while($event = mysqli_fetch_all($show_query)){
echo json_encode($event);
}

?>