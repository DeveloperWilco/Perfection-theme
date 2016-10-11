<?php
/**
 * Just displays a post loop. Intended to be included in child themes using get_template_part('loop'). Also works with SiteOrigin page builder loop widget.
 *
 * Loop Name: Blog Loop
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */
?>

<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>

	<?php endwhile; ?>

	<!-- Add the pagination functions here. -->
	<?php wp_link_pages(); ?>
	<div class="nav-previous alignleft"><?php next_posts_link( 'Back' ); ?></div>
	<div class="nav-next alignright"><?php previous_posts_link( 'Next' ); ?></div>


<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>