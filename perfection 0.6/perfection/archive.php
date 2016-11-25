 <?php
/**
 * The template for displaying archives and tags
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */


if (function_exists('perfection_redirect_archive_pages')) perfection_redirect_archive_pages(); 

get_header(); ?>

	<div class='limit-perfection'>

		<?php while ( have_posts() ) : the_post(); ?>
		
			<?php get_template_part( 'content', 'single' ); ?>
		
		<?php endwhile; // end of the loop. ?>

	</div>

<?php get_footer(); ?>
