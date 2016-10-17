<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <title>On Tour</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/ot.css">
	<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.10.4.custom.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 



<style>
		.ot-alert {
		background: url("img/newsroom.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment:fixed;
		height: 100%;
		}
		.paper {
		background: url("img/sheet.jpg") center no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-attachment:center;
		background-size: cover;
		width: 100%;
		}
		.navbar-iin {
		margin: 0px;
		width: 100%;
		border: 0px;
		}
		.ot-button{
		background: #2D2D2D;
		color: white;
		border-radius: 4px;
		padding: 10px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.75;
		}
		.ot-text{
		color:white;
		}
		.venue-details{
		background: rgba(0, 0, 0, 0.20);
		color: #FCF7E4;
		vertical-align:text-middle;
		opacity: 0.93;
		padding:25px;
		border-bottom-left-radius:8px;
		border-bottom-right-radius:8px;
		}
</style>

	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">
	<link rel="icon" type="image/png" href="img/favicon.jpg">

	<!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
</head>	
<body class="default-venue">
<?php


include "dbconnect.php";
include "handler.php";
include "classes.php";

if (isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
	}
elseif ($_COOKIE["clickID"]) 
	{
		$id = $_COOKIE["clickID"];
	}

session_start();

$sun = $_SESSION['username'];
$first = $_SESSION['first_name'];
$last = $_SESSION['last_name'];

$show = $handler->query("SELECT * FROM shows WHERE id = '$id'");
$show->setFetchMode(PDO::FETCH_CLASS, 'Show');

while($r = $show->fetch())
	{
		$date = date("l F jS, Y", strtotime($r->show_date));
	}

$artist = $_SESSION['thename'];

$parent_id = $_SESSION['parent'];
$parent_page = $_SESSION['parent_page'];	
$isit = $_SESSION['settings_page'];


if ($isit === "/show_settings.php")
	{
		$cancel = "show_settings.php?id=" . $id;
	}
else
	{
		$cancel = "shows.php";
	}

?>

<div class = "container" style="margin-top:50px;">
	<div class = "jumbotron paper" style="border-radius:4px;">
				<div class="container">
					<div class = "navbar navbar-iin">
					<div class = "navbar-text"><h4 style="color:black;"><span class = "fa fa-exclamation-triangle"></span> DELETE DAY?</h4></div>
					</div>
					<div style="color:black;font-size:14px;font-family:oswald;opacity:0.85;">
					Hi <?php echo $first;?>:<br><br>
					We heard that you want to cancel the day of <?php echo $date;?> for <?php echo $artist;?>. Click the delete button to confirm.<br><br>
					FROM: Management
					</div>
					<br>
					<br>
					<div class = "navbar">
						<a class = "btn btn-info ot-button pull-left" data-dismiss='modal' href="#"><h6>Cancel</h6></a>
						<a class = "btn btn-danger ot-button pull-right" onclick="confirmDelete()"><h4><span class = "fa fa-trash-o"></span> DELETE</h4></a>						
					</div>
				</div>			
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
</body>
</html>