<?php
	// Pimatic
	$pimatic['user'] = 'admin';			// Pimatic username
	$pimatic['pass'] = 'password';		// Pimatic password
	$pimatic['host'] = '192.168.1.5';	// Pimatic IP address
	$pimatic['port'] = 80;				// Pimatic port
	$pimatic['ssl']  = false;			// Use https (SSL)
	$pimatic['poll'] = 5000;          	// Polling interval
	
	//Thermostaat
	$therm['id'] = 'thermostaat'; 		// ID of the thermostat device
	$therm['title'] = 'thermostaat';    // What is the name on the screen
	$therm['eco'] = 10;					// Eco temperature
	$therm['comf'] = 20;				// Comfort temperature
	
	//Temperature sensor
	$temp['id'] = 'woonkamer-temp';		// ID of the temperature sensor
	
	$light['id'] = 'woonkamer';			// ID of the light switch
	//$light['id'] = '';				// Make empty if lights are not used
?>
