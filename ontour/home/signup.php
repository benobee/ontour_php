<?php ob_start(); ?>
<?php session_start(); 
		
$data = $_GET['number'];
list($number, $email) = explode("*", $data);

$_SESSION['username'] = $email;

$users = "SELECT * FROM users WHERE username = '$email' LIMIT 1";

$thenumber = mysqli_query($con,$users);
while ($row = mysqli_fetch_assoc($thenumber)){
		$confirm = md5($row['email_confirm']);
		$confirmed = $row['confirmed'];
	}

if ($confirmed == 1){
		header('Location: ./home.php');
	}
?>
	
<body class="ot-grad">
<div class ="container">
<?php
if($confirm == $number)
	{
		?>
		<div class ="row">	
				<div class ="col-sm-6">								
					<h1 class ="ot-text">Email confirmed</h1>			
					<form class="navbar-form" name="loginform" action="register_user.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="loginform"><input type="hidden" name="form_name" value="loginform"></input>
							<p class="ot-text">Enter your information to login</p>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="text" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="first" name="first" placeholder="First Name" required></input>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="text" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="last" name="last" placeholder="Last Name" required></input>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="phone" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="phone" name="phone" placeholder="Phone Number"></input>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="password" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="password" name="password" placeholder="Password" required></input>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="password" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:50px;margin-bottom:20px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="repassword" name="confirm_password" placeholder="Retype Password" required></input>				  
									</div>		
								</div>						
								<div class="col-xs-12">
									<button href="#" class="btn btn-info ot-button"><span class = "fa fa-sign-in"></span> Submit</button>
								</div>
							</div>	
					</form>	
				</div>		
			</div>
		</div>
	<?php
	}	
else
	{
?>
			<div class ="row">	
				<div class ="col-sm-6">								
					<h1 class ="ot-text">Email NOT confirmed</h1>			
					<form class="navbar-form" name="loginform" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="loginform"><input type="hidden" name="form_name" value="loginform"></input>
							<p class="ot-text">Your email appears to be invalid. Either try the link from your email again or email <a href="mailto:webmaster@ontour.voyage">webmaster@ontour.voyage</a>  for support.</p>	
					</form>	
				</div>		
			</div>
		
<?php
	}
?>

