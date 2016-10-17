<?php session_start();?>
<?php

	include_once "dbconnect.php";
	include_once "handler.php";
	include_once "classes.php";
	include_once "functions.php";

$cookieData = $_COOKIE['artistInfo'];

list($cookieId, $cookieArtistName, $cookieBandId) = explode("*", $cookieData);	
		
				$_SESSION['thename'] = $cookieArtistName;				
				$_SESSION['nameid'] = $cookieBandId;
				$_SESSION['band_id'] = $cookieId;			
?>
<?php
$band_id = $cookieId;

$band_id = $_SESSION['band_id'];
$par_art = mysqli_query($con,"SELECT * FROM bands WHERE id = '$band_id'");
		
while($row = mysqli_fetch_assoc($par_art))
			{
				$parent_artist = $row['parent'];
				$memberofband = $row['member'];	
				$admin = $row['admin'];
			}

if ($admin == 1)
			{
				$hide = "";
				$admin = true;
			}			
		else 
			{
				$hide = "hidden";
				$admin = false;
			}
?>


<style>
		.floatingLayer{
		position:fixed;
		bottom:0px;
		width:100%;
		z-index:-20;
		}
		.backLayer{
		position:absolute;
		z-index:-30;
		width:100%;
		}
		.artist-img{
		background:  url("img/drive.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		height:60px;
		box-shadow: inset 5px 5px 15px 15px rgba(0, 0, 0, 0.6);
		}
		.paper {
		background: url("img/sheet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-attachment:center;
		background-size: cover;
		width: 100%;
		}
</style>
<!-- sec.header -->

<script>
      $(function () {

        $('#artistForm').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/update_artist.php',
            data: $('#artistForm').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "artist_settings.php" );
            }
          });

        });

      });
</script>

<?php

	$artist_name = $_SESSION['thename'];
							
?>

<div class = "container artist-img hidden-xs" style="padding-left:0px;padding-right:0px;">
	<div class = "navbar navbar-ot hidden-xs" style="margin-left:25px;">
	<div class="pull-right hidden-xs" style="background:black; margin-right:10px; padding:10px;font-family:raleway; color:#FCF7E4; margin-top:3px;border-radius:4px;font-size:10px"><?php echo $_SESSION['thename']; ?></div>

	<div class ="nav navbar-nav">
		<a class = 'btn btn-default navbar-btn ot-nav-button' type="btn button" onclick="dashboard()"><span class = "fa fa-dashboard"></span> Dashboard</a>
		<a class = 'btn btn-default navbar-btn ot-nav-button' type="btn button" onclick="dates()"><span class="fa fa-calendar"></span> Dates</a>
		<a class = 'btn btn-default navbar-btn ot-nav-button' type="btn button" onclick="map()" ><span class="fa fa-globe"></span> Map</a>
		<a class = 'btn btn-default navbar-btn ot-nav-button' type="btn button" onclick="whosin()"><span class="fa fa-user"></span> Who's In</a>
	
		<a class = 'btn btn-default navbar-btn ot-nav-button hidden' type="btn button" onclick="exportFile()"><span class="fa fa-cloud-download"></span> Export to File</a>						
	</div>
</div>
</div>
	
<div class="container visible-xs artist-img">
	<div style="position:absolute;right:0px;top:18px">
	
	</div>
	<div style="font-family:raleway;color:#FCF7E4;"><?php echo $_SESSION['thename']; ?></div>
	
</div>
<div class="floatingLayer visible-xs" style="background:black">
	<table id="bottomNav" class="ot-nav-table">
		<tr>
			<td class="ot-td" align="center" valign="middle">
				<a class = 'ot-nav-button-xs' type="button" onclick="dashboard()"><span class = "fa fa-dashboard"></span></a>
			</td>
			<td class="ot-td" align="center" valign="middle">
				<a class = 'ot-nav-button-xs' onclick="dates()" type="button" ><span class="fa fa-calendar"></span></a>
				
			</td>
			<td class="ot-td" align="center" valign="middle">
				<a class = 'ot-nav-button-xs' type="button" onclick="map()"><span class="fa fa-globe"></span></a>	
			</td>
			<td class="ot-td" align="center" valign="middle">
				<a class = 'ot-nav-button-xs' type="button" onclick="whosin()"><span class="fa fa-user"></span></a>
				
			</td>
			<td class="ot-td hidden" align="center" valign="middle">
				<a class = 'ot-nav-button-xs' type="button" onclick="artistSettings()"><span class="glyphicon glyphicon-stats"></span></a>
			</td>	
		</tr>

	</table>
</div>
<div id="calendar-waterfall" class="backLayer">
	<?php include_once "ontour/dates/dates.php" ?>
</div>
		
<?php
mysqli_close($con);
?>


