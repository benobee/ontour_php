<?php session_start(); ?>	
<script src="js/jquery.circliful.min.js"></script>
	<style>
		.toggle{
		background: #2D2D2D;
		color:white;
		padding:10px;
		border-radius: 4px;
		text-align: center;
		border-color: #2D2D2D;
		opacity:0.81;
		margin-top:10px;
		}
		.art-img {
		background-position:50% 11%;
		background-repeat:no-repeat;
		height:100%;
		background-size:cover;
		border-radius:4px;
		}
		
		#fans li {
		display: inline-block;
		list-style-type: none;
		margin-top:10px;
		margin-right:5px;
		height:50px;
		width:50px;
		border-radius:25px;
		padding:20px;
		}
		#info li {
		display: inline-block;
		list-style-type: none;
		padding-right:10px;
		}
		#last_fm_tags li {
		display: inline-block;
		list-style-type: none;
		padding-right:5px;
		padding-left:5px;
		border-radius:4px;
		background:#707070;
		margin-right:2px;
		}
		.meter{
		width:100px;
		height:100px;
		border-radius:50px;
		background: red;
		}
	</style>

				<?php
					require "dbconnect.php";
					require "handler.php";
					include "classes.php";
					
					$id = $_SESSION['nameid'];
									
					$query = "SELECT * FROM events WHERE id = $id LIMIT 1";
					$sun = $_SESSION['username'];

					$showQuery = "SELECT * FROM shows WHERE id = $id LIMIT 1";
					$eventQuery = $handler->query("SELECT * FROM events WHERE session_username ='$sun' ORDER by event_time");
					$obj_event = $eventQuery->FetchALL(PDO::FETCH_CLASS, 'Event');
					
					$admin = $_SESSION['admin'];
					$artist_name = $_SESSION['thename'];
					
				?>				
				<?php
				$user = mysqli_query($con,"SELECT * FROM users WHERE username = '$sun'");
				while($row = mysqli_fetch_assoc($user))
					{
						$phone = $row['phone'];
						$first_name = $row['first_name'];
						$last_name = $row['last_name'];
					}
					
				$nameid = $_SESSION['nameid'];	
				
				
				$artist = mysqli_query($con,"SELECT * FROM band_names WHERE id = '$nameid'");
				while($row = mysqli_fetch_assoc($artist))
					{
						$artist_id = $row['artist_id'];
						$_SESSION['artist_id'] = $artist_id; 
					}

				if($admin == 1)
					{
						$hide = "";
						$leave = "hidden";
					}
				else
					{
						$hide = "hidden";
						$leave = "";
					}
					
				$searchArtist = urlencode($artist_name);					
				
				?>
				
<!-- BODY TAG -->						
			
<script>
var windows = document.getElementById('window');
windows.setAttribute('style','min-height:'+ screen.height +'px');
</script>
<script>
var artist = '<?php echo $artist_id;?>';
var artist_display_name = '<?php echo $searchArtist;?>';
if (artist){

	document.getElementById('page_message').innerHTML = '<span style="position:absolute;top:50%;left:40%"><h6>Searching artist information...</h6><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img></span>';
	$.ajax({	
		url: 'http://developer.echonest.com/api/v4/artist/profile?bucket=songs&bucket=id:facebook&bucket=id:musicbrainz&bucket=urls&bucket=biographies&bucket=genre&bucket=artist_location&bucket=hotttnesss_rank&bucket=familiarity_rank&bucket=reviews&bucket=terms&bucket=video&bucket=years_active&bucket=doc_counts&bucket=blogs&bucket=hotttnesss&bucket=id:spotify&bucket=id:songkick&bucket=familiarity&bucket=discovery',
		dataType: "jsonp",
		data: {
			id: artist,
			api_key: "UJPOPHKAGZ3QX5IXP",
            format:"jsonp"			
		}, 
		
		success:function(data){
		
			$.ajax({	
				url: 'http://developer.echonest.com/api/v4/artist/similar?bucket=artist_location&bucket=hotttnesss_rank&bucket=hotttnesss&bucket=familiarity',
				dataType: "jsonp",
				data: {
					id: artist,
					api_key: "UJPOPHKAGZ3QX5IXP",
					format:"jsonp",
					results: "100",
					min_familiarity: "0.4",
					max_familiarity: "0.8"
				},
				success:function(data){
				console.log(data);
				}
			});
		
			document.getElementById('page_message').innerHTML = '';
			console.log(data);			
			var artist_name = data.response.artist.name;
			var famous = data.response.artist.familiarity;
			var fame = Math.floor((famous / 1) * 100);
			var blogs = data.response.artist.doc_counts.blogs;
			var news = data.response.artist.doc_counts.news;
			var songs = data.response.artist.doc_counts.songs;
			var video = data.response.artist.doc_counts.video;
			
/* 			if (data.response.artist.genres[0] != null){
				var genre = data.response.artist.genres;
				console.log("has genre");
				document.getElementById('genreTitle').innerHTML = '<div style="font-size:9px">Genre(s)</div>';
				
				for (var i = 0; i < genre.length; i++){
				console.log(data.response.artist.genres[i].name);
				
				var f = document.createElement("li");
				var t = document.createTextNode(data.response.artist.genres[i].name);
				
				f.appendChild(t);
				document.getElementById('genres').appendChild(f);
				
				
				
				}
			}
			else{
				console.log("no genre");
			} */

			document.getElementById('blogs').innerHTML = '<div style="font-size:9px;margin-top:10px;">Blog Mentions</div><div style="font-size:12;color:#6cf9ff">' + blogs + '</div>';
			
			document.getElementById('news').innerHTML = '<div style="font-size:9px">News Mentions</div><div style="font-size:12;color:#6cf9ff">' + news + '</div>';
			
			document.getElementById('songs').innerHTML = '<div style="font-size:9px">Songs</div><div style="font-size:12;color:#6cf9ff">' + songs + '</div>';
			
			document.getElementById('video').innerHTML = '<div style="font-size:9px">Video</div><div style="font-size:12;color:#6cf9ff">' + video + '</div>';
			
			var buzzy = data.response.artist.hotttnesss;
			var buzz = Math.floor((buzzy / 1) * 100);
			
			document.getElementById('famous').innerHTML = '<div style="font-size:12px">FAMOUS METER</div><div id="fame" style="color:#696969" data-dimension="100" data-text="'+ fame +'%" data-info="Fame" data-width="5" data-fontsize="16" data-percent="'+ fame +'" data-fgcolor="#6cf9ff" data-bgcolor="#eee" data-type="half" data-fill="#ddd"></div>';
			
			document.getElementById('mybuzz').innerHTML = '<div style="font-size:12px">BUZZ METER</div><div id="buzz" style="color:#696969" data-dimension="100" data-text="'+ buzz +'%" data-info="Fame" data-width="5" data-fontsize="16" data-percent="'+ buzz +'" data-fgcolor="#ff0000" data-bgcolor="#eee" data-type="half" data-fill="#ddd"></div>';
			
			$( document ).ready(function() {
			$('#fame').circliful();
			$('#buzz').circliful();
			});
			
			
			if (data.response.artist.artist_location){
			var artist_location = data.response.artist.artist_location.location;
			}		
				$.ajax({	
						url: 'http://ws.audioscrobbler.com/2.0/?method=artist.getinfo',
						dataType: "jsonp",
						data: {
							format:"json",
							api_key: "ff0184b483fc12e0446690b9c38ed59b",
							artist: artist_name
						}, 
						
						success:function(data){		
						console.log(data);
						
						var last_fm_image = data.artist.image[4]["#text"];
						var image = document.getElementById('image');
												
							if (last_fm_image){
							image.setAttribute('style','height:100%;background-image: url(' + last_fm_image + ')');
							}
							else{
							
							$.ajax({	
								url: 'http://developer.echonest.com/api/v4/artist/profile?bucket=images',
								dataType: "jsonp",
								data: {
									id: artist,
									api_key: "UJPOPHKAGZ3QX5IXP",
									format:"jsonp"			
								}, 
								
								success:function(data){
								var echo_image = data.response.artist.images[0].url;
								image.setAttribute('style','height:100%;background-image: url(' + echo_image + ')');
								}
							});
							
							}						
														
							if (data.artist.tags){
							
							var tag = data.artist.tags.tag;
							//console.log(tag);
							
								//document.getElementById('last_fm_tags').innerHTML = '<span>' + tag.tag[0].name + '</span>';
								for (name in tag){
								
								//console.log(tag[name]);
								
									var f = document.createElement("li");
									var t = document.createTextNode(tag[name].name);

									f.appendChild(t);
									document.getElementById('last_fm_tags').appendChild(f);
								}
							}
							if (data.artist.stats.listeners){
								document.getElementById('last_fm_listeners').innerHTML = '<span><div style="font-size:9px">Last.fm Listeners</div><div style="color:#6cf9ff">' + data.artist.stats.listeners + '</div></span>';
							}
							
							if (data.artist.stats.playcount){
								document.getElementById('last_fm_playcount').innerHTML = '<span><div style="font-size:9px">Last.fm Play Count</div><div style="color:#6cf9ff">' + data.artist.stats.playcount + '</div></span>';
							}
						}
					});
					
			if (data.response.artist.foreign_ids[0].catalog == "facebook"){
			var facebook = data.response.artist.foreign_ids[0].foreign_id;
			var fb_id = (facebook.split("facebook:artist:").pop());
			
					$.ajax({	
						url: 'http://graph.facebook.com/' + fb_id,
						dataType: "jsonp",
						data: {
							format:"jsonp"
						}, 
						
						success:function(data){		
						console.log(data);
						if (data.genre){
								document.getElementById('genre').innerHTML = '<span>' + data.genre + '</span>';
							}
						if (data.current_location){
								document.getElementById('location').innerHTML = '<span>' + data.current_location + '</span>';
							}
						else
							{
								document.getElementById('location').innerHTML = '<span>' + artist_location + '</span>';
							}
						
						if (data.likes){
								document.getElementById('fb_likes').innerHTML = '<div style="margin-bottom:10px"><div style="font-size:9px"><span class="fa fa-facebook-square"></span> Likes</div><div style="color:#6cf9ff">'+ data.likes + '</div></div>';
							}
						
						}
					});
			}
			else if (data.response.artist.foreign_ids[0].catalog == "musicbrainz"){
			console.log("Musicbrainz");	
				if (artist_location){
				document.getElementById('location').innerHTML = '<span>' + artist_location + '</span>';	
				}
			}
			else{
				if (artist_location){
				document.getElementById('location').innerHTML = '<span>' + artist_location + '</span>';
				}
			}

		}	
	});
	
}

		
</script>
<!-- Content -->
<div class="container" style="background:#2D2D2D">				
<div id="window">
	<div class="venue-details" style="margin-top:15px">
		<div class="pull-right <?php echo $leave; ?>">
			<a type="button" style="width:40px;height:40px;" onclick="" id="leaveLineupButton" class="btn btn-default toggle"><span class="fa fa-gear"></span></a>
		</div>
	</form>
		<div class ="row" style="margin-bottom:60px">
			<div class="col-sm-6" style="margin-bottom:35px">									
					<div style="height:250px">
						<div id="page_message"></div>
						<div class="art-img" id="image">
	
						<div style="position:absolute; right:20px;font-size:10px; opacity:0.85;background:rgba(0,0,0,0.40);border-radius:4px;bottom:0px;padding:5px;" id="genre"></div>
						<div style="font-size:14px; border-radius:4px;opacity:0.95; position:absolute; left:20px;top:0px;margin-top:5px;padding:5px;background:rgba(0,0,0,0.50);" id="location"></div>
						</div>
					</div>
					<div style="position:absolute">
						<div style="margin-top:5px;font-size:10px" id="last_fm_tags"></div>
					</div>
			</div>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-xs-6">							
							<div id="famous"></div>							
							<div id="mybuzz"></div>
						<div class="row">
							<div class="col-xs-6">
								<div id="genreTitle"></div>
								<div style="font-size:12; color:#6cf9ff; list-style-type: none;" id="genres"></div>
							</div>
							<div class="col-xs-6 hidden">
								<div style="font-size:9px" id="similar">Similar Artists</div>
							</div>
						</div>
					</div> 
					<div class="col-xs-6">
						<div style="postion:absolute">
								<div id="fb_likes"></div>
								<div id="last_fm_listeners"></div>
								<div id="last_fm_playcount"></div>
								<div id="fans"></div>
								
						</div>
						<div style="postion:absolute">
								<div id="blogs"></div>
								<div id="news"></div>
								<div id="songs"></div>
								<div id="video"></div>
						</div>
						
					</div>

				</div>
			</div>
			
		</div>
		<img style="border-radius:4px" width="90" src="img/echonest.jpg"></img>
	</div>
	<div class="venue-details" style="margin-top:10px;margin-bottom:60px;">
	<h5>About This Page</h5>
	<p>The Famous Meter and the Buzz meter are displaying an aggregated number from a variety of sources. This includes, videos, images, streaming plays, social media metrics, blog and media mentions and as much information that can possibly be located. It's meant solely to gauge the digital footprint of an artist.
	<p>If you don't see any information here please contact us at info@ontour.voyage for support.</p>
	</div>
</div>	
</div>		 
<script>

</script>	  
	
<script>
$(window).resize(function() {
$('#resize').height($(window).height() - 46);
});
$(window).trigger('resize');

</script>
