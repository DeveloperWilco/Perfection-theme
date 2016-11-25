<?php
/**
 *
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 *
 *
 * Loop Name: Content - Title
 */
?>

<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 		<div class='post-content'><?php the_content(); ?></div>

 		<h2 class='post-title'><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

	<?php perfection_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>



