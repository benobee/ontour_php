<!DOCTYPE html>
<html lang="en">
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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization&libraries=places&key=<?php echo $key;?>"></script>
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
	    
		$.ajax({	
			url: 'get_events2.php',
			dataType: "json",
			data: "",								
			success:function(data){
			console.log(data);
			
			var group = _.groupBy(data, 5); 
			console.log(group);

				var performanceDates = new Array();		
				for (var i = 0; i < data.length; i++){
			
				performanceDates[i] = new google.maps.LatLng(data[i][3],data[i][4]);	
				
					var icon = {url: 'http://labs.google.com/ridefinder/images/mm_20_gray.png'};
					var marker = new google.maps.Marker({
						position: new google.maps.LatLng(data[i][3],data[i][4]),
						map: map,
						icon: icon,
						visible: true					
					});					
				}
			}
		});
	 }

google.maps.event.addDomListener(window, 'load', initialize);	
	
</script>
</head>
<body>
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
</body>
</html>


