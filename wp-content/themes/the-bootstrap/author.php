<?php
/** author.php
 *
 * The template for displaying Author Archive pages.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */

get_header(); ?>

<div class="container">
<div id="page" class="container">
<section id="primary" class="span8">
	<div id="content" role="main">
		<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Author Archives: %s','theme-text-domain', 'the-bootstrap' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
		</header><!-- .page-header -->
		<?php tha_content_before(); ?>
		<?php tha_content_top();
		
		if ( have_posts() ) :
	 
		
			rewind_posts();
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div id="author-info" class="row">
				<h2 class="span8"><?php printf( __( 'About %s', 'theme-text-domain','the-bootstrap' ), get_the_author() ); ?></h2>
				<div id="author-avatar" class="span1">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'the-bootstrap_author_bio_avatar_size', 70 ) ); ?>
				</div><!-- #author-avatar -->
				<div id="author-description" class="span7">
					<?php the_author_meta( 'description' ); ?>
				</div><!-- #author-description	-->
			</div><!-- #author-info -->
			<?php endif;
			
			while ( have_posts() ) {
				the_post();
				if (has_post_format('aside')){?>
			<div class="span4 post_aside"> 
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
		endif; ?>
		
		<?php tha_content_bottom(); ?>
	<?php tha_content_after(); ?>
</section><!-- #primary -->
<?php get_sidebar(); ?>
</div><!--main-->
</div><!-- #page -->
</div><!-- .container -->
<?php get_footer();


/* End of file author.php */
/* Location: ./wp-content/themes/the-bootstrap/author.php */