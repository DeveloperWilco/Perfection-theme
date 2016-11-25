 <?php
/**
 * The template for displaying all single posts.
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

<div id='primary' class='content-area'>

	<div id='content' class='site-content' role='main'>

		<div class='limit-perfection'>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

				 	<?php
					if ( has_post_thumbnail() ) { ?>
						<div class='post-thumbnail'>
						    <?php the_post_thumbnail(); ?>
						</div>
					<?php } ?>

				 	<div class='post-title'><?php the_title(); ?></div>

				 	<div class='post-content'><?php the_content(); ?></div>

			 	    <?php if ( comments_open() ) { comments_template(); }?>
				 	
					<div class='post-tags list'><?php the_tags(); ?></div>

				</article>

			<?php endwhile; // end of the loop. ?>
			
		</div>

	</div>

</div>

<?php get_footer(); ?>
