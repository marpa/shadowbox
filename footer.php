<?php
/**
 * @package ShadowBox
 */
?>

<?php //$current_site = get_current_site(); ?>
<hr />

<?php global $options; ?>
<?php wp_footer(); ?>

</div>
</div>
<div class="page_bottom"></div>

<div id="footer">

<div class="footermeta_right">
	<span class="bgtextcolor">
	<a href="<?php print stripslashes($options['theme-url']); ?>">
	<?php print stripslashes($options['theme-name']); ?></a>
	<a href="<?php print stripslashes($options['background-source-url']); ?>">
	<?php print stripslashes($options['background-source-credit']); ?></a>
	| <a href="http://www.wordpress.org/">WordPress</a>	
	</span><br/>
</div>

<div class="footermeta_left">
	<span class="bgtextcolor">
	<?php print stripslashes($options['footerleft']); ?>
	</span><br/>
</div>

<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
</div>
</div>

</body>
</html>
