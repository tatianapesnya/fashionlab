<?php
/*
Plugin Name: Social Media Icons Widget
Plugin URI: http://www.arstropica.com
Description: Plugin/Widget for Social Media Icons 
Author: Akin Williams
Version: 1.2.7
Tags: social media, icons, facebook, twitter, Digg, email, flickr, pinterest, googleplus, linkedin, Reddit, rss, social, stumbleupon, vimeo, wordpress, yelp, youtube
Author URI: http://arstropica.com
*/

add_filter ('plugins_url', 'smc_wpcs_correct_domain_in_url');

define('SMC_PLUGIN_FILE', __FILE__);
define('SMC_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('SMC_PLUGIN_PATH', trailingslashit(dirname(__FILE__)));
define('SMC_PLUGIN_DIR', plugins_url('/', __FILE__));

register_deactivation_hook(__FILE__, 'smc_3_unregister');
register_activation_hook(__FILE__, 'smc_3_preregister');
add_action('widgets_init', 'smcWidgetReg');
add_action('plugins_loaded', 'smc_textdomain');
add_action( 'admin_print_styles-widgets.php', 'smc_3_admin_styles' );
add_action( 'admin_print_scripts-widgets.php',  'smc_3_admin_scripts' );
if( is_active_widget( false, false, 'smcwidget' ) ){
    add_action('wp_print_styles', 'smc_3_front_styles');
}

function smc_wpcs_correct_domain_in_url($url){
    if (function_exists('icl_get_home_url')){
        // Use the language switcher object, because that contains WPML settings, and it's available globally
        global $icl_language_switcher;
        // Only make the change if we're using the languages-per-domain option
        if (isset($icl_language_switcher->settings['language_negotiation_type']) && $icl_language_switcher->settings['language_negotiation_type'] == 2)
            return str_replace(untrailingslashit(get_option('home')), untrailingslashit(icl_get_home_url()), $url);
    }
    return $url;
}

function smc_3_preregister() {
    add_option('default_iconset', 'Default');
    add_option('first_save', 1);
}

function smc_3_unregister() {
    delete_option( 'default_iconset' );
    delete_option( 'first_save' );
}

function smc_textdomain(){
    load_plugin_textdomain('SMCWidget', false, basename( dirname( __FILE__ ) ) . '/languages');
}

function smcWidgetReg() {
    register_widget('SMCWidget');
}

function smc_3_admin_styles(){
    $styles_dir = SMC_PLUGIN_DIR . "styles/";
    wp_enqueue_style('smc-admin-style',$styles_dir . 'smc_admin.css', array(), '1.2.5');
}
function smc_3_admin_scripts(){
    $scripts_dir = SMC_PLUGIN_DIR . "js/";
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-livequery',$scripts_dir . 'jquery.livequery.js', array('jquery'));
    wp_enqueue_script('jquery-tooltip',$scripts_dir . 'tooltip.min.js', array('jquery'));
    wp_enqueue_script('smc-admin-script',$scripts_dir . 'smc_admin.js', array('jquery', 'jquery-tooltip'), '1.2.5');
}
function smc_3_front_styles(){
    $styles_dir = SMC_PLUGIN_DIR . "styles/";
    wp_enqueue_style('smc-widget-style',$styles_dir . 'smc_front.css', array(), '1.2.5');
}

class SMCWidget
extends WP_Widget
{
    public function SMCWidget(){

        $widget_ops=array
        (
        'classname'   => 'SMCWidget',
        'description' => 'Social Media Icons'
        );

        $control_ops=array ( 'width' => 300, 'height' => 300 );

        $this->WP_Widget('SMCWidget', __('Social Media Icons', 'SMCWidget'), $widget_ops, $control_ops); 

    }

    function update($new_instance, $old_instance) {
        $first_save = get_option('first_save');
        if ($first_save == 1) $first_save = 0;
        update_option('first_save', $first_save);

        $instance = $old_instance;
        $default_rss = get_bloginfo_rss('rss2_url');
        $iconsetpath = SMC_PLUGIN_PATH . "images/iconset/" . $new_instance['selected_iconset'];
        $icon_array = array();
        foreach (glob($iconsetpath . "/*.png") as $filename) {
            $icon_name = basename($filename, ".png");
            $icon_name_slug = $this->sanitize($icon_name);
            $icon_array[$icon_name_slug] = $icon_name_slug;
        }

        $value_array = array_merge(array(
        "selected_iconset" => "selected_iconset",
        "title" => "title",
        "plural" => "plural",
        "facebook" => "facebook",
        "twitter" => "twitter",
        "rss" => "rss",
        "youtube" => "youtube",
        "contact" => "contact",
        "flickr" => "flickr",
        "linkedin" => "linkedin",
        "delicious" => "delicious",
        "digg" => "digg",
        "buzz" => "buzz",
        "stumbleupon" => "stumbleupon",
        "reddit" => "reddit",
        "vimeo" => "vimeo",
        "yelp" => "yelp",
        "website" => "website",
        "sortable" => "sortable",
        "target" => "target"), $icon_array);
        foreach ( $value_array as $val ) {
            $new_value = isset($new_instance[$val]) ? strip_tags( $new_instance[$val] ) : "";
            $instance[$val] = $new_value;
        }
        return $instance;
    }

    function form( $instance ) {
        global $current_user;
        $author_meta = $this->authorinfo();
        get_currentuserinfo();
        $is_authorized = ((current_user_can('manage_options') || ($current_user->ID == $author_meta->ID)) ? true : false);
        $iconsetpath = SMC_PLUGIN_PATH . "images/iconset/";
        $iconsetfolders = $this->get_dirs($iconsetpath);
        $option_default_iconset = get_option('default_iconset', 'Default');
        $first_save = get_option('first_save');
        $default_rss = ($first_save == 1) ? get_bloginfo_rss('rss2_url') : "";
        $output = "";

        $defaults = array(
        'selected_iconset'  => $option_default_iconset,
        'title'             => 'Connect with me',
        'rss'               => $default_rss,
        'plural'            => false,
        'target'            => '_blank',
        'sortable'          => ''
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        extract( $instance, EXTR_PREFIX_ALL, 'smc');

        # Output the options
        $output .= '<p style="text-align:right;"><label for="' . $this->get_field_name('title') . '">' . __('Title:', 'SMCWidget') . ' <input style="width: 250px;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $smc_title . '" /></label></p>';
        $output .= "<div id='widget_icon_setup'>\n";
        $output .= "<fieldset>\n";
        $output .= "<legend>" . __("Social Media Icons", "SMCWidget") . "</legend>\n";
        $output .= "<div class=\"seltheme_container\">\n";
        $output .= "<label>" . __("Select a Theme", "SMCWidget") . ": \n";
        $output .= "<select name='" . $this->get_field_name('selected_iconset') . "' id='" . $this->get_field_id('selected_iconset') . "' class='smc_theme_select'>\n";
        foreach ($iconsetfolders as $iconfolder)
        {
            $output .= "<OPTION value=\"" . $iconfolder . "\"" . ($iconfolder == $smc_selected_iconset ? " selected=\"selected\"" : "") . ">" . __(ucwords($iconfolder) . " Theme", "SMCWidget") . "</OPTION>";
        }
        $output .= "</select>\n";
        $output .= "</label>\n";
        $output .= "</div>\n";
        $output .= wp_nonce_field('smc-update-widget', 'smc_widget_update', true, false); 
        $output .= "<div class=\"iconset_container\">\n";
        $output .= "<div class=\"smc_utility nopad\">";
        $output .= "<p class=\"helper small fl\"><a id=\"more_info\" href=\"#\">&nbsp;</a></p>\n";
        $output .= "<!-- tooltip element -->\n";
        $output .= "<div class='tooltip'>\n";
        $output .= "<table style='margin:0'>\n";
        $output .= "<tr>\n";
        $output .= "<td colspan='2' class='label'><h3>" . __("Social Media Icon Widget Help", "SMCWidget") . "</h3></td>\n";
        $output .= "</tr>\n";
        $output .= "<tr>\n";
        $output .= "<td>1.</td>\n";
        $output .= "<td>" . __("Select an icon theme from the drop-down menu.", "SMCWidget") . "</td>\n";
        $output .= "</tr>\n";
        $output .= "<tr>\n";
        $output .= "<td>2.</td>\n";
        $output .= "<td>" . __("Click an available icon to reveal the URL text box below.", "SMCWidget") . "</td>\n";
        $output .= "</tr>\n";
        $output .= "<tr>\n";
        $output .= "<td>3.</td>\n";
        $output .= "<td>" . __("Enter a URL in the text field &amp; click save to update the widget.", "SMCWidget") . "</td>\n";
        $output .= "</tr>\n";
        $output .= "<tr>\n";
        $output .= "<td></td>\n";
        $output .= "<td><strong>" . __("Note: Icons without a set url will not be displayed.", "SMCWidget") . "</strong>"  . "</td>\n";
        $output .= "</tr>\n";
        $output .= "</table>\n";
        $output .= "</div>\n";
        $output .= "<p class=\"helper small fl\"><span>" . __("Tip: Click icon to set its URL", "SMCWidget") . "...</span></p>\n";
        $output .= "</div>\n";
        foreach (glob($iconsetpath . $smc_selected_iconset . "/*.png") as $filename) {
            $icon_name = basename($filename, ".png");
            $icon_name_slug = "smc_" . $this->sanitize($icon_name);

            $instance_value = isset(${$icon_name_slug}) ? ${$icon_name_slug} : "";
            $icon_value = (isset($instance_value)) ? $instance_value : "";
            if ($icon_name == "contact") {
                $output .= $this->contact_pages($smc_selected_iconset, $filename, $icon_value);
            } elseif ($icon_name == "googleplus") {
                $icon_value = (empty($icon_value) ? 0 : $icon_value);
                $output .= $this->icon_field($smc_selected_iconset, $filename, $icon_value);
            } else {
                $output .= $this->icon_field($smc_selected_iconset, $filename, $icon_value);
            }
        }
        $output .= "<div class=\"iconset_container_bdr\">\n";
        foreach (glob($iconsetpath . $smc_selected_iconset . "/*.png") as $filename) {
            $icon_name = basename($filename, ".png");
            $output .= $this->icon_image($smc_selected_iconset, $filename);
        }
        $output .= "<input class=\"smc_sortable\" type=\"hidden\" id=\"" . $this->get_field_id( 'sortable' ) . "\" name=\"" . $this->get_field_name( 'sortable' ) . "\" value=\"$smc_sortable\" />";
        $output .= "<input type=\"hidden\" id=\"smc_sortable_init\" value=\"0\" />";
        $output .= "</div>\n";
        $output .= "<div class=\"smc_utility\">";
        $output .= "<label style='margin-top: 5px; display: block; clear: both;'>" . __("Use \"our\" instead of \"my\" in icon text?", "SMCWidget") . "\n";
        $output .= "<input class=\"checkbox\" type=\"checkbox\" " . checked( (bool) $smc_plural, '1', false ) . "id=\"" . $this->get_field_id( 'plural' ) . "\" name=\"" . $this->get_field_name( 'plural' ) . "\" value=\"1\" />";
        $output .= "</label>\n";
        $output .= "<label style='margin-top: 5px; display: block; clear: both;'>" . __("Open links in a new tab or window?", "SMCWidget") . "\n";
        $output .= "<input class=\"checkbox\" type=\"checkbox\" " . checked( $smc_target, '_blank', false ) . "id=\"" . $this->get_field_id( 'target' ) . "\" name=\"" . $this->get_field_name( 'target' ) . "\" value=\"_blank\" />";
        $output .= "</label>\n";
        $output .= "</div>\n";
        $output .= "</div>\n";
        $output .= "</fieldset>\n";
        $output .= "</div>\n";
        $output .= "<script type='text/javascript'>\n";
        $output .= "jQuery(document).ready(function(){\n";
        $output .= "if (typeof jQuery.fn.sortable == 'function'){\n";
        $output .= "jQuery('.iconset_container_bdr').livequery(function(){\n";
        $output .= "jQuery(this).sortable(sOptions).disableSelection();\n";
        $output .= "}); \n";
        $output .= "} \n";
        $output .= "});\n";
        $output .= "</script>\n";

        echo $output;
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', esc_attr($instance['title']));
        echo $before_widget;
        if(!empty($title)) {
            echo $before_title.$title.$after_title;
        }
        $this->get_smcWidget($instance);    
        echo $after_widget;
    }

    function get_SMCWidget($instance){
        $author_meta = $this->authorinfo();
        $default_rss = get_bloginfo_rss('rss2_url');
        $option_default_iconset = get_option('default_iconset', 'Default');
        foreach ($instance as $optionname => $optionvalue) {
            $var_name = "smc_" . $optionname;
            ${$var_name} = $optionvalue;
        }
        $iconsetpath = SMC_PLUGIN_PATH . "images/iconset/";
        if (isset($smc_selected_iconset)) {
            $icon_mask = $iconsetpath . $smc_selected_iconset . "/*.png";
        } else {
            $default_iconset = get_option('default_iconset', 'Default');
            $icon_mask = $iconsetpath . $default_iconset . "/*.png";
        }
        $html="<!-- BEGIN SOCIAL MEDIA CONTACTS -->\n";
        $html.="<div id=\"socialmedia-container\">\n";
        $icon_filenames = array();
        $smc_sortable_all_array = @json_decode(rawurldecode($smc_sortable), true);

        $icon_theme = isset($smc_selected_iconset) ? $smc_selected_iconset : $default_iconset;

        $smc_sortable_array = (isset($smc_sortable_all_array[$icon_theme])) ? $smc_sortable_all_array[$icon_theme] : false;
        if ((empty($smc_sortable_array) === false) && is_array($smc_sortable_array)){
            foreach ($smc_sortable_array as $key => &$val){
                $val = str_replace('icon_container', '', $val);
            }
            foreach (glob($icon_mask) as $filename) {
                $icon_name_slug = $this->sanitize(basename($filename, ".png"));
                $icon_filenames[$icon_name_slug] = $filename;
            }
            foreach($smc_sortable_array as $smc_order => $smc_slug){
                if (isset($icon_filenames[$smc_slug])){
                    $filename = $icon_filenames[$smc_slug];
                    $icon_name = basename($filename, ".png");
                    $icon_name_slug = $this->sanitize($icon_name);
                    $icon_varname = "smc_" . $icon_name_slug;
                    $instance_value = isset(${$icon_varname}) ? ${$icon_varname} : "";
                    $icon_url = (empty($instance_value)) ? false : $instance_value;
                    if ($icon_url) $html .= $this->build_widget_icon($filename, $icon_url, $smc_plural, $smc_target);
                }
            }
        } else {
            foreach (glob($icon_mask) as $filename) {
                $icon_name = basename($filename, ".png");
                $icon_name_slug = $this->sanitize($icon_name);
                $icon_varname = "smc_" . $icon_name_slug;
                $instance_value = isset(${$icon_varname}) ? ${$icon_varname} : "";
                $icon_url = (empty($instance_value)) ? false : $instance_value;
                if ($icon_url) $html .= $this->build_widget_icon($filename, $icon_url, $smc_plural, $smc_target);
            }      
        }
        $html.="</div>\n";
        $html.="<!-- END SOCIAL MEDIA CONTACTS -->\n";
        echo $html;
    }

    function build_widget_icon($icon, $iconlink="", $smc_plural=false, $smc_target='_blank'){
        $icon_info = pathinfo($icon);
        $icon_name = $icon_info['filename'];
        $icon_name_slug = $this->sanitize($icon_info['filename']);
        $icon_theme = basename($icon_info['dirname']);
        $output= "";
        $iconsrc = str_replace(array(rtrim(SMC_PLUGIN_PATH, '/\\'), '\\'), array(rtrim(plugins_url('/', __FILE__), '/\\'), '/'), $icon);
        $src = file_exists($icon) ? $iconsrc : false;
        if ($src){
            if ($icon_name == "contact") {
                $iconlink = get_permalink($iconlink);
                $output.="<div id=\"social-" . $icon_name_slug . "\" class=\"smc_icon_container $icon_theme\"><a href=\"" . $iconlink . "\" title=\"Link to " . (empty($smc_plural) ? "my" : "our") . " " . ucwords($icon_name) . " Page\"><img alt=\"Link to " . (empty($smc_plural) ? "my" : "our") . " " . ucwords($icon_name) . "\" src=\"" . $src . "\" /></a></div>";
            } elseif ($icon_name == "googleplus"){
                if (empty($iconlink) || $iconlink === 0){ 
                    return $output;
                } else {
                    $output .=  "<div id=\"social-" . $icon_name . "\" class='googleplus smc_icon_container " . $icon_theme . "'>\n";
                    $output .=  "<div class='googlehider'>\n";
                    $output .=  "<g:plusone annotation='none'></g:plusone>\n";
                    $output .=  "\n";
                    $output .=  "<!-- Place this render call where appropriate -->\n";
                    $output .=  "<script type='text/javascript'>\n";
                    $output .=  "window.___gcfg = {lang: 'en-GB'};\n";
                    $output .=  "\n";
                    $output .=  "(function() {\n";
                    $output .=  "var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;\n";
                    $output .=  "po.src = 'https://apis.google.com/js/plusone.js';\n";
                    $output .=  "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);\n";
                    $output .=  "})();\n";
                    $output .=  "</script>\n";
                    $output .=  "</div>\n";
                    $output .=  "<img alt=\"" . __("Recommend this page!", "SMCWidget") . "\" title=\"" . __("Recommend this page!", "SMCWidget") . "\" src='" . $src . "' class='mygoogle' />\n";
                    $output .=  "</div>\n";
                }
            } else {
                $iconlink_type = $this->emailORurl($iconlink);
                switch($iconlink_type){
                    case 'email' :
                        $iconlink = $this->addMailTo($iconlink);
                        break;
                    case 'url' :
                        $iconlink = $this->addhttp($iconlink);
                        break;
                    default :
                        $iconlink = $iconlink;
                        break;
                }

                $output.="<div id=\"social-" . $icon_name . "\" class=\"smc_icon_container $icon_theme\"><a href=\"" . $iconlink . "\" " . (($smc_target == '_blank') ? "target=\"_blank\" " : "") . "title=\"" . __("Link to " . (empty($smc_plural) ? "my" : "our") . " " . ucwords($icon_name) . " Page", "SMCWidget") . "\"><img alt=\"" . __("Link to " . (empty($smc_plural) ? "my" : "our") . " " . ucwords($icon_name) . " Page") . "\" src=\"" . $src . "\" /></a></div>";
            }
        }
        return $output;
    }

    function authorinfo(){
        $blog_admin_email = (function_exists('get_blog_option') ? (get_blog_option( $this->current_blog_var->blog_id,'admin_email' )) : get_option('admin_email'));
        $blog_admin_info = get_user_by('email', $blog_admin_email);
        $blog_owner_id = (function_exists('get_user_id_from_string') ? (get_user_id_from_string( $blog_admin_email )) : ($blog_admin_info->ID));
        $authordata = get_userdata( $blog_owner_id );
        return $authordata;
    }

    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }

    function addMailTo($email){
        if (stristr($email, 'mailto:') === false){
            $email = "mailto:" . $email;
        }
        return $email;
    }

    function emailORurl($string) {
        $string = str_replace(array('mailto:', 'http://', 'https://', 'ftp://', 'sftp://', 'ftps://'), array('','','','','',''), strtolower($string));
        if (filter_var($string, FILTER_VALIDATE_EMAIL)){
            return 'email';
        } elseif (filter_var($string, FILTER_VALIDATE_URL)){
            return 'url';
        } elseif (filter_var("http://" . $string, FILTER_VALIDATE_URL)){
            return 'url';
        } else {
            return false;
        }
    }

    function icon_field($directory_name, $icon, $value="", $onclick=""){
        $icon_info = pathinfo($icon);
        $icon_name = $icon_info['filename'];
        $icon_name_slug = $this->sanitize($icon_info['filename']);
        $output = "";
        $disabled = (!file_exists($icon)) ? " disabled\" disabled = \"disabled" : "";
        $onclick = (empty($onclick) ? "" : " onclick =\"if(this.value=='" . $onclick . "'){this.value='';}\"");
        $output.= "<p class=\"icon_url_input\" id=\"" . $icon_name_slug . "_icon_url_input\" style=\"display: none; \">\n";
        $output.= "<label>" . __(($icon_name == "googleplus" ? "Enable " : "") . ucwords($icon_name) . " Icon", "SMCWidget") . ":&nbsp;\n";
        if($icon_name == "googleplus")
            $output.= "<input id=\"smc_profile_url_" . $icon_name_slug . "\" name=\"" . $this->get_field_name($icon_name_slug) . "\" value=\"1\" type=\"checkbox\" class=\"smc_widget_url_input" . $disabled . "\" " . checked($value, "1", false) . " style=\"width: auto!important; margin-top: 5px;\">\n";
        else
            $output.= "<input id=\"smc_profile_url_" . $icon_name_slug . "\" name=\"" . $this->get_field_name($icon_name_slug) . "\" value=\"" . $value . "\" type=\"text\" class=\"smc_widget_url_input" . $disabled . "\"" . $onclick . ">\n";
        $output.= "</label>\n";
        $output.= "</p>\n";
        return $output;
    }

    function icon_image($directory_name, $icon){
        $output = "";
        $icon_info = pathinfo($icon);
        $icon_name = $icon_info['filename'];
        $icon_name_slug = $this->sanitize($icon_info['filename']);
        $iconurl = str_replace(rtrim(SMC_PLUGIN_PATH, '/\\'), rtrim(plugins_url('/', __FILE__), '/\\'), $icon);

        $src = file_exists($icon) ? $iconurl : SMC_PLUGIN_DIR . "images/" . "unknown.png";
        $output .="<div class='icon_container' id='" . $icon_name_slug . "icon_container'>\n";
        $output .="<img alt=\"" . __(ucwords($directory_name) . " Theme: " . ucwords($icon_name) . " Icon", "SMCWidget") . "\" src=\"" . $src . "\" height=\"32\" width=\"32\" />\n";
        $output .="<span class=\"" . (file_exists($icon) ? "" : "icon_disabled") . "\">" . ucwords($icon_name) . "</span>";
        $output .=" <input type=\"hidden\" name=\"" . $directory_name . "_" . $icon_name_slug . "_sort\" class=\"smc_sort\" />\n";
        $output .=" </div>\n";
        return $output;
    }

    function get_dirs($path = '.') {
        $dirs = array();
        foreach (new DirectoryIterator($path) as $file) {
            if ($file->isDir() && !$file->isDot()) {
                $dirs[] = $file->getFilename();
            }
        }
        return $dirs;
    }

    function contact_pages($directory_name, $icon, $value=""){
        $icon_info = pathinfo($icon);
        $icon_name = $icon_info['filename'];
        $disabled = (!file_exists($icon)) ? "disabled\" disabled = \"disabled" : "";
        $smc_pages=get_pages();
        $wp_pages=array(0 => __("Choose a Page", "SMCWidget"));
        $output = "";
        foreach ($smc_pages as $smc_pages_list) { $wp_pages[ "$smc_pages_list->ID" ]=$smc_pages_list->post_title; }
        $output.= "<p class=\"icon_url_input\" id=\"" . $icon_name . "_icon_url_input\" style=\"display: none; \">\n";
        $output.= "<label>" . __(ucwords($icon_name) . " Icon", "SMCWidget") . ":&nbsp;\n";
        $output.= "<select id=\"smc_profile_url_" . $icon_name . "\" name=\"" .  $this->get_field_name('contact') . "\" class=\"smc_widget_url_input " . $disabled . "\">\n";
        foreach ($wp_pages as $pageid => $pagetitle) {
            $output.= "<option value = \"" . (($pageid === 0) ? "" : $pageid) . "\" " . ($value == $pageid ? "selected=\"selected\"" : "") . " class=\"" . $pageid . "\"" . ">" . $pagetitle . "</option>\n";
            #if ($pageid == 'leadgen') $output .= "<option disabled='disabled'>&mdash;</option>\n";
        }        
        $output.= "</select>\n";
        $output.= "</label>\n";
        $output.= "</p>\n";
        return $output;
    }       

    function sanitize($value) {
        if (!@preg_match('/\pL/u', 'a')) {
            $pattern = '/[^a-zA-Z0-9]/';
        } else {
            $pattern = '/[^\p{L}\p{N}]/u';
        }
        return preg_replace($pattern, '', $value);
    }

}
