<?php
/**
 * The template for displaying the search results
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

	<div class='limit-perfection'>

		<article> 

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content' ); ?>

			<?php endwhile; ?>
		
		</article>

	</div>

<?php get_footer(); ?>
