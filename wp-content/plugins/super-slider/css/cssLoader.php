<?php header("Content-type: text/css; charset: UTF-8"); 

require_once( '../../../../wp-load.php' );

$pexeto_css = array(
	'skin'=>get_opt('_skin'),
	'custom_color'=>get_opt('_custom_skin'),
	'pattern'=>get_opt('_pattern'),
	'custom_pattern'=>get_opt('_custom_pattern'),
	'body_bg_options'=>get_opt('_body_bg_options'),
	'body_color' => get_opt('_body_color'),
	'body_bg' => get_opt('_body_bg'),
	'body_text_size' => get_opt('_body_text_size'),
	'logo_image' => get_opt('_logo_image'),
	'logo_width' => get_opt('_logo_width'),
	'logo_height' => get_opt('_logo_height'),
	'link_color' => get_opt('_link_color'),
	'heading_color' => get_opt('_heading_color'),
	'menu_link_color' => get_opt('_menu_link_color'),
	'menu_link_hover' => get_opt('_menu_link_hover'),
	'menu_hover_bg' => get_opt('_menu_hover_bg'),
	'content_bg' => get_opt('_content_bg'),
	'secondary_bg' => get_opt('_secondary_bg'),
	'boxes_color' => get_opt('_boxes_color'),
	'subtitle_color' => get_opt('_subtitle_color'),
	'comments_bg' => get_opt('_comments_bg'),
	'footer_bg' => get_opt('_footer_bg'),
	'footer_text_color' => get_opt('_footer_text_color'),
	'footer_lines_color' => get_opt('_footer_lines_color'),
	'subtitle_bg' => get_opt('_subtitle_bg'),
	'footer_wrapper_bg' => get_opt('_footer_wrapper_bg'),
	'copyright_text' => get_opt('_copyright_text_color'),
	'border_color' => get_opt('_border_color'),
	'heading_font_family'=>get_opt('_heading_font_family'),
	'secondary_font_family'=>get_opt('_secondary_font_family'),
	'body_font_family'=>get_opt('_body_font_family')
);


$pexeto_main_color=$pexeto_css['custom_color']==''?$pexeto_css['skin']:$pexeto_css['custom_color'];

/**--------------------------------------------------------------------*
 * SET THE BACKGROUND COLOR AND PATTERN
 *---------------------------------------------------------------------*/

if($pexeto_main_color!=''){
	$css= 'h1 a:hover,a,#footer ul li a:hover,#intro h1 a,#page-title h1 a,#portfolio-categories ul li.selected,.sidebar-box ul li a:hover,#sidebar .widget_nav_menu ul li.current-menu-item > a,#sidebar ul li.current-cat>a, .showcase-item span.post-info,ul.blogroll li a,#footer .widget_twitter ul li a,#footer ul.blogroll li a, .tabs a:hover, .services-box a h2{color:#'.$pexeto_main_color.';}';
	$css.=' #navigation-container, #menu ul ul li, .portfolio-hover, .button, #submit  {background-color:#'.$pexeto_main_color.';}';
	$css.='a, #accordion h2.current {color:#'.$pexeto_main_color.';}';
	$css.='table th:hover{border-color:#'.$pexeto_main_color.';}';
	$css.='.tabs .current, .tabs .current:hover, .tabs li.current a, .tabs a:hover{border-bottom-color:#'.$pexeto_main_color.';}';
	$css.='::selection { background: #'.$pexeto_main_color.'; } ::-moz-selection { background: #'.$pexeto_main_color.'; }';
	echo $css;
}

if($pexeto_css['custom_pattern']!='' || ($pexeto_css['pattern']!='' && $pexeto_css['pattern']!='none')){
	if($pexeto_css['custom_pattern']!=''){
	$bg=$pexeto_css['custom_pattern'];
	
	//set the custom background options
	$options = explode(',', $pexeto_css['body_bg_options']);
	if(!in_array('repeatable', $options)){
		echo 'body{background-repeat:no-repeat;}';
	}
	if(in_array('fixed', $options)){
		echo 'body{background-attachment:fixed;}';
	}
	if(in_array('center', $options)){
		echo 'body{background-position:center top;}';
	}
	
	}else{
	$bg=get_bloginfo('template_url').'/images/patterns/'.$pexeto_css['pattern'];
	}
	
	echo 'body{background-image:url('.$bg.');}';
	
}elseif($pexeto_css['pattern']=='none' && $pexeto_css['custom_pattern']==''){
	echo 'body{background-image:none;}';
}


if($pexeto_css['body_bg']!=''){
	echo 'body {background-color:#'.$pexeto_css['body_bg'].';}';
}

if($pexeto_css['body_text_size']!=''){
	echo 'body, .sidebar,#footer ul li a,#footer{font-size:'.$pexeto_css['body_text_size'].'px;}';
}

/**--------------------------------------------------------------------*
 * SET THE LOGO
 *---------------------------------------------------------------------*/

if($pexeto_css['logo_image']!=''){
	echo "#logo-container a{background-image:url('".$pexeto_css['logo_image']."');}";
}

$logoWidth=116;
if($pexeto_css['logo_width']!=''){
	echo '#logo-container a{width:'.$pexeto_css['logo_width'].'px;}';
	$logoWidth=$pexeto_css['logo_width'];
	if($pexeto_css['logo_width']>116){
		echo '#navigation-spacer{width:'.(900-$pexeto_css['logo_width']).'px;}';
	}
}


if($pexeto_css['logo_height']!=''){
	echo '#logo-container a{height:'.$pexeto_css['logo_height'].'px;}';
	if($pexeto_css['logo_height']>36){
		echo '#navigation-spacer{height:'.($pexeto_css['logo_height']-34).'px;}';
	}
}

/**--------------------------------------------------------------------*
 * TEXT COLORS
 *---------------------------------------------------------------------*/

if($pexeto_css['body_color']!=''){
	echo 'body, .sidebar-box ul li a,#portfolio-big-pagination a,.sidebar-box h4, #slider, .no-caps, .post-date h4, .post-date span, #sidebar .widget_categories ul li a, #sidebar .widget_nav_menu ul li a, blockquote {color:#'.$pexeto_css['body_color'].';}';
}

if($pexeto_css['link_color']!=''){
	echo 'a,.post-info, .post-info a{color:#'.$pexeto_css['link_color'].';}';
}

if($pexeto_css['heading_color']!=''){
	echo 'h1,h2,h3,h4,h5,h6,.sidebar-box h4,.services-box h2,.post h1, .blog-post h1 a,.portfolio-sidebar h4, #portfolio-categories ul li, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .services-box h4, #intro h1, #page-title h1, .item-desc h4 a, .item-desc h4, .sidebar-post-wrapper h6 a, table th, .tabs a, .post-title a:hover{color:#'.$pexeto_css['heading_color'].';}';
}

if($pexeto_css['menu_link_color']!=''){
	echo '#menu ul li a{color:#'.$pexeto_css['menu_link_color'].';}';
}

if($pexeto_css['menu_link_hover']!=''){
	echo '#menu ul li a:hover{color:#'.$pexeto_css['menu_link_hover'].';}';
}

if($pexeto_css['subtitle_color']!=''){
	echo '#page-title, #content-slider, #content-slider h2{color:#'.$pexeto_css['subtitle_color'].';}';
}

if($pexeto_css['footer_text_color']!=''){
	echo '#footer,#footer ul li a,#footer ul li a:hover,#footer h4, #footer .sidebar-post-wrapper h6 a, #footer .sidebar-post-info a{color:#'.$pexeto_css['footer_text_color'].';}';
}

if($pexeto_css['copyright_text']!=''){
	echo '#copyrights h5, #copyrights h5 a {color:#'.$pexeto_css['copyright_text'].';}';
}

/**--------------------------------------------------------------------*
 * BACKGROUNDS
 *---------------------------------------------------------------------*/
 
if($pexeto_css['content_bg']!=''){
	echo '#site, input[type=text], textarea, #accordion .pane, #accordion h2{background-color:#'.$pexeto_css['content_bg'].';}';
	echo '#content-container{border-color:#'.$pexeto_css['content_bg'].';}';
}

if($pexeto_css['secondary_bg']!=''){
	echo '#slider-navigation-container, #thumbnail-wrapper, #content-container .wp-pagenavi a:hover, .wp-pagenavi span.current, .services-description, .showcase-item:hover, .showcase-selected, #portfolio-categories, #sidebar .widget_categories ul li a:hover, #sidebar .widget_nav_menu ul li a:hover, .sidebar-post-wrapper:hover, .sidebar-box .search-button, #footer .search-button, #not-found .search-button, table th , .table-price td, .tabs .current, .tabs .current:hover, .tabs li.current a, .tabs a:hover, #accordion h2.current, #nivo-controlNav-holder, img.img-frame, img.attachment-post_box_img, .img-frame img, .img-wrapper, .coment-box img, #content-container .gallery img, #sidebar-projects img, .wp-caption p.wp-caption-text, .gallery-caption, .wp-caption, #slider-navigation .items img, .thumbnail-holder, table td:hover, .coment-box img, .table-title td{background-color:#'.$pexeto_css['secondary_bg'].';}';
	echo '.showcase-item:hover .triangle, .showcase-selected .triangle { border-left-color:#'.$pexeto_css['secondary_bg'].';}';
}


if($pexeto_css['menu_hover_bg']!=''){
	echo '#menu ul ul li a:hover {background-color:#'.$pexeto_css['menu_hover_bg'].';}';
}


if($pexeto_css['border_color']!=''){
	echo 'hr, ul.blogroll li, .sidebar-box h4, .sidebar-box ul li, .post-info, #portfolio-categories,.post, ul.commentlist li, .double-line, #intro, #page-title,#slider, #slider-navigation .items img, .latest-projects-holder .latest-project, .slider-frame, .sidebar-post-wrapper, #blog-latest .columns-wrapper, .latest-small, .showcase-item, .item-wrapper, .portfolio-item, .coment-box img, #content-container .gallery img, #sidebar .widget_categories ul li, #sidebar .widget_nav_menu ul li, input[type="text"], textarea, table td, .services-box h2, #thumbnail-wrapper, .thumbnail-holder, #nivo-controlNav-holder, #slider-navigation-container, .panes, .tabs li a, #accordion .pane, #accordion, #accordion h2, .table-description td, .table-buttons td, .table-price td, .pricing-table ul li, .table-title td, .showcase-item:first-child, blockquote p {border-color:#'.$pexeto_css['border_color'].';}';
}

if($pexeto_css['footer_bg']!=''){
	echo '#footer, #footer input[type="text"], #footer textarea {background-color:#'.$pexeto_css['footer_bg'].';border-color:#'.$pexeto_css['footer_bg'].';}';
}

if($pexeto_css['footer_wrapper_bg']!=''){
	echo '#footer-container {background-color:#'.$pexeto_css['footer_wrapper_bg'].';}';
}

if($pexeto_css['footer_lines_color']!=''){
	echo '#footer .gallery-img, #footer .img-frame, #footer .search-button{background-color:#'.$pexeto_css['footer_lines_color'].';}';
	echo '#footer .double-line, #footer hr, #footer ul li a, #footer ul li,#footer-line, #footer-container, #footer .sidebar-post-wrapper, #footer input[type="text"], #footer textarea{border-color:#'.$pexeto_css['footer_lines_color'].';}';
}

/**--------------------------------------------------------------------*
 * FONTS
 *---------------------------------------------------------------------*/

if($pexeto_css['heading_font_family']!=''){
	echo 'h1,h2,h3,h4,h5,h6,.accordion-description a,#content-container .wp-pagenavi,#portfolio-categories ul li.selected,.table-title td,.table-description strong,table th,.tabs a,ul.blogroll li a {font-family:'.$pexeto_css['heading_font_family'].';}';
}

if($pexeto_css['secondary_font_family']!=''){
	echo '#portfolio-categories h6, .post-date span, .no-caps , .no-caps , #copyrights h5 , blockquote , .widget-contact-form input[type="text"], .widget-contact-form textarea , #intro h1, #page-title h1{font-family:'.$pexeto_css['secondary_font_family'].';}';
}

if($pexeto_css['body_font_family']!=''){
	echo 'body{font-family:'.$pexeto_css['body_font_family'].';}';
}



/**--------------------------------------------------------------------*
 * ADDITIONAL STYLES
 *---------------------------------------------------------------------*/

if(get_opt('_additional_styles')!=''){
	echo(get_opt('_additional_styles'));
}
?>