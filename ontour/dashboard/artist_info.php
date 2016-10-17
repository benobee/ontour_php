<?php session_start();?>															
<script>

function updateArtistInfo(){
	$.ajax({
		type: 'post',
		url: 'ontour/dashboard/add_artist_info.php',
		data: $('#echo').serialize(),
		success: function () {
		console.log('info added');
		}
	});
}

var artist = '<?php echo $artist_id;?>';
var artist_display_name = '<?php echo $searchArtist;?>';

if (artist){

	$.ajax({	
		url: 'http://developer.echonest.com/api/v4/artist/profile?bucket=songs&bucket=id:facebook&bucket=id:musicbrainz&bucket=urls&bucket=biographies&bucket=genre&bucket=artist_location&bucket=hotttnesss_rank&bucket=familiarity_rank&bucket=reviews&bucket=terms&bucket=video&bucket=years_active&bucket=doc_counts&bucket=blogs&bucket=hotttnesss&bucket=id:spotify&bucket=id:songkick&bucket=familiarity&bucket=discovery',
		dataType: "jsonp",
		data: {
			id: artist,
			api_key: "UJPOPHKAGZ3QX5IXP",
            format:"jsonp"			
		}, 
		
		success:function(data){
			
			document.getElementById('page_message<?php echo $artist_id;?>').innerHTML = '';
			console.log(data);
			
			var artist_name = data.response.artist.name;
			var famous = data.response.artist.familiarity;
			var fame = Math.floor((famous / 1) * 100);
						
			var buzzy = data.response.artist.hotttnesss;
			var buzz = Math.floor((buzzy / 1) * 100);
			
			var dbid = document.getElementById('dbid<?php echo $artist_id;?>');
			dbid.setAttribute('value', '<?php echo $dbid;?>');
			
			var dbfamous = document.getElementById('dbfamous<?php echo $artist_id;?>');
			dbfamous.setAttribute('value', data.response.artist.familiarity);
			
			var dbbuzz = document.getElementById('dbbuzz<?php echo $artist_id;?>');
			dbbuzz.setAttribute('value', data.response.artist.hotttnesss);
			
			updateArtistInfo();
			
			document.getElementById('famous<?php echo $artist_id;?>').innerHTML = '<div id="fame<?php echo $artist_id;?>" style="color:#FCF7E4" data-dimension="60" data-text="'+ fame +'%" data-info="Fame" data-width="3" data-fontsize="10" data-percent="'+ fame +'" data-fgcolor="#456A8F" data-bgcolor="#242424" data-type="half" data-fill="#242424"></div><div style="font-size:9px;position:relative;bottom:31px;left:5px">FAMOUS METER</div>';
			
			document.getElementById('mybuzz<?php echo $artist_id;?>').innerHTML = '<div id="buzz<?php echo $artist_id;?>" style="color:#FCF7E4" data-dimension="60" data-text="'+ buzz +'%" data-info="Fame" data-width="3" data-fontsize="10" data-percent="'+ buzz +'" data-fgcolor="#6cf9ff" data-bgcolor="#242424" data-type="half" data-fill="#242424"></div><div style="font-size:9px;position:relative;bottom:31px;left:5px">BUZZ METER</div>';
			
			$( document ).ready(function() {
			$('#fame<?php echo $artist_id;?>').circliful();
			$('#buzz<?php echo $artist_id;?>').circliful();
			});			
			
			if (data.response.artist){
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
						var image = document.getElementById('image<?php echo $artist_id;?>');
							
							var mb = data.artist.mbid;
							console.log(mb);
							var mb_id = document.getElementById('mb_id<?php echo $artist_id;?>');
							mb_id.setAttribute('value', 'musicbrainz:'+mb);	
							
							if (last_fm_image){
							image.setAttribute('style','box-shadow: inset 10px 10px 150px 38px rgba(0, 0, 0, 0.8);height:100%;background-image: url(' + last_fm_image + ')');
							
							var dburl = document.getElementById('dburl<?php echo $artist_id;?>');
							dburl.setAttribute('value', last_fm_image);
															
							updateArtistInfo();
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
								image.setAttribute('style','box-shadow: inset 10px 10px 150px 38px rgba(0, 0, 0, 0.8);height:100%;background-image: url(' + echo_image + ')');
								
								var dburl = document.getElementById('dburl<?php echo $artist_id;?>');
								dburl.setAttribute('value', echo_image);
								updateArtistInfo();
								}
							});
							
							}																				
						}
					});
					
			updateArtistInfo();
		}		
	});	
}
	
</script>

<form id="echo" name="echo" class="hidden" method="post">
<input style="background:black;color:white" id="dbfamous<?php echo $artist_id;?>" name="famous" type="text">
<input style="background:black;color:white" id="dbbuzz<?php echo $artist_id;?>" name="buzz" type="text">
<input style="background:black;color:white" id="dburl<?php echo $artist_id;?>" name="url" type="text">
<input style="background:black;color:white" id="dbid<?php echo $artist_id;?>" name="dbid" type="text">
<input style="background:black;color:white" id="mb_id<?php echo $artist_id;?>" name="mb_id" type="text">
</form>