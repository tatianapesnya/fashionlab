<?php
/** content-single.php
 *
 * The template for displaying content in the single.php template
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.0 - 07.02.2012
 */


tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<header class="page-header">
		<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image'); endif; ?>
		<!--category-->
		<?php
		if(is_single('stylist')){
		}else{
		 echo get_the_post_thumbnail($page->ID);
		}
			$categories = get_the_category();
			$separator = ' ';
			$output = '';
			if($categories){
				foreach($categories as $category) {
					$output .= '<ul class="category-list"><li>
						<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li></ul>'.$separator;
				}
			echo trim($output, $separator);
			}
			?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if (is_singular('stylist')){}else{ ?>
			<div class="entry-meta">
			<?php 
			if (get_the_author_meta(ID) == 2){
				$author_link = get_bloginfo('url').'/stylist/francois-quentin/';
			}elseif(get_the_author_meta(ID) == 3){
				$author_link = get_bloginfo('url').'/stylist/jonathan-riss/';
			}elseif(get_the_author_meta(ID) == 4){
				$author_link = get_bloginfo('url').'/stylist/julien-fournie/';
			}

			echo '<div class="about-author"><span class="by-author"> <span class="sep">By</span> <span class="author vcard"><a class="url fn n" href="'.$author_link.'" title="" rel="author">'.get_the_author().'</a></span></span>
				<span class="sep"> | </span><time class="entry-date" datetime="'.get_the_date( 'c' ).'" pubdate>'.get_the_date().'</time>';
			?>
			</div><!--about-author-->
		</div><!-- .entry-meta -->
			<?php }

if ( get_the_author_meta( 'description' ) AND is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
<aside id="author-info" class="row">
	<h2 class="span8"><?php printf( __( 'About %s','theme-text-domain', 'the-bootstrap' ), get_the_author() ); ?></h2>
	<div id="author-avatar" class="span1">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'the_bootstrap_author_bio_avatar_size', 70 ) ); ?>
	</div><!-- #author-avatar -->
	<div id="author-description" class="span7">
		<?php the_author_meta( 'description' ); ?>
		<div id="author-link">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>','theme-text-domain', 'the-bootstrap' ), get_the_author() ); ?>
			</a>
		</div><!-- #author-link	-->
	</div><!-- #author-description -->
</aside><!-- #author-info -->
<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php
		the_content();
		the_bootstrap_link_pages(); ?>
	</div><!-- .entry-content -->
		<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();?>
	<?php 

/* End of file content-single.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-single.php */