<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
<table width='100%' cellpadding='0'>
<tr>

<?php 

if (is_category() && $options['category-sidebar-left-display'] == "show" && $options['left01-width'] != '0') {
	print "<td valign='top' class='left01block'>";
	include (TEMPLATEPATH . '/sidebar-left.php');
} else if (is_tag() && $options['tag-sidebar-left-display'] == "show" && $options['left01-width'] != '0') {
print "<td valign='top' class='left01block'>";
	include (TEMPLATEPATH . '/sidebar-left.php');
} else if ((is_day() || is_month() || is_year())
	&& $options['archives-sidebar-left-display'] == "show" 
	&& $options['left01-width'] != '0') {
	print "<td valign='top' class='left01block'>";
	include (TEMPLATEPATH . '/sidebar-left.php');
} else {
	print "<td valign='top' class='left01block' style='width: 0px; border: none;'>";
}

?>

</td>
<td valign='top' class="contentblock">

	<div id="content">

		<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>

 	  	<div style = "width: 50%; float: right;">
			<div id="syndication">
			<a href="<?php get_category_feed_link( $cat_id, $feed ); ?>feed" class="feed">
			&#8216;<?php single_cat_title(); ?>&#8217; Category RSS</a>
			</div>
		</div>

		<div><h2 single_tag_title="pagetitle">Categories &raquo; &#8216;<?php single_cat_title(); ?>&#8217;</h2></div>
		
		
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
 	  	<div style = "width: 45%; float: right; clear: left;">
 	  	<div id="syndication">
		<a href="<?php get_tag_feed_link( $cat_id, $feed ); ?>feed" class="feed">&#8216;<?php single_cat_title(); ?>&#8217; Tag RSS</a>
		</div>
		</div>
		<div><h2 single_tag_title="pagetitle">Tags &raquo; &#8216;<?php single_tag_title(); ?>&#8217;</h2></div>
		
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>
 	  <?php } ?>



		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?>>
				<h2 id="post-<?php the_ID(); ?>">
				
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="postmetadata">
				Categories: <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span></div>

				<small><?php the_time('F jS, Y') ?>  by <?php the_author_posts_link(); ?></small>
				
				<div class="entry">
					<?php the_content('<div class=\'morelink\'>&laquo; More &raquo;</div>'); ?> 
				</div>
				
				<div class="postmetadata">
				<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>',' '); ?></div>

				<div class="postmetadata" style="text-align: right">
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

</div>

	</td>
	<?php 
	if (is_category() && $options['category-sidebar-right-display'] == "show" && $options['right01-width'] != '0') {
		print "<td valign='top' class='right01block'>";
		include (TEMPLATEPATH . '/sidebar-right.php');
	} else if (is_tag() && $options['tag-sidebar-right-display'] == "show" && $options['right01-width'] != '0') {
		print "<td valign='top' class='right01block'>";
		include (TEMPLATEPATH . '/sidebar-right.php');
	} else if ((is_day() || is_month() || is_year())
		&& $options['archives-sidebar-right-display'] == "show" 
		&& $options['right01-width'] != '0') {
		print "<td valign='top' class='right01block'>";
		include (TEMPLATEPATH . '/sidebar-right.php');
	} else {
		print "<td valign='top' class='right01block' style='width: 0px; border: none;'>";
	}
	
	?>
	
	<?php 
	if (is_category() && $options['category-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') {
		print "<td valign='top' class='right02block'>";
		include (TEMPLATEPATH . '/sidebar-right02.php');
	} else if (is_tag() && $options['tag-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') {
		print "<td valign='top' class='right02block'>";
		include (TEMPLATEPATH . '/sidebar-right02.php');
	} else if ((is_day() || is_month() || is_year())
		&& $options['archives-sidebar-right02-display'] == "show" 
		&& $options['right02-width'] != '0') {
		print "<td valign='top' class='right02block'>";
		include (TEMPLATEPATH . '/sidebar-right02.php');
	} else {
		print "<td valign='top' class='right02block' style='width: 0px; border: none;'>";
	}
	?>	
	</td>


</td>
</tr>

</table>

<table width='100%' class='bottomblock'>
<tr>
<?php include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>


<?php get_footer(); ?>
