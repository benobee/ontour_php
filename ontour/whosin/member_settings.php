<?php ob_start(); ?>
<?php session_start(); ?>
	<style>
		.ot-show-group{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.81;
		}
		
	</style>
    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/whosin/update_member.php',
            data: $('form').serialize(),
            success: function () {
              $( "#lineupWindow" ).load( "ontour/whosin/member_settings.php" );
			  $( "#members" ).load( "ontour/whosin/members.php" );
            }
          });

        });

      });
    </script>
				<?php
					require "dbconnect.php";
					require "handler.php";
					include "classes.php";
					
					if ($_COOKIE["memberID"])
						{
							$id = $_COOKIE["memberID"];
						}
					
					$sun = $_SESSION['username'];
					$artist_name = $_SESSION['thename'];
					$_SESSION['memberid'] = $id;
					
					$query = ("
					SELECT bands.member, bands.admin, bands.name, bands.parent, bands.id, bands.role, bands.phone as band_phone, bands.category, users.username, users.phone, users.first_name, users.last_name, users.confirmed
					FROM bands, users
					WHERE bands.member = users.username AND bands.id = '$id' LIMIT 1");
					
					$bandmember = mysqli_query($con,$query);
					
					while ($row = mysqli_fetch_assoc($bandmember))
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
							
							
							
							$band = $row['parent'];
							$email = $row['member'];
							$admin = $row['admin'];
							$role = $row['role'];
							$memberid = $row['id'];
							$cat = $row['category'];
							$confirmed = $row['confirmed'];
							
							$_SESSION['thememberband'] = $band;
							$_SESSION['themembername'] = $name;
							$_SESSION['thememberemail'] = $email;
							$_SESSION['thememberrole'] = $role;
							$_SESSION['themembercat'] = $cat;
	
							if($admin == 1)
								{
									$checked = "checked";
								}
							else
								{
									$checked = "no";
								}
	
						}
					
					$user = mysqli_query($con,"SELECT * FROM users WHERE username = '$band'");
				
				switch($cat)
					{
						case "6":
						$category =		"<option></option>
										<option selected value='6'>Management</option>
										<option value='2'>Publicity</option>
										<option value='7'>Booking</option>
										<option value='1'>Artists/Performers</option>
										<option value='10'>Support Crew</option>";			
						$group = "Management";
						break;
						
						case "2":
						$category =		"<option></option>
										<option value='6'>Management</option>
										<option selected value='2'>Publicity</option>
										<option value='7'>Booking</option>
										<option value='1'>Artists/Performers</option>
										<option value='10'>Support Crew</option>";
										
						$group = "Publicity";
						break;
						
						case "7":
						$category =		"<option></option>
										<option value='6'>Management</option>
										<option value='2'>Publicity</option>
										<option selected value='7'>Booking</option>
										<option value='1'>Artists/Performers</option>
										<option value='10'>Support Crew</option>";
										
						$group = "Booking";
						break;
						
						case "1":
						$category =		"<option></option>
										<option value='6'>Management</option>
										<option value='2'>Publicity</option>
										<option value='7'>Booking</option>
										<option selected value='1'>Artists/Performers</option>
										<option value='10'>Support Crew</option>";	

						$group = "Artists/Performers";					
						break;
						
						case "10":
						$category =		"<option></option>
										<option value='6'>Management</option>
										<option value='2'>Publicity</option>
										<option value='7'>Booking</option>
										<option value='1'>Artists/Performers</option>
										<option selected value='10'>Support Crew</option>";
										
						$group = "Support Crew";
						break;
						
						default:
						break;

					}
					
					
				?>

<!--BODY TAG -->			
			
<!-- Content -->

<div class="venue-details" style="border-radius:4px;margin-top:10px;margin-bottom:20px;padding:10px;box-shadow: 5px 10px 25px #323333;">
	<div class="row" style="margin-bottom:10px;">
	<div id ="drop" style="display:none;position:fixed;z-index:30;">
	<div style="border-radius:8px;">
				<div class="container paper" style="border-radius:4px;">
					<div class = "navbar">
					<div class = "navbar-text"><h4 style="color:black;"><span class = "fa fa-exclamation-triangle"></span> DROP MEMBER?</h4></div>
					</div>
					<div style="color:black;font-size:14px;font-family:oswald;opacity:0.85;padding:15px;">
					Click the drop button to confirm.<br>
					</div>
					<form id="addDatesForm" action="/">
					<div class = "navbar">
						<a class = "btn btn-info ot-button pull-left" id="closeDrop" style="margin-left:15px;">Cancel</a>
						<a class = "btn btn-danger ot-button pull-right" style="margin-right:15px;" type="button" onclick=
						"deleteMember()" data-dismiss='modal'><span class = "fa fa-minus-circle"></span> DROP</a>		
					</div>
					</form>
				</div>			
	</div>
</div>	
		<div class="col-sm-12">
			<div class="nav navbar">
					<h5 style="margin-top:10px;"><?php echo $name;?><small><?php echo " ".$group;?></small></h5>
					<div style="font-family:oswald;font-size:14px;opacity:0.90;">
							<?php echo strtoupper($role);?>
					</div>					
			</div>
				
						
				
			<div class="btn-group">
						<a type="button" href="mailto:<?php echo $email;?>" class="btn btn-danger" style="width:50px;height:50px;border-radius:25px; font-family:Oswald; margin-right:10px;padding:14px;"><span class="fa fa-envelope"></span></a>
																
						<a class="btn btn-primary ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:5px; font-size:12px;" href="sms:<?php echo $phone; ?>"><span class="fa fa-comment"></span></a>
																
						<a class="btn btn-success ot-show-group" style="color:white;height:50px;width:50px; border-radius:25px; padding:14px; margin-right:5px; font-size:12px;" href='tel:<?php echo $phone; ?>'><span class="fa fa-phone"></span></a>
			</div>
						<div class = "row" style="margin-top:20px;">

					<?php
					if ($confirmed == 1)
						{
							$color = "#66FF33";
							$statustext =" Email confirmed";
						}
					else
						{
							$statustext = " Member has not logged in";
							$color = "#C2C2A3";
						}
					?>
				<div class ="col-xs-6">	
					<div id="sendMessage">
					<a onclick="sendMessage()" type="button" class ="btn btn-default ot-show-group navbar-btn"><span class= "fa fa-envelope"></span> Send Notification</a>
					</div>				
				</div>	
				<div class ="col-xs-6">
					<div style="font-size:10px;font-family:oswald;opacity:0.75; margin-top:18px;margin-left:10px;"><span style="color:<?php echo $color;?>"class='fa fa-flag'></span><?php echo $statustext;?>
					</div>
				</div>
			</div>
			<div class="nav navbar">
					<div class="pull-left" style="margin-top:12px;font-family:oswald;margin-left:5px;font-size:12px;">MEMBER SETTINGS</div>
					<div class="pull-right">
						<a type="button" style="width:40px;height:40px;" id="memberbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>	
			</div>
		
			<div id="memberpanel" style="display:none;">
			<form action="/">
			<div class = "row">
				<div class="col-md-12">
					<div class="nav navbar">
						<a type="button" class ="btn btn-danger navbar-btn ot-show-group pull-left" id="memberDrop" ><span class = "fa fa-minus-circle"></span> Drop Member</a>
						<button type="submit" class ="btn btn-success ot-show-group navbar-btn pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
					</div>
				</div>
			
				<div class ="col-md-6">	  
					<div class="form-group">
						<div for="username">Name</div>
						<input type="text" value="<?php echo $name;?>" class="ot-standout" id="username" autocomplete="off" name="name"></input>
					</div>
				</div>
				<div class ="col-md-6">	  
					<div class="form-group">
						<div for="email">E-mail</div>
						<input type="email" value="<?php echo $email;?>"class="ot-standout" id="email" autocomplete="off" name="username"></input>
					</div>
				</div>
				<div class ="col-md-6">	  
					<div class="form-group">
						<div for="phone">Phone</div>
						<input type="tel" value="<?php echo $phone;?>" class="ot-standout" id="phone" autocomplete="off" name="phone"></input>
					</div>
				</div>
				<div class ="col-md-6">	  
					<div class="form-group">
						<div for="role">Role</div>
						<input type="text" value="<?php echo $role;?>" class="ot-standout" id="role" autocomplete="off" name="role"></input>
					</div>
				</div>
				<div class ="col-md-6">	  
					<div class="form-group">
						<div for="role">Group</div>
							<select type="text" class="ot-standout" id="group" autocomplete="off" name="group" required>
								<?php echo $category;?>									  
						</select>
					</div>
				</div>
				<div class ="col-md-6">	  
					<div class="form-group" style="margin-top:20px;">
							<label></span><input type ="checkbox" class="ot-standout" 
							id="admin" name="admin" value="1" style="width:20px;height:20px;margin-right:5px;" <?php echo $checked;?>></input>Admin Access</label>
					</div>
				</div>
			</form>
			</div>
			</div>
		<a style="margin-top:15px;" class="btn btn-default ot-button" onclick="closeMember()" type="button">Close</a>
		</div>
		
	</div>
</div>
<script>
		$( "#memberbutton" ).click(function() {
		  $( "#memberpanel" ).toggle( "blind", 200 );
		});

		$( "#commbutton" ).click(function() {
		  $( "#commpanel" ).toggle( "blind", 200 );
		});
		$( "#memberDrop" ).click(function() {
		  $( "#drop" ).toggle( "blind", 200 );
		});
		$( "#closeDrop" ).click(function() {
		  $( "#drop" ).fadeOut( "slow" );
		});
</script>
<script>	
function deleteMember()
{
          $.ajax({
            type: 'get',
            url: 'ontour/whosin/member_delete.php',
            data: $('#eventUpdateForm').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/whosin/whosin.php" );
            }
          });
}
</script>
<script>
function sendMessage()
{
          $.ajax({
            type: 'get',
            url: 'ontour/whosin/messagesent.php',
            data: $('#eventUpdateForm').serialize(),
            success: function () {
              $( "#sendMessage" ).load( "ontour/whosin/messagebutton.php" );
            }
          });
}

</script>
