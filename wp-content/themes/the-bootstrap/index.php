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
<div id="slider">
	<?php echo do_shortcode( "[SlideDeck2 id=163 ress=1]" ); ?>
</div>
<div class="container">
<div id="page" class="container">
<section id="primary" class="span8">
	<h1 class="top-news">Latest News</h1>
	<?php tha_content_before(); ?>
	<div id="content" class="ajax" role="main">
		<?php tha_content_top();?>
		
		
	
		<?php tha_content_bottom(); ?>
		
	</div>
	<div class="load_more">
		<a href="#" id="loadmore"></a>
	</div>

	<?php tha_content_after(); ?>
	</section><!-- #primary -->
</section><!-- #primary -->
<?php get_sidebar(); ?>
</div><!-- #page -->
</div><!-- .container -->
<?php get_footer(); ?>


<!-- End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/index.php */ -->