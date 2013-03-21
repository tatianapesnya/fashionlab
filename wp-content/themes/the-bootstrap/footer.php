<?php
/** footer.php
 *
 * @author		Pesnya Tatiana
 * @package		FashionLab
 */
				tha_footer_before(); ?>
				<footer id="colophon" role="contentinfo" class="span12">
					<div id="page-footer" class="well clearfix">
					<?php tha_footer_top(); ?>
						<div class="span3">
							<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<span><img src="<?php bloginfo('template_directory'); ?>/img/fashionlab-gray.png" alt="<?php bloginfo('name'); ?>" /></span>
							</a>
						</h1>
					</div>
					<div class="span3">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>       
            
       					 <?php endif; ?>                
					</div><!--span3-->
					<div class="span3">
						<h2><a href="#">Stylists</a></h2>
							<ul>
								<li><a href="#">François Quentin</a></li>
								<li><a href="#">Jonathan Riss</a></li>
								<li><a href="#">Julien Fournié</a></li>
							</ul>
					</div>
					<div class="span2">
						<h2><a href="#">Partners</a></h2>
							<ul>
								<li><a href="#">Media</a></li>
								<li><a href="#">Technologic</a></li>
							</ul>
					</div>
					</div><!-- #page-footer .well .clearfix -->
					<div class="span12">	
						<?php wp_nav_menu( array(
							'container'			=>	'nav',
							'container_class'	=>	'subnav',
							'theme_location'	=>	'footer-menu',
							'menu_class'		=>	'credits nav nav-pills pull-left',
							'depth'				=>	3,
							'fallback_cb'		=>	'the_bootstrap_credits',
							'walker'			=>	new The_Bootstrap_Nav_Walker,
						) );
						?>
					</div>
					<?php tha_footer_bottom(); ?>
				</footer><!-- #colophon -->
				<?php tha_footer_after(); ?>
			</div><!-- #page -->
		</div><!-- .container -->
	<!-- <?php printf( __( '%d queries. %s seconds.', 'the-bootstrap' ), get_num_queries(), timer_stop(0, 3) ); ?> -->
	<?php wp_footer(); ?>
	</body>
</html>
<?php


/* End of file footer.php */
/* Location: ./wp-content/themes/the-bootstrap/footer.php */