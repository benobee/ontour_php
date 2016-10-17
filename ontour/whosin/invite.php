<?php session_start(); ?>
<?php ob_start(); ?>
<?php
include "dbconnect.php";
include "handler.php";
include "classes.php";


$first = $_SESSION['first_name'];
$last = $_SESSION['last_name'];	
$user = $_SESSION['username'];
$artist = $_SESSION['thename'];
$band_id = $_SESSION['nameid'];

$name = $first . " " . $last . " " . "<noreply@ontour.voyage>";
$thetype = $_POST['group'];
$role = $_POST['role'];
$member = $_POST['name'];
$number = md5(rand());
$email = $_POST['username'];

switch($thetype)
	{	
		case "6":
		$type = "management";
		break;		
		case "2":
		$type = "a publicist";
		break;		
		case "7":
		$type = "a booker";
		break;		
		case "1":
		$type = "an artist/performer";
		break;		
		case "10":
		$type = "part of the support crew";
		break;		
		default:
		break;		
	}
	
if($_POST['invite'])
	{		
		$msg = " and an email notification has been sent";
	}

?>

<?php
mysqli_query($con,"INSERT INTO users (username, active, email_confirm)	
VALUES
('$_POST[username]','1','$number')");

mysqli_query($con,"INSERT INTO bands (band_id, member, role, parent, name, category)	
VALUES
('$band_id','$_POST[username]','$_POST[role]','$_POST[parent]','$_POST[name]','$_POST[group]')");

	if($_POST['invite']){
		include "Message.php";
	}



?>
