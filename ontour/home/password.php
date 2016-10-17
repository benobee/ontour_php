<?php ob_start(); ?>
<?php session_start(); ?>

<?php

include "ontour/dbconnect.php";
include "ontour/handler.php";
include "ontour/classes.php";
		
$data = $_GET['number'];
list($number, $email) = explode("*", $data);

$_SESSION['username'] = $email;

$users = "SELECT * FROM users WHERE email_confirm = '$number' AND username = '$email' LIMIT 1";

$thenumber = mysqli_query($con,$users);
while ($row = mysqli_fetch_assoc($thenumber))
	{
		$confirm = $row['email_confirm'];
		$confirmed = $row['confirmed'];
	}

if ($confirmed == 1)
	{
		header('Location: ./home.php');
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
              $( "#passwordForm" ).load( "password_sent.php" );
            }
          });

        });

      });
    </script>
	<div class="row">
			<div id="passwordForm">
							
				<form class="navbar-form" name="loginform" enctype="multipart/form-data" accept-charset="UTF-8" id="loginform"><input type="hidden" name="form_name" value="loginform"></input>
					<div class="col-xs-12">
							<div class="form-group">
								<h3 class ="ot-text">Password Reset</h3>
								<p class="ot-text">Enter the Email associated with the account.</p>
								<input type="email" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:240px;height:50px;line-height:50px;margin-bottom:5px;background: rgba(80, 80, 80, 0.50);" class="form-control" id="email" name="username" placeholder="Email"></input>
							</div>	
					</div>
					<div class="col-xs-12">
							<div class="form-group">
								<button type="submit" id="go" href="#" class="btn btn-info ot-button"><span class = "fa fa-envelope"></span> Send</button>
							</div>	
					</div>
				</form>	
			</div>
	</div>