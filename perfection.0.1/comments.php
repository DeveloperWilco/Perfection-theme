 <div class="navigation">
  <?php paginate_comments_links(); ?> 
 </div>
 
 <ol class="commentlist">
  <?php wp_list_comments(); ?>
 </ol>
 
 <div class="navigation">
  <?php paginate_comments_links(); ?> 
 </div>
 
 <?php comments_template(); ?> 

  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>