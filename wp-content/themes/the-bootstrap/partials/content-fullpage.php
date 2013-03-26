<?php
/** content-fullpage.php
 *
 * The template for displaying posts in the Full Page Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Pesnya Tatiana
 * @package		The Bootstrap
 * @since		1.0 - 07.02.2012
 */
tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary clearfix">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content clearfix">
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('fullpage_thumb', 768, 265, true);?></a>
		<header class="page-header">
		<hgroup>
			<?php the_title('<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</hgroup>
		</header><!-- .entry-header -->
		<?php
		the_excerpt( __( 'Continue reading <span class="meta-nav">...</span>', 'the-bootstrap' ) );
		the_bootstrap_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php the_bootstrap_posted_on(); ?>
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-aside.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-aside.php */