<?php
/*
Theme Name: ShadowBox
Variation Name: Yellow White Gradient ShadowBox
Variation id: shadowbox-yellow-white
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "shadowbox-yellow-white") {

	$options['background_image_file'] = "bg_topdark.jpg";
	$options['background_image_directory'] = "shadowbox-yellow-white";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";

	$options['background_color'] = "#FFFFFF";
	$options['bgtextcolor'] = "#999999";
	$options['bglinkcolor'] = "#777777";
	$options['bgbordercolor'] = "#999999";
	
	$options['transparent-blogtitle-color'] = $options['linkcolor']; 
	$options['transparent-blogdescription-color'] = $options['textcolor'];
	$options['transparent-heading-color'] = "#333333";
	$options['transparent-link-color']  = $options['linkcolor'];
	$options['transparent-text-color']  = $options['textcolor'];


}	
	
?>