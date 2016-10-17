<?php session_start(); ?>
<?php
		include_once "dbconnect.php";
		include_once "handler.php";
		include_once "classes.php";
		include_once "functions.php";
?>

<?php
$dateShort = $_SESSION['dateShort'];
$show_crew_date = $_SESSION['showcrewdate'];
$id = $_COOKIE["daysheetID"];
$sun = $_SESSION['nameid'];
?>

<?php
$admin = $_SESSION['admin'];
if ($admin == 1)
			{
				$sun = $nameid;
				$hide = "";
				$admin = true;
			}			
		else 
			{
				$sun = $nameid;
				$hide = "hidden";
				$admin = false;
			}
?>
	<script>
      $(function () {
        $('form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'ontour/dates/update_show.php',
            data: $('#settingsForm').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
				$( "#bottomNav" ).show();
            }
          });
        });
      });
    </script>
				
			<form id="settingsForm" action="/">									
			<div class ="row" style="border-bottom-left-radius:8px;border-bottom-right-radius:8px;">
				<div class="col-sm-12">
				<div class="nav navbar">
					<div class="pull-right"style="margin-top:15px;">
					<button onclick="closeDayInfo()" style="margin-right:15px;border-width:0px;" class="ot-button ">Close</button>
					<button type="submit" class="ot-button"><span class="fa fa-cloud-download"></span> Update</button>
				</div>
				</div>				
					<div id="dayinfo" class="" >
					<div class ="row ">
							<div class="col-xs-6">
								<div style="font-size:12px;">
			
									<div class="input-group">
										<select id="show_status" onchange="updateShowInfo()" name="show_status" class="ot-standout" name="show_status">
										<option></option>
										<?php echo $show_status; ?>
										</select>
										<span class="input-group-addon">
										<span class="fa fa-flag"></span>
										</span>
									</div>
									
								</div>
							</div>
							<div class="col-xs-6">
								<div style="font-size:12px;">
				
									<div class="input-group">
										<select id="show_type" name="show_type" class="ot-standout" name="ot-standout">
										<option></option>
										<?php echo $show_type; ?>
										</select>
										<span class="input-group-addon">
										<span class="fa fa-tasks"></span>
										</span>
									</div>
									
								</div>
							</div>
							<div class="col-xs-12">
								<div>						
									<div id="show_tour" style="font-size:12px;">	 
							
											<input type="text" placeholder="Tour Name" class="ot-standout" value="<?php echo $tour; ?>" name="show_tour"></input>
									
									</div>
								</div>
							</div>
					</div>
					</div>
					<div class="<?php echo $hide;?>">
					<div id="contactinfo" style="font-size:12px;">
					<div class ="row">						
								<div class="col-md-4">												 
								
											<input type="text" placeholder="Contact Name" class="ot-standout" value="<?php echo $show_contact; ?>" name="show_contact"></input>
							
								</div>
								<div class="col-md-4">
									
	
											<input type="tel" placeholder="Phone" id="business_phone" class="ot-standout" value="<?php echo $show_contact_phone; ?>" name="show_contact_phone"></input>
									
								</div>
								<div class="col-md-4">
						

											<input type="email" placeholder="Email" class="ot-standout" value="<?php echo $show_contact_email; ?>" name="show_contact_email"></input>
									
								</div>							
						</div>
					</div>
					</div>
					
					<div class ="row" style="font-size:12px;">				
							<div class ="col-sm-12">						

								<div class="input-group">
									<input id="venue_search" class ="ot-standout" placeholder="Search or Enter Address" onFocus="geolocate();initialize();" type="text" value="<?php echo $venue; ?>" name="event_address"></input>	
										<span class="input-group-addon">
										<span class="glyphicon glyphicon-map-marker"></span>
										</span>
								</div>
				
							</div>

					<div id="venueinfo">		
						<div id="address">
							<div class ="col-sm-6">
								<input class="ot-standout" id="street_number" placeholder="Street Number" value="<?php echo $address1; ?>" name=
								"event_street_number"></input>
							</div>
							<div class ="col-sm-6">
								
								<input class="ot-standout" id="route" placeholder="Street" value="<?php echo $address2;?>" name="event_route"
								></input>
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
	
								<input class="ot-standout" id="postal_code" placeholder="Postal Code" value="<?php echo $postal; ?>" name="event_postal_code"
									  ></input>
							</div>
							<div class ="col-sm-12">
	
								<input class="ot-standout"
									  id="country" name="event_country" placeholder="Country" value="<?php echo $country; ?>"
									  ></input>
							</div>
							<div class ="col-sm-12">
								<input class="ot-standout"
									  id="show_location" name="show_location" placeholder="Coordinates" value="<?php echo $geoLoc; ?>"
									  ></input>
							</div>
							<div class ="col-sm-12 hidden">
								<input class="ot-standout"
									  id="business_name" name="business_name" placeholder="Venue" value="<?php echo $venue; ?>"
									  ></input>
							</div>

						</div>
							<div class ="col-sm-3 hidden">
								<div class="form-group">
									<label class="label ot-standout-label">Capacity</label>
									<input class="ot-standout"
									id="venue_capacity" name="venue_capacity" value="<?php echo $capacity; ?>"></input>
								</div>
							</div>	
					</div>
					</div>

				</div>
			</div>		
</form>
	
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
	<script>	
		(function()
		{
			var realDate = '<?php echo $thetime;?>';

			var elem = document.createElement('input');
			elem.setAttribute('type', 'datetime-local');
			
			if ( elem.type === 'text' )
				{
					$('#time').timepicker(
					{ 
						timeFormat: 'HH:mm:ss',
						pickerTimeFormat: 'hh:mm TT',
						timeOnly: true,
						showSecond: false					
					}); // format to show
					
					$('#time').timepicker('setTime', realDate);
				}
		})();		
	</script>
	<script>	
		(function()
		{
			var queryDate = '<?php echo $showdate;?>',
			dateParts = queryDate.match(/(\d+)/g)
			realDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
		
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

<script src='docs/js/googlePlacesAPI.js'></script>