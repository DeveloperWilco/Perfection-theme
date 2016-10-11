<?php 

add_action("admin_menu", "perfection_add_theme_menu_item");
add_action("admin_init", "perfection_add_options" );

// Create menu 
function perfection_add_theme_menu_item()
{
    add_theme_page("Thema-instellingen", "Thema-instellingen", "manage_options", "perfection-theme-settings", "perfection_theme_settings_page");
}



function perfection_add_options(){

   register_setting( 'perfectionPage', 'perfection_settings' );

   // Section 1 Breadcrumbs

   add_settings_section(
        'perfection_pluginPage_section', 
        __( 'Breadcrumbs', 'perfection' ), 
        'perfection_settings_section_callback', 
        'perfectionPage'
    );

    add_settings_field( 
        'perfection_checkbox_breadcrumbs_activate', 
        __( 'Activate breadcrumbs', 'perfection' ), 
        'perfection_checkbox_breadcrumbs_activate_render', 
        'perfectionPage', 
        'perfection_pluginPage_section' 
    );

    add_settings_field( 
        'perfection_text_breadcrumbs_separator', 
        __( 'Breadcrumbs Separator', 'perfection' ), 
        'perfection_text_breadcrumbs_separator_render', 
        'perfectionPage', 
        'perfection_pluginPage_section' 
    );

    // Section 2 General

   add_settings_section(
        'perfection_pluginPage_section_general',
        __( 'General', 'perfection' ),
        'perfection_settings_section_callback_general',
        'perfectionPage'
    );

   add_settings_field(
        'perfection_checkbox_stickymenu_activate',
        __( 'Sticky menu', 'perfection' ),
        'perfection_checkbox_stickymenu_render',
        'perfectionPage',
        'perfection_pluginPage_section_general'
    );

    add_settings_field(
        'perfection_checkbox_stickymenu_automargin',
        __( 'Sticky menu auto margin', 'perfection' ),
        'perfection_checkbox_stickymenu_automargin_render',
        'perfectionPage',
        'perfection_pluginPage_section_general'
    );

    add_settings_field(
        'perfection_back_to_top_active',
        __( 'Back to top button', 'perfection' ),
        'perfection_back_to_top_render',
        'perfectionPage',
        'perfection_pluginPage_section_general'
    );    

    add_settings_field(
        'perfection_back_to_top_speed',
        __( 'Back to top Speed', 'perfection' ),
        'perfection_back_to_top_speed_render',
        'perfectionPage',
        'perfection_pluginPage_section_general'
    );        
 
}

function perfection_checkbox_breadcrumbs_activate_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <input type='checkbox' name='perfection_settings[perfection_checkbox_breadcrumbs_activate]' <?php checked( isset( $options['perfection_checkbox_breadcrumbs_activate'] ) ); ?> value='1'>
    
    <?php

}

function perfection_text_breadcrumbs_separator_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <input type='text' name='perfection_settings[perfection_text_breadcrumbs_separator]' value='<?php echo $options['perfection_text_breadcrumbs_separator']; ?>'>
    
    <?php

}

function perfection_checkbox_stickymenu_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <input type='checkbox' name='perfection_settings[perfection_checkbox_stickymenu_activate]' <?php checked( isset( $options['perfection_checkbox_stickymenu_activate'] ) ); ?> value='1'>
    
    <?php

}

function perfection_checkbox_stickymenu_automargin_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <input type='checkbox' name='perfection_settings[perfection_checkbox_stickymenu_automargin]' <?php checked( isset( $options['perfection_checkbox_stickymenu_automargin'] ) ); ?> value='1'>
    
    <?php

}

function perfection_back_to_top_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <input type='checkbox' name='perfection_settings[perfection_back_to_top_active]' <?php checked( isset( $options['perfection_back_to_top_active'] ) ); ?> value='1'>
    
    <?php

}


function perfection_back_to_top_speed_render(  ) { 

    $options = get_option( 'perfection_settings' );
    ?>

    <select name='perfection_settings[perfection_back_to_top_speed]'>
        <option value='1' selected <?php selected( $options['perfection_back_to_top_speed'], 1 ); ?>>Slow</option>
        <option value='2' <?php selected( $options['perfection_back_to_top_speed'], 2 ); ?>>Medium</option>
        <option value='3' <?php selected( $options['perfection_back_to_top_speed'], 3 ); ?>>Fast</option>

    </select>
    
    <?php

}





function perfection_settings_section_callback(  ) { 

    echo __( 'Instellingen voor de breadcrumbs', 'perfection' );

}

function perfection_settings_section_callback_general(  ) { 

    echo __( 'Algemene instellingen', 'perfection' );

}

function perfection_theme_settings_page(){

    // Check that the user is allowed to update options
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    } ?>

    <?php settings_errors(); ?>

    <div class="wrap">
            <h1>Theme settings</h1>
            <form action="options.php" method="post">
                <?php
                    settings_fields( 'perfectionPage' );
                    do_settings_sections('perfectionPage');
                    submit_button(); 
                ?>          
            </form>
            <p>Created by Wilco.</p>
    </div>

<?php } ?>