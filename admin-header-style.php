function admin_header_style() { 
	?>
	<style type="text/css">
	#headimg, .block_header{
		background: <?php echo HEADER_BGCOLOR; ?> url(<?php header_image(); ?>) 0 0 no-repeat;
		background-position: right;
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	}
		
	<?php if ( 'blank' == get_header_textcolor() ) { ?>
	
		.block_header, h1, #headimg h1 {
				display: none;
		}
	
	<?php } else { ?>
	
		.block_header .headertext .description, #headimg h1 {
			display: none;
		}
		.block_header .headertext .description, #headimg #desc {
			display: none;
		}
	<?php } ?>
	
	</style>
	<?php 
}

/*********************************************************
 * define styles based on results of custom header function
 *********************************************************/

function header_style() {
	?>
	
	<style type="text/css">
	.block_header {
		background: <?php echo HEADER_BGCOLOR; ?> url(<?php header_image(); ?>) 0 0 no-repeat;
		background-position: right;
	}
	</style>	
	<?php
}