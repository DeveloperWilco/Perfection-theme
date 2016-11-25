 
<?php wp_list_comments("callback=mytheme_comment"); ?>

 
<div class='comments'>
	<?php comment_form(); ?>
</div> 


   <?php
if ( is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
?>

<div class="navigation">
<?php paginate_comments_links(); ?> 
</div>