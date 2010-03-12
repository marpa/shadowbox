<?php
/*
Theme Name: ShadowBox
Variation Name: Default
Variation ID: default
Description: Default variation for ShadowBox
Version: 1.0.1
Author: Alex Chapin
Author URI: http://www.alexchapin.com
*/

// defaults for all but custom background images 
if ($options['background'] != "custom") {	 
	$options['background_color'] = "#FFFFFF";
	$options['background_image_file'] = "none";
	$options['background_image'] = "none";
	$options['background_position'] = "top";
	$options['background_repeat'] = "repeat-x";
	$options['bgbordercolor'] = "#999999";
	$options['bgtextcolor']	= "#CCCCCC";
	$options['bglinkcolor']	= "#CCCCCC";
	$options['transparent-blogtitle-color'] = "#999999"; 
	$options['transparent-blogdescription-color'] = "#555555"; 
	$options['transparent-heading-color'] = "#999999";
	$options['transparent-link-color']  = "#999999";
	$options['transparent-text-color']  = "#999999";
	$options['background-source-url'] = "";
	$options['background-source-credit'] = "";
}

if ($shadowbox_config['headermeta'] = "on") $options['headermeta'] = "on";

$options['site-margin-top'] = "0";	
$options['page-image-width'] = $options['site-width']-50;
$options['header-width'] = $options['site-width'];
$options['custom-header-width-offset'] = 107;

$options['foreground_color'] = "#FFFFFF";
$options['content-background'] = "#FFFFFF";
$options['header-text-padding-left'] = "10";
$options['header-blogtitle-size'] = "27";


if (isset($options['linkcolor'])) {
	$options['header-blogtitle-color'] = $options['linkcolor']; 
	$options['content-link-color'] = $options['linkcolor'];
	$options['top-link-color'] = $options['linkcolor'];
	$options['bottom-link-color'] = $options['linkcolor'];
	$options['left01-link-color'] = $options['linkcolor'];
	$options['right01-link-color'] = $options['linkcolor'];
	$options['right02-link-color'] = $options['linkcolor'];
} else {
	$options['header-blogtitle-color'] = "#003366";
	$options['content-link-color'] = "#003366";
	$options['top-link-color'] = "#003366";
	$options['bottom-link-color'] = "#003366";
	$options['left01-link-color'] = "#003366";
	$options['right01-link-color'] = "#003366";
	$options['right02-link-color'] = "#003366";
}

if (isset($options['textcolor'])) {
	$options['header-blogdescription-color'] = $options['textcolor']; 
} else {
	$options['header-blogdescription-color'] = "#333333";
}

$options['header-meta-left-margin'] = "30px";
$options['header-meta-right-margin'] = "30px";
$options['footer-meta-left-margin'] = "30px";
$options['footer-meta-right-margin'] = "20px";

$options['left01-heading-color'] = "#999999";
$options['right01-heading-color'] = "#999999";
$options['right02-heading-color'] = "#999999";

$options['transparent-blogtitle-color'] = $options['linkcolor']; 
$options['transparent-blogdescription-color'] = $options['textcolor'];
$options['transparent-heading-color'] = "#333333";
$options['transparent-link-color']  = $options['linkcolor'];
$options['transparent-text-color']  = $options['textcolor'];

$options['header-outer-border-style'] = "solid";
$options['header-border02-height'] = 1;

$options['page_image_directory'] = "shadowbox-default";	
$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/variations/".$options['page_image_directory'];

if ($options['page_image_directory'] != "none") {
	$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
	$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
	$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
} else {
	$options['page_top_background_image'] = "none";
	$options['page_main_background_image'] = "none";
	$options['page_bottom_background_image'] = "none";
}

$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
$options['page_top_padding'] = "30";	

$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
$options['page_main_padding'] = "50";	

$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
$options['page_bottom_padding'] = "30";

$options['thread-even-bgcolor'] = "#FFFFFF";
$options['thread-alt-bgcolor'] = "#f8f8f8";
$options['commentfield'] = "#000000";

$options['searchbox-color'] = "#FFFFFF";

/******************************************************************************
 * Initialization
 * Set these only if not in the initial options array
 ******************************************************************************/
if (!isset($options['background'])) $options['background'] = "shadowbox-gray-white";
if (!isset($options['site-width'])) $options['site-width'] = "900";
if (!isset($options['header-block-height'])) $options['header-block-height'] = "100";
if (!isset($options['header-blogtitle-size'])) $options['header-blogtitle-size'] = "20";
if (!isset($options['footer-meta-left'])) $options['footer-meta-left'] = "custom";
if (!isset($options['header-meta-left'])) $options['header-meta-left'] = "network";
if (!isset($options['revert'])) $options['revert'] = 1;
if (!isset($options['header-image-options'])) $options['header-image-options'] = "whitegradient";

if (!isset($options['header-text-display'])) $options['header-text-display'] = "middle";
if (!isset($options['entry-link-style'])) $options['entry-link-style'] = "ww";
if (!isset($options['tag-link-style'])) $options['tag-link-style'] = "yellow-box";
if (!isset($options['category-link-style'])) $options['category-link-style'] = "yellow-box";
if (!isset($options['post-single-sidebar'])) $options['post-single-sidebar'] = "right";

if (!isset($options['header-color'])) $options['header-color'] = "#F9F9F9";
if (!isset($options['top-color'])) $options['top-color'] = "#FFFFFF";
if (!isset($options['left01-color'])) $options['left01-color'] = "#F9F9F9";
if (!isset($options['content-color'])) $options['content-color'] = "#FFFFFF";
if (!isset($options['right01-color'])) $options['right01-color'] = "#F9F9F9";
if (!isset($options['right02-color'])) $options['right02-color'] = "#F9F9F9";
if (!isset($options['bottom-color'])) $options['bottom-color'] = "#FFFFFF";

if (!isset($options['header-opacity'])) $options['header-opacity'] = "1";
if (!isset($options['top-opacity'])) $options['top-opacity'] = "1";
if (!isset($options['left01-opacity'])) $options['left01-opacity'] = "1";
if (!isset($options['content-opacity'])) $options['content-opacity'] = "1";
if (!isset($options['right01-opacity'])) $options['right01-opacity'] = "1";
if (!isset($options['right02-opacity'])) $options['right02-opacity'] = "1";
if (!isset($options['bottom-opacity'])) $options['bottom-opacity'] = "1";

if (!isset($options['header-border-style'])) $options['header-border-style'] = "solid";
if (!isset($options['top-border-style'])) $options['content-border-style'] = "solid";
if (!isset($options['content-border-style'])) $options['content-border-style'] = "none";
if (!isset($options['left01-border-style'])) $options['left01-border-style'] = "solid";
if (!isset($options['right01-border-style'])) $options['right01-border-style'] = "solid";
if (!isset($options['right02-border-style'])) $options['right02-border-style'] = "solid";
if (!isset($options['bottom-border-style'])) $options['bottom-border-style'] = "none";


if (!isset($options['header-width'])) $options['header-width'] = $options['site-width'];
if (!isset($options['left01-width'])) $options['left01-width'] = "0";
if (!isset($options['right01-width'])) $options['right01-width'] = "200";
if (!isset($options['right02-width'])) $options['right02-width'] = "0";


/*********************************************************
 * options value defaults
 * actual px values need to be adjusted for padding
 *********************************************************/	

$options_values['site-width'] = array(
	'1000px' => '1000',
	'950px' => '950',
	'900px' => '900',
	'850px' => '850',
	'800px' => '800',
	'750px' => '750'
	);

$options_values['header-width'] = array(
	'1000px' => '1000',
	'975px' => '975',
	'950px' => '950',
	'925px' => '925',
	'900px' => '900',
	'975px' => '975',
	'850px' => '850',
	'800px' => '800',
	'750px' => '750',
	'100%' => '100'
	);

$options_values['header-opacity'] = array(
	'100%' => '1',
	'90%' => '.9',
	'80%' => '.8',
	'70%' => '.7',
	'60%' => '.6',
	'50%' => '.5',
	'40%' => '.4',
	'30%'=> '.3',
	'20%'=> '.2',
	'0%'=> '0'
	);

$options_values['border-style'] = array(
	'No Border' => 'none',
	'Dotted Border' => 'dotted',
	'Solid Border' => 'solid'
	);

$options_values['background_repeat'] = array(
	'No Repeat' => 'no-repeat',
	'Repeat Horizontally' => 'repeat-y',
	'Repeat Vertically' => 'repeat-x',
	'Repeat Both' => 'repeat'
	);

$options_values['background_position'] = array(
	'Center Top' => 'center top',
	'Center Bottom' => 'center bottom'
	);


$options_values['sidebar-width'] = array(
	'175px' => '125',
	'200px' => '150',
	'225px' => '175',
	'250px' => '200',
	'275px' => '225',
	'350px' => '300',
	'400px' => '350',
	'hidden'	=> '0'
	);

$options_values['sidebar-opacity'] = array(
	'100%' => '1',
	'90%' => '.9',
	'80%' => '.8',
	'70%' => '.7',
	'60%' => '.6',
	'50%' => '.5',
	'40%' => '.4',
	'30%'=> '.3',
	'20%'=> '.2',
	'0%'=> '0'
	);


$options_values['sidebar-color'] = array(
	'White' => '#FFFFFF',
	'Silver' => '#F9F9F9',
	'Gray' => '#F3F3F3',
	'Yellow' => '#FFF8C6',
	'Muted Yellow' => '#e9e9c9',
	'Gray Blue'	=> '#364559'
	);


$options_values['header-block-height'] = array(
	'50px' => '50',
	'70px' => '70',
	'100px' => '100',
	'125px' => '125',
	'150px' => '150',
	'175px' => '175',
	'200px' => '200',
	'225px' => '225',
	'250px' => '250',
	'300px' => '300'
	);
	
$options_values['linkcolor'] = array(
	'Dark Blue' => '#003366',
	'Light Blue' => '#0066cc',
	'Red' => '#990000',
	'Green' => '#265e15',
	'Black' => '#222222',
	'Gold'	=>	'#625B1D'
	);
	
$options_values['entry-link-style'] = array(
	'None' => 'none',
	'Underline' => 'underline',
	'Underline & Highlight' => 'ww'
);

$options_values['textcolor'] = array(
	'30% Gray' => '#888888',
	'40% Gray' => '#777777',
	'50% Gray' => '#666666',
	'60% Gray' => '#555555',
	'70% Gray' => '#444444',
	'80% Gray' => '#333333',
	'Black' => '#222222'
);


$options_values['category-link-style'] = array(
		'Right Sidebar Box' => 'right-sidebar-box',
		'Left Sidebar Box' => 'left-sidebar-box',
		'Yellow Box' => 'yellow-box'
);

$options_values['tag-link-style'] = array(
		'Right Sidebar Box' => 'right-sidebar-box',
		'Left Sidebar Box' => 'left-sidebar-box',
		'Yellow Box' => 'yellow-box'
);


$options_values['post-single-sidebar'] = array(
	'Left Sidebar' => 'left',
	'Right Sidebar' => 'right',
	'Both Sidebars' => 'both',
	'No Sidebars' => 'none'
);

$options_values['sidebar-display'] = array(
	'Left Sidebar' => 'left01',
	'1st Right Sidebar' => 'right01',
	'2nd Right Sidebar' => 'right02',
	'Both Right Sidebars' => 'right01right02',
	'Left & 1st Right' => 'left01right01',
	'Left & 2nd Right' => 'left01right02',
	'No Sidebars' => 'none',
);

	
	
?>