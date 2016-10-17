<?php session_start(); ?>	
	<style>
		.table{
		width: 100%;
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
		.ot-nav-toggle{
		color: #2D2D2D;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.55;		
		}
		.modal{
			z-index: 20;   
		}
		.modal-backdrop{
			z-index: 10;        
		}​
		a:link {color:#FCF7E4;}    /* unvisited link */
		a:visited {color:#FCF7E4;} /* visited link */
		a:hover {color:#FCF7E4;}   /* mouse over link */
		a:active {color:#FCF7E4;}  /* selected link */
		
		.ot-nav-toggle{
		color: #2D2D2D;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #DDDDDD;
		opacity:0.55;		
		}
		
		.ot-img {
		background:  url("img/meet.jpg") no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		opacity: 0.93;
		width:100%;
		}
		.ot-button{
		background: black;
		color: #FCF7E4;
		padding: 8px;
		border-radius: 4px;
		border-color: #DDDDDD;
		font-family:oswald;
		}
	</style>

    <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/whosin/mass_config.php',
            data: $('form').serialize(),
            success: function () {
              $( "#whosinDates" ).load( "ontour/whosin/config_add.php" );
            }
          });

        });

      });
    </script>
				<?php
					require "dbconnect.php";
					require "handler.php";
					include "classes.php";
					
					session_start();	
					if (isset($_GET['id']) && is_numeric($_GET['id']))
						{
							$id = $_GET['id'];
						}
					else
						{
							$id = $_SESSION['parent'];
						}
						

					$sun = $_SESSION['nameid'];

					$parent_id = $_SESSION['parent'];
					$parent_page = $_SESSION['parent_page'];
					$_SESSION['roster'] = $id;
					$today = $_SESSION['today'];
					$artist_name = $_SESSION['thename'];
					$imgType = $_SESSION['img'];
				
				$query = ("
				SELECT bands.member, bands.name, bands.parent, bands.id, bands.role, bands.phone as band_phone, bands.category, users.username, users.phone, users.first_name, users.last_name
				FROM bands, users
				WHERE bands.member = users.username AND bands.parent = '$sun'");
				
				$query2 = ("SELECT shows.show_date, shows.show_tour, shows.venue_city, shows.venue_state, shows.show_venue FROM shows WHERE 
				session_username='$sun' AND shows.show_date >= '$today' ORDER by show_date LIMIT 90");	
				?>
		
			

<!-- Content -->
<div class="container" style="margin-top:10px;">
<form action="/" id="configform">
<div class="venue-details" style="margin-bottom:150px;box-shadow: 5px 10px 25px #323333;">							
	<div class ="row">
			<div class="col-lg-5">
				<div id="crewpanel">					
							<div class = "row">
								<div class = "col-sm-12">
									<div style="border-radius:4px;padding:5px;" class="venue-details"> 
									<div>
										<div class="pull-left">
										<div style="font-family:oswald; font-size:14px;opacity:0.85;">ARTISTS/PERFORMERS</div>
										</div>
									</div>
									<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:50%;"><h5>Name</th></h5>
										<th style="width:40%;"><h5>Role</h5></th>
										<th style="width:10%;"><h5 style="padding-left:15px;"><span class="fa fa-check-circle"span></h5></th>
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
															$date = $row['show_date'];
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
													style="width:32px;height:32px;margin-left:10px;" type 
													="checkbox" value="' . 
													$member . '">
													
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
										<div style="font-family:oswald; font-size:14px;margin-top:25px;opacity:0.85;"><?php echo $supp;?></div>
										</div>
									<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:50%;"><h5></th></h5>
										<th style="width:40%;"><h5></h5></th>
										<th style="width:10%;"><h5 style="padding-left:15px;"></h5></th>

										</tr>
									</thead>
									<tbody style="font-family:Oswald;font-size:12px;">
										
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
													style="width:32px;height:32px;margin-left:10px;" type 
													="checkbox" value="' . 
													$member . '">
													
													</input>
													</td>';
													
													echo '</tr>';	
																	
												}
											}	
										?>
									
									</tbody>
									</table>
									</div>
								</div>
						
							</div>				
										
				</div>
			</div>
			<div class="col-lg-7">
	
					<div id="dates" style="padding:10px;border-radius:4px;">
							<table style="vertical-align:middle;width:100%;">
									<thead>
										<tr>					
										<th style="width:25%;"><h6>Date</h5></th>
										<th style="width:35%;"><h6>City</h5></th>
										<th style="width:35%;"><h6 style="margin-right:5px;">Venue</h5></th>
										<th style="width:5%;"><h6 style="padding-left:25px"><span class="fa fa-check-circle"span></h6></th>
										</tr>
									</thead>
									<tbody class="table" style="font-family:Oswald;font-size:11px;">
														
											<?php
									
											$dates = mysqli_query($con,$query2);
											while ($row = mysqli_fetch_assoc($dates))
											{
												echo '<tr style="height:40px;">';	
												echo '<td>' . date("m-d-y", strtotime($row['show_date'])) . "</td>";
												echo "<td>" . $row['venue_city'] . "</td>";
												echo "<td>" . $row['show_venue'] . "</td>";
												echo '</td>
													
													<td><input name="dates[]" 
													style="width:32px;height:32px;margin-left:20px;" type 
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
					<div class="nav navbar">
					<a class = 'btn btn-default ot-button <?php echo $hide;?>' style="margin-top:10px;" onclick="whosin()" >Close</a>
					
					<button type="submit" style="margin-top:10px;" class ="btn btn-success ot-button pull-right"><span class = "fa fa-cloud-upload"></span> ADD</button>
					</div>	
			</div>												
	</div>			
</div>				
</form>	
</div>


