<?php
	// Pimatic
	$pimatic['user'] = 'admin';			// Pimatic username
	$pimatic['pass'] = 'password';		// Pimatic password
	$pimatic['host'] = '192.168.1.5';	// Pimatic IP address
	$pimatic['port'] = 80;				// Pimatic port
	$pimatic['ssl']  = false;			// Use https (SSL)
	
	//Thermostaat
	$therm['id'] = 'thermostaat'; 		// ID of the thermostat device
	$therm['min'] = 5;					// Min temperature
	$therm['max'] = 30;					// Max temperature
	$therm['eco'] = 10;					// Eco temperature
	$therm['comf'] = 20;				// Comfort temperature
	
	//Temperature sensor
	$temp['id'] = 'woonkamer-temp';		// ID of the temperature sensor
	
	//Lights
	$light['id'] = 'woonkamer';			// ID of the light switch
?>