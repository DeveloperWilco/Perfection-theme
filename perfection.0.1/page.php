<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<div class='limit-perfection'>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>

		</div>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>