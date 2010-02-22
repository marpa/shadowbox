<?php
/*********************************************************
 * 
 * Configuration otions for ShadowBox theme
 * To create your own configuration options save this file
 * as config.php
 *
 *********************************************************/
$variation_config = array();

$variation_config['theme-url'] = "http://segueproject.org/wordpress/themes/";
$variation_config['theme-name'] = "ShadowBox";

/******************************************************************************
 * Header meta left options
 * (this is the html content options for the upper left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$variation_config['header_meta_left_options']['blogs'] = array (
		option_name =>	'blogs',
		option_label =>	'Blog Sign Up',
		option_value => ''
	);
	
$variation_config['header_meta_left_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => ''
	);

/******************************************************************************
 * Header meta right options
 * (this is the html content options for the upper right corner of the blog)
 ******************************************************************************/

$variation_config['header_meta_right_options'] = array (
		option_name =>	'',
		option_label =>	'',
		option_value => ''
	);
	
/******************************************************************************
 * Header Image Options
 * (put all header images in images directory
 ******************************************************************************/

$variation_config['header_image_options']['whitegradient'] = array (
		option_name =>	'whitegradient',
		option_label =>	'White Gradient',
		option_value => 'header-trans-white-1200x100.png'
	);

$variation_config['header_image_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => 'header-trans-white-1200x100.png'
	);

$variation_config['header_image_options']['transparent'] = array (
		option_name =>	'transparent',
		option_label =>	'None',
		option_value => 'header-transparent.png'
	);

/******************************************************************************
 * Footer meta left options
 * (this is the html content options for the lower left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/
	
$variation_config['footer_meta_left_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => ''
	);

/******************************************************************************
 * Miscellaneous Config
 ******************************************************************************/
$variation_config['headermeta'] = "on";


/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 ******************************************************************************/


$variation_config['model'][1]  = 'site-width';
$variation_config['model'][2]  = 'background_image_url';
$variation_config['model'][3]  = 'background_color';
$variation_config['model'][4]  = 'background_repeat';
$variation_config['model'][5]  = 'background_position';
$variation_config['model'][6]  = 'bglinkcolor';
$variation_config['model'][7]  = 'bgtextcolor';
$variation_config['model'][8]  = 'header-width';
$variation_config['model'][9]  = 'headerleftcustom';
$variation_config['model'][10]  = 'header-meta-left';
$variation_config['model'][11]  = 'header-image-options';
$variation_config['model'][12]  = 'headermeta';
$variation_config['model'][13]  = 'header-text-display';
$variation_config['model'][14]  = 'header-block-height';
$variation_config['model'][15]  = 'topbar-bg-color';
$variation_config['model'][16]  = 'bottombar-bg-color';
$variation_config['model'][17]  = 'background';
$variation_config['model'][18]  = 'headercolor';
$variation_config['model'][19]  = 'textcolor';
$variation_config['model'][20]  = 'linkcolor';
$variation_config['model'][21]  = 'entry-link-style';
$variation_config['model'][22]  = 'tag-link-style';
$variation_config['model'][23]  = 'category-link-style';
$variation_config['model'][24]  = 'left01-width';
$variation_config['model'][25]  = 'right01-width';
$variation_config['model'][26]  = 'right02-width';
$variation_config['model'][27]  = 'top-color';
$variation_config['model'][28]  = 'bottom-color';
$variation_config['model'][29]  = 'content-color';
$variation_config['model'][30]  = 'content-opacity';
$variation_config['model'][31]  = 'header-color';
$variation_config['model'][32]  = 'header-opacity';
$variation_config['model'][33]  = 'left01-color';
$variation_config['model'][34]  = 'right01-color';
$variation_config['model'][35]  = 'right02-color';
$variation_config['model'][36]  = 'top-opacity';
$variation_config['model'][37]  = 'bottom-opacity';
$variation_config['model'][38]  = 'left01-opacity';
$variation_config['model'][39]  = 'right01-opacity';
$variation_config['model'][40]  = 'right02-opacity';
$variation_config['model'][41]  = 'post-single-sidebar';
$variation_config['model'][42]  = 'footer-meta-left';
$variation_config['model'][43]  = 'footerleftcustom';
$variation_config['model'][44]  = 'model-instructions';
$variation_config['model'][45]  = 'custom_background_color';
$variation_config['model'][46]  = 'custom_background_repeat';
$variation_config['model'][47]  = 'custom_background_position';
$variation_config['model'][48]  = 'custom_bgtextcolor';
$variation_config['model'][49]  = 'custom_bglinkcolor';
// $variation_config['model'][50]  = 'custom_header_color';
$variation_config['model'][51]  = 'custom_background-source-url';
$variation_config['model'][52]  = 'custom_background-source-credit';
$variation_config['model'][53]  = 'revert';
$variation_config['model'][54]  = 'header-blogtitle-size';



/******************************************************************************
 * Disabled Variations 
 * Variation names should match name of variation folder
 * Comment out all variations that are NOT disabled
 ******************************************************************************/

// $variation_config['variations_disabled'][0] = 'custom';
// $variation_config['variations_disabled'][1] = 'shadowbox-white';
// $variation_config['variations_disabled'][2] = 'shadowbox-black';
// $variation_config['variations_disabled'][3] = 'shadowbox-blue';
// $variation_config['variations_disabled'][4] = 'shadowbox-green';	
// $variation_config['variations_disabled'][5] = 'shadowbox-yellow';
// $variation_config['variations_disabled'][6] = 'shadowbox-yellow-white';
// $variation_config['variations_disabled'][7] = 'shadowbox-white-yellow';
// $variation_config['variations_disabled'][8] = 'shadowbox-gray';
// $variation_config['variations_disabled'][9] = 'shadowbox-gray-white';
// $variation_config['variations_disabled'][10] = 'shadowbox-white-gray';
