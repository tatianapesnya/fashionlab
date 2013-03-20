<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package FashionLab
 */
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>;charset=<?php bloginfo('charset'); ?>" />
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width">
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
<?php wp_print_styles(array('main_style', 'boostrap_css', 'bootstrap_responsive')); ?>
<?php wp_print_scripts(array('jquery', 'bootstrap_js')); ?>
<?php wp_head(); ?>
</head>
<body>
<div class="container">
	<div class="page-header">
		 <div class="row">
			<hgroup class="span12">
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/fashionlab.png" alt="<?php
bloginfo('name'); ?>" /></a></span></h1>
			</hgroup>
			<div class="span12">
				<?php wp_nav_menu(); ?>
			</div>
	</div><!--page-header-->
