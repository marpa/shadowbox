<?php
/*
Theme Name: ShadowBox
Variation Name: Black ShadowBox
Variation id: shadowbox-black
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/

if ($options['background'] == "shadowbox-black") {

	$options['background_image_file'] = "none";
	$options['background_image_directory'] = "shadowbox-black";	
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";

	$options['background_color'] = "#0F0F0F";
	$options['bgtextcolor'] = "#CCCCCC";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#000000";		

	$options['header-meta-left-margin'] = "30px";
	$options['header-meta-right-margin'] = "30px";
	$options['footer-meta-left-margin'] = "30px";
	$options['footer-meta-right-margin'] = "20px";
	
	$options['transparent-blogtitle-color'] = "#CCCC99";
	$options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#FFFFFF";
	

	//$options['header-blogtitle-size'] = "20";
	
	$options['page_image_directory'] = "shadowbox-black";
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
	$options['bottom-border-style'] = "solid";
	$options['header-border-style'] = "solid";
	
	$options['searchbox-color'] = "#262626";

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

	// option values
	$options_values['headercolor'] = array(
		'Dark Gray' => '#262626',
		'Black' => '#000000',
		'Transparent' => 'transparent'
	);

	$options_values['sidebar-color'] = array(
		'Dark Gray' => '#262626',
		'Black' => '#000000'
	);
	
	$options_values['linkcolor'] = array(
		'Pale Yellow' => '#FFFFCC', 
		'Yellow' => '#EEDD82',
		'Light Gray' => '#CCCCCC',
		'White' => '#FFFFFF'	
	);
	
	$options_values['textcolor'] = array(
		'Light Gray' => '#CCCCCC',
		'Gray' => '#666666',
		'Silver' => '#F9F9F9'
	);

	$options_values['category-link-style'] = array(
			'Right Sidebar Box' => 'right-sidebar-box',
			'Left Sidebar Box' => 'left-sidebar-box'
	);

	$options_values['tag-link-style'] = array(
			'Right Sidebar Box' => 'right-sidebar-box',
			'Left Sidebar Box' => 'left-sidebar-box'
	);
	
	
	// if current value is one of this variation's option values, then use it 
	// otherwise use default for this variation
	if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#FFFFCC";
	if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#210";
	if (!in_array($options['header-color'], array_values($options_values['headercolor']))) $options['header-color'] = "#262626";
	
	if (!in_array($options['header-heading-color'], array_values($options_values['linkcolor']))) $options['header-heading-color'] = "#262626";		
	if (!in_array($options['header-link-color'], array_values($options_values['linkcolor']))) $options['header-link-color'] = "#FFFFCC";	
	if (!in_array($options['left01-link-color'], array_values($options_values['linkcolor']))) $options['left01-link-color'] = "#FFFFCC";
	if (!in_array($options['right01-link-color'], array_values($options_values['linkcolor']))) $options['right01-link-color'] = "#FFFFCC";
	if (!in_array($options['right02-link-color'], array_values($options_values['linkcolor']))) $options['right02-link-color'] = "#FFFFCC";
	
	if (!in_array($options['top-color'], array_values($options_values['sidebar-color']))) $options['top-color'] = "#000000";
	if (!in_array($options['content-color'], array_values($options_values['sidebar-color']))) $options['content-color'] = "#000000";
	if (!in_array($options['bottom-color'], array_values($options_values['sidebar-color']))) $options['bottom-color'] = "#000000";
	if (!in_array($options['left01-color'], array_values($options_values['sidebar-color']))) $options['left01-color'] = "#262626";
	if (!in_array($options['right01-color'], array_values($options_values['sidebar-color']))) $options['right01-color'] = "#262626";
	if (!in_array($options['right02-color'], array_values($options_values['sidebar-color']))) $options['right02-color'] = "#262626";
	
	if (!in_array($options['category-link-style'], array_values($options_values['category-link-style']))) $options['category-link-style'] = "left-sidebar-box";
	if (!in_array($options['tag-link-style'], array_values($options_values['tag-link-style']))) $options['tag-link-style'] = "right-sidebar-box";		



}	
	
?>