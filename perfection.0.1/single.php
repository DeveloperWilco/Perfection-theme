 <?php
/**
 * The template for displaying all single posts.
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

	<div class='limit-perfection'>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		 	<?php // Check if the post has a Post Thumbnail assigned to it.
			if ( has_post_thumbnail() ) { ?>
				<div class='post-thumbnail'>
				    <?php the_post_thumbnail(); ?>
				</div>
			<?php } ?>
		 	<div class='post-title'>
		 		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		 	</div>
		 	<div class='post-content'>
		 		<?php the_content(); ?>
		 	</div>

		 	<div class='comments'>
		 		<?php comment_form(); ?>
		 	</div>

		 	<div class="comment list">
		    	<?php wp_list_comments( array( 'style' => 'div' ) ); ?>
			</div>

			<div class='tags list'>
				<?php the_tags(); ?>
			</div>

		</article>

	</div>

<?php get_footer(); ?>
