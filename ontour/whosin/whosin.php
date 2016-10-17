<?php session_start(); ?>
<?php include_once("ontour/home/analyticstracking.php") ?>
<?php
			
require "dbconnect.php";
require "handler.php";
include "classes.php";

$admin = $_SESSION['admin'];
if ($admin == 1)
			{
				$sun = $nameid;
				$hide = "";
				$admin = true;
			}			
		else 
			{
				$sun = $nameid;
				$hide = "hidden";
				$admin = false;
			}
					
$_SESSION['parent_page'] = $pageURL .= $_SERVER["SCRIPT_NAME"];
$sun = $_SESSION['nameid'];
$artist = $_SESSION['thename']; 
$artist_name = $_SESSION['thename'];								
?>			
			
<div id="in" class ="container" style="box-shadow: 5px 10px 25px #323333;background:#2D2D2D;">	
	<div id="totalcrew">	
	<div class="row">
	<div id="whosinDates">
	<div class="nav navbar hidden-xs" style="background:black">
		<div style="margin-top:5px;margin-right:5px">
		<a class = 'ot-button btn btn-default <?php echo $hide;?> pull-right' style="opacity:0.9;margin-left:10px;width:100px;" onclick="calendar()" type="button" ><span class="fa fa-plus-circle"></span> Add to Dates</a>
		<a class = 'ot-button btn btn-default <?php echo $hide;?> pull-right' style="opacity:0.9;width:100px" type="button" onclick="addlineup()"><span class = "fa fa-plus-circle"></span> Add Member</a>
		</div>
	</div>
		
		<div class="col-sm-6">
		<div id="lineupWindow">
		</div>
		<div id="whosinWindow">
		</div>
		</div>
		<div id="members" class="col-sm-6">
			<?php include "ontour/whosin/members.php";?>
		</div>
	</div>
	</div>
	</div>
</div>
	
<script>
function addlineup(){
$( "#lineupWindow" ).load( "ontour/whosin/addlineup.php" ).show();
$( "#members" ).hide();
}
function memberSettings(){
$( "#lineupWindow" ).load( "ontour/whosin/member_settings.php" ).hide().fadeIn("slow");
$( "#members" ).hide();
}
function calendar(){
$( "#whosinDates" ).load( "ontour/whosin/calendar.php" );
}
function loadMembers(){
$( "#members" ).load( "ontour/whosin/members.php" );
}
function closeWindow(){
$( "#lineupWindow" ).hide();
$( "#members" ).show();
}
function closeMember(){
$( "#lineupWindow" ).load("ontour/dates/day_sheet/empty.php");
$( "#members" ).show();
}
$(window).resize(function() {
    $('#resize').height($(window).height() - 46);
});

$(window).trigger('resize');
</script>

