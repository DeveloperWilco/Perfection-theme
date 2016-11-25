 <?php
/**
 * The template for displaying all single posts.
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 *
 */
?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

 	<?php
	if ( has_post_thumbnail() ) { ?>
		<div class='post-thumbnail'>
		    <?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>
 	<div class='post-title'><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
 	<div class='post-content'><?php the_content(); ?></div>

 </article>