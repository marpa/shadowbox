<?php
/*
Theme Name: Translucence
Variation Name: Black Translucence
VAriation id: translucence-black
Description: Easy to use highly flexible theme with options for defining background images and  setting colors, opacity and visibility of various foreground areas including widget bars
Version: 1.0.1
Author: Alex Chapin
Author URI: 
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, theme-options, fixed-width, flexible-width, custom-colors, custom-header, sticky-post, light, dark, white, black, yellow, blue, green, red, silver
*/


if ($options['background'] == "translucence-black") {

	$options['background_image_directory'] = "translucence-black";
	$options['background_image_file'] = "none";
	$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
	$options['background_image'] .= "/variations/".$options['background_image_directory'];
	$options['background_image'] .= "/".$options['background_image_file']."')";
	$options['background_repeat'] = "no-repeat";
	$options['background_position'] = "center top";	

	$options['transparent-blogtitle-color'] = "#CCCC99";
	$options['transparent-blogdescription-color'] = "#FFFFFF"; 
	$options['transparent-heading-color'] = "#CCCC99";
	$options['transparent-link-color']  = "#FFFFFF";
	$options['transparent-text-color']  = "#F2F2F2";
		
	$options['bgtextcolor'] = "#CCCCCC";
	$options['bglinkcolor'] = "#FFFFFF";
	$options['bgbordercolor'] = "#FFFFFF";
		

	$options['background_color'] = "#0F0F0F";
	$options['foreground_color'] = "#000000";		

								
	$options['thread-even-bgcolor'] = "#333333";
	$options['thread-alt-bgcolor'] = "#000000";
	$options['commentfield'] = "#FFFFFF";

// 	$options['left01-border-left'] = "#FFFFCC";
// 	$options['left01-border-bottom'] = "#FFFFCC";
// 	$options['left01-border-right'] = "#FFFFCC";
// 
// 	$options['right01-border-left'] = "#FFFFCC";
// 	$options['right01-border-bottom'] = "#FFFFCC";
// 	$options['right01-border-right'] = "#FFFFCC";
// 
// 	$options['right02-border-left'] = "#FFFFCC";
// 	$options['right02-border-bottom'] = "#FFFFCC";
// 	$options['right02-border-right'] = "#FFFFCC";
	
	$options['searchbox-color'] = "#262626";

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
		'White' => '#FFFFFF',
		'10% Gray' => '#EEEEEE',
		'20% Gray' => '#CCCCCC',
		'30% Gray' => '#888888',
		'40% Gray' => '#777777'
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