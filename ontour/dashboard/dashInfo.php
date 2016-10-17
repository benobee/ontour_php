<?php ob_start(); ?>
<?php session_start();?>
<?php include_once("ontour/home/analyticstracking.php") ?>
<?php

include_once "dbconnect.php";
include_once "handler.php";
include_once "classes.php";

$_SESSION['admin'] = NULL;
$_SESSION['filter'] = "ALL";
$_SESSION['rangefirst'] = NULL;
$_SESSION['rangelast'] = NULL;
setcookie("firstdate", "", time()-3600);
setcookie("lastdate", "", time()-3600);
$_SESSION['personid'] = $id;
$_SESSION['timezone'] = $_COOKIE["timezone"];
$_SESSION['day'] = $_COOKIE["day"];	

$day = $_SESSION['day'];
$timezone = $_SESSION['timezone'];		
date_default_timezone_set($timezone);

$today = date("Y-m-d");
$_SESSION['today'] = $today;		

if ($_SESSION['username']){		
$sun = strtolower($_SESSION['username']);
$_SESSION['username'] = $sun;
}

$monthyear = date("Y-m");
$_SESSION['monthyear'] = $monthyear;

$userinfo = mysqli_query($con,"SELECT * FROM users WHERE username = '$sun'");
while($row = mysqli_fetch_assoc($userinfo))
	{
		$first = $row['first_name'];
		$last = $row['last_name'];
		$business = $row['business_name'];
		$id = $row['id'];
		$phone = $row['phone'];
	}

$_SESSION['nameid'] = $id;
$_SESSION['first_name'] = $first;
$_SESSION['last_name'] = $last;
$_SESSION['biz_name'] = $business;
$_SESSION['phone'] = $phone;
							
?>
	<style>
		.toggle{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.81;
		margin-top:10px;
		}
		.art-img {
		background-position:70% 30%;
		background-repeat:no-repeat;
		height:100%;
		background-size:cover;
		}		
		#fans li {
		display: inline-block;
		list-style-type: none;
		margin-top:10px;
		margin-right:5px;
		height:50px;
		width:50px;
		border-radius:25px;
		padding:20px;
		}
		#info li {
		display: inline-block;
		list-style-type: none;
		padding-right:10px;
		}
		#last_fm_tags li {
		display: inline-block;
		list-style-type: none;
		padding-right:5px;
		padding-left:5px;
		border-radius:4px;
		background:#707070;
		margin-right:2px;
		}
		.meter{
		width:100px;
		height:100px;
		border-radius:50px;
		background: red;
		}
		.records {
		background:  url("img/records.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
		p.tour{
		word-wrap:break-word;
		}

</style>

<script src="js/jquery.circliful.min.js"></script>
    <script>
      $(function () {

        $('#addArtistForm').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dashboard/add_artist.php',
            data: $('#addArtistForm').serialize(),
            success: function () {
              $( "#dash" ).load( "ontour/dashboard/dashInfo.php" );
			  
            }
          });

        });

      });
    </script>
<script>
$(function() {
    $("#artist_name" ).autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: "http://developer.echonest.com/api/v4/artist/suggest",
                dataType: "jsonp",
                data: {
                    results: 12,
                    api_key: "UJPOPHKAGZ3QX5IXP",
                    format:"jsonp",
                    name:request.term
                },
                success: function( data ) {
                    response( $.map( data.response.artists, function(item) {
                        return {
                            label: item.name,
                            value: item.name,
                            id: item.id
                        }
                    }));
                }
            });
        },
        minLength: 3,
        select: function( event, ui ) {
            $("#search").empty();
            $("#search").append(ui.item ? ui.item.id + ' ' + ui.item.label : '(nothing)');
			
			var artist = document.getElementById("artist_id");
			artist.setAttribute('value',ui.item.id);
        },
    });
});
</script>
<script>

jQuery.ajaxSetup({
  beforeSend: function() {
     NProgress.start();
  },
  complete: function(){
     NProgress.done();
  },
  success: function() {}
});

NProgress.start();
setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>

<div id="shows">
<div class="container">
	<div class="row">
		<div class="records col-xs-12" style="box-shadow: 2px 0px 25px #323333;">
			<div class = "navbar-brand-ot" style="margin-top:8px;">
				<img style="border-radius:25px;margin-bottom:5px;" src = "img/van.png" width="50px" height="50px"></img>
			</div>
			<div class = "pull-right" style="margin-top:8px;margin-bottom:15px;">
				<div class ="artist-name venue-details" style="border-radius:4px;font-size:9px;margin-top:8px"><?php echo $sun;?></div>
			</div>
		</div>
		<div class="col-xs-12 visible-xs" id="dashHead-xs" style="background:black;height:55px">
			<a type="button" style="background:#212121;width:44px; height:44px;margin-top:5px;padding:12px;border-radius:22px;" onclick="dashPanel()" href="#" class="button ot-button pull-right"><span class="fa fa-bars"></span></a>	
		</div>
		<div class="col-xs-12 hidden-xs" id="dash_head" style="background:black;padding-top:15px;padding-bottom:15px;box-shadow: 2px 0px 25px #323333;">
			<a class="btn btn-default button ot-button pull-right" onclick="loadUserSettings()" style="margin-right:10px;box-shadow: 2px 1px 2px 0px #323333" type="button"><span class ='fa fa-gear'></span> Settings</a>
			<a class="btn btn-default button ot-button pull-left" onclick="addArtist()" style="box-shadow: 2px 1px 2px 0px #323333;width:90px;"><span class ='fa fa-plus-circle'></span> Add Artist</a>	
		</div>
		<div class="col-xs-12" id="dashPanel" style="display:none;background:black;padding-top:15px;padding-bottom:15px">
		
			<a class="btn btn-default button ot-button pull-right" onclick="loadUserSettings()" style="margin-right:10px;box-shadow: 2px 1px 2px 0px #323333" type="button"><span class ='fa fa-gear'></span> Settings</a>
			<a class="btn btn-default button ot-button pull-left" onclick="addArtist()" style="box-shadow: 2px 1px 2px 0px #323333;width:90px;"><span class ='fa fa-plus-circle'></span> Add Artist</a>	
		</div>
	</div>
</div>
	
<div class="container">
	<div id="userSettings" style="display:none;">
		<div class="row">
			<div id="userSettingsUpdate" class="col-sm-6">
			<?php include "ontour/dashboard/user_settings.php";?>
			</div>
			<div class="col-sm-6">
				<div class="col-sm-12 venue-details" style="margin-top:15px;margin-bottom:15px;border-radius:4px;box-shadow: 2px 0px 25px #323333;">
				<button class="btn btn-default ot-button button" onclick="logOut()" style="box-shadow: 2px 1px 2px 0px #323333;" type="button"><span class ='fa fa-sign-out'></span> Logout</button>	
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="border-radius:4px;box-shadow: 2px 0px 25px #323333;">
		<div class="col-sm-6">
			<div id = "addArtist" style="display:none;margin-top:20px;" style ="border-radius:8px; border-width:4px; background:black; border-color:#FCF7E4; width:280px;height:150px;">
				<form id="addArtistForm">
				<input type="hidden" class="ot-standout" id="session_username" name="session_username"value = "<?php echo $sun; ?>"></input>
				<input type="hidden" class="ot-standout" id="userid" name="userid" value = "<?php echo $id; ?>"></input>			
					<div class = "row"> 
						<div class ="col-sm-12" style="color:#FFFFEC;">
							<label for="artist_name"></label> 	
							Name
							<input type ="text" class="ot-standout" id="artist_name" placeholder="Search or enter artist name..." name="artist_name" required></input>
							<input type ="text" style="display:none" class="ot-standout" id="artist_id" name="artist_id">
						</div>						
					</div>
					<div style="display:none" id="search" class="venue-details"></div>
					<br>
					<div class = "navbar">						
						<a class = "btn btn-default pull-left ot-button" style="border-width:0px" onclick="closeAddArtist()">close</a>
						
						<button type="submit" class = "btn btn-success pull-right btn-lg ot-button"><span class = "fa fa-plus-circle"></span> Add</button>					
					</div>					
				</form>							
			</div>
		</div>
	</div>		
</div>
	
<div id="artists" class ="container" style="border-radius:4px;box-shadow: 2px 0px 25px #323333;">
	<div class="row">
			<div style="color:black;font-size:14px;font-family:oswald;opacity:0.85;">	
				<?php				
				$isband = mysqli_query($con,"
					SELECT
					bands.id as theband, 
					bands.member, 
					band_names.name, 
					band_names.id as thename
					
					FROM 
					bands, 
					band_names
					
					WHERE 
					band_names.id = bands.band_id
					AND
					bands.member = '$sun'");
					
					while($row = mysqli_fetch_assoc($isband)){
						$isthere = $row['member'];
					}
					
					if ($isthere == NULL){
					echo "<div style='color:#FCF7E4;font-size:16px'>Add one or multiple artists to start managing accounts. If someone has added you to their artist roster, the artist name will show up here automatically.</div>";				
					}
					
					else{					
					echo "<h6 class='hidden' style='color:#FCF7E4;margin-bottom:20px;font-family:Raleway'>Artist Roster Selection</h6>";
					?>
					<h6 class="hidden" id="bizName" style="margin-top:13px;color: #FCF7E4;"><?php echo stripslashes($_SESSION['biz_name']);?></h6>
					<?php
					$userbands = mysqli_query($con,"
					SELECT
					bands.id as theband, 
					bands.member,
					band_names.artist_id as artist_id,
					band_names.name, 
					band_names.id as thename,
					band_names.image as url,
					band_names.famous as famous,
					band_names.buzz as buzz
					
					FROM 
					bands, 
					band_names
					
					WHERE 
					band_names.id = bands.band_id");
					
					while($row = mysqli_fetch_assoc($userbands))
						{
							if ($sun == $row['member'])
								{
								$row['member'];
								?>																	
									<?php							
										$artist_name = stripslashes($row["name"]);
										$searchArtist = urlencode($searchArtist);
										$url = $row['url'];
										$famous = $row['famous'];
										$buzz = $row['buzz'];
										$dbid = $row['thename'];
										
										if ($row['artist_id']){
											$artist_id = $row['artist_id'];
										}
										else{
											$artist_id = $dbid;
										}
									?>
				<div class="col-sm-6" style="background:black;padding:0px">
									<script>
									document.getElementById('page_message<?php echo $artist_id;?>').innerHTML = '<span style="position:absolute;top:50%;left:40%"><h6>Getting artist information...</h6><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img></span>';
									</script>
									
										<?php
							
											if ($row['artist_id'] == NULL){
													$image = "img/drive.jpg";?>
													<script>
													document.getElementById('page_message<?php echo $artist_id;?>').innerHTML = '';
													var image = document.getElementById('image<?php echo $artist_id;?>');
													image.setAttribute('style','box-shadow: inset 10px 10px 150px 38px rgba(0, 0, 0, 0.8);height:100%;background-image: url("<?php echo $image;?>")');
													
													</script>
													<?php
											}
											
											else{									
												if ($url == NULL){
													include "ontour/dashboard/artist_info.php";
												}
												else {
													include "ontour/dashboard/artist_stored_info.php";
													
													?>
													
													<script>
													var image = document.getElementById('image<?php echo $artist_id;?>');
													image.setAttribute('style','box-shadow: inset 10px 10px 150px 38px rgba(0, 0, 0, 0.8);height:100%;background-image: url("<?php echo $url;?>")');
													</script>
													<?php
												}
											}
										?>
										
					<div id="window<?php echo $dbid;?>" style="color:#FCF7E4">
						<div name="<?php echo $dbid;?>" style="height:200px;display:none; position:absolute; background:black;z-index:99;width:100%" id="artistSettings<?php echo $dbid;?>">
						
									<form id="artistForm" action="/">
										<div id="artistinfo" class="<?php echo $hide;?>">							
											<div id ="artistTrash<?php echo $dbid;?>" class="venue-details" style="display:none;z-index:15;padding:10px;position:absolute;width:100%;height:100%">
												<div style="border-radius:8px;">
											
													<div class ="navbar">
														<div class = "navbar-text"><h5 style="color:white;"><span class = "fa fa-exclamation-triangle"></span> DELETE ARTIST?</h5></div>
													</div>
											
														<div class = "navbar">
															<a class = "btn btn-info ot-button pull-left" name="artistTrash<?php echo $dbid;?>" onclick="artistTrash(this.name)" style="width:60px" id="artistTrashCancel">Cancel</a>
															<button type="button" onclick="deleteArtist(<?php echo $dbid;?>)" class = "btn btn-danger ot-button" style="margin-left:20px"><span class = "fa fa-trash-o"></span> DELETE</button>		
														</div>
																	
												</div>	
											</div>
											<div id="delete_functions" style="margin-left:10px;margin-right:10px;">
												<div class="nav navbar">
												
												<button name="artistSettings<?php echo $dbid;?>" class="btn btn-default ot-show-group navbar-btn" type="button" style="border-width:1px;border-style:solid" onclick="settings(this.name)"> Close</button>
												
												<button type="button" onclick="updateArtist(<?php echo $dbid;?>)" class ="btn btn-success ot-show-group navbar-btn pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
												</div>
									
												<div id="artist_name">	 
													<div class="form-group">
														<div class="pull-left">
															<label> Artist Name</label>
														</div>	
														<input id="name<?php echo $dbid;?>" type="text" style="font-size:18px;font-family:oswald;" class="ot-standout" value="<?php echo $artist_name; ?>" name="artist_name"></input>
													</div>
												</div>
												
												<a type="button" name="artistTrash<?php echo $dbid;?>" onclick="artistTrash(this.name)" id="artistTrashButton" class ="btn btn-danger ot-show-group pull-left"><span class= "fa fa-trash-o"></span></a>
											</div>						
										</div>
									</form>	
									
							<div id ="leaveLineup" style="display:none">
								<div style="border-radius:8px;">
									<div class="venue-details" style="border-radius:4px;">
										<form id="leave" action="/">
										<div class = "navbar">
											<a class = "btn btn-info ot-button pull-left" id="artistTrashCancel" style="margin-left:15px;">Cancel</a>
											<a class = "btn btn-danger ot-button pull-right" style="margin-right:15px;width:120px" type="button" onclick=
											"leaveArtist()" data-dismiss='modal'><span class = "fa fa-suitcase"></span> LEAVE LINEUP?</a>		
										</div>
										</form>
									</div>			
								</div>	
							</div>									
						</div>										
							<div id="artistMain<?php echo $dbid;?>" style="height:200px">

												<div class="art-img" id="image<?php echo $artist_id;?>">
												
													<div id="page_message<?php echo $artist_id;?>"></div>													
														<div style="font-size:22px; font-family: raleway; position:absolute; left:10px;top:3px;margin-top:0px;padding:0px;width:72%" id="location<?php echo $artist_id;?>"><?php echo $artist_name;?></div>
														<div style="position:absolute;right:0px;bottom:-35px;margin-top:5px;padding:5px;" id="famous<?php echo $artist_id;?>"></div>
														<div style="position:absolute;right:60px;bottom:-35px;margin-top:5px;padding:5px;" id="mybuzz<?php echo $artist_id;?>"></div>
														
														<a id="gear" name="artistSettings<?php echo $dbid;?>" style="position:absolute;right:10px;top:3px;border-radius:20px;width:40px;height:40px;font-size:14px;color:#FCF7E4;border-style:solid; padding:5px;border-width:2px; border-color: #6E6E6E;opacity:0.6"
														
														onmouseover="this.setAttribute('style','position:absolute; right:10px;top:3px; border-radius:20px; width:40px; height:40px; font-size:14px; color:#EBFAFF; border-style:solid; padding:5px;border-width:2px; border-color: #47C8FF;opacity:0.9')"
														
														onmouseout="this.setAttribute('style','position:absolute; right:10px;top:3px; border-radius:20px; width:40px; height:40px; font-size:14px; color:#FCF7E4; border-style:solid; padding:5px;border-width:2px; border-color: #6E6E6E;opacity:0.6')"
														
														onclick="settings(this.name)" type="button" class="btn tour venue-details">
														
														<div style="position:relative;top:10%;"><span class="fa fa-gear"></span></div>
														</a>
													
														<a style="position:absolute;left:10px;bottom:3px;padding:10px;font-size:14px;color:#FCF7E4;border-style:solid; width:44px; border-width:2px; border-radius:22px; border-color: #EBFAFF;opacity:0.6" onclick="loadShows()" onmousedown="setCookie('artistInfo', this.name, 365)" name="<?php echo $row['theband'] ."*". urlencode($row["name"]) ."*". $row['thename'];?>" type="button" class="btn tour venue-details">
														<div style="position:relative;top:10%;"><span class="fa fa-calendar"></span></div>
														</a>
														
														
		
												</div>
							</div>											
					</div>
				</div>
					<?php	
								}
						}
					}
					?>
			</div>	
	<div class="col-md-6">
		<div>
		<?php		
		$isdates = mysqli_query($con,"
					SELECT
					show_config.member, 
					show_config.show_date as thedate,
					show_config.parent,
					band_names.id,
					band_names.name,
					shows.session_username
					
					FROM 
					show_config, band_names, shows
					
					WHERE
					show_config.parent = shows.session_username AND	
					show_config.show_date = shows.show_date AND
					show_config.member = '$sun' AND
					band_names.id = show_config.parent AND
					show_config.show_date >= '$today'
					
					ORDER BY
					show_config.show_date");
					
		while($row = mysqli_fetch_assoc($isdates))
					{
						$aretheredates = $row['thedate'];
					}
		if ($aretheredates !== NULL)
		{
		?>		
		<div class="venue-details" style="border-radius:4px;margin-top:15px;box-shadow: 2px 0px 25px #323333;display:none">			
		<h6 style="font-family:raleway;color:#FCF7E4">Upcoming Dates</h6>
		<table style="font-family:oswald; font-size:11px;">
		<tr>
		<th style="width:10%;padding-right:15px;"><h6>Date</h6></th>
		<th style="width:25%;"><h6>Artist</h6></th>
		<th style="width:40%;"><h6>Venue</h6></th>
		<th style="width:25%;"><h6>Location</h6></th>
		</tr>
		<?php
		$calendar = mysqli_query($con,"
					SELECT
					show_config.member, 
					show_config.show_date as thedate,
					show_config.parent,
					band_names.id,
					band_names.name,
					shows.show_venue,
					shows.session_username,
					shows.show_date,
					shows.venue_city,
					shows.venue_state
					
					FROM 
					show_config, band_names, shows
					
					WHERE
					show_config.parent = shows.session_username AND	
					show_config.show_date = shows.show_date AND
					show_config.member = '$sun' AND
					band_names.id = show_config.parent AND
					show_config.show_date >= '$today'
					
					ORDER BY
					show_config.show_date");
					while($row = mysqli_fetch_assoc($calendar))
					{
						echo "<tr>";
						echo "<td>" . date('M . d', strtotime($row['thedate'])) . "</td>";
						echo "<td>" . stripslashes($row['name']) . "</td>";
						echo "<td>" . $row['show_venue'] . "</td>";
						echo "<td>" . $row['venue_city'] . " " .$row['venue_state']."</td>";
						echo "</tr>";
					}
				?>
		</table>
		</div>
		<?php
		}
		?>	
	</div>
	</div>
	</div>
</div>
</div>
	
<script>
function deleteArtist(id){
document.getElementById('artistTrash'+id).innerHTML = '<span style="position:absolute;top:50%;left:40%"><h6>Deleting Artist...</h6><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img></span>';

          $.ajax({
            type: 'post',
            url: 'ontour/dates/confirmed_delete_artist.php',
            data: {
				nameid: id
			},
            success: function () {
              $( "#dash" ).load( "ontour/dashboard/dashInfo.php" );
            }
          });

}
function updateArtist(id){
var x = document.getElementById('name'+ id).value;
document.getElementById('artistSettings'+id).innerHTML = '<span style="position:absolute;top:50%;left:40%"><h6>Updating Artist...</h6><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img></span>';

          $.ajax({
            type: 'post',
            url: 'ontour/dates/update_artist.php',
            data: {
				nameid: id,
				artist_name: x
			},
            success: function () {
              $( "#dash" ).load( "ontour/dashboard/dashInfo.php" );
			  $('#artistSettings'+id).hide();
            }
          });

}
</script>
<script>
function settings(id) {
var y = document.getElementById(id);
$(y).toggle('slide',400);
}
</script>
<script>
function artistTrash(id) {
var y = document.getElementById(id);
$(y).toggle();
}
</script>
<script>
function logOut(){
document.cookie = "otid=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
document.cookie = "otdb=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
$( "#body" ).load( "ontour/home/homepage.php" );
}
function updateSettings() {
          $.ajax({
            type: 'post',
            url: 'ontour/dashboard/update_user.php',
            data: $('#userSettingsForm').serialize(),
            success: function () {
              $( "#userSettingsUpdate" ).load( "ontour/dashboard/user_settings.php" );
			  $("#bizName").load( "ontour/dashboard/businessName.php" );
            }
          });

        }
</script>	
<script>
function loadUserSettings(){
$( "#userSettings" ).show();
$( "#artists" ).hide();
$( "#dash_head" ).hide();
$( "#dashPanel" ).hide();
$( "#dashHead-xs" ).hide();
}
</script>
<script>
function closeUserSettings(){
$( "#userSettings" ).hide();
$( "#artists" ).show();
$( "#dash_head" ).show();
$( "#dashPanel" ).hide();
$( "#dashHead-xs" ).hide();
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var tz = jstz.determine(); // Determines the time zone of the browser client
    var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
    $.post("url-to-function-that-handles-time-zone", {tz: timezone}, function(data) {
       //Process the timezone in the controller function and get
       //the confirmation value here. On success, refresh the page.
     });	 	
	function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
	}
	user = timezone;
	setCookie("timezone", user, 365);
	var d = new Date();
	var n = d.getDate();
	setCookie("day", n, 365);
  }); 
</script>
<script type="text/javascript">
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}
</script>

	<script>	
	function leaveArtist(){

          $.ajax({
            type: 'get',
            url: 'ontour/dates/confirmed_leave.php',
            success: function () {
              $( "#dash" ).load( "ontour/dashboard/dashInfo.php" );
            }
          });
	}
	</script>