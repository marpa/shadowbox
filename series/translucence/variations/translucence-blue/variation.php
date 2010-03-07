<?php
/*
Theme Name: Translucence
Variation Name: Blue Translucence
Variation id: translucence-blue
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "translucence-blue") {

	$options['background_image_file'] = "grunge-blue.jpg";
	$options['background_image_directory'] = "translucence-blue";
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "repeat";
	$options['background_position'] = "center top";
	// 	$options['background-source-url'] = "";
 	$options['background-source-credit'] = "Blue Grunge";
	
	
	$options['background_color'] = "#051E3C";
	$options['bgtextcolor'] = "#CCCCCC";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#000000";
	
	$options['transparent-blogtitle-color'] = "#CCCC99"; 
	$options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#FFFFFF";
	
	$options['left01-heading-color'] = "#354253";
	$options['right01-heading-color'] = "#354253";
	$options['right02-heading-color'] = "#354253";
	

}	
	
?>