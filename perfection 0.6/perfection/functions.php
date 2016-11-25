<?php

/**
 * Functions for Perfection
 *
 * @package perfection	
 * @since Perfection 0.1
 * @license GPL 2.0
 */

include get_template_directory() . '/theme-settings/customizer.php';
include get_template_directory() . '/theme-settings/customizer-settings.php';

require_once get_template_directory() . '/theme-settings/class-tgm-plugin-activation.php';



// Add theme support 
add_theme_support( 'custom-logo' );
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
if ( ! isset( $content_width ) ) $content_width = 900;

/**
 * Registers an editor stylesheet for the theme.
 */
function wpdocs_theme_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );

function perfection_custom_logo_customizer() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

add_action( 'after_setup_theme', 'perfection_after_setup_theme' );
function perfection_after_setup_theme(){
    load_theme_textdomain( 'perfection', get_template_directory() . '/languages' );
}

function perfection_video_slider() {
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if(is_plugin_active( 'video-background/candide-vidbg.php')){

		echo '<div class="video-slider">';
		echo '<div class="perfection-video-slider">';
		echo '</div>';
		echo '</div>';

		add_action('wp_footer', 'perfection_video_slider_script'); 
	} 
}

function perfection_video_slider_script(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function () {
	    	jQuery('video').attr('loop','loop');
	    	if ( jQuery( ".perfection-video-slider .vidbg-container" ).length ) {
	    		jQuery('.perfection-video-slider').css('height','550px');
	    	}
    	});
	</script><?php 
} 

/**
 * Register menu
 *
 */
function perfection_register_menu() {
	register_nav_menu('header-menu',__( 'Header Menu(primary)', 'perfection' ));
}
add_action( 'init', 'perfection_register_menu' );

/**
 * Enqueue styles
 *
 */
function perfection_enqueue_style() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), false ); 
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', false); 
	wp_enqueue_style( 'standard', get_template_directory_uri(). '/css/standard.css', false);
	wp_enqueue_style( 'meta-slider', get_template_directory_uri(). '/css/meta-slider.css', false);
	wp_enqueue_style( 'form-maker', get_template_directory_uri(). '/css/form-maker.css', false);
 	wp_enqueue_script('jquery');
 	wp_enqueue_script( 'metaslider', get_template_directory_uri(). '/js/metaslider.js', false);
 	wp_enqueue_script( 'theme', get_template_directory_uri(). '/js/theme.js', false);

}
add_action( 'wp_enqueue_scripts', 'perfection_enqueue_style' );

// Custom comments
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' : ?>
            <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
            <div class="back-link">< ?php comment_author_link(); ?></div>
        <?php break;
        default : ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        	<article <?php comment_class(); ?> class="comment">
				<div class="comment-body">
	       			<div class="author vcard">
						<div class="author-avatar"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_avatar( $comment, 100 ); ?></a></div>
						<div class='author-name'><?php comment_author(); ?></div>
						<div class='date'><?php comment_date(); ?></div>
						<div class='comment-text'><?php comment_text(); ?></div>
	            	</div><!-- author -->
				</div><!-- comment-body -->
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 
							'reply_text' => __('Reply', 'perfection'),
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
		            ) ) ); ?>
				</div><!-- .reply -->
            </article>
        <?php
        break;
    endswitch;
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function perfection_custom_widget_init() {

	register_sidebar( array(
		'name'          => 'Header',
		'id'            => 'perfection_header_widget_location',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'perfection_footer_widget_location',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'perfection_custom_widget_init' );

/**
 * a call to all functions in the header
 * 
 * @since Perfection 0.4
 */
function perfection_header(){
	if (function_exists('perfection_back_to_top')) perfection_back_to_top(); ?>
	<header <?php if( get_theme_mod('sticky_menu_code')){ echo "class='perfection-sticky'";}?>>
		<div class='limit-perfection'>
			<?php if (function_exists('perfection_header_template_show')) perfection_header_template_show(); ?>
		</div>
	</header>
	<?php
	if (function_exists('perfection_render_slider')) perfection_render_slider();
	if (function_exists('perfection_video_slider')) perfection_video_slider(); 
	if (function_exists('perfection_singlepost_metaslider')) perfection_singlepost_metaslider(); 
	if (function_exists('perfection_breadcrumbs')) perfection_breadcrumbs(); 
	if (function_exists('perfection_sticky_menu')) perfection_sticky_menu(); 
}


/**
 * Render slider by Vantage
 * https://nl.wordpress.org/themes/vantage/
 * 
 * @since perfection 0.4
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
	if ( $is_home && empty( $metaslider ) ) {
		$metaslider = 'home_slider';
	}
	$metaslider_stretch = 'home_slider_stretch';
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
}
endif;
add_action('save_post', 'perfection_metaslider_page_setting_save');


function perfection_recommended_plugins(){
	$plugins = array(

		array(
			'name'		=> 'Meta Slider',
			'slug'		=> 'ml-slider',
			'required'	=> true,
		)
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


?>