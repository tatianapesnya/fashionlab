<?php
/*
Plugin Name: Vimeography
Plugin URI: http://vimeography.com
Description: Vimeography is the easiest way to set up a custom Vimeo gallery on your site.
Version: 0.9.3
Author: Dave Kiss
Author URI: http://davekiss.com
License: MIT
*/

if (!function_exists('json_decode'))
	wp_die('Vimeography requires the JSON PHP extension.');

global $wpdb;

$wp_upload_dir = wp_upload_dir();

// Define constants
define( 'VIMEOGRAPHY_URL', plugin_dir_url(__FILE__) );
define( 'VIMEOGRAPHY_PATH', plugin_dir_path(__FILE__) );
define( 'VIMEOGRAPHY_THEME_URL', $wp_upload_dir['baseurl'].'/vimeography-themes/' );
define( 'VIMEOGRAPHY_THEME_PATH', $wp_upload_dir['basedir'].'/vimeography-themes/' );
define( 'VIMEOGRAPHY_ASSETS_URL', $wp_upload_dir['baseurl'].'/vimeography-assets/' );
define( 'VIMEOGRAPHY_ASSETS_PATH', $wp_upload_dir['basedir'].'/vimeography-assets/' );
define( 'VIMEOGRAPHY_BASENAME', plugin_basename( __FILE__ ) );
define( 'VIMEOGRAPHY_VERSION', '0.9.3');
define( 'VIMEOGRAPHY_GALLERY_TABLE', $wpdb->prefix . "vimeography_gallery");
define( 'VIMEOGRAPHY_GALLERY_META_TABLE', $wpdb->prefix . "vimeography_gallery_meta");
define( 'VIMEOGRAPHY_CURRENT_PAGE', basename($_SERVER['PHP_SELF']));

require_once(VIMEOGRAPHY_PATH . 'lib/exception.php');

// Require Mustache.php
if (! class_exists('Mustache'))
	require_once(VIMEOGRAPHY_PATH . '/vendor/mustache/Mustache.php');

class Vimeography
{
	public function __construct()
	{
		add_action( 'init', array(&$this, 'vimeography_init') );
		add_action( 'admin_init', array(&$this, 'vimeography_requires_wordpress_version') );
		add_action( 'admin_init', array(&$this, 'vimeography_check_if_db_exists') );
		add_action( 'init', array(&$this, 'vimeography_move_folders') );
		add_action( 'plugins_loaded', array(&$this, 'vimeography_update_database') );
		add_action( 'admin_menu', array(&$this, 'vimeography_add_menu') );
		add_action( 'do_robots', array(&$this, 'vimeography_block_robots') );

		register_activation_hook( VIMEOGRAPHY_BASENAME, array(&$this, 'vimeography_update_tables') );

		add_filter( 'plugin_action_links', array(&$this, 'vimeography_filter_plugin_actions'), 10, 2 );
		add_shortcode( 'vimeography', array(&$this, 'vimeography_shortcode') );

		// Add shortcode support for widgets
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Check the wordpress version is compatible, and disable plugin if not.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_requires_wordpress_version()
	{
		global $wp_version;
		$plugin_data = get_plugin_data( __FILE__, false );

		if ( version_compare($wp_version, "3.3", "<" ) )
		{
			if( is_plugin_active( VIMEOGRAPHY_BASENAME ) )
			{
				deactivate_plugins( VIMEOGRAPHY_BASENAME );
				wp_die( "'".$plugin_data['Name']."' requires WordPress 3.3 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>." );
			}
		}
	}

	/**
	 * Runs on every page load.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_init()
	{
		require_once(VIMEOGRAPHY_PATH . 'lib/init.php');
		$init = new Vimeography_Init;

		$init->vimeography_register_jquery();
		$init->vimeography_add_gallery_helper();
		$init->vimeography_written_block_robots();

		require_once(VIMEOGRAPHY_PATH . 'lib/ajax.php');
		new Vimeography_Ajax;
	}

	public function vimeography_update_database()
	{
		require_once(VIMEOGRAPHY_PATH . 'lib/database.php');
		$db = new Vimeography_Database;

		$db->vimeography_update_db_to_0_6();
		$db->vimeography_update_db_to_0_7();
		$db->vimeography_update_db_to_0_8();
		$this->vimeography_update_db_version();
	}

	public function vimeography_check_if_db_exists()
	{
		if (get_option('vimeography_db_version') == FALSE)
			$this->vimeography_update_db_version();
	}

	 /**
   * Updates the Vimeography version stored in the database.
   *
   * @access public
   * @return void
   */
  public function vimeography_update_db_version()
  {
    update_option('vimeography_db_version', VIMEOGRAPHY_VERSION);
  }

	/**
	 * Move the defined folders to the defined target path in wp-content/uploads.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_move_folders()
	{
		$this->_move_folder(array('source' => VIMEOGRAPHY_PATH . 'bugsauce/', 'destination' => VIMEOGRAPHY_THEME_PATH.'bugsauce/', 'clear_destination' => true, 'clear_working' => true));
		$this->_move_folder(array('source' => VIMEOGRAPHY_PATH . 'theme-assets/', 'destination' => VIMEOGRAPHY_ASSETS_PATH, 'clear_destination' => true, 'clear_working' => true));

		// Now, check if the .htaccess exists in the VIMEOGRAPHY_THEME_PATH
		if (file_exists(VIMEOGRAPHY_THEME_PATH.'.htaccess'))
		{
			unlink(VIMEOGRAPHY_THEME_PATH.'.htaccess');
		}
		// file_put_contents(VIMEOGRAPHY_THEME_PATH.'.htaccess', "Options All -Indexes\n<FilesMatch \".(htaccess|mustache)$\">\nOrder Allow,Deny\nDeny from all\n</FilesMatch>");
	}

	/**
	 * Add Settings link to "installed plugins" admin page.
	 *
	 * @access public
	 * @param mixed $links
	 * @param mixed $file
	 * @return void
	 */
	public function vimeography_filter_plugin_actions($links, $file)
	{
		if ( $file == VIMEOGRAPHY_BASENAME )
		{
			$settings_link = '<a href="admin.php?page=vimeography-edit-galleries">' . __('Settings') . '</a>';
			if (!in_array($settings_link, $links))
				array_unshift( $links, $settings_link ); // before other links
		}
		return $links;
	}

	/**
	 * Adds a new top level menu to the admin menu.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_add_menu()
	{
		global $submenu;

		add_menu_page( 'Vimeography Page Title', 'Vimeography', 'manage_options', 'vimeography-edit-galleries', '', VIMEOGRAPHY_URL.'media/img/vimeography-icon.png' );
		add_submenu_page( 'vimeography-edit-galleries', 'Edit Galleries', 'Edit Galleries', 'manage_options', 'vimeography-edit-galleries', array(&$this, 'vimeography_render_template' ));
		add_submenu_page( 'vimeography-edit-galleries', 'New Gallery', 'New Gallery', 'manage_options', 'vimeography-new-gallery', array(&$this, 'vimeography_render_template' ));
		add_submenu_page( 'vimeography-edit-galleries', 'My Themes', 'My Themes', 'manage_options', 'vimeography-my-themes', array(&$this, 'vimeography_render_template' ));
		$submenu['vimeography-edit-galleries'][500] = array( 'Buy Themes', 'manage_options' , 'http://vimeography.com/themes' );
		add_submenu_page( 'vimeography-edit-galleries', 'Vimeography Pro', 'Vimeography Pro', 'manage_options', 'vimeography-pro', array(&$this, 'vimeography_render_template' ));
		add_submenu_page( 'vimeography-edit-galleries', 'Help', 'Help', 'manage_options', 'vimeography-help', array(&$this, 'vimeography_render_template' ));
	}

	/**
	 * Renders the admin template for the current page.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_render_template()
	{
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );

		wp_register_style( 'bootstrap', VIMEOGRAPHY_URL.'media/css/bootstrap.min.css');
		wp_register_style( 'bootstrap-responsive', VIMEOGRAPHY_URL.'media/css/bootstrap-responsive.min.css');
		wp_register_style( 'vimeography-admin', VIMEOGRAPHY_URL.'media/css/admin.css');

		wp_register_script( 'bootstrap-transition', VIMEOGRAPHY_URL.'media/js/bootstrap-transition.js');
		wp_register_script( 'bootstrap-alert', VIMEOGRAPHY_URL.'media/js/bootstrap-alert.js');
		wp_register_script( 'vimeography-admin.js', VIMEOGRAPHY_URL.'media/js/admin.js', 'jquery');

		wp_enqueue_style( 'bootstrap');
		wp_enqueue_style( 'bootstrap-responsive');
		wp_enqueue_style( 'vimeography-admin');

		wp_enqueue_script( 'bootstrap-transition');
		wp_enqueue_script( 'bootstrap-alert');
		wp_enqueue_script( 'vimeography-admin.js');

		require_once(VIMEOGRAPHY_PATH . 'lib/admin/base.php');

		switch(current_filter())
		{
			case 'vimeography_page_vimeography-new-gallery':
				require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/gallery/new.php');
				$mustache = new Vimeography_Gallery_New();
				$template = $this->_load_template('gallery/new');
				break;
			case 'toplevel_page_vimeography-edit-galleries':
				if (isset($_GET['id']))
				{
					require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/gallery/edit.php');
					$mustache = new Vimeography_Gallery_Edit();
					$template = $this->_load_template('gallery/edit/layout');
				}
				else
				{
					require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/gallery/list.php');
					$mustache = new Vimeography_Gallery_List();
					$template = $this->_load_template('gallery/list');
				}
				break;
			case 'vimeography_page_vimeography-my-themes':
				require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/theme/list.php');
				$mustache = new Vimeography_Theme_List();
				$template = $this->_load_template('theme/list');
				break;
			case 'vimeography_page_vimeography-pro':
				require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/vimeography/pro.php');
				$mustache = new Vimeography_Pro();
				$template = $this->_load_template('vimeography/pro');
				break;
			case 'vimeography_page_vimeography-help':
				require_once(VIMEOGRAPHY_PATH . 'lib/admin/view/vimeography/help.php');
				$mustache = new Vimeography_Help();
				$template = $this->_load_template('vimeography/help');
				break;
			default:
				wp_die( __('The admin template for "'.current_filter().'" cannot be found.') );
			break;
		}
		echo $mustache->render($template);
	}

	/**
	 * Returns the file contents for the provided mustache template. Common Function.
	 *
	 * @access protected
	 * @param mixed $name
	 * @return void
	 */
	protected function _load_template($name)
	{
		$path = VIMEOGRAPHY_PATH . 'lib/admin/templates/' . $name .'.mustache';
		if (! $result = @file_get_contents($path))
			wp_die('The admin template "'.$name.'" cannot be found.');
		return $result;
	}

	/**
	 * Create tables and define defaults when plugin is activated.
	 *
	 * @access public
	 * @return void
	 */
	public function vimeography_update_tables() {
		global $wpdb;

		delete_option('vimeography_default_settings');
		delete_option('vimeography_advanced_settings');

		add_option('vimeography_advanced_settings', array(
			'active'              => FALSE,
			'client_id'           => '',
			'client_secret'       => '',
			'access_token'        => '',
			'access_token_secret' => '',
		));

		add_option('vimeography_default_settings', array(
			'source_url'     => 'https://vimeo.com/channels/staffpicks/',
			'video_limit'    => 20,
			'featured_video' => '',
			'cache_timeout'  => 3600,
			'theme_name'     => 'bugsauce',
		));

		$sql = 'CREATE TABLE '.VIMEOGRAPHY_GALLERY_TABLE.' (
		id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		title varchar(150) NOT NULL,
		date_created datetime NOT NULL,
		is_active tinyint(1) NOT NULL,
		PRIMARY KEY  (id)
		);
		CREATE TABLE '.VIMEOGRAPHY_GALLERY_META_TABLE.' (
		id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
		gallery_id mediumint(8) unsigned NOT NULL,
		source_url varchar(100) NOT NULL,
		video_limit mediumint(7) NOT NULL,
		featured_video varchar(100) DEFAULT NULL,
		gallery_width varchar(10) DEFAULT NULL,
		cache_timeout mediumint(7) NOT NULL,
		theme_name varchar(50) NOT NULL,
		PRIMARY KEY  (id)
		);
		';

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

	/**
	 * Read the shortcode and return the output.
	 * example:
	 * [vimeography id="1" theme='apple']
	 *
	 * @access public
	 * @param mixed $atts
	 * @return void
	 */
	public function vimeography_shortcode($atts, $content = NULL)
	{

		// Let's get the data for this gallery from the db
		if (intval($atts['id']))
		{
			global $wpdb;
			$gallery_info = $wpdb->get_results('SELECT * from '.VIMEOGRAPHY_GALLERY_META_TABLE.' AS meta JOIN '.VIMEOGRAPHY_GALLERY_TABLE.' AS gallery ON meta.gallery_id = gallery.id WHERE meta.gallery_id = '.$atts['id'].' LIMIT 1;');
		}

		// Get admin panel options
		$default_settings = get_option('vimeography_default_settings');

		$gallery_settings['theme']    = isset($gallery_info[0]->theme_name)     ? $gallery_info[0]->theme_name     : $default_settings['theme_name'];
		$gallery_settings['featured'] = isset($gallery_info[0]->featured_video) ? $gallery_info[0]->featured_video : $default_settings['featured_video'];
		$gallery_settings['source']   = isset($gallery_info[0]->source_url)     ? $gallery_info[0]->source_url     : $default_settings['source_url'];
		$gallery_settings['limit']    = isset($gallery_info[0]->video_limit)    ? $gallery_info[0]->video_limit    : $default_settings['video_limit'];
		$gallery_settings['cache']    = isset($gallery_info[0]->cache_timeout)  ? $gallery_info[0]->cache_timeout  : $default_settings['cache_timeout'];
		$gallery_settings['width']    = isset($gallery_info[0]->gallery_width)  ? $gallery_info[0]->gallery_width  : '';

		// Get shortcode attributes
		$settings    = shortcode_atts( array(
			'id'       => '',
			'theme'    => $gallery_settings['theme'],
			'featured' => $gallery_settings['featured'],
			'source'   => $gallery_settings['source'],
			'limit'    => $gallery_settings['limit'],
			'cache'    => $gallery_settings['cache'],
			'width'    => $gallery_settings['width'],
		), $atts );

		if (!empty($settings['width']))
		{
			preg_match('/(\d*)(px|%?)/', $settings['width'], $matches);
			// If a number value is set...
			if (!empty($matches[1]))
			{
				// If a '%' or 'px' is set...
				if (!empty($matches[2]))
				{
					// Accept the valid matching string
					$settings['width'] = $matches[0];
				}
				else
				{
					// Append a 'px' value to the matching number
					$settings['width'] = $matches[1] . 'px';
				}
			}
			else
			{
				// Not a valid width
				$settings['width'] = '';
			}
		}

		try
		{
			if ( file_exists( VIMEOGRAPHY_PATH . 'lib/pro/core.php' ) )
			{
				require_once(VIMEOGRAPHY_PATH . 'lib/pro/core.php');
	    	$vimeography = Vimeography_Pro_Core::factory('videos', $settings);
			}
			else
			{
				require_once(VIMEOGRAPHY_PATH . 'lib/core.php');
	    	$vimeography = Vimeography_Core::factory('videos', $settings);
			}

			require_once(VIMEOGRAPHY_PATH . 'lib/cache.php');
	    $cache = new Vimeography_Cache;

	    $settings_check = $settings;
	    $unused_id = array_shift($settings_check);

			// If the shortcode settings are equal to the DB settings, the
			// gallery isn't being overloaded by shortcode, so proceed to render
			// the standard cache.

			if ($settings_check == $gallery_settings)
			{
				// If the cache isn't set,
				if (($vimeography_data = $cache->get($settings['id'])) === FALSE)
				{
			    // make the request,
			    $vimeography_data = $vimeography->get('videos');

			    // and cache the results.
			    if ($settings['cache'] != 0)
			    	$transient = $cache->set($settings['id'], $vimeography_data, $settings['cache']);
				}
			}
			// Otherwise, let's see if a cache exists for these particular
			// shortcode settings, and if not, we'll create one using an
			// alternate cache name generated using an md5 of the serialized
			// shortcode combined with the gallery id.
			else
			{
				$cache_hash = $settings['id'].'_'.md5(serialize($settings_check));

				// The `option_name` column has a limit of 64 characters,
				// so we need to shorten the generated hash.
				$cache_hash = substr($cache_hash, 0, -10);

				// If the cache isn't set,
				if (($vimeography_data = $cache->get($cache_hash)) === FALSE)
				{
			    // make the request,
			    $vimeography_data = $vimeography->get('videos');

			    // and cache the results.
			    if ($settings['cache'] != 0)
            $transient = $cache->set($cache_hash, $vimeography_data, $settings['cache']);
				}
			}

			// Render that ish.
			return $vimeography->render($vimeography_data);
		}
		catch (Vimeography_Exception $e)
		{
			return "Vimeography error: ".$e->getMessage();
		}
	}

	/**
	 * Adds the VIMEOGRAPHY_THEME_URL and VIMEOGRAPHY_ASSETS_URL to the virtual robots.txt restricted list.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function vimeography_block_robots()
	{
		$blocked_theme_path = str_ireplace(site_url(), '', VIMEOGRAPHY_THEME_URL);
		$blocked_asset_path = str_ireplace(site_url(), '', VIMEOGRAPHY_ASSETS_URL);
		echo 'Disallow: '.$blocked_theme_path."\n";
		echo 'Disallow: '.$blocked_asset_path."\n";
	}

  /**
   * Moves the given folder to the given destination.
   *
   * @access private
   * @param array $args (default: array())
   * @return void
   */
  private function _move_folder($args = array())
  {
  	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  	// Replaces simple `WP_Filesystem();` call to prevent any extraction issues
  	// @link http://wpquestions.com/question/show/id/2685
  	if (! function_exists('__return_direct'))
  	{
  		function __return_direct() { return 'direct'; }
  	}

  	add_filter( 'filesystem_method', '__return_direct' );
  	WP_Filesystem();
  	remove_filter( 'filesystem_method', '__return_direct' );

      global $wp_filesystem;
  	$defaults = array( 'source' => '', 'destination' => '', //Please always pass these
  					'clear_destination' => false, 'clear_working' => false,
  					'hook_extra' => array());

  	$args = wp_parse_args($args, $defaults);
  	extract($args);

  	@set_time_limit( 300 );

  	if ( empty($source) || empty($destination) )
  		return new WP_Error('bad_request', 'bad request.');

  	// $this->skin->feedback('installing_package');

  	//Retain the Original source and destinations
  	$remote_source = $source;
  	$local_destination = $destination;

  	if (! $wp_filesystem->dirlist($remote_source)) return FALSE;

  	$source_files = array_keys( $wp_filesystem->dirlist($remote_source) );
  	$remote_destination = $wp_filesystem->find_folder($local_destination);

  	//Locate which directory to copy to the new folder, This is based on the actual folder holding the files.
  	if ( 1 == count($source_files) && $wp_filesystem->is_dir( trailingslashit($source) . $source_files[0] . '/') ) //Only one folder? Then we want its contents.
  		$source = trailingslashit($source) . trailingslashit($source_files[0]);
  	elseif ( count($source_files) == 0 )
  		return new WP_Error( 'incompatible_archive', 'incompatible archive string', __( 'The plugin contains no files.' ) ); //There are no files?
  	else //Its only a single file, The upgrader will use the foldername of this file as the destination folder. foldername is based on zip filename.
  		$source = trailingslashit($source);

  	//Has the source location changed? If so, we need a new source_files list.
  	if ( $source !== $remote_source )
  		$source_files = array_keys( $wp_filesystem->dirlist($source) );

  	if ( $clear_destination ) {
  		//We're going to clear the destination if there's something there
  		//$this->skin->feedback('remove_old');
  		$removed = true;
  		if ( $wp_filesystem->exists($remote_destination) )
  			$removed = $wp_filesystem->delete($remote_destination, true);
  		if ( is_wp_error($removed) )
  			return $removed;
  		else if ( ! $removed )
  			return new WP_Error('remove_old_failed', 'couldnt remove old');
  	} elseif ( $wp_filesystem->exists($remote_destination) ) {
  		//If we're not clearing the destination folder and something exists there already, Bail.
  		//But first check to see if there are actually any files in the folder.
  		$_files = $wp_filesystem->dirlist($remote_destination);
  		if ( ! empty($_files) ) {
  			$wp_filesystem->delete($remote_source, true); //Clear out the source files.
  			return new WP_Error('folder_exists', 'folder exists string', $remote_destination );
  		}
  	}

  	//Create themes folder, if needed
  	if ( !$wp_filesystem->exists(VIMEOGRAPHY_THEME_PATH) )
  		if ( !$wp_filesystem->mkdir(VIMEOGRAPHY_THEME_PATH, FS_CHMOD_DIR) )
  			return new WP_Error('mkdir_failed', 'mkdir failer string', $remote_destination);

  	//Create destination if needed
  	if ( !$wp_filesystem->exists($remote_destination) )
  		if ( !$wp_filesystem->mkdir($remote_destination, FS_CHMOD_DIR) )
  			return new WP_Error('mkdir_failed', 'mkdir failer string', $remote_destination);

  	// Copy new version of item into place.
  	$result = copy_dir($source, $remote_destination);

  	if ( is_wp_error($result) ) {
  		if ( $clear_working )
  			$wp_filesystem->delete($remote_source, true);
  		return $result;
  	}

  	//Clear the Working folder?
  	if ( $clear_working )
  		$wp_filesystem->delete($remote_source, true);

  	$destination_name = basename( str_replace($local_destination, '', $destination) );
  	if ( '.' == $destination_name )
  		$destination_name = '';

  	$result = compact('local_source', 'source', 'source_name', 'source_files', 'destination', 'destination_name', 'local_destination', 'remote_destination', 'clear_destination', 'delete_source_dir');

  	//Bombard the calling function will all the info which we've just used.
  	return $result;

  }

}

new Vimeography;