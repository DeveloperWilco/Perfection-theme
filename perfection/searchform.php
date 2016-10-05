<?php
/**
 * The template for displaying search forms in perfection
 *
 * @package perfection
 * @since perfection 0.1
 * @license GPL 2.0
 */
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', 'perfection' ); ?>"/>
</form>
