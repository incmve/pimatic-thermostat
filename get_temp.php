<?php	
	include('config.php');
	include('inc/functions.php');
	$value = getValue($temp['id'].'.temperature');
	
	if(!$value){
		$value = "- ";
	}
	echo $value.'&deg;C<BR>&nbsp;'; // Aff line-feed and space to correct for second line in eco/comf
?>
