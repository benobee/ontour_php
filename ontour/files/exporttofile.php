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
		
		if (isset($_POST['submit']))
			{	
				$filename = 'uploads/' . strtotime("now") . 'csv';
				echo $filename;
			}
			
		?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <title>On Tour</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ot.css">
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> 


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
		height: 44px;
		vertical-align:text-middle;
		font-size: 24px;
		color: #878787;
		font-family: inherit;			
		}
		.table-hd-blk{
		color: #FCF7E4;
		padding: 5px;
		background-color: black;
		border-style: none;
		text-align: center;
		}
		.table-hd-info{
		color: #969696;
		padding: 5px;
		background-color: black;
		border-style: none;
		width:15%;
		}
		.venue-hd-info{
		color: #969696;
		padding: 5px;
		background-color: black;
		border-style: none;
		}
		.day-hd-info{
		color: #969696;
		padding: 5px;
		background-color: black;
		border-style: none;
		}
		.artist-name{
		color: #FCF7E4;
		padding: 5px;
		border-style: none;
		opacity:0.65;
		}
		.table-hd-view{
		color: #969696;
		padding: 10px;
		background-color: black;
		border-style: none;
		}
		.date{
		color: black;
		padding: 2px;
		text-align: center;
		}
		.date-head{
		color: white;
		padding: 10px;
		width: 6%;
		background-color: #B6CFCD;
		text-align: center;
		}
		.city-state{
		color: black;
		padding: 5px;
		border-right: none;
		font-size: 14px;
		font-weight:bold;
		text-align: center;
		}
		.location{
		color: black;
		font-size: 12px;
		padding: 5px;
		font-weight:normal;
		text-align: center;
		border-right: none;		
		a:hover {background-color:#FF704D;}
		}		
		.ot-list-hover > li > a:hover {
		color: green;
		}
		.highlight-show{
		color: #FCF7E4;
		background: none;
		padding: 5px;
		border-style: none;
		text-align: center;
		}
		.day{
		font-size: 24px;
		color: #FCF7E4;
		}
		.navbar-iin {
		margin: 0px;
		width: 100%;
		border: 0px;
		color: white;
		}
		.navbar-ot {
		margin: 0px;
		border: 0px;
		color: white;
		}
		.show-info{
		color: black;
		padding: 15px;
		border-right: none;
		border-left: none;
		font-size: 14px;
		vertical-align:text-middle;
		}
		.ot-standout{
		background: rgba(0, 0, 0, 0.62);
		border-radius:4px;
		width:100%;
		height: 44px;
		padding: 5px;
		color:#FFFFEC;
		border-style: solid;
		border-width: 1px;
		border-color:#424242;
		}
		.ot-button{
		background: black;
		color: #FCF7E4;
		padding: 10px;
		border-radius: 4px;
		border-color: #DDDDDD;
		font-family:oswald;
		}
		.ot-delete{
		margin-top:15px;
		background: #F9F9F8;
		color: #2D2D2D;
		padding: 15px;
		border-radius: 4px;
		border-color: #DDDDDD;
		opacity:0.85;
		width:155px;
		height:80px;
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
		opacity:0.35;
		}
		.ot-nav-toggle{
		color: #2D2D2D;
		background: rgba(0, 0, 0, 0.10);
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;		
		}
		.ot-navbar {
		color: black;		
		background: #B6CFCD;
		border-radius: 4px;
		}	
		.ot-img {
		background:  url("img/ot3.jpg") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
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
		.venue-details{
		background: rgba(0, 0, 0, 0.60);
		color: #FCF7E4;
		vertical-align:text-middle;
		padding:10px;
		font-family:oswald;
		}
		.main-back {
		background:  url("img/meet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		}
		.ot-multi{
		background: rgba(0, 0, 0, 0.20);
		color:white;
		padding:10px;
		text-align: center;
		border-color: white;
		opacity:0.81;
		border-style:solid;
		}
		.ot-show-group{
		background: #2D2D2D;
		color:white;
		padding:20px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		}
						
	</style>
	
	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">
	<link rel="icon" type="image/png" href="img/favicon.jpg">

	<!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
	<?php
	$key = 'AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU';
	?>
	<!-- Google Places API -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU"></script>
</head>

<script>
function start() {
  initialize();
}
window.onload = start;
</script>
  
<body class="main-back" onload="start()">
<?php include_once("analyticstracking.php") ?>
  		<?php
		include "dbconnect.php";
		include "handler.php";
		include "classes.php";
		
		$first = $_SESSION['first_name'];
		$sun = $_SESSION['nameid'];
		
		$dashboard = "<a href = './dashboard.php' class = 'btn-xs btn-default navbar-btn 
		dash-button' style='height:30px;'><span class = 'fa fa-dashboard'></span> Dashboard</a>";
		
		$artist_settings = "<a href = './artist_settings.php' class = 'btn-xs btn-default navbar-btn 
		ot-trans-button'><span class = 'fa fa-gear'></span> Settings</a>";	
		
		$export = "<a href = '#' class = 'btn-xs btn-default navbar-btn 
		ot-trans-button'><span class = 'fa fa-print'></span> Print/Export</a>";
		
		$query2 = ("SELECT * FROM shows WHERE session_username='$sun' ORDER by show_date LIMIT 90");	
		
		$query3 = ("SELECT * FROM files WHERE session_username='$sun' LIMIT 10");
		
		?>
<!-- Header -->
	<div class = "container venue-details">	
		<div class = "nav navbar" role = "navigation">
			<div class = "pull-left"><a style="margin-top:20px; margin-bottom:5px;" class = 'btn btn-default back-button' href="./shows.php"><h6><span class = "fa fa-arrow-circle-o-left fa-2x"></span></h6></a></div>
			
			<div class="pull-left" style="font-size: 18px; margin-top:35px;font-family:oswald; padding: 5px;">Export to File
			</div>			
		</div>
	</div>

<!-- Content -->
<div class = "container" style="margin-bottom:80px;">
	<div class = "row venue-details">
	<div class="col-sm-6">
	<form method="post" role="form" action="mass_export.php">
					<div id="dates" style="border-radius:4px;margin-bottom:25px;">
					
						<div style="font-family:oswald;font-size:18px;">DATES</div>
							<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:30%;"><h6>Date</h6></th>
										<th style="width:30%;"><h6>City</h6></th>
										<th style="width:30%;"><h6>Venue</h6></th>
										<th style="width:10%;"><h6></h6></th>
										</tr>
									</thead>
									<tbody style="font-family:Oswald;font-size:11px;">
														
									<?php
									
										$dates = mysqli_query($con,$query2);
										while ($row = mysqli_fetch_assoc($dates))
											{
												echo '<tr style="height:40px;">';	
												echo '<td>' . date("M . d . Y", strtotime($row['show_date'])) . "</td><td>" . $row['venue_city'] . ' ' .$row['venue_state']. "</td><td>" . $row['show_venue'] . "</td>";
												echo '</td>
													
													<td><input name="dates[]" 
													style="width:32px;height:32px;" type 
													="checkbox" value="' . 
													$row['show_date'] . '">
													
													</input>
												</td>';
												echo '</tr>';	
											}
											
									?>										
							
									</tbody>
							</table>
					</div>							
	</div>
	<div class="col-sm-6">
	<div style="font-family:oswald;font-size:18px;margin-bottom:20px;">EXPORT OPTIONS</div>
					<div class="row" style="margin-bottom:20px;">
						
						<div class="col-xs-10">
							<div style="font-family:oswald;font-size:14px;margin-bottom:20px;">DAY SHEETS</div>
						</div>
						<div class="col-xs-2">
							<input type="checkbox" name="thedates" value="1" style="width:32px;height:32px;"></input>
						</div>
				</div>
		<button type="submit" class="btn btn-default ot-button" name="submit" style="margin-bottom:15px;"><span class = "fa fa-cloud-download"></span> Download File</button>
		<div style="font-family:oswald;font-size:14px;margin-bottom:20px;">FILES</div>
		<?php
		$files = mysqli_query($con,$query3);
		for ($row = mysqli_fetch_assoc($files))
			{
				echo" <a style='color:white;' href='".$row['filename']."'>DAYSHEETS</a><br>";
			}
		?>
	</div>
	</div>
	</form>
</div>

<?php
mysqli_close($con);
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>