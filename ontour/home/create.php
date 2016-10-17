		<div id="new" class="row">
			<div class="col-xs-12">
					<form method="post" id="createform">
							<p class="ot-text">Enter your info to create an account</p>
							<div class="row">
								<div class="col-xs-12">
								<input type="text" class="hidden" name="new">
									<div class="form-group">					
										<input type="text" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:5px;background: black;box-shadow: 2px 0px 25px #323333;" class="form-control" id="email" name="email" autocomplete="off" placeholder="Email" required>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="text" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:5px;background: black;" class="form-control" id="first" name="first" autocomplete="off" placeholder="First Name" required>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="text" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:5px;background: black;box-shadow: 2px 0px 25px #323333;" class="form-control" id="last" name="last" autocomplete="off" placeholder="Last Name" required>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="password" style="font-size: 18px; border-width:0px; color: #FCF7E4; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:5px;background: black;box-shadow: 2px 0px 25px #323333;" class="form-control" oninput="check()" id="password" name="password" autocomplete="off" placeholder="Password" required>				  
									</div>		
								</div>
								<div class="col-xs-12">
									<div class="form-group">					
										<input type="password" style="font-size: 18px; border-width:0px; color: #D92B2B; border-radius:0px;width:280px;height:50px;line-height:20px;margin-bottom:20px;background: black;box-shadow: 2px 0px 25px #323333;" class="form-control" oninput="check()" id="repassword" name="confirm_password" placeholder="Retype Password" required>		  
									</div>		
								</div>						
								<div class="col-xs-12">
									<a type="button" style="width:280px;box-shadow: 2px 0px 25px #323333" onclick="send()" class="btn btn-info ot-log"><span class = "fa fa-sign-in"></span> Submit</a>
								</div>

							</div>	
					</form>
				</div>	
		</div>

<script>

function send(){

	$.ajax({
            type: 'post',
            url: 'new_user.php',
            data: $('#createform').serialize(),
            success: function () {
			
			$( "#confirm" ).show();
			$( "#new" ).hide();
				
			}
	});
}

function check(){
    var pass = $('#password').val();
    var repass = $('#repassword').val();
	var color = document.getElementById('repassword');
	
    if(($('input[name=password]').val().length == 0) || ($('input[name=confirm_password]').val().length == 0)){
        $('#password').addClass('has-error');
    }
    else if (pass != repass) {
        $('#password').addClass('has-error');
        $('#repassword').addClass('has-error');
    }
    else {
		color.setAttribute('style','font-size: 18px; border-width:0px; color: #1BF254; border-radius:0px;width:280px;height:50px;padding-left:12px;line-height:50px;margin-bottom:20px;background: black;');
    }
}

</script>
<div id="confirm" style="display:none;color: #FCF7E4;padding:15px">
<h3>We sent you an email with a confirmation link.</h3>
<h3>Click the link to verify your account and you'll be all good to go.</h3>
</div>
