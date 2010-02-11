<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
?>

<div class="sidebarleft01">

<?php
// display link to edit widgets if user is at least an blog admin
if (wp_get_current_user()->user_level > 7) {
	print "<div class='editlink'>";
	print "<a href='". get_bloginfo('url')."/wp-admin/widgets.php?show=&amp;sidebar=sidebar-1'>Edit Widgets</a>";
	print "</div>"; 
}?>

	<ul>
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1') ) : ?>	
		
		<?php endif; ?>
	</ul>

</div>

