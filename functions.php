<?php

function item_icon($theicontype)
							{	
									switch ($theicontype) 
										{
											case 'performance':
											echo "<span class ='fa fa-music'>" . " " ."</span>";
											break;
											case 'radio':
											echo "<span class='fa fa-headphones'>" . " " ."</span>";
											break;			
											case 'lodging':
											echo "<span class='fa fa-home'>" . " "."</span>";
											break;
											case 'lodging check in':
											echo "<span class='fa fa-home'>" . " "."</span>";
											break;
											case 'lodging check out':
											echo "<span class='fa fa-home'>" . " "."</span>";
											break;
											case 'flight':
											echo "<span class='fa fa-plane'>" . " " ."</span>";
											break;
											case 'drive':
											echo "<span class='fa fa-truck'>" . " " ."</span>";
											break;
											case 'van call':
											echo "<span class='fa fa-truck'>" . " " ."</span>";
											break;
											case 'meet':
											echo "<span class='fa fa-group'>" . " " ."</span>";
											break;
											case 'food':
											echo "<span class='fa fa-cutlery'>" . " " ."</span>";
											break;
											case 'recording':
											echo "<span class='fa fa-microphone'>" . " ". "</span>";
											break;
											case 'rehearsal':
											echo "<span class='fa fa-clock-o'>" . " " ."</span>";
											break;								
											case 'load in':
											echo "<span class='fa fa-suitcase'>" . " " ."</span>";
											break;
											case 'sound check':
											echo "<span class='fa fa-bullhorn'>" . " " ."</span>";
											break;
											case 'doors open':
											echo "<span class='fa fa-flag'>" . " " ."</span>";
											break;
											case 'misc':
											echo "<span class='fa fa-asterisk" . " " ."</span>";
											break;											
											default:
											echo ""; 
											break;	
										}	
							}										
?>