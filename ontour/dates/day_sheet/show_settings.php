<?php
		
		if (session_id() == "")
		{
		   session_start();
		}
		if (!isset($_SESSION['username']))
		{
		   header('Location: ./login.php');
		   exit;
		}
		if (isset($_SESSION['expires_by']))
		{
		   $expires_by = intval($_SESSION['expires_by']);
		   if (time() < $expires_by)
		   {
			  $_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
		   }
		   else
		   {
			  unset($_SESSION['username']);
			  unset($_SESSION['expires_by']);
			  unset($_SESSION['expires_timeout']);
			  header('Location: ./login.php');
			  exit;
		   }
		}
	?>
<?php session_start(); ?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <title>On Tour</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ot.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	
	<style>
		.navbar-brand-ot {
		float: left;
		padding: 5px 5px;
		font-size: 32px;
		line-height: 44px;
		vertical-align:text-middle;
		font-size: 24px;
		color: #878787;
		font-family: inherit;			
		}
		.table{
		width: 100%;
		}
		.table-hd-blk{
		color: white;
		padding: 5px;
		background-color: black;
		border-style: none;
		text-align: center;
		}
		.date{
		color: black;
		padding: 10px;
		text-align: center;
		}
		.date-head{
		color: white;
		padding: 10px;
		background-color: #B6CFCD;
		text-align: center;
		border: 0px;
		}
		.show-head{
		color: white;
		padding: 10px;
		background-color: #B6CFCD;
		text-align: center;
		border: 0px;
		float: right;
		margin-left: 5px;
		margin-top: 5px;
		}
		.city-state{
		color: black;
		padding: 5px;
		border-right: none;
		font-size: 14px;
		font-weight:bold;
		text-align: center;
		}
		.venue{
		color: black;
		padding: 10px;
		font-size: 12px;
		border: none;
		width: 100%;
		font-weight:normal;
		text-align: center;
		}
		.ot-close-button{
		vertical-align:text-middle;
		background: #F9F9F8;
		color: #2D2D2D;
		width:80px;
		height:60px;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.75;
		}
		.highlight-show{
		color: #FCF7E4;
		background: #2D2D2D;
		padding: 5px;
		border-style: none;
		}
		.day{
		font-size: 24px;
		}
		.back-button{
		background: #B6CFCD;
		color: white;
		margin-left: 15px;
		border-radius: 8px;
		padding: 8px;
		font-size: 18px;
		line-height: 30px;
		}
		.ot-nav-button{
		background: #2D2D2D;
		color: white;
		border-radius: 8px;
		padding: 10px;
		margin-right: 15px;
		}
		.ot-button{
		background: #F9F9F8;
		color: #2D2D2D;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.75;
		}
		.ot-show-group{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.81;
		}
		.navbar-iin {
		margin: 0px;
		width: 100%;
		border: 0px;
		}
		.display-head {
		color: white;
		padding: 5px;
		background-color: black;
		font-size: 24px;
		text-align: center;
		}
		.highlight-event{
		color: #FCF7E4;
		background: #2D2D2D;
		border-style: none;
		margin-left: 75px;
		padding: 5px;
		font-size: 18px;
		text-align: center;
		margin-top: 25px;
		}
		.time{
		vertical-align:text-middle;
		font-size: 18px;
		background: black;
		color: white;
		padding: 5px;
		margin-top: 25px;
		}	
		.list-event {
		background: rgba(0, 0, 0, 0.82);
		border-style: solid;
		border-color: black;
		border-width: 1px;
		}
		.theater {
		background:  url("img/theater.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.club {
		background:  url("img/club.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.punk {
		background:  url("img/punk2.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.bar {
		background:  url("img/bar.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.tavern {
		background:  url("img/tavern.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.travel {
		background:  url("img/drive.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		
		.amphitheatre {
		background:  url("img/amphitheatre.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.drive {
		background:  url("img/drive.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.rehearsal {
		background:  url("img/rehearsal.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.studio {
		background:  url("img/studio.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.flight {
		background:  url("img/flight3.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.off {
		background:  url("img/off.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;

		background-attachment:fixed;
		height: 100%;
		}
		.default-venue {
		background: url("img/default_venue.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.tba {
		background: url("img/tba.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.venue-details{
		background: rgba(0, 0, 0, 0.62);
		color: #FCF7E4;
		vertical-align:text-middle;
		padding:15px;
		}
		.details{
		color: #FCF7E4;
		vertical-align:text-middle;
		padding:10px;
		}
		.event-details{
		background: rgba(0, 0, 0, 0.82);
		color: #FCF7E4;
		}
		.list-venue-head{
		color: #FCF7E4;
		font-size: 18px;
		}
		.list-venue-details{
		color: #99988A;
		}
		.ot-dark-head {
		background:  url("img/dark-header.jpg") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		margin-top: 0px;
		height: 100%;
		}
		.ot-nav-toggle{
		color: #2D2D2D;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.55;		
		}
		.blur{
		display:block;
		-webkit-filter: blur(20px);
		-moz-filter: blur(15px);
		-o-filter: blur(15px);
		-ms-filter: blur(15px);
		filter: blur(15px);
		opacity: 0.95;
		}
		.navbar-iin {
		margin: 0px;
		background:
		width: 100%;
		border: 0px;
		color: white;
		}
		.ot-edit{
		background: rgba(0, 0, 0, 0.72);
		border-radius:4px;
		opacity:0.75;
		width:100%;
		height: 44px;
		padding: 5px;
		color: #FCF7E4;;
		border-style: solid;
		border-width: 1px;
		border-color:#424242;
		}
		.ot-standout{
		background: rgba(0, 0, 0, 0.62);
		border-radius:4px;
		width:100%;
		height: 44px;
		padding: 5px;
		color:#FCF7E4;
		border-style: solid;
		border-width: 1px;
		border-color:#424242;
		}
		.ot-standout-label{
		background: rgba(0, 0, 0, 0.12);
		border-radius:4px;
		width:100%;
		color:#FFFFEB;
		border-style: solid;
		border-width: 0px;
		border-color:#1A1A1A;
		}
		.add-event-background {
		background: black;
		}
		.pac-container {
			background-color: #FFF;
			z-index: 20;
			position: fixed;
			display: inline-block;
			float: left;
		}
		.modal{
			z-index: 20;   
		}
		.modal-backdrop{
			z-index: 10;        
		}​
		a:link {color:#FCF7E4;}    /* unvisited link */
		a:visited {color:#FCF7E4;} /* visited link */
		a:hover {color:#FCF7E4;}   /* mouse over link */
		a:active {color:#FCF7E4;}  /* selected link */
		
		.ot-nav-toggle{
		color: #2D2D2D;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.55;		
		}

		
	</style>
	
	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">
	<link rel="icon" type="image/png" href="img/favicon.jpg">
	<!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>	
	<!-- Google Places API -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU"></script>
	<script src="https://maps.googleapis.com/maps/api/place/details/json&sensor=false&key=AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU"></script>
  </head>
<?php
	require "dbconnect.php";
	require "handler.php";
	include "classes.php";
	session_start();	
if (isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
	}
else
	{
		$id = $_SESSION['parent'];
	}
	$_SESSION['parent'] = $id;							
	$query = "SELECT * FROM events WHERE id = $id LIMIT 1";
	$sun = $_SESSION['username'];	
	$parent_id = $_SESSION['parent'];
	$parent_page = $_SESSION['parent_page'];		
	$showQuery = "SELECT * FROM shows WHERE id = $id LIMIT 1";
	$eventQuery = $handler->query("SELECT * FROM events WHERE session_username ='$sun' ORDER by event_time");
	$obj_event = $eventQuery->FetchALL(PDO::FETCH_CLASS, 'Event');
	$_SESSION['settings_page'] = $pageURL .= $_SERVER["SCRIPT_NAME"];		
	$user = mysqli_query($con,"SELECT * FROM users WHERE username = '$sun'");
		while($row = mysqli_fetch_assoc($user))
			{
				$artist_name = $row['artist_name'];
			}
				$showHead = mysqli_query($con,$showQuery);
				while ($row=mysqli_fetch_assoc($showHead))
				{
					$dateHead = date("l F jS, Y", strtotime($row['show_date']));
					$dateShort = date("M jS", strtotime($row['show_date']));
					$show_date = $row['show_date'];
					$venueName = strtolower($row['show_venue']);
					$dayType = strtolower($row['show_type']);
					$showID = $row['id'];
					$_SESSION['showdate'] = $row['show_date'];
					$showDetails = $row['show_details'];
					$show_contact = $row['show_contact'];
					list($show_contact_firstname) = explode(" ", $show_contact);
					$show_contact_phone = $row['show_contact_phone'];
					$show_contact_email = $row['show_contact_email'];
					$show_public = $row['show_public'];
					$geoLoc = $row['location'];
					$address1 = $row['venue_address'];					
					$address2 = $row['venue_route'];
					$city = $row['venue_city'];
					$state = $row['venue_state'];
					$country = $row['venue_country'];
					$postal = $row['venue_zipcode'];
					$tour = $row['show_tour'];
					$capacity = $row['venue_capacity'];
					$status_word = $row['show_status'];				
					switch($row['show_status'])
						{
						case "Confirmed":
						$color = "#00CC00";
						$show_status = "<option selected>Confirmed</option>
										<option>Pending</option>
										<option>Cancelled</option>";
						break;
						
						case "Pending":
						$color = "#D69533";
						$show_status = "<option>Confirmed</option>
										<option selected>Pending</option>
										<option>Cancelled</option>";
						break;
						
						case "Cancelled":
						$color = "#990000";
						$show_status = "<option>Confirmed</option>
										<option>Pending</option>
										<option selected>Cancelled</option>";
						break;
						
						default:
						$color = "grey";
						$show_status = "<option>Confirmed</option>
										<option>Pending</option>
										<option>Cancelled</option>";
						break;
						}								
			//SHOW TYPE	
						switch($row['show_type'])
						{
						case "Perform":
						$show_type = "<option selected>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "";
						break;	
						case "Rehearse":
							$show_type = "<option>Perform</option>
										<option selected>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "<span class='fa fa-clock-o'></span>";			
						break;
						case "Travel":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option selected>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "<span class='fa fa-road'></span>";
						break;
						case "Promote":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option selected>Promote</option>
										<option>Record</option>
										<option>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "<span class='fa fa-calendar'></span>";							
						break;
						case "Record":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option selected>Record</option>
										<option>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "<span class='fa fa-microphone'></span>";							
						break;
						case "TBA":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>Off</option>
										<option selected>TBA</option>";
							$venue = "TBA";
							$type = "<span class='fa fa-flag'></span>";
						break;
						case "Off":
							$show_type = "<option>Perform</option>
										<option >Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option selected>Off</option>
										<option>TBA</option>";
							$venue = "";
							$type = "<span class='fa fa-glass'></span>";			
						break;
						default: 
						$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option selected>Off</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$type = "<span class='fa fa-glass'></span>";							
						break;
						}
						
					switch($row['show_type'])
						{
							case "Perform":
							$typeword = "Performance";
							break;
							case "Rehearse":
							$typeword = "Rehearsal";
							break;
							case "Record":
							$typeword = "Recording";
							break;
							case "Travel":
							$typeword = "Travel Day";
							break;
							case "Promote":
							$typeword = "Promotion";
							break;
							case "TBA":
							$typeword = "";
							break;
							default;
							break;
						}
				}	
			//rehearsal
				if (stripos($dayType, "Rehearse") !==false)
				{
				$venueType = 'rehearsal';
				}	
			//club
				if (stripos($venueName, "tavern") !==false)
				{
				$venueType = 'tavern';
				}
				
				if (stripos($venueName, "club") !==false)
				{
				$venueType = 'club';
				}

			//punk
				if (stripos($venueName, "punk") !==false)
				{
				$venueType = 'punk';
				}
				
			//theater	
				if (stripos($venueName, "theater") !==false)
				{
				$venueType = 'theater';
				}
				if (stripos($venueName, "theatre") !==false)
				{
				$venueType = 'theater';
				}
			//Amphitheatre	
				if (stripos($venueName, "amphitheatre") !==false)
				{
				$venueType = 'amphitheatre';
				}
			//travel
			
			 //----------drive
				if (stripos($dayType, "Travel") !==false)
				{
				$venueType = 'drive';
				}

			  
			 //----------flight
				if (stripos($venueName, "airport") !==false)
				{
				$venueType = 'flight';
				}
				
			//off
				if (stripos($dayType, "off") !==false)
				{
				$venueType = 'off';
				}
			//bar
				if (stripos($venueName, "bar") !==false)
				{
				$venueType = 'bar';
				}
				if (stripos($dayType, "Record") !==false)
				{
				$venueType = 'studio';
				}
				
				if (stripos($dayType, "TBA") !==false)
				{
				$venueType = 'tba';
				}
				
				
				if ($venueName == NULL && $dayType == 'performance')
					{
						$imgType = 'tba';
					}
				else
					{
						switch ($venueType) 
							{
								case 'travel':
								$imgType = 'travel';
								case 'tba':
								$imgType = 'tba';
								break;
								case 'flight':
								$imgType = 'flight';
								break;
								case 'drive':
								$imgType = 'drive';
								break;
								case 'theater':
								$imgType = 'theater';
								break;
								case 'rehearsal':
								$imgType = 'rehearsal';
								break;
								case 'studio':
								$imgType = 'studio';
								break;
								case 'punk':
								$imgType = 'punk';
								break;
								case 'tavern':
								$imgType = 'tavern';
								break;
								case 'bar':
								$imgType = 'bar';
								break;
								case 'amphitheatre':
								$imgType = 'amphitheatre';
								break;
								case 'club':
								$imgType = 'club';
								break;
								case 'Off':
								$imgType = 'off';
								break;
								default:
								$imgType = 'default-venue'; 
								break;	
							}
					}
					
//<BODY TAG				
				echo "<body class = '$imgType' onload='initialize()' id='page'>";				
				?>
<?php include_once("analyticstracking.php") ?>				
<!-- Header -->	

	<div class = "container venue-details">	
		<div class = "nav navbar" role = "navigation">
			<div class = "pull-left">
			<a style="margin-top:20px; margin-bottom:5px;" class="btn btn-default back-button" href="<?php echo $back; ?>">
				<h6><span class = "fa fa fa-arrow-circle-o-left fa-2x"></span></h6></a>
			</div>
			<div class="pull-left hidden-xs" style="font-size: 14px; margin-top:40px;font-family:oswald; padding: 5px;">	
				Back
			</div>
			<div class="pull-right" style="font-size: 24px; font-family:oswald; padding: 15px;">
				<div style="font-size: 24px;">
					<?php echo strtoupper(date("M . d", strtotime($show_date)));?>
				</div>
				<div style="font-size:14px;">
					Day Settings
				</div>
			</div>				
		</div>
	</div>

<!-- Content -->

<div class="container">					
			<form role="form" method="post" action="update_show.php">									
			<div class ="row venue-details" style="border-bottom-left-radius:8px;border-bottom-right-radius:8px;">
				<div class="col-sm-6">		
				<div class="nav navbar">
					<div style="font-family:oswald; width:80%;" class="pull-left">
					<?php echo $type . " " . $typeword . " " . $status_word ." ". "<span style='color:" . $color ."' class='fa fa-flag'></span><br>";?>
					<?php echo $tour;?>
					</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" id="daybutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>				
				</div>
					<div id="dayinfo" class="venue-details" style="display:none">
					<div class ="row">
							<div class="col-xs-12">
								<div class="nav navbar">
									<a type="button" class ="btn btn-danger navbar-btn ot-show-group pull-left" <?php echo "<a href= 'show_delete.php?id=" . $showID . "'";?>><span class = "glyphicon glyphicon-trash"></span> Delete Day</a>
									<button type="submit" class ="btn btn-success ot-show-group navbar-btn pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
								</div>
							</div>
							<div class="col-xs-6">
								<div style="font-size:12px;">
									<div class="form-group">
										<label for="show_status" style="padding:5px;border-radius:2px;"><span class='fa fa-flag'></span> Status</label>
										<select id="show_status" name="show_status" class="ot-standout" name="show_status">
										<option></option>
										<?php echo $show_status; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div style="font-size:12px;">
									<div class="form-group">
										<label for="show_type" style="padding:5px;border-radius:2px;"><?php echo $type; ?> Day Type</label>
										<select id="show_type" name="show_type" class="ot-standout" name="ot-standout">
										<option></option>
										<?php echo $show_type; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xs-12">
								<div>						
									<div id="show_tour" style="font-size:12px;">	 
										<div class="form-group">
											<label for="event_details"><span class = "fa fa-bookmark"></span> Tour Name</label>
											<input type="text" class="ot-standout" value="<?php echo $tour; ?>" name="show_tour"></input>
										</div>
									</div>
								</div>
							</div>
					</div>
					</div>
					<div class="nav navbar">
					<div style="font-family:oswald;width:80%;" class="pull-left">
					<div style="font-size:12px; opacity:0.85;">VENUE</div>
					<div style="font-size:16px;"><?php echo $venue; ?></div>
					</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" id="venuebutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
					</div>
					<div id="venueinfo" class="venue-details" style="display:none">
					<div class ="row" style="font-size:12px;">
							<div class="col-sm-12">
								<div class="nav navbar">
									<button type="submit" class ="btn btn-success ot-show-group navbar-btn pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
								</div>
							</div>					
							<div class ="col-sm-12">						
								<label for="locationField"><span class="glyphicon glyphicon-map-marker"></span> Location</label>
								<div id="locationField">
								<input id="venue_search" class ="ot-standout" placeholder="Search or Enter Address"
								onFocus="geolocate()" type="text" value="<?php echo $venue; ?>" name="event_address"></input>
								</div>
							</div>
							
						<div id="address">
							<div class ="col-sm-6">
								<label class="label ot-standout-label">Street Number</label>
								<input class="ot-edit" id="street_number" value="<?php echo $address1; ?>" name=
								"event_street_number"></input>
							</div>
							<div class ="col-sm-6">
								<label class="label ot-standout-label">Street</label>								
								<input class="ot-edit" id="route" value="<?php echo $address2;?>" name="event_route"
								></input>
							</div>
							<div class ="col-sm-6">
								<label class="label ot-standout-label">City</label>
								<input class="ot-edit" id="locality" value="<?php echo $city; ?>" name="event_locality"
									  ></input>
							</div>
							<div class ="col-sm-3">
								<label class="label ot-standout-label">State</label>
								<input class="ot-edit"
									 id="administrative_area_level_1" value="<?php echo $state; ?>" name="event_administrative_area_level_1"
									  ></input>
							</div>
							<div class ="col-sm-3">
								<label class="label ot-standout-label">Zip code</label>
								<input class="ot-edit" id="postal_code" value="<?php echo $postal; ?>" name="event_postal_code"
									  ></input>
							</div>
							<div class ="col-sm-12">
								<label class="label ot-standout-label">Country</label>
								<input class="ot-edit"
									  id="country" name="event_country" value="<?php echo $country; ?>"
									  ></input>
							</div>


						</div>
							<div class ="col-sm-3">
								<div class="form-group">
									<label class="label ot-standout-label">Capacity</label>
									<input class="ot-edit"
									id="venue_capacity" name="venue_capacity" value="<?php echo $capacity; ?>"></input>
								</div>
							</div>	
					</div>
					</div>
					<div class="nav navbar">
					<div style="font-family:oswald;margin-top:12px;width:80%;" class="pull-left">
					<div style="font-size:12px; opacity:0.85;">MAIN CONTACT</div>
					<div style="font-size:16px;"><?php echo $show_contact; ?></div>
					</div>
					<div class="pull-right">
					<a type="button" style="width:40px;height:40px;" id="contactbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
					</div>
					<div class="btn-group">
					
					<a type="button" href="mailto:
											<?php 
											
											echo $show_contact_email;
												
											?>?Subject=<?php echo $artist_name . " - " . $venue  ." - " . $dateHead;?>&body=Hi," class="btn btn-danger" style="width:64px;height:64px;border-radius:32px; font-family:Oswald; margin-right:10px;padding:20px;"><span class="fa fa-envelope"></span></a>
															
					<a class="btn btn-primary ot-show-group" style="color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;" href="sms:<?php echo $show_contact_phone; ?>"><span class="fa fa-comment"></span></a>
															
					<a class="btn btn-success ot-show-group" style="color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;" href='tel:<?php echo $show_contact_phone; ?>'><span class="fa fa-phone"></span></a>
					
					</div>
					<div id="contactinfo" class="venue-details" style="display:none;font-size:12px;">
						<div class ="row">
								<div class="col-md-12">
									<div class="nav navbar">
										<button type="submit" class ="btn btn-success ot-show-group navbar-btn pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
									</div>
								</div>						
								<div class="col-md-4">												 
										<div class="form-group">
											<label><span class = "fa fa-user"></span> Main Contact</label>
											<input type="text" class="ot-standout" value="<?php echo $show_contact; ?>" name="show_contact"></input>
										</div>
								</div>
								<div class="col-md-4">
										<div class="form-group">
											<label><span class = "glyphicon glyphicon-earphone"></span> Phone</label>
											<input type="tel" class="ot-edit" value="<?php echo $show_contact_phone; ?>" name="show_contact_phone"></input>
										</div>
								</div>
								<div class="col-md-4">
										<div class="form-group">
											<label><span class = "fa fa-envelope"></span> Email</label>
											<input type="email" class="ot-edit" value="<?php echo $show_contact_email; ?>" name="show_contact_email"></input>
										</div>
								</div>							
					
						</div>
					</div>
				</div>
			</div>		
</form>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src='js/jquery-ui.js'></script>	

<script src='docs/js/googlePlacesAPI.js'></script>
	<script>
	$( "#daybutton" ).click(function() {
	  $( "#dayinfo" ).toggle( "blind", 200 );
	});
	</script>
	<script>
	$( "#venuebutton" ).click(function() {
	  $( "#venueinfo" ).toggle( "blind", 200 );
	});
	</script>
	<script>
	$( "#contactbutton" ).click(function() {
	  $( "#contactinfo" ).toggle( "blind", 200 );
	});
	</script>


  </body>	

</html>

