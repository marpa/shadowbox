<?php

/*********************************************************
 *  Register sidebars
 *********************************************************/

if (function_exists('register_sidebar')) {
	register_sidebar(array('name'=>'left_sidebar',
	'before_widget' => '<li>',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'right_sidebar',
	'before_widget' => '<li>',
	'after_widget' => '</li>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'bottombar',
	'before_widget' => '<td valign=\'top\'>',
	'after_widget' => '</td>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'topbar',
	'before_widget' => '<td valign=\'top\'>',
	'after_widget' => '</td>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
	));

}


/******************************************************************************
 *  Get options
 ******************************************************************************/

if (!is_array(get_option('shadowbox_settings')) )
    add_option('shadowbox_settings', array('init' => 1));
    
if (!get_option('shadowbox_css'))
    add_option('shadowbox_css', "");

$options = get_option('shadowbox_settings');
$shadowbox_css = get_option('shadowbox_css');

// option defaults and value lists for the current variation
set_variation_options();

// default options for theme if no options have been selected yet
set_default_options();

// update option values display in UI based on values defined for selected variation
update_option('shadowbox_settings', $options);

/*********************************************************
 * Setup admin menu
 *********************************************************/ 

add_action('admin_menu', 'shadowbox_admin_menu');

function shadowbox_admin_menu() {
    add_theme_page('Shadowbox Options', 'Shadowbox Options', 'edit_themes', "Shadowbox", 'shadowbox_options');
}

/*********************************************************
 * Custom Header functions
 *********************************************************/

if ( function_exists('add_custom_image_header') ) {
  add_custom_image_header('header_style', 'admin_header_style');
}

$header_image_width = $options['site-width'] - 105;

define('HEADER_IMAGE', '%s/images/header.png'); // %s is theme dir uri
define('HEADER_IMAGE_WIDTH', $header_image_width);
define('HEADER_IMAGE_HEIGHT', 70);
define('HEADER_TEXTCOLOR', $options['headertext']);
define('HEADER_BGCOLOR', $options['headercolor']);
define( 'NO_HEADER_TEXT', true );
define( 'NO_HEADER_DESCRIPTION', true );

/*********************************************************
 * Styles used in admin custom header function
 * header_image() is a WordPress function
 *********************************************************/

function admin_header_style() { 
	?>
	<style type="text/css">
	#headimg, .block_header{
		background: <?php echo HEADER_BGCOLOR; ?> url(<?php header_image(); ?>) 0 0 no-repeat;
		background-position: right;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	}
		
	<?php if ( 'blank' == get_header_textcolor() ) { ?>
	
		.block_header, h1, #headimg h1 {
				display: none;
		}
	
	<?php } else { ?>
	
		.block_header .headertext .description, #headimg h1 {
			display: none;
		}
		.block_header .headertext .description, #headimg #desc {
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
	.block_header {
		background: <?php echo HEADER_BGCOLOR; ?> url(<?php header_image(); ?>) 0 0 no-repeat;
		background-position: right;
	}
	</style>	
	<?php
}

/*********************************************************
 * ShadowBox theme options
 * renders UI and theme model for chosing and previewing options
 *********************************************************/

function shadowbox_options() {
    global $options, $options_values, $shadowbox_css, $model_main_column_width;
	
	set_variation_options();	
		
    if ($_POST['action'] == 'save' )
        save_options();

	/*********************************************************
	 * Define theme layout model values
	 *********************************************************/
    
    $model_site_width = $options['site-width']-50;
    $model_right_sidebar_width = $options['sidebar-right-width'] + 12;
    $model_left_sidebar_width = $options['sidebar-left-width'] + 12;
    $model_main_column_width = $model_site_width - ($model_right_sidebar_width + $model_left_sidebar_width) - 100;
    $model_content_width = $options['site-width'] - ($options['sidebar-left-width'] + $options['sidebar-right-width']);

	/*********************************************************
	 * Define theme model css
	 * model css uses most of the actual theme's css except
	 * theme body css 
	 * model css adds css for theme edit UI components
	 *********************************************************/
 	
 	$model_css = preg_replace("/body/", ".body_na", $shadowbox_css); 
 	print "
 	<style type='text/css'>".$model_css."
 		.customheaderlink {
 			color: ".$options['headertext'].";
 			border: 1px dotted ".$options['headertext'].";
 			padding: 5px; 
 			text-decoration: none;
 		}
 		
		.customheaderlink a {
			display: block;
			text-decoration: none; 
		}

 		.customheaderlink a:hover {
			 border: 1px solid ".$options['headertext'].";
			 text-decoration: none;
		}

 		.rss  {
			font-size: 10px;
			text-align: center;
 			color: ".$options['headertext'].";
		} 	
		
		#appgroupedit textarea {
			width: 300px;
		}

 				
 		.editwidgetlink {
			display: block;
 			color: ".$options['headertext'].";
 			padding: 5px;
		 		
 		}
 		
 		.editwidgetlink a {
			display: block;
 			color: ".$options['headertext'].";
 			padding: 5px;
 			border: 1px dotted ".$options['headertext'].";
		} 		
 		
 		.editwidgetlink a:hover {
			 border: 1px solid ".$options['headertext'].";
			 text-decoration: none;
		}
		
 		.entry p a:visited {
			color: ".$options['linkcolor'].";	
			text-decoration: ".$options['entry-link-decoration'].";
			border: 1px ".$options['entry-link-border']." ".$options['sidebar-left-border-right'].";
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px; 		
 		}
		
 		.modelwrapper {
 			width: ".$model_site_width."px;
			margin-top: 1px;
			margin-right: 10px;
			background-color: ".$options['background_color'].";
			color: #000000;
			padding: 1px 10px 10px 10px;
			border: 1px solid #CCCCCC;
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
			border: 1px ".$options['entry-link-border']." ".$options['sidebar-left-border-right'].";
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
 	
 	</style>";	 
    
	/*********************************************************
	 * Form action 
	 *********************************************************/

	print "
	<form id='settings' action='' method='post' class='themeform' style='margin: 20px;'>
	<input type='hidden' id='action' name='action' value='save'/>";


	/*********************************************************
	 *  Header meta options
	 *********************************************************/
	
	print 
	"
	<table width = '".$model_site_width."' cellpadding='0'>
		<tr>
			<td width='20%'>
				<span style='font-size: 9px;'>Header Links:</span>
				<select name='appgroups' style='font-size: 10px;'  onchange='this.form.submit();'>
					<option value='blogs' ".($options['appgroups'] == 'blogs' ? ' selected' : '') . ">Blog Sign Up</option>
					<option value='custom' ".($options['appgroups'] == 'custom' ? ' selected' : '') . ">Custom</option>
				</select>

			</td>
			<td width='60%' align='left'>
			<div class='instructions' style='font-size: 9px;'>	
			<i>Below is just a model of your blog's layout and colors. It does not show 
			background gradient colors such as gray-white, nor all the details of your blog's header, borders or sidebar widgets</i>&nbsp;&nbsp;
			 <strong>Show recommendations: </strong><input type='checkbox' name='model-instructions' id='model-instructions' ".($options['model-instructions'] == "on" ? ' checked' : '') . " onchange='this.form.submit();'/>
			</div>			
			</td>
			<td width='20%' align='right'><span style='font-size: 9px;'>Show Meta links:</span>
			<input type='checkbox' name='headermeta' id='headermeta' ".($options['headermeta'] == "on" ? ' checked' : '') . " onchange='this.form.submit();'/>
			</td>
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
			<div style='font-size: 9px; color: ".$options['bgtextcolor'].";'>";
			
			if ($options['headerleft'] == "") {
				print "no links defined...";
				
			} else {
				print $options['headerleft'];
			}
					
			// if header left links selection is custom
			if ($options['appgroups'] == 'custom') {
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
				";
			}
			print "
			</div>	
			</td>
			<td width='20%' valign='top'>";
			// header right meta options
			if ($options['headermeta'] == "on") {
				print "<div style='font-size: 9px; float: right; clear: both; color: ".$options['textcolor'].";'>Log in</div>";
			} else {
				print "<div style='font-size: 9px; float: right; clear: both; color: ".$options['linkcolor'].";'></div>";
			}
			print "
			</td>
			</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width='20%'>
		<input type='checkbox' name='header-text-display' id='header-text-display'" .($options['header-text-display'] == "on" ? ' checked' : '')." onchange='this.form.submit();'/>
		<span style='color:".$options['textcolor']."; font-size: 9px;'>Display blog title and description</span>	
		</td>
		<td width='60%'>
		<div style='font-size: 8px; text-align: center;'>	
		<div style=''>		
		<span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Header:</span>
		<select name='headercolor' style='font-size: 10px;' onchange='this.form.submit();'>";							
			//header color options
			foreach ($options_values['headercolor'] as $label => $value) {
				print "\n<option value='".$value."'".($options['headercolor'] == $value ? ' selected' : '') . ">".$label."</option>";
			}
		print "
		</select>
		<span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Background:</span>
		<select name='background' style='font-size: 10px;' onchange='this.form.submit();'>
			<option value='white' ".($options['background'] == 'white' ? ' selected' : '') . ">White</option>
			<option value='black' ".($options['background'] == 'black' ? ' selected' : '') . ">Black</option>
			<option value='gray' ".($options['background'] == 'gray' ? ' selected' : '') . ">Gray</option>
			<option value='gray-white' ".($options['background'] == 'gray-white' ? ' selected' : '') . ">Gray-White</option>
			<option value='white-gray' ".($options['background'] == 'white-gray' ? ' selected' : '') . ">White-Gray</option>
			<option value='yellow' ".($options['background'] == 'yellow' ? ' selected' : '') . ">Yellow</option>
			<option value='yellow-white' ".($options['background'] == 'yellow-white' ? ' selected' : '') . ">Yellow-White</option>
			<option value='white-yellow' ".($options['background'] == 'white-yellow' ? ' selected' : '') . ">White-Yellow</option>
			<option value='blue' ".($options['background'] == 'blue' ? ' selected' : '') . ">Blue</option>
			<option value='green' ".($options['background'] == 'green' ? ' selected' : '') . ">Green</option>
		</select>
		<span style='font-size: 10px; color: ".$options['bgtextcolor'].";'>Site width:</span>
		<select name='site-width' style='font-size: 10px;' onchange='this.form.submit();'>";							
			// site width options
			foreach ($options_values['site-width'] as $label => $value) {
				print "\n<option value='".$value."'".($options['site-width'] == $value ? ' selected' : '') . ">".$label."</option>";
			}					
		print "
		</select>		
		</div>
		</div>	
		</td>
		<td width='20%'>
		</td>		
	</tr>
	<tr><td colspan='3'>";
		if ($options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='font-size: 8px;'>	
				<i>If you use your own custom header image, consider an image with transparent background for graphics or logo type images. 
				If your custom header image spans the entire width of the header, hide the blog title and description </i>
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
	<table width = '".$model_site_width."' align='center' cellpadding='0' cellspacing='0' style='border: 1px solid #CCCCCC;'>
	<tr>
	<td>		
		<table width = '100%' cellpadding='10' style='background-color: ".$options['content-background']."'>
			<tr>
				<td colspan='3' height='70' style='background-color: ".$options['headercolor']."; border: 1px solid #CCCCCC;'>				
					<div style='font-size: 10px; margin: 6px; float: right; clear: left; color: ".$options['headertext'].";'>
					<a href='".get_bloginfo('url')."/wp-admin/themes.php?page=custom-header' class ='customheaderlink'>Edit Custom Header Image</a></div>
					<div style='font-size: 10px; margin: 4px; text-align: left; color: ".$options['headertext'].";'>";	
					// blog title and description model
					if ($options['header-text-display'] == "on") {
						print "<span style='font-size: 20px;'>".get_bloginfo('name')."</span><br/>";
						print "<div style='font-size: 10px; margin-left: 10px; color: ".$options['textcolor'].";'>".get_bloginfo('description')."</div>";
					} else {
						print "<i>blog title and description hidden</i>";
					}
					print "
					</div>
				</td>
			</tr>
			<tr>
				<td colspan='3' style='background-color: ".$options['content-background'].";'>
				<table width='100%' cellspacing='1' cellpadding='0'>
				<tr>
				<td width='80%' style='background-color: ".$options['content-background']."; border: 1px solid #CCCCCC;'>";
								
				/*********************************************************
				 * top bar
				 *********************************************************/
				
				if ($options['model-instructions'] == "on") {
					print "
					<div class='instructions' style='margin: 2px;'>	
						<span style='font-size: 8px;'><i>Use this area for announcements, or links to other related sites.  Recommended widget: Text/HTML 
						(don't bother with giving your Text widget a title here, probably take too much space...) </i></span>
					</div>						
					";		
				}		
				print "
				<div class='editwidgetlink' style='text-align: center; width: 85%; float: right; clear: left;'> 
				<a style='font-size: 10px; margin: 1px; padding: 1px;' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
				</div>	
				<div id='sidebar' style='font-size: 8px;'><h2 style='margin: 2px; float: left;'>Top Bar</h2></div>	
			
				</td>
				
				<td width='20%' style='background-color: ".$options['content-background']."; border: 1px solid #CCCCCC;'>
				<div class='rss'>Posts RSS | Comments RSS</div>
				</td>
				</tr>
				</table>
			</tr>

			<tr>";
						
			/******************************************************************************
			 * left sidebar model
			 ******************************************************************************/

			if ($options['sidebar-left-width'] != 0) {
				print"
				<td valign='top' width='".$model_left_sidebar_width."' style='background-color: ".$options['sidebar-left-color']."; border: 1px solid #CCCCCC;'>
					<div style='font-size: 10px; text-align: center; color: ".$options['textcolor'].";'>&larr; ".$model_left_sidebar_width." px &rarr; </div>
					<div id='sidebar' style='font-size: 8px;'>					
					<h2 style='margin-bottom: 2px; margin-top: 2px;'>Left Sidebar</h2>
					<div class='editwidgetlink' style='font-size: 10px;'>
					<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
					
					if ($options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";					
							if ($options['sidebar-right-width'] == 0) {
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
			<td width='".$model_content_width."' style='background-color: ".$options['content-background']."; color: ".$options['textcolor'].";'>	
				<div style='font-size: 10px; text-align: center;'> &larr; ".$model_main_column_width." px &rarr;</div>
				<table width = '100%' cellpadding='0'>
					<tr><td valign='top'>
						<table width = '100%' cellpadding='0'>";
						
							/*********************************************************
							 * Left Sidebar Color
							 *********************************************************/							
							print"
							<tr><td style='border-bottom: 1px dotted; text-align: left;'>";
							
							print "\n\t\t\t\t\t\t\t<select name='sidebar-left-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['sidebar-left-color'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['sidebar-left-color'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>
							<td style='border-bottom: 1px dotted; text-align: left;'>
							<span style='font-size: 10px;'>Left Sidebar color</span>
							</td>							
							";	
							
							/*********************************************************
							 * Left Sidebar Width
							 *********************************************************/
							
							print "
							</tr>
							<tr><td style='border-bottom: 1px dotted; text-align: left;'>
							<select name='sidebar-left-width' style='font-size: 10px;' onchange='this.form.submit();'>								
								<option value='163' ".($options['sidebar-left-width'] == '163' ? ' selected' : '') . ">175px</option>
								<option value='188' ".($options['sidebar-left-width'] == '188' ? ' selected' : '') . ">200px</option>
								<option value='238' ".($options['sidebar-left-width'] == '238' ? ' selected' : '') . ">250px</option>
								<option value='338' ".($options['sidebar-left-width'] == '338' ? ' selected' : '') . ">350px</option>
								<option value='388' ".($options['sidebar-left-width'] == '388' ? ' selected' : '') . ">400px</option>
								<option value='0' ".($options['sidebar-left-width'] == '0' ? ' selected' : '') . ">hide</option>
							</select>
							<td style='border-bottom: 1px dotted; text-align: left;'>
							<span style='font-size: 10px;'>Left Sidebar Width</span> 
							</td>
							</tr>
							
						</table>
					</td><td>
					
					<table width = '100%' cellpadding='0'>

						<tr><td style='border-bottom: 1px dotted; text-align: right;'>
						<span style='font-size: 10px;'>Right Sidebar color</span>
						</td><td style='border-bottom: 1px dotted; text-align: right;'>";

						/*********************************************************
						 * Right Sidebar Color
						 *********************************************************/
						
						print "\n\t\t\t\t\t\t\t<select name='sidebar-right-color' style='font-size: 10px;' onchange='this.form.submit();'>";							
						foreach ($options_values['sidebar-right-color'] as $label => $value) {
							print "\n\t\t\t\t\t\t\t<option value='".$value."'".($options['sidebar-right-color'] == $value ? ' selected' : '') . ">".$label."</option>";
						}
						print "\n\t\t\t\t\t\t\t</select>";	
						
						/*********************************************************
						 * Right Sidebar Width
						 *********************************************************/
						
						print "
						</td></tr>
						<tr><td style='border-bottom: 1px dotted; text-align: right;'>
						<span style='font-size: 10px;'>Right Sidebar Width </span>
						</td><td style='border-bottom: 1px dotted; text-align: right;'>
						<select name='sidebar-right-width' style='font-size: 10px;' onchange='this.form.submit();'>
							<option value='163' ".($options['sidebar-right-width'] == '163' ? ' selected' : '') . ">175px</option>
							<option value='188' ".($options['sidebar-right-width'] == '188' ? ' selected' : '') . ">200px</option>
							<option value='238' ".($options['sidebar-right-width'] == '238' ? ' selected' : '') . ">250px</option>
							<option value='338' ".($options['sidebar-right-width'] == '338' ? ' selected' : '') . ">350px</option>
							<option value='388' ".($options['sidebar-right-width'] == '388' ? ' selected' : '') . ">400px</option>
							<option value='0' 	".($options['sidebar-right-width'] == '0' ? ' selected' : '') . ">hide</option>
						</select>	
						</td></tr>								
					</table>						
					</td></tr>
				</table>
				";
				
				/*********************************************************
				 * Post model
				 *********************************************************/
				
				print "
						<div style='float: right; clear: left; font-size: 10px;'>";
						// post single sidebar options
						print "\n\t\t\t\t\t\t\tSingle Post Display: <select name='post-single-sidebar' style='font-size: 10px;' onchange='this.form.submit();'>";							
						foreach ($options_values['post-single-sidebar'] as $label => $value) {
							print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['post-single-sidebar'] == $value ? ' selected' : '') . ">".$label."</option>";
						}
						print "\n\t\t\t\t\t\t\t</select>
						</div>
						<div style='color: ".$options['linkcolor']."; font-size: 16px; font-weight: bold;'>Post Title</div>
						<span style='font-size: 9px;'>April 16th, 2009 by </span>
						<div class='entry'>Posted in <span class='category'>Category</span></div>					
						<div class='entry' style='text-align: justify;'>
						<p>Lorem ipsum dolor sit amet, <span style='color: ".$options['linkcolor_visited'].";'>visited link</span> 
						adipiscing elit. Donec ac felis non mauris tristique vehicula. 
						Nunc commodo, justo vel imperdiet cursus, leo dui <a href='#'  style='color: ".$options['linkcolor'].";'>link</a>, vel bibendum neque justo nec ipsum. 
						Aliquam erat volutpat. <a href='#' style='color: ".$options['linkcolor'].";'>another link</a> leo tellus, sagittis id mollis non, pretium a tellus.</p>
						</div>
						<div class='entry'>Tags: <span class='tag'>tag</span>					
						<div class='entry' style='text-align: right;'>No Comments &#187;</div><br/>
						</div>";

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
							print "\n\t\t\t\t\t\t\t<select name='textcolor' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['textcolor'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['textcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>";	
							
							print "		 							
							</td>								
							</tr><tr>
							<td style='border-bottom: 1px dotted;'><span style='font-size: 10px; color:".$options['linkcolor'].";'>Link color</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>";
							
							// link color options
							print "\n\t\t\t\t\t\t\t<select name='linkcolor' style='font-size: 10px;' onchange='this.form.submit();'>";							
							foreach ($options_values['linkcolor'] as $label => $value) {
								print "\n\t\t\t\t\t\t\t\t<option value='".$value."'".($options['linkcolor'] == $value ? ' selected' : '') . ">".$label."</option>";
							}
							print "\n\t\t\t\t\t\t\t</select>								
							</td>								
							</tr><tr>";
							
							// Link style options
							print "
							<td style='border-bottom: 1px dotted;'><span class='postlink' style='font-size: 10px; color:".$options['linkcolor'].";'>Link Style</span> 
							 (<span style='font-size: 10px; color:".$options['linkcolor_visited'].";'>visited link</span>)</td>								
							<td style='border-bottom: 1px dotted; text-align: right;'>								
							<select name='entry-link-style' style='font-size: 10px;' onchange='this.form.submit();'>								
								<option value='none' ".($options['entry-link-style'] == 'none' ? ' selected' : '') . ">None</option>
								<option value='underline' ".($options['entry-link-style'] == 'underline' ? ' selected' : '') . ">Underline</option>
								<option value='box' ".($options['entry-link-style'] == 'box' ? ' selected' : '') . ">Box</option>
							</select>								
							</td></tr>							
						</table>
					</td><td valign='top' width='50%'>
						<table width = '100%' cellpadding='0'>
							<tr>";
							
							// category link style
							print "
							<td style='border-bottom: 1px dotted;'><span class='category' style='font-size: 10px;'>Category Link Style</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>	
							<select name='category-link-style' style='font-size: 10px;' onchange='this.form.submit();'>								
								<option value='none' ".($options['category-link-style'] == 'none' ? ' selected' : '') . ">None</option>
								<option value='underline' ".($options['category-link-style'] == 'underline' ? ' selected' : '') . ">Underline</option>
								<option value='left-sidebar-box' ".($options['category-link-style'] == 'left-sidebar-box' ? ' selected' : '') . ">Left Sidebar Box</option>
								<option value='right-sidebar-box' ".($options['category-link-style'] == 'right-sidebar-box' ? ' selected' : '') . ">Right Sidebar Box</option>
							</select>								
							</td>								
							</tr><tr>";
							
							// Tag link style
							print "
							<td style='border-bottom: 1px dotted;'><span class='tag' style='font-size: 10px;'>Tag Link Style</span></td>
							<td style='border-bottom: 1px dotted; text-align: right;'>
							<select name='tag-link-style' style='font-size: 10px;' onchange='this.form.submit();'>								
								<option value='none' ".($options['tag-link-style'] == 'none' ? ' selected' : '') . ">None</option>
								<option value='underline' ".($options['tag-link-style'] == 'underline' ? ' selected' : '') . ">Underline</option>
								<option value='right-sidebar-box' ".($options['tag-link-style'] == 'right-sidebar-box' ? ' selected' : '') . ">Right Sidebar Box</option>
								<option value='left-sidebar-box' ".($options['tag-link-style'] == 'left-sidebar-box' ? ' selected' : '') . ">Left Sidebar Box</option>								
							</select>								
							</td></tr>
						</table>						
					</table>
				
			</td>";
			
			/*********************************************************
			 * right sidebar model
			 *********************************************************/

			if ($options['sidebar-right-width'] != 0) {
				print"
				<td valign='top' width='".$model_right_sidebar_width."' style='background-color: ".$options['sidebar-right-color']."; border: 1px solid #CCCCCC;'>
					<div style='font-size: 10px; text-align: center; color: ".$options['textcolor'].";'>&larr; ".$model_right_sidebar_width." px &rarr;</div>
					<div style='font-size: 8px; margin: 4px;'>
					<div id='sidebar' style='font-size: 8px;'>
					<h2 style='margin-bottom: 2px; margin-top: 2px;'>Right Sidebar</h2></div>
					<div class='editwidgetlink' style='font-size: 10px;'>
					<a href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>";
					if ($options['model-instructions'] == "on") {
						print "
						<div class='instructions' style='font-size: 8px;'>	
							<i>Recommended widgets:<br/>";
							if ($options['sidebar-left-width'] == 0) {
								print "								
								1. Search<br/>
								2. Pages<br/>
								3. Recent Posts<br/>
								4. Recent Comments<br/>
								5. Categories<br/>
								6. Tag Cloud<br/>";
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
			print "	
			</tr>
		</table>
	
	</td></tr>
	<tr>
		<td colspan='3' style='background-color: ".$options['content-background'].";'>
		<table width='100%' cellspacing='2' cellpadding='0'>
		<tr>
		<td style='background-color: ".$options['content-background']."; border: 1px solid #CCCCCC;'>";	
		
		/*********************************************************
		 *  bottom bar model
		 *********************************************************/
		
		if ($options['model-instructions'] == "on") {
			print "
			<div class='instructions' style='margin: 2px;'>	
				<span style='font-size: 8px;'><i>Use this area for additional RSS feeds, links to other related sites.  Recommended widgets: Text/HTML, RSS</i></span>
			</div>		
			";		
		}		
		print "		 
		<div class='editwidgetlink' style='text-align: center; width: 85%; float: right; clear: left;'>
		<a style='font-size: 10px; margin: 1px; padding: 1px;' href='".get_bloginfo('url')."/wp-admin/widgets.php'>Edit Widgets</a>
		</div>
		<div id='sidebar' style='font-size: 8px;'><h2 style='margin: 2px; float: left;'>Bottom Bar</h2></div>
		</td>
		</tr>
		</table>
	</tr>
	</table>
	<table width='100%' cellpadding='5'>
	<tr><td width='80%'>
	<div style='font-size: 9px; color: ".$options['bgtextcolor'].";'>";

		if ($options['footerleft'] == "") {
			print "no links defined...";
		} else {
			print $options['footerleft'];
		}

		print "
			<input id='footerleftdo' type='hidden' name='footerleftdo' value='0'/> - 
	
			<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"block\"; document.getElementById(\"footerleftdo\").value = \"1\"; exit;'>edit</a>
			
			<div id='footerleftedit' style='display: none;'>
			
			<textarea name='footerleft' style='width: 100%; height: 50px; font-size: 10px;' class='code'>";
			print stripslashes(stripslashes(trim($options['footerleft'])));
			print "</textarea>		
			&nbsp;&nbsp;&nbsp;
			<a href='javascript: document.getElementById(\"footerleftedit\").style.display = \"none\"; document.getElementById(\"footerlefteditdo\").value = \"0\"; exit;'>Cancel</a> - 
			<span class='submit'><input type='submit' value='Update' name='save'/></span>					
		";

		print "
		</div>		

	</td><td valign='bottom' width='20%'>
	<div style='font-size: 9px; text-align: right; color: ".$options['bgtextcolor'].";'>ShadowBox | WordPress</div>
	</td></tr>
	</table>
	</div>";
	// end options		

	/*********************************************************
	 * ShadowBox Theme instructions and Save Changes button
	 *********************************************************/
    print
    "<table width = '".$model_site_width."' align='center' cellpadding='5' cellspacing='5' border='0'>
    <tr><td valign='top'>
    <span class='submit'><input type='submit' value='Save Changes' name='save'/></span>
    </td><td>
    <div class='instructions'>	
	<strong>ShadowBox</strong>: When chosing options think about colors and contrasts that complement your content.  For example, if your site focuses on links, be sure your link color contrasts with your 
	text color so links will stand out.  Chose the black theme for blogs that highlight images.  <br/>
	</div>
	</td></tr>
	</table>
	</form>";

}

/*********************************************************
 * ShadowBox save options
 *********************************************************/

function save_options() {
    global $_POST, $options, $shadowbox_css;

	// options are those exposed in the UI
	set_primary_options();
	
	// options specific to a particular variation
	set_variation_options();
	
	// options derived from primary options
	set_derivative_options();


	/******************************************************************************
	 * add theme options to theme CSS
	 ******************************************************************************/

	$shadowbox_css =
	"
		body {
			background-color: ".$options['background_color'].";
			background-image: ".$options['background_image'].";
			background-repeat: ".$options['background_repeat'].";
			background-position: ".$options['background_position'].";			
			color: ".$options['textcolor'].";
			margin-top: 10px;
		}
	
		.sitewrapper {
			width: ".$options['site-width']."px;
			margin-left: auto;
			margin-right: auto;
			margin-top: ".$options['site-margin-top']."px;
		}

		.block_background .block_background_content {
			background-color: ".$options['content-background'].";
			padding: 15px;
			text-align: left;
			margin: 0px;
		}
				
		.block_foreground {
			background-color: ".$options['foreground_color'].";
		
		}

		.page_top {
			background-image: ".$options['page_top_background_image'].";
			background-repeat: no-repeat;
			background-position: center;
			padding-top: ".$options['page_top_padding']."px;
		}
		
		.page_main {
			background-image:  ".$options['page_main_background_image']."; 
			background-repeat: repeat-y; 
			background-position: center;
			padding-top: 10px;
			padding-right: ".$options['page_main_padding']."px;
			padding-left: ".$options['page_main_padding']."px;
		}
		
		.page_bottom {
			background-image:  ".$options['page_bottom_background_image'].";
			background-repeat: no-repeat; 
			background-position: center;
			padding-top: ".$options['page_bottom_padding']."px;
		}

		#header {
			border: 1px 0 0 0;
			border-bottom: 1px solid ".$options['headerbottom'].";
			border-top: 1px solid ".$options['headertop'].";
			margin: 0 0 0 1px;
			padding: 0 2px 0 2px;
		}

		h2.pagetitle {		
			margin-top: 10px;		
			text-align: left;
			color: ".$options['page-title'].";
		}
		
		#sidebar h2 {
			color: ".$options['sidebar-title'].";
		}
		
		#sidebar ul ul li, #sidebar ul ol li {
			margin: 3px 0 -4px;
			padding: 3px;
		}
		
		#sidebar a:hover {
			color: ".$options['linkcolor'].";
			text-decoration: underline;		
		}

		.sidebarleft {
			width: ".$options['sidebar-left-width']."px;
			visibility: ".$options['sidebar-left-visibility'].";
		}

		.sidebarleftcolor {
			background: ".$options['sidebar-left-color'].";
			border-bottom: 1px solid ".$options['sidebar-left-border-bottom'].";
			border-left: 1px solid ".$options['sidebar-left-border-left'].";
			border-right: 1px solid ".$options['sidebar-left-border-right'].";
		}

		.sidebarright {
			width: ".$options['sidebar-right-width']."px;
			visibility: ".$options['sidebar-right-visibility'].";
		}

		.sidebarrightcolor {
			background: ".$options['sidebar-right-color'].";
			border-bottom: 1px solid ".$options['sidebar-right-border-bottom'].";
			border-left: 1px solid ".$options['sidebar-right-border-left'].";
			border-right: 1px solid ".$options['sidebar-right-border-right'].";
		}
		
		a, h2 a:hover, h3 a:hover {
			color: ".$options['linkcolor'].";
			text-decoration: none;
		}
		
		a:hover {
			color: ".$options['linkcolor'].";
			text-decoration: underline;
		}
		
		.entry p a {
			color: ".$options['linkcolor'].";	
			text-decoration: ".$options['entry-link-decoration'].";
			border: 1px ".$options['entry-link-border']." ".$options['headerborder'].";
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}

		.entry p a:hover {
			color: ".$options['linkcolor'].";	
			text-decoration: ".$options['entry-link-hover-decoration'].";
			border: 1px ".$options['entry-link-hover-border']." ".$options['linkcolor'].";
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}


		.entry p a:visited {
			color: ".$options['linkcolor_visited'].";		
			border: none;
		}
		
		.tag {
			color: ".$options['linkcolor'].";
			background: ".$options['tag-link-background'].";
			border: 1px ".$options['tag-link-border']." ".$options['headerborder'].";
			text-decoration: ".$options['tag-link-decoration'].";
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}
		
		.tag a:hover {
			text-decoration: ".$options['tag-link-hover-decoration'].";
		}
		
		.tag:hover {
			text-decoration: ".$options['tag-link-hover-decoration'].";
			border: 1px ".$options['tag-link-border']." ".$options['linkcolor'].";		
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}

		.category {
			color: ".$options['linkcolor'].";
			background: ".$options['category-link-background'].";
			border: 1px ".$options['category-link-border']." ".$options['headerborder'].";
			text-decoration: ".$options['category-link-decoration'].";
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}

		.category a:hover {
			text-decoration: ".$options['category-link-hover-decoration'].";
		}
		
		.category:hover {
			text-decoration: ".$options['category-link-hover-decoration'].";
			border: 1px ".$options['category-link-border']." ".$options['linkcolor'].";		
			margin: 2px;
			padding-right: 2px;
			padding-left: 2px;
		}
		
		.postlink {
			background: ".$options['content-background'].";
			color: ".$options['linkcolor'].";
			border: 1px dotted ".$options['bgbordercolor'].";
			text-align: center;
			padding: 5px;
			margin-top: 10px;
		}

		
		.postlink a {
			display: block;
			color: ".$options['linkcolor'].";
			text-decoration: none;
		}

		h2 {
			color: ".$options['textcolor'].";
			text-decoration: none;
		}
		
		.post h2 {
			color: ".$options['linkcolor'].";
			text-decoration: none;
		}

		.postlink a:hover {
			text-decoration: none;
			color: ".$options['link_color'].";
		}

		.postlink:hover {
			color: ".$options['content-background'].";
			border: 1px solid ".$options['bgbordercolor'].";
			margin-bottom: 2px;
		}
		
		
		.editlink {
			color: ".$options['linkcolor'].";
			border: 1px dotted ".$options['bgbordercolor'].";
			text-align: center;
			padding: 1px;
			margin-top: 1px;
			margin-bottom: 10px;
		}

		.editlink a {
			display: block;
			text-decoration: none;
			color: ".$options['linkcolor'].";
		}

		.editlink a:hover {
			text-decoration: none;
			color: ".$options['link_color'].";
		}

		.editlink:hover {
			border: 1px solid ".$options['bgbordercolor'].";
		}

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

		.bgtextcolor {
			color: ".$options['bgtextcolor'].";
		}

		.bgtextcolor a {
			color: ".$options['bglinkcolor'].";
		}

		.bgtextcolor a:hover {
			color: ".$options['bglinkcolor'].";
		}

		.block_header {
			background-color: ".$options['headercolor'].";
			border-bottom: 1px solid ".$options['headerborder'].";
			border-top: 1px solid ".$options['headerborder'].";
			border-right: 1px solid ".$options['headerborder'].";
			border-left: 1px solid ".$options['headerborder'].";					
			padding-top: 1px;
			height: 70px;
		}

		.topbar {
			border-bottom: 1px solid ".$options['headerborder'].";					
			padding-top: 2px;
			padding-bottom: 2px;
			padding-left: 10px;
		}
		
		div .hr {
			color: ".$options['headerbottom'].";
			background-color: ".$options['headerbottom'].";
			height: 1px;
			margin-right: -1px;
			margin-left: -1px;
		}
		
		.headertext a {
			display: ".$options['show-header-text'].";
			padding-left: 10px;
			color: ".$options['headertext'].";
			font-size: 20px;
			font-weight: bold;			
		}
		
		.block_header .description {
			display: ".$options['show-header-text'].";
			padding-left: 15px;
			color: ".$options['headerdescription'].";
			font-size: 10px;
		}
		
		#sidebar #searchform #s {
			background-color: ".$options['content-background'].";
			color: ".$options['linkcolor'].";
			
		}
					
	";
	
	
	update_option('shadowbox_settings', $options);
	update_option('shadowbox_css', $shadowbox_css);
	
	print_option_feedback();
	
}


/*********************************************************
 * Set defaults
 *********************************************************/
function set_default_options() {
	global $options;

	if( ! isset($options['headerleft'			]) ) $options['headerleft'			] = "";
	if( ! isset($options['footerleft'			]) ) $options['footerleft'			] = "";
	if( ! isset($options['headerleftcustom'		]) ) $options['headerleftcustom'			] = "";
	if( ! isset($options['appgroups'			]) ) $options['appgroups'			] = "custom";
	if( ! isset($options['headermeta'			]) ) $options['headermeta'			] = "on";
	if( ! isset($options['header-text-display'	]) ) $options['header-text-display'	] = "on";
	
	if( ! isset($options['background'     		]) ) $options['background'      	] = "gray";
	if( ! isset($options['headercolor'			]) ) $options['headercolor'			] = "#F9F9F9";
	if( ! isset($options['linkcolor'			]) ) $options['linkcolor'			] = "#003366";
	if( ! isset($options['entry-link-style'		]) ) $options['entry-link-style'	] = "none";
	if( ! isset($options['tag-link-style'		]) ) $options['tag-link-style'		] = "box";
	if( ! isset($options['category-link-style'	]) ) $options['category-link-style'	] = "none";
	if( ! isset($options['textcolor'			]) ) $options['textcolor'			] = "#999999";
	if( ! isset($options['bgtextcolor'			]) ) $options['bgtextcolor'			] = "#CCCCCC";
	if( ! isset($options['bglinkcolor'			]) ) $options['bglinkcolor'			] = "#CCCCCC";
	
	if( ! isset($options['site-width'			]) ) $options['site-width'			] = "950";
	if( ! isset($options['sidebar-left-width'	]) ) $options['sidebar-left-width'	] = "0";
	if( ! isset($options['sidebar-right-width'	]) ) $options['sidebar-right-width'	] = "138";
	if( ! isset($options['sidebar-left-color'	]) ) $options['sidebar-left-color'	] = "#F9F9F9";
	if( ! isset($options['sidebar-right-color'	]) ) $options['sidebar-right-color'	] = "#F9F9F9";
	if( ! isset($options['page-title'			]) ) $options['page-title'			] = "#CCCCCC";
	if( ! isset($options['sidebar-title'		]) ) $options['sidebar-title'		] = "#CCCCCC";
	if( ! isset($options['post-single-sidebar'	]) ) $options['post-single-sidebar'	] = "right";
	
	if( ! isset($options['model-instructions'	]) ) $options['model-instructions'	] = "on";
	
	//printpre($_POST);

}

/*********************************************************
 * set primary options
 *********************************************************/
 
function set_primary_options() {
	global $_POST, $options;
	
	//printpre($_POST);
	
    $options['appgroups'] = ( isset($_POST['appgroups']) ) ? stripslashes($_POST['appgroups']) : "custom";
    $options['headermeta'] = ( isset($_POST['headermeta']) ) ? stripslashes($_POST['headermeta']) : "off";
    $options['headerleftcustom'] = ( isset($_POST['headerleftcustom']) ) ? addslashes($_POST['headerleftcustom']) : "";
    $options['model-instructions']		= ( isset($_POST['model-instructions']) ) ? stripslashes($_POST['model-instructions']) : "off";
    
    $options['background'] = ( isset($_POST['background']) ) ? stripslashes($_POST['background']) : "gray";
	$options['headercolor']	= ( isset($_POST['headercolor']) ) ? stripslashes($_POST['headercolor']) : "#F9F9F9";
	$options['sidebar-left-width']	= ( isset($_POST['sidebar-left-width']) ) ? stripslashes($_POST['sidebar-left-width']) : "138";
	$options['sidebar-right-width']	= ( isset($_POST['sidebar-right-width']) ) ? stripslashes($_POST['sidebar-right-width']) : "138";
	$options['sidebar-left-color']	= ( isset($_POST['sidebar-left-color']) ) ? stripslashes($_POST['sidebar-left-color']) : "#F9F9F9";
	$options['sidebar-right-color']	= ( isset($_POST['sidebar-right-color']) ) ? stripslashes($_POST['sidebar-right-color']) : "#F9F9F9";	

	$options['page-title'] = ( isset($_POST['page-title']) ) ? stripslashes($_POST['page-title']) : "#CCCCCC";
	$options['sidebar-title'] = ( isset($_POST['sidebar-title']) ) ? stripslashes($_POST['sidebar-title']) : "#CCCCCC";
	
	$options['post-single-sidebar']	= ( isset($_POST['post-single-sidebar']) ) ? stripslashes($_POST['post-single-sidebar']) : "right";

	$options['textcolor'] = ( isset($_POST['textcolor']) ) ? stripslashes($_POST['textcolor']) : "#999999";
	$options['linkcolor'] = ( isset($_POST['linkcolor']) ) ? stripslashes($_POST['linkcolor']) : "#003366";
	$options['entry-link-style'] = ( isset($_POST['entry-link-style']) ) ? stripslashes($_POST['entry-link-style']) : "none";
	$options['tag-link-style'] = ( isset($_POST['tag-link-style']) ) ? stripslashes($_POST['tag-link-style']) : "box";
	$options['category-link-style'] = ( isset($_POST['category-link-style']) ) ? stripslashes($_POST['category-link-style']) : "none";

	$options['bgtextcolor']	= ( isset($_POST['bgtextcolor']) ) ? stripslashes($_POST['bgtextcolor']) : "#CCCCCC";
	$options['bglinkcolor']	= ( isset($_POST['bglinkcolor']) ) ? stripslashes($_POST['bglinkcolor']) : "#CCCCCC";	
	
	$options['footerleft'] = ( isset($_POST['footerleft']) ) ? stripslashes($_POST['footerleft']) : "";
	$options['site-width'] = ( isset($_POST['site-width']) ) ? stripslashes($_POST['site-width']) : "900";
	
	$options['header-text-display'] = ( isset($_POST['header-text-display']) ) ? stripslashes($_POST['header-text-display']) : "off";	
			

}


function set_variation_options() {
	global $_POST, $options, $options_values;


	/*********************************************************
	 * derived options defaults
	 *********************************************************/
	$options['site-margin-top'] = "0";
	 
	$options['background_color'] = "#FFFFFF";
	$options['background_image_file'] = "none";
	$options['background_image'] = "none";
	$options['background_position'] = "top";
	$options['background_repeat'] = "repeat-x";
	$options['bgbordercolor'] = "#999999";
	$options['page-image-width'] = $options['site-width']-50;
	
	$options['page_image_directory'] = "default";	
	$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/images/".$options['page_image_directory'];
	
	$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
	$options['page_top_padding'] = "30";	
	
	$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
	$options['page_main_padding'] = "50";	

	$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
	$options['page_bottom_padding'] = "30";
	
	$options['foreground_color'] = "#FFFFFF";
	$options['content-background'] = "#FFFFFF";
	
	$options['thread-even-bgcolor'] = "#FFFFFF";
	$options['thread-alt-bgcolor'] = "#f8f8f8";
	$options['commentfield'] = "#000000";

	
	/*********************************************************
	 * options value defaults
	 *********************************************************/	
	
	$options_values['site-width'] = array(
		'1000px' => '1050',
		'950px' => '1000',
		'900px' => '950',
		'850px' => '900',
		'800px' => '850',
		'750px' => '800'
		);
	
	$options_values['linkcolor'] = array(
		'Dark Blue' => '#003366',
		'Light Blue' => '#0066cc',
		'Red' => '#990000',
		'Green' => '#265e15',
		'Black' => '#151515'
		);
		
	$options_values['entry-link-style'] = array(
		'None' => 'none',
		'Underline' => 'underline',
		'Box' => 'box'
	);
	
	$options_values['textcolor'] = array(
		'Dark Gray' => '#666666',
		'Gray' => '#999999',
		'Light Gray' => '#CCCCCC',
		'Black' => '#424242'
	);

	$options_values['page-title'] = array(
		'Dark Gray' => '#666666',
		'Gray' => '#999999',
		'Light Gray' => '#CCCCCC',
		'Black' => '#424242'
	);

	$options_values['sidebar-title'] = array(
		'Dark Gray' => '#666666',
		'Gray' => '#999999',
		'Light Gray' => '#CCCCCC',
		'Black' => '#424242'
	);
	
	
	$options_values['headercolor'] = array(
		'White' => '#FFFFFF',
		'Silver' => '#F9F9F9',
		'Blue' => '#003366',
		'Yellow' => '#FFF8C6',
		'Green'	=>	'#92BB84'
		);
	
	
	$options_values['sidebar-left-color'] = array(
		'White' => '#FFFFFF',
		'Silver' => '#F9F9F9',
		'Gray' => '#F3F3F3',
		'Yellow' => '#FFF8C6',
		'Green' => '#92BB84'
		);
	
	$options_values['sidebar-right-color'] = array(
		'White' => '#FFFFFF',
		'Silver' => '#F9F9F9',
		'Gray' => '#F3F3F3',
		'Yellow' => '#FFF8C6',
		'Green' => '#92BB84'
		);

	$options_values['post-single-sidebar'] = array(
		'Left Sidebar' => 'left',
		'Right Sidebar' => 'right',
		'Both Sidebars' => 'both',
		'No Sidebars' => 'none'
	);

	/******************************************************************************
	 * Defaults for variations
	 * variations use defaults unless otherwise specified
	 * variations can have default option values and default option value lists
	 * option value lists are the option values users can select in the theme model UI
	 ******************************************************************************/
	 
	/******************************************************************************
	 * Black variation
	 * The black variation has it set of images (other variations use default images
	 * This variation also has limited option value lists 
	 ******************************************************************************/
	if ($options['background'] == "black") {
	
		// option values
		$options_values['headercolor'] = array(
			'Dark Gray' => '#262626',
			'Black' => '#000000'
		);

		$options_values['sidebar-right-color'] = array(
			'Dark Gray' => '#262626',
			'Black' => '#000000'
		);
		
		$options_values['sidebar-left-color'] = array(
			'Dark Gray' => '#262626',
			'Black' => '#000000'
		);
		
		$options_values['linkcolor'] = array(
			'Pale Yellow' => '#FFFFCC', 
			'Yellow' => '#FFCC33',
			'Light Gray' => '#CCCCCC',
			'White' => '#FFFFFF'	
		);
		
		$options_values['textcolor'] = array(
			'Light Gray' => '#CCCCCC',
			'Gray' => '#666666',
			'Silver' => '#F9F9F9'
		);

		$options_values['page-title'] = array(
			'Light Gray' => '#CCCCCC',
			'Gray' => '#666666',
			'White' => '#FFFFFF'
		);

		$options_values['sidebar-title'] = array(
			'Light Gray' => '#CCCCCC',
			'Gray' => '#666666',
			'White' => '#FFFFFF'
		);


		// if current value is one of this variation's option values, then use it 
		// otherwise use default for this variation
		if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#FFFFCC";
		if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#CCCCCC";
		if (!in_array($options['page-title'], array_values($options_values['page-title']))) $options['page-title'] = "#CCCCCC";
		if (!in_array($options['sidebar-title'], array_values($options_values['sidebar-title']))) $options['sidebar-title'] = "#CCCCCC";
		if (!in_array($options['headercolor'], array_values($options_values['headercolor']))) $options['headercolor'] = "#262626";
		if (!in_array($options['sidebar-left-color'], array_values($options_values['sidebar-left-color']))) $options['sidebar-left-color'] = "#262626";
		if (!in_array($options['sidebar-right-color'], array_values($options_values['sidebar-right-color']))) $options['sidebar-right-color'] = "#262626";
		
		$options['content-background'] = "#000000";		
		$options['page_image_directory'] = "black";	
		$options['page_image_path'] = "url('".get_bloginfo("stylesheet_directory")."/images/".$options['page_image_directory'];	
		
		$options['page_top_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-top.png')";
		// page_top_padding should = height of your page top image png
		$options['page_top_padding'] = "30";	
		
		$options['page_main_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-main.png')";
		$options['page_main_padding'] = "50";	
		
		$options['page_bottom_background_image'] = $options['page_image_path']."/".$options['page-image-width']."-bottom.png')";
		// page_bottom_padding should = height of your page bottom image png
		$options['page_bottom_padding'] = "30";

		$options['thread-even-bgcolor'] = "#333333";
		$options['thread-alt-bgcolor'] = "#000000";
		$options['commentfield'] = "#FFFFFF";
		$options['background_color'] = "#0F0F0F";
		$options['foreground_color'] = "#000000";
		$options['bgtextcolor'] = "#CCCCCC";
		$options['bglinkcolor'] = "#FFFFFF";
		$options['bgbordercolor'] = "#FFFFFF";

		$options['sidebar-left-border-left'] = "#FFFFCC";
		$options['sidebar-left-border-bottom'] = "#FFFFCC";
		$options['sidebar-left-border-right'] = "#FFFFCC";

		$options['sidebar-right-border-left'] = "#FFFFCC";
		$options['sidebar-right-border-bottom'] = "#FFFFCC";
		$options['sidebar-right-border-right'] = "#FFFFCC";
		
		$options['searchbox-color'] = "#262626";

	/******************************************************************************
	 * Blue
	 * The blue variation has a background image and different colors for
	 * for background color, borders, text and links
	 ******************************************************************************/

	} else if ($_REQUEST['background'] == "blue") {
	
		// option values
		$options['background_image_file'] = "bg.png";
		$options['background_image_directory'] = "blue";
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";
		$options['background_repeat'] = "repeat-y";
		$options['background_position'] = "center";		
		$options['background_color'] = "#071329";
		$options['bgtextcolor'] = "#666666";
		$options['bglinkcolor'] = "#FFFFFF";
		$options['bgbordercolor'] = "#000000";

	/******************************************************************************
	 * Green
	 ******************************************************************************/

	}  else if ($options['background'] == 'green') {
	
		// option values
		$options['background_image_file'] = "bg_edgedark.png";
		$options['background_image_directory'] = "green";
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";
		$options['background_repeat'] = "repeat-y";
		$options['background_position'] = "center";		
		$options['background_color'] = "#83A776";
		$options['bgtextcolor'] = "#666666";
		$options['bglinkcolor'] = "#333333";
		$options['bgbordercolor'] = "#666666";			

	/******************************************************************************
	 * white-yellow
	 ******************************************************************************/

	} else if ($options['background'] == 'white-yellow') {
	
		// option values
		$options['background_image_file'] = "bg_toplight.jpg";
		$options['background_image_directory'] = "white-yellow";
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";		
		$options['background_color'] = "#FFF8C6";		
		$options['bgtextcolor'] = "#CCCCCC";
		$options['bglinkcolor'] = "#999999";
		$options['bgbordercolor'] = "#999999";

	/******************************************************************************
	 * white-gray
	 ******************************************************************************/

	} else if ($options['background'] == 'white-gray') {
		
		// option values
		$options['background_image_file'] = "bg_toplight.jpg";
		$options['background_image_directory'] = "white-gray";	
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";		
		$options['background_color'] = "#F5F5F5";		
		$options['bgtextcolor'] = "#999999";
		$options['bglinkcolor'] = "#666666";
		$options['bgbordercolor'] = "#999999";
		
	/******************************************************************************
	 * yellow
	 ******************************************************************************/

	} else if ($options['background'] == 'yellow') {
		$options['background_image'] = "none";
		$options['background_color'] = "#FFF8C6";
		$options['bgtextcolor'] = "#CCCCCC";
		$options['bglinkcolor'] = "#999999";
		$options['bgbordercolor'] = "#999999";

	/******************************************************************************
	 * yellow-white
	 ******************************************************************************/

	} else if ($options['background'] == 'yellow-white') {
		$options['background_image_file'] = "bg_topdark.jpg";
		$options['background_image_directory'] = "yellow-white";	
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";

		$options['background_color'] = "#FFFFFF";
		$options['bgtextcolor'] = "#CCCCCC";
		$options['bglinkcolor'] = "#999999";
		$options['bgbordercolor'] = "#999999";

	
	/******************************************************************************
	 * gray
	 ******************************************************************************/

	}  else if ($options['background'] == 'gray') {	
		$options['background_image'] = "none";
		$options['background_color'] = "#F5F5F5";
		$options['bgtextcolor'] = "#999999";
		$options['bglinkcolor'] = "#666666";
		$options['bgbordercolor'] = "#999999";
		
	/******************************************************************************
	 * gray-white
	 ******************************************************************************/

	} else if ($options['background'] == 'gray-white') {
		$options['background_image_file'] = "bg_topdark.jpg";
		$options['background_image_directory'] = "gray-white";	
		$options['background_image'] = "url('".get_bloginfo("stylesheet_directory");
		$options['background_image'] .= "/images/".$options['background_image_directory'];
		$options['background_image'] .= "/".$options['background_image_file']."')";

		$options['background_color'] = "#FFFFFF";
		$options['bgtextcolor'] = "#999999";
		$options['bglinkcolor'] = "#666666";
		$options['bgbordercolor'] = "#999999";
	
	// if no variation has been selected then use theme defaults
	} 
	
	if (isset($_POST)) {
		if (!in_array($options['headercolor'], array_values($options_values['headercolor']))) $options['headercolor'] = "#F9F9F9";
		if (!in_array($options['sidebar-left-color'], array_values($options_values['sidebar-left-color']))) $options['sidebar-left-color'] = "#F3F3F3";
		if (!in_array($options['sidebar-right-color'], array_values($options_values['sidebar-right-color']))) $options['sidebar-right-color'] = "#F3F3F3";
		if (!in_array($options['linkcolor'], array_values($options_values['linkcolor']))) $options['linkcolor'] = "#003366";
		if (!in_array($options['entry-link-style'], array_values($options_values['entry-link-style']))) $options['entry-link-style'] = "none";
		if (!in_array($options['textcolor'], array_values($options_values['textcolor']))) $options['textcolor'] = "#333";
	}
	
}


/*********************************************************
 * Set directive options uses primary options (i.e. those exposed in UI)
 * to set derivative options
 *********************************************************/

function set_derivative_options() {
	global $_POST, $options, $options_values;

	/******************************************************************************
	 * Header left links
	 ******************************************************************************/
	
	if ($options['appgroups'] == 'blogs') {
		$options['headerleft'] = "<a href='http:".$current_site->domain . $current_site->path."wp-signup.php' title='View your Blogs'>WordPress</a>";
	} else if ($options['appgroups'] == 'custom') {
		$options['headerleft'] = stripslashes($options['headerleftcustom']);
	}

	/******************************************************************************
	 * Blog title and description display option
	 ******************************************************************************/
	if ($options['header-text-display'] == "on") {
		$options['show-header-text'] = "block";
	} else {
		$options['show-header-text'] = "none";
	}

	/******************************************************************************
	 * link color options
	 ******************************************************************************/

	// blue
	if ($options['linkcolor'] == '#003366') {	
		$options['linkcolor_visited'] = "#555555";
	// blue
	} else if ($options['linkcolor'] == '#0066cc') {	
		$options['linkcolor_visited'] = "#996666";
	// red
	} else if ($options['linkcolor'] == '#990000') {	
		$options['linkcolor_visited'] = "#996666";
	// green
	}  else if ($options['linkcolor'] == '#265e15') {	
		$options['linkcolor_visited'] = "#6D9C54";	
	// pale yellow
	}  else if ($options['linkcolor'] == '#FFFFCC') {	
		$options['linkcolor_visited'] = "#FFFBEE";	
	// yellow
	}  else if ($options['linkcolor'] == '#FFFFCC') {	
		$options['linkcolor_visited'] = "#FFFBEE";	
	// black
	}  else if ($options['linkcolor'] == '#151515') {	
		$options['linkcolor_visited'] = "#6E6E6E";	
	}

	/******************************************************************************
	 * Entry link style options
	 ******************************************************************************/	

	if ($options['entry-link-style'] == "none") {
		$options['entry-link-border'] = "none";
		$options['entry-link-hover-border'] = "none";
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "underline";
		
	} else if ($options['entry-link-style'] == "underline") {
		$options['entry-link-border'] = "none";
		$options['entry-link-hover-border'] = "none"; 
		$options['entry-link-decoration'] = "underline";
		$options['entry-link-hover-decoration'] = "underline";
		
	} else if ($options['entry-link-style'] == "box") {
		$options['entry-link-border'] = "dotted";
		$options['entry-link-hover-border'] = "solid";
		$options['entry-link-decoration'] = "none";
		$options['entry-link-hover-decoration'] = "none";
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
		
	} else if ($options['tag-link-style'] == "underline") {
		$options['tag-link-border'] = "none";
		$options['tag-link-decoration'] = "underline";
		$options['tag-link-hover-border'] = "none"; 
		$options['tag-link-hover-decoration'] = "underline";
		$options['tag-link-background'] = "none";
		
	} else if ($options['tag-link-style'] == "right-sidebar-box") {
		$options['tag-link-border'] = "solid";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "solid";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-background'] = $options['sidebar-right-color'];
		$options['tag-link-hover-decoration'] = "none";
		
	} else if ($options['tag-link-style'] == "left-sidebar-box") {
		$options['tag-link-border'] = "solid";
		$options['tag-link-decoration'] = "none";
		$options['tag-link-hover-border'] = "solid";
		$options['tag-link-hover-decoration'] = "none";
		$options['tag-link-background'] = $options['sidebar-left-color'];
		$options['tag-link-hover-decoration'] = "none";
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
		
	} else if ($options['category-link-style'] == "underline") {
		$options['category-link-border'] = "none";
		$options['category-link-decoration'] = "underline";
		$options['category-link-hover-border'] = "none"; 
		$options['category-link-hover-decoration'] = "underline";
		$options['category-link-background'] = "none";
		
	} else if ($options['category-link-style'] == "left-sidebar-box") {
		$options['category-link-border'] = "solid";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "solid";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-background'] = $options['sidebar-left-color'];
		$options['category-link-hover-decoration'] = "none";
		
	}	else if ($options['category-link-style'] == "right-sidebar-box") {
		$options['category-link-border'] = "solid";
		$options['category-link-decoration'] = "none";
		$options['category-link-hover-border'] = "solid";
		$options['category-link-hover-decoration'] = "none";
		$options['category-link-background'] = $options['sidebar-right-color'];
		$options['category-link-hover-decoration'] = "none";
	} 

	/******************************************************************************
	 * header color options
	 ******************************************************************************/
		 
	// black
	if ($options['headercolor'] == '#262626') {
		$options['headertext'] = "#FFFFFF";
		$options['headerdescription'] = "#FFFFFF";
		$options['headerborder'] = "#333333";
		$options['headertop'] = "#FFFFCC";
		$options['headerbottom'] = "#FFFFCC";	
		
	// silver
	} else if ($options['headercolor'] == '#F9F9F9') {	
		$options['headerdescription'] = "#999999";
		$options['headerborder'] = "#DFDFDF";
		$options['headertop'] = "#999999";
		$options['headerbottom'] = "#999999";
		
	// blue
	} else if ($options['headercolor'] == '#003366') {	
		$options['headerdescription'] = "#999999";
		$options['headerborder'] = "#DFDFDF";
		$options['headertop'] = "#333333";
		$options['headerbottom'] = "#333333";
	// green
	} else if ($options['headercolor'] == '#92BB84') {	
		$options['headerdescription'] = "#FFFFFF";
		$options['headerborder'] = "#7E7E7E";
		$options['headertop'] = "#333333";
		$options['headerbottom'] = "#333333";
	// yellow
	}  else if ($options['headercolor'] == '#FFF8C6') {	
		$options['headerdescription'] = "#999999";
		$options['headerborder'] = "#DFDFDF";
		$options['headertop'] = "#999999";
		$options['headerbottom'] = "#999999";		
	// white
	}  else if ($options['headercolor'] == '#FFFFFF') {	
		$options['headerdescription'] = "#999999";
		$options['headerborder'] = "#DFDFDF";
		$options['headertop'] = "#999999";
		$options['headerbottom'] = "#999999";
	}

	// if header color is NOT blue, set header text to linkcolor
	if ($options['headercolor'] == '#003366') {
		$options['headertext'] = "#FFFFFF";
	} else {
		$options['headertext'] = $options['linkcolor'];
	}
	
	/******************************************************************************
	 * sidebar color options
	 ******************************************************************************/
		
	// if white	then set left sidebar left and bottom borders to white
	if ($options['sidebar-left-color'] == '#FFFFFF') {	
		$options['sidebar-left-border-left'] = "#FFFFFF";
		$options['sidebar-left-border-bottom'] = "#FFFFFF";
		$options['sidebar-left-border-right'] = "#CCCCCC";
	
	// if black	then set left sidebar left and bottom borders to black
	} else if ($options['sidebar-left-color'] == '#000000') {	
		$options['sidebar-left-border-left'] = "#000000";
		$options['sidebar-left-border-bottom'] = "#000000";
		$options['sidebar-left-border-right'] = "#CCCCCC";
		
	// if greeen then set left sidebar left and bottom borders to black
	} else if ($options['sidebar-left-color'] == '#92BB84') {	
		$options['sidebar-left-border-left'] = "#000000";
		$options['sidebar-left-border-bottom'] = "#000000";
		$options['sidebar-left-border-right'] = "#000000";
		
	} else {
		$options['sidebar-left-border-left'] = "#CCCCCC";
		$options['sidebar-left-border-right'] = "#CCCCCC";
		$options['sidebar-left-border-bottom'] = "#CCCCCC";
	}
		
	// if white	then set right sidebar right and bottom borders to white	
	if ($options['sidebar-right-color'] == '#FFFFFF') {	
		$options['sidebar-right-border-right'] = "#FFFFFF";
		$options['sidebar-right-border-bottom'] = "#FFFFFF";
		$options['sidebar-right-border-left'] = "#CCCCCC";
	
	// if black	then set right sidebar right and bottom borders to black
	} else if ($options['sidebar-right-color'] == '#000000') {	
		$options['sidebar-right-border-left'] = "#000000";
		$options['sidebar-right-border-bottom'] = "#000000";
		$options['sidebar-right-border-right'] = "#CCCCCC";
	
	} else if ($options['sidebar-right-color'] == '#92BB84') {	
		$options['sidebar-right-border-left'] = "#000000";
		$options['sidebar-right-border-bottom'] = "#000000";
		$options['sidebar-right-border-right'] = "#000000";
				
	} else {
		$options['sidebar-right-border-left'] = "#CCCCCC";
		$options['sidebar-right-border-right'] = "#CCCCCC";
		$options['sidebar-right-border-bottom'] = "#CCCCCC";
	}	

	/******************************************************************************
	 * sidebar visibility options
	 ******************************************************************************/
	
	// left sidebar
	if ($options['sidebar-left-width'] == '0') {
		$options['sidebar-left-visibility'] = "hidden";
		if ($options['background'] == 'black') {
			$options['sidebar-left-color'] = "#000000";
			$options['sidebar-left-border-left'] = "#000000";
			$options['sidebar-left-border-right'] = "#000000";
			$options['sidebar-left-border-bottom'] = "#000000";			
		} else {
			$options['sidebar-left-color'] = "#FFFFFF";
			$options['sidebar-left-border-left'] = "#FFFFFF";
			$options['sidebar-left-border-bottom'] = "#FFFFFF";
		}
		$options['sidebar-left-border-right'] = $options['sidebar-left-color'];
		
	} else {
		$options['sidebar-left-visibility'] = "visible";
	}
	
	// right sidebar
	if ($options['sidebar-right-width'] == '0') {
		$options['sidebar-right-visibility'] = "hidden";
		if ($options['background'] == 'black') {
			$options['sidebar-right-color'] = "#000000";
			$options['sidebar-right-border-left'] = "#000000";
			$options['sidebar-right-border-right'] = "#000000";
			$options['sidebar-right-border-bottom'] = "#000000";	
		} else {
			$options['sidebar-right-color'] = "#FFFFFF";		
			$options['sidebar-right-border-bottom'] = "#FFFFFF";
			$options['sidebar-right-border-left'] = "#FFFFFF";
		}
		$options['sidebar-right-border-right'] = $options['sidebar-right-color'];

	} else {
		$options['sidebar-right-visibility'] = "visible";
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

function print_option_feedback() {
	global $_POST, $options;
	
	/******************************************************************************
	 * Give feedback about chosen options
	 ******************************************************************************/
	$main_column_width = $options['site-width'] - ($options['sidebar-left-width'] + $options['sidebar-right-width'] + 174);
	$message = "";
	$error = "false";
	
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
	
	if ($main_column_width < '400') {
		$message .= " <br/><br/>The area for your blog posts is less than 400px.  Consider increasing the width of your site.";	
		$error = "true";
	} 
	
	if ($options['post-sidebar-right-display'] == "show" && $options['sidebar-right-visibility'] == "hidden") {
		$message .= " <br/><br/>You wanted to show your right sidebar on single post pages but you have hidden it...";
		$error = "true";
	} 

	if ($options['post-sidebar-left-display'] == "show" && $options['sidebar-left-visibility'] == "hidden") {
		$message .= " <br/><br/>You wanted to show your left sidebar on single post pages but you have hidden it...";
		$error = "true";
	} 

	
	if ($error == "false") {
		$message .= " Visit the site";
	} else {
		$message .= " <br/><br/>Take a look at the site and see if it is the looks the way you had hoped";
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
