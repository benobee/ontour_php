<?php ob_start(); ?>
<?php
if (session_id() == "")
	{
		session_start();
	}
	if (!isset($_SESSION['username']))
	{
		header('Location: home.php');
		exit;
	}
	if (isset($_SESSION['expires_by']))
	{
		$expires_by = intval($_SESSION['expires_by']);
		if (time() < $expires_by)
			{
				$_SESSION['expires_by'] = time() + intval($_SESSION['expires_timeout']);
			}
		else
			{
				unset($_SESSION['username']);
				unset($_SESSION['expires_by']);
				unset($_SESSION['expires_timeout']);
				header('Location: home.php');
				exit;
			}
	}
?>
<?php session_start(); ?>
<style>
		.records {
		background:  url("img/records.jpg") no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}		
</style>

<body style="background:#5C5C5C">
<div id="dash">
<?php 
include "ontour/dashboard/dashInfo.php";?>
</div>

<script>
	function showInfo() {
	  $( "#getInfo" ).show();
	 var body = document.getElementById('body');
	 body.setAttribute('class','blur');
	}
	function closeGetInfo() {
	  $( "#getInfo" ).hide();
	  var body = document.getElementById('body');
	 body.setAttribute('class','');
	}		
		
	function showPassword() {
	  $( "#passwordFormReset" ).show();
	  $( "#login").hide();
	}
</script>

<script>
function addArtist(){
$( "#addArtist" ).show();
$( "#artists" ).hide();
$( "#dash_head" ).hide();
$( "#dashPanel" ).hide();
$( "#dashHead-xs" ).hide();
}
function closeAddArtist(){
$( "#addArtist" ).hide();
$( "#artists" ).show();
$( "#dash_head" ).show();
$( "#dashPanel" ).hide();
$( "#dashHead-xs" ).hide();
}
</script>
<script>
function loadShows(){
$( "#shows" ).load( "shows.php" );
}
</script>
<script>
function create(){
$( "#login" ).load( "ontour/home/create.php" );
}

</script>
<script src='js/jquery-ui-timepicker-addon.js'></script>
<script type="text/javascript">
			function toggle_visibility(id) {
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'block';
			}
</script>
<script type="text/javascript">
			function toggle_hide(id) {
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'none';
			}
</script>
<script>
function loadRange()
{
setCookie("filter", "RANGE", 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=RANGE" );
}
</script>
<script>
function loadAll()
{
setCookie("filter", "ALL", 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=ALL" );
}
</script>
<script>
function loadToday()
{
setCookie("filter", "TODAY", 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=TODAY" );
}
</script>
<script>
function refreshShows()
{
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=<?php echo $filter;?>" );
}
</script>
<script>
function dayRoster()
{
$( "#calendar-waterfall" ).hide().load( "ontour/day_sheet/day_roster/day_roster.php" ).fadeIn(1000);
}
</script>

<script type="text/javascript">
function setFirstDate(){
var first = document.getElementById('firstdate').value;
setCookie("firstdate", first, 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=RANGE" );
}

function setFirstDatexs(){
var first = document.getElementById('firstdatexs').value;
setCookie("firstdate", first, 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=RANGE" );
}

function setLastDate(){
var last = document.getElementById('lastdate').value
setCookie("lastdate", last, 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=RANGE" );
}

function setLastDatexs(){
var last = document.getElementById('lastdatexs').value
setCookie("lastdate", last, 365);
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php?filter=RANGE" );
}

function dates(){
$( "#calendar-waterfall" ).load( "ontour/dates/dates.php" );
}

function whosin(){
$( "#calendar-waterfall" ).load( "ontour/whosin/whosin.php" );
}

function map(){
$( "#calendar-waterfall" ).load( "ontour/map/map_container.php" );
}

function events(){
$( "#calendar-waterfall" ).load( "ontour/map/map_container2.php" );
}

function artistSettings(){
$( "#calendar-waterfall" ).load( "ontour/insights/artist_settings.php" );
}

function exportFile(){
$( "#calendar-waterfall" ).load( "ontour/files/export.php" );
}
function dashboard(){
$( "#dash" ).load( "ontour/dashboard/dashInfo.php" );
}	
</script>
<script>
function daySheet(){
$( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
}
</script>
<script>
function openAddDates(){
	$( "#stuff" ).hide();
	$( "#bottomNav" ).toggle( "blind", 200 );
	$( "#addDatesPanel" ).show('slide', { direction: 'right' }, 200);	
}
function closeAddDates(){
	$( "#addDatesPanel" ).hide();
	$( "#bottomNav" ).toggle( "blind", 200 );
	$( "#stuff" ).show();
}
</script>		
<script>
	(function()
	{
		var elem = document.createElement('input');
		elem.setAttribute('type', 'date');		
		if ( elem.type === 'text' )
			{
				$('#date').datepicker
				(		
					{
						dateFormat: 'yy-mm-dd'
					}
				);	
			}
	})();		
</script>
<script>
function deleteShow(){
$( "#calendar-waterfall" ).load( "ontour/dates/confirmed_delete.php" );
}
</script>
<script>
function dayInfo()
{
$( "#daySettings" ).toggle( "blind", 200 );
$( "#bottomNav" ).hide();
}
function closeDayInfo()
{
$( "#daySettings" ).toggle( "blind", 200 );
$( "#bottomNav" ).show();
}
function itemSettings(){
$( "#settingsWindow" ).load( "ontour/dates/day_sheet/day_items/event_view.php" );
$( "#bottomNav" ).hide();
}

function dayTimes(){
$( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_items/times.php" );
}

function closeItemSettings(){
$( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
$( "#bottomNav" ).show();
}

function addDayItem()
{
$( "#settingsWindow" ).load( "ontour/dates/day_sheet/day_items/adddayitem.php" );
$( "#bottomNav" ).hide();
}

function deleteEvent()
{
          $.ajax({
            type: 'get',
            url: 'ontour/dates/day_sheet/day_items/event_delete.php',
            data: $('#eventUpdateForm').serialize(),
            success: function () {
              $( "#dayItemSection" ).load( "ontour/dates/day_sheet/day_items/times.php" );
            }
          });
}

function closeDayItem()
{
$( "#calendar-waterfall" ).load( "ontour/dates/day_sheet/show_view.php" );
$( "#bottomNav" ).show();
}

$(window).resize(function() {
$('#resize').height($(window).height() - 46);
});

$(window).trigger('resize');

	$( "#daycrew" ).click(function() {
		$( "#crewpanel" ).toggle( "blind", 300 );
	});
	$( "#daycrew2" ).click(function() {
		$( "#crewpanel" ).toggle( "blind", 300 );
	});
	function controlPanel() {
		$( "#controlPanel-xs" ).toggle( "blind", 200 );
	}
	function MemberControlPanel() {
		$( "#memberPanel" ).toggle( "blind", 200 );
	}
	function dashPanel() {
		$( "#dashPanel" ).slideToggle( 200 );
	}
	
</script>
<script src='docs/js/googlePlacesAPI.js'></script>


			