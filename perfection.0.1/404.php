<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Perfection
 * @since Perfection 0.1
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<div class='limit-perfection'>

				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Not Found', 'perfection' ); ?></h1>
				</header>

				<div class="page-wrapper">
					<div class="page-content">
						<h2><?php _e( 'Sorry', 'perfection' ); ?></h2>
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'perfection' ); ?></p>

						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</div><!-- .page-wrapper -->

			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>