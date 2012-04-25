<?php
/*
Plugin Name: Calotor Calorie Counter
Plugin URI: http://www.calotor.com
Description: Figure out your basal metabolic rate
Author: Lucian Apostol
Version: 0.2
Author URI: http://www.lucianapostol.com
*/

function calotor() 
{
  ?>
	<script type="text/javascript">
		function mod(div,base) {
				return Math.round(div - (Math.floor(div/base)*base));
		}


		function bmr_calculator(formhandler)  {
			
			var w = formhandler.bmr_weight.value * 1;
			var a = formhandler.bmr_age.value * 1;

			displaybmr = (Math.round( (10 * w * 0.4535 ) + ( 5 * 180 ) - ( 5 * a )  + 66.5       ));
			var rvalue = true;
			if ( (w <= 35) || (w >= 500)  || (a <= 1) || (a >= 120) ) {
				document.getElementById("bmr_result").innerHTML = "Invalid data";
				rvalue = false;
				return false;
			}
			if (rvalue) {
					document.getElementById("bmr_result").innerHTML = "Your BMR is: " + displaybmr;
			}


			return false;
		}
	</script> 

	<form id="calotorform" onsubmit="return bmr_calculator(this);" method="post">
		Weight: <input type="text" name="bmr_weight" id="bmi_weight" size="9"; /> lbs.<br />
		Age: <input type="text" name="bmr_age" id="bmr_age" size="9"; /> years <br />
		<br><input type="submit" name="submit" id="submit" value="Calculate" /><br />
		<div id="bmr_result"></div>
	</form>

  <?
}

function widgetCalotor($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>BMI calculator<?php echo $after_title;
  calotor();
  echo $after_widget;
}

function calotorInit()
{
  register_sidebar_widget(__('Calotor'), 'widgetCalotor');     
  add_shortcode( 'calotor', 'calotor' );
}
add_action("plugins_loaded", "calotorInit");


?>