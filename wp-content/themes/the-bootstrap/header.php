<?php
/** header.php
 *
 * Displays all of the <head> section and everything up till </header>
 *
 * @author		Pesnya Tatiana
 * @package		FashionLab
 */

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<?php tha_head_top(); ?>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<title>
		<?php if (function_exists('is_tag') && is_tag()) {
		single_tag_title('Tag Archive for &quot;'); echo '&quot; - ';
		} elseif (is_archive()) {
		wp_title(''); echo ' Archive - ';
		} elseif (is_search()) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
		} elseif (!(is_404()) && (is_single()) || (is_page())) {
		wp_title(''); echo ' - ';
		} elseif (is_404()) {
		echo 'Not Found - ';
		}
		if (is_home()) {
		bloginfo('name'); echo ' - '; bloginfo('description');
		} else {
		bloginfo('name');
		}
		if ($paged > 1) {
		echo ' - page '. $paged;
		} ?>
		</title>
		
		<?php tha_head_bottom(); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<div class="top"></div>
		<img src="<?php bloginfo('template_directory'); ?>/img/logo.png" class="logo">
		<div class="container">
			<div id="page">
				<?php wp_nav_menu( array('menu' => 'languages' )); ?>
				<?php do_action('icl_language_selector'); ?>
				<?php tha_header_before(); ?>
				<header id="branding" role="banner" class="span12">
					<?php tha_header_top();
					wp_nav_menu( array(
						'container'			=>	'nav',
						'container_class'	=>	'subnav clearfix',
						'theme_location'	=>	'header-menu',
						'menu_class'		=>	'nav nav-pills pull-right',
						'depth'				=>	3,
						'fallback_cb'		=>	false,
						'walker'			=>	new The_Bootstrap_Nav_Walker,
					) ); ?>
					<hgroup>
						<h1 id="site-title" class="span3">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<span><img src="<?php bloginfo('template_directory'); ?>/img/fashionlab.png" alt="<?php bloginfo('name'); ?>" /></span>
							</a>
						</h1>
					<nav id="access" role="navigation" class="span9">
						<h3 class="assistive-text"><?php _e( 'Main menu', 'the-bootstrap' ); ?></h3>
						<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'the-bootstrap' ); ?>"><?php _e( 'Skip to primary content', 'the-bootstrap' ); ?></a></div>
						<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'the-bootstrap' ); ?>"><?php _e( 'Skip to secondary content', 'the-bootstrap' ); ?></a></div>
						<?php if ( has_nav_menu( 'primary' ) OR the_bootstrap_options()->navbar_site_name OR the_bootstrap_options()->navbar_searchform ) : ?>
						<div <?php the_bootstrap_navbar_class(); ?>>
							<div class="navbar-inner">
								<div class="container">
									<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
									<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									</a>
									<?php if ( the_bootstrap_options()->navbar_site_name ) : ?>
									<span class="brand"><?php bloginfo( 'name' ); ?></span>
									<?php endif;?>
									<div class="nav-collapse">
										<?php wp_nav_menu( array(
											'theme_location'	=>	'primary',
											'menu_class'		=>	'nav',
											'depth'				=>	3,
											'fallback_cb'		=>	false,
											'walker'			=>	new The_Bootstrap_Nav_Walker,
										) ); ?>
								    </div>
								</div>
							</div>
						</div>
					</div>
						<?php endif; ?>
					</nav><!-- #access -->
					<?php 
					tha_header_bottom(); ?>
				</hgroup>
			</header>
		</div><!--page-->
	</div><!--container-->
	<!-- #branding -->
	<?php tha_header_after();
				

/* End of file header.php */
/* Location: ./wp-content/themes/the-bootstrap/header.php */