<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */

get_header();
?>
<table width='100%' cellpadding='0'>
<tr>
	<td valign='top' class="left01block">
	
	<?php 
	if ($options['post-sidebar-left-display'] == "show" && $options['left01-width'] != '0') {
		include (TEMPLATEPATH . '/sidebar-left.php'); 
	}		
	?>
	
	</td>
	<td valign='top' class="contentblock">

	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div style = "float: left; clear: left;"><h2><?php the_title(); ?></h2></div>
			
		<div class="postmetadata">
			Categories: <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span>
		</div>

		<small><?php the_time('l, F jS, Y') ?>  by <?php the_author_posts_link(); ?></small>
		<div class="entry">
		
			<?php the_content('<div class=\'morelink\'>&laquo; More &raquo;</div>'); ?> 

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php edit_post_link('Edit', '<div class="editlink">', '</div>'); ?>
		</div>

		<div class="postmetadata">
			<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>',' '); ?>
		</div>

		<div class="postmetadata alt">
				
				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Both Comments and Pings are open ?>
					<a href="#respond">Respond</a> <a href="<?php trackback_url(); ?>" rel="trackback">Trackback</a>

				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
					// Only Pings are Open ?>
					<a href="<?php trackback_url(); ?> " rel="trackback">Trackback</a><br/>
					Responses are currently closed.

				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Comments are open, Pings are not ?>
					<a href="#respond">Respond</a><br/>
					Pinging is currently not allowed.

				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
					// Neither Comments, nor Pings are open ?>
					Both comments and pings are currently closed.

				<?php } ?>

		</div>
		<div id="syndication">
			<span><?php post_comments_feed_link('Comments RSS'); ?></span>
		</div>

	</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

	</div>
	</td>
	
	<td valign='top' class="right01block">	
	<?php 
	if ($options['post-sidebar-right-display'] == "show" && $options['right01-width'] != '0') {
		include (TEMPLATEPATH . '/sidebar-right.php'); 
	}
	?>
	</td>
	
	<td valign='top' class="right02block">	
	<?php 
	if ($options['post-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') {
		include (TEMPLATEPATH . '/sidebar-right02.php'); 
	}	
	?>	
	</td>

</tr>

</table>

<table width='100%' class='bottomblock'>
<tr>
<?php include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>

<?php get_footer(); ?>
