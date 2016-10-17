<?php ob_start(); ?>
<?php

require "dbconnect.php";
require "handler.php";
include "classes.php";

$data = $_GET['number'];
list($number, $email) = explode("*", $data);

$_SESSION['username'] = $email;

$users = "SELECT * FROM users WHERE username = '$email' LIMIT 1";
$thenumber = mysqli_query($con,$users);
while ($row = mysqli_fetch_assoc($thenumber))
	{
		$confirm = md5($row['email_confirm']);
	}
?>

<script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'password_sent.php',
            data: $('form').serialize(),
            success: function () {
			   $( "#body" ).load( "dashboard.php" );
            }
          });

        });

      });
</script>
<div class ="container">
<?php		
if ($confirm == $number)
	{
		echo'<div class ="row">	
				<div class ="col-sm-6">								
					<h1 class ="ot-text">Password Reset</h1>			
					<form class="navbar-form" name="loginform" action="register_user.php"><input type="hidden" value="loginform"></input>
							<p class="ot-text">Enter new password</p>
							<div class="row">
								<div class="col-xs-12">
									<div>					
										<input type="password" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;font-family:oswald;background:black;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="ot-standout" id="password" name="password" placeholder="Password"></input>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div>					
										<input type="password" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;font-family:oswald;background:black;height:50px;line-height:50px;margin-bottom:20px;background: rgba(80, 80, 80, 0.50);" class="ot-standout" id="repassword" name="confirm_password" placeholder="Retype Password"></input>				  
									</div>		
								</div>						
								<div class="col-xs-12">
									<button href="#" class="btn btn-info ot-button"><span class = "fa fa-sign-in"></span> Log In</button>
								</div>
							</div>	
					</form>	
				</div>		
			</div>
		</div>';
	}

?>

