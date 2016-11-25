<?php
/**
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 * 
 * Default header
 */
?>

<div class='default-header'>

<div class='logo'>

	<?php perfection_custom_logo_customizer(); ?>

</div>

<div class='header-menu'>

	<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>

</div>


<?php if (function_exists('perfection_search_in_menu_full')) perfection_search_in_menu_full(); ?>


<?php if ( is_active_sidebar( 'perfection_header_widget_location' ) ) : ?>
	<div id="header-sidebar" class="header-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'perfection_header_widget_location' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>

</div>