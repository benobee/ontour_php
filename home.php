<?php ob_start(); ?>
<?php session_start(); 
//-- is user set to stay logged in? --//

if (isset($_COOKIE['otid']))
	{
		$sid = $_COOKIE['otid'];
		include "dbconnect.php";
		include "handler.php";
		include "classes.php";

		$user = "SELECT * FROM users WHERE id = '$sid' LIMIT 1";
		$check = mysqli_query($con,$user);

		while ($row = mysqli_fetch_assoc($check)){
				$hash = sha1($row['email_confirm']);
				$username = $row['username'];
				$password = $row['password'];
			}
			
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			if ($hash == $_COOKIE['otdb']){	
				setcookie("otc","true", time() + 8500*24*90);
			}
	}
?>
<!DOCTYPE html>
<html id="all" lang="en">  
<head>
<title>OnTour</title>  
<meta name="description" content="Applications for artists, bands and musicians designed to help manage their musical lives."> 
<meta name="keywords" content="DIY, Music, Tour App, Tour, Bands, Artists, Touring, Musicians, Tour Manager">
<meta name="copyright" content="Copyright Visited 2014. All Rights Reserved.">
<meta property="og:image" content="img/drive.jpg"/>
<meta property="og:image:secure_url" content="img/drive.jpg" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimal-ui, initial-scale=1 user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	

<!-- Bootstrap -->	
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="css/nprogress.css">
<link type="text/css" rel="stylesheet" href="css/ot.css">
<link type="text/css" rel="stylesheet" href="css/jquery.circliful.css">
<link type="text/css" rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-clockpicker.min.css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->	<!--[if lt IE 9]>	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>	<![endif]-->			
<!-- Favicons -->	

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>



<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">	
<link rel="icon" type="image/png" href="img/favicon.jpg">		<!-- Fonts -->    
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>    
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>  
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>

<?php $key = 'AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU';?>
<!-- Google Places API -->	
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places&key=<?php echo $key;?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<style>			
.ot-img {		
background:  url("img/flight.jpg") 
no-repeat center center; 		
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  width: 100%;	
}
.blur{
 -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);
}					
</style>
</head>
<body style="background:#5C5C5C">
<script>

function login(){

	$( "#login" ).hide();
	$( "#log" ).hide();
	$( "#logNav" ).hide();
	$( "#confirmMessage" ).hide();

	document.getElementById('message').innerHTML = '<h5>Fetching your account info...</h5><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img>';
		
          $.ajax({
            type: 'post',
            url: 'loginApp.php',
            data: $('#loginApp').serialize(),
            success: function () {
				 $( "#body" ).load( "ontour.php" );
			}
          });
}

function checkLogin(){

	if (document.cookie="otc"){	
	var username = document.getElementById('username');
		username.setAttribute('value', '<?php echo $_SESSION['username'];?>');
		
	var password = document.getElementById('password');
		password.setAttribute('value', '<?php echo $_SESSION['password'];?>');		
	login();
	}
}
</script>
<?php

//-- checking to see if user is confirming email link --//

$confirm = $_GET['route'];
if ($confirm == "confirm"){

$data = $_GET['number'];
list($number, $email) = explode("*", $data);
 
$_SESSION['username'] = $email;

include "dbconnect.php";
include "handler.php";
include "classes.php";

//-- searching database for email --//

$users = "SELECT * FROM users WHERE username = '$email' LIMIT 1";
$thenumber = mysqli_query($con,$users);
while ($row = mysqli_fetch_assoc($thenumber)){
		$confirm = md5($row['email_confirm']);
		$confirmed = $row['confirmed'];
	}
	
if($confirm == $number) {
	
		mysqli_query($con,"UPDATE users SET confirmed = '1' WHERE username = '$email'");

		//-- if verified displaying confirm message --//

		if ($_COOKIE['timezone'] == NULL){
		echo 
				'<div style="position:fixed;left:0;right:0;margin:auto;width: 300px; color: #FCF7E4; background:#5C5C5C; padding:10px;box-shadow: 2px 0px 25px #323333; margin-top:80px;border-radius:4px;z-index:9;" id="confirmMessage">
				<h3>Email Confirmed!</h3>
				<p>Use the log in button to access your account.</p>	
				</div>';
		}
	}
}
//-- END OF CONFIRM SCRIPT --//

?>
	<div>
		<div style="position:fixed;left:0;right:0;margin:auto;width: 300px; display:none;background:#5C5C5C; padding:10px;box-shadow: 2px 0px 25px #323333; margin-top:60px;border-radius:4px;z-index:9;" id="login">		
			<form id="loginApp" method="post" target="/">			
				<input type="hidden" name="form_name" value="loginApp"></input>
					<div class="row">
						<div class="col-xs-12">
						<button type="button" class="button pull-right" style="border-radius:4px;display:none;font-size:24px;margin-bottom:15px;opacity:0.2" onclick="hideOTlog()" id="closeLog">X</button>
							<div class="form-group">
								<input type="email" style="box-shadow: 2px 0px 25px #323333; font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:0px;background: black" class="form-control" id="username" name="username" placeholder="Email" required>
							</div>	
						</div>
						<div class="col-xs-12">
							<div class="form-group">					
								<input type="password" style="box-shadow: 2px 0px 25px #323333; font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:20px;background: black;" class="form-control" id="password" name="password" placeholder="Password" required>															
							</div>		
						</div>
						<div class="col-xs-12" style="margin-bottom:20px;">	
							<input type ="checkbox" id="remem_me_check" name="rememberme" value="on" style= "width:30px;height:30px;margin-top:15px;" checked>
							<label for="remem_me_check" style="font-size: 18px;font-family:oswald; color: #FCF7E4"> Stay Logged In</label>
						</div>	
						<div class="col-xs-12">
							<button id="button" style="margin-bottom:15px;box-shadow: 2px 0px 25px #323333;" type="submit" class="btn btn-info ot-log"><span class = "fa fa-sign-in"></span> Log In</button>
						</div>					
					</div>				
			</form>
		</div>
	</div>

<div id="body">
<?php

include "ontour/home/homepage.php";

?>
</div>

<!-- Include all compiled plugins (below), or include individual files as needed -->	
<script src="js/bootstrap.min.js"></script>
<script src='js/jquery-ui.js'></script>
<script src='js/nprogress.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
<script type="text/javascript" src="js/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript" src="js/underscore.js"></script>

<script>
$(function () {

$('#loginApp').on('submit', function (e) {

	e.preventDefault();

	var body = document.getElementById('body');
	body.setAttribute('class','');
	
	login();
	});
});
</script>
<script>	
	function showOTLog() {
	  $( "#login" ).show();
	  $( "#log" ).hide();
	  $( "#closeLog" ).show();
	 var body = document.getElementById('body');
	 body.setAttribute('class','blur');
	}	
	
	function hideOTlog() {
	$("#login").hide();
	$( "#closeLog" ).hide();
	$( "#log" ).show();
	var body = document.getElementById('body');
	 body.setAttribute('class','');
	}	
</script>

</body>
</html>
