<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<style type="text/css" >

<?php 
global $shadowbox_css; 
print $shadowbox_css;


?>
</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>
<body>

<?php global $options; ?>


<div class="sitewrapper">

	
<div class="headermeta_right">
<span class="bgtextcolor">
<?php 
if ($options['headermeta'] == "on") {
	if (wp_get_current_user()->user_level > 0) {
		print "<a href='".get_bloginfo('siteurl')."/wp-admin/profile.php'>";
		print wp_get_current_user()->display_name."</a>";
	}
	if (is_user_logged_in() == 'true') print " | ";
	print wp_loginout('','')."<br/>";
	if (wp_get_current_user()->user_level > 1) print "<a href='".get_bloginfo('siteurl')."/wp-admin/post-new.php'>post</a>";
	if (wp_get_current_user()->user_level > 4) print " | <a href='".get_bloginfo('siteurl')."/wp-admin/edit.php'>edit</a>";
	if (wp_get_current_user()->user_level > 7) print " | <a href='".get_bloginfo('siteurl')."/wp-admin/users.php'>users</a>";
	if (wp_get_current_user()->user_level > 7)print " | <a href='".get_bloginfo('siteurl')."/wp-admin/widgets.php'>widgets</a>";
	if (wp_get_current_user()->user_level > 7)print " | <a href='".get_bloginfo('siteurl')."/wp-admin/themes.php?page=Shadowbox'>theme</a>";
		//print wp_register('','');
}
?>	
</span><br/>
</div>
<div class="headermeta_left">
<span class="bgtextcolor">
<?php print stripslashes($options['headerleft']); ?>
</span><br/><br/>
</div>

<div class="page_top"></div>	
<div class="page_main">	
<div class="block_foreground">
		
			
<div id="header">
	<div class="block_header">
		<div class="headertext"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></div>
		<div class="description"><?php bloginfo('description'); ?></div>
	</div>
</div>


<hr />
