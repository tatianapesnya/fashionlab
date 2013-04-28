<?php
/** category.php
 *
 * The template for displaying Category Archive pages.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>

<div class="container">
<div id="page" class="container">
<section id="primary" class="span8 category">
		<header class="page-header">
				<h1 class="page-title">
					<div class="category-shadow">
					<?php /*Taxonomy Images*/
						print apply_filters( 'taxonomy-images-queried-term-image', '', array(
					    'after' => '</div>',
					    'attr' => array(
					        'alt'   => 'Custom alternative text',
					        'class' => '',
					        'title' => '',
					        ),
					    'before' => '<div id="my-custom-div">',
					    'image_size' => '621,184',
					    ) ); 
					    printf('<span>' . single_cat_title( '', false ) . '</span>' );
					    ?>
				</div><!--category-shadow-->
				</h1>
	
				<?php if ( $category_description = category_description() ) {
					echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
				} ?>
			</header><!-- .page-header -->
	<?php tha_content_before(); ?>
		<?php tha_content_top();
if (have_posts()) {  
       while ( have_posts() ) {
				the_post();
				if (has_post_format('aside')){?>
			<div class="row-fluid span4 post_aside"> 
				<?php get_template_part( '/partials/content',  get_post_format() );?>
			</div><!--post_aside-->
			<?php }elseif(has_post_format('video')) { ?>
			<div class="span8 post_chat">
				<?php get_template_part( '/partials/content',  get_post_format() ); ?>
			</div>
			<?php } elseif(has_post_format('chat')){?>
				<div class="span8 post_chat"> 
					<?php get_template_part( '/partials/content', get_post_format() );?>
				</div><!--post_chat-->
			<?php }
			else{ ?>
			<div class="row-fluid span4 post_aside"> 
				<?php get_template_part( '/partials/content', get_post_format() ); ?>
			</div>
			<?php } 
	}
}
		tha_content_bottom(); ?>

	<?php tha_content_after(); ?>
</section><!-- #primary -->

<?php 
	get_sidebar();
?>
</div><!-- #page -->
</div><!-- .container -->
<?php get_footer();


/* End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/category.php */