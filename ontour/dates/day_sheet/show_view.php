<?php session_start();?>
<style>
		.ot-show-group{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.81;
		}
		.ot-nav-group{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.61;
		}
		.ot-toggle-menu{
		background: #2D2D2D;
		padding:5px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		}	
		.theater {
		background:  url("img/theater.jpg") center no-repeat;
		width:100%;
		}
		.club {
		background:  url("img/club.jpg") center no-repeat;
		width:100%;
		}
		.punk {
		background:  url("img/punk2.jpg") center no-repeat;
		width:100%;
		}
		.bar {
		background:  url("img/bar.jpg") center no-repeat;
		width:100%;
		}
		.tavern {
		background:  url("img/tavern.jpg") center no-repeat;
		width:100%;
		}
		.travel {
		background:  url("img/drive.jpg") center no-repeat;
		width:100%;
		}
		.amphitheatre {
		background:  url("img/amphitheatre.jpg") center no-repeat;
		width:100%;
		}
		.drive {
		background:  url("img/drive.jpg") center no-repeat;
		width:100%;
		}
		.rehearsal {
		background:  url("img/rehearsal.jpg") center no-repeat;
		width:100%;
		}
		.studio {
		background:  url("img/studio.jpg") center no-repeat;
		width:100%;
		}
		.flight {
		background:  url("img/flight3.jpg")  center no-repeat;
		width:100%;
		}
		.off {
		background:  url("img/off.jpg") center no-repeat;
		width:100%;
		}
		.default-venue {
		background: url("img/default_venue.jpg") center no-repeat;
		width:100%;
		}
		.tba {
		background: url("img/tba.jpg") center no-repeat;
		width:100%;
		}			
		.venue-details{
		background: rgba(0, 0, 0, 0.62);
		color: #FCF7E4;
		vertical-align:text-middle;
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
		.pac-container {
			background-color: #FFF;
			z-index: 20;
			position: fixed;
			display: inline-block;
			float: left;
		}
		
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
		.ot-multi{
		background: #2D2D2D;
		color:white;
		padding:10px;
		text-align: center;
		border-color: #2D2D2D;
		border-style:solid;
		opacity:0.61;
		}
		.floatingModal{
		z-index:20;
		}
		.ot2-grad{
			background: -webkit-linear-gradient(left top, #6F7475 , #CBCCC2); /* For Safari 5.1 to 6.0 */
			background: -o-linear-gradient(bottom right, #6F7475, #CBCCC2); /* For Opera 11.1 to 12.0 */
			background: -moz-linear-gradient(bottom right, #6F7475, #CBCCC2); /* For Firefox 3.6 to 15 */
			background: linear-gradient(to bottom right, #6F7475 , #CBCCC2); /* Standard syntax (must be last) */
		}		
	</style>
	

	
<?php
require "dbconnect.php";
require "handler.php";
include "classes.php";
					
if (isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
	}

if ($_COOKIE["daysheetID"]) 
	{
		$id = $_COOKIE["daysheetID"];
	}
					
$sun = $_SESSION['nameid'];

$showQuery = "SELECT * FROM shows WHERE id = $id LIMIT 1";
$eventQuery = $handler->query("SELECT * FROM events WHERE session_username ='$sun' ORDER by event_time");
$obj_event = $eventQuery->FetchALL(PDO::FETCH_CLASS, 'Event');
					
$_SESSION['parent'] = $id;
$_SESSION['parent_page'] = $pageURL .= $_SERVER["SCRIPT_NAME"];
$artist_name = $_SESSION['thename'];
									
$showHead = mysqli_query($con,$showQuery);
			while ($row=mysqli_fetch_assoc($showHead))
				{
					$dateHead = date("l F jS, Y", strtotime($row['show_date']));
					$dateShort = date("M jS", strtotime($row['show_date']));					
					$venueName = strtolower($row['show_venue']);
					$dayType = strtolower($row['show_type']);
					$showID = $row['id'];
					$_SESSION['showdate'] = $row['show_date'];
					$showDetails = $row['show_details'];
					$show_contact = $row['show_contact'];
					list($show_contact_firstname) = explode(" ", $show_contact);
					$show_contact_phone = $row['show_contact_phone'];
					$show_contact_email = $row['show_contact_email'];
					$show_crew_date = $row['show_date'];
					$showdate = $row['show_date'];
					$show_tour = $row['show_tour'];
					$showVenue = "TBA";
					$status_word = $row['show_status'];
					$geoLoc = $row['show_location'];
					
					$address1 = $row['venue_address'];
					$address2 = $row['venue_route'];
					$city = $row['venue_city'];
					$state = $row['venue_state'];
					$country = $row['venue_country'];
					$postal = $row['venue_zipcode'];
					$tour = $row['show_tour'];
					$capacity = $row['venue_capacity'];
			
					$_SESSION['showcrewdate'] = $row['show_date'];
					$_SESSION['dateShort'] = $dateShort;
					
					
						if ($row['show_venue'] !== "TBA")
							{								
								$venueAddress = $show_address . " " . $row['venue_zipcode'];
								$venuecity = $row['venue_city'] . " " . $row['venue_state'];
								$_SESSION['venueCity'] = $venuecity;
							}
						else
							{
								$venue = "TBA";
								$venue = $_SESSION['venue'];
								$venuecity = $row['venue_country'];
								$venueAddress = $row['show_tour'];
								$_SESSION['venueCity'] = $venuecity;
							}
							
			
			//DAY STATUS

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
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$typeword = "Performance";
						break;
						
						case "Rehearse":
							$show_type = "<option>Perform</option>
										<option selected>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>TBA</option>";
							$typeword = "Rehearsal";
							$venue = "Practice Spot";
										
						break;
						
						case "Travel":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option selected>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$typeword = "Travel Day";
						break;
						
						case "Promote":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option selected>Promote</option>
										<option>Record</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$typeword = "Promotion";
						break;
						
						case "Record":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option selected>Record</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];
							$typeword = "Recording";
						break;
						
						case "TBA":
							$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option selected>TBA</option>";
							$venue = $row['show_venue'];
							$typeword = "";
						break;
						
						default: 
						$show_type = "<option>Perform</option>
										<option>Rehearse</option>
										<option>Travel</option>
										<option>Promote</option>
										<option>Record</option>
										<option>TBA</option>";
							$venue = $row['show_venue'];					
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
								case 'off':
								$imgType = 'off';
								break;
								default:
								$imgType = 'default-venue'; 
								break;	
							}
					}				
					
				$band_id = $_SESSION['band_id'];
				$parent_artist = $_SESSION['theparent'];
				$memberofband = $_SESSION['themember'];		
				$artist_session_username = $_SESSION['theparent'];
				$artist_name = $_SESSION['thename'];				
				$thename = $_SESSION['thename'];				
				$_SESSION['img'] = $imgType;
				$thename = $_SESSION['thename'];

				if ($_SESSION['admin'] == 1)
					{
						$sun = $_SESSION['nameid'];
						$hide = "";
						$showgearsettings = '<a type="button" style="width:30px;height:30px;border-radius:4px;font-family:Oswald;" ><span class = "fa fa-gear fa-2x"></span></a>';
					}
					
				else
					{
						$sun = $_SESSION['nameid'];
						$hide = "hidden";
						$showgearsettings = "";
					}			
				?>
			
<div class="container" style="box-shadow: 5px 10px 25px #323333;">
	<div class = "row" style="padding-bottom:150px;min-height:600px;">
		<div id="settingsWindow" class ="col-sm-6 " style="margin-bottom:15px;padding-left:1px;padding-right:1px">
		<div class="<?php echo $imgType;?>" style="border-radius:4px;box-shadow: 5px 10px 25px #323333;">
		<div class="venue-details" style="border-radius:4px;">
			<div id="daySettingsToggle" style="display:none;">
			</div>
			<div id="dayDisplay">
			<?php include "ontour/dates/day_sheet/showinfo.php";?>

					<div class="nav navbar">
					<div style="font-size:12px;">MAIN CONTACT: <?php echo $show_contact; ?></div>
					<div class="btn-group pull-left" style="width:80%;margin-top:5px;">
					
					<a type="button" href="mailto:
					<?php 
											
					echo $show_contact_email;
												
					?>?Subject=<?php echo $artist_name . " - " . $venue  ." - " . $dateHead;?>&body=Hi," class="btn btn-danger" style="width:50px;height:50px;border-radius:25px; font-family:Oswald; margin-right:3px;padding:14px;"><span class="fa fa-envelope"></span></a>
															
					<a class="btn btn-primary ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:3px; font-size:12px;" href="sms:<?php echo $show_contact_phone; ?>"><span class="fa fa-comment"></span></a>
															
					<a class="btn btn-success ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:3px; font-size:12px;" href='tel:<?php echo $show_contact_phone; ?>'><span class="fa fa-phone"></span></a>
					
					</div>
					</div>
			</div>
		</div>
		</div>
		</div>		
		<div class = "col-sm-6">
			<div id="dayItemSection" style="margin-bottom:1px;">
				<?php include "ontour/dates/day_sheet/day_items/times.php";?>
			</div>
			<div id="rosterSection">
				<?php include "ontour/dates/day_sheet/day_roster/roster_day_sheet.php";?>
			</div>		
		</div>
	</div>
</div>
<?php
mysqli_close($con);
?>
<script>
function dropDayRoster()
{
          $.ajax({
            type: 'get',
            url: 'ontour/dates/day_sheet/day_roster/crew_delete.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
            }
          });
}
</script>

