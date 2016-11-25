<?php
/**
 * This template displays full width pages.
 *
 * @package perfection
 * @since perfection 0.2
 * @license GPL 2.0
 * 
 * Template Name: Full Width Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class='limit-perfection'>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>

				<?php endwhile; // end of the loop. ?>
				
			</div>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>