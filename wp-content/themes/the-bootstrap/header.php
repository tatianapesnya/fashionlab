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
		wp_title(''); echo '  - ';
		} elseif (is_search()) {
		echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
		} elseif (!(is_404()) && (is_single()) || (is_page())) {
		 wp_title(''); echo '  ';
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
		<!--[if IE 8]>
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/styles-ie.css" media="screen" type="text/css" />
		<![endif]-->
		<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/modernizr.custom.24046.js'></script>
		<?php tha_head_bottom(); ?>

		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
		<!--<div class="top"></div>
		<img src="<?php bloginfo('template_directory'); ?>/img/logo.png" class="logo">-->

<div id="header_3ds">    	    
	<div id="dsheader"> 
		<a class="logo" href="http://www.3ds.com/" title="Dassault Systèmes" target="_blank" onclick="">&nbsp;</a>
		<div id="navigation">
			<div class="outer">
				<div class="inner">
					<ul>
						<li class="firstitem"><a href="http://www.3ds.com/solutions/" onfocus="blurLink(this);" target="_blank">Solutions</a> </li>
						<li><a href="http://www.3ds.com/products/" onfocus="blurLink(this);"target="_blank">Products</a> </li>
						<li><a href="http://www.3ds.com/support/" onfocus="blurLink(this);" target="_blank">Support</a> </li>
						<li><a href="http://www.3ds.com/education/" onfocus="blurLink(this);" target="_blank">Education</a> </li>
						<li><a href="http://www.3ds.com/partners/" onfocus="blurLink(this);" target="_blank">Partners</a> </li>
						<li><a href="http://www.3ds.com/company/" onfocus="blurLink(this);" class="current"  target="_blank">Company</a> </li>
						<li class="nosub"><a href="http://www.3ds.com/social-networks/" onfocus="blurLink(this);" target="_blank">Social Networks</a></li>
					</ul>
					<div id="compass"><a href="http://www.3ds.com/3dexperience/" onfocus="blurLink(this);" target="_blank"><span>3DExperience</span></a></div>
				</div>
			</div>
		</div>
		<div id="account">
			<div class="inner">
				<ul>
					<li class="searchform">
						<form id="search_3ds" method="get" name="search_3ds" action="http://www.3ds.com/search/" class="hidemenu">
							<div>
								<input class="search-input" id="search3ds" onblur="if(this.value=='') this.value='Search 3DS website';" onfocus="if(this.value=='Search 3DS website')this.value='';" value="Search 3DS website" name="q" type="text" />
								<input value="OK" class="search-submit" src="<?php bloginfo('template_directory'); ?>/img/px.png" type="image" />
							</div>
						</form>
					</li>
					<!--<li class="language"> <span class="bullet"></span> <a class="currentflag" onclick="return false();"> <span class="flag en-bg.gif"></span> <span>English</span> </a> <span class="separate"></span> </li>-->
					<li class="contact"> <span class="bullet"></span> <a href="http://www.3ds.com/contact/" target="_blank">Contact</a> <span class="separate"></span> </li>
					<li class="dsappstore"> <span class="bullet"></span> <a href="http://www.3ds.com/3dstore/" target="_blank">3DStore</a> <span class="separate"></span> </li>
				</ul>
			</div>
		</div>
	</div>
</div>


<div class="header_drag_container">
	<span id="header_drag" class="noajax active">
		<div class="header_drag_toggle"></div>		
	</span>
	<span id="header_drag2">
		<a class="header_drag_toggle" href="http://www.3ds.com" target="_blank"></a>		
	</span>	

</div>





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
					<nav id="access" role="navigation">
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
					<div class="clear"></div>
					<div class="breadcrumbs">
    					<?php do_action('icl_navigation_breadcrumb', ' -> '); ?>
					</div>
					<?php tha_header_bottom(); ?>
				</hgroup>
			</header>
		</div><!--page-->
	</div><!--container-->
	<!-- #branding -->
	<?php tha_header_after();
				

/* End of file header.php */
/* Location: ./wp-content/themes/the-bootstrap/header.php */