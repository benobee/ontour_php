<?php session_start(); ?>
<?php ob_start(); ?>
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
$sun = $_SESSION['nameid'];

?>

    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'add_show.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "dates.php" );
            }
          });

        });

      });
    </script>

		

<div class="row" style="padding:10px;">
<div class="col-sm-6">
		<div class="nav navbar ot-tour-head" style="border-radius:4px;">
			<div class="pull-left" style="padding:10px;">
				<h5 style="color: #FCF7E4;">Add Dates</h5>
			</div>
		</div>			
				<form action="/">
					<div class="form-group">
								<input type="hidden" class="form-control" id="session_username" name="session_username"
								value = "<?php echo $sun; ?>">
					</div>
					<div class="row" style="padding-bottom:0px;">
						<div class ="col-xs-12">
							 <label for="show_status" class="checkbox-inline">					
							 <span style="margin-left:10px;">Confirmed <span class = "fa fa-flag"></span></span><input 
							 type ="checkbox" class="form-control" id="show_status" name="show_status" value=
							 "Confirmed" style= "width:20px;height:20px;"></label></input>
						</div>
						<div class ="col-xs-8">
							 <label for="single" class="checkbox-inline">					
							 <span style="margin-left:10px;"> Day Type</span><input type ="checkbox" class=
							 "form-control" id="single" name="single" value="0" onclick="toggle_visibility('dayGroup')"
							 style= "width:20px;height:20px;margin-bottom:20px;">   - Default: Perform
							 </label>
						</div>						
						<div class ="col-xs-4">
							 <label for="repeating" class="checkbox-inline">					
							 <span style="margin-left:10px;"> Tour</span><input type ="checkbox" class="form-control" 
							 id="repeating" name="repeating" value="1" onclick=
							 "toggle_visibility('show_qty');toggle_visibility('show_tour');" style= 
							 "width:20px;height:20px;margin-bottom:20px;" value="repeating"></label>
						</div>
					</div>
				
					<div class = "row">
						<div class ="col-xs-6">	 
							  <div class="form-group">
								<span class='glyphicon glyphicon-calendar'></span> Date
								<input type ="date" style="border-radius:4px;" class="ot-standout" id="date" name="show_date" required></input>
							  </div>
						</div>						
						<div class ="col-xs-6" id="show_qty" style="display:none;">	 
							  <div class="form-group">
								<div># of days</div>
								<input type ="number" max="45" style="margin-left:10px; font-size: 14px; 
								border-radius:4px; width:65px;" class="ot-standout" name="show_qty"></input>
							  </div>
						</div>
					</div>		 			
					<div class = "row" id="dayGroup" style="display:none;">					
						<div class ="col-xs-12" id="radio-group">
						<label for="radio-group"><span class = "fa fa-tasks"></span> Day Type</label>
						</div>
						<div class ="col-sm-4">
							 <label for="Perform" class="radio-inline"> 					
							 <span style="margin-left:10px;">Perform</span><input type ="radio" class="form-control" 
							 id="Perform" name="show_type" style= "width:30px;height:30px; margin-bottom: 20px;" value
							 ="Perform" checked></label></input>
						</div>
						<div class ="col-sm-4">
								<label class="radio-inline">
								<span style="margin-left:10px;">Rehearse</span><input type ="radio" class=
								"form-control" value="Rehearse" style= "width:30px;height:30px;margin-bottom: 20px;" 
								id="Rehearse" name="show_type"></label></input>
						</div>
						<div class ="col-sm-4">
								<label class="radio-inline">
								<span style="margin-left:10px;">Travel</span><input type ="radio" class="form-control"
								value="Travel" style= "width:30px;height:30px;margin-bottom: 20px;" id="Travel" name=
								"show_type"></label></input>
						</div>
						<div class ="col-sm-4">
							 <label for="Promote" class="radio-inline"> 					
							 <span style="margin-left:10px;">Promote</span><input type ="radio" class="form-control" 
							 id="Promote" name="show_type" style= "width:30px;height:30px; margin-bottom: 20px;" value
							 ="Promote"></label></input>
						</div>
						<div class ="col-sm-4">
								<label class="radio-inline">
								<span style="margin-left:10px;">Record</span><input type ="radio" class="form-control"
								value="Record" style= "width:30px;height:30px;margin-bottom: 20px;" id="Record" name=
								"show_type"></label></input>
						</div>
						<div class ="col-sm-4">
								<label class="radio-inline">
								<span style="margin-left:10px;">TBA</span><input type ="radio" class="form-control" 
								value="TBA" style= "width:30px;height:30px;margin-bottom: 20px;" id="TBA" name=
								"show_type"></label></input>
						</div>
					</div>	
					<div class ="row">
						<div class ="col-xs-12" id="show_tour" style="display:none;">	 
							<div class="form-group">
								<span class = "fa fa-bookmark"></span> Tour Name
								<input type="text" class="ot-standout" name="show_tour"></input>
							</div>
						</div>
						<div class ="col-xs-12">						
								<span class ="glyphicon glyphicon-map-marker"></span> Location		
								<div id="locationField">
								<input id="venue_search" class ="ot-standout" placeholder="Search or Enter Address"
								onFocus="geolocate();initialize();" type="text" name="event_address" required></input>
								</div>	
							<div id="address">
							  <div class ="hidden">
								<label class="label">Street address</label>
								<input class="form-control" id="street_number" name="event_street_number"
									  disabled="true"></input>
								<input class="form-control" id="route" name="event_route"
									  disabled="true"></input>
							  </div>
							 <div class ="hidden">
								<label class="label">City</label>
								<input class="form-control" id="locality" name="event_locality"
									  disabled="true"></input>
							  </div>
							<div class ="hidden">
								<label class="label">State</label>
								<input class="form-control"
									  id="administrative_area_level_1" name="event_administrative_area_level_1"
									  disabled="true"></input>
							  </div>
							  <div class ="hidden">
								<label class="label">Zip code</label>
								<input class="form-control" id="postal_code" name="event_postal_code"
									  disabled="true"></input>
							  </div>
							 <div class ="hidden">
								<label class="label">Country</label>
								<input class="form-control"
									  id="country" name="event_country"
									  disabled="true"></input>
							  </div>
							</div>
						</div>
				    </div> 
					<br>
					<div class = "navbar">
						<a class = "btn btn-info ot-button pull-left" onclick="dates()" href="#">Close</a>					
						<button type="submit" onclick="addShow()" class = "btn btn-success pull-right btn-lg ot-button"><span class = "fa fa-plus-circle"></span> Add</button>
					</div>						
				</form>					
</div>	
</div>

<script src='docs/js/googlePlacesAPI.js'></script>	