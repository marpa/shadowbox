<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */

get_header();
?>
<table width='100%' cellpadding='0'>
<tr>
<td valign='top' class="sidebarleftcolor">

<?php 
if ($options['post-sidebar-left-display'] == "show" && $options['sidebar-left-width'] != '0') {
	include (TEMPLATEPATH . '/sidebar-left.php'); 
}		
?>

</td>
<td valign='top' class="centercontent">

	<div id="content" class="widecolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			
			<div class="postmetadata">
			Posted in <span class='category'><?php the_category('</span> <span class=\'category\'') ?></span></div>

			<small><?php the_time('F jS, Y') ?>  by <?php the_author_posts_link(); ?></small>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<?php edit_post_link('Edit', '<div class="editlink">', '</div>'); ?>

				<div class="postmetadata">
				<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>',' '); ?></div>

				<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						and is filed under <span class='category'><?php the_category('</span><span class=\'category\'>') ?></span>.
						You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry','','.'); ?>

					</small>
				</p>
				 	<div id="syndication">
					<span><?php post_comments_feed_link('Comments RSS'); ?></span>
					</div>

			</div>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
</td>
<td valign='top' class="sidebarrightcolor">

<?php 
if ($options['post-sidebar-right-display'] == "show" && $options['sidebar-right-width'] != '0') {
	include (TEMPLATEPATH . '/sidebar-right.php'); 
}
?>

</td>
</tr>

</table>
<table>
<tr><td>
<?php //include (TEMPLATEPATH . '/bottombar.php'); ?>
</td></tr>
</table>

<?php get_footer(); ?>
