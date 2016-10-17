<?php session_start();?>
<?php

require_once "dbconnect.php";
require_once "handler.php";
include_once "classes.php";

$sun = $_SESSION['nameid'];
$artist = $_SESSION['thename']; 
$artist_name = $_SESSION['thename'];

$query3 = ("
	SELECT bands.member, bands.name, bands.parent, bands.id, bands.role, bands.phone as band_phone, bands.category, users.username, users.phone, users.first_name, users.last_name, users.fb_id
	FROM bands, users
	WHERE bands.member = users.username AND bands.parent = '$sun'");
					
?>
			<div style="color:#FCF7E4; margin-bottom:10px" class ="row">
			<div class="visible-xs <?php echo $hidenav;?>" style="background:black;height:50px">
			<a type="button" style="background:#212121;width:44px; height:44px;margin-right:10px;padding:12px;border-radius:22px;" onclick="MemberControlPanel()" href="#" class="button ot-button pull-right"><span class="fa fa-bars"></span></a>
			</div>
			<div id="memberPanel" style="display:none">
			<div class="nav navbar visible-xs" style="background:black">
				
				<a class = 'ot-button btn btn-default <?php echo $hide;?> pull-right' style="opacity: 0.8; margin-left:10px;width:100px;margin-right:10px" onclick="calendar()" href = "#" ><span class="fa fa-plus-circle"></span> Add to Dates</a>
				<a class = 'ot-button btn btn-default <?php echo $hide;?> pull-right' style="opacity: 0.8;width:100px"href = "#" onclick="addlineup()"><span class = "fa fa-plus-circle"></span> Add Member</a>
				
			</div>
			</div>
						<div class = "col-sm-12" style="margin-bottom:10px;opacity:0.85;margin-top:10px">
							<div style="font-family:oswald;"class="pull-left">ARTISTS/PERFORMERS</div>
						</div>
						<div class = "col-sm-12">
							<table style="vertical-align:middle;width:100%;">
							<thead>
								<tr>					
								<th style="width:20%;"></th>
								<th style="width:50%;"></th>
								<th style="width:30%;"></th>
							</thead>
							<tbody style="font-family:Oswald;font-size:12px;">
								</tr>
										<?php
										$bandmembers = mysqli_query($con,$query3);
										while ($row = mysqli_fetch_assoc($bandmembers))
											{	
												$id = $row['id'];
												
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
													
												if($row['fb_id'] == 0)
													{
														$photo = "<span class='fa fa-info-circle fa-2x'></span>";
														$class = "class='btn btn-default ot-show-group " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px; box-shadow: 5px 10px 25px #323333;padding:9px; margin-top:5px;font-size:12px;'";	

													}
												else
													{
														$photo = "<img width='44px' height='44px' style='border-radius:22px' src='http://graph.facebook.com/" .$row['fb_id']."/picture?type=large'</img>";
														$class = "class='btn " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px;padding:0px; margin-top:5px;box-shadow: 5px 10px 25px #323333'";
													}
												
												$role = $row['role'];
												$email = $row['username'];
												$category = $row['category'];
											
											if($category === "1")
												{
												echo "<td>";
															
												?>
												
												<a <?php echo $style . " " . $class;?> onclick="setCookie('memberID', this.name, 365); memberSettings()" name="<?php echo $id;?>" type="button"><?php echo $photo;?></a>
												
												<?php

												echo '<td>' . $name . '</td><td>' . $role . '</td>
													  </tr>';
												}
											}
										?>
							</tbody>
							</table>
						</div>
			</div>
		
						<?php
						$istheremgmt = mysqli_query($con,$query3);
						while ($row = mysqli_fetch_assoc($istheremgmt))
							{
								  if($row['category'] === "6")
									{
										$theremg = $row['username'];
									}
									
								if (strlen($theremg) > 0)	
									{
										$mg = "MANAGEMENT";
									}
								else
									{
										$mg = "";
									}
							}
						
						?>
	
				<div style="border-radius:4px;color:#FCF7E4;"class = "row">
						<div class = "col-sm-12" style="margin-bottom:10px;opacity:0.85;">
							<div style="font-family:oswald;"class="pull-left"><?php echo $mg; ?></div>
						</div>
						<div class = "col-sm-12" style="margin-bottom:15px;">
							<table style="vertical-align:middle;width:100%;">
							<thead>
								<tr>					
								<th style="width:20%;"></th>
								<th style="width:50%;"></th>
								<th style="width:30%;"></th>
							</thead>
							<tbody style="font-family:Oswald;font-size:12px;">
								</tr>
									<?php
									
									$management = mysqli_query($con,$query3);
										while ($row = mysqli_fetch_assoc($management))
											{	
												$id = $row['id'];
												
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
													
												if($row['fb_id'] == 0)
													{
														$photo = "<span class='fa fa-info-circle fa-2x'></span>";
														$class = "class='btn btn-default ot-show-group " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px; box-shadow: 5px 10px 25px #323333;padding:9px; margin-top:5px;font-size:12px;'";	

													}
												else
													{
														$photo = "<img width='44px' height='44px' style='border-radius:22px' src='http://graph.facebook.com/" .$row['fb_id']."/picture?type=large'</img>";
														$class = "class='btn " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px;padding:0px; margin-top:5px;box-shadow: 5px 10px 25px #323333'";
													}
												$role = $row['role'];
												$email = $row['username'];
												$category = $row['category'];
											
												if($category === "6")
												{
												echo "<td>";
												?>
												<a <?php echo $style . " " . $class;?> onclick="setCookie('memberID', this.name, 365); memberSettings()" name="<?php echo $id;?>" type="button"><?php echo $photo;?></a>
												<?php
															
												echo '<td>' . $name . '</td><td>' . $role . '</td>
													</tr>';
												
												}
											
											}
										
										?>
							</tbody>
							</table>
						</div>
						<?php
						$istherebooking = mysqli_query($con,$query3);
						while ($row = mysqli_fetch_assoc($istherebooking))
							{
								  if($row['category'] === "7")
									{
										$therebook = $row['username'];
									}
									
								if (strlen($therebook) > 0)	
									{
										$booking = "BOOKING";
									}
								else
									{
										$booking = "";
									}
							}
							
						?>
						<div class = "col-sm-12" style="margin-bottom:10px;opacity:0.85;">
							<div style="font-family:oswald;"class="pull-left"><?php echo $booking; ?> </div>
						</div>
						<div class = "col-sm-12" style="margin-bottom:15px;">
							<table style="vertical-align:middle;width:100%;">
								<thead>
									<tr>					
								<th style="width:20%;"></th>
								<th style="width:50%;"></th>
								<th style="width:30%;"></th>
								</thead>
							<tbody style="font-family:Oswald;font-size:12px;">
								</tr>
										<?php
									
										$booking = mysqli_query($con,$query3);
										while ($row = mysqli_fetch_assoc($booking))
										{	
												$id = $row['id'];
												
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
													
												if($row['fb_id'] == 0)
													{
														$photo = "<span class='fa fa-info-circle fa-2x'></span>";
														$class = "class='btn btn-default ot-show-group " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px; box-shadow: 5px 10px 25px #323333;padding:9px; margin-top:5px;font-size:12px;'";	

													}
												else
													{
														$photo = "<img width='44px' height='44px' style='border-radius:22px' src='http://graph.facebook.com/" .$row['fb_id']."/picture?type=large'</img>";
														$class = "class='btn " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px;padding:0px; margin-top:5px;box-shadow: 5px 10px 25px #323333'";
													}	
											$role = $row['role'];
											$email = $row['username'];
											$category = $row['category'];
											
											if($category === "7")
											{
											
												echo "<td>";
															
												?>
												
												<a <?php echo $style . " " . $class;?> onclick="setCookie('memberID', this.name, 365); memberSettings()" name="<?php echo $id;?>" type="button"><?php echo $photo;?></a>
												
												<?php
															

												echo '<td>' . $name . '</td><td>' . $role . '</td>
													</tr>';
											}
										}
										?>
							</tbody>
							</table>
						</div>
						<?php
						$istherepub = mysqli_query($con,$query3);
						while ($row = mysqli_fetch_assoc($istherepub))
							{
								$category = $row['category'];
								
								  if($category === "2")
									{
										$therepub = $row['username'];
									}
								
								if (strlen($therepub) > 0)
									{
										$pub = "PUBLICITY";
									}
								else
									{
										$pub = "";
									}
							}
						?>
						<div class = "col-sm-12" style="margin-bottom:10px;opacity:0.85;">
							<div style="font-family:oswald;"class="pull-left"><?php echo $pub;?></div>
						</div>
						<div class = "col-sm-12" style="margin-bottom:15px;">
							<table style="vertical-align:middle;width:100%;">
							<thead>
								<tr>					
								<th style="width:20%;"></th>
								<th style="width:50%;"></th>
								<th style="width:30%;"></th>
							</thead>
							<tbody style="font-family:Oswald;font-size:12px;">
								</tr>
										<?php
										$publicity = mysqli_query($con,$query3);
										while ($row = mysqli_fetch_assoc($publicity))
										{	
												$id = $row['id'];
												
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
													
												if($row['fb_id'] == 0)
													{
														$photo = "<span class='fa fa-info-circle fa-2x'></span>";
														$class = "class='btn btn-default ot-show-group " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px; box-shadow: 5px 10px 25px #323333;padding:9px; margin-top:5px;font-size:12px;'";	

													}
												else
													{
														$photo = "<img width='44px' height='44px' style='border-radius:22px' src='http://graph.facebook.com/" .$row['fb_id']."/picture?type=large'</img>";
														$class = "class='btn " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px;padding:0px; margin-top:5px;box-shadow: 5px 10px 25px #323333'";
													}	
											$role = $row['role'];
											$email = $row['username'];
											$category = $row['category'];
											
											if($category === "2")
											{

												echo "<td>";
												?>
												
												<a <?php echo $style . " " . $class;?> onclick="setCookie('memberID', this.name, 365); memberSettings()" name="<?php echo $id;?>" type="button"><?php echo $photo;?></a>
												
												<?php
															
												echo '<td>' . $name . '</td><td>' . $role . '</td>
													</tr>';
											}
										}
										?>
							</tbody>
							</table>
						</div>
				</div>
	
						<?php
						$istherecrew = mysqli_query($con,$query3);
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
		
	
			<div style="border-radius:4px;color:#FCF7E4;"class ="row">
						<div class = "col-sm-12" style="margin-bottom:10px;opacity:0.85;">
							<div style="font-family:oswald;"class="pull-left"><?php echo $supp; ?></div>
						</div>
						<div class = "col-sm-12" style="margin-bottom:80px;">
							<table style="vertical-align:middle;width:100%;">
							<thead>
								<tr>					
								<th style="width:20%;"></th>
								<th style="width:50%;"></th>
								<th style="width:30%;"></th>
							</thead>
							<tbody style="font-family:Oswald;font-size:12px;">
								</tr>
										<?php
										$support = mysqli_query($con,$query3);
										while ($row = mysqli_fetch_assoc($support))
										{	
												$id = $row['id'];
												
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
													
												if($row['fb_id'] == 0)
													{
														$photo = "<span class='fa fa-info-circle fa-2x'></span>";
														$class = "class='btn btn-default ot-show-group " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px; box-shadow: 5px 10px 25px #323333;padding:9px; margin-top:5px;font-size:12px;'";	

													}
												else
													{
														$photo = "<img width='44px' height='44px' style='border-radius:22px' src='http://graph.facebook.com/" .$row['fb_id']."/picture?type=large'</img>";
														$class = "class='btn " . $hide. "'";
														$style = "style='height:44px;width:44px; border-radius:22px;padding:0px; margin-top:5px;box-shadow: 5px 10px 25px #323333'";
													}
											$role = $row['role'];
											$email = $row['username'];
											
											$category = $row['category'];
											
											if($category === "10")
											{
											
												echo "<td>";
															
												?>
												
												<a <?php echo $style . " " . $class;?> onclick="setCookie('memberID', this.name, 365); memberSettings()" name="<?php echo $id;?>" type="button"><?php echo $photo;?></a>
												
												<?php


												echo    '<td>' . $name . '</td><td>' . $role . '</td>
													</tr>';
											}
										}
										?>
							</tbody>
							</table>
						</div>
			</div>
