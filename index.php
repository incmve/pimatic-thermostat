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
		<title><?php echo($therm['title']); ?></title>
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
			
			var setTemp = <?php echo getValue($therm['id'].'.temperatureSetpoint'); ?>;
			var timer;
			var wait = false;
			
			$(document).ready(function() {
				
				poll();

				$(".up").click(function() {	
    				setTemp = setTemp + .5;
					updateTemp();
				});
				$(".down").click(function() {		
					setTemp = setTemp - .5;
					updateTemp();
				});
				
				// MODES
				$(".eco").click(function() {
    				setTemp = <?php echo $therm['eco']; ?>;		
					updateTemp();
				});
				$(".comf").click(function() {		
					setTemp = <?php echo $therm['comf']; ?>;		
					updateTemp();
				});
				
				// LIGHTS
				$(".lights-on img").click(function() {		
					$( "#dump" ).load( "lights.php?turn=on" );
				});
				
				$(".lights-off img").click(function() {		
					$( "#dump" ).load( "lights.php?turn=off" );
				});
				
			});
			
			function updateTemp(){
    			wait = true;
    			if(setTemp > 30) {
        			setTemp = 30;
    			}
    			if(setTemp < 5) {
        			setTemp = 5;
    			}
    			
    			$("#set_temp .val").html(showTemp());   			
    			clearTimeout(timer);
    			timer = setTimeout(function(){
                    		$("#dump").load( "set_temp.php?temp=" + setTemp );
                    		wait = false;
                	}, 1500);
                
			}
			
			function showTemp(){
                return Math.floor(setTemp) + '<small>' + String(setTemp.toFixed(1)).replace(Math.floor(setTemp), '') + '</small>';
			}
			
			function poll(){
				if(!wait){
			    		$("#get_temp .val").load( "get_temp.php?sensor" );
			    		$.get( "get_temp.php?setPoint", function( data ) {
                  				setTemp = parseFloat(data);
                			});
			    		$("#set_temp .val").html(showTemp());
				}
			}
			
			setInterval(function(){ poll(); }, <?php echo $pimatic['poll']; ?>);
		
		</script>
	</head>
	<body>
		<div style="display: none;" id="dump"></div> 
		<div class="content" unselectable="on" onselectstart="return false;" onmousedown="return false;">
			<div class="title slideDown">
				<?php echo($therm['title']); ?>
			</div>
			
			<div class="middle fadeIn">
				<div class="grad-border">
					<div class="fadeIn" id="set_temp">
    					<span class="set">SET</span>
    					<span class="val"></span>
    					<span class="deg">&deg;C</span>
					</div>
				</div>
			</div>
			<div class="left slideRight">
				<div class="down-border">
					<div class="down">
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
					Eco modus<br/><span class="glass"><?php echo("(".$therm['eco']." &deg;C)"); ?></span>
				</div>
				<div class="comf">
					Comfort<br/><span class="glass"><?php echo("(".$therm['comf']." &deg;C)"); ?></span>
				</div>
				<div id="get_temp">
                    <span class="val"></span>
                    &deg;C
				</div>
				<?php if($light['id']){ ?>
				<div class="lights">
					<div class="lights-off">
						<img src="images/light-off.png" alt=""/>
					</div>
					<div class="lights-on">
						<img src="images/light-on.png" alt=""/>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</body>
</html>
