<?php 
get_header(); ?>
	
<table width='100%' cellpadding='0'>
<tr>
<td valign='top' class="sidebarleftcolor">

<?php 
if ($options['sidebar-left-width'] != 0) {
	include (TEMPLATEPATH . '/sidebar-left.php'); 
} 
?>

</td>
<td valign='top' class="centercontent">

	<div id="content" class="widecolumn">

		
			<?php 
				if(isset($_GET['author_name'])) :
				$curauth = get_userdatabylogin($author_name); // NOTE: 2.0 bug requires get_userdatabylogin(get_the_author_login());
				(get_the_author_login());
				else :
				$curauth = get_userdata(intval($author));
				endif;
			?>			
			
			<?php echo get_avatar($curauth->ID, '64' ); ?>
			<h2>Author: <?php echo $curauth->nickname; ?></h2>
			Member Since: <?php echo $curauth->user_registered; ?><br/>
			<?php if($curauth->user_url != "" && $curauth->user_url != "http://") : ?>
				Website: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br/>
			<?php endif; ?>
			<br/>
									
			<h2>Posts by <?php echo $curauth->nickname; ?>:</h2>
			<?php query_posts('author=' . $curauth->ID . '&showposts=50'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="postmetadata">
				Posted in <span class='category'><?php the_category('</span> <span class=\'category\'>') ?></span></div>

				<small><?php the_time('F jS, Y') ?>  by <?php the_author_posts_link(); ?></p></small>
				
				<div class="entry">
					<?php the_content() ?>
				</div>
				
				<div class="postmetadata">
				<?php the_tags('Tags: <span class=\'tag\'>','</span> <span class=\'tag\'>', '</span><br/>',' '); ?></div>

				<div class="postmetadata" style="text-align: right">
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></div>
				
				</div>

			<?php endwhile; ?>

			<?php else : ?>
				<h2>None</h2>
				<p><?php echo $curauth->nickname ?> has not created any posts.</p>
			<?php endif; ?>			
</div>

</td>
<td valign='top' class="sidebarrightcolor">

<?php ?>


</td>
</tr>

</table>
<table>
<tr><td>
<?php //include (TEMPLATEPATH . '/bottombar.php'); ?>
</td></tr>
</table>
		

<?php get_footer(); ?>
	