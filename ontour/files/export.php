<?php session_start(); ?>
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
		.ot-trans-button{
		background: black;
		color: white;
		border-radius: 4px;
		border-color: #DDDDDD;
		opacity:0.80;
		}
		.dash-button{
		background: #2D2D2D;
		color: #FCF7E4;
		border-radius: 4px;
		border-color: #DDDDDD;
		}
		.date-container{
		border: 1px;
		border-style: solid;
		border-color: #FCF7E4;
		border-radius:4px;
		width:60px;
		}
		.ot-small-button{
		background: #2D2D2D;
		color: #FCF7E4;
		border-radius: 8px;
		padding: 10px;
		}
		.ot-nav-toggle-button{
		background: #2D2D2D;
		color: white;
		border-radius: 8px;
		padding: 10px;
		margin-right: 15px;
		border-color:#FFFFD2;
		}
		.display-head {
		color: #FCF7E4;
		padding: 5px;
		background-color: black;
		font-size: 24px;
		text-align: center;
		}
		.label-event {
		color: black;
		background-color: #F9F9F8;
		width: 100%;
		border-style: solid;
		border-color: #DDDDDD;
		border-width: 1px;
		}
		.ot-navbar {
		color: black;		
		background: #B6CFCD;
		border-radius: 4px;
		}	
		.ot-dyn-button{
		background: #2D2D2D;
		color: white;
		border-radius: 8px;
		padding: 10px;
		}
		.ot-img {
		background:  url("img/tavern.jpg") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		width:100%;
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
		.ot-tour-head {
		background:  url("img/tourhead.jpg") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		margin-top: 0px;
		height: 100%;
		}
		.venue-waterfall{
		background: rgba(0, 0, 0, 0.00);
		color: #FCF7E4;
		border-width: 0px;
		border-style: solid;
		}
		.location-list{
		color: black;
		border-radius: 15px;
		background: radial-gradient(circle, #DAD5C9, rgba(255,0,0,0));
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
		.icon-van {
		background:  url("img/van.png") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		margin-top: 0px;
		height: 100%;
		}
		.venue-details{
		background: rgba(0, 0, 0, 0.60);
		color: #FCF7E4;
		vertical-align:text-middle;
		padding:10px;
		font-family:oswald;
		}
		.default-venue {
		background: url("img/default_venue.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.main-back {
		background:  url("img/meet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		}
		.main-blur {
		background: url("img/blur.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		}
		.drive {
		background:  url("img/drive.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.venue-img {
		background: url("img/club2.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
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
		.flight {
		background:  url("img/flight3.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.studio {
		background:  url("img/studio.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}		
		.off {
		background:  url("img/off.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.rehearsal {
		background:  url("img/rehearsal.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.amphitheatre {
		background:  url("img/amphitheatre.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.bar {
		background:  url("img/bar.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.club {
		background:  url("img/club.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.theater {
		background:  url("img/theater.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.punk {
		background:  url("img/punk2.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.tba {
		background: url("img/tba.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.travel {
		background:  url("img/drive.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.tavern {
		background:  url("img/tavern.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.show-text{
		background: rgba(0, 0, 0, 0.62);
		color: #FCF7E4;
		}
		.van {
		background:  url("img/van.png") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		width: 100%;
		}
		.people {
		background:  url("img/people.png") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		width: 100%;
		}
		.ot-show-group{
		background: #2D2D2D;
		color:white;
		padding:20px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		}
		.back-button{
		background: #B6CFCD;
		color: white;
		margin-left: 15px;
		border-radius: 8px;
		padding: 8px;
		font-size: 18px;
		line-height: 30px;
		}
		
</style>	

    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'mass_export.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "export.php" );
            }
          });

        });

      });
    </script>
	

	
<?php include_once("analyticstracking.php") ?>
<?php

include_once "dbconnect.php";
include_once "handler.php";
include_once "classes.php";

if (isset($_POST['submit']))
	{	
		$filename = 'uploads/' . strtotime("now") . 'csv';
	}
	
$first = $_SESSION['first_name'];
$sun = $_SESSION['nameid'];	

$query2 = ("SELECT * FROM shows WHERE session_username='$sun' ORDER by show_date LIMIT 90");	
$query3 = ("SELECT * FROM files WHERE session_username='$sun' LIMIT 10");
?>

<!-- Content -->
<div class = "container">
	<div class = "row venue-details">
	<div class="col-sm-6">
	<form id="exportForm" action="/">
					<div id="dates" style="border-radius:4px;margin-bottom:25px;">
					
						<div style="font-family:oswald;font-size:18px;">DATES</div>
							<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:30%;"><h6>Date</h6></th>
										<th style="width:30%;"><h6>City</h6></th>
										<th style="width:30%;"><h6>Venue</h6></th>
										<th style="width:10%;"><h6><span class="fa fa-check-circle"></span></h6></th>
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
		<div class="hidden" style="font-family:oswald;font-size:18px;margin-bottom:20px;">EXPORT OPTIONS</div>
					<div class="row" style="margin-bottom:20px;">		
						<div class="col-xs-10 hidden">
							<div style="font-family:oswald;font-size:14px;margin-bottom:20px;">DAY SHEETS</div>
						</div>
						<div class="col-xs-2 hidden">
							<input type="checkbox" name="thedates" value="1" style="width:32px;height:32px;" checked></input>
						</div>
					</div>
		<a type="submit" class="btn btn-default ot-button" style="margin-bottom:15px;"><span class = "fa fa-cloud-download"></span> Create File</a>
		<div style="font-family:oswald;font-size:14px;margin-bottom:20px;"></div>
		<table>
		<tr>
		<th style="margin-right:10px;"></th>
		<th></th>
		</tr>
		<?php
		$files = mysqli_query($con,$query3);
		while ($row = mysqli_fetch_assoc($files))
			{
				echo "<td style='margin-bottom:10px;'><div class='dropdown'>";															
				echo "<button data-toggle='dropdown' href='#' class ='btn-danger ot-multi' style='width:40px; height:40px; 
				border-radius:20px;border-width:2px;margin-right:10px;padding:5px;'><span class='fa fa-ellipsis-h'></span></button>";
															
				echo "<ul class='dropdown-menu' role='menu' style='width:160px; margin-bottom:10px; border-radius:4px; background:black; 
				border-width:0px; padding:8px;'>";
															
				echo "<div class='dropdown-menu btn-group' style='border-width:0px; background: none;'>";
				
				echo "<a class='btn btn-info ot-show-group' style='height:64px; width:64px; border-radius:32px; padding:20px; 
				margin-right:5px; font-size:12px;font-family:oswald;' href='".$row['filename']."'><span class = 'fa 
				fa-cloud-download'></span></a>";
															
				echo "<a class='btn btn-danger ot-show-group' style='height:64px;width:64px; border-radius:32px; padding:20px; 
				margin-right:5px; font-size:12px;' href='delete_file.php?id=".$row['id']."&filename=".$row['filename']."'><span class='fa 
				fa-trash-o'></span></a>";
																																		
				echo "</div></ul>";
				echo "</div>";											
				echo "</td>";
				echo '<td> DAYSHEETS</td></tr>';
			}
		?>
		</table>
	</div>
	</div>
	</form>
</div>
<?php
mysqli_close($con);
?>
