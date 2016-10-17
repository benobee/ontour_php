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
$thetype = $_SESSION['group'];
$role = $_SESSION['thememberrole'];
$member = $_SESSION['themembername'];
$email = $_SESSION['thememberemail'];
$thetype = $_SESSION['themembercat'];

$name = $first . " " . $last . " " . "<noreply@ontour.voyage>";
	
$query = ("SELECT email_confirm FROM users WHERE username='$email' LIMIT 1");	
		
$bandmember = mysqli_query($con,$query);
while ($row = mysqli_fetch_assoc($bandmember))
{
	$number = $row['email_confirm'];
}

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

?>
<?php include "Message.php";?>
