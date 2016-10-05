<?php
/**
 * The main template file.
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

<div id="primary" class="content-area">

	<div id="content" class="site-content" role="main">

	<?php 
	if ( have_posts() ) {
	    while ( have_posts() ) {
	        the_post();
	        the_title( '<h2>', '</h2>' );
	        the_content();
	    }
	}
	?>

	</div><!-- #content .site-content -->

</div><!-- #primary .content-area -->

<?php get_footer(); ?>