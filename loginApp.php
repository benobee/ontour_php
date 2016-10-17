<?php ob_start(); ?>
<?php session_start(); ?>
<?php

include "dbconnect.php";
include "handler.php";
include "classes.php";

   $crypt_pass = md5($_POST['password']);
   $found = false;
   $username = $_POST['username'];
   $user = $_POST['username'];   
	  
   $result = mysqli_query($con,"SELECT id, password, username, email_confirm, active FROM users WHERE username = '$user'");  
   if ($data = mysqli_fetch_array($result)){
   
      if ($crypt_pass == $data['password'] && $data['active'] != 0){
			
			$hash = $data['email_confirm'];
			$id = $data['id'];
			$found = true;
			$username = $data['username'];
			$_SESSION['username'] = strtolower($_POST['username']);
			$_SESSION['password'] = md5($_POST ['password']);
		  
			$rememberme = isset($_POST['rememberme']) ? true : false;
				if ($rememberme){				
					setcookie('otdb', sha1($hash), time() + 8500*24*90);
					setcookie('otid', $id, time() + 8500*24*90);					
				}
		}
   }  
?>