<?php 

function perfection_settings_init(  ) { 

  register_setting( 'perfectionSettings', 'perfection_settings' );

  add_settings_section(
    'perfection_pluginPage_section', 
    __( 'Your section description', 'perfection' ), 
    'perfection_settings_section_callback', 
    'perfectionSettings'
  );

  add_settings_field( 
    'perfection_checkbox_field_0', 
    __( 'Settings field description', 'perfection' ), 
    'perfection_checkbox_field_0_render', 
    'perfectionSettings', 
    'perfection_pluginPage_section' 
  );


}
add_action( 'admin_init', 'perfection_settings_init' );


function perfection_checkbox_field_0_render(  ) { 

  $options = get_option( 'perfection_settings' );
  ?>
  <input type='checkbox' name='perfection_settings[perfection_checkbox_field_0]' <?php checked( $options['perfection_checkbox_field_0'], 1 ); ?> value='1'>
  <?php

}


function perfection_settings_section_callback(  ) { 

  echo __( 'This section description', 'perfection' );

}


function perfection_theme_settings_page(){

	// Check that the user is allowed to update options
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}

    ?>
	    <div class="wrap">
		    <h1>Theme settings</h1>
		    <form method="post" enctype="multipart/form-data" action="options.php">
		        <?php
		            settings_fields( 'perfectionSettings' );
		            do_settings_sections('perfectionSettings');
		            submit_button(); 
		        ?>          
		    </form>
		    <p>Created by Wilco.</p>
		</div>
	<?php
}



?>