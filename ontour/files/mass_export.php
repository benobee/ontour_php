<?php ob_start(); ?>
<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;

include "dbconnect.php";
include "handler.php";
include "classes.php";
session_start();
$id = $_SESSION['nameid'];	
		
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$sun = $_SESSION['nameid'];

if ($_POST['thedates'] == "1")
{	

$filename = 'daysheets_'.$sun."-".strtotime("now") .'.csv';
$options = stream_context_create(['gs'=>['acl'=>'public-read']]);
$object_url = 'gs://proven-signal-627.appspot.com/'.$filename;							
$output = fopen('gs://proven-signal-627.appspot.com/'.$filename, 'w', false, $options);
			
fputcsv($output, array('DATE', 'DAY INFO', 'LOCATION', 'CONTACT'));
fputcsv($output, array(''));			
foreach($_POST['dates'] as $date) 
				{	
					$query = ("SELECT 
							shows.show_date as DATE, 
							shows.show_venue as VENUE,
							shows.venue_address as ADDRESS,
							shows.venue_route as STREET,
							shows.venue_city as CITY,
							shows.venue_state as STATE,
							shows.venue_zipcode as POSTAL,
							shows.venue_country as COUNTRY,
							shows.show_contact as CONTACT,
							shows.show_contact_phone as PHONE,
							shows.show_contact_email as EMAIL,
							shows.session_username,
							shows.show_status as STATUS,
							shows.show_tour as TOUR,
							shows.show_type as TYPE
	
							FROM shows
							WHERE shows.show_date = '$date'
							AND shows.session_username = '$sun'
							ORDER by shows.show_date 
							");
							
					$events = ("SELECT 
							event_type as TYPE, 
							event_date, 
							event_time as TIME,
							event_business_name as VENUE,
							event_street_number as ADDRESS,
							event_route as STREET,
							event_postal_code as POSTAL,
							event_contact as CONTACT,
							event_contact_email as EMAIL,
							event_contact_phone as PHONE
							FROM events 
							WHERE session_username = '$sun'
							AND event_date = '$date'
							ORDER BY event_time");	
							
					$daysheet = mysqli_query($con,$events);		
					$dates = mysqli_query($con,$query);		
					while ($row = mysqli_fetch_assoc($dates)) 
						{
							fputcsv($output, array(strtoupper(date("D\rM-d\rY", strtotime($row['DATE']))), 
							
							$row['STATUS']."\r".
							$row['TOUR']."\r".
							$row['TYPE'],
							
							$row['VENUE']."\r".
							$row['ADDRESS']." ".$row['STREET']."\r".
							$row['CITY']." ". $row['STATE']." ".$row['POSTAL'],
							
							$row['CONTACT'] ."\r". 
							$row['PHONE']."\r". 
							$row['EMAIL']
							
							));
						}
					fputcsv($output, array(''));	
					while ($row = mysqli_fetch_assoc($daysheet)) 
						{
							fputcsv($output, array('',date("g:i A", strtotime($row['TIME'])) ." ". ucwords($row['TYPE']),
							$row['VENUE']." ".$row['ADDRESS']." ".$row['STREET']." ".$row['POSTAL'],
							$row['CONTACT']." ".$row['PHONE']." ".$row['EMAIL']
							));		
						}
						
					fputcsv($output, array(''));
				}
	
fclose($output);

$object_public_url = CloudStorageTools::getPublicUrl($object_url, false);
mysqli_query($con,"INSERT INTO files (filename, session_username)	
VALUES
('$object_public_url','$id')");

}
	
mysqli_close($con);	
?>