<?php ob_start(); ?>	
<style>
		.drive{
		background:  url("img/drive.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.flight{
		background:  url("img/flight3.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.doors{
		background:  url("img/doors.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.studio{
		background:  url("img/studio.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.radio2{
		background:  url("img/radio.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.gear{
		background:  url("img/gear1.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.rehearsal{
		background:  url("img/rehearsal.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.meet{
		background:  url("img/meet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.soundcheck{
		background:  url("img/soundcheck.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.perform{
		background:  url("img/perform.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.hotel{
		background:  url("img/hotel.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.van{
		background:  url("img/van.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
		.food{
		background:  url("img/food.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:center;
		}
</style>
<?php

require_once "dbconnect.php";
require_once "handler.php";
include "classes.php";

if ($_COOKIE["eventID"])
	{
		$id = $_COOKIE["eventID"];
	}
	
$query = "SELECT * FROM events WHERE id = $id LIMIT 1";

$sun = $_SESSION['nameid'];							
$band_id = $_SESSION['band_id'];	
$artist_name = $_SESSION['thename'];	
						
				$thename = $_SESSION['thename'];

				if ($_SESSION['admin'] == "1")
					{
						$sun = $parent_artist;
						$hide = "";
					}
					
				else
					{
						$sun = $parent_artist;
						$hide = "hidden";
					}
					
$eventQuery = mysqli_query($con, $query);
while ($row=mysqli_fetch_assoc($eventQuery))
{
	$details = $row['event_details'];

					switch ($row['event_type']) 
							{
								case 'performance':
								$eType = "<span class ='fa fa-music'>" . " " ."</span>";
								$imgType = "perform";
								break;
								case 'radio':
								$eType = "<span class='fa fa-headphones'>" . " ". "</span>";
								$imgType = "radio2";
								break;			
								case 'lodging':
								$eType = "<span class='fa fa-home'>" . " "."</span>";
								$imgType = "gear";
								break;
								case 'lodging check in':
								$eType = "<span class='fa fa-home'>" . " "."</span>";
								$imgType = "hotel";
								break;
								case 'lodging check out':
								$eType = "<span class='fa fa-home'>" . " "."</span>";
								$imgType = "hotel";
								break;
								case 'flight':
								$eType = "<span class='fa fa-plane'>" . " " ."</span>";
								$imgType = "flight";
								break;
								case 'drive':
								$eType = "<span class='fa fa-truck'>" . " " ."</span>";
								$imgType = "drive";
								break;
								case 'van call':
								$eType = "<span class='fa fa-truck'>" . " " ."</span>";
								$imgType = "van";
								break;
								case 'meet':
								$eType = "<span class='fa fa-group'>" . " " ."</span>";
								$imgType = "meet";
								break;
								case 'food':
								$eType = "<span class='fa fa-cutlery'>" . " " ."</span>";
								$imgType = "food";
								break;
								case 'recording':
								$eType = "<span class='fa fa-microphone'>" . " ". "</span>";
								$imgType = "studio";
								break;
								case 'rehearsal':
								$eType = "<span class='fa fa-clock-o'>" . " " ."</span>";
								$imgType = "rehearsal";
								break;
								case 'load in':
								$eType = "<span class='fa fa-suitcase'>" . " " ."</span>";
								$imgType = "gear";
								break;
								case 'sound check':
								$eType = "<span class='fa fa-bullhorn'>" . " " ."</span>";
								$imgType = "soundcheck";
								break;
								case 'doors open':
								$eType = "<span class='glyphicon glyphicon-flag'>" . " " ."</span>";
								$imgType = "doors";
								break;									
								default:
								$eType = ""; 
								$imgType ="gear";
								break;
							}
							
							$dateHead = date("l F jS, Y", strtotime($row['event_date']));
							$dateShort = date("M jS", strtotime($row['event_date']));	
							$datevalue = $row['event_date'];
							$eventID = $row['id'];
							$_SESSION['update_id'] = $eventID;
							$eventName = $row['event_business_name'];
							$eventWord = ucwords($row['event_type']);
							$eventType = $row['event_type'];
							$eventDetails = $row['event_details'];
							$eventAddress = $row['event_street_number'] . " " . $row['event_route'] . " " . $row['event_postal_code'];	
							$eventTime = $row['event_time'];
							list($thedate,$thetime) = explode(" ", $eventTime);
							$daydate = date("l M jS", strtotime($thedate));						
							$daytime = date("s:s:s", strtotime($thetime));	
							$time =	date("g:i a", strtotime($eventTime));	
							$address1 = $row[event_street_number];
							$address2 = $row[event_route];
							$city = $row[event_locality];
							$state = $row[event_administrative_area_level_1];
							$country = $row[event_country];
							$postal = $row[event_postal_code];
							$event_contact = $row[event_contact];
							$event_contact_phone = $row[event_contact_phone];
							$event_contact_email = $row[event_contact_email];
							$status = $row['event_status'];
							$location = $eventName . " " . $address1 . " " . $address2 . " " . $city . " " . $state . " " . $postal;
							$navpoint = "'https://www.google.com/maps/search/$location'";

											if ($eventTime  === NULL)
												{
													$time = "TBA";
												}
											else
												{
													$time = date("g:i A", strtotime($eventTime));
												}
}

					switch($status)
						{
						case "Confirmed":
						$color = "#00CC00";
						$event_status = "<option></option>
										<option selected>Confirmed</option>
										<option>Pending</option>
										<option>Cancelled</option>";
						break;
						
						case "Pending":
						$color = "#D69533";
						$event_status = "<option></option>
										<option>Confirmed</option>
										<option selected>Pending</option>
										<option>Cancelled</option>";
						break;
						
						case "Cancelled":
						$color = "#990000";
						$event_status = "<option></option>
										<option>Confirmed</option>
										<option>Pending</option>
										<option selected>Cancelled</option>";
						break;
						
						default: 
						$color = "grey";
						$event_status = "<option></option>
										<option>Confirmed</option>
										<option>Pending</option>
										<option>Cancelled</option>";
						break;
						}

switch($eventType)
		{
							case "meet":
					$show_type = "<option></option>
									<option selected>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "drive":
					$show_type = "<option></option>
									<option>meet</option>
									<option selected>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "flight":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option selected>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "lodging check in":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option selected>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "radio":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option selected>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "load in":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option selected>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "sound check":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option selected>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "food":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option selected>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "doors open":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option selected>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "performance":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option selected>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "lodging check out":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option selected>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "van call":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option selected>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "recording":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option selected>recording</option>
									<option>rehearsal</option>";								  							  	
						break;
							case "rehearsal":
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option selected>rehearsal</option>";								  							  	
						break;
						default: 
					$show_type = "<option></option>
									<option>meet</option>
									<option>drive</option>
									<option>flight</option>
									<option>lodging check in</option>
									<option>radio</option>
									<option>load in</option>
									<option>sound check</option>
									<option>food</option>
									<option>doors open</option>
									<option>performance</option>								  
									<option>lodging check out</option>
									<option>van call</option>
									<option>recording</option>
									<option>rehearsal</option>";
						break;
		}
?>

    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/day_sheet/day_items/update_event.php',
            data: $('#eventUpdateForm').serialize(),
            success: function () {
              $( "#settingsWindow" ).load( "ontour/dates/day_sheet/day_items/event_view.php" );
			  $( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_items/times.php" );
            }
          });

        });

      });
    </script>	

<div class="<?php echo $imgType;?>" style="border-radius:4px">
<div>
<div class="venue-details" style="margin-bottom:15px;box-shadow: 5px 10px 25px #323333;border-radius:4px;">
<form action="/" id="eventUpdateForm">
<div class="nav navbar">
	<div class="pull-left">
		<h5>DAY ITEM DETAILS</h5>
	</div>
	
	<div class="pull-right"style="margin-top:15px;">
		<button onclick="closeItemSettings()" type="button" style="margin-right:15px;border-width:0px;" class="ot-button ">Close</button>
		<button type="submit" class="ot-button"><span class="fa fa-cloud-download"></span> Update</button>
	</div>
</div>	
		
				<div class="nav navbar">
					<div style="font-family:oswald; width:80%;" class="pull-left">
					<div style="font-size:12px; opacity:0.85;"><?php echo $daydate . " " . $status . " " ."<span style='color:" . $color ."' class='fa fa-flag'></span>";?></div> 
					<?php echo $time . " " . strtoupper($eventType);?>
					</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" id="eventbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
				</div>
				<div id="eventpanel" style="display:none;font-size:12px;">
					<div class="row">
						<div class = "col-xs-12">
						<p style="font-size:8px; opacity:0.85;">All times set after midnight need to select the next day to remain in chronological order.</p>
						</div>
						<div class = "col-xs-6" style="margin-bottom:10px;">
						
							<div class="input-group">
							<input class="ot-standout" id="date" type="date" value="<?php echo $thedate;?>" name="event_date"></input>
							
							<span class="input-group-addon">
							<span class="fa fa-calendar"></span>
							</span>
							</div>
							
						</div>
						<div class = "col-xs-6 " style="margin-bottom:10px;">
					
							<div class="input-group clockpicker">
									<input type="time" id="time" name="event_time" class="ot-standout" value="<?php echo $thetime;?>">
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
							</div>
							
						</div>
						<div class ="col-xs-6">
							
							<div class="input-group">
									<select id="event_status" name="event_status" class="ot-standout" name="event_status">
								
										<?php echo $event_status; ?>
									</select>
									<span class="input-group-addon">
									<span class="fa fa-flag"></span>
									</span>
							</div>
						</div>
						<div class ="col-xs-6">
	
							<div class="input-group">
									<select id="event_type" name="event_type" class="ot-standout" name="event_type">
									<?php echo $show_type; ?>
									</select>
									<span class="input-group-addon">
									<span class="fa fa-tasks"></span>
									</span>
							</div>
							
						</div>
					</div>
				</div>				
			<div class="nav navbar">
					<div style="font-family:oswald; width:80%;" class="pull-left">
					<div style="font-size:12px; opacity:0.85;">LOCATION</div>
					<div style="font-size:16px;"><?php echo $eventName;?></div>
					</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" onclick="initialize()" id="locationbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
			</div>
			<div id="locationpanel" style="display:none;">
			<div class="row">
					<div class ="col-sm-12">
						<div id="locationField">
							<div class="ot-text"><span class = "glyphicon glyphicon-map-marker"></span> Location</div>
							<input id="venue_search" class ="ot-standout" placeholder="Search by address or venue name"
							onFocus="geolocate()" type="text" style="font-size:12px;" value="<?php echo $eventName; ?>" name="event_address"></input>	
						</div>
					</div>
							<div id="address" style="font-size:12px;">
								<div class ="col-sm-6">
								<input class="ot-standout" id="street_number" placeholder="Street Number" value="<?php echo $address1; ?>" name="event_street_number"></input>
								</div>
								<div class ="col-sm-6">								
								<input class="ot-standout" id="route" placeholder="Street" value="<?php echo $address2;?>" name="event_route"></input>
								</div>
								<div class ="col-sm-6">
								<input class="ot-standout" id="locality" placeholder="City" value="<?php echo $city; ?>" name="event_locality"
									  ></input>
								</div>
								<div class ="col-sm-3">
								<input class="ot-standout"
									 id="administrative_area_level_1" placeholder="State" value="<?php echo $state; ?>" name="event_administrative_area_level_1"
									  ></input>
								</div>
								<div class ="col-sm-3">
								<input class="ot-standout" id="postal_code" placeholder="Zip code" value="<?php echo $postal; ?>" name="event_postal_code"
									  ></input>
								</div>
								<div class ="col-sm-12">
								<input class="ot-standout"
									  id="country" name="event_country" placeholder="Country" value="<?php echo $country; ?>"
									  ></input>
								</div>
							</div>
			</div>
			</div>
			<div class="nav navbar">
					<div style="font-family:oswald; width:80%;" class="pull-left">
					<div style="font-size:12px; opacity:0.85;">MAIN CONTACT</div> 
					<div style="font-size:16px;"><?php echo $event_contact;?></div>
					</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" id="contactbuttonEvent" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
			</div>
			<div id="contactpanelEvent" style="display:none;font-size:12px;">
				<div class = "row">
							<div class = "col-sm-4">
								<input class="ot-standout" id="event_contact" placeholder="Full Name" type="text" value="<?php echo $event_contact; ?>" name="event_contact"></input>
							</div>
							<div class = "col-sm-4">
								<input class="ot-standout" id="event_email" placeholder="Email" type="email" value="<?php echo $event_contact_email; ?>" name="event_contact_email"></input>
							</div>
							<div class = "col-sm-4">
								<input class="ot-standout" id="event_phone" type="tel" placeholder="Phone" value="<?php echo $event_contact_phone; ?>" name="event_contact_phone"></input>
							</div>
				</div>
			</div>
			<div class="nav navbar">
				<div class = "col-sm-12" style="margin-bottom:10px;">
				<div class="btn-group">
					
					<a type="button" href="mailto:
					<?php 
											
					echo $event_contact_email;
												
					?>?Subject=<?php echo $artist_name . " - " . $eventName  ." - " . $dateHead;?>&body=Hi," class="btn btn-danger" style="width:50px;height:50px;border-radius:25px; font-family:Oswald; margin-right:10px;padding:14px;"><span class="fa fa-envelope"></span></a>
															
					<a class="btn btn-primary ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:5px; font-size:12px;" href="sms:<?php echo $event_contact_phone; ?>"><span class="fa fa-comment"></span></a>
															
					<a class="btn btn-success ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:5px; font-size:12px;" href='tel:<?php echo $event_contact_phone; ?>'><span class="fa fa-phone"></span></a>
					
				</div>				
				</div>
			</div>

			
		</form>
	</div>	
</div>		
</div>

<?php
mysqli_close($con);
?>

<script src='js/jquery-ui-timepicker-addon.js'></script>
	<script>
	$( "#eventbutton" ).click(function() {
	  $( "#eventpanel" ).toggle( "blind", 200 );
	});
	</script>
	<script>
	$( "#locationbutton" ).click(function() {
	  $( "#locationpanel" ).toggle( "blind", 200 );
	});
	</script>
	<script>
	$( "#contactbuttonEvent" ).click(function() {
	  $( "#contactpanelEvent" ).toggle( "blind", 200 );
	});
	</script>
	<script>	
		(function()
		{
			var realDate = '<?php echo $thetime;?>';

			var elem = document.createElement('input');
			elem.setAttribute('type', 'time');
			
			if ( elem.type === 'text' )
				{
					$('.clockpicker').clockpicker({
						align: 'left',
						donetext: 'Done'
					});	
					$('#time').datetimepicker('setTime', realDate);
				}

		})();		
	</script>
	<script>	
		(function()
		{
			var queryDate = '<?php echo $datevalue;?>',
			dateParts = queryDate.match(/(\d+)/g)
			realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
			
			var queryTime = '<?php echo $thetime;?>';
			
			var elem = document.createElement('input');
			elem.setAttribute('type', 'date');
			
			if ( elem.type === 'text' )
				{
					$('#date').datepicker(
					{ 
						dateFormat: 'yy-mm-dd'
					}); // format to show
					
					$('#date').datepicker('setDate', realDate);
				}

		})();		
	</script>		
<script>
function updateEventForm() 
{
	$( ".#eventFormUpdate" ).change(function()
	$.ajax({
		type: 'post',
		url: 'ontour/dates/day_sheet/day_items/update_event.php',
		data: $('eventFormUpdate').serialize(),
		success: function () {
		$( "#settingsWindow" ).load( "ontour/dates/day_sheet/day_items/event_view.php" );
		}
		});
});
</script>
