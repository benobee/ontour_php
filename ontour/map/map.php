<?php session_start();?>
<?php $key = 'AIzaSyD7AvCXODlrDX7-gqQ4IQg4BnoR808pTWU';
require_once('twitter/TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "2577713748-kE0VAIRJJV7CvcbPAAM9elPMbBIReOWSyoP9pKz",
    'oauth_access_token_secret' => "UTnPwqU7j14fZuWYgbNTgdunapTaKiRO077rGciUauzJA",
    'consumer_key' => "O98we4PRsi36Y4cWRPPzNHbB5",
    'consumer_secret' => "BaBWoTGyGcrXvUROwP9cea91sUC7yCDRl7g9NR3X2SQsu9l8Rk"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=benobee1&count=20';

/* $twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(); */
			 
require "dbconnect.php";
require "handler.php";
include "classes.php";

$sun = $_SESSION['nameid'];
$query = ("SELECT * FROM band_names WHERE id = '$sun'");
$user_query = mysqli_query($con,$query);

while($row = mysqli_fetch_assoc($user_query))
			{
				$mb_id = $row['mb_id'];
				$buzz = $row['buzz'];
				$artist_name = $row['name'];
			}
?>
<!DOCTYPE html>
<head>
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="css/ot.css">
<link type="text/css" rel="stylesheet" href="css/font-awesome.css">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/favicon_precomposed.jpg">	
<link rel="icon" type="image/png" href="img/favicon.jpg">		<!-- Fonts -->    
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>    
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>  
<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=<?php echo $key;?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
   }
 </style>
</head>
<body>

<script type="text/javascript">
			
      function initialize() {
	  
      var mapOptions = {
          center: new google.maps.LatLng(32.397, -90.644),
          zoom: 3,
		  mapTypeId: google.maps.MapTypeId.TERRAIN,
		  disableDefaultUI: true

      };
	  	  var styles = [
		  {
			"featureType": "poi",
			"elementType": "labels.text",
			"stylers": [
			  { "lightness": 43 },
			  { "weight": 0.1 },
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.land_parcel",
			"stylers": [
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.neighborhood",
			"stylers": [
			  { "visibility": "simplified" },
			  { "opacity": 0.8 }
			]
		  },{
			"stylers": [
			  { "saturation": -100 },
			  { "gamma": 0.64 },
			  { "lightness": -10 },			  
			]
		  },{
			"featureType": "administrative.province",
			"elementType": "labels.text",
			"stylers": [
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.province",
			"elementType": "geometry",
			"stylers": [
			  { "visibility": "simplified" }
			]
		  },{
			"featureType": "administrative.country",
			"elementType": "geometry",
			"stylers": [
			  { "visibility": "on" },
			  { "weight": 0.2 }
			]
		  },{
			"featureType": "administrative.country",
			"elementType": "labels.text",
			"stylers": [
			  { "visibility": "on" },
			  { "weight": 0.2 },
			   { "color": "#686965" },
			   { "visibility": "simplified" }

			]
		  }];

	  var map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);
	  map.setOptions({styles: styles});
	    
/* 	   	  		layer = new google.maps.FusionTablesLayer({
					query: {
					  select: 'location',
					  from: '1csySYiBOidF7EnIyzYO2B5w4oFsRa1Kt8HqRkIs'
					},
					styles: [{
					  markerOptions: {
						iconName: "measle_grey",
						fillOpacity: 0.2,
						opacity: 0.2
					  }
					}]
				  });
				  
			    layer.setMap(map); */

			
	var myLatlng = new google.maps.LatLng("32.397","-90.644");	  	    
	var id ='<?php echo $mb_id;?>';
	var artist ='<?php echo $artist_name;?>';
		
			$.ajax({	
				url: 'http://api.semetric.com/artist/'+id+'/demographics/twitter-fans/location/city',
				dataType: "json",
				data: {
					format:"jsonp",
					token: "322151bbf8cc47ffb30a2e94e8823a57"
				},								
				success:function(data){
				console.log(data);
				var buzzy ='<?php echo $buzz;?>';
				var buzz = Math.floor((buzzy / 1) * 10);
				
					var twitterFollowers = new Array();				
					for (var i = 0; i < data.response.length; i++){
					var one = data.response[0].value;
					var lat = data.response[i].city.latitude;
					var lon = data.response[i].city.longitude;
					var val = data.response[i].value;
					var name = data.response[i].city.name;
					var dynVal = val / one * 15;
					
					var twitter = new google.maps.Circle({
						strokeColor: '#0080FF',
						strokeOpacity: 0.9,
						strokeWeight: 4,
						fillColor: '#FFFF80',
						fillOpacity: 0.2,
						map: map,
						editable: false,
						zIndex: 0.5,
						radius: 2500 * dynVal * buzz,
						center: new google.maps.LatLng(lat,lon)
					});					
					twitter.setMap(map);
					}				
				}
			});
	 }

</script>
<script>	
$.ajax({	
		url: 'get_events.php',
		dataType: "json",
		data: "",								
		success:function(data){
				
		var loc = data[0][1];
		var first = loc.split(',');
		var markLoc = new google.maps.LatLng(first[0], first[1]);
		
		var mapOptions = {
          center: markLoc,
          zoom: 8,
		  mapTypeId: google.maps.MapTypeId.TERRAIN,
		  disableDefaultUI: true		
        };
	  	  var styles = [
		  {
			"featureType": "poi",
			"elementType": "labels.text",
			"stylers": [
			  { "lightness": 43 },
			  { "weight": 0.1 },
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.land_parcel",
			"stylers": [
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.neighborhood",
			"stylers": [
			  { "visibility": "simplified" },
			  { "opacity": 0.8 }
			]
		  },{
			"stylers": [
			  { "saturation": -100 },
			  { "gamma": 0.64 },
			  { "lightness": -10 },			  
			]
		  },{
			"featureType": "administrative.province",
			"elementType": "labels.text",
			"stylers": [
			  { "visibility": "off" }
			]
		  },{
			"featureType": "administrative.province",
			"elementType": "geometry",
			"stylers": [
			  { "visibility": "simplified" }
			]
		  },{
			"featureType": "administrative.country",
			"elementType": "geometry",
			"stylers": [
			  { "visibility": "on" },
			  { "weight": 0.2 }
			]
		  },{
			"featureType": "administrative.country",
			"elementType": "labels.text",
			"stylers": [
			  { "visibility": "on" },
			  { "weight": 0.2 },
			   { "color": "#686965" },
			   { "visibility": "simplified" }

			]
		  }];

		var map = new google.maps.Map(document.getElementById("map-canvas"),
		mapOptions);
		map.setOptions({styles: styles});
		
		var id ='<?php echo $mb_id;?>';	  

			$.ajax({	
				url: 'http://api.semetric.com/artist/'+id+'/demographics/twitter-fans/location/city',
				dataType: "json",
				data: {
					format:"jsonp",
					token: "322151bbf8cc47ffb30a2e94e8823a57"
				},								
				success:function(data){
				console.log(data);
				
				var buzzy ='<?php echo $buzz;?>';
				var buzz = Math.floor((buzzy / 1) * 10);
				
					var twitterFollowers = new Array();				
					for (var i = 0; i < data.response.length; i++){
					var one = data.response[0].value;
					var lat = data.response[i].city.latitude;
					var lon = data.response[i].city.longitude;
					var val = data.response[i].value;
					var name = data.response[i].city.name;
					var dynVal = val / one * 15;
					
					var twitter = new google.maps.Circle({
						strokeColor: '#0080FF',
						strokeOpacity: 0.9,
						strokeWeight: 4,
						fillColor: '#FFFF80',
						fillOpacity: 0.08,
						map: map,
						content: thedate,
						editable: false,
						zIndex: 0.5,
						radius: 2500 * dynVal * buzz,
						center: new google.maps.LatLng(lat,lon)
					});					
					twitter.setMap(map);
					}				
				}
			});
			
/* 				layer = new google.maps.FusionTablesLayer({
					query: {
					  select: 'location',
					  from: '1csySYiBOidF7EnIyzYO2B5w4oFsRa1Kt8HqRkIs'
					},
					styles: [{
					  markerOptions: {
						iconName: "measle_grey",
						fillOpacity: 0.3,
						zIndex: 99.9
					  }
					}]
				  });
				  
			    layer.setMap(map); */
								
		var performanceDates = new Array();		
			for (var i = 0; i < data.length; i++){
	
			var loc = data[i][1];
			var latLon = loc.split(',');		

			performanceDates[i] = new google.maps.LatLng(latLon[0],latLon[1]);	
			
			var thedate = data[i][3];
			var lastdate = data[i][data.length];
			
			var icon = {url: 'http://labs.google.com/ridefinder/images/mm_20_gray.png'};
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(latLon[0],latLon[1]),
				map: map,
				icon: icon,
				content: "<div style='background:black;color:white;width:250px;height:150px;padding:10px;margin-bottom:15px'><h2>" + data[i][4] + "</h2><p>" + data[i][8] + " " + data[i][9] +"</p>" + thedate +"</div>",
				visible: true,
				title: thedate + " " + data[i][4] + " " + data[i][8] + " " + data[i][9]
						
			});
				
			var cityCircle;			
			var circleBuzz = {
			strokeColor: '#000000',
			strokeOpacity: 0.9,
			strokeWeight: 2,
			fillColor: '#6cf9ff',
			fillOpacity: 0.05,
			map: map,
			content: thedate,
			editable: false,
			zIndex: 0.5,
			radius: 5000,
			center: new google.maps.LatLng(latLon[0],latLon[1])
			};
					
			cityCircle = new google.maps.Circle(circleBuzz);
			
			var contentString = "<div style='background:black;color:white;width:350pxheight:500px;'>"+data[i][4]+"</div>";
			var infowindow = new google.maps.InfoWindow({
			content: contentString
			});
			
			google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(this.content);
			infowindow.open(map, this);
			});						
		}	
			
		var flightPath = new google.maps.Polyline({		
			path: performanceDates,
			geodesic: true,
			strokeColor: '#000000',
			strokeOpacity: 0.3,
			strokeWeight: 1.5
		});
		
		flightPath.setMap(map);
	}	
});

google.maps.event.addDomListener(window, 'load', initialize);
	
</script>
<style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map-canvas { height: 100% }
</style>

<div class="venue-details" style="display:none;position:fixed; top:5px;left:5px;right:5px;height:100px; background:black;z-index:99" id="get">
<button style="poisition:relative;right:0px" class="btn btn-success" onclick="closeGet()">X</button>
</div>

<div class="venue-details" style="display:none;position:fixed;top:110px;left:5px;width:100px;height:70%;background:black;z-index:99" id="get2">
</div>

<div id="map-canvas" style="width: 100%; height: 100%">
</div>

<script>
function pan(x,y){
var lat = x;
var lon = y;
var latLng = new google.maps.LatLng(lat, lon); //Makes a latlng
console.log(latLng);
}
function get(){
$( "#get" ).toggle();
$( "#get2" ).toggle();
}
function closeGet(){
$( "#get" ).hide();
$( "#get2" ).hide();
}
</script>
</body>
</html>


