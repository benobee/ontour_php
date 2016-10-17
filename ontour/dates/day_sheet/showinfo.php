

			<div>
<?php

$admin = $_SESSION['admin'];
if ($admin == 1)
			{
				$sun = $nameid;
				$hide = "";
				$admin = true;
			}			
		else 
			{
				$sun = $nameid;
				$hide = "hidden";
				$admin = false;

			}

?>	
			<div id="daySettings" style="display:none;">
			<?php include "ontour/dates/day_sheet/daysettings.php";?>						
			</div>
			
			
					<div class = "nav navbar" style="margin-top:8px;">
						<div class="pull-left">	
							<div  style="font-size: 24px; font-family:oswald;">
								<div style="font-size: 22px;">
									<?php echo strtoupper(date("M . d", strtotime($showdate)));?>		
								</div>
							</div>
						</div>
						<div class="pull-right <?php echo $hide;?>">
							<button onclick="dayInfo();" style="border-width:0px;" class="ot-button"><span class="fa fa-gear"></span> Day Info</button> 
							<button onclick="addDayItem()" style="border-width:0px;" class="ot-button"><span class="fa fa-plus-circle"></span> Day Item</button>
						</div>
					</div>
					<div style="font-size:18px;"><?php echo $venuecity; ?></div>
					<div style="font-size:16px;"><?php echo $venue; ?></div>
					
					<div style="font-family:oswald;margin-top:10px;">
						<?php echo $type . " " . $typeword . " " . $status_word ." ". "<span style='color:" . $color ."' class='fa fa-flag'></span><br>";?>
					</div>				
					<div style="font-size:16px;"><?php echo $tour; ?></div>
			</div>