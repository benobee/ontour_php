<?php session_start();
$image = $url;
?>															
<script>
			document.getElementById('page_message<?php echo $artist_id;?>').innerHTML = '<span style="position:absolute;top:50%;left:40%"><h6>Getting artist information...</h6><img class="venue-details" style="border-radius:20px" src="img/ajax-loader.gif"></img></span>';
	
			document.getElementById('page_message<?php echo $artist_id;?>').innerHTML = '';
			
			
			
			var famous ='<?php echo $famous;?>';
			var fame = Math.floor((famous / 1) * 100);	
			
			var buzzy ='<?php echo $buzz;?>';
			var buzz = Math.floor((buzzy / 1) * 100);
			
			document.getElementById('famous<?php echo $artist_id;?>').innerHTML = '<div id="fame<?php echo $artist_id;?>" style="color:#FCF7E4" data-dimension="60" data-text="'+ fame +'%" data-info="Fame" data-width="3" data-fontsize="10" data-percent="'+ fame +'" data-fgcolor="#456A8F" data-bgcolor="#242424" data-type="half" data-fill="#242424"></div><div style="font-size:9px;position:relative;bottom:31px;left:5px">FAMOUS METER</div>';
			
			document.getElementById('mybuzz<?php echo $artist_id;?>').innerHTML = '<div id="buzz<?php echo $artist_id;?>" style="color:#FCF7E4" data-dimension="60" data-text="'+ buzz +'%" data-info="Fame" data-width="3" data-fontsize="10" data-percent="'+ buzz +'" data-fgcolor="#6cf9ff" data-bgcolor="#242424" data-type="half" data-fill="#242424"></div><div style="font-size:9px;position:relative;bottom:31px;left:5px">BUZZ METER</div>';
				
			$( document ).ready(function() {
			$('#fame<?php echo $artist_id;?>').circliful();
			$('#buzz<?php echo $artist_id;?>').circliful();
			});			
				
</script>
