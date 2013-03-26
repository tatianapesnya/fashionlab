<?php
/** index.php
 *
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author		Pesnya Tatiana
 */

get_header(); ?>
<div id="slider" class="container">
	<?php if ( function_exists( 'get_smooth_slider' ) ) { get_smooth_slider(); } ?>
</div>
<section id="primary" class="span8">
	<h1 class="offset3">Latest News</h1>
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();?>
		
		<?php
			$args = array( 'numberposts' => 8, 'order'=> 'DESC');
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
			} ?>
			<?php endforeach; ?>
	
		<?php tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php
get_sidebar();
get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */