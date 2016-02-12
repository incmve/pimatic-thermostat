<?php	
	include('config.php');
	include('inc/functions.php');
	$value = 0;
	
	if(isset($_GET['sensor'])){
    	$value = getValue($temp['id'].'.temperature'); 	
    	if(!$value){
    		$value = "- ";
    	}
	}
	
	if(isset($_GET['setPoint'])){
    	$value = getValue($therm['id'].'.temperatureSetpoint');
    	
	}
	
	echo $value;
?>
