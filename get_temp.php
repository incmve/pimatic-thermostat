<?php	
	include('config.php');
	include('inc/functions.php');
	$value = getValue($temp['id'].'.temperature');
	
	if(!$value){
		$value = "- ";
	}
	echo $value.'&deg;C';
?>