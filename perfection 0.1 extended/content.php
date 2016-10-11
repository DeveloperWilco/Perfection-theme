<?php
/**
 *
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 *
 *
 * Loop Name: Image - title - content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="perfection-post">

		<?php // check if the post has a Post Thumbnail assigned to it.
		if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} ?>

 		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

 		<?php the_content(); ?>

 		<?php wp_link_pages(); ?>

 	</div>

</article><!-- #post-<?php the_ID(); ?> -->
