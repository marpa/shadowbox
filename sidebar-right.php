<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
?>
<div class="sidebarright01">

<?php
// display link to new post if user is at least an author
if (current_user_can( 'switch_themes' )) {
	print "<div class='editlink'>";
	print "<a style='border-color: ".$options['right01-link-color'].";' href='". get_bloginfo('url')."/wp-admin/widgets.php?show=&amp;sidebar=sidebar-2'>Edit Widgets</a>";
	print "</div>"; 
}?>
	<ul>
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-2') ) : ?>

			<li>
				<?php get_search_form(); ?>
			</li>

			<?php if ( is_404() || is_category() || is_day() || is_month() ||
						is_year() || is_search() || is_paged() ) {
			?> <li>

			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <?php the_time('F, Y'); ?>.</p>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p>You are currently browsing the <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for the year <?php the_time('Y'); ?>.</p>

			<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p>You have searched the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives
			for <strong>'<?php the_search_query(); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>You are currently browsing the <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> blog archives.</p>

			<?php } ?>

			</li>
		<?php }?>
		</ul>
		<ul>
			<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>


			<?php wp_list_categories('show_count=1&title_li=<h2>Categories</h2>'); ?>



		<?php endif; ?>
	</ul>
</div>


