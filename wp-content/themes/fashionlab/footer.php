<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package FashionLab
 */
?>
	</div><!-- #main -->
</div><!--row-->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>
			<div id="site-generator">
			</div>
	</footer><!-- #colophon -->
</div><!--container-->

<?php wp_footer(); ?>

</body>
</html>