<?php
require 'dbinfo.php';
class connection{
	private	
		$name = $dbname; // Your database name
		$user = $dbuser; // Your database username
        $pass = $dbpass; // // Your database password
		$host = $dbhost; // Your database host, 'localhost' is default.
		
	public function connection(){
		return new PDO("mysql:host=$this->host; dbname=$this->name", $this->user, $this->pass);
		

}
?>