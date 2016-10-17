<?php session_start(); ?>
<?php
$dateShort = $_SESSION['dateShort'];
$show_crew_date = $_SESSION['showcrewdate'];
$id = $_COOKIE["daysheetID"];
$sun = $_SESSION['nameid'];
?>

    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/day_sheet/day_items/add_item.php',
            data: $('#dayItemForm').serialize(),
            success: function () {
              $( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_items/times.php" );
            }
          });

        });

      });
    </script>
		<div class="venue-details" style="padding:5px;margin-bottom:15px;box-shadow: 5px 10px 25px #323333;">
			<div class ="ot-dark-head" style ="border-color:black;height:35px;">
				<div class = "navbar">
				<div style="color:#FFFFEC;opacity:0.85;padding:5px;border-radius:4px;"> Add Day Item</div>
				</div>
			</div>
		
				<form id="dayItemForm" action="/">
				<div class="form-group">
								<input type="hidden" class="ot-standout" id="session_username" name="session_username"value = "<?php echo $sun; ?>"></input>
								<input type="hidden" class="ot-standout" id="show_id" name="show_id"value = "<?php echo $id; ?>"></input>
								<input type="hidden" class="ot-standout" id="show_date" name="show_date" value = "<?php echo $show_crew_date; ?>"></input>
				</div>
		<div class = "row"> 
						<div class ="col-xs-6" style="color:#FFFFEC;margin-bottom:5px;">
						<div class="row">
						<div class="col-xs-3">
						<input type ="checkbox" class="form-control" id="show_status" name="event_status" style= "width:20px;height:20px;color:#FFFFEC;margin-left:10px;" value="Confirmed" checked></input>
						</div>
						<div class="col-xs-9">
						<label for="show_status" style="font-size:11px;">Confirmed <span class ="fa fa-flag"></span></label>
						</div>
						</div>
						</div>
	
						
						<div class = "col-xs-12">
						<p style="font-size:8px; opacity:0.85;color:#FFFFEC;">All times set after midnight need to select the next day to remain in chronological order.</p>
						</div>
						<div class ="col-xs-6">	  
							<div class="input-group" >
								<input type="date" class="ot-standout" id="thedate" style="font-size:14px;" name="event_date" value="<?php echo $show_crew_date;?>"></input>
								<span class="input-group-addon">
								<span class="fa fa-calendar"></span>
								</span>
							</div>
						</div>
						<div class ="col-xs-6">	  	
							<div class="input-group clockpicker">
								<input type="time" class="ot-standout" id="time" style="font-size:14px;" name="event_time"></input>
								<span class="input-group-addon">
								<span class="fa fa-clock-o"></span>
								</span>
							</div>
						</div>
						<div class ="col-xs-12" style="color:#FFFFEC;margin-top:8px;">
							<div class="input-group">
								<select id="event_type" name="event_type" style="font-size:14px;" class="ot-standout" name="event_type" placeholder="" required>
								  <option></option>
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
								  <option>rehearsal</option>			
								  <option>misc</option>								  
								</select>
									<span class="input-group-addon">
									<span class="fa fa-tasks"></span>
									</span>
							</div>
						</div>	 
						<div class ="col-xs-12">															
							<div id="locationField" style="color:#FFFFEC;margin-top:10px;">

							<div class="input-group">
							<input id="venue_search" class ="ot-standout"
							onFocus="geolocate();initialize();" type="text" style="font-size:14px;" placeholder="Search by address or venue name" name="event_address"></input>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-map-marker"></span>
									</span>
							</div>	
							<div id="address">
								  <div class="hidden">
									<label class="label">Name</label>
									<input class="form-control" id="name" name="name"></input>
								  </div>
								  <div class="hidden">
									<label class="label">Street address</label>
									<input class="form-control" id="street_number" name="event_street_number"
										  disabled="true"></input>
									<input class="form-control" id="route" name="event_route"
										  disabled="true"></input>
								  </div>
								  <div class="hidden">
									<label class="label">City</label>
									<input class="form-control" id="locality" name="event_locality"
										  disabled="true"></input>
								  </div>
								  <div class="hidden">
									<label class="label">State</label>
									<input class="form-control"
										  id="administrative_area_level_1" name="event_administrative_area_level_1"></input>
								  </div>
								  <div class="hidden">
									<label class="label">Zip code</label>
									<input class="form-control" id="postal_code" name="event_postal_code"
										  disabled="true"></input>
								  </div>
								  <div class="hidden">
									<label class="label">Country</label>
									<input class="form-control"
										  id="country" name="event_country"
										  disabled="true"></input>
								  </div>
							</div>
							</div>
						<div class ="col-xs-12 hidden" style="margin-top:10px;">	 
							<div class="form-group">
								<label for="show_details" style="color:#FFFFEC;"><span class = "fa fa-pencil"></span> Notes (optional) <small> </small></label>
								<textarea class="ot-standout" name="event_details" rows="3"></textarea>
							</div>
						</div>
					
						</div> 
						<div class ="col-xs-12">	 
							<div style="height:50px;margin-top:10px;">						
								<a class = "btn btn-default pull-left ot-button" onclick="closeDayItem();">Close</a>
								<button type="submit" class = "btn btn-success pull-right ot-button" style= "width:80px;"><span class = "fa fa-plus-circle"></span> Add</button>
							</div>	
						</div>
										
				</form>							
		</div>
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
		var elem = document.createElement('input');
		elem.setAttribute('type', 'date');		
		if ( elem.type === 'text' )
			{
				$('#thedate').datepicker
				(		
					{
						dateFormat: 'yy-mm-dd'
					}
				);	
			}
	})();		
</script>

