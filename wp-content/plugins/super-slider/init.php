<?php
/*
Plugin Name: SUPER RESPONSIVE SLIDER
Plugin URI: http://www.extendyourweb.com/wordpress/super-slider
Description: Plugin that lets you create a slider very easy and with spectacular results. Multiple configurations and image management simple. You can create multiple sliders and use them on your pages, posts, as a widget or inserting them directly as HTML code. Use and admin in Settings -> Super Slider. <a href="options-general.php?page=super">SUPER SLIDER ADMIN</a>
Version: 1.3
Author: Webpsilon S.C.P.
Author URI: http://www.extendyourweb.com/wordpress/

Copyright 2013  Webpsilon S.C.P.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
*/



function getYTidsuper($ytURL) {
#
 
#
$ytvIDlen = 11; // This is the length of YouTube's video IDs
#
 
#
// The ID string starts after "v=", which is usually right after
#
// "youtube.com/watch?" in the URL
#
$idStarts = strpos($ytURL, "?v=");
#
 
#
// In case the "v=" is NOT right after the "?" (not likely, but I like to keep my
#
// bases covered), it will be after an "&":
#
if($idStarts === FALSE)
#
$idStarts = strpos($ytURL, "&v=");
#
// If still FALSE, URL doesn't have a vid ID
#
if($idStarts === FALSE)
#
die("YouTube video ID not found. Please double-check your URL.");
#
 
#
// Offset the start location to match the beginning of the ID string
#
$idStarts +=3;
#
 
#
// Get the ID string and return it
#
$ytvID = substr($ytURL, $idStarts, $ytvIDlen);
#
 
#
return $ytvID;
#
 
#
}



function super_enqueue_scripts() { 

  

 }



function super($content){
	
	
	$content = preg_replace_callback("/\[super ([^]]*)\/\]/i", "super_render2", $content);
	return $content;
	
}

function super_render2($tag_string){
	return super_render($tag_string, "");
}

function super_render($tag_string, $instance){
$contador=rand(9, 9999999);

$widthloading="48"; // Set if change loading image

global $wpdb; 	
$table_name = $wpdb->prefix . "super";


if(isset($tag_string[1])) {
	
	
	
	$auxi1=str_replace(" ", "", $tag_string[1]);
	
	}

else {
	
	
	
	$auxi1 = empty($instance['title']) ? '&nbsp;' : apply_filters('widget_title', $instance['title']);
	
	}


	
	
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );

	if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	
	$conta=0;
$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;



 require_once 'Mobile_Detect.php';
 $detect = new Mobile_Detect;
 $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
 
 if($deviceType=='phone') {
	 
	 $width = $myrows[$conta]->thumbnail_border;
$height = $myrows[$conta]->font;
	 
 }

if($deviceType=='tablet') {
	 
	 $width = $myrows[$conta]->color1;
$height = $myrows[$conta]->color2;
	 
 }



if(eregi("%", $width)) $width=900; 

$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



$total = $myrows[$conta]->number_thumbnails;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

if($color3=="FCFFED") $color3=10;

$time = $myrows[$conta]->time;

$animation = $myrows[$conta]->animation;

$mode = $myrows[$conta]->mode;

$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;


/*

else {
$width = empty($instance['width']) ? '&nbsp;' : apply_filters('widget_width', $instance['width']);
$height = empty($instance['height']) ? '&nbsp;' : apply_filters('widget_height', $instance['height']);
$values = empty($instance['values']) ? '&nbsp;' : apply_filters('widget_values', $instance['values']);
$twidth = empty($instance['width_thumbnail']) ? '&nbsp;' : apply_filters('widget_width_thumbnail', $instance['width_thumbnail']);
$theight = empty($instance['height_thumbnail']) ? '&nbsp;' : apply_filters('widget_height_thumbnail', $instance['height_thumbnail']);


$total = empty($instance['number_thumbnails']) ? '&nbsp;' : apply_filters('widget_number_thumbnails', $instance['number_thumbnails']);

$border = empty($instance['border']) ? '&nbsp;' : apply_filters('widget_border', $instance['border']);
$round = empty($instance['round']) ? '&nbsp;' : apply_filters('widget_round', $instance['round']);
$tborder = empty($instance['thumbnail_border']) ? '&nbsp;' : apply_filters('widget_thumbnail_border', $instance['thumbnail_border']);
$thumbnail_round = empty($instance['thumbnail_round']) ? '&nbsp;' : apply_filters('widget_thumbnail_round', $instance['thumbnail_round']);

$sizetitle = empty($instance['sizetitle']) ? '&nbsp;' : apply_filters('widget_sizetitle', $instance['sizetitle']);
$sizedescription = empty($instance['sizedescription']) ? '&nbsp;' : apply_filters('widget_sizedescription', $instance['sizedescription']);
$sizethumbnail = empty($instance['sizethumbnail']) ? '&nbsp;' : apply_filters('widget_sizethumbnail', $instance['sizethumbnail']);
$font = empty($instance['font']) ? '&nbsp;' : apply_filters('widget_font', $instance['font']);
$color1 = empty($instance['color1']) ? '&nbsp;' : apply_filters('widget_color1', $instance['color1']);
$color2 = empty($instance['color2']) ? '&nbsp;' : apply_filters('widget_color2', $instance['color2']);
$color3 = empty($instance['color3']) ? '&nbsp;' : apply_filters('widget_color3', $instance['color3']);

$time = empty($instance['time']) ? '&nbsp;' : apply_filters('widget_time', $instance['time']);
$animation = empty($instance['animation']) ? '&nbsp;' : apply_filters('widget_animation', $instance['animation']);
$mode = empty($instance['mode']) ? '&nbsp;' : apply_filters('widget_mode', $instance['mode']);


}

*/
$site_url = get_option( 'siteurl' );
$firstisuperimage="";
$textovid="";
$mobpag=0;

$heightimage=round(((100-$number_thumbnails)*$height)/100);
$heightthumb=round((($number_thumbnails)*$height)/100);
$heightimage-=50;
$mobrow=0;
$mobcolumn=0;
$textovidmob="";
$firstimage="";
$firstlink="";
$firsttitle="";

$imagesslider="";
$captions="";
$sliderscaptions="0";
$items_super="";
$cont=0;
$colorp="#bbb";
global $templatesel;
$templatesel=$time;


/*
if($time==1) {
	   wp_register_style( 'slider-skin1', plugins_url('/skins/dark-room/quake.skin.css', __FILE__) );
   wp_enqueue_style( 'slider-skin1' );
}

if($time==2) {
	
	wp_register_style( 'slider-skin2', plugins_url('/skins/plain/quake.skin.css', __FILE__) );
 	wp_enqueue_style( 'slider-skin2' );

}

if($time==3) {
	
	
   wp_register_style( 'slider-skin3', plugins_url('/skins/violet/quake.skin.css', __FILE__) );
 	wp_enqueue_style( 'slider-skin3' );

}
*/

/*
if($time==1) echo "<link rel='stylesheet' id='slider-skin1-css'  href='http://localhost/wor34/wp-content/plugins/super-slider/skins/dark-room/quake.skin.css?ver=3.4.2' type='text/css' media='all' />";
if($time==2) {
	echo "<link rel='stylesheet' id='slider-skin1-css'  href='http://localhost/wor34/wp-content/plugins/super-slider/skins/plain/quake.skin.css?ver=3.4.2' type='text/css' media='all' />";
	$colorp="#222";
}
if($time==3) echo "<link rel='stylesheet' id='slider-skin1-css'  href='http://localhost/wor34/wp-content/plugins/super-slider/skins/violet/quake.skin.css?ver=3.4.2' type='text/css' media='all' />";

*/
			if($values!="") {
				$items=explode("kh6gfd57hgg", $values);
				$cont=1;
				foreach ($items as &$value) {
					if(count($items)>$cont) {
					$item=explode("t6r4nd", $value);
					
						
						if($item[3]=="1" && $item[2]!="") {
								if($sliderscaptions=="") $sliderscaptions.=$cont;
			else $sliderscaptions.=", ".$cont;	
							$link=$item[4];
							if($link=="") $link="#";
							
							$imagesslider.='<a target="'.$thumbnail_round.'" href="'.$link.'">
                <img src="'.$item[2].'" alt="" />
            </a>';
							if($item[0]!="" || $item[1]!="") {
								
								$captions.='<div class="quake-slider-caption">
                '.$item[0].'
				<p style="font-size:13px; line-height:13px; margin-top:5px; color:'.$colorp.';">
				'.$item[1].'
				</p>
            </div>';
							}
			
			//else 	$captions.='<div class="quake-slider-caption"></div>';		
		
			
						 $cont++;
						}
					}
					 
				}
			}


 $cont--;
 
 if($mobcolumn>0) {
	 
	 while($mobcolumn<$twidth) {
		 
		 $textovidmob.='<td></td>';
		 $mobcolumn++;
	 }
	  $textovidmob.='</tr>';
 }
 
 if($mobrow<$theight) {
							
							 $textovidmob.='</table></div>';
							 $mobpag++;
		}
  

$cantidad=$cont;

$width_thumbs_total=($twidth+1)*($cantidad+1);

$width_windowsuper=round($width-(2*$border));

$widthzone=round($total*($twidth+1));
$paggingtop=10;

$timgwidth="";
//$timgwidth="width: ".($twidth*2)."px;";





$efectos=str_replace("-", "'", $sizethumbnail);

$efectos=str_replace("''", "','", $efectos);

//$efectos=str_replace("'", "\'", $efectos);

$texteffect="";

if($op5==2) $texteffect=', "callback": captionAnimateCallback';
if($op5==3) $texteffect=', "callback": captionAnimateCallback2';
if($op5==4) $texteffect=', "callback": captionAnimateCallback3';
if($op5==5) $texteffect=', "callback": captionAnimateCallback4';
if($op5==6) $texteffect=', "callback": captionAnimateCallback5';

$delaye=$op4+500;
$oris=$op2;
$output='
<!-- SUPER SLIDER -->
<script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery(\'.quake-slider\').quake({
                thumbnails: '.$op1.',
                animationSpeed: '.$op4.',
				swidth: \''.$width.'\',
				sheight:  \''.$height.'\',
				pauseTime: '.$border.',
                applyEffectsRandomly: '.$round.',
                navPlacement: \''.$op3.'\',
                navAlwaysVisible: '.$number_thumbnails.',
				effects: ['.$efectos.'],
                captionOpacity: 0.5,
                captionOrientations: [\''.$op2.'\'],
                rows: '.$theight.',
                cols: '.$twidth.',
				hasNextPrev: '.$sizetitle.',
				border: '.intval($color3).',
				colorborder: \'1c1c1c\',
				colorlinks: \''.$op7.'\',
				titlesize: \'18\',
				roundborder: \'0\',
				shadow: \'0\',
				buttons: \'1\',
				buttonsposition: \'1\',
				navegationb: \'1\',
				pluginurl: \''.$site_url.'/wp-content/plugins/super-slider/skins/dark-room/\',
				captionAnimationSpeed: '.$op4.',
				 captionsSetup: [
                                {
                                    
                                    "slides": ['.$sliderscaptions.']
                                    '.$texteffect.'
                                }
                               ]
 

            });	
			
			function captionAnimateCallback(captionWrapper, captionContainer, orientation) {
				
				 //captionContainer.css({ left: 100}).stop(true).delay("'.$delaye.'").animate({ left: 0}, 500);
				
               captionWrapper.css({ '.$oris.': \'-'.$width.'px\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({'.$oris.': 0, opacity:0.5 }, 1000);
			   
			   var auxi1=captionContainer.css("'.$oris.'");
               captionContainer.css({ '.$oris.': \'-'.$width.'px\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({ '.$oris.': auxi1, opacity:1 }, 1000);
           }
		   function captionAnimateCallback2(captionWrapper, captionContainer, orientation) {
				
               captionWrapper.css({ opacity: \'0\' }).stop(true, true).delay("'.$delaye.'").animate({ opacity: 0.5 }, 500);
               captionContainer.css({ opacity: \'0\' }).stop(true, true).delay("'.$delaye.'").animate({ opacity: 1 }, 500);
           }
		   
			function captionAnimateCallback3(captionWrapper, captionContainer, orientation) {
				
               captionWrapper.css({ top: \'-'.$height.'\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({ top: 0, opacity:0.5 }, 500);
               captionContainer.css({ top: \'-'.$height.'\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({ top: 0, opacity:1 }, 500);
           }
		   function captionAnimateCallback4(captionWrapper, captionContainer, orientation) {
				
               captionWrapper.css({ top: \'+'.$height.'\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({ top: 0, opacity:0.5 }, 500);
               captionContainer.css({ top: \'+'.$height.'\', opacity:0 }).stop(true, true).delay("'.$delaye.'").animate({ top: 0, opacity:1 }, 500);
           }
		   
		   
		   
		   		//calculate and set height based on image width/height ratio and specified line height
				var setsize = function(){
					
					var windowsize = jQuery(window).width();
					
					//if(windowsize<'.str_replace("px", "", $width).') {
					//jQuery(\'.quake-slider\').css(\'maxWidth\', windowsize);
					//}
					//alert("resize");
				};
				setsize();

				//bind setsize function to window resize event
				//jQuery(window).resize(function(){
					//setsize();
					
				//});
		   
		   
		   
        });
		

	
		
    </script>
    
    <div class="quake-slider" style="height: '.$height.'; max-width: '.$width.';" >
        <div class="quake-slider-images" style="display:none;">
            '.$imagesslider.'
        </div>
        <div class="quake-slider-captions" style="display:none;">
            '.$captions.'
        </div>
    </div>
    <!-- /SUPER SLIDER -->
';
	
	if(isset($tag_string[1])) return $output;
	else echo $output;
}


function add_header_super() {
	
	
	
	
  $site_url = get_option( 'siteurl' );
  
  wp_enqueue_script('jquery');
 
 
 
  wp_register_style( 'super-slider', plugins_url('/css/quake.slider.css', __FILE__) );
  wp_enqueue_style( 'super-slider' );
  

  
  
 


  wp_register_style( 'slider-skin2', plugins_url('/skins/dark-room/quake.skin.css', __FILE__) );
  // wp_register_style( 'slider-skin3', plugins_url('/skins/violet/quake.skin.css', __FILE__) );
 

wp_enqueue_style( 'slider-skin2' );
//wp_enqueue_style( 'slider-skin3' );

 wp_enqueue_script('super-slider', plugins_url('', __FILE__).'/js/quake.slider.js', array('jquery'), '1.0', true);
 
  // wp_enqueue_script('demo-slider', plugins_url('', __FILE__).'/js/demo.js', array('jquery'), '1.0', true);
 

}

class wp_super extends WP_Widget {
	function wp_super() {
		$widget_ops = array('classname' => 'wp_super', 'description' => 'Amazing widget for slider. Very easy to use. Select the super slider ID.' );
		$this->WP_Widget('wp_super', 'SUPER SLIDER', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		$site_url = get_option( 'siteurl' );


		
		//$instance['hide_is_admin']

		
		
			echo $before_widget;
			
			echo super_render("", $instance, $templatesel);
			
			
			echo $after_widget;
		
	}
	function update($new_instance, $old_instance) {
		
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		
		
		
		
		
		
		$instance['values']=$values;
		
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'width' => '240', 'height' => '200', 'border' => '10', 'round' => '1', 'width_thumbnail' => '40', 'height_thumbnail' => '50', 'thumbnail_border' => '6', 'thumbnail_round' => '1', 'number_thumbnails' => '4', 'values'=>'', 'sizetitle'=>'18pt Arial', 'sizedescription'=>'12pt Arial', 'sizethumbnail'=>'10pt Arial', 'font'=>'Verdana', 'color1'=>'#333333', 'color2'=>'#888888', 'color3'=>'#dddddd', 'time'=>'5000', 'animation'=>'0', 'mode'=>'0','op1' => '','op2' => '','op3' => '','op4' => '','op5' => '' ) );
		$title = strip_tags($instance['title']);
		$id=rand(0, 99999);
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$border = strip_tags($instance['border']);
		$round = strip_tags($instance['round']);
		$title = strip_tags($instance['title']);
		$width_thumbnail = strip_tags($instance['width_thumbnail']);
		$height_thumbnail = strip_tags($instance['height_thumbnail']);
		$thumbnail_border = strip_tags($instance['thumbnail_border']);
		$thumbnail_round = strip_tags($instance['thumbnail_round']);
		$number_thumbnails = strip_tags($instance['number_thumbnails']);
		$values = strip_tags($instance['values']);
		
		$sizetitle = strip_tags($instance['sizetitle']);
		$sizedescription = strip_tags($instance['sizedescription']);
		$sizethumbnail = strip_tags($instance['sizethumbnail']);
		$font = strip_tags($instance['font']);
		$color1 = strip_tags($instance['color1']);
		$color2 = strip_tags($instance['color2']);
		$color3 = strip_tags($instance['color3']);
		
		$time = strip_tags($instance['time']);
		$animation = strip_tags($instance['animation']);
		$mode = strip_tags($instance['mode']);
		
		$op1 = strip_tags($instance['op1']);
		$op2 = strip_tags($instance['op2']);
		$op3 = strip_tags($instance['op3']);
		$op4 = strip_tags($instance['op4']);
		$op5 = strip_tags($instance['op5']);

		
		
		$borderround[$round] = 'checked';
		$tborderround[$thumbnail_round] = 'checked';
		
		

  global $wpdb; 
	$table_name = $wpdb->prefix . "super";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new slider, from the administration of super slider.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="'.$this->get_field_name('title').'" id="'.$this->get_field_id('title').'">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($title==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.' '.$myrows[$contaa1]->title.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';




echo 'Slider: '.$selector; 

			}
	}
}


function super_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "super";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
		
		
//autos  no existe
$paca=0;
if(empty($re))
{
	

	$paca=1;
	
  $sql = " CREATE TABLE $table_name(
	id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
	title longtext NOT NULL ,
	width longtext NOT NULL ,
	height longtext NOT NULL ,
	border longtext NOT NULL ,
	round longtext NOT NULL ,
	width_thumbnail longtext NOT NULL ,
	height_thumbnail longtext NOT NULL ,
	thumbnail_border longtext NOT NULL ,
	thumbnail_round longtext NOT NULL ,
	number_thumbnails longtext NOT NULL ,
	ivalues longtext NOT NULL ,
	sizetitle longtext NOT NULL ,
	sizedescription longtext NOT NULL ,
	sizethumbnail longtext NOT NULL ,
	font longtext NOT NULL ,
	color1 longtext NOT NULL ,
	color2 longtext NOT NULL ,
	color3 longtext NOT NULL ,
	time longtext NOT NULL ,
	animation longtext NOT NULL ,
	mode longtext NOT NULL ,
	op1 longtext NOT NULL ,
	op2 longtext NOT NULL ,
	op3 longtext NOT NULL ,
	op4 longtext NOT NULL ,
	op5 longtext NOT NULL ,
	
		PRIMARY KEY ( `id` )	
	) ;";
	$wpdb->query($sql);
	
}

$sql = "INSERT INTO $table_name (`title`, `width`, `height`, `border`, `round`, `width_thumbnail`, `height_thumbnail`, `thumbnail_border`, `thumbnail_round`, `number_thumbnails`, `ivalues`, `sizetitle`, `sizedescription`, `sizethumbnail`, `font`, `color1`, `color2`, `color3`, `time`, `animation`, `mode`, `op1`, `op2`, `op3`, `op4`, `op5`) VALUES
('Super slider', '900', '300', '7000', 'false', '12', '4', '900', '_self', 'true', '', 'true', '', '-swirlFadeOut--slideDown--swirlFadeOutRotate--boxFadeIn--fade--slabs--swirlFadeOutRotateFancy--swirlFadeIn-', '300', '900', '300', '10', '', '', '', 'true', 'bottom', 'outside', '1000', '2');";
	
	
	
	
	
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	
	
	
	$total = strip_tags($_POST['total']);


$cont=1;
		
		 $sorter=array();
		while($cont<=$total) {
			
			if(!$_POST['item'.$cont] || $_POST['operation']!="2") {
				$valaux=count($sorter);
				$sorter[$valaux]['order']=$_POST['order'.$cont];
				$sorter[$valaux]['cont']=$cont;
			}
		
			$cont++;
		}


function sortByOrder($a, $b) {
    return $a['order'] - $b['order'];
}

usort($sorter, 'sortByOrder');


/// effects


$cont=1;
		
		 $sortere=array();
$cef=0;
$sizethumbnail="";

while($cef < 48) {
			
			if(isset($_REQUEST["e".$cef])) {
				$valaux=count($sortere);
				$sortere[$valaux]['order']=$_REQUEST['or'.$cef];
				$sortere[$valaux]['cont']=$_REQUEST["e".$cef];
			
			}
			$cef++;
		}

usort($sortere, 'sortByOrder');
$cef=0;
$sizethumbnail="";

while($cef < count($sortere)) {
	
	$sizethumbnail.="-".$sortere[$cef]['cont']."-";
	
	$cef++;
}


//////
		$cont=1;
		
		
		
		
		
		$values="";
		foreach ($sorter as &$value) {
    $cont = $value['cont'];

			if(!$_POST['item'.$cont] || $_POST['operation']!="2") $values.=$_POST['title'.$cont]."t6r4nd".$_POST['description'.$cont]."t6r4nd".$_POST['image'.$cont]."t6r4nd".$_POST['link'.$cont]."t6r4nd".$_POST['video'.$cont]."t6r4nd".$_POST['timage'.$cont]."t6r4nd".$_POST['seo'.$cont]."t6r4nd".$_POST['seol'.$cont]."kh6gfd57hgg";
				
		
			
		}
		
		if($_POST['operation']=="1") {
			$values.="Title image t6r4nd".""."t6r4nd".""."t6r4nd"."1"."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".""."t6r4nd".date("j/n/Y")."kh6gfd57hgg";
			
			$cont++;
		}
		

	
	if($_POST["color3".$_POST['id']]=="FCFFED") $_POST["color3".$_POST['id']]=10;


$sql= "UPDATE $table_name SET `ivalues` = '".$values."', `title` = '".$_POST["stitle".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `round` = '".$_POST["round".$_POST['id']]."', `width_thumbnail` = '".$_POST["twidth".$_POST['id']]."', `height_thumbnail` = '".$_POST["theight".$_POST['id']]."', `thumbnail_border` = '".$_POST["tborder".$_POST['id']]."', `thumbnail_round` = '".$_POST["thumbnail_round".$_POST['id']]."', `number_thumbnails` = '".$_POST["number_thumbnails".$_POST['id']]."', `sizetitle` = '".$_POST["sizetitle".$_POST['id']]."', `sizedescription` = '".$_POST["sizedescription".$_POST['id']]."', `sizethumbnail` = '".$sizethumbnail."', `font` = '".$_POST["font".$_POST['id']]."', `color1` = '".$_POST["color1".$_POST['id']]."', `color2` = '".$_POST["color2".$_POST['id']]."', `color3` = '".$_POST["color3".$_POST['id']]."', `time` = '".$_POST["time".$_POST['id']]."', `border` = '".$_POST["border".$_POST['id']]."', `animation` = '".$_POST["animation".$_POST['id']]."', `mode` = '".$_POST["mode".$_POST['id']]."', `op1` = '".$_POST["op1".$_POST['id']]."', `op2` = '".$_POST["op2".$_POST['id']]."', `op3` = '".$_POST["op3".$_POST['id']]."', `op4` = '".$_POST["op4".$_POST['id']]."', `op5` = '".$_POST["op5".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
		
			
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;



include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$title = $myrows[$conta]->title;
		$width = $myrows[$conta]->width;
$height = $myrows[$conta]->height;
$values =$myrows[$conta]->ivalues;

$twidth = $myrows[$conta]->width_thumbnail;

$theight = $myrows[$conta]->height_thumbnail;

$number_thumbnails = $myrows[$conta]->number_thumbnails;



$total = $myrows[$conta]->total;

$border = $myrows[$conta]->border;
$round = $myrows[$conta]->round;
$tborder = $myrows[$conta]->thumbnail_border;
$thumbnail_round = $myrows[$conta]->thumbnail_round;

$sizetitle = $myrows[$conta]->sizetitle;
$sizedescription = $myrows[$conta]->sizedescription;
$sizethumbnail = $myrows[$conta]->sizethumbnail;
$font = $myrows[$conta]->font;
$color1 = $myrows[$conta]->color1;
$color2 = $myrows[$conta]->color2;

$color3 = $myrows[$conta]->color3;

$animation = $myrows[$conta]->animation;
$time = $myrows[$conta]->time;
$mode = $myrows[$conta]->mode;
$op1 = $myrows[$conta]->op1;
$op2 = $myrows[$conta]->op2;
$op3 = $myrows[$conta]->op3;
$op4 = $myrows[$conta]->op4;
$op5 = $myrows[$conta]->op5;


	include('template/panel.php');			
	$conta++;
	}
include('template/footer.html');
}




function super_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		add_options_page('super', 'SUPER SLIDER', 8, 'super', 'super_panel');
	}
}


if (function_exists('add_action')) {
	add_action('admin_menu', 'super_add_menu'); 
}

add_action('wp_enqueue_scripts', 'add_header_super');

add_filter('the_content', 'super');

add_action( 'widgets_init', create_function('', 'return register_widget("wp_super");') );

?>