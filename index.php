<?php get_header(); ?>
<?php global $options; ?>



<table width='100%' align='center' cellpadding='0'>
<tr><td colspan='3'>

<table width='100%' class='topbar'>
<tr>
<?php include (TEMPLATEPATH . '/topbar.php'); ?>
<td>
<div id="syndication">
<a href="<?php bloginfo('rss2_url'); ?>" class="feed">Posts RSS</a> 
<a href="<?php bloginfo('comments_rss2_url'); ?>" class="feed">Comments RSS</a>
</div>
</td>
</tr>
</table>
<div class="hr"><hr /></div>
</td></tr>
<tr>
<td valign='top' class="sidebarleftcolor">

<?php if ($options['sidebar-left-width'] != 0) include (TEMPLATEPATH . '/sidebar-left.php'); ?>
</td>
<td valign='top' class="centercontent">
    <div id="content">
    
    <?php
    // display link to new post if user is at least an author
    if (wp_get_current_user()->user_level > 1) {
		print "<div class='postlink'>";
		print "<a href='". get_bloginfo('url')."/wp-admin/post-new.php'>New Post</a>";
		print "</div>"; 
	}?>
	
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="postmetadata">
				Posted in <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span></div>

				<small><?php the_time('F jS, Y') ?>  by <?php the_author() ?></small>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

				<?php edit_post_link('Edit', '<div class="editlink">', '</div>'); ?>

				<div class="postmetadata">
				<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>'); ?></div>

				<div class="postmetadata" style="text-align: right">
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

	
</td>
<td valign='top' class="sidebarrightcolor">

<?php if ($options['sidebar-right-width'] != 0) include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td></tr>
</table>

<table>
<tr>
<?php include (TEMPLATEPATH . '/bottombar.php'); ?>
</tr>
</table>

<?php get_footer(); ?>


