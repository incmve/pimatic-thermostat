<?php if(count(get_included_files()) ==1) die("Not permitted"); ?>
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
			$( "#dump" ).load( "inc/lights.php?turn=on" );
		});
		
		$(".lights-off img").click(function() {		
			$( "#dump" ).load( "inc/lights.php?turn=off" );
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
            $("#dump").load( "inc/set_temp.php?temp=" + setTemp );
            wait = false;
        }, 1500);
        
	}
	
	function showTemp(){
        return Math.floor(setTemp) + '<small>' + String(setTemp.toFixed(1)).replace(Math.floor(setTemp), '') + '</small>';
	}
	
	function poll(){
		if(!wait){
		    $("#get_temp .val").load( "inc/get_temp.php?sensor" );
		    $.get( "inc/get_temp.php?setPoint", function( data ) {
              setTemp = parseFloat(data);
            });
		    $("#set_temp .val").html(showTemp());
	    }
	}
	
	setInterval(function(){ poll(); }, <?php echo $pimatic['poll']; ?>);

</script>