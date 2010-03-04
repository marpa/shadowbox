<?php
/*
Theme Name: ShadowBox
Variation Name: White Yellow Gradient ShadowBox
Variation id: shadowbox-white-yellow
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "shadowbox-white-yellow") {

	$options['background_image_file'] = "bg_toplight.jpg";
	$options['background_image_directory'] = "shadowbox-white-yellow";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";

	$options['background_color'] = "#FFF8C6";
	$options['bgtextcolor'] = "#999999";
	$options['bglinkcolor'] = "#777777";
	$options['bgbordercolor'] = "#999999";

	$options['header-meta-left-margin'] = "30px";
	$options['header-meta-right-margin'] = "30px";
	$options['footer-meta-left-margin'] = "30px";
	$options['footer-meta-right-margin'] = "20px";
	
	$options['transparent-blogtitle-color'] = $options['linkcolor']; 
	$options['transparent-blogdescription-color'] = $options['textcolor'];
	$options['transparent-heading-color'] = "#333333";
	$options['transparent-link-color']  = $options['linkcolor'];
	$options['transparent-text-color']  = $options['textcolor'];

	//$options['header-blogtitle-size'] = "20";
	
	$options['page_image_directory'] = "shadowbox-default";
	$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/variations/".$options['page_image_directory'];
	
	$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
	$options['page_top_padding'] = "30";	
	
	$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
	$options['page_main_padding'] = "50";	

	$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
	$options['page_bottom_padding'] = "30";
	
	$options['left01-border-style'] = "solid";
	$options['right01-border-style'] = "solid";
	$options['right02-border-style'] = "solid";
	$options['top-border-style'] = "solid";
	$options['bottom-border-style'] = "none";
	$options['header-border-style'] = "solid";
	$options['header-border02-height'] = 1;

	$options['header-width'] = $options['site-width'];

	$options_values['site-width'] = array(
		'1000px' => '1000',
		'950px' => '950',
		'900px' => '900',
		'850px' => '850',
		'800px' => '800',
		'750px' => '750'
	);

	$options_values['header-width'] = array();



}	
	
?>