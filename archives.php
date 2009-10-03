<?php
/**
 * @package WordPress
 * @subpackage ShadowBox
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
<table width='100%' cellpadding='0'>
<tr>
<td valign='top' class="sidebarleftcolor">

<?php //include (TEMPLATEPATH . '/sidebar-left.php'); ?>
</td>
<td valign='top' class="centercontent">

<div id="content" class="widecolumn">

<?php get_search_form(); ?>

<h2>Archives by Month:</h2>
	<ul>
		<?php wp_get_archives('type=monthly'); ?>
	</ul>

<h2>Archives by Subject:</h2>
	<ul>
		 <?php wp_list_categories(); ?>
	</ul>

</div>
</td>
<td valign='top' class="sidebarrightcolor">

<?php //include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td>
</tr>

</table>
<table>
<tr>
<?php //include (TEMPLATEPATH . '/bottombar.php'); ?>
</tr>
</table>

<?php get_footer(); ?>
