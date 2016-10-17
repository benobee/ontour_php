<div id="wrapper">
<iframe src="map2.php" width="100%" height="100%"></iframe>
</div>
<script>
	$(function(){
		var windowH = $(window).height();
		var wrapperH = $('#wrapper').height();
		if(windowH > wrapperH) {                            
			$('#wrapper').css({'height':($(window).height() -80)+'px'});
		}                                                                               
		$(window).resize(function(){
			var windowH = $(window).height();
			var wrapperH = $('#wrapper').height();
			var differenceH = windowH - wrapperH;
			var newH = wrapperH + differenceH;
			var truecontentH = $('#truecontent').height();
			if(windowH > truecontentH) {
				$('#wrapper').css('height', (newH)+'px');
			}

		})          
	});
</script>