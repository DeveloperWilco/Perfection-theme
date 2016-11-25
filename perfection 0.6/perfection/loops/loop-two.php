<?php
/**
 *
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 *
 *
 * Loop Name: Title - Image - Content
 */
?>

<?php if ( have_posts() ) : ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php // check if the post has a Post Thumbnail assigned to it.
		if ( has_post_thumbnail() ) { ?>

			<div class='post-thumbnail'>
			    <?php the_post_thumbnail(); ?>
			</div>
			
		<?php } ?>

 		<h2 class='post-title'><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

 		<div class='post-content'><?php the_content(); ?></div>

 		<?php wp_link_pages(); ?>


</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

	<!-- Add the pagination functions here. -->
	<?php perfection_pagination(); ?>


<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>



