<?php session_start();?>
<?php include_once("ontour/home/analyticstracking.php") ?>
<?php
		include_once "dbconnect.php";
		include_once "handler.php";
		include_once "classes.php";
		include_once "functions.php";
?>
<?php	

$id = $_SESSION['band_id'];						
$nameid = $_SESSION['nameid'];
		
		if (isset($_GET['filter']))
			{
				$_SESSION['filter'] = $_COOKIE['filter'];
				$filter = $_SESSION['filter'];
			}
		elseif ($_SESSION['filter'])
			{
				$filter = $_SESSION['filter'];
			}
		elseif ($_COOKIE['filter'])
			{
				$_SESSION['filter'] = $_COOKIE['filter'];
				$filter = $_SESSION['filter'];
			}
			
		$_SESSION['band_id'] = $id;
		$band_id = $id;
		
		$_SESSION['parent_page'] = $pageURL .= $_SERVER["SCRIPT_NAME"];
		$_SESSION['settings_page'] = $pageURL .= $_SERVER["SCRIPT_NAME"];
		
		$par_art = mysqli_query($con,"SELECT * FROM bands WHERE id = '$band_id'");		
		while($row = mysqli_fetch_assoc($par_art))
			{
				$parent_artist = $row['parent'];
				$memberofband = $row['member'];	
				$admin = $row['admin'];
			}
			
		$_SESSION['admin'] = $admin;
		$_SESSION['theparent'] = $parent_artist;
		$_SESSION['themember'] = $memberofband;	
		$_SESSION['timezone'] = $_COOKIE["timezone"];
		$_SESSION['day'] = $_COOKIE["day"];	
		
		$day = $_SESSION['day'];
		$timezone = $_SESSION['timezone'];		
		date_default_timezone_set($timezone);

		$today = date("Y-m-d");
		$_SESSION['today'] = $today;
		$firstday = $_COOKIE["firstdate"];
		$lastday = $_COOKIE["lastdate"];
		
		if (isset($_COOKIE["firstdate"]))
			{
				$_COOKIE["firstdate"] = $_SESSION['rangefirst'];
			}
			
		elseif($_POST['first'])
			{
				$_SESSION['rangefirst'] = $_POST['first'];
				$firstday = $_SESSION['rangefirst'];	
			}		
		elseif($_SESSION['rangefirst'])
			{
				$firstday = $_SESSION['rangefirst'];	
			}
		else
			{
				$firstday = $today;
			}
		
		if (isset($_COOKIE["lastdate"]))
			{
				$_COOKIE["lastdate"] = $_SESSION['rangelast'];
			}		
		elseif ($_POST['last'])
			{
				$_SESSION['rangelast'] = $_POST['last'];
				$lastday = $_SESSION['rangelast'];				
			}
		elseif($_SESSION['rangelast'])
			{
				$lastday = $_SESSION['rangelast'];
			}
		else
			{
				$date = strtotime("+30 day");
				$lastday = date('Y-m-d', $date);
			}

		$user = strtolower($_SESSION['username']);
		if ($admin == 1)
			{
				$sun = $nameid;
				$eventForm = 
				"<div class='btn-group' style='width:140px;'>
				<a type='button' style='height:60px; width:60px;' id='showmodal' class ='btn ot-small-button van' href = '#addEvent' data-toggle ='modal'></a>
				<a type='button' id='whosin' style='height:60px; width:60px;' data-toggle='modal' class = 'btn ot-small-button people' href ='#who'></a>
				</div>";
				$hide = "";
		
			switch($filter)
				{
					case "RANGE":
					$query = ("
					SELECT id as show_id, show_location, show_type, show_date, show_venue,session_username, show_status, venue_address, venue_city, venue_state, venue_zipcode, venue_country, venue_route FROM shows WHERE shows.session_username = '$sun' AND shows.show_date >= '$firstday' AND shows.show_date <= '$lastday' ORDER BY shows.show_date");
					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username = '$sun' ORDER BY event_time");
					$month_select = "background:#CC3300;";
					break;
					
					case "TODAY":
					$query = ("
					SELECT id as show_id, show_location, show_type, show_date, show_venue,session_username, show_tour, show_contact, show_contact_phone, show_contact_email, show_status, venue_address, venue_city, venue_state, venue_zipcode, venue_country, venue_route FROM shows WHERE shows.session_username = '$sun' AND shows.show_date = '$today' ORDER BY shows.show_date LIMIT 1");
					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username = '$sun' AND event_date = '$today' ORDER BY event_time");				
					$today_select = "background:#CC3300;";
					break;
					
					case "ALL":
					$query = ("
					SELECT id as show_id, show_location, show_type, show_date, show_venue,session_username, show_status, venue_address, venue_city, venue_state, venue_zipcode, venue_country, venue_route FROM shows WHERE shows.session_username = '$sun' ORDER BY shows.show_date LIMIT 90");
					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username = '$sun' ORDER BY event_time");
					$all_select = "background:#CC3300;";
					break;
					
					default:
					break;	
				}
				
				$admin = true;
			}			
		else 
			{
				$sun = $nameid;
				$hide = "hidden";
				$admin = false;
			}
	
		$_SESSION['sun'] = $sun;
		$first = $_SESSION['first_name'];		
		?>
		
<style>
.venue-details{
background: rgba(0, 0, 0, 0.60);
color: #FCF7E4;
vertical-align:text-middle;
padding:10px;
font-family:oswald;
}
.ot-show-group{
background: #2D2D2D;
color:white;
padding:10px;
border-radius: 4px;
text-align: center;
border-color: #2D2D2D;
}​
		
</style>
    <script>
      $(function () {

        $('#addDatesForm').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/add_show.php',
            data: $('#addDatesForm').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=ALL" );
			  $( "#bottomNav" ).show();
            }
          });

        });

      });
	  
	    function addImportShow(){
				$.ajax({
					type: 'post',
					url: 'ontour/dates/add_show.php',
					data: $('#bandsintown').serialize(),
					success: function () {
					$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=ALL" );
					$( "#bottomNav" ).show();
					}
				});
		}
</script>
	<?php
				$artist = mysqli_query($con,"SELECT * FROM band_names WHERE id = '$nameid'");
				while($row = mysqli_fetch_assoc($artist)){
						$artist_id = $row['artist_id'];
						$_SESSION['artist_id'] = $artist_id;
					}
				
					if ($_SESSION['artist_id']){
						$theartist_id = $artist_id;
					}
					else{
						$hideBandsButton = "";
						$hideSongButton = "hidden";
					}


	?>
<script>
function bandsintown(){

document.cookie="filter=ALL";
var artist_id = '<?php echo $theartist_id;?>';
if (artist_id.length <= 0){
var artist_name = '<?php echo $_SESSION['thename'];?>';

					console.log("Searching Bandsintown");

					
						$.ajax({	
							url: 'http://api.bandsintown.com/artists/'+ artist_name +'/events.json?&api_version=2.0',
							dataType: "jsonp",
							data: {
								app_id: "ONTOUR"
							}, 
							
							success:function(data){	
							console.log(data);
														
									console.log(data);
									
									var date = data;
								if (data.length > 0){
									for (var i = 0; i < data.length; i++){
									
									var datetime = document.getElementById('bit_datetime');
									datetime.setAttribute('value',data[i].datetime);
									
									var venue = document.getElementById('bit_venue');
									venue.setAttribute('value',data[i].venue.name);
									
									var country = document.getElementById('bit_country');
									country.setAttribute('value',data[i].venue.country);
									
									var city = document.getElementById('bit_city');
									city.setAttribute('value',data[i].venue.city);
									
									var id = document.getElementById('bit_form_location');
									id.setAttribute('value',data[i].formatted_location);
									
									var lat = document.getElementById('bit_lat');
									lat.setAttribute('value',data[i].venue.latitude);
									
									var lon = document.getElementById('bit_lon');
									lon.setAttribute('value',data[i].venue.longitude);									
									console.log("Show Added");
									addImportShow();
									}
								}
								else{
								document.getElementById('bands_button').innerHTML = "No Dates Found";
								console.log("Searched by name and no dates found");
								}

							
							}
						});

}
else{

var artist = artist_id;
	$.ajax({	
		url: 'http://developer.echonest.com/api/v4/artist/profile?bucket=id:facebook&bucket=id:musicbrainz&bucket=id:songkick',
		dataType: "jsonp",
		data: {
			api_key: "UJPOPHKAGZ3QX5IXP",
            format:"jsonp",
			id: artist
		},
		success:function(data){		
		console.log(data);
		
		var artist_name = data.response.artist.name;
			if (data.response.artist.foreign_ids[0].catalog == "facebook"){
			console.log("Id's Found");
				if (data.response.artist.foreign_ids[0].catalog == "facebook"){
					var fb = data.response.artist.foreign_ids[0].foreign_id;
					var fbid = (fb.split("facebook:artist:").pop());
					console.log("Searching Bandsintown");
						$.ajax({	
							url: 'http://api.bandsintown.com/artists/'+ artist_name +'/events.json?&api_version=2.0',
							dataType: "jsonp",
							data: {
								app_id: "ONTOUR",
								artist_id: fbid
							}, 
							
							success:function(data){	
							console.log(data);
							console.log("facebook");
					
									console.log(data);
									
									var date = data;
		
								if (data.length > 0){
									for (var i = 0; i < data.length; i++){
									
									var datetime = document.getElementById('bit_datetime');
									datetime.setAttribute('value',data[i].datetime);
									
									var venue = document.getElementById('bit_venue');
									venue.setAttribute('value',data[i].venue.name);
									
									var country = document.getElementById('bit_country');
									country.setAttribute('value',data[i].venue.country);
									
									var city = document.getElementById('bit_city');
									city.setAttribute('value',data[i].venue.city);
									
									var id = document.getElementById('bit_form_location');
									id.setAttribute('value',data[i].formatted_location);
									
									var lat = document.getElementById('bit_lat');
									lat.setAttribute('value',data[i].venue.latitude);
									
									var lon = document.getElementById('bit_lon');
									lon.setAttribute('value',data[i].venue.longitude);
									  
									console.log("Show Added");
									addImportShow();
									}
								}
								else{
								document.getElementById('bands_button').innerHTML = "No Dates Found";
								}
							}				
						});
					}
				}		
		else{
					console.log("Searching Bandsintown");
						$.ajax({	
							url: 'http://api.bandsintown.com/artists/'+ artist_name +'/events.json?&api_version=2.0',
							dataType: "jsonp",
							data: {
								app_id: "ONTOUR"
							}, 							
							success:function(data){	
							console.log(data);														
									console.log(data);									
									var date = data;
								if (data.length > 0){
									for (var i = 0; i < data.length; i++){
									
									var datetime = document.getElementById('bit_datetime');
									datetime.setAttribute('value',data[i].datetime);
									
									var venue = document.getElementById('bit_venue');
									venue.setAttribute('value',data[i].venue.name);
									
									var country = document.getElementById('bit_country');
									country.setAttribute('value',data[i].venue.country);
									
									var city = document.getElementById('bit_city');
									city.setAttribute('value',data[i].venue.city);
									
									var id = document.getElementById('bit_form_location');
									id.setAttribute('value',data[i].formatted_location);
									
									var lat = document.getElementById('bit_lat');
									lat.setAttribute('value',data[i].venue.latitude);
									
									var lon = document.getElementById('bit_lon');
									lon.setAttribute('value',data[i].venue.longitude);									
									console.log("Show Added");
									addImportShow();
									}
								}
								else{
								console.log("Searched by name and no dates found");
								}							
							}
						});
				}
			}				
			});
}			
}	

function songkick(){
var artist = '<?php echo $theartist_id;?>';

	$.ajax({	
		url: 'http://developer.echonest.com/api/v4/artist/profile?bucket=id:songkick',
		dataType: "jsonp",
		data: {
			api_key: "UJPOPHKAGZ3QX5IXP",
            format:"jsonp",
			id: artist
		},
		success:function(data){		
		console.log(data);
		
			if (data.response.artist.foreign_ids[0].catalog == "songkick"){
			console.log("ID Found " + data.response.artist.foreign_ids[0].foreign_id);
			
			var sk = data.response.artist.foreign_ids[0].foreign_id;
			var skid = (sk.split("songkick:artist:").pop());
			console.log(skid);
			
				$.ajax({	
					url: 'http://api.songkick.com/api/3.0/artists/'+ skid +'/calendar.json?',
					//dataType: "jsonp",
					data: {
						apikey: "mQxxmEuUBHytLuxR",
					},
					success:function(data){	
					console.log(data);
					
					var x = data.resultsPage.results;
					console.log(x);
					
								if (data.resultsPage.results.event){
					
									for (var i = 0; i < data.resultsPage.results.event.length; i++){
									
									if (data.resultsPage.results.event[i].start.time){
										var datetime = document.getElementById('bit_datetime');
										datetime.setAttribute('value',data.resultsPage.results.event[i].start.date + "T" + data.resultsPage.results.event[i].start.time);
										console.log(data.resultsPage.results.event[i].start.date + "T" + data.resultsPage.results.event[i].start.time);
									}
									else{
										var venue = document.getElementById('bit_datetime');
										venue.setAttribute('value',data.resultsPage.results.event[i].start.date + "T");
										console.log(data.resultsPage.results.event[i].start.date + "T");
									}
														
									var venue = document.getElementById('bit_venue');
									venue.setAttribute('value',data.resultsPage.results.event[i].venue.displayName);
		
									var country = document.getElementById('bit_country');
									country.setAttribute('value',data.resultsPage.results.event[i].venue.metroArea.country.displayName);
									
									var city = document.getElementById('bit_city');
									city.setAttribute('value',data.resultsPage.results.event[i].venue.metroArea.displayName);
									
									var id = document.getElementById('bit_form_location');
									id.setAttribute('value',data.resultsPage.results.event[i].location.city);
									
									var lat = document.getElementById('bit_lat');
									lat.setAttribute('value',data.resultsPage.results.event[i].location.lat);
									
									var lon = document.getElementById('bit_lon');
									lon.setAttribute('value',data.resultsPage.results.event[i].location.lng);
									
									console.log("Show Added");
									addImportShow();
									}
								}
								else {
								document.getElementById('song_button').innerHTML = "No Dates Found";
								}

					}
				});
			}
			else {
			document.getElementById('song_button').innerHTML = "No Songkick Account Detected";
			console.log("No dates found");
			}			
		}
	});
}
</script>
				
<div class="container" style="background:black">
<div class="row" id="addDatesPanel" style="padding:10px;border-radius:4px;display:none; z-index:2;top:0px;left:0px;">
<div class="col-sm-6 venue-details" style="border-radius:4px;">
			<div style="margin-bottom:10px">
			<form method="post" id="bandsintown">	
					<div class="hidden">
					<input class="ot-standout" name="bandsintown_date" id="bit_datetime">
					<input class="ot-standout" name="venue" id="bit_venue">
					<input class="ot-standout" name="country" id="bit_country">
					<input class="ot-standout" name="city" id="bit_city">
					<input class="ot-standout" name="lat" id="bit_lat">
					<input class="ot-standout" name="lon" id="bit_lon">
					<input class="ot-standout" name="form_location" id="bit_form_location">
					<input class="ot-standout" name="session_username" value="<?php echo $_SESSION['nameid'];?>">
					</div>

			<button id="bands_button_b" class = 'btn btn-default ot-button <?php echo $hide;?>' style="margin-top:10px;width:100px;position:relative;right:5px" onclick="bandsintown()" type="submit"><span class = "fa fa-cloud-download"></span> Bandsintown</button>
					
			<button id="song_button" class = 'btn btn-default ot-button <?php echo $hide . " " .$hideSongButton;?>' style="margin-top:10px;width:100px" onclick="songkick()" type="submit"><span class = "fa fa-cloud-download"></span> Songkick</button>
			</form>	
			</div>	
				<form id="addDatesForm" action="/">
					<div class="form-group">
						<input type="hidden" class="form-control" id="session_username" name="session_username"
						value = "<?php echo $sun; ?>">
					</div>
					<div class="row" style="padding-bottom:0px;">
						<div class ="col-xs-7">	 
							<div class="form-group">
							<span id="oneDate"><span class='glyphicon glyphicon-calendar'></span> Date</span>
							<input type ="date" style="border-radius:4px;" class="ot-standout" id="date" name="show_date" required></input>
						</div>
						</div>
						<div class ="col-xs-5">
							<div >
							 <label for="repeating">Repeating</label>				
							 <input type ="checkbox" class="form-control" 
							 id="repeating" name="repeating" value="1" onclick=
							 "toggle_visibility('show_qty');toggle_visibility('show_tour'); toggle_visibility('start');" style= 
							 "width:20px;height:20px;" value="repeating">
							</div>
						</div>
					</div>
					<div class = "row" id="show_qty" style="display:none;">
						<div class ="col-xs-7">	 
							<div class="form-group">
							<div>Every</div>
							<select name="freq" style="width:110px" class="ot-standout">
							  <option></option>
							  <option value="P1D">Day</option>
							  <option value="P7D">Week</option>
							  <option value="P1M">Month</option>
							</select>
							</div>
						</div>					
						<div class ="col-xs-5" >	 
							<div class="form-group">
							<div># of times</div>
							<input type ="number" max="45" style="font-size: 14px; 
							border-radius:4px;width:80px" class="ot-standout" name="show_qty"></input>
							</div>
						</div>
					</div>						
					<div class="row" style="padding-bottom:0px;">	
						<div class ="col-xs-7">
							 <label for="show_status">Confirmed	<span class = "fa fa-flag"></span>				
							 <input 
							 type ="checkbox" class="form-control" id="show_status" name="show_status" value=
							 "Confirmed" style= "width:20px;height:20px;"></label></input>
						</div>	
						<div class ="col-xs-5">
							 <label for="single">Day Type				
							 <input type ="checkbox" class=
							 "form-control" id="single" name="single" value="0" onclick="toggle_visibility('dayGroup')"
							 style= "width:20px;height:20px;margin-bottom:20px;">
							 </label>
						</div>												
					</div>				
						 			
					<div class = "row" id="dayGroup" style="display:none">					
						<div class ="col-xs-12" id="radio-group">
						<label for="radio-group"><span class = "fa fa-tasks"></span> Day Type</label>
						</div>
						<div class ="col-xs-4">
							 <label for="Perform"> 					
							 <span>Perform</span><input type ="radio" class="form-control" 
							 id="Perform" name="show_type" style= "width:30px;height:30px; margin-bottom: 20px;" value
							 ="Perform" checked></label></input>
						</div>
						<div class ="col-xs-4">
								<label>
								Rehearse<input type ="radio" class=
								"form-control" value="Rehearse" style= "width:30px;height:30px;margin-bottom: 20px;" 
								id="Rehearse" name="show_type"></label></input>
						</div>
						<div class ="col-xs-4">
								<label>
								<span>Travel</span><input type ="radio" class="form-control"
								value="Travel" style= "width:30px;height:30px;margin-bottom: 20px;" id="Travel" name=
								"show_type"></label></input>
						</div>
						<div class ="col-xs-4">
							 <label for="Promote"> 					
							 <span>Promote</span><input type ="radio" class="form-control" 
							 id="Promote" name="show_type" style= "width:30px;height:30px; margin-bottom: 20px;" value
							 ="Promote"></label></input>
						</div>
						<div class ="col-xs-4">
								<label>
								Record<input type ="radio" class="form-control"
								value="Record" style= "width:30px;height:30px;margin-bottom: 20px;" id="Record" name=
								"show_type"></label></input>
						</div>
						<div class ="col-xs-4">
								<label>
								<span>TBA</span><input type ="radio" class="form-control" 
								value="TBA" style= "width:30px;height:30px;margin-bottom: 20px;" id="TBA" name=
								"show_type"></label></input>
						</div>
					</div>	
					<div class ="row">

						<input type="text" class="ot-standout hidden" name="venue_name" id="business_name">
						<input type="text" class="ot-standout hidden" name="show_location" id="show_location">
						
						<div class ="col-xs-12">	 
							<div class="form-group">
								<span class = "fa fa-bookmark"></span> Name (optional)
								<input type="text" class="ot-standout" name="show_tour"></input>
							</div>
						</div>	
						<div class ="col-xs-12">						
								<span><span class ="glyphicon glyphicon-map-marker"></span> Location <span style="font-size:10px"></span></span>
								<div id="locationField">
								<input id="venue_search" class ="ot-standout" placeholder="Search for venue or enter address"
								onFocus="geolocate();initialize();" type="text" name="event_address"></input>
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
						<a class = "btn btn-info ot-button pull-left" onclick="closeAddDates()" type="button">Close</a>	<button type="submit" class = "btn btn-success pull-right btn-lg ot-button"><span class = "fa fa-plus-circle"></span> Add</button>
					</div>						
				</form>					
</div>	
</div>
</div>
<div class = "container" style="margin-bottom:150px;box-shadow: 5px 10px 25px #323333;">
	<div id="stuff" class = "row">			
<?php			
if ($admin)
	{
			$isShow = "SELECT show_date FROM shows WHERE session_username='$sun'";
			$isShowQuery = mysqli_query($con,$isShow);
			while ($row=mysqli_fetch_array($isShowQuery))
				{
					$yesShow = $row['show_date'];
					$hidenav = "";
				}
				
			if ($yesShow === NULL)
				{
					$hidenav = "hidden";
					?>
				
					<div id="no_dates" class='venue-details jumbotron ot-label'><div style="margin-bottom:10px;font-family: 'Special Elite', cursive;">Hey <?php echo $first;?>, you can add dates to your calendar by clicking the Add Dates Button.<br><br>
					
					<a class="btn btn-default ot-button" onclick="openAddDates()" type="button"><span class = "fa fa-plus-circle"></span> Add Dates</a><br><br>
					<form method="post" id="bandsintown">	
					<div class="hidden">
					<input class="ot-standout" name="bandsintown_date" id="bit_datetime">
					<input class="ot-standout" name="venue" id="bit_venue">
					<input class="ot-standout" name="country" id="bit_country">
					<input class="ot-standout" name="city" id="bit_city">
					<input class="ot-standout" name="lat" id="bit_lat">
					<input class="ot-standout" name="lon" id="bit_lon">
					<input class="ot-standout" name="form_location" id="bit_form_location">
					<input class="ot-standout" name="session_username" value="<?php echo $_SESSION['nameid'];?>">
					</div>
					<div style="font-family: 'Special Elite', cursive" class="<?php echo $hideBandsButton;?>">If you have an existing account with active events on the calendar you can import them with the options below.<br><br>
					<button id="bands_button" class = 'btn btn-default ot-button <?php echo $hide;?>' style="margin-top:10px;width:170px" onclick="bandsintown()" type="submit"><span class = "fa fa-cloud-download"></span> Import Bandsintown Events</button><br><br>
					
					<button id="song_button" class = 'btn btn-default ot-button <?php echo $hide . " " .$hideSongButton;?>' style="margin-top:10px;width:170px" onclick="songkick()" type="submit"><span class = "fa fa-cloud-download"></span> Import Songkick Events</button>
					</form>	
					</div>
					</div>
					
					<?php
				}
				

?>		
	<div class="visible-xs <?php echo $hidenav;?>" style="background:black;height:50px;">
	<a type="button" style="background:#212121;width:44px; height:44px;margin-right:10px;padding:12px;border-radius:22px;" onclick="controlPanel()" href="#" class="button ot-button pull-right"><span class="fa fa-bars"></span></a>
	</div>
	<div id="dateHeadSection" class="<?php echo $hidenav;?>">
		<div class="nav ot-navbar hidden-xs" style="background:black; color:#FCF7E4; padding:5px;opacity: 0.88; font-family:oswald; font-size:14px;">		
			<div class="pull-left">
				<div class="btn-group">
				 <a type="button" style="width:70px;background:black;color:#FCF7E4;<?php echo $today_select;?>" onclick="loadToday()" class="ot-button btn btn-default"><span class="fa fa-clock-o"></span> TODAY</a>			 
				 <a type="button" style="width:70px;background:black;color:#FCF7E4;<?php echo $month_select;?>" onclick="loadRange()" class="ot-button btn btn-default"><span class="fa fa-calendar"></span> RANGE</a>			 
				 <a type="button" style="width:50px;background:black;color:#FCF7E4;<?php echo $all_select;?>" onclick="loadAll()" class="ot-button btn btn-default"><span class="fa fa-history"></span> ALL</a>
				</div>
			</div>
			<div class="pull-right">		
				<a class = 'btn btn-default ot-button <?php echo $hide;?>' onclick="openAddDates()" type="button"><span class = "fa fa-plus-circle"></span> Add Dates</a>				
			</div>
			<div class="hidden-xs pull-left" style="margin-left:20px;margin-bottom:5px;">
			<form method="POST" name="range">
			<?php
			if ($filter == "RANGE")
				{
					echo '
					<label style="background:black;color:#FCF7E4;font-size:12px;font-family:oswald;">From</label>
					<input class="time-button" type="date" onchange="setFirstDate()" id="firstdate" name="first" value="'.$firstday.'"></input>
					<label style="background:black;color:#FCF7E4;font-size:12px;font-family:oswald;">To</label>
					<input class="time-button" type="date" onchange="setLastDate()" id="lastdate" name="last" value="'.$lastday.'"></input>
					';
				?>
				<?php
				}
			else
				{
					echo "";
				}
			?>				
			</form>
			</div>			
		</div>		
	<div class="nav ot-navbar visible-xs">
		<div id="controlPanel-xs" class="nav ot-navbar" style="background:black; display:none; color:#FCF7E4; padding:5px;opacity: 0.88; font-family:oswald; font-size:14px;">
			<div class="pull-left">
				<div class="btn-group">
				 <a type="button" style="width:70px;background:black;color:#FCF7E4;<?php echo $today_select;?>" onclick="loadToday()" class="ot-button btn btn-default"><span class="fa fa-clock-o"></span> TODAY</a>			 
				 <a type="button" style="width:70px;background:black;color:#FCF7E4;<?php echo $month_select;?>" onclick="loadRange()" class="ot-button btn btn-default"><span class="fa fa-calendar"></span> RANGE</a>			 
				 <a type="button" style="width:50px;background:black;color:#FCF7E4;<?php echo $all_select;?>" onclick="loadAll()" class="ot-button btn btn-default"><span class="fa fa-history"></span> ALL</a>
				</div>
			</div>
			<div style="position:relative">			
				<a style="position:absolute;right:5px" class = 'btn btn-default ot-button <?php echo $hide;?>' onclick="openAddDates()" type="button"><span class = "fa fa-plus-circle"></span> Add Dates</a>				
			</div>
			<div class="pull-left" style="margin-left:5px;margin-top:10px;margin-bottom:8px">	
			<form>
			<?php
			if ($filter == "RANGE")
				{
					echo '
					<label style="background:black;color:#FCF7E4;font-size:10px;">From</label>
					<input class="time-button" id="firstdatexs" onchange="setFirstDatexs()" type="date" name="firstdatexs" value="'.$firstday.'"></input>
					<label style="background:black;color:#FCF7E4;font-size:10px;">To</label>
					<input class="time-button" id="lastdatexs" onchange="setLastDatexs()" type="date" name="lastdatexs" value="'.$lastday.'"></input>
					';
				}
			else
				{
					echo "";
				}
			?>
			
			</form>
			</div>
		</div>
	</div>	
	<script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/add_show.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/dates/dates.php" );
            }
          });

        });

      });
    </script>

<?php
$show_query = mysqli_query($con,$query);
while ($row = mysqli_fetch_assoc($show_query))	
		{
			$tour = $row['show_tour'];
			$dayshowtype = $row['show_type'];
			$daystatustype = $row['show_status'];
			$daycontact = $row['show_contact'];
			$daycontactphone = $row['show_contact_phone'];
			$daycontactemail = $row['show_contact_email'];
			$showdate = $row['show_date'];
			$showid = $row['show_id'];
			$daydatetime = strtoupper(date("M . d . Y", strtotime($row['show_date'])));
					switch ($row['show_type'])
					{							
						case 'TBA':						
						$venue = "TBA";
						$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
						$type = "<span class='fa fa-flag'></span>";
						$showVenue = $venue;
						$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
						$location = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];
						break;	
						
						case 'Promote':
						$venue = stripslashes($row['show_venue']);
						$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
						$type = "<span class='fa fa-calendar'></span>";
						$showVenue = $venue . " " .$type;
						$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
						$location = $venue . " ". $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];
						break;	
						
						case 'Record':
						$venue = stripslashes($row['show_venue']);
						$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
						$type = "<span class='fa fa-microphone'></span>";
						$showVenue = $venue . " " .$type;
						$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
						$location = $venue . " ". $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];						
						break;
						
						case 'Perform':						
						if ($row['show_venue'] == $row['venue_city'])
							{
								$type = "TBA";
							}
						elseif ($row['show_venue'] == $row['venue_country'])
							{
								$type = "TBA";
							}
						else
							{
								"<div class='hidden-xs'>" . $type = "<span class='fa fa-microphone'></span></div>";
								"<div class='visible-xs'>" . $type = $row['show_venue'] . "</div>";
							}	
							
						$venue = stripslashes($row['show_venue']);
						$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
							
						if (($row['show_venue'] == NULL) !== false)
							{							
								if ($row['venue_country'])
									{
										$venueLoc = $row['venue_country'];
									}
								else
									{
										$venueLoc = "TBA"; 
									}								
								$showVenueDisplay = $showVenue;	
							}
						else
							{
								if ($row['venue_country'] == NULL)
									{
										$venueLoc = $venue;
										$showVenue = "TBA";
									}
								elseif ($row['venue_city'] == NULL)
									{
										$venueLoc = $venue;
										$showVenue = "TBA";
									}
								else
									{
										$showVenue = $venue;
										$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
									}									
	//combining route and street address
							}
							
							if ($row['venue_address']){
							$location = $venue . " ". $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " .$row['venue_state'] . " " . $row['venue_zipcode'];
							}
							else{
							$location = $row['show_location'];							
							}

							break;	
							
						case 'Off':
							$type = "<span class='glyphicon glyphicon-glass'</span>";
							$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
							$showVenue = "Off Day" . " " . $type;
							$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
							$location = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];							
							break;	
							
						case 'Travel':
						
							if (stripos($r->show_venue, "airport") !==false)
								{
								  $type = "<span class='fa fa-plane'></span>";
								  $venue = $row['show_venue'] . " " . $type;
								  $show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
								}
							else
								{
								  $type = "<span class='fa fa-road'></span>";
								  $venue = "TRAVEL DAY" . " " . $type;
								  $show_address = "";
								}	
								
							$showVenue = $venue;
							$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
							$location = $row['show_venue'] . " " . $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];		
							break;
							
						case 'Rehearse':
							$type = "<span class='fa fa-clock-o'></span>";
							$showVenue = "Practice Spot" . " " .$type;
							$show_address = $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_zipcode'];
							$venueLoc = $row['venue_city'] . " " . $row['venue_state'];
							$location = $row['show_venue'] . " " . $row['venue_address'] . " " . $row['venue_route'] . " " . $row['venue_city'] . " " . $row['venue_state'] . " " . $row['venue_zipcode'];
							break;
							
							default:
							$type = " ";
							break;	
					}					
					switch ($row['show_status']) 
					{
						case 'Confirmed':
							$status = "<div class ='label ot-show-confirmed'> " . " " . "<span class='glyphicon glyphicon-ok-sign'</span></div>";
							break;
						case 'Pending':
							$status = "<div class ='label ot-show-pending'> " . " " . "<span class='glyphicon glyphicon-question-sign'</span></div>";
							break;			
						case 'Cancelled':
							$status = "<div class ='label ot-show-cancelled'> " . " " . "<span class='glyphicon glyphicon-remove-circle'</span></div>";
							break;							
							default:
							$status = " ";               
					}					
							$venueSta = $status;
							$showVenueDisplay = $showVenue;	
							$SID = $showid;
			?>			
	<div>	
		<div class="venue-details" style="min-height:135px;">
				<div class="col-xs-3">
					<div class='dropdown'>	
					
							<button data-toggle='dropdown' name="<?php echo $showid;?>" onclick="setCookie('clickID', this.name, 365)" href='#' class ='btn-danger ot-multi' style=' width:40px; height:40px; border-radius:20px;padding:5px;margin-top:31px;'><span class='fa fa-ellipsis-h'></span></button>
								
							
							<ul class="dropdown-menu" role="menu" style="width:280px;margin-bottom:10px; height:20px;border-radius:4px; border-width:0px; background:none;">
																
							<div class='dropdown-menu btn-group' style='border-width:0px; border-radius:4px;background: rgba(0, 0, 0, 0.96);'>
												
							<a type="button" style="width:64px;height:64px;border-radius:32px; margin-left:5px;margin-right:5px;padding:20px;" href="http://maps.apple.com/?q=<?php echo $location; ?>" class="btn btn-success ot-show-group"><span class='fa fa-map-marker'></span></a>
																					
							<a type="button" style="width:64px;height:64px;margin-right:5px; border-radius:32px;padding:20px;" name="<?php echo $showid;?>" onclick="$(document.getElementById(this.name)).show('slide', { direction: 'left' }, 200);" class="<?php echo $hide;?> btn btn-danger ot-show-group"><span class="fa fa-trash-o"></span></a>
																								
							</div>
							</ul>
					</div>									
				</div>				
				<div class="venue-details" id="<?php echo $showid;?>" style="position:absolute;margin-top:20px;display:none;z-index:15;border-radius:4px;">
					<form id="addDatesForm" action="/">
					<div>
						<a class = "btn btn-info ot-button" name="<?php echo $showid;?>" onclick="$(document.getElementById(this.name)).hide('slide', { direction: 'left' }, 200);" style="margin-left:15px;">Cancel</a>
						<a class = "btn btn-danger ot-button" style="margin-right:15px;" type="button" onclick=
						"deleteShow()" data-dismiss='modal'><span class = "fa fa-trash-o"></span> DELETE?</a>		
					</div>
					</form>	
				</div>

		
				<div class='col-xs-9' style="font-family:oswald; opacity:0.89; padding: 10px;">
					<div class="row">
						<div class="col-sm-5">
							<div>
								<div style="font-size: 24px;">
									<?php echo strtoupper(date("M . d", strtotime($row['show_date'])));?>
									<a class="visible-xs pull-right button btn" style="color:#FFFFEB;background: black; margin-top:7px; font-size: 12px; border-style:solid;border-color:#FFFFEB; border-width:1px;padding-left:7px; padding-right:7px; border-radius:2px; opacity:0.85;box-shadow: 5px 5px 5px #323333;" type="button" onclick="setCookie('daysheetID', this.name, 365);daySheet();" id="daysheet-xs" name="<?php echo $showid;?>"><span class='fa fa-clock-o'></span> DAY SHEET</a>
								<br>
								</div>
								<div style="font-size:18px;">
									<?php echo $venueLoc."</br>";?>
								</div>
								<div style="font-size:12px;">
									<?php echo $showVenueDisplay . " " . $status;?>
								</div>
							</div>
						</div>
						<div class="col-sm-7">												
<!-- THE BUTTONS -->	
						<div class="hidden-xs" style="margin-top:10px;font-family:oswald;">				
<!--DAY SHEET-->			<div style="color:#FFFFEB; opacity:0.95;font-size:12px;">
								<a class="btn button" data-rel="back" data-ajax="false" style="color:#FFFFEB;background: black; border-style:solid;border-color:#FFFFEB; border-width:1px;box-shadow: 5px 5px 5px #323333;padding-left:7px;padding-right:7px; border-radius:2px;opacity:0.85;" type="button" onclick="setCookie('daysheetID', this.name, 365); daySheet();" name="<?php echo $showid;?>"><span class='fa fa-clock-o'></span> DAY SHEET</a>
							</div>			
						</div>	
						</div>
					</div>
				</div>
		</div>
	</div>
<?php
if ($_SESSION['filter'] == "TODAY")
	{
?>	<div>
		<div class="day-details container">
			<div class="row" style="margin-top:10px;margin-bottom:10px;">
				<div class="col-sm-7">
					<div class="row">
						<div class='col-sm-5' style="margin-bottom:10px;">
							<?php echo $tour; ?>
						</div>
						<div class='col-sm-7'>
							<div class="row">
								<div class="col-sm-12" style="margin-bottom:10px;">
								<span class="fa fa-user"></span> MAIN CONTACT: <?php echo $daycontact;?>
								</div>
								<div class='col-sm-12' style='margin-bottom:10px;'>
								<div>
									<div class="btn-group">
						
									<a type="button" href="mailto:
									<?php 
												
									echo $daycontactemail;
													
									?>?Subject=<?php echo $thename . " - " . $venue  ." - " . $daydatetime;?>&body=Hi," class="btn btn-danger" style="width:64px;height:64px;border-radius:32px; font-family:Oswald; margin-right:10px;padding:20px;"><span class="fa fa-envelope"></span></a>
																
									<a class="btn btn-primary ot-show-group" style="color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;" href="sms:<?php echo $daycontactphone; ?>"><span class="fa fa-comment"></span></a>
																
									<a class="btn btn-success ot-show-group" style="color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;" href='tel:<?php echo $daycontactphone; ?>'><span class="fa fa-phone"></span></a>
									</div>	
								</div>
								</div>			
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="row">
						<div class="col-xs-12" style="margin-bottom:10px;">
							<span class="fa fa-clock-o"></span> TIMES
						</div>		
<?php 
						$event_query2 = mysqli_query($con,$events);	
						while ($row = mysqli_fetch_assoc($event_query2))
								{
									$time = date("g:i", strtotime($row['event_time']));
									$time2 = date("A", strtotime($row['event_time']));
									$theicontype = $row['event_type'];
									
									echo "<div class='col-xs-2'>".$time . "</div><div class='col-xs-2'>" . $time2 . "</div><div class='col-xs-2'>"; item_icon($theicontype); echo "</div><div class='col-xs-6'>" .ucfirst($row['event_type'])."</div>";
								}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}

	?>
	<?php	
		}													

	}	
else 
	{
	
	
	
		$isShow = "SELECT show_date FROM show_config WHERE parent = '$sun' AND member = '$user' AND show_date >= '$today' ORDER BY show_date";
		$isShowQuery = mysqli_query($con,$isShow);
		while ($row=mysqli_fetch_array($isShowQuery))
			{
				$yesShow = $row['show_date'];
			}
		
			
				
	if ($yesShow == NULL)
		{

			echo "<div class='jumbotron ot-label venue-details'><h3>Hey " . $first . ", " . "it looks like you haven't been added to the day roster of any " .$thename. " dates. Once you've been added, they will show up on this page.</h3>";
			?>
			</div>
			<?php
		}
	else
		{
			switch($filter)
				{				
					case "TODAY":
					$today_select = "background:#CC3300;";
					break;
					
					case "ALL":
					$all_select = "background:#CC3300;";
					break;
					
					case "RANGE":
					$month_select = "background:#CC3300;";
					break;
					
					default:
					break;					
				}
		?>	
		<div class="nav ot-navbar" style="background:black; color:#FCF7E4; padding:5px;opacity: 0.88; font-family:oswald; font-size:14px;">
			<div class="btn-group pull-left">
			 <a type="button" style="color:#FCF7E4;<?php echo $today_select;?>" href="#" onclick="loadToday()" class="ot-button btn btn-default"><span class="fa fa-clock-o"></span> TODAY</a>
			 		 
			 <a type="button" style="color:#FCF7E4;<?php echo $all_select;?>" href="#" onclick="loadAll()"class="ot-button btn btn-default"><span class="fa fa-history"></span> ALL</a>
			</div>
			<div class="hidden-xs pull-left" style="margin-left:20px;margin-bottom:5px;">

			</div>
			
		</div>
		
		<?php	
			$band_dates = mysqli_query($con,"SELECT show_date FROM show_config WHERE parent = '$sun' AND member = '$user' AND show_date >= '$today'");
			while($row=mysqli_fetch_array($band_dates))
			{			
			switch($filter)
				{			
					case "TODAY":
					$query = $handler->query("SELECT * FROM shows WHERE 
					session_username='$sun' AND show_date = '$today' LIMIT 1");					
					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username='$sun'AND event_date = '$today' ORDER BY event_time");
					$today_select = "background:#CC3300;";
					break;
					
					case "RANGE":
					$query = $handler->query("SELECT * FROM shows WHERE session_username='$sun' AND show_date >= '$firstday' AND show_date <= '$lastday' ORDER BY show_date");
					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username = '$sun' ORDER BY event_time");
					$month_select = "background:#CC3300;";
					break;
					
					case "ALL":
					$query = $handler->query("SELECT * FROM shows WHERE 
					session_username='$sun' AND show_date >= '$today' ORDER by show_date LIMIT 45");					
					$events = ("SELECT id as event_id, event_type, event_date, event_time FROM events WHERE session_username = '$sun' ORDER BY event_time");
					$all_select = "background:#CC3300;";
					break;
					
					default:
					break;				
				}				
				$showup = $row['show_date'];
				$query->setFetchMode(PDO::FETCH_CLASS, 'Show');
				while($r = $query->fetch())
				if ($r->show_date == $showup)	
				{
					$showdate = $r->show_date;
					$tour = $r->show_tour;
					$dayshowtype = $r->show_type;
					$daystatustype = $r->show_status;
					$daycontact = $r->show_contact;
					$daycontactphone = $r->show_contact_phone;
					$daycontactemail = $r->show_contact_email;
					$showdate = $r->show_date;
					$showid = $r->show_id;
					$daydatetime = strtoupper(date("M . d . Y", strtotime($r->show_date)));
				
					switch ($r->show_status) 
					{
						case 'Confirmed':
							$status = "<div class ='label ot-show-confirmed'><span class='fa fa-check-circle'</span></div>";
							break;
						case 'Pending':
							$status = "<div class ='label ot-show-pending'><span class='fa fa-question-circle'</span></div>";
							break;			
						case 'Cancelled':
							$status = "<div class ='label ot-show-cancelled'><span class='fa fa-times-circle'</span></div>";
							break;							
							default:
							$status = " "; 		
					}
					
					switch ($r->show_type)
					{						
						case 'TBA':
						
						$venue = "TBA";
						$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
						$type = "<span class='fa fa-flag'></span>";
						$showVenue = $venue;
						$venueLoc = $r->venue_city . " " . $r->venue_state;
						$location = $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;
						break;
							
						case 'Promote':
						$venue = $r->show_venue;
						$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
						$type = "<span class='fa fa-calendar'></span>";
						$showVenue = $venue . " " .$type;
						$venueLoc = $r->venue_city . " " . $r->venue_state;
						$location = $venue . " ". $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;
						break;
						
						case 'Record':
						$venue = $r->show_venue;
						$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
						$type = "<span class='fa fa-microphone'></span>";
						$showVenue = $venue . " " .$type;
						$venueLoc = $r->venue_city . " " . $r->venue_state;
						$location = $venue . " ". $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;						
						break;
						
						case 'Perform':						
						if ($r->show_venue === $r->venue_city)
							{
								$type = "TBA";
							}
						elseif ($r->show_venue === $r->venue_country)
							{
								$type = "TBA";
							}
						else
							{
								"<div class='hidden-xs'>" . $type = "<span class='fa fa-microphone'></span></div>";
								"<div class='visible-xs'>" . $type = $r->show_venue . "</div>";
							}							
							$venue = $r->show_venue;
							$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
							
						if (($r->show_venue === NULL) !== false)
							{							
								if ($r->venue_country)
									{
										$venueLoc = $r->venue_country;
									}
								else
									{
										$venueLoc = "TBA"; 
									}
									
								$showVenueDisplay = $showVenue;									
							}
						else
							{
									if ($r->venue_country == NULL)
										{
											$venueLoc = $venue;
											$showVenue = "TBA";
										}
									elseif ($r->venue_city == NULL)
										{
											$venueLoc = $venue;
											$showVenue = "TBA";
										}
									elseif ($r->venue_address == NULL)
										{
											$venueLoc = $venue;
											$showVenue = "TBA";
										}
									else
										{
											$showVenue = $venue;
											$venueLoc = $r->venue_city . " " . $r->venue_state;
										}									
	//combining route and street address	
							}
							
							$location = $venue . " ". $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;							
							break;	
							
						case 'Off':
							$type = "<span class='glyphicon glyphicon-glass'</span>";
							$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
							$showVenue = "Off Day" . " " . $type;
							$venueLoc = $r->venue_city . " " . $r->venue_state;
							$location = $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;							
							break;	
							
						case 'Travel':
						
							if (stripos($r->show_venue, "airport") !==false)
								{
								  $type = "<span class='fa fa-plane'></span>";
								  $venue = $r->show_venue . " " . $type;
								  $show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
								}
							else
								{
								  $type = "<span class='fa fa-road'></span>";
								  $venue = "TRAVEL DAY" . " " . $type;
								  $show_address = "";
								}	
								
							$showVenue = $venue;
							$venueLoc = $r->venue_city . " " . $r->venue_state;
							$location = $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;								
							break;
							
						case 'Rehearse':
							$type = "<span class='fa fa-clock-o'></span>";
							$showVenue = "Practice Spot" . " " .$type;
							$show_address = $r->venue_address . " " . $r->venue_route . " " . $r->venue_zipcode;
							$venueLoc = $r->venue_city . " " . $r->venue_state;
							$location = $r->venue_address . " " . $r->venue_route . " " . $r->venue_city . " " . $r->venue_state . " " . $r->venue_zipcode;
							break;
							
							default:
							$type = " ";
							break;	
					}				
					$venueSta = $status;
					$showVenueDisplay = $showVenue;																				
					?>
	<div>
		<div class="venue-details" style="height:120px;">
			<div class='col-xs-3'>						
					<a type="button" style="width:50px;height:50px;border-radius:25px; padding:14px;margin-top:30px; margin-left:10px;margin-right:20px;" href="http://maps.apple.com/?q=<?php echo $location; ?>" class="btn btn-success ot-show-group"><span class='fa fa-map-marker'></span></a>										
			</div>
			<div class='col-xs-9' style="font-size: 24px; font-family:oswald; opacity:0.89; padding: 15px;">
				<div class="row">
					<div class="col-sm-5">
								<div>
								<div style="font-size: 24px;">
									<?php echo strtoupper(date("M . d", strtotime($row['show_date'])));?>
									<a class="visible-xs pull-right" style="color:#FFFFEB;background: black; margin-top:7px; font-size: 12px; border-style:solid;border-color:#FFFFEB; border-width:1px;padding-left:7px; padding-right:7px; border-radius:2px; opacity:0.85;" href="#daysheet" onclick="setCookie('daysheetID', this.name, 365);daySheet();" id="daysheet-xs" name="<?php echo $r->id;?>"><span class='fa fa-clock-o'></span> DAY SHEET</a>
								<br>
								</div>
									<div style="font-size:18px;">
										<?php echo $venueLoc."</br>";?>
									</div>
									<div style="font-size:12px;">
										<?php echo $showVenueDisplay . " " . $status;?>
									</div>
								</div>

					</div>
					<div class="col-sm-7">										
	<!--DAY SHEET-->	<div class="hidden-xs" style="margin-top:10px;font-family:oswald;">				
							<div style="color:#FFFFEB; opacity:0.95;font-size:12px;">
							<a style="color:#FFFFEB;background:black; border-style:solid;border-color:#FFFFEB; border-width:1px;padding-left:7px;padding-right:7px;border-radius:2px;" onclick="setCookie('daysheetID', this.name, 365);daySheet();" name="<?php echo $r->id;?>" href="#"><span class="fa fa-clock-o"></span> DAY SHEET</a></div>																								
																		
						</div>
					</div>
				</div>
			</div>

		</div>		
	</div>
	<?php
	if ($_SESSION['filter'] == "TODAY")
		{
?>		
	<div>
		<div class="day-details container">
			<div class="row" style="margin-top:10px;margin-bottom:10px;">
				<div class="col-sm-7">
					<div class="row">
						<div class='col-sm-5' style="margin-bottom:10px;">
							<?php echo $tour; ?>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="row">
							<div class="col-xs-12" style="margin-bottom:10px;">
							<span class="fa fa-clock-o"></span> TIMES
							</div>		
<?php 
						$event_query2 = mysqli_query($con,$events);	
						while ($row = mysqli_fetch_assoc($event_query2))
								{
									$time = date("g:i", strtotime($row['event_time']));
									$time2 = date("A", strtotime($row['event_time']));
									$theicontype = $row['event_type'];
									
									echo "<div class='col-xs-2'>".$time . "</div><div class='col-xs-2'>" . $time2 . "</div><div class='col-xs-2'>"; item_icon($theicontype); echo "</div><div class='col-xs-6'>" .ucfirst($row['event_type'])."</div>";
								}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
		}
?>
<?php			
				}			
			}
		}
	}
?>		
	</div>
	</div>
</div>
<script>
	(function()
	{
		var elem = document.createElement('input');
		elem.setAttribute('type', 'date');		
		if ( elem.type === 'text' )
			{
				$('#date').datepicker
				(		
					{
						dateFormat: 'yy-mm-dd'
					}
				);	
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
				$('#firstdate').datepicker
				(		
					{
						dateFormat: 'yy-mm-dd'
					}
				);	
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
				$('#lastdate').datepicker
				(		
					{
						dateFormat: 'yy-mm-dd'
					}
				);	
			}
	})();		
</script>
