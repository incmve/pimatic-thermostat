<?php	
	include('config.php');
	include('inc/functions.php');
	if($pimatic['ssl']){
		$url = 'https://';
	} else {
		$url = 'http://';
	}
	$url .= $pimatic['user'] . ":" . $pimatic['pass'] . "@" . $pimatic['host'] . ":" . $pimatic['port'] . "/api/variables/";
	if(!file_get_contents($url)){
		include('error.php');
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<link rel="apple-touch-icon" href="icon.png">
		<title>Thermostat</title>
		<preference name="DisallowOverscroll" value="true" />	
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
					$( "#set_temp" ).load( "set_temp.php?temp=up" );
				});
				$(".lower").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?temp=down" );
				});
				$(".eco").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?temp=eco" );
				});
				$(".comf").click(function() {		
					$( "#set_temp" ).load( "set_temp.php?temp=comf" );
				});
				
				// LIGHTS
				$(".lights-on img").click(function() {		
					$( "#light" ).load( "lights.php?turn=on" );
				});
				
				$(".lights-off img").click(function() {		
					$( "#light" ).load( "lights.php?turn=off" );
				});
				
			});
			function poll(){
			    $( "#get_temp" ).load( "get_temp.php" ); 
			    $( "#set_temp" ).load( "set_temp.php" ); 
			}
			setInterval(function(){ poll(); }, <?php if( $pimatic['poll'] ) { echo $pimatic['poll']; } else { echo 5000; } ?>);
		</script>
	</head>
	<body>
		<div style="display: none;" id="light"></div> 
		<div class="content" unselectable="on" onselectstart="return false;" onmousedown="return false;">
			<div class="title slideDown">
				<?php echo($therm['title']); ?>
			</div>
			
			<div class="middle fadeIn">
				<div class="grad-border">
					<div class="fadeIn" id="set_temp">
					</div>
				</div>
			</div>
			<div class="left slideRight">
				<div class="lower-border">
					<div class="lower">
						-
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
					Eco modus<br><?php echo("(".$therm['eco']." &deg;C)"); ?>
				</div>
				<div class="comf">
					Comfort<br><?php echo("(".$therm['comf']." &deg;C)"); ?>
				</div>
				<div id="get_temp">
		
				</div>
				<div class="lights">
					<div class="lights-off">
						<img src="images/light-off.png" alt=""/>
					</div>
					<div class="lights-on">
						<img src="images/light-on.png" alt=""/>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
