<?php
/*
Theme Name: Translucence
Variation Name: Translucence Earth Lights
VAriation id: translucence-earthlights
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/


if ($options['background'] == "translucence-earthlights") {

	$options['background_image_directory'] = "translucence-earthlights";
	$options['background_image_file'] = "bg-earthlights.png";
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "no-repeat";
	$options['background_position'] = "center top";
	
	$options['background-source-credit'] = "Visible Earth";
	$options['background-source-url'] = "http://visibleearth.nasa.gov";	
	
	$options['background_color'] = "#101032";
	$options['foreground_color'] = "#FFFFFF";

	$options['transparent-blogtitle-color'] = "#CCCC99"; 
	$options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#FFFFFF";
			
	$options['bgtextcolor'] = "#666666";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#000000";		
	
	$options['searchbox-color'] = "#FFFFFF";	

}
	
	
?>