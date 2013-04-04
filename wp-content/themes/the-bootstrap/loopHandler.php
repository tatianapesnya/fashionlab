<?php
// Our include  
define('WP_USE_THEMES', false);  
require_once('../../../wp-load.php');  

// Our variables  
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;  
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;  
  
query_posts(array(  
       'posts_per_page' => $numPosts,  
       'paged'          => $page  
));
if (have_posts()) {  
       while (have_posts()){  
              the_post();  
             if (has_post_format('aside')){?>
			<div class="span4 post_aside"> 
				<?php get_template_part( '/partials/content', get_post_format() );?>
			</div><!--post_aside-->
			<?php }elseif (has_post_format('video')) { ?>
			<div class="span8 post_chat">
				<?php get_template_part( '/partials/content', get_post_format() ); ?>
			</div>
			<?php } elseif(has_post_format('chat')){?>
				<div class="span8 post_chat"> 
					<?php get_template_part( '/partials/content', get_post_format() );?>
				</div><!--post_chat-->
			<?php }elseif (has_post_format('gallery')){ ?>
				<div class="span8 post_chat">
				<?php  get_template_part( '/partials/content', get_post_format() ); ?>
			</div>
			<?php }elseif (has_post_format('standard')){ ?>
				<div class="span4 post_aside">
				<?php  get_template_part( '/partials/content', get_post_format() ); ?>
				</div>
			<?php }
			else{
				get_template_part( '/partials/content', 'not-found' );
			}
       }  
}  
wp_reset_query();  ?>
			




			<?php /*$args = array( 'numberposts' => $numPosts, 'order'=> 'DESC');
			$postslist = get_posts( $args );
			foreach ($postslist as $post) :  setup_postdata($post); ?>
			<?php if (has_post_format('aside')){?>
			<div class="span4 post_aside"> 
				<?php get_template_part( '/partials/content', get_post_format() );?>
			</div><!--post_aside-->
			<?php }elseif (has_post_format('video')) { ?>
			<div>
				<?php get_template_part( '/partials/content', get_post_format() ); ?>
			</div>
			<?php } elseif(has_post_format('chat')){?>
				<div class="span7 post_chat"> 
				<?php get_template_part( '/partials/content', get_post_format() );?>
			</div><!--post_chat-->
			<?php }elseif (has_post_format('gallery')){
				 get_template_part( '/partials/content', get_post_format() );
			}
			else{
				get_template_part( '/partials/content', 'not-found' );
			}*/ ?>
<?php //endforeach; ?>
