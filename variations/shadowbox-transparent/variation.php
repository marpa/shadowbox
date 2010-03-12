<?php
/*
Theme Name: ShadowBox
Variation Name: Transparent ShadowBox
Variation id: shadowbox-transparent
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "shadowbox-transparent") {

	$options['background_image_file'] = "bg_topdark.jpg";
	$options['background_image_directory'] = "shadowbox-transparent";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";

	// variation credit
	$options['background-source-credit'] = "Translucence";
	$options['background-source-url'] = "";

	$options['background_color'] = "#FFFFFF";
	$options['bgtextcolor'] = "#999999";
	$options['bglinkcolor'] = "#666666";
	$options['bgbordercolor'] = "#999999";
	
	$options['content-background'] = "transparent";
	
	$options['transparent-blogtitle-color'] = $options['linkcolor']; 
	$options['transparent-blogdescription-color'] = $options['textcolor'];
	$options['transparent-heading-color'] = "#333333";
	$options['transparent-link-color']  = $options['linkcolor'];
	$options['transparent-text-color']  = $options['textcolor'];
	
	$options['page_image_directory'] = "shadowbox-transparent";
	$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/variations/".$options['page_image_directory'];
	
	$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
	$options['page_top_padding'] = "30";	
	
	$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
	$options['page_main_padding'] = "50";	

	$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
	$options['page_bottom_padding'] = "30";	


}	
	
?>