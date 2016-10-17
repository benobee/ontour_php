<?php session_start();?>
<?php
$sun = $_SESSION['nameid'];
$first = $_SESSION['first_name'];	
?>
			<div class="container venue-details">
				<div class="row">
					<div class="col-sm-6">
					</div>
					<div class="col-sm-6">
					<div class = "nav navbar">
						<h4><span class = "fa fa-check-circle"></span> Members Added!</h4>
					</div>
					<div style="font-size:14px;font-family:oswald;opacity:0.85;">
					Hi <?php echo $first;?>:<br><br>
					All selected members have been added to the day roster for the desired dates. To reconfigure the day roster, go to the day sheet of an individual day to add or remove from the lineup.<br><br>
					FROM: Management
					</div>
					<a href="#" onclick="whosin()" class="ot-button pull-right">OK</a>
					</div>
			</div>
					

