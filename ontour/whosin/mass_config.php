<?php session_start();?>	
<?php
		include_once "dbconnect.php";
		include_once "handler.php";
		include_once "classes.php";		
				
if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$sun = $_SESSION['nameid'];
$first = $_SESSION['first_name'];
class Person
	{
        public $member;
        public $show_date;
        public $artist;
		
		public function __construct($member, $show_date, $artist) 
			{
				$this->member = $member;
				$this->show_date = $show_date;
				$this->artist = $artist;	
			}
	}
	
foreach($_POST['dates'] as $dates) 
	{ 
		
		foreach($_POST['member'] as $member)
			{
			
				$going = new Person($member, $dates, $sun);

				mysqli_query($con,"INSERT INTO show_config (parent, member, show_date)	
				VALUES
				('$going->artist','$going->member','$going->show_date')");	
								
			}
			
	} 
	
?>	

<?php
mysqli_close($con);	
?>
				

