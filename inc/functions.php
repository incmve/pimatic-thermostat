<?php
	if(count(get_included_files()) ==1) die("Not permitted");
	
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
    
    function loggedIn(){
        global $app;
        if($_COOKIE['login'] == pass($app['password']) or $app['password'] == '') {
            return true;
        } else {
            return false;
        }
    }
    
    function pass($string){
    	$salt = "Dc9ri12orRSDhNUd";
    	$pepper = "5%1vF3x5";
    	$string = md5($pepper.$string);
    	return hash("sha256", md5($salt.$string).sha1($string));
    }
    
?>