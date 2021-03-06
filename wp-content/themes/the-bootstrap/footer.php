<?php
/** footer.php
 *
 * @author		Pesnya Tatiana
 * @package		FashionLab
 */
				tha_footer_before(); ?>
				<footer id="colophon" role="contentinfo">
				<div class="container">
				<div id="page-footer" class="well clearfix">
					<?php tha_footer_top(); ?>
						<div class="span3">
							<h1 id="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<span><img src="<?php bloginfo('template_directory'); ?>/img/logo-footer.png" alt="<?php bloginfo('name'); ?>" /></span>
							</a>
							</h1>
							<?php wp_nav_menu( array(
							'container'			=>	'nav',
							'container_class'	=>	'subnav',
							'theme_location'	=>	'footer-contact',
							'menu_class'		=>	'credits nav nav-pills pull-left',
							'depth'				=>	3,
							'fallback_cb'		=>	'the_bootstrap_credits',
							'walker'			=>	new The_Bootstrap_Nav_Walker,
						) );
						?>
					</div><!--span3-->
					<div class="span2">
						<div class="footer_box">
							<h2><?php _e('Fashionlab Categories','theme-text-domain'); ?></h2>
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
					</div><!--span3-->
					<div class="span2">
					<div class="footer_box">
						<h2><?php _e('Other Categories','theme-text-domain'); ?></h2>
						<?php wp_nav_menu( array(
							'container'			=>	'nav',
							'container_class'	=>	'subnav',
							'theme_location'	=>	'footer-menu2',
							'menu_class'		=>	'credits nav nav-pills pull-left',
							'depth'				=>	3,
							'fallback_cb'		=>	'the_bootstrap_credits',
							'walker'			=>	new The_Bootstrap_Nav_Walker,
						) );
						?>
					</div>
					</div>
					<div class="span2">
					<div class="footer_box">
						<h2><?php _e('Stylists','theme-text-domain'); ?></h2>
						<?php wp_nav_menu( array(
							'container'			=>	'nav',
							'container_class'	=>	'subnav',
							'theme_location'	=>	'footer-menu3',
							'menu_class'		=>	'credits nav nav-pills pull-left',
							'depth'				=>	3,
							'fallback_cb'		=>	'the_bootstrap_credits',
							'walker'			=>	new The_Bootstrap_Nav_Walker,
						) );
						?>
					</div>
					</div>
					<div class="span2">
					<div class="footer_box">
						<h2><?php _e('Partners','theme-text-domain'); ?></h2>
						<?php wp_nav_menu( array(
							'container'			=>	'nav',
							'container_class'	=>	'subnav',
							'theme_location'	=>	'footer-menu4',
							'menu_class'		=>	'credits nav nav-pills pull-left',
							'depth'				=>	3,
							'fallback_cb'		=>	'the_bootstrap_credits',
							'walker'			=>	new The_Bootstrap_Nav_Walker,
						) );
						?>
					</div>
					</div>
					</div><!-- #page-footer .well .clearfix -->
					<div class="clear"></div>
					<div class="span12">	
						<p><?php _e('Copyright 2013 Dassault Systemes.','theme-text-domain'); ?></p>	
					</div>
					<?php tha_footer_bottom(); ?>
					</div><!--container-->
				</footer><!-- #colophon -->
				<?php tha_footer_after(); ?>
	<!-- <?php printf( __( '%d queries. %s seconds.', 'the-bootstrap' ), get_num_queries(), timer_stop(0, 3) ); ?> -->
	<?php wp_footer(); ?>
	</body>
</html>
<?php


/* End of file footer.php */
/* Location: ./wp-content/themes/the-bootstrap/footer.php */