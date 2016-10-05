<?php


function modify_read_more_link() {
    return '<a class="more-link" href="' . get_permalink() . '">Your Read More Link Text</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );


function perfection_breadcrumbs(){

	echo '<div class="perfection-breadcrumbs">';
		echo '<div class="limit-perfection">';

		global $post;
		$slash = ' / ';

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
			elseif(is_archive()){

				// $title = get_the_archive_title();
				// echo $title;

				$categories = get_the_category();

				if ( ! empty( $categories ) ) {
				    echo esc_html( $categories[0]->name );
				}
			}
			elseif(is_search()){
				
				echo 'im search page';
			}
		}

		echo '</div>';
	echo '</div>';
}

?>