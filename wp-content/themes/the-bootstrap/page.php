<?php
/** page.php
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author		Pesnya Tatiana
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<div class="container">
<div id="page" class="container">
<section id="primary" class="span8 single">	<?php tha_content_before(); ?>
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );

		tha_content_bottom(); ?>

	<?php tha_content_after(); ?>
</section><!-- #primary -->
<?php if(is_page(9)){  //sidebar pour la page about us
	get_sidebar('about');}
		elseif (is_page(10) || is_page(59)){
			(!dynamic_sidebar());}
			else{ /*sidebar pour toutes les autres pages */
	get_sidebar();
}?>
</div><!-- #page -->
</div><!-- .container -->
<?php get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */