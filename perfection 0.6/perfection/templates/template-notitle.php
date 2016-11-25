<?php
/**
 * This template displays full width pages without a page title.
 *
 * @package perfection
 * @since perfection 0.2
 * @license GPL 2.0
 * 
 * Template Name: Full Width Page, No Title
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<div class='limit-perfection'>


				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="entry-main">

							<div class="entry-content">
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'perfection' ) ); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'perfection' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->

						</div>

					</article><!-- #post-<?php the_ID(); ?> -->

					<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>

				<?php endwhile; // end of the loop. ?>
				
			</div>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>