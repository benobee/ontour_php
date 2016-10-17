<?php session_start();?>
<?php
require_once "dbconnect.php";
require_once "handler.php";
include_once "classes.php";

$name = $_POST['fb_email'];
$fullname = $_POST['fb_name'];										
list($first, $last) = explode(" ", $fullname);

$id = $_POST['fb_id'];	

$db = mysqli_query($con,"SELECT * FROM users WHERE username = '$name' LIMIT 1");		
while($row = mysqli_fetch_assoc($db))
	{
		$account = $row['username'];
		$confirmed = $row['confirmed'];
		$fb_id = $row['fb_id'];
	}
	
		if ($account)
			{	
				if(!($confirmed))
					{
						mysqli_query($con,
						
						"UPDATE users 
						SET first_name ='$first', 
						last_name ='$last', 
						confirmed='1',
						fb_id='$id'
						
						WHERE username='$account'");	
						
						$_SESSION['username'] = $account;
					}
				else
					{
						$_SESSION['username'] = $account;
					}
			}
		elseif(!($account))
			{				
				$number = md5(rand());
				mysqli_query($con,"INSERT INTO users (username, first_name, last_name, active, confirmed, email_confirm, fb_id)	
				VALUES
				('$name','$first','$last','1','1','$number','$id')");
				$_SESSION['username'] = $name;
			}
			
		if(!($fb_id))
			{
				mysqli_query($con,
						
						"UPDATE users 
						SET 
						fb_id='$id'
						
						WHERE username='$account'");
			}
			

		
?>	