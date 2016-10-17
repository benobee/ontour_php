<?php

		include "dbconnect.php";
		include "handler.php";
		include "classes.php";
		$session_username = 'benobee';

		
if (isset($_GET['id']) && is_numeric($_GET['id']))

	{
	$id = $_GET['id'];
	}
 

$book_name = $_POST['event_details'];  
$sql = "SELECT event_details FROM events WHERE event_details LIKE '$event_details%'";  
$result = mysql_query($sql);  
while($row=mysql_fetch_array($result))  
{  
echo "<p>".$row['event_details']."</p>";  
}  

    if ($result)
    {
		header("Location: shows.php");
    }
    else
    {
		echo "<div class = 'container'><div class = 'jumbotron'><h3>ERROR!</h3></div>";
        // close connection 
        mysql_close();
    }

?>		

