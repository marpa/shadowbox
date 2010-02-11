<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
 /*
Template Name: Widget Page
*/


get_header(); ?>

<table width='100%' align='center' cellpadding='0' >
	<tr><td colspan='4'>
	
	<table width='100%' class='topblock'>
		<tr>
		<?php include (TEMPLATEPATH . '/sidebar-top.php'); ?>
		<td>
		<div id="syndication">
		<a href="<?php bloginfo('rss2_url'); ?>" class="feed">Posts RSS</a> 
		<a href="<?php bloginfo('comments_rss2_url'); ?>" class="feed">Comments RSS</a>
		</div>
		</td>	
	</tr>
	</table>
	<div class="hr"><hr /></div>	
	
	</td>
	</tr>
	<tr>
	<td valign='top' class="left01block">
	
	<?php if ($options['left01-width'] != 0) include (TEMPLATEPATH . '/sidebar-left.php'); ?>
	
	</td>
	
	<td valign='top' class="contentblock">
	<div id="content" class="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(); ?>
				<?php $sub_pages = wp_list_pages( 'sort_column=menu_order&depth=1&title_li=&echo=0&child_of=' . $id );?>
				<?php if ($sub_pages <> "" ){?>
					<p class="post-info"><?php _e('This page has the following sub pages.','ml');?></p>
					<ul><?php echo $sub_pages; ?></ul>
				<?php }?>
				
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>

		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit Page', '<div class=\'editlink\'>', '</div>'); ?>

	<?php
	// display link to edit widgets if user is at least an blog admin
	if (wp_get_current_user()->user_level > 7) {
		print "<div class='editlink'>";
		print "<a href='". get_bloginfo('url')."/wp-admin/widgets.php?show=&amp;sidebar=sidebar-1'>Edit Widgets</a>";
		print "</div>"; 
	}?>	

	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-6') ) : ?>	
	
	<?php endif; ?>


	
	</div>



</td>
<td valign='top' class="right01block">
	<?php if ($options['right01-width'] != 0) include (TEMPLATEPATH . '/sidebar-right.php'); ?>
</td>

<td valign='top' class="right02block">
	<?php if ($options['right02-width'] != 0) include (TEMPLATEPATH . '/sidebar-right02.php'); ?>
</td>

</tr>
</table>

<table width='100%' class='bottomblock'>
<tr>
	<?php include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>


<?php get_footer(); ?>
