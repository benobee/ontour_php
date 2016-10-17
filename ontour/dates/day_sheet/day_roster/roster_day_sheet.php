<?php
session_start();

if ($_SESSION['admin'] == 1)
					{
						$hide = "";
					}
					
				else
					{
						$hide = "hidden";
					}			

				$query3 = ("
				SELECT bands.name, bands.member, bands.phone, bands.role, bands.parent, show_config.member, show_config.show_date, show_config.id AS crew_id, show_config.parent, users.first_name, users.last_name, users.username
				FROM bands, show_config, users
				WHERE bands.member = show_config.member AND bands.member = users.username AND bands.parent = '$sun'");
				
				$members = $handler->query("SELECT member FROM show_config WHERE parent = '$sun' AND show_date = '$show_crew_date'");
				$members->setFetchMode(PDO::FETCH_CLASS, 'Show_config');
?>

			<div class="row" style="border-radius:4px;background:black;box-shadow: 5px 10px 25px #323333">
				<div id="rosterHead" class="col-sm-12">			
					<form role="form" action="update_contact.php">
						<div class="nav navbar">
							<div class=" venue-details pull-left">
								<div style="margin-left:5px;">DAY ROSTER</div>
								<img style="margin-top:5px;" width="80px" src="/img/people.png"></img>
								<a type="button" href="mailto:
										<?php 											
										while($r = $members->fetch())
											{
												echo $r->member .",";
											}												
										?>?Subject=<?php echo $artist_name . " - " . $venue  ." - " . $dateHead;?>&body=Hi," class="btn btn-danger" style="width:50px;height:50px;border-radius:25px; font-family:Oswald; margin-right:10px;padding:14px;"><span class="fa fa-envelope"></span></a>
							</div>
							<div class="pull-right" style="margin-top:25px;">	
								<a type="button" onclick="addDayRosterMembers()" class="btn btn-default ot-button <?php echo $hide;?>" style="font-family:Oswald; margin-right:10px;border-width:0px;">
								<span class="fa fa-plus-circle"></span> Add</a>
							</div>
						</div>		
				</div>
			</div>
<?php												
$bandmembers = mysqli_query($con,$query3);
while ($row = mysqli_fetch_assoc($bandmembers))
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
															
														
														if($show_crew_date == $date)
															{
															?>
				
			<div class="row venue-details" style="background:black;font-size:12px;box-shadow: 5px 10px 25px #323333; border-radius:4px;margin-top:2px;margin-bottom-2px;">		
								<div class="col-xs-2">
									<div class='dropdown'>
															
										<button data-toggle='dropdown' name="<?php echo $row['crew_id'];?>" href='#' class ="btn-danger ot-multi" style="width:40px; height:40px; margin-left:5px;border-radius:20px;" onclick="setCookie('memberID', this.name, 365);"><span class='fa fa-ellipsis-h'></span></button>
									
										<ul class='dropdown-menu' role='menu' style='width:290px; margin-bottom:10px; border-radius:4px; background:black; border-width:0px; padding:10px;'>
															
										<div class='dropdown-menu btn-group' style='border-width:0px; background: black;'>
															
										<a class='btn btn-info ot-show-group' style='color:white; height:64px; width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;font-family:oswald;' href="mailto:<?php echo $member;?>"><span class='fa fa-envelope'></span></a>
															
										<a class='btn btn-primary ot-show-group' style='color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;' href='sms:<?php echo $phone;?>'><span class='fa fa-comment'></span></a>
															
										<a class='btn btn-success ot-show-group' style='color:white;height:64px;width:64px; border-radius:32px; padding:20px; margin-right:5px; font-size:12px;' href="tel:<?php echo $phone;?>"><span class='fa fa-phone'></span></a>
										
										<a class='btn btn-danger ot-show-group <?php echo $hide;?>' onclick="$(document.getElementById(this.name)).show('slide', { direction: 'left' }, 200);" name="<?php echo $row['crew_id'];?>" style='color:white;height:64px;width:64px; border-radius:32px; padding:20px; font-size:12px;'><span class='fa fa-minus-circle'></span></a>
															
										</div>
										</ul>
									</div>
								</div>
															
															
								<div class="col-xs-6">
									<div style="margin-top:10px;font-size:11px;"><?php echo $name;?></div>
								</div>
								<div class="col-xs-4">
									<div style="margin-top:10px;font-size:11px;"><?php echo $role;?></div>
								</div>
					</form>
									
			</div>
			<div class="row">
			<div id ="<?php echo $row['crew_id'];?>" style="display:none; margin-top:5px">
				<div style="border-radius:8px;box-shadow: 5px 10px 25px #323333;">
					<form id="addDatesForm" action="/">
						<div class = "navbar">
							<a class = "btn btn-info ot-button pull-left" name="<?php echo $row['crew_id'];?>" style="margin-left:15px;" onclick="$(document.getElementById(this.name)).hide('slide', { direction: 'left' }, 200);">Cancel</a>
							<a class = "btn btn-danger ot-button pull-right" style="margin-right:15px;" onclick=
							"dropDayRoster()"><span class = "fa fa-minus-circle"></span> DROP?</a>		
						</div>
					</form>		
				</div>
			</div>
			</div>
			
										<?php
		
															
															}
															?>
	<?php
	}														
	?>
		
<script>
function addDayRosterMembers(){
$( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_roster/day_roster.php" );
}
</script>
<script>
function dropDayRoster()
{
          $.ajax({
            type: 'get',
            url: 'ontour/dates/day_sheet/day_roster/crew_delete.php',
            data: $('form').serialize(),
            success: function () {
              $( "#rosterSection" ).load( "ontour/dates/day_sheet/day_items/rosterDaySheet.php" );
            }
          });
}
</script>