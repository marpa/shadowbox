<?php
if (file_exists(dirname(__FILE__).'/config.php')) {
	require_once('config.php');
} else if (file_exists(dirname(__FILE__).'/config-sample.php')) {
	require_once('config-sample.php');
}
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

/******************************************************************************
 * Preset Widgets
 * It is possible to preset widgets for a given theme but not many theme
 * developers have done this yet....
 ******************************************************************************/

//update_option( 'sidebars_widgets', NULL );
$default_widgets = get_option('sidebars_widgets');

//printpre(get_option('sidebars_widgets'));

// Pre-set Widgets
$preset_widgets = array (
	'sidebar-1'  => array( 'search', 'pages', 'categories', 'archives' ),
	'sidebar-2'  => array( 'links', 'meta' ),
	'sidebar-3'  => array( 'links' ),
	'sidebar-4'  => array( 'search'),
	'sidebar-5'  => array( 'links')
);

//$new_widgets = array_merge($default_widgets, $preset_widgets);

//if ( isset( $_GET['activated']) ) {
//	printpre($preset_widgets);
//	update_option('sidebars_widgets', $preset_widgets);
//	printpre( get_option( 'sidebars_widgets' ) );
//}

/*********************************************************
 *  Register sidebars
 *********************************************************/

if (function_exists('register_sidebar')) {
	register_sidebar(array('name'=>'Top Bar',
	'id' => 'sidebar-4',
	'before_widget' => '<td valign=\'top\' class=\'page-widgets\'>',
	'after_widget' => '</td>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'Left Sidebar',
	'id' => 'sidebar-1',
	'before_widget' => '<li>',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'Right Sidebar',
	'id' => 'sidebar-2',
	'before_widget' => '<li>',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'2nd Right Sidebar',
	'id' => 'sidebar-3',
	'before_widget' => '<li>',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'Bottom Bar',
	'id' => 'sidebar-5',
	'before_widget' => '<td valign=\'top\' class=\'page-widgets\'>',
	'after_widget' => '</td>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));

	register_sidebar(array('name'=>'Widget Page',
	'id' => 'sidebar-6',
	'before_widget' => '<div class=\'page-widgets\'>',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));

}


/******************************************************************************
 *  Get options
 ******************************************************************************/
 
$theme_settings = $variation_config['theme-name']."_settings";
$theme_css = $variation_config['theme-name']."_css";
$theme_options = $variation_config['theme-name']." Options";
//printpre($theme_settings);

if (!is_array(get_option($theme_settings))) {
    add_option($theme_settings, array('init' => 1));    
} else {	
	$options = get_option($theme_settings);
}
   
if (!get_option($theme_css)) {
	add_option($theme_css, "");	
} else {
	$variation_css = get_option($theme_css);	
}

set_variation_options();

$options['theme-url'] = $variation_config['theme-url'];
$options['theme-name'] = $variation_config['theme-name'];


/*********************************************************
 * Setup admin menu
 *********************************************************/ 

add_action('admin_menu', 'variation_admin_menu');

function variation_admin_menu() {
	global $theme_options, $variation_config;
	
    add_theme_page($theme_options, $theme_options, 'edit_themes', 'Variations', 'variation_options');
}

/*********************************************************
 * Custom Header functions
 *********************************************************/

if ( function_exists('add_custom_image_header') ) {
  add_custom_image_header('header_style', 'admin_header_style');
}

$header_image = "%s/variations/".$variation_config['header_image_options'][$options['header-image-options']]['option_value'];
$header_image_width = $options['header-width'];
$header_image_height = $options['header-block-height'];

define('HEADER_IMAGE', $header_image); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', $header_image_width);
define('HEADER_IMAGE_HEIGHT', $header_image_height);
define('HEADER_TEXTCOLOR', $options['header-text-color']);
define('HEADER_BGCOLOR', $options['header-color-rgb']);
define( 'NO_HEADER_TEXT', true );
define( 'NO_HEADER_DESCRIPTION', true );

/*********************************************************
 * Styles used in admin custom header function
 * header_image() is a WordPress function
 *********************************************************/

function admin_header_style() { 
	?>
	<style type="text/css">
	#headimg, .headerblock{
		background-color: <?php echo HEADER_BGCOLOR; ?> 
		background-image: url(<?php header_image(); ?>) 0 0;
		background-position: right;
		background-repeat: no-repeat;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	}
		
	<?php if ( 'blank' == get_header_textcolor() ) { ?>
	
		.headerblock, h1, #headimg h1 {
				display: none;
		}
	
	<?php } else { ?>
	
		.headerblock .headertext .description, #headimg h1 {
			display: none;
		}
		.headerblock .headertext .description, #headimg #desc {
			display: none;
		}
	<?php } ?>
	
	</style>
	<?php 
}

/*********************************************************
 * Styles based on results of custom header function
 * this is loaded by means of wp_head() function
 *********************************************************/

function header_style() {
	?>	
	<style type="text/css">
	.headerblock {
		background-color: <?php echo HEADER_BGCOLOR; ?>;
		background-image: url(<?php header_image(); ?>);
		background-position: right;
		background-repeat: no-repeat;
	}
	</style>	
	<?php
}

/*********************************************************
 * ShadowBox theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function variation_options() {	
	global $variation_config, $options, $options_values, $variation_css, $model_content_width, $variations, $header_image;
    global $theme_settings, $theme_css, $_POST;
    	
	if (isset($_POST['reset'])) {
		delete_options();
		save_options();  
		
    } else if ($options['revert'] == 1) {	
		delete_options();
		save_options();	
		
    } else if ($_POST['action'] == 'save') {
		save_options();        
	}
	
	set_variation_options();	
		
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);

	$options = get_option($theme_settings);
	$variation_css = get_option($theme_css);
	
    
	/*********************************************************
	 * Define theme layout model values
	 *********************************************************/

    $model_right_sidebar_width = $options['right01-width']+50;
    $model_right_sidebar_width02 = $options['right02-width']+50;
    $model_left_sidebar_width = $options['left01-width']+50;
    
   // $model_header_image = get_header_image();
	if ($options['header-image-options'] == "custom") {
   		$match = preg_match('/variations/', $model_header_image);
   		if ($match == 0) {
   			$custom_header_set = 1;
   		} else {
   			$custom_header_set = 0;
   		}
   	} else {
   		$model_header_image = get_bloginfo('stylesheet_directory')."/variations/".$variation_config['header_image_options'][$options['header-image-options']]['option_value'];
   	}

	if ($options['site-width'] == 100) {
		$model_site_width = $options['site-width']-5;
		$model_header_text_width = $model_site_width - 200;
  	//	$model_content_width = $options['site-width'] - ($options['left-width'] + $options['right-width'] + $options['right02-width'] + 150);
		$model_site_width = $model_site_width."%";
				
	} else {
		$model_site_width = $options['site-width']-22;
		$model_header_text_width = $model_site_width - 200;
		$model_content_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + $options['right02-width'] + 150);
		$model_site_width = $model_site_width."";
		$model_site_width_css = $model_site_width."px";
	}

	
	/*********************************************************
	 * Define theme model css
	 * model css uses most of the actual theme's css except
	 * theme body css 
	 * model css adds css for theme edit UI components
	 *********************************************************/
 	
 	$model_css = preg_replace("/body/", ".body_na", $variation_css); 
 	print "
 	<style type='text/css'>".$model_css."

		.modelwrapper {
			background-image: ".$options['background_image'].";
			background-position: ".$options['background_position'].";
			background-color: ".$options['background_color'].";
			background-repeat: ".$options['background_repeat'].";
 			width: ".$model_site_width_css.";
			margin-top: 1px;
			margin-right: 10px;
			background-color: ".$options['background_color'].";
			color: #000000;
			padding: 1px 10px 10px 10px;
			border: 1px solid #CCCCCC;
		}
		
		.contentwrapper {
			background-color: ".$options['background_color'].";
		
		}
		
		.headerwrapper {
			width: ".$options['header-width'].";
		}
						
		.headerblock {
			background-image: url(".$model_header_image.");
			background-position: right center;
			background-repeat: no-repeat;
		}
		 		
 		.contentblock {
 			width: ".$model_content_width."px;
 		}

 		.editheaderlink {
 			color: ".$options['bglinkcolor'].";
 			font-size: 9px;
 			white-space:nowrap; 			
 		}
 		
		.editheaderlink a {
 			color: ".$options['bglinkcolor'].";
 			padding: 3px;
 			border: 1px dotted ".$options['bglinkcolor'].";
		}

 		.editheaderlink a:hover {
			 border: 1px solid ".$options['bglinkcolor'].";
			 text-decoration: none;
			 color: ".$options['bglinkcolor'].";
		}
		
		.modelheadertextposition {
			font-size: 20px; 
			margin-left: 5px;
			padding-top: ".$options['header-text-padding-top']."px;
			color: ".$options['headertext'].";
		}

 		.rss  {
			font-size: 10px;
			text-align: center;
 			color: ".$options['linkcolor'].";
		} 	
		
		#appgroupedit textarea {
			width: 300px;
		}

 		.metatext {
 			font-size: 9px; 
 			color: ".$options['bglinkcolor'].";

 		}
 		
 		.metatext a {
 			color: ".$options['bglinkcolor'].";
 		}

		.horizontalbar {
			padding-top: 4px;	
			text-align: right;
		}
 		.editwidgetlink {
			display: block;
 			color: ".$options['linkcolor'].";
 			padding: 5px;		 		
 		}
 		
 		.editwidgetlink a {
			display: block;
 			color: ".$options['linkcolor'].";
 			padding: 5px;
 			border: 1px dotted ".$options['linkcolor'].";
		} 		
 		
 		.editwidgetlink a:hover {
			 border: 1px solid ".$options['linkcolor'].";
			 text-decoration: none;
		}
								
		.instructions {
			margin-top: 5px;
			margin-bottom: 5px;
			margin-right: 0px;
			margin-left: 0px;
			background-color: #fffeeb;
			color: #000000;
			font-size: 10px;
			line-height: 1.5em;
			padding: 5px;
			border: 1px solid #CCCCCC;
		}
		
		.postlink {
			color: ".$options['linkcolor'].";	
			text-decoration: ".$options['entry-link-decoration'].";
			border: 1px ".$options['entry-link-border']." ".$options['left01-border-right'].";
			margin: 2px;
			padding: 1px;
		}

		.postlink:hover {
			color: ".$options['linkcolor'].";	
			text-decoration: ".$options['entry-link-decoration'].";
			border: 1px ".$options['entry-link-hover-border']." ".$options['linkcolor'].";
			margin: 2px;
			padding: 1px;
		}

		".$options['header-color-ie']."; 
		".$options['top-color-ie']."; 
		".$options['content-color-ie']."; 
		".$options['bottom-color-ie']."; 
		".$options['left01-color-ie']."; 
		".$options['right01-color-ie']."; 
		".$options['right02-color-ie'].";

 	</style>";	 
    
	/*********************************************************
	 * Form action 
	 *********************************************************/

	print "
	<form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>
	<input type='hidden' id='action' name='action' value='save'/>";

	/*********************************************************
	 *  Header meta options
	 *  Header meta left set in config
	 *********************************************************/
	print 
	"
	<table width = '".$model_site_width."' cellpadding='0' style='background-color: transparent;'>
		<tr>
			<td width='20%'>
			<span class='submit'><input type='submit' value='Update' name='save'/></span>
			</td>
			<td width='60%' align='left'>
			<div class='instructions' style='font-size: 9px;'>	
			<i>Below is just a model of your blog's layout and colors. It does not show 
			background gradient colors such as gray-white, nor all the details of your blog's header, borders or sidebar widgets</i>&nbsp;&nbsp;
			 <strong>Show recommendations: </strong><input type='checkbox' name='model-instructions' id='model-instructions' ".(isset($options['model-instructions']) && $options['model-instructions'] == "on" ? ' checked' : '') . " onchange='this.form.submit();'/>
			</div>			
			</td>
			<td width='20%'>
			<div class='submit' style='float: right;'><input type='submit' value='Revert to Default' name='reset'/></div>
			</td>
		</tr>
		<tr>
		<td width='20%'>";
			// header meta right appgroups options	
			if (in_array("header-meta-left", $variation_config['model'])) {
				print "<span style='font-size: 9px;'>Header Links:</span>\n";
				print "<select name='header-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
				foreach (array_keys($variation_config['header_meta_left_options']) as $meta_left_option) {						
					print "<option value='".$variation_config['header_meta_left_options'][$meta_left_option]['option_name']."' ";
					print ($options['header-meta-left'] == $variation_config['header_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
					print $variation_config['header_meta_left_options'][$meta_left_option]['option_label']."</option>";						
				}
				print "</select>";
			}
			print "
			</td>
			<td style='text-align: center;'>";	
			// background options		
			if (in_array("background", $variation_config['model'])) {
				
				print "
				<span style='font-size: 10px;'>Variation:</span>
				<select name='background' style='font-size: 10px;' onchange='this.form.submit();'>";
					// custom background image					
					if (!in_array("custom", $variation_config['variations_disabled']))
						print "\n<option value='custom'".($options['background'] == $value ? ' selected' : '') . ">Custom</option>";
					
					// variations defined in variations folder
					foreach ($variations as $label => $value) {
						if (!in_array($value, $variation_config['variations_disabled']))
							print "\n<option value='".$value."'".($options['background'] == $value ? ' selected' : '') . ">".$label."</option>";
					}									
				print "</select>";
			}
	
			//site width
			if (in_array("site-width", $variation_config['model'])) {
				print " <span style='font-size: 10px;'>Site Width:</span>\n";
				print "<select name='site-width' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
					// site width options
					foreach ($options_values['site-width'] as $label => $value) {
						print "\n<option value='".$value."'".($options['site-width'] == $value ? ' selected' : '') . ">".$label."</option>";
					}					
				print "</select>";
			}

			//header width
			if (in_array("header-width", $variation_config['model']) && count($options_values['header-width']) > 0) {
				print " <span style='font-size: 10px;'>Header Width:</span>\n";
				print "<select name='header-width' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
					// site width options
					foreach ($options_values['header-width'] as $label => $value) {
						print "\n<option value='".$value."'".($options['header-width'] == $value ? ' selected' : '') . ">".$label."</option>";
					}					
				print "</select>";
			}
				
			print "
			</td>
			<td width='20%' align='right'><span style='font-size: 9px;'>
			</td>
		</tr>
		<tr>
			<td colspan='3' style='text-align: center;'>";
			if ($options['background'] == 'custom') {
		
				// background image url
				if (in_array("background_image_url", $variation_config['model'])) {			
					print "	
					<span style='font-size: 10px;'>Background Image URL:</span>
					<input name='background_image_url' type='text' size='70' style='font-size: 10px;' 
					value='".(isset($options['background_image_url']) ? $options['background_image_url'] : '')."'/><br/>";
				}
								
				// background repeat
				if (in_array("background_repeat", $variation_config['model'])) {			
					print "
					<span style='font-size: 10px;'>Background Repeat:</span>
					<select name='custom_background_repeat' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
						// site width options
						foreach ($options_values['background_repeat'] as $label => $value) {
							print "\n<option value='".$value."'".($options['custom_background_repeat'] == $value ? ' selected' : '').">".$label."</option>";
						}					
					print "</select>";
				}

				// background position
				if (in_array("background_position", $variation_config['model'])) {			
					print "
					<span style='font-size: 10px;'>Background Position:</span>
					<select name='custom_background_position' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
						// site width options
						foreach ($options_values['background_position'] as $label => $value) {
							print "\n<option value='".$value."'".($options['custom_background_position'] == $value ? ' selected' : '') . ">".$label."</option>";
						}					
					print "</select>";
				}

				// background color
				if (in_array("custom_background_color", $variation_config['model'])) {			
					print "
					<span style='font-size: 10px;'>Background Color:</span>
					<input name='custom_background_color' type='text' size='8' style='font-size: 10px;' 
					value='".(isset($options['custom_background_color']) ? $options['custom_background_color'] : '')."'/><br/>";
				}

				// background text color
				if (in_array("bgtextcolor", $variation_config['model'])) {			
					print " <span style='font-size: 10px;'>Background Text Color:</span>\n";
					print "<select name='custom_bgtextcolor' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
						// site width options
						foreach ($options_values['textcolor'] as $label => $value) {
							print "\n<option value='".$value."'".($options['custom_bgtextcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
						}					
					print "</select>";
				}

				// background link color
				if (in_array("bglinkcolor", $variation_config['model'])) {			
					print " <span style='font-size: 10px;'>Background Link Color:</span>\n";
					print "<select name='custom_bglinkcolor' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
						// site width options
						foreach ($options_values['textcolor'] as $label => $value) {
							print "\n<option value='".$value."'".($options['custom_bglinkcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
						}					
					print "</select>";
				}				
				// Blog title and background heading colors	
				if (in_array("custom_header_color", $variation_config['model'])) {
					print "
					<span style='font-size: 10px;'>Translucent Blog Title Color:</span>
					<input name='custom_header_color' type='text' size='8' style='font-size: 10px;' 
					value='".(isset($options['custom_header_color']) ? $options['custom_header_color'] : '')."'/>
					<span style='font-size: 9px;'>(when header opacity < 80%)</span>";
				}
				
				// Background source url
				if (in_array("custom_background-source-url", $variation_config['model'])) {
					print "
					<br/><span style='font-size: 10px;'>Variation source URL:</span>
					<input name='custom_background-source-url' type='text' size='50' style='font-size: 10px;' 
					value='".(isset($options['custom_background-source-url']) ? $options['custom_background-source-url'] : '')."'/>";
				}

				// Background source credit	
				if (in_array("custom_background-source-credit", $variation_config['model'])) {
					print "
					<span style='font-size: 10px;'>Variation Name/Credit:</span>
					<input name='custom_background-source-credit' type='text' size='20' style='font-size: 10px;' 
					value='".(isset($options['custom_background-source-credit']) ? $options['custom_background-source-credit'] : '')."'/>";
				}
				
			}				
			print "</td>
		</tr>
	</table>
	
	<div class='modelwrapper'>";
	

	/*********************************************************
	 *  Header meta and background  model
	 *********************************************************/
	
	print "	
	<table width='100%' cellpadding='5'>
	<tr>
		<td colspan='3'>
			<table width='100%' cellspacing='0' cellpadding='5'>
			<tr>
			<td width='90%'>
			<div class='metatext'>";
			
			if ($options['headerleft'] == "") {
				print "no links defined...";				
			} else {
				print $options['headerleft'];
			}
					
			// if header left links selection is custom
			if ($options['header-meta-left'] == 'custom') {
				print "
					<input id='appgroupdo' type='hidden' name='appgroupdo' value='0'/> - 			
					<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"block\"; document.getElementById(\"appgroupdo\").value = \"1\"; exit; '>edit</a>					
					<div id='appgroupedit' style='display: none;'>					
					<textarea name='headerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
					print stripslashes(stripslashes(trim($options['headerleftcustom'])));
					print "</textarea>		
					&nbsp;&nbsp;&nbsp;
					<a href='javascript: document.getElementById(\"appgroupedit\").style.display = \"none\"; document.getElementById(\"appgroupdo\").value = \"0\"; exit;'>Cancel</a> - 
					<span class='submit'><input type='submit' value='Update' name='save'/></span>
					</div>
				";
			}
			print "
			</div>	
			</td>
			<td width='20%' valign='top'>";
			// header right meta options
			if ($variation_config['headermeta'] = "on") {
				$options['headermeta'] = "on";
				print "<div style='font-size: 9px; float: right; clear: both; color: ".$options['bgtextcolor'].";'>Log in</div>";
			} else {
				print "<div style='font-size: 9px; float: right; clear: both; color: ".$options['bglinkcolor'].";'></div>";
			}
			print "
			</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width='20%'>";
		
		// header-text-display options
		if (in_array("header-text-display", $variation_config['model'])) {	
			print "
			<span style='color:".$options['bgtextcolor']."; font-size: 10px;'>Blog Title Position:
			<select name='header-text-display' style='font-size: 10px;' onchange='this.form.submit();'>
				<option value='middle' ".($options['header-text-display'] == 'middle' ? ' selected' : '') . ">Middle</option>
				<option value='top' ".($options['header-text-display'] == 'top' ? ' selected' : '') . ">Top</option>
				<option value='bottom' ".($options['header-text-display'] == 'bottom' ? ' selected' : '') . ">Bottom</option>
				<option value='hide' ".($options['header-text-display'] == 'hide' ? ' selected' : '') . ">Hide</option>
			</select>
			</span>";
		}		
		print "</td>
		<td width='80%' colspan='2'>";
				
		// header height options
		if (in_array("header-block-height", $variation_config['model'])) {
			print " <span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Header Height:</span>\n";
			print "<select name='header-block-height' style='font-size: 10px;' onchange='this.form.submit();'>\n";							
			foreach ($options_values['header-block-height'] as $label => $value) {
				print "\n<option value='".$value."'".($options['header-block-height'] == $value ? ' selected' : '') . ">".$label."</option>";
			}					
			print "</select>";
		}
				
		// header color
		if (in_array("header-color", $variation_config['model'])) {
			print " <span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Header Color:</span>\n";
			print "\n\t\t\t\t\t\t\t<select name='header-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
			foreach ($options_values['sidebar-color'] as $label => $value) {
				print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['header-color'] == $value ? ' selected' : '') . ">".$label."</option>";
			}
			print "\n\t\t\t\t\t\t\t</select>";
		}
		// header opacity
		if (in_array("header-opacity", $variation_config['model'])) {
			print " <span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Header Opacity:</span>\n";
			print "\n\t\t\t\t\t\t\t<select name='header-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
			foreach ($options_values['header-opacity'] as $label => $value) {
				print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['header-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
			}
			print "\n\t\t\t\t\t\t\t</select>";
		}				 
				
		// header image options
		if (in_array("header-image-options", $variation_config['model'])) {
			print " <span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Header Image:</span>\n";

			if ($options['header-image-options'] == "custom" && $custom_header_set == 1) {
				print "<span class ='editheaderlink'><a href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>Edit Custom Header Image</a></span>";
			} else {
				print "<select name='header-image-options' style='font-size: 10px;'  onchange='this.form.submit();'>\n";
				foreach (array_keys($variation_config['header_image_options']) as $header_image_option) {						
					print "<option value='".$variation_config['header_image_options'][$header_image_option]['option_name']."' ";
					print ($options['header-image-options'] == $variation_config['header_image_options'][$header_image_option]['option_name'] ? ' selected' : '') . ">";
					print $variation_config['header_image_options'][$header_image_option]['option_label']."</option>\n";						
				}
				print "</select>";
				if ($options['header-image-options'] == "custom" && $custom_header_set == 0) 
					print "<span class ='editheaderlink'><a href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header'>Edit Custom Header Image</a></span>";
			}
		}		
		print "
		</td>		
	</tr>
	<tr><td colspan='3'>";
		if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='font-size: 8px;'>	
				<i>If you use your own custom header image, consider an image with transparent background for graphics or logo type images. 
				If your custom header image spans the entire width of the header, move the blog title and description to top or bottom or hide it </i>
			</div>		
			";		
		}		
		print "	
	</td></tr>	
	</table>
	";

	/*********************************************************
	 * theme model and options
	 *********************************************************/
	
	print "
	<table width = '".$model_site_width."' align='center' cellpadding='0' cellspacing='0' style='border: 1px solid #CCCCCC; background-color: ".$options['content-background'].";'>
	<tr>
	<td>		
		<table width = '100%' cellpadding='10' style='background-color: transparent;'>
			<tr>
				<td colspan='4' valign='top' height='".$options['header-block-height']."' class='headerblock'>";
					
					// blog title and description model
					if ($options['header-text-display'] != "hide") {
						print "<div class='headertext'><a href = '#'>".get_bloginfo('name')."</a></div>";
						print "<div class='description'>".get_bloginfo('description')."</div>";
					} else {
						print "<div style='font-size: 10px; color: ".$options['header-text-color'].";'><i>blog title and description hidden</i></div>";
					}
					print "

				</td>
			</tr>
			<tr>
				<td colspan='4' style='background-color: transparent;'>
				<table width='100%' cellspacing='1' cellpadding='0'>
				<tr>
				<td width='80%' class='topblock'>";
								
				/*********************************************************
				 * top bar
				 *********************************************************/
				
				if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
					print "
					<div class='instructions' style='margin: 2px;'>	
						<span style='font-size: 8px;'><i>Use this area for announcements, or links to other related sites.  Recommended widget: Text/HTML 
						(don't bother with giving your Text widget a title here, probably take too much space...) </i></span>
					</div>						
					";		
				}		
				print "
				<h2 style='padding-top: 0px; font-size: 10px; float: left;'>Top Bar</h2>
				<div class='editwidgetlink' style='text-align: center; width: 50%; float: left;'> 
				<a style='color:".$options['top-link-color']."; font-size: 10px; margin: 1px; padding: 1px;' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
				</div>	
				<div class='horizontalbar' style='font-size: 8px; float: right;'>";

				// color
				if (in_array("top-color", $variation_config['model'])) {
					print "\n\t\t\t\t\t\t\t<select name='top-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
					foreach ($options_values['sidebar-color'] as $label => $value) {
						print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['top-color'] == $value ? ' selected' : '') . ">".$label."</option>";
					}
					print "\n\t\t\t\t\t\t\t</select>";
				}
				// opacity
				if (in_array("top-opacity", $variation_config['model'])) {
					print "\n\t\t\t\t\t\t\t<select name='top-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
					foreach ($options_values['sidebar-opacity'] as $label => $value) {
						print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['top-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
					}
					print "\n\t\t\t\t\t\t\t</select>";
				}
			
				print"
				</div>
				</td>
				
				<td width='20%' class='topblock'>
				<div class='rss' style='color:".$options['top-link-color'].";'>Posts RSS | Comments RSS</div>
				</td>
				</tr>
				</table>
			</tr>
			<tr>";
						
			/******************************************************************************
			 * left sidebar model
			 ******************************************************************************/

			if ($options['left01-width'] != 0) {
				print"
				<td valign='top' width='".$model_left_sidebar_width."' class='left01block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['left01-heading-color'].";'>&larr; ".$model_left_sidebar_width." px &rarr; </div>
					<div style='font-size: 8px;'>					
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['left01-heading-color'].";'>Left Sidebar</h2>
					<div class='editwidgetlink' style='font-size: 10px;'>
					<a style='color:".$options['left01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
					
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";					
							if ($options['right01-width'] == 0 && $options['right02-width'] == 0) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else {
								print "
								1. Pages<br/>
								2. Categories<br/>";							
							}
							print "
							</i>
						</div>		
						";							
					}
					print "
					</div>
					</div>
				</td>";
			}
			
			/*********************************************************
			 * model main column contains options for:
			 * sidebar colors and widths
			 * post model with text and link color and style options
			 *********************************************************/
			
			print "
			<td width='".$model_content_width."' class='contentblock' style=' color: ".$options['textcolor'].";'>	
				<div style='font-size: 10px; text-align: center;'> &larr; ".$model_content_width." px &rarr;</div>
				<div style='font-size: 10px; text-align: center;'>";
				
				/*********************************************************
				 * Content Sidebar Options
				 *********************************************************/			
				print "<span style='font-size: 10px;'>Content</span>\n";
				// color
				if (in_array("content-color", $variation_config['model'])) {
					print "\n\t\t\t\t\t\t\t<select name='content-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
					foreach ($options_values['sidebar-color'] as $label => $value) {
						print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['content-color'] == $value ? ' selected' : '') . ">".$label."</option>";
					}
					print "\n\t\t\t\t\t\t\t</select>";
				}
				// opacity
				if (in_array("content-opacity", $variation_config['model'])) {
					print "\n\t\t\t\t\t\t\t<select name='content-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
					foreach ($options_values['sidebar-opacity'] as $label => $value) {
						print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['content-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
					}
					print "\n\t\t\t\t\t\t\t</select>";
				}				 
				
				print "
				</div>
				<table width = '100%' cellpadding='0'>
					<tr><td valign='top'>
						<table width = '100%' cellpadding='0'>";
						
							/*********************************************************
							 * Left Sidebar Options
							 *********************************************************/							
							
							print "<tr><td style='border-bottom: 1px dotted; text-align: left;'>";
							print "<div style='font-size: 10px;'>Left Sidebar</div>\n";
							// color
							if (in_array("left01-color", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='left01-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['sidebar-color'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['left01-color'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							// opacity
							if (in_array("left01-opacity", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='left01-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['sidebar-opacity'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['left01-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							//width
							if (in_array("left01-width", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='left01-width' style='font-size: 10px;' onchange='this.form.submit();'>";
								foreach ($options_values['sidebar-width'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['left01-width'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select><br/>";
							}	
							
							if (is_active_sidebar("sidebar-1") && $options['left01-width'] == 0) {
								print "<span style='font-size: 10px;'>hidden widgets!</span>";
							}
							
							print "
							</td></tr>
						</table>
						
					</td><td>					
						<table width = '100%' cellpadding='0'>";
					
							/*********************************************************
							 * Right Sidebar Options
							 *********************************************************/
							print "<tr><td style='border-bottom: 1px dotted; text-align: right;'>\n";
							print "<div style='font-size: 10px;'>Right Sidebar</div>\n";
							//print "<td style='border-bottom: 1px dotted; text-align: right;'>\n";
							// color
							if (in_array("right01-color", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='right01-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['sidebar-color'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['right01-color'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}						
							// opacity
							if (in_array("right01-opacity", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='right01-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['sidebar-opacity'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['right01-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							// width
							if (in_array("right01-width", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='right01-width' style='font-size: 10px;' onchange='this.form.submit();'>";
									foreach ($options_values['sidebar-width'] as $label => $value) {
										print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['right01-width'] == $value ? ' selected' : '') . ">".$label."</option>";
									}
									print "\n\t\t\t\t\t\t\t</select><br/>";
							}
							
							if (is_active_sidebar("sidebar-2") && $options['right01-width'] == 0) {
								print "<span style='font-size: 10px;'>hidden widgets!</span>";
							}

							print "</td></tr>";
					
						/*********************************************************
						 * Right Sidebar 02 Color
						 *********************************************************/
						print "<tr><td style='border-bottom: 1px dotted; text-align: right;'>\n";
						print "<div style='font-size: 10px;'>2nd Right Sidebar</div>\n";
						//print "<td style='border-bottom: 1px dotted; text-align: right;'>\n";


						if (in_array("right02-color", $variation_config['model'])) {
							print "\n\t\t\t\t\t\t\t<select name='right02-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['sidebar-color'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['right02-color'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>";
						}
						// opacity
						if (in_array("right02-opacity", $variation_config['model'])) {
							print "\n\t\t\t\t\t\t\t<select name='right02-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['sidebar-opacity'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['right02-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>";
						}
						// width
						if (in_array("right02-width", $variation_config['model'])) {
							print "\n\t\t\t\t\t\t\t<select name='right02-width' style='font-size: 10px;' onchange='this.form.submit();'>";
							foreach ($options_values['sidebar-width'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['right02-width'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select><br/>";
							
						if (is_active_sidebar("sidebar-3") && $options['right02-width'] == 0) {
							print "<span style='font-size: 10px;'>hidden widgets!</span>";
						}

						}
						print "
						</td></tr>								
					</table>						
					</td></tr>
				</table>
				";
				
				/*********************************************************
				 * Post model
				 *********************************************************/
				
				print "<div style='float: right; clear: left; font-size: 10px;'>\n";
				
					// post single sidebar options
					if (in_array("post-single-sidebar", $variation_config['model'])) {
							print "\n\t\t\t\t\t\t\tSingle Post Display: <select name='post-single-sidebar' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['post-single-sidebar'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['post-single-sidebar'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>";
					}
					print "
						</div>
						<div style='color: ".$options['linkcolor']."; font-size: 16px; font-weight: bold;'>Post Title</div>
						<span style='font-size: 9px;'>April 16th, 2009 by Author</span><br/>
						<span class='entry'>Categories: </span><span class='category'><a href='#'>Category</a></span>					
						<div class='entry' style='text-align: justify;'>
						<p>Lorem ipsum dolor sit amet, <span style='color: ".$options['linkcolor_visited'].";'>visited link</span> 
						adipiscing elit. Donec ac felis non mauris tristique vehicula. 
						Nunc commodo, justo vel imperdiet cursus, leo dui <a href='#'  style='color: ".$options['linkcolor'].";'>link</a>, vel bibendum neque justo nec ipsum. 
						Aliquam erat volutpat. <a href='#' style='color: ".$options['linkcolor'].";'>another link</a> leo tellus, sagittis id mollis non, pretium a tellus.</p>
						</div>
						<span class='entry'>Tags: </span><span class='tag'><a href='#'>tag</a></span>					
						<div class='entry' style='text-align: right;'>No Comments &#187;</div><br/>";

					/*********************************************************
					 * Text, Link, Category and Tag options
					 *********************************************************/
					
					print "
					<table width = '100%' cellpadding='0'>
					<tr><td valign='top'>	

						<table width = '100%' cellpadding='0'>
							<tr>
							<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['textcolor'].";'>Text color</span></td>							
							<td style='border-bottom: 1px dotted; text-align: right;'>";
							
							// text color options
							if (in_array("textcolor", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='textcolor' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['textcolor'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['textcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							
							print "		 							
							</td>								
							</tr><tr>
							<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['linkcolor'].";'>Link color</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>";
							
							// link color options
							if (in_array("linkcolor", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='linkcolor' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['linkcolor'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['linkcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>\n";
							}
							print "
							</td>								
							</tr><tr>";
							
							// Link style options
							print "
							<td style='border-bottom: 1px dotted;'><span class='postlink' style='font-size: 10px; color:".$options['linkcolor'].";'>Link Style</span> 
							 (<span style='font-size: 10px; color:".$options['linkcolor_visited'].";'>visited link</span>)</td>								
							<td style='border-bottom: 1px dotted; text-align: right;'>";
							
							if (in_array("entry-link-style", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='entry-link-style' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['entry-link-style'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['entry-link-style'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}


							print "
							</td></tr>							
						</table>
					</td><td valign='top' width='50%'>
						<table width = '100%' cellpadding='0'>
							<tr>";
							
							// category link style
							print "
							<td style='border-bottom: 1px dotted;'><span class='category' style='font-size: 10px;'>Category Link Style</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>";
							
							if (in_array("category-link-style", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='category-link-style' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['category-link-style'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['category-link-style'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							print "
							</td>								
							</tr><tr>";
							
							// Tag link style
							print "
							<td style='border-bottom: 1px dotted;'><span class='tag' style='font-size: 10px;'>Tag Link Style</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>\n";
							
							if (in_array("tag-link-style", $variation_config['model'])) {
								print "\n\t\t\t\t\t\t\t<select name='tag-link-style' style='font-size: 10px;' onchange='this.form.submit();'>";							
								foreach ($options_values['tag-link-style'] as $label => $value) {
									print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['tag-link-style'] == $value ? ' selected' : '') . ">".$label."</option>";
								}
								print "\n\t\t\t\t\t\t\t</select>";
							}
							print "
							</td></tr>
						</table>						
					</table>
				
			</td>";
			
			/*********************************************************
			 * right sidebar model
			 *********************************************************/

			if ($options['right01-width'] != 0) {
				print"
				<td valign='top' width='".$model_right_sidebar_width."' class='right01block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['right01-heading-color'].";'>&larr; ".$model_right_sidebar_width." px &rarr;</div>
					<div style='font-size: 8px; margin: 4px;'>
					<div style='font-size: 8px;'>
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['right01-heading-color'].";'>Right Sidebar</h2></div>
					<div class='editwidgetlink' style='font-size: 10px;'>
					<a style='color:".$options['right01-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";
							if ($options['left01-width'] == 0 && $options['right02-width'] == 0) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else if ($options['left01-width'] == 0 && $options['right02-width'] == 1) {
								print "
								1. Search<br/>
								2. Recent Posts<br/>
								3. Recent Comments<br/>";								
								
							} else {	
								print "
								1. Search<br/>
								2. Recent Posts<br/>
								3. Recent Comments<br/>
								4. Tag Cloud<br/>";							
							}
							print "
							</i>
						</div>		
						";		
					}
					print "
					</div>
					</div>	
				</td>";
			}
			/*********************************************************
			 * 2nd right sidebar model
			 *********************************************************/

			if ($options['right02-width'] != 0) {
				print"
				<td valign='top' width='".$model_right_sidebar_width02."'  class='right02block'>
					<div style='font-size: 10px; text-align: center; color: ".$options['right02-heading-color'].";'>&larr; ".$model_right_sidebar_width02." px &rarr;</div>
					<div style='font-size: 8px; margin: 4px;'>
					<div style='font-size: 8px;'>
					<h2 style='margin-bottom: 2px; margin-top: 2px; color: ".$options['right02-heading-color'].";'>2nd Right Sidebar</h2></div>
					<div class='editwidgetlink' style='font-size: 10px;'>
					<a style='color:".$options['right02-link-color'].";' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
					if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";
							if ($options['left01-width'] == 0 && $options['right01-width'] == 0 ) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
							} else if ($options['left01-width'] == 0 && $options['right01-width'] == 1) {
								print "
								1. Pages<br/>
								2. Categories<br/>
								3. Tag Cloud<br/>";
							} else {
								print "
								1. Pages<br/>
								2. Categories<br/>
								3. Tag Cloud<br/>";							
							}
							print "
							</i>
						</div>		
						";		
					}
					print "
					</div>
					</div>	
				</td>";
			}
			print "	
			</tr>
		</table>
	
	</td></tr>
	<tr>
		<td colspan='3' style='background-color: transparent;'>
		<table width='100%' cellspacing='2' cellpadding='0'>
		<tr>
		<td class='bottomblock'>";	
		
		/*********************************************************
		 *  bottom bar model
		 *********************************************************/
		
		if ($options['model-instructions'] == "init" || $options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='margin: 2px;'>	
				<span style='font-size: 8px;'><i>Use this area for additional RSS feeds, links to other related sites.  Recommended widgets: Text/HTML, RSS</i></span>
			</div>		
			";		
		}		
		print "	
		<h2 style='padding-top: 0px; font-size: 10px; float: left;'>Bottom Bar</h2>
		<div class='editwidgetlink' style='text-align: left; width: 65%; float: left;'>
		<a style='color:".$options['bottom-link-color']."; font-size: 10px; margin: 1px; padding: 1px;' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
		</div>
		<div class='horizontalbar' style='font-size: 8px; float: right;'>";
		
		// color
		if (in_array("bottom-color", $variation_config['model'])) {
			print "\n\t\t\t\t\t\t\t<select name='bottom-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
			foreach ($options_values['sidebar-color'] as $label => $value) {
				print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['bottom-color'] == $value ? ' selected' : '') . ">".$label."</option>";
			}
			print "\n\t\t\t\t\t\t\t</select>";
		}
		// opacity
		if (in_array("bottom-opacity", $variation_config['model'])) {
			print "\n\t\t\t\t\t\t\t<select name='bottom-opacity' style='font-size: 10px;' onchange='this.form.submit();'>";							
			foreach ($options_values['sidebar-opacity'] as $label => $value) {
				print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['bottom-opacity'] == $value ? ' selected' : '') . ">".$label."</option>";
			}
			print "\n\t\t\t\t\t\t\t</select>";
		}

		print "
		</div>
		</td>
		</tr>
		</table>
	</tr>
	</table>
	<table width='100%' cellpadding='5'>
	<tr><td width='80%'>
	<div class='metatext'>";

		if ($options['footerleft'] == "") {
			print "no links defined...";
		} else {
			print $options['footerleft'];
		}
		if ($options['footer-meta-left'] == 'custom') {
			print "
				<input id='footerleftdo' type='hidden' name='footerleftdo' value='0'/> - 
		
				<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"block\"; document.getElementById(\"footerleftdo\").value = \"1\"; exit;'>edit</a>
				
				<div id='footerleftedit' style='display: none;'>
				
				<textarea name='footerleftcustom' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
				print stripslashes(stripslashes(trim($options['footerleftcustom'])));
				print "</textarea>		
				&nbsp;&nbsp;&nbsp;
				<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"none\"; document.getElementById(\"footerlefteditdo\").value = \"0\"; exit;'>Cancel</a> - 
				<span class='submit'><input type='submit' value='Update' name='save'/></span>	
				</div>
			";
	
			print "</div>\n";
		}
		
	print "

	</td><td valign='bottom' width='20%'>
	<div style='font-size: 9px; text-align: right; color: ".$options['bgtextcolor'].";'>";
		print $options['theme-name'];
	print "
	| WordPress
	</div>
	</td></tr>
	</table>";

	print "</div>";
		// footer meta left appgroups options	
	if (in_array("footer-meta-left", $variation_config['model'])) {
		print "<span style='font-size: 9px;'>Footer Links:</span>\n";
		print "<select name='footer-meta-left' style='font-size: 10px;'  onchange='this.form.submit();'>";
		foreach (array_keys($variation_config['footer_meta_left_options']) as $meta_left_option) {						
			print "<option value='".$variation_config['footer_meta_left_options'][$meta_left_option]['option_name']."' ";
			print ($options['footer-meta-left'] == $variation_config['footer_meta_left_options'][$meta_left_option]['option_name'] ? ' selected' : '') . ">";
			print $variation_config['footer_meta_left_options'][$meta_left_option]['option_label']."</option>";						
		}
		print "</select>";
	}
	// end options		

	/*********************************************************
	 * ShadowBox Theme instructions and Save Changes button
	 *********************************************************/
    print
    "<table width = '".$model_site_width."' align='center' cellpadding='5' cellspacing='5' border='0'>
    <tr><td valign='top'>
    <span class='submit'><input type='submit' value='Update' name='save'/></span>
    </td><td>
    <div class='instructions'>	
	When chosing options think about colors and contrasts that complement your content.  For example, if your site focuses on links, be sure your link color contrasts with your 
	text color so links will stand out.  Chose the black theme for blogs that highlight images.  <br/>
	</div>
	</td></tr>
	</table>
	<div style='float: right;'>
	<span class='submit'><input type='submit' value='Revert to Default' name='reset'/></span><br/>
	<span style='font-size: 10px;'>(Recreates Variations options)</span>
	</div>
	</form>";

}	

/*********************************************************
 * ShadowBox save options
 *********************************************************/

function save_options() {
    global $_POST, $options, $variation_css, $variation_config;
    global $theme_settings, $theme_css;
	
	// options are those exposed in the UI
	set_primary_options();
	
	// options specific to a particular variation
	set_variation_options();
	
	if ($options['site-width'] == 100) {
		$sitewidth = $options['site-width']-10;
		$sitewidth = $sitewidth."%";
	} else {
		$sitewidth = $options['site-width']."px";
	}

	if ($options['header-width'] == 100) {
		$headerwidth = $options['header-width']-10;
		$headerwidth = $headerwidth."%";
	} else {
		$headerwidth = $options['header-width']."px";
	}

	/******************************************************************************
	 * add theme options to theme CSS
	 ******************************************************************************/
	
	$variation_css =
	"	
		body {
			font-size: 62.5%;
			font-family:'Helvetica Neue',Arial,Helvetica,sans-serif;
			color: ".$options['textcolor'].";
			background-color: ".$options['background_color'].";
			background-image: ".$options['background_image'].";
			background-repeat: ".$options['background_repeat'].";
			background-position: ".$options['background_position'].";	 
			margin-top: 10px;
		}
	
		.sitewrapper {
			width: ".$sitewidth.";
			margin-left: auto;
			margin-right: auto;
			margin-top: ".$options['site-margin-top']."px;
		}

		.headerwrapper {
			width: ".$headerwidth.";
			margin-left: auto;
			margin-right: auto;
		}

		.block_background .block_background_content {
			background-color: ".$options['content-background'].";
			padding: 15px;
			text-align: left;
			margin: 0px;
		}
				
		.block_foreground {
		
		}

		.page_top {
			background-image: ".$options['page_top_background_image'].";
			background-repeat: no-repeat;
			background-position: center;
			border-top: 1px none #000000;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_top_padding']."px;
			margin-top: ".$options['page_top_margin']."px;
		}
		
		.page_main {
			background-color: transparent;
			background-image:  ".$options['page_main_background_image']."; 
			background-repeat: repeat-y; 
			background-position: center;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_main_top_padding']."px;
			padding-right: ".$options['page_main_padding']."px;
			padding-left: ".$options['page_main_padding']."px;
		}
				
		.page_bottom {
			background-color: transparent;
			background-image:  ".$options['page_bottom_background_image'].";
			background-repeat: no-repeat; 
			background-position: center;
			border-bottom: 1px none #000000;
			border-left: 1px none #000000;
			border-right: 1px none #000000;
			padding-top: ".$options['page_bottom_padding']."px;
			margin-bottom: ".$options['page_bottom_margin']."px;
		}

		#header {
			border-bottom: 1px ".$options['header-border-style']." ".$options['header-border02-top'].";
			border-top: 1px ".$options['header-border-style']." ".$options['header-border02-bottom'].";
			margin: 0 0 0 1px;
			padding: 0 2px 0 2px;
		}

		.headermeta_left {
			font-size: 12px;
			width: 50%;	
			text-align: left;
			margin-left: ".$options['header-meta-left-margin'].";
		}
		
		.headermeta_right {
			font-size: 12px;
			width: 45%;
			text-align: right;
			float: right;
			clear: left;
			margin-right: ".$options['header-meta-right-margin'].";
		}
		
		.footermeta_left {
			font-size: 12px;
			width: 50%;	
			text-align: left;
			margin-left: ".$options['footer-meta-left-margin'].";
			padding-top: 5px;
			padding-bottom: 10px;
		}
		
		.footermeta_right {
			font-size: 12px;
			width: 40%;
			text-align: right;
			float: right;
			margin-right: ".$options['footer-meta-right-margin'].";
			padding-top: 5px;
			padding-bottom: 10px;
		}


		.contentblock, .widecolumn, .narrowcolumn {
			color: ".$options['content-text-color'].";
			background-color: ".$options['content-color-rgb'].";
			border-top: 1px none ".$options['content-border-top'].";
			border-bottom: 1px none ".$options['content-border-bottom'].";
			border-left: 1px none ".$options['content-border-left'].";
			border-right: 1px none ".$options['content-border-right'].";
			padding-right: 30px;
			padding-left: 20px;
		}

		h1, h2, h3 {
			color: #999999;
			border-bottom: 1px solid #CCCCCC;
		}
		
		a, h2 a:hover, h3 a:hover {
			color: ".$options['linkcolor'].";
			text-decoration: none;
		}
		
		a:hover {
			color: ".$options['linkcolor'].";
			border-bottom:1px solid ".$options['linkcolor'].";
			text-decoration: none;
		}

		.headerblock {
			color: ".$options['header-text-color'].";
			background-color: ".$options['header-color-rgb'].";
			border-top: 1px ".$options['header-border-style']." ".$options['header-border-top'].";
			border-bottom: 1px ".$options['header-border-style']." ".$options['header-border-bottom'].";
			border-left: 1px ".$options['header-border-style']." ".$options['header-border-left'].";
			border-right: 1px ".$options['header-border-style']." ".$options['header-border-right'].";				
			padding-top: 0px;
			height: ".$options['header-block-height']."px;
		}
		
		.headerblock:hover {
			background-color: ".$options['header-color-hover-rgb'].";
			border-top: 1px ".$options['header-hover-border-style']." ".$options['header-border-top'].";
			border-bottom: 1px ".$options['header-hover-border-style']." ".$options['header-border-bottom'].";
			border-left: 1px ".$options['header-hover-border-style']." ".$options['header-border-left'].";
			border-right: 1px ".$options['header-hover-border-style']." ".$options['header-border-right'].";	 
		}

		.topblock {
			color:  ".$options['top-text-color'].";
			background-color: ".$options['top-color-rgb'].";
			border-bottom: 1px ".$options['header-border-style']." ".$options['header-border-bottom'].";					
			padding-top: 3px;
			padding-bottom: 1px;
			padding-left: 10px;
		}
		
		.topblock a {
			color: ".$options['top-link-color'].";		
		}

		.topblock a:hover {
			color: ".$options['top-link-color'].";	
			border-bottom: 1px solid ".$options['topbar-link-color'].";	
		}

		.bottomblock {
			color:  ".$options['bottom-text-color'].";
			background-color: ".$options['bottom-color-rgb'].";
			border-top: 1px ".$options['bottom-border-style']." ".$options['bottom-border-top'].";
			border-bottom: 1px ".$options['bottom-border-style']." ".$options['bottom-border-bottom'].";
			border-left: 1px ".$options['bottom-border-style']." ".$options['bottom-border-left'].";
			border-right: 1px ".$options['bottom-border-style']." ".$options['bottom-border-right'].";				
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 10px;
			margin-right: 5px;
		}
		
		.bottomblock:hover {
			background-color: ".$options['bottom-color-hover-rgb'].";
		}		

		.bottomblock a {
			color: ".$options['bottom-link-color'].";		
		}

		.bottomblock a:hover {
			color: ".$options['bottom-link-color'].";	
			border-bottom: 1px solid ".$options['bottom-link-color'].";	
		}
		
		div .hr {
			color: ".$options['header-border-top'].";
			background-color: ".$options['header-border02-top'].";
			height: ".$options['header-border02-height']."px;
			margin-right: -1px;
			margin-left: -1px;
			margin-bottom: 0px;
		}
		
		.headertext a {
			display: ".$options['show-header-text'].";
			padding-top: ".$options['header-text-padding-top']."px;
			padding-left: ".$options['header-text-padding-left']."px;
			color: ".$options['header-blogtitle-color'].";
			font-size: ".$options['header-blogtitle-size']."px;
			font-weight: normal;	
			border-bottom: none;
		}

		.headertext a:hover {
			display: ".$options['show-header-text'].";
			padding-top: ".$options['header-text-padding-top']."px;
			padding-left: ".$options['header-text-padding-left']."px;
			color: ".$options['header-blogtitle-color'].";	
			border-bottom: none;
		}

		
		.headerblock .description {
			display: ".$options['show-header-text'].";
			padding-left: 15px;
			color: ".$options['header-blogdescription-color'].";
			font-size: 12px;
		}
		
		/* Begin sidebar list */
		.sidebarleft01 ul ul li, .sidebarleft01 ul ol li {
			font-size: 12px;
			color: ".$options['left01-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}
		
		.sidebarright01 ul ul li, .sidebarright01 ul ol li {
			font-size: 12px;
			color: ".$options['right01-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}

		.sidebarright02 ul ul li, .sidebarright02 ul ol li {
			font-size: 12px;
			color: ".$options['right02-text-color'].";
			list-style-type:none;
			margin: 3px 0 -4px;
			padding: 3px;
			padding-right: 10px;
		}
		
		/* Begin sidebar search form */
		.sidebarleft01  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;			
		}

		.sidebarright01  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;				
		}

		.sidebarright02  #searchform #s {
			background-color: ".$options['searchbox-color'].";
			color: ".$options['linkcolor'].";
			border: 1px solid #999999;
			width: 108px;
			padding: 2px;			
		}

		/* Begin block color borders and opacity */
		.left01block {
			color: ".$options['left01-text-color'].";
			background-color: ".$options['left01-color-rgb'].";
			border-top: 1px ".$options['left01-border-style']." ".$options['left01-border-top'].";
			border-bottom: 1px ".$options['left01-border-style']." ".$options['left01-border-bottom'].";
			border-left: 1px ".$options['left01-border-style']." ".$options['left01-border-left'].";
			border-right: 1px ".$options['left01-border-style']." ".$options['left01-border-right'].";
		}

		.left01block:hover {
			background-color: ".$options['left01-color-hover-rgb'].";
		}
				
		.right01block {
			color: ".$options['right01-text-color'].";
			background-color: ".$options['right01-color-rgb'].";
			border-top: 1px ".$options['right01-border-style']." ".$options['right01-border-top'].";
			border-bottom: 1px ".$options['right01-border-style']." ".$options['right01-border-bottom'].";
			border-left: 1px ".$options['right01-border-style']." ".$options['right01-border-left'].";
			border-right: 1px ".$options['right01-border-style']." ".$options['right01-border-right'].";
		}
		
		.right01block:hover {
			background-color: ".$options['right01-color-hover-rgb'].";
		}

		.right02block {
			color: ".$options['right02-text-color'].";
			background-color: ".$options['right02-color-rgb'].";
			border-top: 1px ".$options['right02-border-style']." ".$options['right02-border-top'].";
			border-bottom: 1px ".$options['right02-border-style']." ".$options['right02-border-bottom'].";
			border-left: 1px ".$options['right02-border-style']." ".$options['right02-border-left'].";
			border-right: 1px ".$options['right02-border-style']." ".$options['right02-border-right'].";
		}

		.right02block:hover {
			background-color: ".$options['right02-color-hover-rgb'].";
		}
		
		/* Begin sidebar text, width and visibility  */
		.sidebarleft01 {
			color: ".$options['left01-text-color'].";
			width: ".$options['left01-width']."px;
			visibility: ".$options['left01-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}

		.sidebarright01 {
			width: ".$options['right01-width']."px;
			visibility: ".$options['right01-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}

		.sidebarright02 {
			width: ".$options['right02-width']."px;
			visibility: ".$options['right02-visibility'].";
			padding-left: 25px;
			padding-right: 25px;
		}
		
		/* Begin sidebar links */
		.sidebarleft01 a {
			color: ".$options['left01-link-color'].";
			border-bottom:1px dotted ".$options['left01-link-color'].";
		}
				
		.sidebarleft01 a:hover {
			color: ".$options['left01-link-color'].";
			border-bottom:1px solid ".$options['left01-link-color'].";
		}
		
		.sidebarright01 a {
			color: ".$options['right01-link-color'].";
			border-bottom:1px dotted ".$options['right01-link-color'].";
		}
				
		.sidebarright01 a:hover {
			color: ".$options['right01-link-color'].";
			border-bottom:1px solid ".$options['right01-link-color'].";
		}

		.sidebarright02 a {
			color: ".$options['right02-link-color'].";
			border-bottom:1px dotted ".$options['right02-link-color'].";
		}

		.sidebarright02 a:hover {
			color: ".$options['right02-link-color'].";
			border-bottom:1px solid ".$options['right02-link-color'].";
		}		
		
		/* Begin sidebar headings */
		.topblock h2 {
			color: ".$options['top-link-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}

		.bottomblock h2 {
			color: ".$options['bottom-link-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}

		.sidebarleft01 h2 {
			color: ".$options['left01-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}
				
		.sidebarright01 h2 {
			color: ".$options['right01-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}

		.sidebarright02 h2 {
			color: ".$options['right02-heading-color'].";
			padding-left: 0px;
			border-bottom: 1px none #CCCCCC;
		}
		
		/* Begin entry/post links */
		
		.post h2  {
			color: ".$options['content-heading-color'].";
			border-bottom: none;
		}
		.post h2 a {
			display: block;
			text-align: left;
			border-bottom: 1px solid #CCCCCC;
		}
		
		.post h2 a:hover {
			border-bottom: 1px solid ".$options['content-link-color'].";
		}
		
		.entry a {
			color: ".$options['linkcolor'].";	
			text-decoration:none;
			border-bottom: 1px ".$options['entry-link-border'].";
			padding:0.07em;
		}

		.entry a:hover {
			border-bottom: 1px ".$options['entry-link-hover-border']."; 
			background-color: ".$options['entry-link-hover-background_color'].";
		}

		.entry a:visited {
			color: ".$options['linkcolor_visited'].";		
			border-bottom: 1px ".$options['entry-link-border'].";
		}

		.entry .morelink a {
			display: block;			
			text-align: center;
			border-top: 1px solid #CCCCCC;
			border-bottom: 1px dotted #CCCCCC;
			text-decoration: none;
		}
		
		.morelink a:hover {
			background-color: transparent;
			color: ".$options['linkcolor'].";
			border-top: 1px solid ".$options['content-link-color'].";
			border-bottom: 1px dotted ".$options['content-link-color'].";
		}

		.postmetadata.alt {
			clear: both;
			text-align: center;
			margin-top: 10px;
			border-top: 1px solid #CCCCCC;
			border-left: 1px none #CCCCCC;
		}
		
		
		.postmetadata.alt:hover {
			border-top: 1px solid ".$options['content-link-color'].";
		}
		
		.postmetadata.alt a {
			display: block;
			color: ".$options['content-link-color'].";
			padding-bottom: 2px;
			border-bottom: 1px dotted #CCCCCC;
			text-decoration: none;
		}
		
		.postmetadata.alt a:hover {
			background-color: transparent;
			color: ".$options['content-link-color'].";
			border-bottom: 1px dotted ".$options['content-link-color'].";
		}
		
		/* Begin tag links */
		.tag a {
			-moz-border-radius-bottomleft:3px; 
			-moz-border-radius-bottomright:3px; 
			-moz-border-radius-topleft:3px; 
			-moz-border-radius-topright:3px; 
			color:".$options['tag-link-color'].";
			background-color:".$options['tag-link-background'].";
			border:1px solid #ccc; 
			cursor:pointer; 
			display:inline-block; 
			margin:2px 0.2em; padding:0.1em 0.2em;			
		}
		
		.tag a:hover {
			text-decoration: ".$options['tag-link-hover-decoration'].";
			background-color: ".$options['category-link-background'].";
		}
		
		/* Begin category links */
		.category a {
			-moz-border-radius-bottomleft:3px; 
			-moz-border-radius-bottomright:3px; 
			-moz-border-radius-topleft:3px; 
			-moz-border-radius-topright:3px; 
			color:".$options['category-link-color'].";
			background-color:".$options['category-link-background'].";
			border:1px solid #ccc; 
			cursor:pointer; 
			display:inline-block; 
			margin:2px 0.2em; padding:0.1em 0.2em;	
		}

		.category a:hover {
			text-decoration: ".$options['category-link-hover-decoration'].";
			background-color: ".$options['tag-link-background'].";
		}		
		
		/* Begin editing UI links */
		.postlink a {
			display: block;
			border: 1px dotted ".$options['linkcolor'].";
			text-align: center;
			padding: 5px;
			margin-top: 10px;
		}

		.postlink a:hover {
			display: block;
			border: 1px solid ".$options['linkcolor'].";
			text-align: center;
			padding: 5px;
			margin-top: 10px;
		}

		.editlink a {
			display: block;
			border: 1px dotted ".$options['linkcolor'].";
			text-align: center;
			text-decoration: none;
			padding: 1px;
			margin-top: 10px;
			margin-bottom: 10px;
		}

		.editlink a:hover {
			background-color: transparent;
			text-decoration: none;
			border: 1px solid ".$options['linkcolor'].";
		}

		h2 {
			color: ".$options['textcolor'].";
			text-decoration: none;
		}
				
		/* Begin comments */
		#commentform textarea {
			background-color: ".$options['thread-even-bgcolor'].";
			color: ".$options['commentfield'].";
		}

		.thread-alt {
			background-color: ".$options['thread-alt-bgcolor'].";
		}
		.thread-even {
			background-color: ".$options['thread-even-bgcolor'].";
		}
		
		/* Begin background text and link color */
		.bgtextcolor {
			color: ".$options['bgtextcolor'].";
		}

		.bgtextcolor a {
			color: ".$options['bglinkcolor'].";
		}

		.bgtextcolor a:hover {
			color: ".$options['bglinkcolor'].";
			border-bottom: 1px solid ".$options['bglinkcolor'].";
		}
		
		small, .nocomments, .postmetadata, blockquote, strike {		
			color: ".$options['textcolor'].";
		}	
					
	";
		
	update_option($theme_settings, $options);
	update_option($theme_css, $variation_css);
	
	print_option_feedback();
	
}

/*********************************************************
 * set primary options (options exposed to user in model)
 *********************************************************/
 
function set_primary_options() {
	global $_POST, $options, $allowedposttags, $variation_config;
	
	foreach ($variation_config['model'] as $option => $value) {

		//sanitize options that contain HTML
		if ($option == "headerleftcustom") {
			$options['headerleftcustom'] = wp_kses($_POST['headerleftcustom'], $allowedposttags);
		} else if ($option == "footerleftcustom") {
			$options['footerleftcustom'] = wp_kses($_POST['footerleftcustom'], $$allowedposttags);
		
		// replaces any characters that are not allowed with null
		} else if (isset($_POST[$value]))  {
			$options[$value] = preg_replace('/[^0-9a-z%#,\.\s-+_\/:~]/i','', stripslashes($_POST[$value]));
		}	
	}
	

	if (isset($_POST['model-instructions'])) {
		$options['model-instructions'] = "on";
	} else if (!isset($_POST['model-instructions']) || $options['model-instructions'] == "off") {
		$options['model-instructions'] = "off";
	} else {
		$options['model-instructions'] = "on";
	}
}

/******************************************************************************
 * set options for variations (set with options['background'])
 * 
 ******************************************************************************/

function set_variation_options() {
	global $_POST, $options, $options_values, $variations;

	/******************************************************************************
	 * Default options and option value lists
	 ******************************************************************************/

	if (file_exists(dirname(__FILE__).'/variations/default/variation.php')) {
		include('variations/default/variation.php');		
	}

	/*********************************************************
	 * Custom backgrounds
	 * Following options are set in the model UI
	 * background_image_url, background_color
	 * background_repeat, background_position
	 * bgtextcolor, bglinkcolor
	 *********************************************************/
	if ($options['background'] == "custom") {			
		$options['background_image'] = "url('".$options['background_image_url']."')";	
		$options['background_color'] = $options['custom_background_color'];
		$options['background_repeat'] = $options['custom_background_repeat'];
		$options['background_position'] = $options['custom_background_position'];
		$options['bgtextcolor'] = $options['custom_bgtextcolor'];
		$options['bglinkcolor'] = $options['custom_bglinkcolor'];
		$options['transparent-blogtitle-color'] = $options['custom_header_color'];
		$options['transparent-blogdescription-color'] = $options['custom_bgtextcolor'];
		$options['transparent-heading-color'] = $options['custom_header_color'];
		$options['transparent-link-color']  = $options['custom_bglinkcolor'];
		$options['transparent-text-color']  = $options['custom_bgtextcolor'];
		$options['background-source-url'] = $options['custom_background-source-url'];
		$options['background-source-credit'] = $options['custom_background-source-credit'];
	} 

	/******************************************************************************
	 * Defaults for variations
	 * variations use defaults unless otherwise specified
	 * variations can have default option values and default option value lists
	 * option value lists are the option values users can select in the theme model UI
	 * (variation info in extracted from variation.php file using same functions
	 * used to extract theme info rom theme style.php
	 ******************************************************************************/
	
	$variations = array();
	
	if (file_exists(dirname(__FILE__).'/variations')) {
		$variation_path = dirname(__FILE__).'/variations';
		
		if ($handle = opendir($variation_path)) {
			while (false !== ($file = readdir($handle))) {
				
				if (is_dir($variation_path.'/'.$file) && $file !="default") {
					
					if (file_exists($variation_path.'/'.$file.'/variation.php')) {
						include($variation_path.'/'.$file.'/variation.php');
						
						$variation_data = implode( '', file( $variation_path.'/'.$file.'/variation.php' ) );
						$variation_data = str_replace ( '\r', '\n', $variation_data );
						
						// get variation name
						if ( preg_match( '|Variation Name:(.*)$|mi', $variation_data, $variation_name ) )
							$name = $variation = wp_kses( _cleanup_header_comment($variation_name[1]), $themes_allowed_tags );
						else
							$name = $variation = '';
						
						// get variation id
						if ( preg_match( '|Variation ID:(.*)$|mi', $variation_data, $variation_id ) )
							$id = $variation = wp_kses( _cleanup_header_comment($variation_id[1]), $themes_allowed_tags );
						else
							$id = $variation = '';						
						$variations[$name] = $id;
					}
				}
			}			
		}
		closedir($handle);
		ksort($variations);
		
	}
		
	// if no variation has been selected then use theme defaults
	if (isset($_POST)) {
		if (!in_array($options['header-color'], array_values($options_values['sidebar-color']))) $options['header-color'] = "#F9F9F9";
		if (!in_array($options['top-color'], array_values($options_values['sidebar-color']))) $options['top-color'] = "#FFFFFF";
		if (!in_array($options['left01-color'], array_values($options_values['sidebar-color']))) $options['left01-color'] = "#F3F3F3";
		if (!in_array($options['content-color'], array_values($options_values['sidebar-color']))) $options['content-color'] = "#FFFFFF";
		if (!in_array($options['right01-color'], array_values($options_values['sidebar-color']))) $options['right01-color'] = "#F3F3F3";
		if (!in_array($options['right02-color'], array_values($options_values['sidebar-color']))) $options['right02-color'] = "#F3F3F3";
		if (!in_array($options['bottom-color'], array_values($options_values['sidebar-color']))) $options['bottom-color'] = "#FFFFFF";
		if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#003366";
		if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#444444";
		if (!in_array($options['entry-link-style'], array_values($options_values['entry-link-style']))) $options['entry-link-style'] = "underline";
		if (!in_array($options['header-blogtitle-color'], array_values($options_values['linkcolor']))) $options['header-blogtitle-color'] = $options['linkcolor'];	
	}
	
	set_derivative_options();	
}


/*********************************************************
 * Set directive options uses primary options (i.e. those exposed in UI)
 * to set derivative options
 *********************************************************/

function set_derivative_options() {
	global $variation_config, $_POST, $options, $options_values;

	/******************************************************************************
	 * Header left links (derived from  header_meta_left_options
	 ******************************************************************************/

	if ($options['header-meta-left'] == 'blogs' && $variation_config['header_meta_left_options']['blog'] == "") {
		$options['headerleft'] = "<a href='http:".$current_site->domain . $current_site->path."wp-signup.php' title='View your Blogs'>WordPress</a>";
	} else if ($options['header-meta-left'] == 'custom') {
		$options['headerleft'] = stripslashes($options['headerleftcustom']);
	} else {
		$options['headerleft'] = $variation_config['header_meta_left_options'][$options['header-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Header right links (derived from header_meta_right_options)
	 ******************************************************************************/

	if (isset($variation_config['header_meta_right_options'])) {
		$options['headerright'] = $variation_config['header_meta_right_options']['option_value'];
	} else {
		$options['headerright'] = "";
	}

	/******************************************************************************
	 * Footer left links (derived from meta_right_options
	 ******************************************************************************/

	if ($options['footer-meta-left'] == 'custom') {
		$options['footerleft'] = stripslashes($options['footerleftcustom']);
	} else {
		$options['footerleft'] = $variation_config['footer_meta_left_options'][$options['footer-meta-left']]['option_value'];					
	}

	/******************************************************************************
	 * Blog title and description display option 
	 * (derived from header-text-display and header-block-height options)
	 ******************************************************************************/
	if ($options['header-text-display'] != "hide") {
		$options['show-header-text'] = "block";
	} else {
		$options['show-header-text'] = "none";
	}
	
	if ($options['header-text-display'] == "top") {
		$options['header-text-padding-top'] = 3;
		
	} else if ($options['header-text-display'] == "middle") {
		if ($options['header-block-height'] == 50) {
			$options['header-text-padding-top'] = 5;
		} else if ($options['header-block-height'] == 70) {
			$options['header-text-padding-top'] = 10;
		} else if ($options['header-block-height'] == 100) {
			$options['header-text-padding-top'] = 25;		
		} else if ($options['header-block-height'] == 125) {
			$options['header-text-padding-top'] = 45;		
		} else if ($options['header-block-height'] == 150) {
			$options['header-text-padding-top'] = 55;		
		} else if ($options['header-block-height'] == 175) {
			$options['header-text-padding-top'] = 65;		
		} else if ($options['header-block-height'] == 200) {
			$options['header-text-padding-top'] = 80;
		} else if ($options['header-block-height'] == 225) {
			$options['header-text-padding-top'] = 90;
		} else if ($options['header-block-height'] == 250) {
			$options['header-text-padding-top'] = 110;
		} else if ($options['header-block-height'] == 300) {
			$options['header-text-padding-top'] = 145;
		}
		
	} else if ($options['header-text-display'] == "bottom") {
		$options['header-text-padding-top'] = $options['header-block-height'] - 50;
		
	} else {
		$options['header-text-padding-top'] = 15;
	}

	/******************************************************************************
	 * visited link color options (derived from link and text colors
	 ******************************************************************************/
	
	// dark blue or gold
	if ($options['linkcolor'] == '#003366' || $options['linkcolor'] == '#625b1d') {	
		// black
		if ($options['textcolor'] == '#222222') {
			$options['linkcolor_visited'] = "#000000";
		// 80% gray
		} else if ($options['textcolor'] == '#333333') {
			$options['linkcolor_visited'] = "#000000";
		// 70% gray
		} else if ($options['textcolor'] == '#444444') {
			$options['linkcolor_visited'] = "#000000";
		// 60% gray
		} else if ($options['textcolor'] == '#555555') {
			$options['linkcolor_visited'] = "#000000";
		// 50% gray
		} else if ($options['textcolor'] == '#666666') {
			$options['linkcolor_visited'] = "#000000";
		// 40% gray
		} else if ($options['textcolor'] == '#777777') {
			$options['linkcolor_visited'] = "#000000";
		// 30% gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#333333";
		// 20% gray
		} else if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#333333";
		// 10% gray	
		} else if ($options['textcolor'] == '#EEEEEE') {
			$options['linkcolor_visited'] = "#CCCCCC";
		}
		
		
	//  light blue
	} else if ($options['linkcolor'] == '#0066cc') {	
		$options['linkcolor_visited'] = "#003366";
	// red
	} else if ($options['linkcolor'] == '#990000') {	
		$options['linkcolor_visited'] = "#996666";
	// green
	}  else if ($options['linkcolor'] == '#265e15') {	
		$options['linkcolor_visited'] = "#6D9C54";
		
	// pale yellow
	}  else if ($options['linkcolor'] == '#FFFFCC') {	
		// light gray
		if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFFFF";
		// gray
		} else if ($options['textcolor'] == '#888888') {
			$options['linkcolor_visited'] = "#FFFBEE";
		// silver
		} else if ($options['textcolor'] == '#F9F9F9') {
			$options['linkcolor_visited'] = "#888888";
		}	
	// yellow
	}  else if ($options['linkcolor'] == '#FFCC33') {
	
		// light gray
		if ($options['textcolor'] == '#CCCCCC') {
			$options['linkcolor_visited'] = "#FFFBEE";
		// gray
		} else if ($options['textcolor'] == '#666666') {
			$options['linkcolor_visited'] = "#FFFBEE";
		// silver
		} else if ($options['textcolor'] == '#F9F9F9') {
			$options['linkcolor_visited'] = "#FFFBEE";
		}
	
	// black
	}  else if ($options['linkcolor'] == '#151515') {	
		$options['linkcolor_visited'] = "#6E6E6E";	
	
	}


	/******************************************************************************
	 * Entry link style options
	 ******************************************************************************/	

	if ($options['entry-link-style'] == "none") {
		$options['entry-link-border'] = "none";
		$options['entry-link-hover-border'] = "solid";
		$options['entry-link-hover-background_color'] = $options['foreground_color'];
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "underline";
		
	} else if ($options['entry-link-style'] == "underline") {
		$options['entry-link-border'] = "dotted";
		$options['entry-link-hover-border'] = "solid"; 
		$options['entry-link-hover-background_color'] = $options['foreground_color'];
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "underline";
		
	} else if ($options['entry-link-style'] == "box") {
		$options['entry-link-border'] = "dotted";
		$options['entry-link-hover-border'] = "solid";
		$options['entry-link-hover-background_color'] = $options['foreground_color'];
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "none";
		
	//ww style links
	} else if ($options['entry-link-style'] == "ww") {
		$options['entry-link-border'] = "dotted ";
		$options['entry-link-hover-border'] = "solid";
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "none";
		if ($options['content-color'] == '#000000') {
			$options['entry-link-hover-background_color'] = "#262626";
		} else if ($options['content-color'] == '#262626') {
			$options['entry-link-hover-background_color'] = "#000000";
		} else {
			$options['entry-link-hover-background_color'] = "#efc";
		}
		
	}

	/******************************************************************************
	 * sidebar color and link options
	 ******************************************************************************/	

	$widget_bars = array('top', 'bottom', 'left01', 'right01', 'right02', 'header', 'content');
	
	foreach($widget_bars as $bar) {
		
		// white
		if ($options[$bar.'-color'] == '#FFFFFF') {
			$options[$bar.'-border-style'] = "none";
			$options[$bar.'-heading-color'] = "#666666";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#666666";
				$options[$bar.'-border02-top'] = "#CCCCCC";
				$options[$bar.'-border02-bottom'] = "#CCCCCC";
			}
		// gray blue
		} else if ($options[$bar.'-color'] == '#364559') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#CCCC99";
			$options[$bar.'-link-color'] = "#EEEEEE";
			$options[$bar.'-text-color'] = "#CCCCCC";
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#FFFFFF";
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// black
		} else if ($options[$bar.'-color'] == '#000000' || $options[$bar.'-color'] == '#262626') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#FFFFFF";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#FFFFCC";
				$options[$bar.'-border02-bottom'] = "#FFFFCC";
			}
		// green	
		} else if ($options[$bar.'-color'] == '#83A776') {
			$options[$bar.'-border-top'] = "#666666";
			$options[$bar.'-border-left'] = "#666666";
			$options[$bar.'-border-bottom'] = "#666666";
			$options[$bar.'-border-right'] = "#666666";
			$options[$bar.'-heading-color'] = "#FFFFFF";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// muted yellow
		}  else if ($options[$bar.'-color'] == '#e9e9c9') {
			$options[$bar.'-border-top'] = "#999999";
			$options[$bar.'-border-left'] = "#999999";
			$options[$bar.'-border-bottom'] = "#999999";
			$options[$bar.'-border-right'] = "#999999";
			$options[$bar.'-heading-color'] = "#AAA448";
			$options[$bar.'-link-color'] = "#FFFFFF";
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = $options['textcolor'];
				$options[$bar.'-border02-top'] = "#333333";
				$options[$bar.'-border02-bottom'] = "#333333";
			}
		// all other colors
		}  else {
			$options[$bar.'-border-top'] = "#CCCCCC";
			$options[$bar.'-border-left'] = "#CCCCCC";
			$options[$bar.'-border-bottom'] = "#CCCCCC";
			$options[$bar.'-border-right'] = "#CCCCCC";
			$options[$bar.'-heading-color'] = "#333333";
			$options[$bar.'-link-color'] = $options['linkcolor'];
			$options[$bar.'-text-color'] = $options['textcolor'];
			if ($bar == "header") {
				$options[$bar.'-blogtitle-color'] = $options['linkcolor'];
				$options[$bar.'-blogdescription-color'] = "#666666";
				$options[$bar.'-border02-top'] = "#999999";
				$options[$bar.'-border02-bottom'] = "#999999";
			}			
		} 
		

		/******************************************************************************
		 * Only variations with dark background colors or images should have 
		 * different colors for low opacity settings
		 ******************************************************************************/

		if ($options[$bar.'-opacity'] < .7) {
			$options[$bar.'-blogtitle-color'] = $options['transparent-blogtitle-color'];
			$options[$bar.'-blogdescription-color'] = $options['transparent-blogdescription-color'];
			$options[$bar.'-heading-color'] = $options['transparent-heading-color'];
			$options[$bar.'-link-color'] = $options['transparent-link-color'];
			$options[$bar.'-text-color'] = $options['transparent-text-color'];						
		}
		
		// opacity			
		$options[$bar.'-color-rgb'] = "rgba(".hex2rgb($options[$bar.'-color']).", ".$options[$bar.'-opacity'].")";
		$options[$bar.'-color-hover-rgb'] = "rgba(".hex2rgb($options[$bar.'-color']).", ".($options[$bar.'-opacity']+.1).")";
		$options[$bar.'-color-ie'] = ".".$bar."block {".ie_opacity_css($options[$bar.'-color'], $options[$bar.'-opacity'])."}";
		
		// visibility
		if ($options[$bar.'-width'] == '0') {
			$options[$bar.'-visibility'] = "hidden";
			$options[$bar.'-border-style'] = "none";			
		} else {
			$options[$bar.'-visibility'] = "visible";
		}
		
	}
	
	/******************************************************************************
	 * Tag link style options
	 ******************************************************************************/	

	if ($options['tag-link-style'] == "none") {
		$options['tag-link-border'] = "none";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "none";
		$options['tag-link-hover-decoration'] = "underline";
		$options['tag-link-background'] = "none";
		$options['tag-link-color'] = $options['linkcolor'];
		
	} else if ($options['tag-link-style'] == "underline") {
		$options['tag-link-border'] = "none";
		$options['tag-link-decoration'] = "underline";
		$options['tag-link-hover-border'] = "none"; 
		$options['tag-link-hover-decoration'] = "underline";
		$options['tag-link-background'] = "none";
		$options['tag-link-color'] = $options['linkcolor'];
		
	} else if ($options['tag-link-style'] == "right-sidebar-box") {
		$options['tag-link-border'] = "solid";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "solid";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-background'] = $options['right01-color'];
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-color'] = $options['linkcolor'];

		
	} else if ($options['tag-link-style'] == "left-sidebar-box") {
		$options['tag-link-border'] = "solid";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "solid";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-background'] = $options['left01-color'];
		$options['tag-link-hover-decoration'] = "none"; 
		$options['tag-link-color'] = $options['linkcolor'];
	
	//ww style links
	} else if ($options['tag-link-style'] == "yellow-box") {
		$options['tag-link-border'] = "solid";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "solid";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-background'] = "#FFF8C6";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-color'] = $options['linkcolor'];
	} 
	
	/******************************************************************************
	 * Category link style options
	 ******************************************************************************/	

	if ($options['category-link-style'] == "none") {
		$options['category-link-border'] = "none";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "none";
		$options['category-link-hover-decoration'] = "underline";
		$options['category-link-background'] = "none";
		$options['category-link-color'] = $options['linkcolor'];
		
	} else if ($options['category-link-style'] == "underline") {
		$options['category-link-border'] = "none";
		$options['category-link-decoration'] = "underline";
		$options['category-link-hover-border'] = "none"; 
		$options['category-link-hover-decoration'] = "underline";
		$options['category-link-background'] = "none";
		$options['category-link-color'] = $options['linkcolor'];
		
	} else if ($options['category-link-style'] == "left-sidebar-box") {
		$options['category-link-border'] = "solid";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "solid";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-background'] = $options['left01-color'];
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-color'] = $options['linkcolor'];

		
	}	else if ($options['category-link-style'] == "right-sidebar-box") {
		$options['category-link-border'] = "solid";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "solid";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-background'] = $options['right01-color'];
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-color'] = $options['linkcolor'];
	
	// WW style links
	}	else if ($options['category-link-style'] == "yellow-box") {
		$options['category-link-border'] = "solid";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "solid";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-background'] = "#e9e9c9";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-color'] = $options['linkcolor'];
	}
	
	/******************************************************************************
	 * Single Post sidebar display
	 * setting for determining which sidebars to show in single post view
	 ******************************************************************************/
	if ($options['post-single-sidebar'] == 'right') {
		$options['post-sidebar-right-display'] = "show";
		$options['post-sidebar-left-display'] = "hide";
		
	} else if ($options['post-single-sidebar'] == 'left') {
		$options['post-sidebar-left-display'] = "show";
		$options['post-sidebar-right-display'] = "hide";
		
	} else if ($options['post-single-sidebar'] == 'both') {
		$options['post-sidebar-right-display'] = "show";
		$options['post-sidebar-left-display'] = "show";
		
	} else if ($options['post-single-sidebar'] == 'none') {
		$options['post-sidebar-right-display'] = "hide";
		$options['post-sidebar-left-display'] = "hide";	
	}
		
	$options['page-image-width'] = $options['site-width']-50;

}

/******************************************************************************
 * Delete options deletes the theme options and resets to defaults for the
 * currently selected variation
 * (This is needed only when updating Variations themes and cleaning out
 * old options...)
 ******************************************************************************/

function delete_options() {
    global $variation_config, $options, $variation_css, $theme_settings, $theme_css;
	
	$options = array();
	$variation_css = "";
	$_POST = array();
	
	delete_option($theme_settings); 	
	delete_option($theme_css);
	
	add_option($theme_settings, array('init' => 1));  	
 	add_option($theme_css, "");
	
	set_variation_options();

	$options['revert'] = 0; 
	
	update_option($theme_settings, $options);

 	$options = get_option($theme_settings);

}

/******************************************************************************
 * Provides feedback to user about theme option choses
 ******************************************************************************/

function print_option_feedback() {
	global $_POST, $options;
	printpre($_POST['reset']);
	$main_column_width = $options['site-width'] - ($options['left01-width'] + $options['right01-width'] + 174);
	$message = "";
	$error = "false";
		
	if ($options['revert'] == 1) {
		$message .= " <br/><br/>These are the default settings for ".$options['theme-name'].".  See the Variation menu for variations of this theme";
		$error = "true";

	} else if (isset($_POST['reset'])) {
		$message .= " <br/><br/>The ".$options['theme-name']." theme options have been reverted to their default settings.";
		$error = "true";

	} else {

		if ($options['background'] == 'black') {
			$message .= " Black is a good choice for blogs that focus on images, particularly photos.";
			
			if ($options['linkcolor'] == "#FFFFCC" && $options['textcolor'] == "#CCCCCC") {
				$message .= " <br/><br/>The color of your links (pale yellow) is very close to the color of your text (light gray).  This means
				that your links will not stand out from your text...  Chose gray or silver for your text color (or yellow for your link color) if you want your links to be more visible.";
				$error = "true";
			}	
		} 
	
	
		if ($options['linkcolor_visited'] == "#b85b5a" && ($options['textcolor'] == "#666666" || $options['textcolor'] == "#424242")) {
			$message .= " <br/><br/>Opps, the color of your visited links is very close to the color of your text.  This means
			that after visiting a link, it won't be easily visible in your text...  
			Chose gray or light gray for your link color if you want your links to be more visible.";
			$error = "true";
		} 
		
		
		if ($options['post-sidebar-right-display'] == "show" && $options['right01-visibility'] == "hidden") {
			$message .= " <br/><br/>You wanted to show your right sidebar on single post pages but you have hidden it...";
			$error = "true";
		} 
	
		if ($options['post-sidebar-left-display'] == "show" && $options['left01-visibility'] == "hidden") {
			$message .= " <br/><br/>You wanted to show your left sidebar on single post pages but you have hidden it...";
			$error = "true";
		} 
		
		if ($error == "false") {
			$message .= " Visit the site";
		} else {
			$message .= " <br/><br/>Take a look at the site and see if it is the looks the way you had hoped";
		}
	}
	
    print
    "
        <div class='updated fade' id='message'
            style='background-color: #fff3cc;
                    margin-right: 50px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p><strong>Your changes have been saved.</strong><em>".$message.".</em></p>
        </div>
    ";

}

/*********************************************************
 * Hext to RGB converter for setting transparency using RGBa
 * $c can be either hex or rgb
 *********************************************************/
 
 function hex2rgb($color) {
	if (!$color) return false;
	$color = trim($color);
	$rgb_color = false;
   
	if (eregi("^[0-9ABCDEFabcdef\#]+$", $color)) {
		$color = str_replace('#','', $color);
		$l = strlen($color) == 3 ? 1 : (strlen($color) == 6 ? 2 : false);
	}

	if ($l) {
		unset($rgb_color);
		//$out = "rgba(";
		$rgb_color .= hexdec(substr($color, 0,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 1*$l,1*$l)).", ";
		$rgb_color .= hexdec(substr($color, 2*$l,1*$l));
	} else $rgb_color = false;
	return $rgb_color;
}

/******************************************************************************
 * Generates IE proprietary CSS for opacity 
 ******************************************************************************/

function ie_opacity_css ($color, $opacity) {
	if (!$color) return false;
	$color = trim($color);
	$out = false;
	
	if (eregi("^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$", $color)) {
		$color = hex2rgb($color);
	}
	
	$color = ereg_replace("#", "", $color);
	$hex_opacity = strtoupper(dechex($opacity*255));
	if ($opacity == "0") $hex_opacity = "00";
	$hex_rgba = "#".$hex_opacity.$color;
	
	$out = "*background:transparent;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=";
	$out .= $hex_rgba;
	$out .= ",endColorstr=";
	$out .= $hex_rgba;
	$out .= ");zoom: 1;";
	return $out;
}


/*********************************************************
 * debugging
 *********************************************************/


function printpre($array, $return=FALSE) {
	ob_start();
	print "\n<pre>";
	print_r($array);
	print "\n</pre>";
	
	if ($return)
		return ob_get_clean();
	else
		ob_end_flush();
}

?>
