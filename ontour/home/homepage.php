<?php include_once("ontour/home/analyticstracking.php") ?>
<div id="wrapper" class="container ot-img" style="padding-left:0px;padding-right:0px;">
<div class="ot-text ot-container" style="height:100%;position:relative;">
		<div id="logNav" class = "container-fluid pull-right" style="z-index:10;margin-top:20px">										
		</div>			
	<div id="txt">
		<div class="ot-text" id="logo">	
			<center style="margin-top:180px">
					<h1 style="font-family: 'Special Elite', cursive;">OnTour <small style="font-size:19px;color:#33FFEB">BETA</small></h1>
				<div id="message"></div>	
				<div class="hidden">	
					<h2 class="text-other hidden-xs ot-container" style="color: #FCF7E4; font-size:24px;padding-left:20px;padding-right:20px;width:450px;border-radius:4px;background: rgba(0, 0, 0, 0.33);">
							Connect with your audience
					</h2>
					<h2 class="text-other visible-xs ot-container" style="color: #FCF7E4; font-size:16px;padding-left:20px;padding-right:20px;background: rgba(0, 0, 0, 0.33);">
							Connect with your audience
					</h2>
				</div>
				<div>
				<button class="btn btn-default" style="box-shadow: 2px 0px 25px #323333;border-radius:4px;margin-top:10px;color:#FFFBE3;background:#000000;margin-bottom:10px;" onclick="showOTLog()" style="margin-top:35px" id="log"><span class = "fa fa-sign-in"></span> Log In</button>
				</div>
				<div>
				<button id="button" style="box-shadow: 2px 0px 25px #323333;border-radius:4px;margin-top:10px;color:#FFFBE3;background:#000000;margin-bottom:10px;" onclick="create()" type="button" class="hidden btn btn-default ot-log"><span class = "fa fa-pencil-square-o"></span> Sign Up</button>
				</div>
			</center>				
		</div>		
	</div>
</div>
</div>
<div style="min-height:350px;" id="pageContent">
</div>
<script>
$( window ).one("scroll", function() {
  $( "#pageContent" ).load( "ontour/home/webpage.php" ).fadeIn("slow");
});
</script>				
<script>

	$(function(){
		var windowH = $(window).height();
		var wrapperH = $('#wrapper').height();
		if(windowH > wrapperH) {                            
			$('#wrapper').css({'height':($(window).height())+'px'});
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