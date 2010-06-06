<?php
/*
Theme Name: ShadowBox
Variation Name: Draft ShadowBox
Variation id: shadowbox-draft
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "shadowbox-draft") {

	$options['background_image_file'] = "multiwidth01.png";
	$options['background_image_directory'] = "shadowbox-draft";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "repeat";
	$options['background_position'] = "left top";	

	// variation credit
	$options['background-source-credit'] = "Draft";
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
	
	$options['header-outer-border-style'] = "none";
	$options['header-border02-height'] = 0;
	
	$options['page_image_directory'] = "shadowbox-draft";
	$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/variations/".$options['page_image_directory'];
	
	$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
	$options['page_top_padding'] = "30";	
	
	$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
	$options['page_main_padding'] = "50";	

	$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
	$options['page_bottom_padding'] = "30";	

	/******************************************************************************
	 * Initialization
	 * Set these only if not in the initial options array
	 ******************************************************************************/
	
	if (!isset($options['header-border-style'])) $options['header-border-style'] = "dotted";
	if (!isset($options['top-border-style'])) $options['top-border-style'] = "none";
	if (!isset($options['content-border-style'])) $options['content-border-style'] = "dotted";
	if (!isset($options['left01-border-style'])) $options['left01-border-style'] = "dotted";
	if (!isset($options['right01-border-style'])) $options['right01-border-style'] = "dotted";
	if (!isset($options['right02-border-style'])) $options['right02-border-style'] = "dotted";
	if (!isset($options['bottom-border-style'])) $options['bottom-border-style'] = "dotted";


}	
	
?>