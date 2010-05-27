<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
?>
<div class="sidebarright02">

	<?php
	// display link to new post if user is at least an author
	if (current_user_can( 'switch_themes' )) {
		print "<div class='editlink'>";
		print "<a href='". get_bloginfo('url')."/wp-admin/widgets.php?show=&amp;sidebar=sidebar-3'>Edit Widgets</a>";
		print "</div>"; 
	}?>
	
	<ul>
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-3') ) : ?>
		
			<li><h2>Archives</h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
		
			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
				<?php wp_list_bookmarks(); ?>

		<?php } ?>	
		<?php endif; ?>
	</ul>
</div>


