<?php session_start();
require "dbconnect.php";
require "handler.php";
include "classes.php";

$query = ("SELECT * FROM venues");

$show_query = mysqli_query($con,$query);

while($event = mysqli_fetch_all($show_query)){
echo json_encode($event);
}
?>