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
<td valign='top' class="left01block">

<?php //include (TEMPLATEPATH . '/sidebar-left.php'); ?>
</td>
<td valign='top' class="contentblock">

<div id="content">

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
<td valign='top' class="right01block">

<?php //include (TEMPLATEPATH . '/sidebar-right.php'); ?>

</td>
</tr>

</table>
<table>
<tr>
<?php //include (TEMPLATEPATH . '/sidebar-bottom.php'); ?>
</tr>
</table>

<?php get_footer(); ?>
