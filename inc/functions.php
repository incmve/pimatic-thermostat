<?php
	
	function getValue($var) {
		global $pimatic;
		if($pimatic['ssl']){
		    $url = 'https://';
	    } else {
		    $url = 'http://';
	    }
	    $url .= $pimatic['user'] . ":" . $pimatic['pass'] . "@" . $pimatic['host'] . ":" . $pimatic['port'] . "/api/variables/" . $var;
	   
	    $curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec ($curl);// curl to a variable
		curl_close ($curl);
		
		$result = json_decode($result, true);// decode to associative array
		$result = $result['variable']['value']; //pick desired value
		return $result;
		
    }
    function setValue($var){
	    global $pimatic;
	    if($pimatic['ssl']){
		    $url = 'https://';
	    } else {
		    $url = 'http://';
	    }
	    $url .= $pimatic['user'] . ":" . $pimatic['pass'] . "@" . $pimatic['host'] . ":" . $pimatic['port'].'/api/device/'.$var;
	    file_get_contents($url);
    }
?>