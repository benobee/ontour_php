<?php session_start(); ?>	
<?php
require "dbconnect.php";
require "handler.php";
include "classes.php";

$show_crew_date = $_SESSION['showdate'];
$sun = $_SESSION['nameid'];
							
$query = ("
SELECT bands.member, bands.name, bands.parent, bands.id, bands.role, bands.phone as band_phone, bands.category, users.username, users.phone, users.first_name, users.last_name
FROM bands, users
WHERE bands.member = users.username AND bands.parent = '$sun'");
?>
										
    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/dates/day_sheet/day_roster/update_showconfig.php',
            data: $('#rosterForm').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
            }
          });

        });

      });
    </script>
	
	<div id="crewpanel" class="row venue-details" style="background:black;border-radius:4px;box-shadow: 5px 10px 25px #323333;">
		<form role="form" id="rosterForm">
			<div style="border-radius:4px;">
									<div>
										<div class="pull-left">
										<div style="font-family:oswald; font-size:14px;">ARTISTS/PERFORMERS</div>
										</div>										
										
									</div>
									<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:50%;"><h5></th></h5>
										<th style="width:35%;"><h5></h5></th>
										<th style="width:15%;"><h5></h5></th>
									</thead>
									<tbody style="font-family:Oswald;font-size:12px;">
										</tr>
										<?php										
											$perform = mysqli_query($con,$query);
											while ($row = mysqli_fetch_assoc($perform))
											{
														
														if($row['first_name'] === NULL)
																{
																	$name = $row['name'];
																}
															else
																{
																	$name = $row['first_name'] . " " . $row['last_name'];
																}
															
															if($row['phone'] === NULL)
																{
																	$phone = $row['band_phone'];
																}
															else
																{
																	$phone = $row['phone'];
																}
															
															$member = $row['member'];
															$role = $row['role'];
															$date = $_SESSION['showdate'];
															$type = $row['category'];						
													
												if($type == "1")
												{	
													echo '<tr style="height:40px;">
													
													<td><span class="fa fa-user" style="margin-right:10px;"></span>'
													. $name . 
													'</td>
													
													<td>' . $role . 
													'</td>
													
													<td><input name="member[]" 
													style="width:32px;height:32px;" type 
													="checkbox" value="' . 
													$date . ',' . $member . "!" . '">
													
													</input>
													</td>';
													
													echo '</tr>';	
																	
												}
											}
										?>
									
									</tbody>
									</table>								
									<?php
									$istherecrew = mysqli_query($con,$query);
									while ($row = mysqli_fetch_assoc($istherecrew))
										{
											  if($row['category'] === "10")
												{
													$theresupp = $row['username'];
												}
												
											if (strlen($theresupp) > 0)	
												{
													$supp = "SUPPORT CREW";
												}
											else
												{
													$supp = "";
												}
										}									
									?>
									<div class="pull-left">
										<div style="font-family:oswald; font-size:14px;margin-top:25px;"><?php echo $supp;?></div>
										</div>
									<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:50%;"><h5></th></h5>
										<th style="width:35%;"><h5></h5></th>
										<th style="width:15%;"><h5></h5></th>
									</thead>
									<tbody style="font-family:Oswald;font-size:12px;">
										</tr>
										<?php										
											$support = mysqli_query($con,$query);
											while ($row = mysqli_fetch_assoc($support))
											{
														
														if($row['first_name'] === NULL)
																{
																	$name = $row['name'];
																}
															else
																{
																	$name = $row['first_name'] . " " . $row['last_name'];
																}
															
															if($row['phone'] === NULL)
																{
																	$phone = $row['band_phone'];
																}
															else
																{
																	$phone = $row['phone'];
																}
															
															$member = $row['member'];
															$role = $row['role'];
															$date = $row['show_date'];
															$type = $row['category'];
															
												if($type == "10")
												{
													echo '<tr style="height:40px;">
													
													<td><span class="fa fa-user" style="margin-right:10px;"></span>'
													. $name . 
													'</td>
													
													<td>' . $role . 
													'</td>
													
													<td><input name="member[]" 
													style="width:32px;height:32px;" type 
													="checkbox" value="' . 
													$show_crew_date . ',' . $member . "!" . '">
													
													</input>
													</td>';
													
													echo '</tr>';	
																	
												}
											}	
										?>
										
									</tbody>
									</table>
									
								
				<button type="button" style="margin-right:20px;" onclick="closeDayRosterMembers()" class ="btn btn-success ot-button ">close</button>	
				<button type="submit" style="margin-right:20px;" class ="btn btn-success ot-button pull-right"><span class = "fa fa-plus-circle"></span> ADD</button>								
			</div>			
		</form>					
	</div>
															
<script>
	$( "#adminbutton" ).click(function() {
	  $( "#crewpanel" ).toggle( "blind", 200 );
	});
</script>
	
<script>
$(window).resize(function() {
$('#resize').height($(window).height() - 46);
});

$(window).trigger('resize');
</script>
<script>
function closeDayRosterMembers(){
$( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_items/times.php" );
}
</script>

