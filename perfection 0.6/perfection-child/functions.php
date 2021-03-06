<?php


/**
 * Enqueue the parent theme stylesheet.
 */

add_action( 'wp_enqueue_scripts', 'perfection_parent_style' );
function perfection_parent_style() {
    wp_enqueue_style( 'parent-theme', get_template_directory_uri() . '/style.css' );
}



function perfection_child_recommended_plugins(){
	$plugins = array(

		array(
			'name'      => 'WP-SCSS',
			'slug'      => 'wp-scss',
			'required'  => false,
		)
	);

	$config = array(
		'id'           => 'tgmpa-perfection',      // Unique ID for hashing notices for multiple instances of TGMPA.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'activate_plugins',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'perfection_child_recommended_plugins' );

?>