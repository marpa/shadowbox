<?php
/*
Theme Name: ShadowBox
Variation Name: Green ShadowBox
Variation id: shadowbox-green
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 

*/

if ($options['background'] == "shadowbox-green") {

	$options['background_image_file'] = "green01.png";
	$options['background_image_directory'] = "shadowbox-green";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "repeat";
	$options['background_position'] = "center top";
	$options['background_color'] = "#83A776";
	$options['background-source-url'] = "http://www.squidfingers.com/patterns/";
	$options['background-source-credit'] = "Green tile";
	
	$options['bgtextcolor'] = "#FFFFFF";
	$options['bglinkcolor'] = "#333333";
	$options['bgbordercolor'] = "#999999";

	$options['transparent-blogtitle-color'] = $options['linkcolor']; 
	$options['transparent-blogdescription-color'] = $options['textcolor'];
	$options['transparent-heading-color'] = "#333333";
	$options['transparent-link-color']  = $options['linkcolor'];
	$options['transparent-text-color']  = $options['textcolor'];

}	
	
?>