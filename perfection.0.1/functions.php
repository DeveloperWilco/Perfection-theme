<?php


include get_template_directory() . '/theme-settings/settings.php';

// Add theme support 
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

function perfection_custom_logo_customizer() {
	
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}


/**
 * Detect plugin. For use in Admin area only.
 */

function perfection_check_form_maker_active() {
  if ( is_plugin_active('/wp-content/plugins/form-maker/form-maker.php') ) {

	wp_enqueue_style( 'form-maker', get_template_directory_uri(). '/css/form-maker.css', false);
	add_action( 'wp_enqueue_scripts', 'perfection_check_form_maker_active' );
    
  }
}
add_action( 'admin_init', 'perfection_check_form_maker_active' );


function perfection_check_meta_slider_active() {
  if ( is_plugin_active('/wp-content/plugins/ml-slider/ml-slider.php') ) {

	wp_enqueue_style( 'meta-slider', get_template_directory_uri(). '/css/meta-slider.css', false);
	add_action( 'wp_enqueue_scripts', 'perfection_check_meta_slider_active' );
    
  }
}
add_action( 'admin_init', 'perfection_check_meta_slider_active' );



/**
 * Detect plugin. For use on Front End only.
 */

function perfection_video_slider() {

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if(is_plugin_active( 'video-background/candide-vidbg.php')){

		add_action('wp_footer', 'add_this_script_footer'); 
		echo '<div class="video-slider">';
		echo '<div class="perfection-video-slider" style="float:left; width:100%; height:650px;">';
		echo '</div>';
		echo '</div>';


	} 
}

function add_this_script_footer(){ ?>

	<script type="text/javascript">

			jQuery(document).ready(function () {
	    		jQuery('video').attr('loop','loop');
	    	});



    	</script>

<?php } 


/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

/**
 * Register menu
 *
 */
function perfection_register_menu() {
  register_nav_menu('header-menu',__( 'Header Menu(primary)', 'perfection' ));
}
add_action( 'init', 'perfection_register_menu' );

//enqueues our locally supplied font awesome stylesheet
function enqueue_our_required_stylesheets(){
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');

/**
 * Enqueue styles
 *
 */
function perfection_enqueue_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), false ); 
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css'); 
	wp_enqueue_style( 'default', get_template_directory_uri(). '/css/default.css', false);
}
add_action( 'wp_enqueue_scripts', 'perfection_enqueue_style' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function perfection_custom_widget_init() {

	register_sidebar( array(
		'name'          => 'Header',
		'id'            => 'perfection_header_widget_location',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'perfection_footer_widget_location',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'perfection_custom_widget_init' );

/**
 * Settings page stuff
 *
 */

get_template_part('theme-settings/theme-settings','theme-settings');


function perfection_add_theme_menu_item()
{
	add_theme_page("Thema-instellingen", "Thema-instellingen", "manage_options", "perfection-theme-settings", "perfection_theme_settings_page", null, 99);
}

add_action("admin_menu", "perfection_add_theme_menu_item");


if ( ! isset( $content_width ) ) $content_width = 900;

/**
 * Add some plugins to TGM plugin activation
 */
function perfection_recommended_plugins(){
	$plugins = array(
		array(
			'name'      => __('SiteOrigin Page Builder', 'perfection'),
			'slug'      => 'siteorigin-panels',
			'required'  => false,
		),
		array(
			'name'      => __('SiteOrigin Widgets Bundle', 'perfection'),
			'slug'      => 'so-widgets-bundle',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'tgmpa-perfection',      // Unique ID for hashing notices for multiple instances of TGMPA.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'perfection_recommended_plugins' );


/**
 * Slider stuff
 *
 */
if( !function_exists('perfection_render_slider') ) :
/**
 * Render the slider.
 */
function perfection_render_slider(){

	if( is_front_page() && !in_array( 'home_slider', array( '', 'none' ) ) ) {
		$settings_slider = 'home_slider';
		$slider_stretch = 'home_slider_stretch';

		if(!empty($settings_slider)) {
			$slider = $settings_slider;
		}
	}
	$page_id = get_the_ID();
	if( ( is_page() ) && get_post_meta($page_id, 'perfection_metaslider_slider', true) != 'none' ) {
		$page_slider = get_post_meta($page_id, 'perfection_metaslider_slider', true);
		if( !empty($page_slider) ) {
			$slider = $page_slider;
		}
		$slider_stretch = get_post_meta($page_id, 'perfection_metaslider_slider_stretch', true);
		if( $slider_stretch === '' ) {
			// We'll default to whatever the home page slider stretch setting is
			$slider_stretch = 'home_slider_stretch';
		}
	}

	if( empty($slider) ) return;

	global $perfection_is_main_slider;
	$perfection_is_main_slider = true;

	?><div id="main-slider" <?php if( $slider_stretch ) echo 'data-stretch="true"' ?>><?php


	if($slider == 'demo') get_template_part('slider/demo');
	elseif( substr($slider, 0, 5) == 'meta:' ) {
		list($null, $slider_id) = explode(':', $slider);

		echo do_shortcode( "[metaslider id=" . intval($slider_id) . "]" );
	}

	?></div><?php
	$perfection_is_main_slider = false;
}
endif;

if( !function_exists('siteorigin_metaslider_get_options') ) :
function siteorigin_metaslider_get_options($has_demo = true){
	$options = array( '' => __('None', 'perfection') );

	if($has_demo) $options['demo'] = __('Demo Slider', 'perfection');

	if(class_exists('MetaSliderPlugin')){
		$sliders = get_posts(array(
			'post_type' => 'ml-slider',
			'numberposts' => 200,

		));

		foreach($sliders as $slider) {
			$options[ 'meta:' . $slider->ID ] = __('Slider: ', 'perfection') . $slider->post_title;
		}
	}

	return $options;
}
endif;

if( !function_exists('perfection_metaslider_themes') ) :
function perfection_metaslider_themes($themes, $current){
	$themes .= "<option value='perfection' class='option flex' ".selected('perfection', $current, false).">".__('Perfection (Flex)', 'perfection')."</option>";
	return $themes;
}
endif;
add_filter('metaslider_get_available_themes', 'perfection_metaslider_themes', 5, 2);

if( !function_exists('perfection_metaslider_filter_flex_slide') ) :
/**
 * Change the HTML for the home page slider.
 *
 * @param $html
 * @param $slide
 * @param $settings
 *
 * @return string The new HTML
 */
function perfection_metaslider_filter_flex_slide($html, $slide, $settings){
	if( is_admin() && !empty($GLOBALS['perfection_is_main_slider']) ) return $html;

	if(!empty($slide['caption']) && function_exists('filter_var') && filter_var($slide['caption'], FILTER_VALIDATE_URL) !== false) {

		$settings['height'] = round( $settings['height'] / 1080 * $settings['width'] );
		$settings['width'] = 1080;

		$html = sprintf("<img src='%s' class='ms-default-image' width='%d' height='%d' />", $slide['thumb'], intval($settings['width']), intval($settings['height']));

		if (strlen($slide['url'])) {
			$html = '<a href="' . esc_url( $slide['url'] ) . '" target="' . esc_attr( $slide['target'] ) . '">' . $html . '</a>';
		}

		$caption = '<div class="content">';
		if (strlen($slide['url'])) $caption .= '<a href="' . $slide['url'] . '" target="' . $slide['target'] . '">';
		$caption .= sprintf('<img src="%s" width="%d" height="%d" />', esc_url($slide['caption']), intval($settings['width']), intval($settings['height']));
		if (strlen($slide['url'])) $caption .= '</a>';
		$caption .= '</div>';

		$html = $caption . $html;

		$thumb = isset($slide['data-thumb']) && strlen($slide['data-thumb']) ? " data-thumb=\"{$slide['data-thumb']}\"" : "";

		$html = '<li style="display: none;"' . $thumb . ' class="perfection-slide-with-image">' . $html . '</li>';
	}

	return $html;
}
endif;
add_filter('metaslider_image_flex_slider_markup', 'perfection_metaslider_filter_flex_slide', 10, 3);


if( !function_exists('perfection_metaslider_page_setting_metabox') ) :
function perfection_metaslider_page_setting_metabox(){
	add_meta_box('perfection-metaslider-page-slider', __('Page Meta Slider', 'perfection'), 'perfection_metaslider_page_setting_metabox_render', 'page', 'side');
}
endif;
add_action('add_meta_boxes', 'perfection_metaslider_page_setting_metabox');

if( !function_exists('perfection_metaslider_page_setting_metabox_render') ) :
function perfection_metaslider_page_setting_metabox_render($post){
	$metaslider = get_post_meta($post->ID, 'perfection_metaslider_slider', true);

	$is_home = $post->ID == get_option( 'page_on_front' );
	// If we're on the home page and the user hasn't explicitly set something here use the 'home_slider' theme setting.
	if ( $is_home && empty( $metaslider ) ) {
		$metaslider = 'home_slider';
	}
	// Default stretch setting to theme setting.
	$metaslider_stretch = 'home_slider_stretch';
	//Include the demo slider in the options if it's the home page.
	$options = siteorigin_metaslider_get_options($is_home);
	if ( metadata_exists( 'post', $post->ID, 'perfection_metaslider_slider_stretch' ) ) {
		$metaslider_stretch = get_post_meta($post->ID, 'perfection_metaslider_slider_stretch', true);
	}

	?>
	<label><strong><?php _e('Display Page Meta Slider', 'perfection') ?></strong></label>
	<p>
		<select name="perfection_page_metaslider">
			<?php foreach($options as $id => $name) : ?>
				<option value="<?php echo esc_attr($id) ?>" <?php selected($metaslider, $id) ?>><?php echo esc_html($name) ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p class="checkbox-wrapper">
		<input id="perfection_page_metaslider_stretch" name="perfection_page_metaslider_stretch" type="checkbox" <?php checked( $metaslider_stretch ) ?> />
		<label for="perfection_page_metaslider_stretch"><?php _e('Stretch Page Meta Slider', 'perfection') ?></label>
	</p>
	<?php
	wp_nonce_field('save', '_perfection_metaslider_nonce');
}
endif;

if( !function_exists('perfection_metaslider_page_setting_save') ) :
function perfection_metaslider_page_setting_save($post_id){
	if( empty($_POST['_perfection_metaslider_nonce']) || !wp_verify_nonce($_POST['_perfection_metaslider_nonce'], 'save') ) return;
	if( !current_user_can('edit_post', $post_id) ) return;
	if( defined('DOING_AJAX') ) return;

	update_post_meta($post_id, 'perfection_metaslider_slider', $_POST['perfection_page_metaslider']);
	$slider_stretch = !empty( $_POST['perfection_page_metaslider_stretch'] );
	update_post_meta($post_id, 'perfection_metaslider_slider_stretch', $slider_stretch );
	// If we're on the home page update the 'home_slider' theme setting as well.

}
endif;
add_action('save_post', 'perfection_metaslider_page_setting_save');

?>