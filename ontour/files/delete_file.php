<?php session_start(); ?>
<?php ob_start(); ?>
<?php
require "dbconnect.php";
require "handler.php";
include "classes.php";

$file = $_GET['filename'];

$filename = str_replace("http://proven-signal-627.appspot.com/.storage.googleapis.com/", "", $file);

$id = $_GET['id'];

unlink('gs://proven-signal-627.appspot.com/'.$filename);

mysqli_query($con,"DELETE FROM files WHERE id ='$id'");
header("Location: export.php");

?>