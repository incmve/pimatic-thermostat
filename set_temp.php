<?php	
	include('config.php');
	include('inc/functions.php');
	if(isset($_GET)){				
		$value = getValue($therm['id'].'.temperatureSetpoint');
		if($_GET['temp'] == 'up' and $value < $therm['max']){
			$value += .5;
		}
		if($_GET['temp'] == 'down' and $value > $therm['min']){
			$value -= .5;
		}
		if($_GET['temp'] == 'eco'){
			$value = $therm['eco'];
		}
		if($_GET['temp'] == 'comf'){
			$value = $therm['comf'];
		}
		setValue($therm['id'].'/changeTemperatureTo?temperatureSetpoint='.$value);
	}
	$temp = getValue($therm['id'].'.temperatureSetpoint');
	$temp = number_format($temp, 1, '.', '');
	$temp_high = substr($temp, 0, strpos($temp, "."));
	$temp_low = str_replace($temp_high.'.', "", $temp);
	$temp = $temp_high.'<small>.'.$temp_low.'</small>';
	echo '<span class="set">SET</span>'.$temp.'<span class="deg">&deg;C</span>';
?>