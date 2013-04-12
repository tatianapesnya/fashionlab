<?php
/** content-video.php
 *
 * The template for displaying posts in the Video Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.0.1 - 07.03.2012
 */

tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php tha_entry_top(); ?>
	<div class="entry-content clearfix">
		<?php	 
	$videosite = get_post_meta($post->ID, 'Video Site', single);  
	$videoid = get_post_meta($post->ID, "Video ID", single);  
		 if ($videosite == 'vimeo')  
	{  
    echo '<iframe src="http://player.vimeo.com/video/'.$videoid.'" width="300" height="190" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
	}  
	else if ($videosite == 'youtube')  
	{  
  	  echo '<iframe width="300" height="190" src="http://www.youtube.com/embed/'.$videoid.'" frameborder="0" allowfullscreen></iframe>';  
	}  
	else  
	{  
   		 echo 'Please select a Video Site via the WordPress Admin';  
	}  ?>
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('homepage_thumb');?><span class="overlay hidden"><span class="lien">Know More</span></span></a>
		<header class="page-header">
		<hgroup>
			<?php the_title('<h2 class="entry-title"><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', 'the-bootstrap' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</hgroup>
		</header><!-- .entry-header -->
		<?php
		the_excerpt( __( '<span class="meta-nav">...</span>', 'the-bootstrap' ) );
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



/* End of file content-video.php */
/* Location: ./wp-content/themes/the-bootstrap/partials/content-video.php */