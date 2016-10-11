 <?php
/**
 * The template for displaying archives and tags
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */

get_header(); ?>

	<div class='limit-perfection'>

		<article> 

    	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php get_option( 'date_format' ); ?> in <?php the_category('&');?>
        </li>

    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.','perfection'); ?></p>

    <?php endif; ?>

		</article>

	</div>

<?php get_footer(); ?>
