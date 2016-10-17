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

$no_characters = "'";
$venue_name = str_replace($no_characters, "", $_POST[venue_name]);
$sun = $_SESSION['nameid'];

if ($_POST['bandsintown_date']){

$venue = addslashes($_POST['venue']);				
$country = $_POST['country'];					
$city = $_POST['city'];
$location = $_POST['lat'] . "\," . $_POST['lon'];

$formatted = $_POST['form_location'];
list($thecity, $thestate) = explode(",", $formatted);

$data = $_POST['bandsintown_date'];
list($thedate, $thetime) = explode("T", $data);

if ($thetime){
		$time = $thetime;
	}	
	else {
		$time = "20:00:00";		
	}

$perform = date("Y-m-d H:i:s", strtotime($thedate.$time));

$load = new DateTime($thedate.$time);
$check = new DateTime($thedate.$time);

$load->modify('-2 hour');
$loadin = $load->format('Y-m-d H:i:s');

$check->modify('-1 hour');
$soundcheck = $check->format('Y-m-d H:i:s');

mysqli_query($con,"INSERT INTO shows (show_date, session_username, show_venue, venue_country, venue_city, venue_state, show_status, show_type, show_location) VALUES ('$thedate','$_POST[session_username]','$venue','$country','$thecity','$thestate','Confirmed','Perform','$location')");

								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$loadin','load in','$thedate','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$soundcheck','sound check','$thedate','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$perform','performance','$thedate','$_POST[session_username]')");

}

if ($_POST['show_date'])
{

$loadin = date("Y-m-d H:i:s", strtotime($_POST[show_date]."18:00:00"));
$soundcheck = date("Y-m-d H:i:s", strtotime($_POST[show_date]."19:00:00"));
$perform = date("Y-m-d H:i:s", strtotime($_POST[show_date]."20:00:00"));
$rehearse = date("Y-m-d H:i:s", strtotime($_POST[show_date]."20:00:00"));
$recording = date("Y-m-d H:i:s", strtotime($_POST[show_date]."00:10:00"));
	
if  ($_POST[repeating]) {
		
		$start = new DateTime($_POST['show_date']);
		$interval = new DateInterval($_POST['freq']);
		$recurrences = intval($_POST['show_qty']); 

		// All of these periods are equivalent.
		$period = new DatePeriod($start, $interval, $recurrences);
		
		if ($_POST['event_address']){
		
		foreach ($period as $date) {
		
				$x = $date->format('Y-m-d');	
				
				$loadin = date("Y-m-d H:i:s", strtotime($x."18:00:00"));
				$soundcheck = date("Y-m-d H:i:s", strtotime($x."19:00:00"));
				$perform = date("Y-m-d H:i:s", strtotime($x."20:00:00"));
				$rehearse = date("Y-m-d H:i:s", strtotime($x."20:00:00"));
				$recording = date("Y-m-d H:i:s", strtotime($x."00:10:00"));
							
				mysqli_query($con,"INSERT INTO shows (show_type, show_date, show_venue, show_status, show_tour, session_username, show_details, venue_address, venue_route, venue_city, venue_state, venue_zipcode, venue_country, show_location)

						VALUES ('$_POST[show_type]',	
								'$x',
								'$venue_name',
								'$_POST[show_status]',
								'$_POST[show_tour]',
								'$_POST[session_username]',
								'$_POST[show_details]',
								'$_POST[event_street_number]',
								'$_POST[event_route]',
								'$_POST[event_locality]',
								'$_POST[event_administrative_area_level_1]',
								'$_POST[event_postal_code]',
								'$_POST[event_country]',
								'$_POST[show_location]')");
			
					$type = $_POST[show_type];
															
							switch ($type) 
							{		
								case 'Perform':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$loadin','load in','$x','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$soundcheck','sound check','$x','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$perform','performance','$x','$_POST[session_username]')");
								break;
								
								case 'Rehearse':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$rehearse','rehearsal','$x','$_POST[session_username]')");
								break;
								
								case 'Record':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$recording','recording','$x','$_POST[session_username]')");
								break;
								
								default: 						
								$ZORB = "ZORB"; 
								break;
							}
											
			}			
		}
	else{
	
			foreach ($period as $date) {
			$x = $date->format('Y-m-d');	
										
			mysqli_query($con,"INSERT INTO shows (show_type, show_date, show_venue, show_status, show_tour, session_username)

			VALUES ('$_POST[show_type]',	
					'$x',
					'$venue_name',
					'$_POST[show_status]',
					'$_POST[show_tour]',
					'$_POST[session_username]')");
			}
		}
}	
else
	{	
	
		$loadin = date("Y-m-d H:i:s", strtotime($_POST[show_date]."18:00:00"));
		$soundcheck = date("Y-m-d H:i:s", strtotime($_POST[show_date]."19:00:00"));
		$perform = date("Y-m-d H:i:s", strtotime($_POST[show_date]."20:00:00"));
		$rehearse = date("Y-m-d H:i:s", strtotime($_POST[show_date]."20:00:00"));
		$recording = date("Y-m-d H:i:s", strtotime($_POST[show_date]."00:10:00"));

		if (strlen($venue_name) < 1)
			{
				mysqli_query($con,"INSERT INTO shows (show_type, show_date, show_status, session_username, show_details, venue_address, venue_route, venue_city, venue_state, venue_zipcode, venue_country, show_location)

				VALUES ('$_POST[show_type]',	
						'$_POST[show_date]',
						'$_POST[show_status]',
						'$_POST[session_username]',
						'$_POST[show_details]',
						'$_POST[event_street_number]',
						'$_POST[event_route]',
						'$_POST[event_locality]',
						'$_POST[event_administrative_area_level_1]',
						'$_POST[event_postal_code]',
						'$_POST[event_country]',
						'$_POST[show_location]')");
			}
		else
			{
						mysqli_query($con,"INSERT INTO shows (show_type, show_date, show_venue, show_status, session_username, show_details, venue_address, venue_route, venue_city, venue_state, venue_zipcode, venue_country, show_location)

						VALUES ('$_POST[show_type]',	
								'$_POST[show_date]',
								'$venue_name',
								'$_POST[show_status]',
								'$_POST[session_username]',
								'$_POST[show_details]',
								'$_POST[event_street_number]',	
								'$_POST[event_route]',
								'$_POST[event_locality]',
								'$_POST[event_administrative_area_level_1]',
								'$_POST[event_postal_code]',
								'$_POST[event_country]',
								'$_POST[show_location]')");
			
			}			
			
					$type = $_POST[show_type];
															
							switch ($type) 
							{		
								case 'Perform':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)								
								VALUES ('$loadin','load in','$_POST[show_date]','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)								
								VALUES ('$soundcheck','sound check','$_POST[show_date]','$_POST[session_username]')");
								
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)								
								VALUES ('$perform','performance','$_POST[show_date]','$_POST[session_username]')");
								break;
								
								case 'Rehearse':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$rehearse','rehearsal','$_POST[show_date]','$_POST[session_username]')");
								break;
								
								case 'Record':
								mysqli_query($con,"INSERT INTO events (event_time, event_type, event_date, session_username)
								VALUES ('$recording','recording','$_POST[show_date]','$_POST[session_username]')");
								break;
								
								default: 						
								$ZORB = "ZORB"; 
								break;
							}

	}

}						
mysqli_close($con);
?>
