<?php session_start(); ?>
		<form id ="userSettingsForm">
			<div class="col-sm-12 venue-details" style="margin-top:15px;margin-bottom:15px;border-radius:4px;box-shadow: 2px 0px 25px #323333;">
			<div class="nav navbar">
			<div class="pull-left" style="opacity:0.85;margin-top:14px;">User Settings</div>
			
			<button type="button" onclick="updateSettings()" class ="btn btn-success ot-button pull-right"><span class= "fa fa-cloud-upload"></span> Update</button>
			<a style="border-width:0px;margin-right:10px" class = "btn btn-default pull-right ot-button" onclick="closeUserSettings()">close</a>
			</div>
				<div class="nav navbar">
					<div style="font-family:oswald;margin-top:12px;" class="pull-left"><span class = "fa fa-user"></span> Personal Info | <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
					</div>
					<div class="pull-right">
						<a type="button" style="color:white;height:44px;width:44px; border-radius:4px; padding:12px; margin-right:3px; font-size:12px;" id="userbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
				</div>
				
				<div id="userinfo" style="display:none;">	
					<div class ="row">
						<div class="col-sm-12">	
							
						</div>
						<div class="col-sm-4">					
						<label>First Name</label>						
						<div class="form-group">
						<input type="text" class="ot-standout" style="font-size:12px;" placeholder="First" value="<?php echo $_SESSION['first_name']; ?>" name="first_name"></input>
						</div>
						</div>
						<div class="col-sm-4">	
						<label>Last Name</label>	
						<div class="form-group">								
						<input type="text" style="font-size:12px;" class="ot-standout" placeholder="Last"value="<?php echo $_SESSION['last_name']; ?>" name="last_name"></input>
						</div>
						</div>
						<div class="col-sm-4">	
						<label><span class = "fa fa-phone"></span> Phone</label>	
						<div>
						<div class="form-group">									
						<input type="tel" style="font-size:12px;" autocomplete="off" class="ot-standout" <?php echo 'value="' . $_SESSION['phone'] . '"' ; ?> name="phone"></input>
						</div>
						</div>
						</div>
					</div>
				</div>
				<div class="nav navbar hidden">
					<div style="font-family:oswald;margin-top:12px;" class="pull-left"><span class = "fa fa-bookmark"></span>  Business | <?php echo $_SESSION['biz_name']; ?>
					</div>
					<div class="pull-right">
						<a type="button" style="color:white;height:44px;width:44px; border-radius:4px; padding:12px; margin-right:3px; font-size:12px;" id="businessbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
					</div>
				</div>				
				<div id="businessinfo" style="display:none;">
					<div class ="row">
						<div class="col-sm-12">	
						</div>
						<div class="col-sm-6">
							<label>Name</label>
								<div class="form-group">
									<input type="text" value="<?php echo $_SESSION['biz_name']; ?>" class="ot-standout" placeholder="Business Name" name="biz"></input>
								</div>
						</div>
					</div>
				</div>
				<div class="nav navbar">
					<div style="font-family:oswald;margin-top:12px;" class="pull-left"><span class = "fa fa-key"></span>Change Password 
					</div>
					<div class="pull-right">
					
						<a type="button" style="color:white;height:44px;width:44px; border-radius:4px; padding:12px; margin-right:3px; font-size:12px;" id="passwordbutton" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
						
						<a type="submit" style="color:white;height:44px;width:44px; border-radius:4px; padding:12px; margin-right:3px; font-size:12px; display:none;" id="updateInfo" class="btn btn-default ot-show-group"><span class="fa fa-toggle-down"></span></a>
						
					</div>
				</div>				
				<div id="passwordinfo" style="display:none;">
					<div class ="row">
						<div class="col-sm-12">	
						</div>
						<div class="col-sm-6">
							<label>New Password</label>
								<div class="form-group">
									<input type="password" min="6" class="ot-standout" placeholder="New Password" value="" name="password"></input>
								</div>
						</div>
						<div class="col-sm-6">	
							<label>Confirm</label>
								<div class="form-group">
									<input type="password" min="6" class="ot-standout" placeholder="Type Again" name="confirm_password"></input>
								</div>
						</div>	
					</div>
				</div>	
			</div>
		</form>	
		
<script>
	$( "#settingsButton" ).click(function() {
	  $( "#userSettings" ).toggle( "blind", 200 );
	});
	$( "#userbutton" ).click(function() {
	  $( "#userinfo" ).toggle( "blind", 200 );
	});
	$( "#businessbutton" ).click(function() {
	  $( "#businessinfo" ).toggle( "blind", 200 );
	});
	$( "#passwordbutton" ).click(function() {
	  $( "#passwordinfo" ).toggle( "blind", 200 );
	});
	$( "#artistbutton" ).click(function() {
	  $( "#artistinfo" ).toggle( "blind", 200 );
	});
</script>