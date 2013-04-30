<?php
/*
Plugin Name: Juiz Social Post Sharer
Plugin URI: http://wordpress.org/extend/plugins/juiz-social-post-sharer/
Description: Add buttons after (or before, or both) your posts to allow visitors share your content (includes no JavaScript mode). You can also use <code>juiz_sps($array)</code> template function or <code>[juiz_sps]</code> shortcode. For more informations see the setting page located in <strong>Settings</strong> submenu. <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=P39NJPCWVXGDY&amp;lc=FR&amp;item_name=Juiz%20Social%20Post%20Sharer%20%2d%20WP%20Plugin&amp;item_number=%23wp%2djsps&amp;currency_code=EUR&amp;bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted">Donate</a>
Author: Geoffrey Crofte
Version: 1.2.1
Author URI: http://crofte.fr
License: GPLv2 or later 
*/

/*

Copyright 2012  Geoffrey Crofte  (email : support@creativejuiz.com)

    
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

define( 'JUIZ_SPS_PLUGIN_NAME',	 'Juiz Social Post Sharer' );
define( 'JUIZ_SPS_VERSION',		 '1.2.1' );
define( 'JUIZ_SPS_FILE',		 __FILE__ );
define( 'JUIZ_SPS_DIRNAME',		 basename( dirname( __FILE__ ) ) );
define( 'JUIZ_SPS_PLUGIN_URL',	 plugin_dir_url( __FILE__ ));
define( 'JUIZ_SPS_SLUG',		 'juiz-social-post-sharer' );
define( 'JUIZ_SPS_SETTING_NAME', 'juiz_SPS_settings' );


	
// multilingue

add_action( 'init', 'make_juiz_sps_multilang' );
function make_juiz_sps_multilang() {
	load_plugin_textdomain( 'jsps_lang', false, JUIZ_SPS_DIRNAME.'/languages' );
}

if ( is_admin() || ( defined( 'DOING_AJAX' ) && !DOING_AJAX ) ) {
	
	include('admin/jsps-admin.inc.php');

} // end if is_admin


if (!is_admin()) {

	// Enqueue & deregister
	add_action( 'wp_enqueue_scripts', 'juiz_sps_style_and_script');
	if ( !function_exists('juiz_sps_style_and_script')) {
		function juiz_sps_style_and_script() {
			$juiz_sps_options = get_option( JUIZ_SPS_SETTING_NAME );
			if(is_array($juiz_sps_options)) {
				if( is_numeric( $juiz_sps_options['juiz_sps_style'] ) )
					wp_enqueue_style( 'juiz_sps_styles', JUIZ_SPS_PLUGIN_URL.'css/'.JUIZ_SPS_SLUG.'-'.$juiz_sps_options['juiz_sps_style'].'.min.css', false, false, 'all' );
				if(is_numeric( $juiz_sps_options['juiz_sps_counter'] ) && $juiz_sps_options['juiz_sps_counter'] == 1 )
					wp_enqueue_script( 'juiz_sps_scripts', JUIZ_SPS_PLUGIN_URL.'js/'.JUIZ_SPS_SLUG.'.js', array('jquery'), false, true );
			}
		}
	}


	// template function
	if ( !function_exists('get_juiz_sps')) {
		function get_juiz_sps($networks = array()) {

			global $post;

			$juiz_sps_content = '';
			$juiz_sps_options = get_option( JUIZ_SPS_SETTING_NAME );

			// some markup filters
			$ul = apply_filters('juiz_sps_list_container_tag', 'ul'); 
			$li = apply_filters('juiz_sps_list_of_item_tag', 'li');
			$before_the_sps_content = apply_filters('juiz_sps_before_the_sps', '');
			$after_the_sps_content = apply_filters('juiz_sps_after_the_sps', '');
			$before_the_list = apply_filters('juiz_sps_before_the_list', '');
			$after_the_list = apply_filters('juiz_sps_after_the_list', '');
			$before_first_i = apply_filters('juiz_sps_before_first_item', '');
			$after_last_i = apply_filters('juiz_sps_after_last_item', '');
			$container_classes = apply_filters('juiz_sps_container_classes', '');

			// classes and attributes options
			$juiz_sps_target_link = (isset($juiz_sps_options['juiz_sps_target_link']) && $juiz_sps_options['juiz_sps_target_link']==1) ? ' target="_blank"' : '';
			$juiz_sps_hidden_name_class = (isset($juiz_sps_options['juiz_sps_hide_social_name']) && $juiz_sps_options['juiz_sps_hide_social_name']==1) ? ' juiz_sps_hide_name' : '';
			$juiz_sps_display_where = isset($juiz_sps_options['juiz_sps_display_where']) ? $juiz_sps_options['juiz_sps_display_where'] : '';

			// beginning markup
			$juiz_sps_content  = $before_the_sps_content;
			$juiz_sps_content .= '<div class="juiz_sps_links '.$container_classes.' juiz_sps_displayed_'.$juiz_sps_display_where.'">';
			$juiz_sps_content .= '<p class="screen-reader-text juiz_sps_maybe_hidden_text">'.__('Share the post','jsps_lang').' "'.get_the_title().'"</p>';
			$juiz_sps_content .= $before_the_list;
			$juiz_sps_content .= '<'.$ul.' class="juiz_sps_links_list'.$juiz_sps_hidden_name_class.'">';
			$juiz_sps_content .= $before_first_i;

			// networks to display
			// 2 differents results : using hook (options) or using shortcode/template-function (array())
			$juis_sps_networks = '';

			if ( count($networks) > 0 ) {
				$juis_sps_networks = array();
				foreach($juiz_sps_options['juiz_sps_networks'] as $k => $v) {
					if(in_array($k, $networks)) {
						$juis_sps_networks[$k]=$v;
						$juis_sps_networks[$k][0]=1; //set its visible value to 1 (visible)
					}
				}
			}
			else {
				$juis_sps_networks = $juiz_sps_options['juiz_sps_networks'];
			}

			// each links (come from options or manual array)
			foreach($juis_sps_networks as $k => $v) {
				if( $v[0] == 1 ) {
					
					$api_link = $api_text = '';
					$text = urlencode($post->post_title);
					$url = urlencode(get_permalink());
					$url = apply_filters('juiz_sps_the_permalink', $url);

					$twitter_user = $juiz_sps_options['juiz_sps_twitter_user'] != '' ? "&amp;related=".$juiz_sps_options['juiz_sps_twitter_user']."&amp;via=". $juiz_sps_options['juiz_sps_twitter_user'] : '';

					switch ($k) {
						case "twitter" :
							$api_link = 'https://twitter.com/intent/tweet?source=webclient&amp;original_referer='.$url.'&amp;text='.$text.'&amp;url='.$url.$twitter_user;
							$api_text = __('Share this article on Twitter','jsps_lang');
							break;

						case "facebook" :
							$api_link = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
							$api_text = __('Share this article on Facebook','jsps_lang');
							break;

						case "google" :
							$api_link = 'https://plus.google.com/share?url='.$url;
							$api_text = __('Share this article on Google+','jsps_lang');
							break;

						case "pinterest" :
							$api_link = "javascript:void((function(){var%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());";
							$api_text = __('Share an image of this article on Pinterest','jsps_lang');
							break;

						case "viadeo" :
							$api_link = "http://www.viadeo.com/shareit/share/?url=".$url;
							$api_text = __('Share this article on Viadeo','jsps_lang');
							break;

						case 'linkedin':
							$api_link = "http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=JuizSocialPostSharer&amp;title=".$text."&amp;url=".$url;
							$api_text = __('Share this article on LinkedIn','jsps_lang');
							break;

						case 'digg':
							$api_link = "http://digg.com/submit?phase=2%20&amp;url=".$url."&amp;title=".$text;
							$api_text = __('Share this article on Digg','jsps_lang');
							break;

						case 'stumbleupon':
							$api_link = "http://www.stumbleupon.com/badge/?url=".$url;
							$api_text = __('Share this article on StumbleUpon','jsps_lang');
							break;

						case 'weibo':
							$api_link = "http://service.weibo.com/share/share.php?url=".$url;
							$api_text = __('Share this article on Weibo','jsps_lang');
							break;

						case "mail" :
							$api_link = 'mailto:?subject='.$juiz_sps_options['juiz_sps_mail_subject'].'&amp;body='.$juiz_sps_options['juiz_sps_mail_body']." : ".$url;
							$api_text = __('Share this article with a friend (email)','jsps_lang');
							break;
					}
					$network_name = isset($v[1]) ? $v[1] : $k;
					$juiz_sps_content .= '<'.$li.' class="juiz_sps_item juiz_sps_link_'.$k.'"><a href="'.$api_link.'" rel="nofollow" title="'.$api_text.'"'.$juiz_sps_target_link.'><span class="juiz_sps_icon"></span><span class="juis_sps_network_name">'.$network_name.'</span></a></'.$li.'>';

				}
			}

			$juiz_sps_content .= $after_last_i;
			$juiz_sps_content .= '</'.$ul.'>';
			$juiz_sps_content .= $after_the_list;
			$juiz_sps_content .= '</div>';
			$juiz_sps_content .= $after_the_sps_content;


			// final markup

			return $juiz_sps_content;

		} // end of get_juiz_sps()
	} // end of if exists


	// just a little alias
	if ( !function_exists("juiz_sps")){
		function juiz_sps($networks = array()) {
			echo get_juiz_sps($networks);
		}
	}

	// write buttons in content
	add_action('the_content', 'juiz_sps_print_links', 10, 1);
	add_action('the_excerpt', 'juiz_sps_print_links', 10, 1);
	if ( !function_exists('juiz_sps_print_links')) {
		function juiz_sps_print_links($content) {
			
			$juiz_sps_options = get_option(JUIZ_SPS_SETTING_NAME);

			$jsps_links = get_juiz_sps();

			if( isset($juiz_sps_options['juiz_sps_display_in_types']) ) {

				// write buttons only if administrator checked this type
				$is_all_lists = in_array('all_lists', $juiz_sps_options['juiz_sps_display_in_types']);
				$singular_options = $juiz_sps_options['juiz_sps_display_in_types'];
				unset($singular_options['all_lists']);

				$is_lists_authorized = (is_archive() || is_front_page() || is_search() || is_tag() || is_post_type_archive()) && $is_all_lists ? true : false;
				$is_singular = is_singular($singular_options);

				if ( $is_singular || $is_lists_authorized ) {
					$juiz_sps_display_where = isset($juiz_sps_options['juiz_sps_display_where']) ? $juiz_sps_options['juiz_sps_display_where'] : '';

					if ($juiz_sps_display_where!='') {
						switch ($juiz_sps_display_where) {
							case 'bottom' :
								return $content.$jsps_links;
								break;
							case 'top' :
								return $jsps_links.$content;
								break;
							case 'both' :
								return $jsps_links.$content.$jsps_links;
								break;
							default :
								return $content.$jsps_links;
						}
					}	
					else
						return $content.$jsps_links;
				}
				else 
					return $content;
			}
			else 
				return $content;

		} // end function
	} // end if function exists


	/*
	 * Add shortcode
	 */
	if ( !function_exists('sc_4_jsps')) {

		function sc_4_jsps($atts) {
			
			$atts = shortcode_atts(array(
				'buttons' 	=> 'facebook,twitter,mail,google,stumbleupon,linkedin,pinterest,viadeo,digg,weibo'
			), $atts);
			
			$jsps_networks = preg_split('#[\s+,\s+]#', $atts['buttons']);

			ob_start();
			juiz_sps($jsps_networks); //do an echo
			$jsps_sc_output = ob_get_contents();
			ob_end_clean();
			

			return $jsps_sc_output;
		}
		add_shortcode('juiz_social','sc_4_jsps');
		add_shortcode('juiz_sps'   ,'sc_4_jsps');
	}

} // end of if not admin
