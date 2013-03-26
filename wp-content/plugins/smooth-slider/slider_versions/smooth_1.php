<?php 
function smooth_global_posts_processor( $posts, $smooth_slider,$out_echo ){
	global $smooth_slider;
	$smooth_slider_css = smooth_get_inline_css();
	$html = '';
	$smooth_sldr_j = 0;
	
	foreach($posts as $post) {
		$post_id = $post->ID;
		$post_title = stripslashes($post->post_title);
		$post_title = str_replace('"', '', $post_title);
		//filter hook
		$post_title=apply_filters('smooth_post_title',$post_title,$post_id,$smooth_slider,$smooth_slider_css);
		$slider_content = $post->post_content;	
//2.1 changes start
		$slide_redirect_url = get_post_meta($post_id, 'slide_redirect_url', true);
		$sslider_nolink = get_post_meta($post_id,'sslider_nolink',true);
		trim($slide_redirect_url);
		if(!empty($slide_redirect_url) and isset($slide_redirect_url)) {
		   $permalink = $slide_redirect_url;
		}
		else{
		   $permalink = get_permalink($post_id);
		}
		if($sslider_nolink=='1'){
		  $permalink='';
		}
		
		//filter hook
		$permalink=apply_filters('smooth_permalink',$permalink,$post_id,$smooth_slider,$smooth_slider_css);
//2.1 changes end	
	   	$smooth_sldr_j++;
		$html .= '<div class="smooth_slideri" '.$smooth_slider_css['smooth_slideri'].'>
			<!-- smooth_slideri -->';
			
		$thumbnail = get_post_meta($post_id, $smooth_slider['img_pick'][1], true);
		//$image_control = get_post_meta($post_id, 'slider_image_control', true);
		
		if ($smooth_slider['content_from'] == "slider_content") {
		    $slider_content = get_post_meta($post_id, 'slider_content', true);
		}
		if ($smooth_slider['content_from'] == "excerpt") {
		    $slider_content = $post->post_excerpt;
		}
		
		$slider_content = strip_shortcodes( $slider_content );
		
		$slider_content = stripslashes($slider_content);
		$slider_content = str_replace(']]>', ']]&gt;', $slider_content);

		$slider_content = str_replace("\n","<br />",$slider_content);
        $slider_content = strip_tags($slider_content, $smooth_slider['allowable_tags']);
		
		//filter hook
		$slider_content=apply_filters('smooth_slide_excerpt',$slider_content,$post_id,$smooth_slider,$smooth_slider_css);
						
		if($smooth_slider['img_pick'][0] == '1'){
		 $custom_key = array($smooth_slider['img_pick'][1]);
		}
		else {
		 $custom_key = '';
		}
		
		if($smooth_slider['img_pick'][2] == '1'){
		 $the_post_thumbnail = true;
		}
		else {
		 $the_post_thumbnail = false;
		}
		
		if($smooth_slider['img_pick'][3] == '1'){
		 $attachment = true;
		 $order_of_image = $smooth_slider['img_pick'][4];
		}
		else{
		 $attachment = false;
		 $order_of_image = '1';
		}
		
		if($smooth_slider['img_pick'][5] == '1'){
			 $image_scan = true;
		}
		else {
			 $image_scan = false;
		}
		
		if($smooth_slider['img_size'] == '1'){
		 $gti_width = $smooth_slider['img_width'];
		}
		else {
		 $gti_width = false;
		}
		
		if($smooth_slider['crop'] == '0'){
		 $extract_size = 'full';
		}
		elseif($smooth_slider['crop'] == '1'){
		 $extract_size = 'large';
		}
		elseif($smooth_slider['crop'] == '2'){
		 $extract_size = 'medium';
		}
		else{
		 $extract_size = 'thumbnail';
		}
		
		$img_args = array(
			'custom_key' => $custom_key,
			'post_id' => $post_id,
			'attachment' => $attachment,
			'size' => $extract_size,
			'the_post_thumbnail' => $the_post_thumbnail,
			'default_image' => false,
			'order_of_image' => $order_of_image,
			'link_to_post' => false,
			'image_class' => 'smooth_slider_thumbnail',
			'image_scan' => $image_scan,
			'width' => $gti_width,
			'height' => false,
			'echo' => false,
			'permalink' => $permalink,
			'style'=> $smooth_slider_css['smooth_slider_thumbnail']
		);
		$smooth_slide_image=smooth_sslider_get_the_image($img_args);
		//filter hook
		$smooth_slide_image=apply_filters('smooth_slide_image',$smooth_slide_image,$post_id,$smooth_slider,$smooth_slider_css);
		
		$html .=  $smooth_slide_image;
		
		if(!$smooth_slider['content_limit'] or $smooth_slider['content_limit'] == '' or $smooth_slider['content_limit'] == ' ') 
		  $slider_excerpt = substr($slider_content,0,$smooth_slider['content_chars']);
		else 
		  $slider_excerpt = smooth_slider_word_limiter( $slider_content, $limit = $smooth_slider['content_limit'] );
		  		
		if ($smooth_slider['image_only'] == '1') { 
			$html .= '<!-- /smooth_slideri -->
			</div>';
		}
		else {
		   if($permalink!='') {
			$html .= '<h2 '.$smooth_slider_css['smooth_slider_h2'].'><a '.$smooth_slider_css['smooth_slider_h2_a'].' href="'.$permalink.'">'.$post_title.'</a></h2><span '.$smooth_slider_css['smooth_slider_span'].'> '.$slider_excerpt.'</span>
				<p class="smooth_more"><a href="'.$permalink.'" '.$smooth_slider_css['smooth_slider_p_more'].'>'.$smooth_slider['more'].'</a></p>
			
				<!-- /smooth_slideri -->
			</div>'; }
		   else{
		   $html .= '<h2 '.$smooth_slider_css['smooth_slider_h2'].'>'.$post_title.'</h2><span '.$smooth_slider_css['smooth_slider_span'].'> '.$slider_excerpt.'</span>
				<!-- /smooth_slideri -->
			</div>';    }
		}
	}
	if($out_echo == '1') {
	   echo $html;
	}
	$r_array = array( $smooth_sldr_j, $html);
	$r_array=apply_filters('smooth_r_array',$r_array,$posts, $smooth_slider);
	return $r_array;
}

function get_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='1'){
	global $smooth_slider; 
	$smooth_sldr_j = $r_array[0];
	$smooth_slider_css = smooth_get_inline_css();
	$html='';
	
	$slider_width=$smooth_slider['width'];
	$slider_height=$smooth_slider['height'];
	$slideri_css='margin:0px '. ( ($smooth_slider['prev_next'] == 1) ? "10": "0" ) .'% 0px '. ( ($smooth_slider['prev_next'] == 1) ? "10": "0" ) .'% !important;width:'. ( ($smooth_slider['prev_next'] == 1) ? "80": "100" ) .'% !important;';
	$smooth_media_queries='';
    if( $smooth_slider['responsive'] == '1' ) {
		$smooth_media_queries='@media only screen and (max-width: 479px) {.smooth_slider{width:100% !important;height:'. ( $slider_height + ($slider_height*0.51) ).'px !important;}.smooth_slider .smooth_slideri{'.$slideri_css.'}.smooth_slider .smooth_slider_thumbnail{max-width:100% !important;}}@media only screen and (min-width: 480px) and (max-width: 767px) {.smooth_slider{width:100% !important;height:'. ( $slider_height + ($slider_height*0.36) ).'px !important;}.smooth_slider .smooth_slideri{'.$slideri_css.'}.smooth_slider .smooth_slider_thumbnail{max-width:100% !important;}}@media only screen and (min-width: 768px) and (max-width: 959px) {.smooth_slider{width:100% !important;height:'. ( $slider_height + ($slider_height*0.12) ).'px !important;}.smooth_slider .smooth_slideri{'.$slideri_css.'}.smooth_slider .smooth_slider_thumbnail{max-width:100% !important;} }';
		//filter hook
		$smooth_media_queries=apply_filters('smooth_media_queries',$smooth_media_queries,$smooth_slider);
	}
	
	if(!isset($smooth_slider['fouc']) or $smooth_slider['fouc']=='0' ){
		$fouc='jQuery("html").addClass("smooth_slider_fouc");jQuery(document).ready(function() {   jQuery(".smooth_slider_fouc #'.$slider_handle.'").css({"display" : "block"}); });';
    }	
	else{
	    $fouc='';
	}
	$html.='<script type="text/javascript">';
	$html.=$fouc;
	$html.='jQuery(document).ready(function() {
		jQuery("#'.$slider_handle.'").cycle({ 
			fx: "'.$smooth_slider['fx'].'",
			speed:"'.$smooth_slider['transition'] * 100 .'",
			timeout: "'. ( ($smooth_slider['autostep'] == '1') ? ( $smooth_slider['speed'] * 1000 ) :  0 ) .'",';
		if ($smooth_slider['prev_next'] == 1){ 
			$html.='next:   "#'.$slider_handle.'_next", 
			prev:"#'.$slider_handle.'_prev",';
		} 
		
		if ($smooth_slider['goto_slide'] == "1" or $smooth_slider['goto_slide'] == "2" or $smooth_slider['goto_slide'] == "4"){ 
			$html.='pager: "#'.$slider_handle.'_nav",';
		} 
		
		if ($smooth_slider['goto_slide'] == 1) {
			$html.=' pagerAnchorBuilder: function(idx, slide) { 
					return \'<a class="sldr\'+(idx+1)+\' smooth_slider_nnav" href="#">\'+(idx+1)+\'</a>\'; 
				},'; 
		}
		if ($smooth_slider['goto_slide'] == 2) {
			$html.='pagerAnchorBuilder: function(idx, slide) { 
					return \'<a class="sldr\'+(idx+1)+\' smooth_slider_inav" style="background-image:url('.  smooth_slider_plugin_url( 'images/' ).'slide\'+(idx+1)+\'.png);background-position:0 0;width:'. $smooth_slider['navimg_w'].'px;height:'.$smooth_slider['navimg_ht'].'px;" href="#"></a>\'; 
				}, ';
		}	
		if ($smooth_slider['goto_slide'] == 4) {
			$html.='pagerAnchorBuilder: function(idx, slide) { 
					return \'<a class="sldr\'+(idx+1)+\' smooth_slider_inav smooth_slider_bnav" style="width:'. $smooth_slider['navimg_w'].'px;height:'.$smooth_slider['navimg_ht'].'px;" href="#"></a>\'; 
				}, ';
		}	

		$html.='pause: 1
			,slideExpr: "div.smooth_slideri"
		});';
		
		if ($smooth_slider['goto_slide'] == 2 or $smooth_slider['goto_slide'] == 4 ) { 
			$html.='jQuery("head").append("<style type=\"text/css\">#'.$slider_handle.' .smooth_nav a.smooth_slider_inav.activeSlide{background-position:-'.$smooth_slider['navimg_w'].'px 0 !important;}</style>");';
		}	
		
		if(!empty($smooth_media_queries)){
			$html.='jQuery("head").append("<style type=\"text/css\">'. $smooth_media_queries .'</style>");';
		}
		
	$html.='});';
	//Action hook
	do_action('smooth_global_script',$slider_handle,$smooth_slider);
	$html.='</script><noscript><p><strong>'.$smooth_slider['noscript'].'</strong></p></noscript>';
	
	$html.='<div id="'.$slider_handle.'" class="smooth_slider" '.$smooth_slider_css['smooth_slider'].'>';
	if( $smooth_slider['title_from']=='1' and !empty($slider_id) ) $sldr_title = get_smooth_slider_name($slider_id);
	else $sldr_title = $smooth_slider['title_text']; 
	if(!empty($sldr_title)) { 
		$html.='<div class="sldr_title" '.$smooth_slider_css['sldr_title'].'>'.$sldr_title.'</div> ';
	}
	
	$html.='<div class="smooth_sliderb">'.$r_array[1].'</div>';
	
	if ($smooth_slider['goto_slide'] == 1 or $smooth_slider['goto_slide'] == 2 or $smooth_slider['goto_slide'] == 4 ) { 
		$html.='<div id="'.$slider_handle.'_nav" class="smooth_nav"></div>';
	} 
	if ($smooth_slider['goto_slide'] == 3) { 	 
		$html.='<div id="'.$slider_handle.'_nav" class="smooth_nav">'.$smooth_slider['custom_nav'].'</div>';
	}
	if ($smooth_slider['prev_next'] == 1){
		$html.='<div id="'.$slider_handle.'_next" class="smooth_next" '.$smooth_slider_css['smooth_next'].'></div>
			<div id="'.$slider_handle.'_prev" class="smooth_prev" '.$smooth_slider_css['smooth_prev'].'></div>';
	} 
	if($smooth_slider['support'] == '1'){
		$html.='<div class="sldrlink" '.$smooth_slider_css['sldrlink'].'><a href="http://www.clickonf5.org/smooth-slider" target="_blank" '.$smooth_slider_css['sldrlink_a'].'>Smooth Slider</a></div>';
	} 
	$html.='<div class="sldr_clearlt"></div><div class="sldr_clearrt"></div>
</div>';
	if($echo == '1')  {echo $html; }
	else { return $html; }
}

//Basic Smooth Slider
function carousel_posts_on_slider($max_posts, $offset=0, $slider_id = '1',$out_echo = '1') {
    global $smooth_slider;
	global $wpdb, $table_prefix;
	$table_name = $table_prefix.SLIDER_TABLE;
	$post_table = $table_prefix."posts";
	$rand = $smooth_slider['rand'];
	if(isset($rand) and $rand=='1'){
	  $orderby = 'RAND()';
	}
	else {
	  $orderby = 'a.slide_order ASC, a.date DESC';
	}
	
	$posts = $wpdb->get_results("SELECT b.* FROM 
	                             $table_name a LEFT OUTER JOIN $post_table b 
								 ON a.post_id = b.ID 
								 WHERE (b.post_status = 'publish' OR (b.post_type='attachment' AND b.post_status = 'inherit')) AND a.slider_id = '$slider_id' 
	                             ORDER BY ".$orderby." LIMIT $offset, $max_posts", OBJECT);
	
	$r_array=smooth_global_posts_processor( $posts, $smooth_slider, $out_echo );
	return $r_array;
}

function get_smooth_slider($slider_id='',$offset=0) {
	global $smooth_slider; 
 
	if($smooth_slider['multiple_sliders'] == '1' and is_singular() and (empty($slider_id) or !isset($slider_id))){
	global $post;
	$post_id = $post->ID;
	$slider_id = get_slider_for_the_post($post_id);
	}
	if((!is_singular() or $smooth_slider['multiple_sliders'] != '1') and (empty($slider_id) or !isset($slider_id))){
	  $slider_id = '1';
	}
	if(!empty($slider_id)){
		$r_array = carousel_posts_on_slider($smooth_slider['no_posts'], $offset, $slider_id, '0'); 
		$slider_handle='smooth_slider_'.$slider_id;
		get_global_smooth_slider($slider_handle,$r_array,$slider_id,$echo='1');
	} //end of not empty slider_id condition
}

//For displaying category specific posts in chronologically reverse order, from Smooth Slider 2.3.3
function carousel_posts_on_slider_category($max_posts='5', $catg_slug='', $offset=0, $out_echo = '1') {
    global $smooth_slider;
	global $wpdb, $table_prefix;
	
	if (!empty($catg_slug)) {
		$category = get_category_by_slug($catg_slug); 
		$slider_cat = $category->term_id;
	}
	else {
		$category = get_the_category();
		$slider_cat = $category[0]->cat_ID;
	}
	
	$rand = $smooth_slider['rand'];
	if(isset($rand) and $rand=='1'){
	  $orderby = '&orderby=rand';
	}
	else {
	  $orderby = '';
	}
	//extract posts
	$posts = get_posts('numberposts='.$max_posts.'&offset='.$offset.'&category='.$slider_cat.$orderby);
	
	$r_array=smooth_global_posts_processor( $posts, $smooth_slider, $out_echo );
	return $r_array;
}

function get_smooth_slider_category($catg_slug,$offset=0) {
	global $smooth_slider; 
	$r_array = carousel_posts_on_slider_category($smooth_slider['no_posts'], $catg_slug, $offset, '0'); 
	$slider_handle='smooth_slider_'.$catg_slug;
	get_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='1');
} 

//For displaying recent posts in chronologically reverse order, from Smooth Slider 2.4
function carousel_posts_on_slider_recent($max_posts='5', $offset=0, $out_echo = '1') {
    global $smooth_slider;
	
	$rand = $smooth_slider['rand'];
	if(isset($rand) and $rand=='1'){
	  $orderby = '&orderby=rand';
	}
	else {
	  $orderby = '';
	}
	
	//extract posts data
	$posts = get_posts('numberposts='.$max_posts.'&offset='.$offset.$orderby);
	
	$r_array=smooth_global_posts_processor( $posts, $smooth_slider, $out_echo );
	return $r_array;
}

function get_smooth_slider_recent($offset=0) {
	global $smooth_slider;  
	$r_array = carousel_posts_on_slider_recent($smooth_slider['no_posts'], $offset, '0');
	$slider_handle='smooth_slider_recent';
	get_global_smooth_slider($slider_handle,$r_array,$slider_id='',$echo='1');
}
require_once (dirname (__FILE__) . '/shortcodes_1.php');
require_once (dirname (__FILE__) . '/widgets_1.php');

function smooth_slider_enqueue_scripts() {
	wp_enqueue_script( 'jquery.cycle', smooth_slider_plugin_url( 'js/jcycle.js' ),
		array('jquery'), SMOOTH_SLIDER_VER, false);
}

add_action( 'init', 'smooth_slider_enqueue_scripts' );

function smooth_slider_enqueue_styles() {	
  global $post, $smooth_slider, $wp_registered_widgets,$wp_widget_factory;
  if(is_singular()) {
	$smooth_slider_style = get_post_meta($post->ID,'_smooth_slider_style',true);
	//for compatibility with lower versions of Smooth Slider
	if( empty($smooth_slider_style) ) $smooth_slider_style=get_post_meta($post->ID,'slider_style',true);
	if((is_active_widget(false, false, 'sslider_wid', true) or isset($smooth_slider['shortcode']) ) and (!isset($smooth_slider_style) or empty($smooth_slider_style))){
	   $smooth_slider_style='default';
	}
	if (!isset($smooth_slider_style) or empty($smooth_slider_style) ) {
	     wp_enqueue_style( 'smooth_slider_headcss', smooth_slider_plugin_url( 'css/skins/'.$smooth_slider['stylesheet'].'/style.css' ),false, SMOOTH_SLIDER_VER, 'all');
	}
    else {
	     $smooth_slider_style=str_replace('.css','',$smooth_slider_style);
	     wp_enqueue_style( 'smooth_slider_headcss', smooth_slider_plugin_url( 'css/skins/'.$smooth_slider_style.'/style.css' ),
		false, SMOOTH_SLIDER_VER, 'all');
	}
  }
  else {
    $smooth_slider_style = $smooth_slider['stylesheet'];
	wp_enqueue_style( 'smooth_slider_headcss', smooth_slider_plugin_url( 'css/skins/'.$smooth_slider_style.'/style.css' ),
		false, SMOOTH_SLIDER_VER, 'all');
  }
}
add_action( 'wp', 'smooth_slider_enqueue_styles' );

//admin settings
function smooth_slider_admin_scripts() {
global $smooth_slider;
  if ( is_admin() ){ // admin actions
  // Settings page only
	if ( isset($_GET['page']) && ('smooth-slider-admin' == $_GET['page'] or 'smooth-slider-settings' == $_GET['page'] )  ) {
	wp_register_script('jquery', false, false, false, false);
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery.cycle', smooth_slider_plugin_url( 'js/jcycle.js' ),
		array('jquery'), SMOOTH_SLIDER_VER, false);
	wp_enqueue_script( 'smooth_slider_admin_js', smooth_slider_plugin_url( 'js/admin.js' ),
		array('jquery'), SMOOTH_SLIDER_VER, false); 
	wp_enqueue_style( 'smooth_slider_admin_head_css', smooth_slider_plugin_url( 'css/skins/'.$smooth_slider['stylesheet'].'/style.css' ),
		false, SMOOTH_SLIDER_VER, 'all');
	wp_enqueue_style( 'smooth_slider_admin_css', smooth_slider_plugin_url( 'css/admin.css' ),
		false, SMOOTH_SLIDER_VER, 'all');
	}
  }
}

add_action( 'admin_init', 'smooth_slider_admin_scripts' );

function smooth_slider_admin_head() {
global $smooth_slider;
if ( is_admin() ){ // admin actions
   
  // Sliders page only
    if ( isset($_GET['page']) && 'smooth-slider-admin' == $_GET['page'] ) {
	  $sliders = ss_get_sliders(); 
	?>
		<script type="text/javascript">
            // <![CDATA[
        jQuery(document).ready(function() {
                    jQuery("#slider_tabs").tabs();
				<?php foreach($sliders as $slider){?>
                    jQuery("#sslider_sortable_<?php echo $slider['slider_id'];?>").sortable();
                    jQuery("#sslider_sortable_<?php echo $slider['slider_id'];?>").disableSelection();
			    <?php } ?>
        });
        function confirmRemove()
        {
            var agree=confirm("This will remove selected Posts/Pages from Slider.");
            if (agree)
            return true ;
            else
            return false ;
        }
        function confirmRemoveAll()
        {
            var agree=confirm("Remove all Posts/Pages from Smooth Slider??");
            if (agree)
            return true ;
            else
            return false ;
        }
        function confirmSliderDelete()
        {
            var agree=confirm("Delete this Slider??");
            if (agree)
            return true ;
            else
            return false ;
        }
        function slider_checkform ( form )
        {
          if (form.new_slider_name.value == "") {
            alert( "Please enter the New Slider name." );
            form.new_slider_name.focus();
            return false ;
          }
          return true ;
        }
        </script>
<?php
   } //Sliders page only
   
   // Settings page only
  if ( isset($_GET['page']) && 'smooth-slider-settings' == $_GET['page']  ) { ?>
		<script type="text/javascript">
            // <![CDATA[
        jQuery(document).ready(function() {
                    jQuery("#slider_tabs").tabs();
        });
		</script>
		<?php wp_print_scripts( 'farbtastic' );
		wp_print_styles( 'farbtastic' );
?>
<script type="text/javascript">
	// <![CDATA[
jQuery(document).ready(function() {
		jQuery('#colorbox_1').farbtastic('#color_value_1');
		jQuery('#color_picker_1').click(function () {
           if (jQuery('#colorbox_1').css('display') == "block") {
		      jQuery('#colorbox_1').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_1').fadeIn("slow"); }
        });
		var colorpick_1 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_1 == true) {
    			return; }
				jQuery('#colorbox_1').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_1 = false;
		});
//for second color box
		jQuery('#colorbox_2').farbtastic('#color_value_2');
		jQuery('#color_picker_2').click(function () {
           if (jQuery('#colorbox_2').css('display') == "block") {
		      jQuery('#colorbox_2').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_2').fadeIn("slow"); }
        });
		var colorpick_2 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_2 == true) {
    			return; }
				jQuery('#colorbox_2').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_2 = false;
		});
//for third color box
		jQuery('#colorbox_3').farbtastic('#color_value_3');
		jQuery('#color_picker_3').click(function () {
           if (jQuery('#colorbox_3').css('display') == "block") {
		      jQuery('#colorbox_3').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_3').fadeIn("slow"); }
        });
		var colorpick_3 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_3 == true) {
    			return; }
				jQuery('#colorbox_3').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_3 = false;
		});
//for fourth color box
		jQuery('#colorbox_4').farbtastic('#color_value_4');
		jQuery('#color_picker_4').click(function () {
           if (jQuery('#colorbox_4').css('display') == "block") {
		      jQuery('#colorbox_4').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_4').fadeIn("slow"); }
        });
		var colorpick_4 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_4 == true) {
    			return; }
				jQuery('#colorbox_4').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_4 = false;
		});
//for fifth color box
		jQuery('#colorbox_5').farbtastic('#color_value_5');
		jQuery('#color_picker_5').click(function () {
           if (jQuery('#colorbox_5').css('display') == "block") {
		      jQuery('#colorbox_5').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_5').fadeIn("slow"); }
        });
		var colorpick_5 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_5 == true) {
    			return; }
				jQuery('#colorbox_5').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_5 = false;
		});
//for sixth color box
		jQuery('#colorbox_6').farbtastic('#color_value_6');
		jQuery('#color_picker_6').click(function () {
           if (jQuery('#colorbox_6').css('display') == "block") {
		      jQuery('#colorbox_6').fadeOut("slow"); }
		   else {
		      jQuery('#colorbox_6').fadeIn("slow"); }
        });
		var colorpick_6 = false;
		jQuery(document).mousedown(function(){
		    if (colorpick_6 == true) {
    			return; }
				jQuery('#colorbox_6').fadeOut("slow");
		});
		jQuery(document).mouseup(function(){
		    colorpick_6 = false;
		});
		jQuery('#sldr_close').click(function () {
			jQuery('#sldr_message').fadeOut("slow");
		});
});
</script>
<style type="text/css">
.color-picker-wrap {
		position: absolute;
 		display: none; 
		background: #fff;
		border: 3px solid #ccc;
		padding: 3px;
		z-index: 1000;
	}
#sldr_message {background-color:#FEF7DA;clear:both;width:72%;}
#sldr_close {float:right;} 
</style>
<?php
   } //for smooth slider option page
 }//only for admin
}
add_action('admin_head', 'smooth_slider_admin_head');

//get inline css with style attribute attached
function smooth_get_inline_css($echo='0'){
    global $smooth_slider;
	
	global $post;
	if(is_singular()) {	
		$smooth_slider_style = get_post_meta($post->ID,'_smooth_slider_style',true);
		//for compatibility with lower versions of Smooth Slider
		if( empty($smooth_slider_style) ) $smooth_slider_style=get_post_meta($post->ID,'slider_style',true);
	}
	if((is_singular() and ($smooth_slider_style == 'default' or empty($smooth_slider_style) or !$smooth_slider_style)) or (!is_singular() and $smooth_slider['stylesheet'] == 'default')  )	{ $default=true; }
	else{ $default=false;}
	
	$smooth_slider_css=array();
	if($default){
		$style_start= ($echo=='0') ? 'style="':'';
		$style_end= ($echo=='0') ? '"':'';
	//smooth_slider
		$smooth_slider_css['smooth_slider']=$style_start.'width:'.$smooth_slider['width'].'px;height:'.$smooth_slider['height'].'px;background-color:'. ( ($smooth_slider['bg'] == '1') ? "transparent" : $smooth_slider['bg_color'] ) .';border:'. $smooth_slider['border'].'px solid '.$smooth_slider['brcolor'].';'.$style_end;
		
		if ($smooth_slider['title_fstyle'] == "bold" or $smooth_slider['title_fstyle'] == "bold italic" ){$slider_title_font = "bold";} else { $slider_title_font = "normal"; }
		if ($smooth_slider['title_fstyle'] == "italic" or $smooth_slider['title_fstyle'] == "bold italic" ){$slider_title_style = "italic";} else {$slider_title_style = "normal";}
	//sldr_title	
		$smooth_slider_css['sldr_title']=$style_start.'font-family:'.$smooth_slider['title_font'].', Arial, Helvetica, sans-serif;font-size:'. $smooth_slider['title_fsize'].'px;font-weight:'.$slider_title_font.';font-style:'.$slider_title_style.';color:'.$smooth_slider['title_fcolor'].';'.$style_end;

		if ($smooth_slider['bg'] == '1') { $smooth_slideri_bg = "transparent";} else { $smooth_slideri_bg = $smooth_slider['bg_color']; }
	//smooth_slideri
		$smooth_slider_css['smooth_slideri']=$style_start.'width:'. ( ($smooth_slider['prev_next'] == 1) ? ( $smooth_slider['width'] - 48 ): $smooth_slider['width'] ) .'px;margin:0px '. ( ($smooth_slider['prev_next'] == 1) ? "24": "0" ) .'px 0px '. ( ($smooth_slider['prev_next'] == 1) ? "24": "0" ) .'px;'.$style_end;
		
		if ($smooth_slider['ptitle_fstyle'] == "bold" or $smooth_slider['ptitle_fstyle'] == "bold italic" ){$ptitle_fweight = "bold";} else {$ptitle_fweight = "normal";}
		if ($smooth_slider['ptitle_fstyle'] == "italic" or $smooth_slider['ptitle_fstyle'] == "bold italic"){$ptitle_fstyle = "italic";} else {$ptitle_fstyle = "normal";}
	//smooth_slider_h2
		$smooth_slider_css['smooth_slider_h2']=$style_start.'clear:none;line-height:'. ($smooth_slider['ptitle_fsize'] + 3) .'px;font-family:'. $smooth_slider['ptitle_font'].';font-size:'.$smooth_slider['ptitle_fsize'].'px;font-weight:'.$ptitle_fweight.';font-style:'.$ptitle_fstyle.';color:'.$smooth_slider['ptitle_fcolor'].';margin:0 0 5px 0;'.$style_end;
		
	//smooth_slider_h2 a
		$smooth_slider_css['smooth_slider_h2_a']=$style_start.'color:'.$smooth_slider['ptitle_fcolor'].';font-size:'.$smooth_slider['ptitle_fsize'].'px;font-weight:'.$ptitle_fweight.';font-style:'.$ptitle_fstyle.';'.$style_end;
	
		if ($smooth_slider['content_fstyle'] == "bold" or $smooth_slider['content_fstyle'] == "bold italic" ){$content_fweight= "bold";} else {$content_fweight= "normal";}
		if ($smooth_slider['content_fstyle']=="italic" or $smooth_slider['content_fstyle'] == "bold italic"){$content_fstyle= "italic";} else {$content_fstyle= "normal";}
	//smooth_slider_span
		$smooth_slider_css['smooth_slider_span']=$style_start.'font-family:'.$smooth_slider['content_font'].';font-size:'.$smooth_slider['content_fsize'].'px;font-weight:'.$content_fweight.';font-style:'.$content_fstyle.';color:'. $smooth_slider['content_fcolor'].';'.$style_end;
		
	//
		if($smooth_slider['img_align'] == "left") {$thumb_margin_right= "10";} else {$thumb_margin_right= "0";}
		if($smooth_slider['img_align'] == "right") {$thumb_margin_left = "10";} else {$thumb_margin_left = "0";}
		if($smooth_slider['img_size'] == '1'){ $thumb_width= 'width:'. $smooth_slider['img_width'].'px;';} else{$thumb_width='';}
	//smooth_slider_thumbnail
		$smooth_slider_css['smooth_slider_thumbnail']=$style_start.'float:'.$smooth_slider['img_align'].';margin:0 '.$thumb_margin_right.'px 0 '.$thumb_margin_left.'px;max-height:'.$smooth_slider['img_height'].'px;border:'.$smooth_slider['img_border'].'px solid '.$smooth_slider['img_brcolor'].';'.$thumb_width.$style_end;
	
	//smooth_slider_p_more
		$smooth_slider_css['smooth_slider_p_more']=$style_start.'color:'.$smooth_slider['ptitle_fcolor'].';font-family:'.$smooth_slider['content_font'].';font-size:'.$smooth_slider['content_fsize'].'px;'.$style_end;
		
		$smooth_slider_css['sldrlink']=$style_start.'padding-right:'. ( ($smooth_slider['prev_next'] == 1) ? "10" : "0" ) .'px;"';
		$smooth_slider_css['sldrlink_a']='style="color:'.$smooth_slider['content_fcolor'].' !important;'.$style_end;
	
	}
	return $smooth_slider_css;
}
function smooth_slider_css() {
global $smooth_slider;
$css=$smooth_slider['css'];
if($css and !empty($css)){?>
 <style type="text/css"><?php echo $css;?></style>
<?php }
}
add_action('wp_head', 'smooth_slider_css');
add_action('admin_head', 'smooth_slider_css');
?>