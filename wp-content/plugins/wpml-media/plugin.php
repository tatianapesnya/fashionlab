<?php 
/*
Plugin Name: WPML Media
Plugin URI: http://wpml.org/
Description: Add multilingual support for Media files
Author: ICanLocalize
Author URI: http://wpml.org
Version: 1.3
*/

if(defined('WPML_MEDIA_VERSION')) return;

define('WPML_MEDIA_VERSION', '1.3');
define('WPML_MEDIA_PATH', dirname(__FILE__));

require WPML_MEDIA_PATH . '/inc/constants.inc';
require WPML_MEDIA_PATH . '/inc/wpml_media.class.php';

$WPML_media = new WPML_media();
?>
