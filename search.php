<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */

get_header(); ?>

<table width='100%' cellpadding='0'>
<tr>
	<td valign='top' class="left01block">
	
	<?php if ($options['left01-width'] != 0) include (TEMPLATEPATH . '/sidebar-left.php'); ?>
	
	</td>

<td valign='top' class="contentblock">

	<div id="content" class="widecolumn">


	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time('l, F jS, Y') ?></small>
				<div class="postmetadata">
				Posted in <span class='category'><?php the_category('</span><span class=\'category\'>') ?></span></div>

				<div class="postmetadata">
				<?php the_tags('Tags: <span class=\'tag\'>','</span><span class=\'tag\'>', '</span><br/>',' '); ?></div>

				<div class="postmetadata" style="text-align: right">
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

</td>
<td valign='top' class="right01block">

<?php if (!isset($options['right01-width']) || $options['right01-width'] != 0) include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td>
</tr>

</table>
<table>
<tr>
<?php //include (TEMPLATEPATH . '/bottombar.php'); ?>
</tr>
</table>


<?php get_footer(); ?>
