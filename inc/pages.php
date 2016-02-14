<?php
    if(count(get_included_files()) ==1) die("Not permitted");
    
    function get_login(){
        global $app;
        if($_POST['password'] == $app['password']){
            setcookie('login', pass($app['password']), time()+3155692, "/");
            header('location: index.php');
        } else {
         ?>
            <div class="content">
                <div class="title slideDown">
    				<?php echo $app['title']; ?>
    			</div>
                <form class="fadeIn" method="post">
                    <input class="password_input" placeholder="Password" type="password" name="password"/>
                    <input class="password_submit" type="submit" value="Login"/>
                </form>
            </div>
   <?php 
        }
    }
    
    function get_thermostat(){ 
        global $pimatic;
        global $therm;
        global $temp;
        global $light;
        global $app;
    ?>
        <div style="display: none;" id="dump"></div> 
		<div class="content" unselectable="on" onselectstart="return false;" onmousedown="return false;">
    		<div class="contain">
    			<div class="title slideDown">
    				<?php echo $app['title']; ?>
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
    		</div>
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
   <?php }
?>