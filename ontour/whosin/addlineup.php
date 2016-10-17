<?php session_start(); ?>
<?php ob_start(); ?>
<?php
$sun = $_SESSION['nameid']; 
?>
  <script>
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'ontour/whosin/invite.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/whosin/whosin.php" );
            }
          });

        });

      });
 </script>

<!-- /accounts --- for managing artists --->
	<div id="window" class="venue-details" style="border-radius:4px;margin-top:10px;margin-bottom:20px;box-shadow: 5px 10px 25px #323333;">
		<div style="padding:5px;border-radius:4px;">	
			<form>					
						<div class="row" style="margin-top:5px;">
							<div class="col-sm-6">	  
								<div class="form-group">
									<div>Name</div>
									<input type="text" class="ot-standout" id="username" autocomplete="off" name="name" placeholder="Enter full name" required>
									<input class="ot-standout hidden" id="fb_id" autocomplete="off" name="fb_id">
								</div>
							</div>
							<div class ="col-sm-6">	  
								<div class="form-group">
									<div>E-mail</div>
									<input type="email" class="ot-standout" id="email" autocomplete="off" name="username" placeholder="dude@somewhere.com" required>
								</div>
							</div>
							<div class ="col-sm-6">	  
								<div class="form-group">
									<div>Role</div>
									<input type="text" class="ot-standout" id="role" autocomplete="off" name="role" required>
								</div>
							</div>
							<div class ="col-sm-6">	  
								<div class="form-group">
									<div>Group</div>
									<select type="text" class="ot-standout" id="group" autocomplete="off" name="group" required>
									  <option></option>
									  <option value="6">Management</option>
									  <option value="2">Publicity</option>
									  <option value="7">Booking</option>
									  <option value="1">Artists/Performers</option>
									  <option value="10">Support Crew</option>										  
									</select>
								</div>
							</div>
								<div class="hidden">
									<input type="text" name="parent" value="<?php echo $sun;?>">
									<input type="text" name="band_id" value="<?php echo $sun;?>">
								</div>
						<div class ="col-sm-12" style="margin-bottom:15px;">
							<label for="invite">Send Email Notification On Submit					
							<input type ="checkbox" class="form-control" id="invite" name="invite" value="1" style="width:20px;height:20px;" checked></input></label>
						</div>
						</div>
						
					<div class = "navbar">						
						<a class = "btn btn-default pull-left ot-button" onclick="closeWindow()">Close</a>
						<button type="submit" class = "btn btn-success pull-right btn-lg ot-button" style= "width:80px;height:44px;"><span class = "fa fa-plus-circle"></span> Add</button>
					</div>
				
			</form>				
		</div>	
	</div>
<script>
function dropDayRoster()
{
          $.ajax({
            type: 'get',
            url: 'ontour/whosin/invite.php',
            data: $('form').serialize(),
            success: function () {
              $( "#calendar-waterfall" ).load( "ontour/whosin/whosin.php" );
            }
          });
}
</script>
