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
	<a href="http://segueproject.org/wordpress/">ShadowBox</a> | <a href="http://mu.wordpress.org/">WordPress</a>	
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
