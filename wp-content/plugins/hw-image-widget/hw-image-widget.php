<?php
/*
Plugin Name: HW Image Widget
Plugin URI: http://wordpress.org/extend/plugins/hw-image-widget/
Description: Image widget that will allow you to choose responsive or fixed sized behavior. Includes TinyMCE rich text editing of the text description. A custom HTML-template for the widget can be created in the active theme folder (a default template will be used if this custom template does not exist).
Author: H&aring;kan Wennerberg
Version: 1.4
Author URI: http://wpnotebook.wordpress.com/
License: LGPLv3 - http://www.gnu.org/licenses/lgpl-3.0.html
*/

function hwim_action_admin_enqueue_scripts() {
	if ( stristr( $_SERVER['REQUEST_URI'], 'widgets.php' ) ) {
		wp_enqueue_script(
			'hw_image_widget_back_end',
			plugins_url( 'js/back-end.js', __FILE__ ),
			array( 'jquery' ),
			'1.4'
		);
		// Allow disable loading of Twitter bootstrap in case of conflict.
		if ( apply_filters( 'hwim_load_bootstrap', true ) === true ) {
			wp_enqueue_script(
				'hwim_bootstrap',
				plugins_url( 'js/bootstrap.min.js', __FILE__ ),
				array( 'jquery' ),
				'1.4'
			);
			wp_enqueue_style(
				'hwim_bootstrap',
				plugins_url( 'css/bootstrap.min.css', __FILE__ ),
				array(),
				'1.4'
			);
		}
		add_thickbox();
	}
}
add_action( 'admin_enqueue_scripts', 'hwim_action_admin_enqueue_scripts' );

function hwim_action_admin_footer() {
	if ( stristr( $_SERVER['REQUEST_URI'], 'widgets.php') ) {
		HW_Image_Widget::echoEditor();
	}
}
add_action( 'admin_footer', 'hwim_action_admin_footer' );

function hwim_action_plugins_loaded() {
	load_plugin_textdomain( 'hwim', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'hwim_action_plugins_loaded' );

function hwim_action_widgets_init() {
	register_widget( 'HW_Image_Widget' );
}
add_action( 'widgets_init', 'hwim_action_widgets_init' );

function hwim_filter_image_send_to_editor( $html, $id, $caption, $title, $align, $url, $size, $alt ) {
	$img = wp_get_attachment_image_src( $id, $size, false );
	$html = str_replace(
			'<img ',
			'<img data-hwim-w="' . $img[1] . '" data-hwim-h="' . $img[2] . '" data-hwim-title="' . esc_attr( $title ) . '" ',
			$html );
	return $html;
}
add_filter( 'image_send_to_editor', 'hwim_filter_image_send_to_editor', 1, 8 );

class HW_Image_Widget extends \WP_Widget {

	protected $widget_id = 'hwim';
	protected static $tb = false;

	/**
	 * Default constructor.
	 */
	function __construct() {
		$widget_ops = array( 'description' => __( 'Image widget to display, describe and possibly link an image.', 'hwim' ) );
		parent::__construct( $this->widget_id, 'HW Image Widget', $widget_ops );
	}

	static function echoEditor() {
		$tinymce_settings['media_buttons'] = '';
		$tinymce_settings['tiny_mce'] = array( 'height' => 200 );
		include 'html/editor.php';
	}

	/**
	* \see WP_Widget::form
	*/
	function form( $instance ) {
		$widget_id = ( isset( $this->id ) ? $this->id : '0' );
		$div_id = $this->widget_id . $widget_id;

		// Load widget defaults and ovveride them with user defined settings.
		$instance = $this->merge_arrays( $this->get_defaults(), $instance );

		// Display form.
		include 'html/back-end.php';
	}

	/**
	 * Returns the default values for this widget.
	 *
	 * \return array Default values for this widget.
	 */
	protected function get_defaults() {
		return apply_filters( $this->widget_id . '_get_defaults', array(
			'title' => '',
			'text' => '',
			'src' => '',
			'display_size' => 'responsive',
			'display_width' => '',
			'display_height' => '',
			'original_width' => '',
			'original_height' => '',
			'keep_aspect_ratio' => true,
			'alt' => '',
			'url' => '',
			'target_option' => '',
			'target_name' => ''
		));
	}

	/**
	 * Returns the image display size options for this widget.
	 *
	 * \return array
	 */
	protected function get_display_sizes() {
		return apply_filters( $this->widget_id . '_display_sizes', array(
			'responsive' => __( 'Responsive', 'hwim' ),
			'fixed' => __( 'Fixed', 'hwim' )
		));
	}

	/**
	 * Returns a list of possible link targets.
	 *
	 * \return array
	 */
	protected function get_targets() {
		return apply_filters( $this->widget_id . '_targets', array(
			'' => '',
			'_blank' => '_blank',
			'_self' => '_self',
			'_parent' => '_parent',
			'_top' => '_top',
			'other' => __( 'Other', 'hwim' )
		));
	}

	/**
	 * Merges two arrays withour reindexing, with overwriting (not the same as
	 * PHP array_merge()).
	 *
	 * \param array $array1 First array to merge.
	 * \param array $array2 Second array to merge and overwrite values with.
	 * \return array Merged arrays.
	 */
	protected function merge_arrays( $array1, $array2 ) {
		return array_diff_key($array1, $array2) + $array2;
	}

	/**
	 * \see WP_Widget::widget
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$instance['title'] = \apply_filters( 'widget_title', \esc_attr( @$instance['title'] ) );
		$instance['keep_aspect_ratio'] = ( isset( $instance['keep_aspect_ratio'] ) ) ? true : false;

		// Output widget to front-end.
		echo $before_widget;

		if ( '' != trim( $instance['title'] ) ) {
			echo apply_filters( 'hwim_title', $before_title . $instance['title'] . $after_title );
		}

		// Allow theme to supply a non-standard template.
		$template = locate_template( 'hwim-template.php' );
		if ( $template ) {
			include $template;
		} else {
			include 'html/front-end.php';
		}

		echo $after_widget;
	}

	/**
	* \see WP_Widget::update
	*/
	public function update( $new_instance, $old_instance ) {
		$new_instance['keep_aspect_ratio'] = isset( $new_instance['keep_aspect_ratio'] );
		return $new_instance;
	}
}
