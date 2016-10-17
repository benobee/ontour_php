<?php

try {
	$handler = new PDO('mysql:unix_socket=/cloudsql/ontour-sql:robertplant; dbname=benobeec_otdb','root','otdbadmin123');
	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	echo $e->getMessage();
	die();
	
}
