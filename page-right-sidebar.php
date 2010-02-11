<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
 /*
Template Name: Page with Right Sidebar
*/


get_header(); ?>

<table width='100%' cellpadding='0'>
<tr>

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
	</div>

<?php comments_template(); ?>

</td>
<td valign='top' class="right01block">

<?php if ($options['right01-width'] != 0) include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td>
</tr>

</table>
<table width='100%' class='bottomblock'>
<tr>
<?php include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>


<?php get_footer(); ?>
