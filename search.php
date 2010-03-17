<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */

get_header(); ?>

<table width='100%' cellpadding='0'>
<tr>
	<?php 
	if ($options['search-sidebar-left-display'] == "show" && $options['left01-width'] != '0') {
		print "<td valign='top' class='left01block'>";
		include (TEMPLATEPATH . '/sidebar-left.php'); 
	} else {
		print "<td valign='top' class='left01block' style='width: 0px; border: none;'>";
	}
	?>

<td valign='top' class="contentblock">

	<div id="content">


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
	<?php 
	if ($options['search-sidebar-right-display'] == "show" && $options['right01-width'] != '0') {
		print "<td valign='top' class='right01block'>";
		include (TEMPLATEPATH . '/sidebar-right.php'); 
	} else {
		print "<td valign='top' class='right01block' style='width: 0px; border: none;'>";
	}
	?>
	</td>
	
	<?php 
	if ($options['search-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') {
		print "<td valign='top' class='right02block'>";
		include (TEMPLATEPATH . '/sidebar-right02.php'); 
	} else {
		print "<td valign='top' class='right02block' style='width: 0px; border: none;'>";
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
