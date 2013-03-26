<?php
function return_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='0'){
	$slider_html='';
	$slider_html=get_global_smooth_slider($slider_handle,$r_array,$slider_id,$echo);
	return $slider_html;
}
//Basic Shortcode
function return_smooth_slider($slider_id='',$offset='0') {
	global $smooth_slider; 
	$slider_html='';
	if($smooth_slider['multiple_sliders'] == '1' and is_singular() and (empty($slider_id) or !isset($slider_id))){
		global $post;
		$post_id = $post->ID;
		$slider_id = get_slider_for_the_post($post_id);
	}
	if((!is_singular() or $smooth_slider['multiple_sliders'] != '1') and (empty($slider_id) or !isset($slider_id))){
		$slider_id = '1';
	}
	if(!empty($slider_id)){ 
		$r_array = carousel_posts_on_slider($smooth_slider['no_posts'], $offset, $slider_id, $echo = '0'); 
		$slider_handle='smooth_slider_'.$slider_id;
		$slider_html=return_global_smooth_slider($slider_handle,$r_array,$slider_id,$echo='0');
	} //end of not empty slider_id condition
	return $slider_html;
}

function smooth_slider_simple_shortcode($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'offset'=> '',
	), $atts));

	return return_smooth_slider($id);
}
add_shortcode('smoothslider', 'smooth_slider_simple_shortcode');

//Category shortcode
function return_smooth_slider_category($catg_slug='',$offset=0) {
	global $smooth_slider; 
	$slider_html='';
	$r_array = carousel_posts_on_slider_category($smooth_slider['no_posts'], $catg_slug, $offset, '0'); 
	$slider_handle='smooth_slider_'.$catg_slug;
	$slider_html=return_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='0');
	return $slider_html;
}

function smooth_slider_category_shortcode($atts) {
	extract(shortcode_atts(array(
		'catg_slug' => '',
		'offset' => '',
	), $atts));

	return return_smooth_slider_category($catg_slug,$offset);
}
add_shortcode('smoothcategory', 'smooth_slider_category_shortcode');

//Recent Posts Shortcode
function return_smooth_slider_recent($offset=0) {
	global $smooth_slider; 
	$slider_html='';
	$r_array = carousel_posts_on_slider_recent($smooth_slider['no_posts'], $offset, '0');
	$slider_handle='smooth_slider_recent';
	$slider_html=return_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='0');
	return $slider_html;
}

function smooth_slider_recent_shortcode($atts) {
	extract(shortcode_atts(array(
		'offset' => '',
	), $atts));
	return return_smooth_slider_recent($offset);
}
add_shortcode('smoothrecent', 'smooth_slider_recent_shortcode');
?>