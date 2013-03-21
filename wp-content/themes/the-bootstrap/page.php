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

<div id="primary" class="span8">
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();
		
		the_post();
		get_template_part( '/partials/content', 'page' );

		tha_content_bottom(); ?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</div><!-- #primary -->
<?php if(is_page(9)){ ?> <!--sidebar pour la page about us-->
<?php get_sidebar('about'); }else{ /*sidebar pour toutes les autres pages */
	get_sidebar();
}
get_footer();


/* End of file page.php */
/* Location: ./wp-content/themes/the-bootstrap/page.php */