<?php
/** search.php
 *
 * The template for displaying Search Results pages.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>
<div class="container">
<div id="page" class="container">
<section id="primary" class="span8 single">
	<?php tha_content_before(); ?>
		<?php tha_content_top();
		
		if ( have_posts() ) : ?>
	
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'the-bootstrap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
	
			<?php
			while ( have_posts() ) {
				the_post();
				             if (has_post_format('aside')){?>
			<div class="row-fluid span4 post_aside"> 
				<?php get_template_part( '/partials/content', get_post_format() );?>
			</div><!--post_aside-->
			<?php }elseif (has_post_format('video')) { ?>
			<div class="span4 post_chat">
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
			<?php }
			else{?>
				<div class="span4 post_aside">
				<?php  get_template_part( '/partials/content', get_post_format() ); ?>
				</div>
			<?php }
		}
		endif; 
	
		tha_content_bottom(); ?>
	<?php tha_content_after(); ?>
			</section>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer();


/* End of file search.php */
/* Location: ./wp-content/themes/the-bootstrap/search.php */