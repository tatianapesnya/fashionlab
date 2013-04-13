<?php
/** single.php
 *
 * The Template for displaying all single posts.
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 05.02.2012
 */

get_header(); ?>
<div class="container">
<div id="page" class="container">
<section id="primary" class="span8">
	
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();

		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', 'single' );
			comments_template();
		} ?>
		
		<nav id="nav-single" class="pager">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'theme-text-domain','the-bootstrap' ); ?></h3>
			<span class="next"><?php next_post_link( '%link', sprintf( '%1$s <span class="meta-nav">&rarr;</span>', __( 'Next Post','theme-text-domain', 'the-bootstrap' ) ) ); ?></span>
			<span class="previous"><?php previous_post_link( '%link', sprintf( '<span class="meta-nav">&larr;</span> %1$s', __( 'Previous Post','theme-text-domain', 'the-bootstrap' ) ) ); ?></span>
		</nav><!-- #nav-single -->
		
		<?php tha_content_bottom(); ?>
		<?php if(get_post_type() == 'stylist'){ ?>
			<div id="other-articles">
				<h2 class="entry-title"><?php _e('Other Stylists','theme-text-domain'); ?></h2>
				<?php
					$cat_ID=array();
					$args = array('post_type' => 'stylist','post__not_in' => array($post->ID), 'category__in' => $cat_ID,'numberposts' => 2, 'orderby' => 'rand');
					$rand_posts = get_posts($args);
 					foreach( $rand_posts as $post ) :
					setup_postdata($post);
				?>
		<div class="span3 other-stylists">
		<div class="entry-content clearfix">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'homepage_thumb' ); ?>
		</a>
		<?php endif;?>
		<div class="extrat-content">
		<header class="page-header">
			<hgroup>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			</hgroup>
		</header>	
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php echo substr(get_the_excerpt(), 0,100); ?>
			</a>
		</div><!--extrat-content-->
		</div><!-- .entry-content -->
		</div><!--post-aside-->
 		<?php endforeach; ?>
			</div>
		<?php }else{ ?>
		<div id="other-articles">
			<h2 class="entry-title"><?php _e('Other Articles','theme-text-domain'); ?></h2>
		<?php
		$args = array('numberposts' => 3, 'orderby' => 'rand');
		$rand_posts = get_posts($args);
 		foreach( $rand_posts as $post ) :
		setup_postdata($post);
		?>
		<div class="span2 other-articles">
		<div class="entry-content clearfix">
		<?php if ( has_post_thumbnail() ) : ?>
		<a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'homepage-thumb' ); ?><span class="overlay hidden"><span class="lien"><?php _e('Know More','theme-text-domain'); ?></span></span>
		</a>
		<?php endif;?>
		<header class="page-header">
			<hgroup>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			</hgroup>
		</header>	
		<a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_excerpt();?>
		</a>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php printf( __( '<div class="about-author"><span class="by-author"> <span class="sep">By </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>
			<span class="sep"> | </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'the-bootstrap' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'theme-text-domain','the-bootstrap' ), get_the_author() ) ),
			get_the_author()
			);?>
			<span></span>
			</div><!--about-author-->
			<div class="comments-display">
			<?php the_category();?>
			<span class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply','theme-text-domain','the-bootstrap' ) . '</span>', __( 'Comment <strong>1</strong> ', 'theme-text-domain','the-bootstrap' ), __( 'Comments : <strong>%</strong>','theme-text-domain', 'the-bootstrap' ) ); ?>
			</span>
			</div><!--comments-display-->
		</footer><!-- .entry-footer -->
		</div><!--post-aside-->
 		<?php endforeach; ?>
 	</div><!--other-articles-->
 	<?php }?>
	</div><!-- #content -->
	<?php tha_content_after(); ?>
</section><!-- #primary -->
<?php if(is_single('255')){ 
	get_sidebar('stylists');
}elseif(is_single('282')){
	get_sidebar('riss');
}elseif(is_single('305')){
	get_sidebar('fournie');
}else{
get_sidebar('posts'); }?>
</div>
</div>
<?php get_footer();?>


<!-- End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */-->