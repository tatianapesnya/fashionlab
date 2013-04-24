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
					<?php if (is_category('innovation')){
						printf('<div class="innovation"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('digital')){
						printf('<div class="digital"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('luxury')){
						printf('<div class="luxury"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('haute-couture')){
						printf('<div class="haute-couture"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('store-corner')){
						printf('<div class="store-corner"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('fast-fashion')){
						printf('<div class="fast-fashion"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('footwear-2')){
						printf('<div class="footwear"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('watches')){
						printf('<div class="watches"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('ready-to-wear')){
						printf('<div class="ready-to-wear"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}
					elseif (is_category('apparel-2')){
						printf('<div class="apparel"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}
					elseif (is_category('bags')){
						printf('<div class="bags"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}elseif (is_category('trends')){
						printf('<div class="trends"><span>' . single_cat_title( '', false ) . '</span></div>' );
					}else{
					printf('<span>' . single_cat_title( '', false ) . '</span>' );
					}?>
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
			<div class="span8 post_chat"> 
				<?php get_template_part( '/partials/content', 'not-found' ); ?>
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