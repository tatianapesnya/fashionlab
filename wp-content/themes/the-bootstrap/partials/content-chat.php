<?php
/** content-chat.php
 *
 * The template for displaying posts in the Chat Post Format on index and archive pages
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
	<div class="entry-content clearfix">
		
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('fullpage_thumb');?><span class="overlay hidden"><span class="lien">Know More</span></span></a>
		<header class="page-header">
		<hgroup>
			<?php the_title('<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</hgroup>
		</header><!-- .entry-header -->
		<?php
		the_excerpt( __('the-bootstrap' ) );
		the_bootstrap_link_pages(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="about-author">
		<?php the_bootstrap_posted_on(); ?>
		</div><!--about-author-->
	</footer><!-- .entry-footer -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php tha_entry_after();


/* End of file content-aside.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-aside.php */