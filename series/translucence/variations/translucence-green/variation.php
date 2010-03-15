<?php
/*
Theme Name: Translucence
Variation Name: Green Translucence
VAriation id: translucence-green
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/


if ($options['background'] == "translucence-green") {

	// option values
	$options['background_image_file'] = "green01.png";
	$options['background_image_directory'] = "translucence-green";
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "repeat";
	$options['background_position'] = "center top";		
	$options['background_color'] = "#83A776";
	$options['bgtextcolor'] = "#444444";
	$options['bglinkcolor'] = "#333333";
	$options['bgbordercolor'] = "#666666";	
	
	$options['transparent-blogtitle-color'] = "#333333"; 
	$options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$options['transparent-heading-color'] = "#333333";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#555555";

		
}
	
	
?>