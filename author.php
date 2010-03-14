<?php 
get_header(); ?>
	
<table width='100%' cellpadding='0'>
<tr>
<td valign='top' class="left01block">

<?php 
if ($options['author-sidebar-left-display'] == "show" && $options['left01-width'] != '0') {
	include (TEMPLATEPATH . '/sidebar-left.php');
}

?>

</td>
<td valign='top' class="contentblock">

	<div id="content">

		
			<?php 
				if(isset($_GET['author_name'])) :
				$curauth = get_userdatabylogin($author_name); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
				(get_the_author_login());
				else :
				$curauth = get_userdata(intval($author));
				endif;
			?>			
			<div id="syndication" style="float: right;">
			<?php echo "<a href='rss' title='Author RSS' class='feed'>&#8216;".$curauth->display_name."&#8217; Author RSS</a>"; ?>
			</div>
			<div style="float: right; padding-right: 5px;">
			<?php echo get_avatar($curauth->ID, '64' ); ?>			
			</div>			
			<div>
			<h2>Author: <?php echo $curauth->display_name; ?></h2>
			Member Since: <?php echo $curauth->user_registered; ?><br/>
			<?php if($curauth->user_url != "" && $curauth->user_url != "http://") : ?>
				Website: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br/>
			<?php endif; ?>

			</div>

			<br/>
									
			<h3>Posts by <?php echo $curauth->display_name; ?>:</h3>
			<?php query_posts('author=' . $curauth->ID . '&showposts=10'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="postmetadata">
				Posted in <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span></div>

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

			<?php else : ?>
				<h2>None</h2>
				<p><?php echo $curauth->nickname ?> has not created any posts.</p>
			<?php endif; ?>			
</div>

</td>
	<td valign='top' class="right01block">	
	<?php 
	if ($options['author-sidebar-right-display'] == "show" && $options['right01-width'] != '0') {
		include (TEMPLATEPATH . '/sidebar-right.php');
	} 
	?>

	<td valign='top' class="right02block">	
	<?php 
	if ($options['author-sidebar-right02-display'] == "show" && $options['right02-width'] != '0') {
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
	