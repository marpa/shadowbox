<?php
/*********************************************************
 * 
 * Configuration otions for ShadowBox theme
 * To create your own configuration options save this file
 * as config.php
 *
 *********************************************************/
$shadowbox_config = array();

$shadowbox_config['theme-url'] = "http://segueproject.org/wordpress/themes/";
$shadowbox_config['theme-name'] = "ShadowBox";

/******************************************************************************
 * Header meta left options
 * (this is the html content options for the upper left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/

$shadowbox_config['header_meta_left_options']['blogs'] = array (
		option_name =>	'blogs',
		option_label =>	'Blog Sign Up',
		option_value => ''
	);
	
$shadowbox_config['header_meta_left_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => ''
	);

/******************************************************************************
 * Header meta right options
 * (this is the html content options for the upper right corner of the blog)
 ******************************************************************************/

$shadowbox_config['header_meta_right_options'] = array (
		option_name =>	'',
		option_label =>	'',
		option_value => ''
	);
	
/******************************************************************************
 * Header Image Options
 * (put all header images in images directory
 ******************************************************************************/

$shadowbox_config['header_image_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => 'header-trans-white-1200x100.png'
	);

$shadowbox_config['header_image_options']['whitegradient'] = array (
		option_name =>	'whitegradient',
		option_label =>	'None',
		option_value => 'header-trans-white-1200x100.png'
	);

$shadowbox_config['header_image_options']['transparent'] = array (
		option_name =>	'transparent',
		option_label =>	'None',
		option_value => 'header-transparent.png'
	);

/******************************************************************************
 * Footer meta left options
 * (this is the html content options for the lower left corner of the blog
 * Include "custom" if you want blog admins to be able to put whatever html they want
 ******************************************************************************/
	
$shadowbox_config['footer_meta_left_options']['custom'] = array (
		option_name =>	'custom',
		option_label =>	'Custom',
		option_value => ''
	);

/******************************************************************************
 * Miscellaneous Config
 ******************************************************************************/
$shadowbox_config['headermeta'] = "on";


/******************************************************************************
 * Model UI Options
 * This is a list of all the theme options that will be displayed in the 
 * theme options UI
 ******************************************************************************/


$shadowbox_config['model'][1]  = 'site-width';
$shadowbox_config['model'][2]  = 'background_image_url';
$shadowbox_config['model'][3]  = 'background_color';
$shadowbox_config['model'][4]  = 'background_repeat';
$shadowbox_config['model'][5]  = 'background_position';
$shadowbox_config['model'][6]  = 'bglinkcolor';
$shadowbox_config['model'][7]  = 'bgtextcolor';
$shadowbox_config['model'][8]  = 'header-width';
$shadowbox_config['model'][9]  = 'headerleftcustom';
$shadowbox_config['model'][10]  = 'header-meta-left';
$shadowbox_config['model'][11]  = 'header-image-options';
$shadowbox_config['model'][12]  = 'headermeta';
$shadowbox_config['model'][13]  = 'header-text-display';
$shadowbox_config['model'][14]  = 'header-block-height';
$shadowbox_config['model'][15]  = 'topbar-bg-color';
$shadowbox_config['model'][16]  = 'bottombar-bg-color';
$shadowbox_config['model'][17]  = 'background';
$shadowbox_config['model'][18]  = 'headercolor';
$shadowbox_config['model'][19]  = 'textcolor';
$shadowbox_config['model'][20]  = 'linkcolor';
$shadowbox_config['model'][21]  = 'entry-link-style';
$shadowbox_config['model'][22]  = 'tag-link-style';
$shadowbox_config['model'][23]  = 'category-link-style';
$shadowbox_config['model'][24]  = 'left01-width';
$shadowbox_config['model'][25]  = 'right01-width';
$shadowbox_config['model'][26]  = 'right02-width';
$shadowbox_config['model'][27]  = 'top-color';
$shadowbox_config['model'][28]  = 'bottom-color';
$shadowbox_config['model'][29]  = 'content-color';
$shadowbox_config['model'][30]  = 'content-opacity';
$shadowbox_config['model'][31]  = 'header-color';
$shadowbox_config['model'][32]  = 'header-opacity';
$shadowbox_config['model'][33]  = 'left01-color';
$shadowbox_config['model'][34]  = 'right01-color';
$shadowbox_config['model'][35]  = 'right02-color';
$shadowbox_config['model'][36]  = 'top-opacity';
$shadowbox_config['model'][37]  = 'bottom-opacity';
$shadowbox_config['model'][38]  = 'left01-opacity';
$shadowbox_config['model'][39]  = 'right01-opacity';
$shadowbox_config['model'][40]  = 'right02-opacity';
$shadowbox_config['model'][41]  = 'post-single-sidebar';
$shadowbox_config['model'][42]  = 'footer-meta-left';
$shadowbox_config['model'][43]  = 'footerleftcustom';
$shadowbox_config['model'][44]  = 'model-instructions';
$shadowbox_config['model'][45]  = 'custom_background_color';
$shadowbox_config['model'][46]  = 'custom_background_repeat';
$shadowbox_config['model'][47]  = 'custom_background_position';
$shadowbox_config['model'][48]  = 'custom_bgtextcolor';
$shadowbox_config['model'][49]  = 'custom_bglinkcolor';
//$shadowbox_config['model'][50]  = 'custom_header_color';
$shadowbox_config['model'][51]  = 'custom_background-source-url';
$shadowbox_config['model'][52]  = 'custom_background-source-credit';
$shadowbox_config['model'][53]  = 'revert';
$shadowbox_config['model'][54]  = 'header-blogtitle-size';



/******************************************************************************
 * Disabled Variations 
 * Variation names should match name of variation folder
 * Comment out all variations that are NOT disabled
 ******************************************************************************/

// $shadowbox_config['variations_disabled'][0] = 'custom';
// $shadowbox_config['variations_disabled'][1] = 'shadowbox-white';
// $shadowbox_config['variations_disabled'][2] = 'shadowbox-black';
// $shadowbox_config['variations_disabled'][3] = 'shadowbox-blue';
// $shadowbox_config['variations_disabled'][4] = 'shadowbox-green';	
// $shadowbox_config['variations_disabled'][5] = 'shadowbox-yellow';
// $shadowbox_config['variations_disabled'][6] = 'shadowbox-yellow-white';
// $shadowbox_config['variations_disabled'][7] = 'shadowbox-white-yellow';
// $shadowbox_config['variations_disabled'][8] = 'shadowbox-gray';
// $shadowbox_config['variations_disabled'][9] = 'shadowbox-gray-white';
// $shadowbox_config['variations_disabled'][10] = 'shadowbox-white-gray';
// $shadowbox_config['variations_disabled'][11] = 'translucence-white';
// $shadowbox_config['variations_disabled'][12] = 'translucence-black';
// $shadowbox_config['variations_disabled'][13] = 'translucence-blue';
// $shadowbox_config['variations_disabled'][14] = 'translucence-green';	
// $shadowbox_config['variations_disabled'][15] = 'translucence-yellow';
// $shadowbox_config['variations_disabled'][16] = 'translucence-yellow-white';
// $shadowbox_config['variations_disabled'][17] = 'translucence-white-yellow';
// $shadowbox_config['variations_disabled'][18] = 'translucence-gray';
// $shadowbox_config['variations_disabled'][19] = 'translucence-gray-white';
// $shadowbox_config['variations_disabled'][20] = 'translucence-white-gray';
// $shadowbox_config['variations_disabled'][21] = 'translucence-middseal';
// $shadowbox_config['variations_disabled'][22] = 'translucence-classics';
// $shadowbox_config['variations_disabled'][23] = 'translucence-middscape';
// $shadowbox_config['variations_disabled'][24] = 'translucence-middscape-blue';