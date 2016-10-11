<?php

// Modify Read more link
function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">Your Read More Link Text</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


function perfection_back_to_top(){

	$perfection_theme_settings = get_option('perfection_settings');

	if(isset($perfection_theme_settings['perfection_back_to_top_active'])){
		add_action('wp_footer', 'perfection_back_to_top_script'); 

	}
}

function perfection_back_to_top_script(){

	?>

	<script type='text/javascript'>

	jQuery('body').prepend('<a href="#" class="back-to-top">Back to Top</a>');

	var amountScrolled = 300;

	jQuery(window).scroll(function() {
		if ( jQuery(window).scrollTop() > amountScrolled ) {
			jQuery('a.back-to-top').fadeIn('slow');
		} else {
			jQuery('a.back-to-top').fadeOut('slow');
		}
	});

	jQuery('a.back-to-top').click(function() {
		jQuery('html, body').animate({
			scrollTop: 0
		}, 700);
		return false;
	});

	</script>

	<?php
}


// Make menu sticky
function perfection_sticky_menu(){

	$perfection_theme_settings = get_option('perfection_settings');

	if(isset($perfection_theme_settings['perfection_checkbox_stickymenu_activate'])){
		add_action('wp_footer', 'perfection_sticky_menu_script'); 
	}
}

// Sticky menu script
function perfection_sticky_menu_script(){

	?><script type='text/javascript'> 

	jQuery('#header').addClass('perfection-sticky');

	jQuery(window).scroll(function(){
		var sticky = jQuery('.perfection-sticky'),
		scroll = jQuery(window).scrollTop();
		if (scroll >= 100) sticky.addClass('perfection-fixed');
		else sticky.removeClass('perfection-fixed');
	});

	</script><?php

	$perfection_theme_settings = get_option('perfection_settings');

	if(isset($perfection_theme_settings['perfection_checkbox_stickymenu_automargin'])){
		
	?>

	<script type='text/javascript'>

	jQuery( document ).ready(function() {

		var am = jQuery('#header').outerHeight();

		jQuery("#header + #main-slider, #header + .video-slider").css("margin-top", am);

	});
  	

	jQuery( window ).scroll(function(){

		var am = jQuery('#header').outerHeight();

		jQuery("#header + #main-slider, #header + .video-slider").css("margin-top", am);
		
	});

	</script>

	<?php

	}
}



/**
 *	Breadcrumbs
 *
 *	@package	Perfection 	
 *	@since 		Perfection 0.1
 *	@license	GPL 2.0
 */
function perfection_breadcrumbs(){

	$perfection_theme_settings = get_option('perfection_settings'); 

	if(isset($perfection_theme_settings['perfection_checkbox_breadcrumbs_activate'])){

	echo '<div class="perfection-breadcrumbs">';
	echo '<div class="limit-perfection">';

	if(isset($perfection_theme_settings['perfection_text_breadcrumbs_separator']) && !empty($perfection_theme_settings['perfection_text_breadcrumbs_separator'])){

		$slash = ' '. $perfection_theme_settings['perfection_text_breadcrumbs_separator']. ' ';

	}
	else{

		$slash = ' / ';

	}

	global $post;

		// Home

		if(!is_front_page()){

			echo '<a href="' .home_url(). '"> Home </a>';
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
			}
			elseif(is_single()){

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

				// $title = get_the_archive_title();
				// echo $title;

				$categories = get_the_category();

				if ( ! empty( $categories ) ) {
				    echo esc_html( $categories[0]->name );
				}
			}elseif(is_archive() && is_tag()){

				echo single_tag_title(); 
			}
			elseif(is_search()){
				
				echo 'search';
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