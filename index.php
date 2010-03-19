<?php get_header(); ?>
<?php global $options; ?>

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
	<?php 
	if ($options['left01-width'] != '0') {
		print "<td valign='top' class='left01block'>";
		include (TEMPLATEPATH . '/sidebar-left.php'); 
		print "</td>";
	}
	?>
	
	<td valign='top' class="contentblock">
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
					Categories: <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span>
					</div>
	
					<small><?php the_time('F jS, Y') ?>  by <?php the_author_posts_link(); ?></small>
	
					<div class="entry">
						<?php the_content('<div class=\'morelink\'>&laquo; More &raquo;</div>'); ?> 
					</div>
	
					<?php edit_post_link('Edit', '<div class="editlink">', '</div>'); ?>
	
					<div class="postmetadata">
					<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>'); ?></div>
	
					<div class="commentlink" style="text-align: right">
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
	<?php 
	if ($options['right01-width'] != '0') {
		print "<td valign='top' class='right01block'>";
		include (TEMPLATEPATH . '/sidebar-right.php');
		print "</td>";
	}
	
	if ($options['right02-width'] != '0') {
		print "<td valign='top' class='right02block'>";
		include (TEMPLATEPATH . '/sidebar-right02.php'); 
		print "</td>";
	}
	?>
	</tr>
</table>

<table width='100%' class='bottomblock'>
<tr>
<?php include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>

<?php get_footer(); ?>


