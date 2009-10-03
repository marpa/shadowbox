<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
 /*
Template Name: Page with Two Sidebars
*/


get_header(); ?>

<table width='100%' cellpadding='0'>
<tr>
<td valign='top' class="sidebarleftcolor">

<?php include (TEMPLATEPATH . '/sidebar-left.php'); ?>
</td>
<td valign='top' class="centercontent">

	<div id="content" class="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>

		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>

<?php comments_template(); ?>

</td>
<td valign='top' class="sidebarrightcolor">

<?php include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td>
</tr>
</table>

<table>
<tr>
<?php include (TEMPLATEPATH . '/bottombar.php'); ?>
</tr>
</table>


<?php get_footer(); ?>
