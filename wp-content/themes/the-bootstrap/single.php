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
<section id="primary" class="span8 single">
	<?php tha_content_before(); ?>
	<div id="content" role="main">
		<?php tha_content_top();

		while ( have_posts() ) {
			the_post();
			get_template_part( '/partials/content', 'single' );
			comments_template();
		} ?>
		
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
			<?php the_post_thumbnail( 'homepage_thumb' ); ?><span class="overlay hidden"><span class="lien">Know More</span></span>
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
			<?php the_post_thumbnail( 'articles_thumb' ); ?><span class="overlay hidden"><span class="lien"><?php _e('Know More','theme-text-domain'); ?></span></span>
		</a>
		<?php endif;?>
		<header class="page-header">
			<hgroup>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php if (strlen($post->post_title) > 22) {
							echo substr(the_title($before = '', $after = '', FALSE), 0, 22) . '...';} else {
							the_title('<a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a>' );
						} ?>
					</a>
				</h3>
			</hgroup>
		</header>	
		<a  href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php echo substr(get_the_excerpt(), 0,70); ?>
		</a>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php printf( __( '<div class="about-author"><span class="by-author"> <span class="sep">By </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>
			<span class="sep"> | </span><time class="entry-date" datetime="%3$s" pubdate>%4$s</time>', 'the-bootstrap' ),
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
			<?php
				$category = get_the_category();
				if ($category) {
				  echo '<ul class="post-categories"><li>
				  	<a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a>
				  	</li>
				  	</ul>';
				}
				?>
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
<?php if(is_single('francois-quentin')){ 
	get_sidebar('stylists');
}elseif(is_single('jonathan-riss')){
	get_sidebar('riss');
}elseif(is_single('julien-fournie')){
	get_sidebar('fournie');
}else{
get_sidebar('posts'); }?>
</div>
</div>
<?php get_footer();?>


<!-- End of file index.php */
/* Location: ./wp-content/themes/the-bootstrap/single.php */-->