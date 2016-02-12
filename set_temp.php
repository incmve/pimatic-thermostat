<?php	
	include('config.php');
	include('inc/functions.php');
	if(isset($_GET['temp'])){
    	setValue($therm['id'].'/changeTemperatureTo?temperatureSetpoint='.$_GET['temp']);				
	}
?>