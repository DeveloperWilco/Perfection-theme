<?php

// Customizer CSS
function perfection_customizer_css() { ?>
	<style type="text/css">
		.perfection-back-to-top{ 
			background: <?php echo get_theme_mod( 'back_to_top_button_color' ); ?>; 
			color: <?php echo get_theme_mod( 'back_to_top_arrow_color' ); ?>
		}
		.perfection-back-to-top:hover{
			background: <?php echo get_theme_mod( 'back_to_top_button_color_hover'); ?>;
			color: <?php echo get_theme_mod('back_to_top_arrow_color_hover'); ?>;
		}
		.icon-icon-box{
			background: <?php echo get_theme_mod( 'search_in_header_background', 'pink') ?>;
		}
		<?php if(get_theme_mod('logo_limit')){ ?>
		.logo img{
			max-height: 50px;
			max-width: 100%;
			height: auto;
			width: auto;
		}
		<?php } ?>

	</style>
<?php }
add_action( 'wp_head', 'perfection_customizer_css' );

/**
 * Adding styles to the Wordpress customizer
 */
function perfection_customizer_styles() { ?>
	<style>
		#customize-control-blog_next_page,#customize-control-blog_previous_page{
			width: 50%!important;
			clear: none!important;
		}
		#customize-control-blog_next_page input{
			width: calc(100% - 10px)!important;
		}
		#customize-control-blog_previous_page inpupt{
			width: calc(100% - 10px)!important;
			float: right!important;
		}
		#customize-control-singlepost_metaslider input{
			width: 60px!important;
			max-width: 100%!important;
		}
		#customize-control-breadcrumbs_separator input{
			width:50%!important;
			min-width: 40px!important;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'perfection_customizer_styles', 999 );

// Checkbox default styles
function perfection_enqueue_style_defaults(){

	if(get_theme_mod('default_styles',true)){

		wp_enqueue_style( 'default', get_template_directory_uri(). '/css/default.css', false);	
	}
}
add_action( 'wp_enqueue_scripts', 'perfection_enqueue_style_defaults' );


function perfection_search_in_menu(){

	if(get_theme_mod('search_in_header')){
	
		add_action('wp_footer', 'perfection_search_in_menu_script'); 
	}
}

function perfection_search_in_menu_script(){ ?>
<script type='text/javascript'>
	jQuery(document).ready(function(){
	    jQuery(".icon-icon-box").click(function(){
	        jQuery(".search-box").toggle();
	    });
	});
</script>
<?php } 

function perfection_search_in_menu_full(){

	if(get_theme_mod('search_in_header')){ ?>

	<div id="header-search">

	<?php if (function_exists('perfection_search_in_menu')) perfection_search_in_menu(); ?>
		<div class='icon-box'>
			<div class='icon-icon-box'>
				<i class="fa fa-search" aria-hidden="true"></i>
			</div>
			<div class='search-box' style='display:none;'>
				<?php get_search_form() ?>
			</div>
		</div>
	</div>

<?php } 
}

/**
 * back to top add to footer
 *
 * @since perfection 0.3
 * @package perfection 0.3
 */
function perfection_back_to_top(){

	if(get_theme_mod('back_to_top_button_code')){

		?>

		<a href="#" class="perfection-back-to-top"><i class="fa fa-fw <?php echo get_theme_mod("back_to_top_button_fa"); ?>" aria-hidden="true"></i></a>

		<?php add_action('wp_footer', 'perfection_back_to_top_script'); 
	}
}

function perfection_responsive_menu(){

	if(get_theme_mod('responsive_menu')){

	?>

	<div class='responsive-menu'>

<?php wp_nav_menu( array( 'theme_location' => get_theme_mod('responsive_menu_menu'), 'menu_class' => 'nav-menu' ) ); ?>;


	</div>


	<?php

		
	}

}

function perfection_get_menu(){

	return get_registered_nav_menus();
}

/**
 * back to top script
 *
 * @since perfection 0.3
 * @package perfection 0.3
 */
function perfection_back_to_top_script(){

	$speed = get_theme_mod("back_to_top_button_speed_code");

	?>

	<script type='text/javascript'>

	var speed = <?php echo $speed; ?>;
	var amountScrolled = 300;

	jQuery(window).scroll(function() {
		if ( jQuery(window).scrollTop() > amountScrolled ) {
			jQuery('.perfection-back-to-top').fadeIn('slow');
		} else {
			jQuery('.perfection-back-to-top').fadeOut('slow');
		}
	});

	jQuery('.perfection-back-to-top').click(function() {
		jQuery('html, body').animate({
			scrollTop: 0
		}, speed);
		return false;
	});

	</script>

	<?php
}

/**
 * Make menu sticky
 *
 * @since perfection 0.3
 * @package perfection 0.3
 */
function perfection_sticky_menu(){

	if(get_theme_mod('sticky_menu_code')){
	
		add_action('wp_footer', 'perfection_sticky_menu_script'); 
	}
}

/**
 * Sticky menu script
 *
 * @since perfection 0.3
 * @package perfection 0.3
 */
function perfection_sticky_menu_script(){

	?><script type='text/javascript'> 

	jQuery(window).scroll(function(){
		var sticky = jQuery('.perfection-sticky'),
		scroll = jQuery(window).scrollTop();
		if (scroll >= 100) sticky.addClass('perfection-fixed');
		else sticky.removeClass('perfection-fixed');
	});

	</script><?php

	if(get_theme_mod('sticky_menu_auto_margin_code')){
		
	?>

	<script type='text/javascript'>

	jQuery( document ).ready(function() {

		var am = jQuery('header').outerHeight(true);
		jQuery("header + div").css("margin-top", am-1); 
		//-1 to fix unrounded values
	});

	jQuery( window ).scroll(function(){

		var am = jQuery('header').outerHeight();
		jQuery("header + div").css("margin-top", am-1);
	});

	jQuery( window ).resize(function(){

		var am = jQuery('header').outerHeight();
		jQuery("header + div").css("margin-top", am-1);
	});

	jQuery( window ).on( "orientationchange", function( event ){

		var am = jQuery('header').outerHeight();
		jQuery("header + div").css("margin-top", am-1);
	});

	</script>



	<?php

	}
}

/**
 * get files to show in the select
 *
 * @since perfection 0.3
 * @package perfection 0.3
 */
function perfection_header_template_select(){

	$files = array(
		'default' => __('default','perfection'),
		'empty'   => __('empty','perfection')
		);

	return $files;
}


/**
 * get header template 
 *
 * @since perfection 0.3
 * @package perfection
 */
function perfection_header_template_show(){


	if(get_theme_mod('header_select_template')){

	$current_header_template = get_theme_mod('header_select_template');

	get_template_part( 'header-templates/header',$current_header_template);

	}else{

		get_template_part( 'header-templates/header', 'default');
	}
}

/**
 *
 *
 * @since perfection 0.5
 * @package perfection
 */
function perfection_metaslider_setting_values()
{

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
	
	return $results;
}


function perfection_pages_setting_value(){

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

	return $results;
}

function perfection_redirect_archive_pages(){

	$cur = get_queried_object()->term_id;

	$terms = get_terms( array(

			'exclude' => array('1','2'), 

		) );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
	   
		foreach ( $terms as $term ) { //Foreach term found

			$term_id = $term->term_id;

			if($cur == $term_id){ // If current term is term in foreach 

				if(!empty(get_theme_mod('redirect_tax_'.$term_id)) && get_theme_mod('redirect_tax_'.$term_id) != 'none'){

					wp_redirect( get_theme_mod('redirect_tax_'.$term_id) ); exit; 
				}
			}
		}
	}
}

// Read more link text
function perfection_read_more_link() {

    return '<a class="more-link" href="' . get_permalink() . '">' .get_theme_mod('blog_read_more'). '</a>';

}
add_filter( 'the_content_more_link', 'perfection_read_more_link' );

function perfection_pagination(){

	wp_link_pages();
	echo '<div class="pagination">';
	echo '<div class="nav-previous alignleft">' .get_previous_posts_link( get_theme_mod('blog_previous_page') ). '</div>';
	echo '<div class="nav-next alignright">' .get_next_posts_link( get_theme_mod('blog_next_page') ). '</div>';

	echo '</div>';
}


function perfection_singlepost_metaslider(){

	$spms = get_theme_mod('singlepost_metaslider');

	if(is_single() && $spms != 'none'){
		
		echo "<div id ='main-slider' data-stretch='true'>" . do_shortcode("[metaslider id=".get_theme_mod('singlepost_metaslider')."]") . "</div>";
	}
}

/**
 *	Breadcrumbs
 *
 *	@package	Perfection 	
 *	@since 		Perfection 0.2
 *	@license	GPL 2.0
 */
function perfection_breadcrumbs(){

	if(get_theme_mod('breadcrumbs_code')){

	echo '<div class="perfection-breadcrumbs">';
	echo '<div class="limit-perfection">';

	$slash_no_space = '<span>'.get_theme_mod("breadcrumbs_separator").'</span>';

	$slash = ' '. $slash_no_space .' ';

	global $post;

		// Home

		if(!is_front_page()){

			echo '<a href="' .home_url(). '"> Home</a>';
			echo $slash;
			
			if(is_page()){ 

				if($post->post_parent){

					$anc = get_post_ancestors( $post->ID );
					$anc_link = get_page_link( $post->post_parent );

					foreach ( $anc as $ancestor ) {

						$parent = "<a href=".$anc_link.">".get_the_title($ancestor)."</a>";

					}

		          	echo $parent;
		         	echo $slash;
					echo the_title();

				}else{

					echo the_title();

				}

			}elseif(is_single()){

			if(has_category()){ // Check on Category
					
				$categories = get_the_category();

				if ( ! empty( $categories ) ) {
				    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
				}

				echo $slash;
			}

			// single
				
			echo the_title();

			}
			elseif(is_archive() && !is_tag()){

				if(is_author()){

					echo get_the_author();

				}else{

				$categories = get_the_category();

					if ( ! empty( $categories ) ) {
					    echo esc_html( $categories[0]->name );
					}
				}

			}elseif(is_archive() && is_tag()){

				echo single_tag_title(); 
			}
			elseif(is_search()){
				
				echo __('search', 'perfection');
			}
			elseif(is_404()){

				echo '404';
			}
		}

		echo '</div>';
	echo '</div>';
}


}

?>