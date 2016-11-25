<?php


//Sections represent a group of settings
//Controls and settings need to be added to a section
//Controls are needed to get the setting to the section

/**
 *
 *	@since perfection 0.2
 *	@package perfection
 *	@license GPL 2.0
 */


// here comes  class



function perfection_customize_register($wp_customize) 
{
	// Add selective refresh method
	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );

	// Panel Theme options
	$wp_customize->add_panel( 'theme_options_perfection', array(
		'priority'       => 21,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Theme Options', 'perfection'),
		'description'    => __('Such options, Much power, wow', 'perfection'),
	));

	// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-

	// Section General
	$wp_customize->add_section("general", array(
		"title"			=> __("General", "perfection"),
		"priority"		=> 28,
		"panel"			=> 'theme_options_perfection',
	));

	// Setting blog read more text
	$wp_customize->add_setting("blog_read_more", array(
		"default"				=> "Read more",
		'sanitize_callback'		=> 'perfection_sanitize_text',
		"transport"				=> "refresh",
	));	

	// Setting blog next page text
	$wp_customize->add_setting("blog_next_page", array(
		"default" 				=> "Next",
		'sanitize_callback'		=> 'perfection_sanitize_text',
		"transport" 			=> $transport,
	));		

	// Setting blog previous page text
	$wp_customize->add_setting("blog_previous_page", array(
		"default" 				=> "Back",
		'sanitize_callback' 	=> 'perfection_sanitize_text',
		"transport" 			=> $transport,
	));	

	// Setting single post meta slider ID
	$wp_customize->add_setting("singlepost_metaslider", array(
		"default" 				=> __('None','perfection'),   
		'sanitize_callback' 	=> 'perfection_sanitize_select_singlepost_metaslider',
		"transport" 			=> "none",
	));

	// Setting enable default styles
	$wp_customize->add_setting("default_styles", array(
		"default" 				=> "checked",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));

	// Control Read more text
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"blog_read_more",
		array(
			"label" 		=> __("Read more text", "perfection"),
			"section" 		=> "general",
			'capability' 	=> 'manage_options',
			"settings" 		=> "blog_read_more",
			"type" 			=> "text",
		)
	));	

	// Control Next
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"blog_next_page",
		array(
			"label" 		=> __("Next page text", "perfection"),
			"section" 		=> "general",
			'capability' 	=> 'manage_options',
			"settings" 		=> "blog_next_page",
			"type" 			=> "text",
		)
	));		

	// Control Previous
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"blog_previous_page",
		array(
			"label" 		=> __("Previous page text", "perfection"),
			"section" 		=> "general",
			'capability' 	=> 'manage_options',
			"settings" 		=> "blog_previous_page",
			"type" 			=> "text",
		)
	));		

	// Control single post metaslider ID
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"singlepost_metaslider",
		array(
			"label" 		=> __("Singlepost Metaslider", "perfection"),
			"section" 		=> "general",
			'capability' 	=> 'manage_options',
			"settings" 		=> "singlepost_metaslider",
			"type" 			=> "select",
			"choices" 		=> perfection_metaslider_setting_values(),
			"description" 	=> __('Select singlepost metaslider','perfection') ,
		)
	));	

	// Control Enable default styles
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"default_styles",
		array(
			"label" 		=> __("Enable default styles", "perfection"),
			"section" 		=> "general",
			'capability' 	=> 'manage_options',
			"settings" 		=> "default_styles",
			"type" 			=> "checkbox",
		)
	));


	// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-

	// Section header
	$wp_customize->add_section("header_section", array(
		"title" 		=> __("Header", "perfection"),
		"priority" 		=> 29,
		"panel" 		=> 'theme_options_perfection',
	));

	// Setting select header template
	$wp_customize->add_setting("header_select_template", array(
		"default" 				=> 'default',   
		'sanitize_callback' 	=> 'perfection_sanitize_select_header_template',
		"transport" 			=> 'refresh',
	));

	// Setting Logo limit height
	$wp_customize->add_setting("logo_limit", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));	

	// Setting sticky menu
	$wp_customize->add_setting("sticky_menu_code", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));

	// Setting sticky menu auto margin
	$wp_customize->add_setting("sticky_menu_auto_margin_code", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));

	// Setting search in header
	$wp_customize->add_setting("search_in_header", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));

	// Setting background search in header
	$wp_customize->add_setting("search_in_header_background", array(
		"default" 				=> "#f92f7d",
		'sanitize_callback' 	=> 'sanitize_hex_color',
		"transport" 			=> "refresh",
	));

	// Control select header template
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"header_select_template",
		array(
			"label" 		=> __("Select Header template", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "header_select_template",
			"type" 			=> "select",
			"choices" 		=> perfection_header_template_select()
		)
	));

	// Control Logo limit height
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"logo_limit",
		array(
			"label" 		=> __("Limit logo height", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "logo_limit",
			"type" 			=> "checkbox",
		)
	));

	// Control sticky menu
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"sticky_menu_code",
		array(
			"label" 		=> __("Sticky menu", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "sticky_menu_code",
			"type" 			=> "checkbox",
		)
	));

	// Control sticky menu auto margin
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"sticky_menu_auto_margin_code",
		array(
			"label" 		=> __("Sticky menu auto margin", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "sticky_menu_auto_margin_code",
			"type" 			=> "checkbox",
		)
	));

	// Control search in header
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"search_in_header",
		array(
			"label" 		=> __("Search in header", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "search_in_header",
			"type" 			=> "checkbox",
		)
	));

	// Control search in header background color
	$wp_customize->add_control(new WP_Customize_Color_Control(
		$wp_customize,
		"search_in_header_background",
		array(
			"label" 		=> __("Search background color", "perfection"),
			"section" 		=> "header_section",
			'capability' 	=> 'manage_options',
			"settings" 		=> "search_in_header_background",
		)
	));

	// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-

	// Section Back to top
	$wp_customize->add_section("back_to_top", array(
		"title" 		=> __("Back to top", "perfection"),
		"priority" 		=> 30,
		"panel" 		=> 'theme_options_perfection'
	));

	// Setting back to top button
	$wp_customize->add_setting("back_to_top_button_code", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> "refresh",
	));

	// Setting back to top button color
	$wp_customize->add_setting("back_to_top_button_color", array(
		"default" 				=> "#000000",
		'sanitize_callback' 	=> 'sanitize_hex_color',
		"transport" 			=> "refresh",
	));

	// Setting back to top button color hover
	$wp_customize->add_setting("back_to_top_button_color_hover", array(
		"default" 				=> "#ffffff",
		'sanitize_callback' 	=> 'sanitize_hex_color',
		"transport" 			=> "refresh",
	));

	// Setting back to top button arrow color
	$wp_customize->add_setting("back_to_top_arrow_color", array(
		"default" 				=> "#ffffff",
		'sanitize_callback' 	=> 'sanitize_hex_color',
		"transport" 			=> "refresh",
	));

	// Settign back to top button arrow color hover
	$wp_customize->add_setting("back_to_top_arrow_color_hover", array(
		"default" 				=> "#000000",
		'sanitize_callback' 	=> 'sanitize_hex_color',		
		"transport" 			=> "refresh",
	));	

	// Setting back to top button select speed
	$wp_customize->add_setting("back_to_top_button_speed_code", array(
		"default" 				=> '1400',   
		'sanitize_callback' 	=> 'perfection_sanitize_select_bta_speed',
		"transport" 			=> "refresh",
	));

	// Font awesome back to top button
	$wp_customize->add_setting("back_to_top_button_fa", array(
		"default" 				=> 'fa-arrow-up', 
		'sanitize_callback' 	=> 'perfection_sanitize_text',  
		"transport" 			=> 'refresh',
	));

	// Control back to top button
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"back_to_top_button_code",
		array(
			"label" 		=> __("Back to top button", "perfection"),
			"section" 		=> "back_to_top",
			'capability' 	=> 'manage_options',
			"settings"		=> "back_to_top_button_code",
			"type" 			=> "checkbox",
		)
	));

	// Control back to top button color
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'back_to_top_button_color', 
		array(
			'label'			=> __( 'Button Color', 'perfection' ),
			'section'		=> 'back_to_top',
			'capability'	=> 'manage_options',
			'settings'		=> 'back_to_top_button_color',
		)
	));

	// Control back to top button color hover
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'back_to_top_button_color_hover', 
		array(
			'label'			=> __( 'Button hover Color', 'perfection' ),
			'section'		=> 'back_to_top',
			'capability'	=> 'manage_options',
			'settings' 		=> 'back_to_top_button_color_hover',
		)
	));

	// Control back to top button arrow color
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'back_to_top_arrow_color', 
		array(
			'label'			=> __( 'Icon Color', 'perfection' ),
			'section'		=> 'back_to_top',
			'capability' 	=> 'manage_options',
			'settings'   	=> 'back_to_top_arrow_color',
		)
	));

	// Control back to top button arrow color hover
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'back_to_top_arrow_color_hover', 
		array(
			'label'      => __( 'Button hover Icon color', 'perfection' ),
			'section'    => 'back_to_top',
			'capability' => 'manage_options',
			'settings'   => 'back_to_top_arrow_color_hover',
		)
	));

	// Control font awesome back to top
	$wp_customize->add_control(new TM_Customize_Iconpicker_Control(
		$wp_customize,
		"back_to_top_button_fa",
		array(
			"label" 		=> __("Back to top Font awesome", "perfection"),
			"section" 		=> "back_to_top",
			'capability'    => 'manage_options',
			"settings" 		=> "back_to_top_button_fa",
			"type" 			=> "text",
			"description" 	=> __('Click to select an Icon','perfection'),
		)
	));	

	// Control back to top speed
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"back_to_top_button_speed_code",
		array(
			"label" 		=> __("Back to top speed", "perfection"),
			"section" 		=> "back_to_top",
			'capability'    => 'manage_options',
			"settings" 		=> "back_to_top_button_speed_code",
			"type" 			=> "select",
			"choices" => array(
	            '1400' 	=> __('Slow','perfection'),
	            '1000' 	=> __('Medium','perfection'),
	            '600' 	=> __('Fast','perfection'),
				),
		)
	));

	// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-// -=-=-=-=-=-=-=-=-=-

	// Section Breadcrumbs
	$wp_customize->add_section("breadcrumbs", array(
		"title" 	=> __("Breadcrumbs", "perfection"),
		"priority" 	=> 31,
		"panel" 	=> 'theme_options_perfection'
	));

	// Setting breadcrumbs activate
	$wp_customize->add_setting("breadcrumbs_code", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_checkbox',
		"transport" 			=> 'refresh',
	));

	// Setting breadcrumbs separator
	$wp_customize->add_setting("breadcrumbs_separator", array(
		"default" 				=> "",
		'sanitize_callback' 	=> 'perfection_sanitize_text',
		"transport" 			=> $transport,
	));

	// Control breadcrumbs activate
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"breadcrumbs_code",
		array(
			"label" 		=> __("Activate breadcrumbs", "perfection"),
			"section"		=> "breadcrumbs",
			'capability'    => 'manage_options',
			"settings" 		=> "breadcrumbs_code",
			"type" 			=> "checkbox",
		)
	));

	// Control breadcrumbs separator
	$wp_customize->add_control(new WP_Customize_Control(
		$wp_customize,
		"breadcrumbs_separator",
		array(
			"label" 		=> __("breadcrumbs separator", "perfection"),
			"section" 		=> "breadcrumbs",
			'capability'    => 'manage_options',
			"settings" 		=> "breadcrumbs_separator",
			"type" 			=> "text",
		)
	));

	$terms = get_terms( array(

		'orderby'		=> 'name', 
	    'order'			=> 'ASC',
	    'hide_empty'    => true, 
	    'exclude'       => array('1','2'), 

		));
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		foreach ( $terms as $term ) {

			// Setting redirect test
			$wp_customize->add_setting("redirect_tax_".$term->term_id, array(
				"default" 				=> "none",
				'sanitize_callback' 	=> 'perfection_sanitize_select_page_archive',
				"transport" 			=> "none",
			));

			// Control redirect terms
			$wp_customize->add_control(new WP_Customize_Control(
				$wp_customize,
				"redirect_tax_".$term->term_id,
				array(
					"label" 		=> $term->name,
					"section" 		=> "breadcrumbs",
					'capability'	=> 'manage_options',
					"settings" 		=> "redirect_tax_".$term->term_id,
					"type" 			=> "select",
					"choices" 		=> perfection_pages_setting_value(),
					"description" 	=> 'Redirect taxonomy archive',
				)
			));
		}
	}
}
add_action("customize_register","perfection_customize_register");

function refresh( WP_Customize_Manager $wp_customize ) {
	
	if ( ! isset( $wp_customize->selective_refresh ) ) return;

	// Partial Breadcrumbs separator
	$wp_customize->selective_refresh->add_partial( 'breadcrumbs_separator', array(
		'selector' => '.perfection-breadcrumbs span',
		'fallback_refresh' => false,
		'settings' => array( 'breadcrumbs_separator' ),
		'render_callback' => function() {
			return get_theme_mod('breadcrumbs_separator');
		}
	) );

	// Partial Blog next page
	$wp_customize->selective_refresh->add_partial( 'blog_next_page', array(
		'selector' => '.pagination .nav-next a',
		'fallback_refresh' => false,
		'settings' => array( 'blog_next_page' ),
		'render_callback' => function() {
			return get_theme_mod('blog_next_page');
		}
	) );	

	// Partial Blog previous page
	$wp_customize->selective_refresh->add_partial( 'blog_previous_page', array(
		'selector' => '.pagination .nav-previous a',
		'fallback_refresh' => false,
		'settings' => array( 'blog_previous_page' ),
		'render_callback' => function() {
			return get_theme_mod('blog_previous_page');
		}
	) );

}
add_action( 'customize_register', 'refresh' );


if ( class_exists( 'WP_Customize_Control' ) ) {
	class TM_Customize_Iconpicker_Control extends WP_Customize_Control {
		/**
		* Render the control's content.
		*/
		public function render_content() { ?>
			<label>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<span class="description customize-control-description"><?php echo __('Click to select an Icon','perfection'); ?></span>
				<div class="input-group icp-container">
					<input data-placement="bottomRight" class="icp icp-auto" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" type="text">
					<span class="input-group-addon"></span>
				</div>
			</label>
		<?php }

		/**
		* Enqueue required scripts and styles.
		*/
		public function enqueue() {
			wp_enqueue_script( 'tm-fontawesome-iconpicker', get_template_directory_uri() . '/theme-settings/icon-picker/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_script( 'tm-iconpicker-control', get_template_directory_uri() . '/theme-settings/icon-picker/iconpicker-control.js', array( 'jquery' ), '1.0.0', true );
			wp_enqueue_style( 'tm-fontawesome-iconpicker', get_template_directory_uri() . '/theme-settings/icon-picker/fontawesome-iconpicker.min.css' );
			wp_enqueue_style( 'tm-fontawesome', get_template_directory_uri() . '/theme-settings/icon-picker/font-awesome.min.css' );
		}
	}
}


/**
 * Sanitizing Fields
 * 
 * @since perfection 0.3
 *
 */
function perfection_sanitize_text( $str ) {
    return sanitize_text_field( $str );
} 

function perfection_sanitize_number( $int ) {
    return absint( $int );
} 

function perfection_sanitize_email( $email ) {
    if(is_email( $email )){
        return $email;
    }else{
        return '';
    }
} 

function perfection_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function perfection_sanitize_file_url( $url ) {
    $output = '';
    $filetype = wp_check_filetype( $url );
    if ( $filetype["ext"] ) {
        $output = esc_url( $url );
    }
    return $output;
}

function perfection_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function perfection_sanitize_select_header_template( $input ) {
	$valid = array(
		'default' => 'default',
		'empty' => 'empty',
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function perfection_sanitize_select_bta_speed( $input ) {
	$valid = array(
		'1400' => 'Slow',
		'1000' => 'Medium',
		'600' => 'Fast',
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

function perfection_sanitize_select_singlepost_metaslider( $input ) {

	$args = array(
        'post_type' => 'ml-slider',
        'post_status' => 'publish',
        'suppress_filters' => 1, // wpml, ignore language filter
        'order' => 'ASC',
        'posts_per_page' => -1
	);
	$results = array();

	$results['none'] = __('None','perfection');

	$loop = new WP_Query( $args );
	if($loop->have_posts()):  
		while ( $loop->have_posts() ) : $loop->the_post();
			$results[get_the_ID()] = get_the_title();
		endwhile;
	endif;
	

	if ( array_key_exists( $input, $results ) ) {
        return $input;
    } else {
        return '';
    }
}

function perfection_sanitize_select_page_archive($input){

	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'hierarchical' => 1,
	); 

	$results = array();

	$results['none'] = __('None','perfection');

	$the_query = new WP_Query( $args ); 

	// If there are pages, let's loop
	if($the_query->have_posts()):  
		while($the_query->have_posts()):
			$the_query->the_post(); 
				$results[get_the_permalink()] = get_the_title();
		endwhile; 
	endif;

	if ( array_key_exists( $input, $results ) ) {
		return $input;
	} else {
		return '';
	}

	return $results;
}

?>
