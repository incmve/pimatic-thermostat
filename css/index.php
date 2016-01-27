<?php	
	include('config.php');
	include('inc/functions.php');
	$url = "http://" . $pimatic['user'] . ":" . $pimatic['pass'] . "@" . $pimatic['host'] . ":" . $pimatic['port'] . "/api/variables/";
	if(!file_get_contents($url)){
		include('error.php');
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Thermostaat</title>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-icon" href="icon.png">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
		<script src="js/jquery.min.js"></script>
		<script src='js/fastclick.js'></script>
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="css/animations.css" type="text/css" media="screen" charset="utf-8">
		<script>
			$(function() {
			    FastClick.attach(document.body);
			});
			var setTemp = 0;
			$(document).ready(function() {
				poll();
				$(".up").click(function() {	
					$( "#set_temp" ).load( "set_temp.php?up=1" );
				});
				$(".lower").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?lower=1" );
				});
				$(".eco").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?eco=1" );
				});
				$(".comf").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?comf=1" );
				});
				
			});
			function poll(){
			    $( "#get_temp" ).load( "get_temp.php" ); 
			    $( "#set_temp" ).load( "set_temp.php" ); 
			}
			setInterval(function(){ poll(); }, 2500);
		</script>
	</head>
	<body>
		<div class="content" unselectable="on" onselectstart="return false;" onmousedown="return false;">
			<div class="title slideDown">
				Thermostaat
			</div>
			<div class="left slideRight">
				<div class="lower-border">
					<div class="lower">
						-
					</div>
				</div>
			</div>
			<div class="middle fadeIn">
				<div class="grad-border">
					<div class="fadeIn" id="set_temp">
					</div>
				</div>
			</div>
			<div class="right slideLeft">
				<div class="up-border">
					<div class="up">
						+
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="bottom fadeInn">
				<div class="eco">
					Eco modus
				</div>
				<div class="comf">
					Comfort
				</div>
				<div id="get_temp">
		
				</div>
			</div>
		</div>
	</body>
</html>