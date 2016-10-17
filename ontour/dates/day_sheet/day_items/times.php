<?php session_start();?>
<?php
require_once "dbconnect.php";
require_once "handler.php";
include_once "classes.php";

$admin = $_SESSION['admin'];
if ($admin == 1)
			{
				$sun = $nameid;
				$hide = "";
				$admin = true;
				$show = "hidden";
			}			
		else 
			{
				$sun = $nameid;
				$hide = "hidden";
				$admin = false;
				$show = "";
			}

$sun = $_SESSION['nameid'];
$showdate = $_SESSION['showcrewdate'];
?>
		
<?php						
	// EVENTS
	$eventQuery = "SELECT * FROM events WHERE session_username = '$sun' AND event_date = '$showdate' ORDER BY event_time";
	$eventDateQuery = mysqli_query($con, $eventQuery);
						while ($row=mysqli_fetch_assoc($eventDateQuery))						
						{
							
							switch ($row['event_type']) 
							{
								case 'performance':
								$eType = "fa fa-music";
								break;
								case 'radio':
								$eType = "fa fa-headphones";
								break;			
								case 'lodging check in':
								$eType = "fa fa-home";
								break;
								case 'lodging check out':
								$eType = "fa fa-home";
								break;
								case 'flight':
								$eType = "fa fa-plane";
								break;
								case 'van call':
								$eType = "fa fa-truck";
								break;
								case 'drive':
								$eType = "fa fa-truck";
								break;
								case 'meet':
								$eType = "fa fa-group";
								break;
								case 'food':
								$eType = "fa fa-cutlery";
								break;
								case 'recording':
								$eType = "fa fa-microphone";
								break;
								case 'rehearsal':
								$eType = "fa fa-clock-o";
								break;
								case 'load in':
								$eType = "fa fa-suitcase";
								break;
								case 'sound check':
								$eType = "fa fa-bullhorn";
								break;
								case 'doors open':
								$eType = "fa fa-flag";
								break;
								case 'misc':
								$eType = "fa fa-asterisk";
								break;								
								default:
								$eType = ""; 
								break;
							}
							
							$eventID = $row['id'];
							$eventpanel = $row['id'] . "panel";
							
							$typeDesc = ucwords($row['event_type']);
							$longdetails = $row['event_details'];
							$eventAddress = $row['event_street_number'] . " " . $row['event_route'] . " " . $row['event_postal_code'];
							$thenameofbusiness = $row['event_business_name'];
							
							switch ($row['event_status']) 
								{
									case 'Confirmed':
										$Estatus = "<span class='glyphicon glyphicon-ok-sign ot-show-confirmed'</span>";
										break;
									case 'Pending':
										$Estatus = "<span class='glyphicon glyphicon-question-sign ot-show-pending'</span>";
										break;			
									case 'Cancelled':
										$Estatus = "<span class='glyphicon glyphicon-remove-circle ot-show-cancelled'</span>";
										break;							
										default:
										$Estatus = " "; 		
								}
										

							if (strlen($thenameofbusiness) !== 0)
								{
									$go = $eventAddress;
								}
							else
								{
									$go = $location;
								}
							
							if ($row['event_time'] == NULL)
								{
									$time = "TBA ";
								}
								
							else
								{
									$time = date("g:i", strtotime($row['event_time']));
									$time2 = date("A", strtotime($row['event_time']));
								}
								
							if ($showdate == $row['event_date'])
								{								
?>		

			
		<div class='row' class="venue-details" style="border-radius:4px; color:#FCF7E4; background:black;box-shadow: 5px 10px 25px #323333;">
			<div class='col-xs-2 <?php echo $show;?>' style="padding:5px;">
				<a type="button" style="width:50px;height:50px;border-radius:25px; margin-left:10px; margin-right:10px;padding:14px;" href="http://maps.apple.com/?q=<?php echo $go; ?>" class="btn btn-success ot-show-group">
				<span class='fa fa-map-marker'></span></a>
			</div>
			<div class='col-xs-2 <?php echo $hide;?>'>
				<div class='dropdown' style="padding:5px;">															
					<button data-toggle='dropdown' onclick="setCookie('eventID', this.name, 365);" name="<?php echo $row['id'];?>" class ='btn-danger ot-multi' style=' width:40px; height:40px; border-radius:20px;'>
					<span class='fa fa-ellipsis-h'></span></button>															
					<ul class='dropdown-menu' role='menu' style='width:230px; margin-bottom:10px; border-radius:4px; background:black; border-width:0px;'>															
					<div class='dropdown-menu btn-group' style='border-width:0px; background: black;'>										
					<a type="button" style="width:64px;height:64px;border-radius:32px; margin-left:10px; margin-right:10px;padding:20px;" href="http://maps.apple.com/?q=<?php echo $go; ?>" class="btn btn-success ot-show-group">
					<span class='fa fa-map-marker'></span></a>
												
					<a type="button" style="width:64px;height:64px; padding:20px; border-radius:32px; margin-right:10px;" name="<?php echo $row['id'];?>" onclick="itemSettings()" id="adminbutton" class="btn btn-default ot-show-group">
					<span class="fa fa-gear"></span></a>
												
					<a type="button" name="<?php echo $row['id'];?>" style="width:64px;height:64px; padding:20px; border-radius:32px;" onclick="$(document.getElementById(this.name)).show('slide', { direction: 'left' }, 200);" class="<?php echo $hide;?> btn btn-danger ot-show-group">
					<span class="fa fa-trash-o"></span></a>																							
					</div>
					</ul>
				</div>										
			</div>
		
			<div class="col-xs-1">
				<div style="margin-left:5px; margin-top:12px;">
					<?php echo $Estatus;?>
				</div>
			</div>								
			<div style="color:#FFFFF0; border-color:#181818;">								
				<div class='col-xs-2' style='font-size:12px; font-family:oswald;text-align:right; margin-left:6px; margin-top:10px;margin-bottom:1px;'>  <?php echo $time . " " . $time2; ?>
				</div>								
				<div class='col-xs-1'>									
					<span style="margin-top:12px;" class="<?php echo $eType;?>"></span>
				</div>										
				<div class='col-xs-5'>
					<div style="margin-top:10px; font-size:10px;font-family:oswald;">
						<?php echo strtoupper($typeDesc); ?><br>
										
						<?php
													
						echo "<div style='margin-bottom:10px; color:#9D9D9D; background:none; opacity: 0.83; font-size:10px'>" . $row['event_business_name'] ."</div>";												
						?>		
					</div>
				</div>
			</div>
		</div>
		<div id ="<?php echo $row['id'];?>" style="display:none;">
				<div style="border-radius:8px;box-shadow: 5px 10px 25px #323333;">
					<form id="addDatesForm" action="/">
					<div class = "navbar">
						<a class = "btn btn-info ot-button pull-left" name="<?php echo $row['id'];?>" style="margin-left:15px;" onclick="$(document.getElementById(this.name)).hide('slide', { direction: 'left' }, 200);">Cancel</a>
						<a class = "btn btn-danger ot-button pull-right" style="margin-right:15px;" onclick=
						"deleteEvent()"><span class = "fa fa-trash-o"></span> DELETE?</a>		
					</div>
					</form>		
				</div>
			</div>	
						<?php
								}							
						}						
						?>	
						

<script>
function toggleDelete(){
$( "#confirm" ).fadeIn('slow');
}
</script>
<script>
function fadeDelete(){
$( "#confirm" ).fadeOut('fast');
}
</script>