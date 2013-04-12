<?php

add_action('widgets_init', 'sliderpro_register_widgets');


function sliderpro_register_widgets() {
	register_widget('Slider_Pro_Widget');
}


/**
* Create the Slider PRO widget
*/
class Slider_Pro_Widget extends WP_Widget {
	
	function Slider_Pro_Widget() {
		
		$widget_opts = array(
			'classname' => 'slider-pro-widget',
			'description' => 'Display a Slider PRO instance in the widgets area.'
		);
		
		$this->WP_Widget('slider-pro-widget', 'Slider PRO', $widget_opts);
	}
	
	
	// create the admin interface
	function form($instance) {
		$instance = wp_parse_args( (array)$instance, array('slider_id' => ''));
		
		$slider_id = strip_tags($instance['slider_id']);
		$title = isset($instance['title']) ? strip_tags($instance['title']) : '';
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'sliderpro_sliders';
		$sliders = $wpdb->get_results("SELECT id, name FROM $table_name", ARRAY_A);
		
		//echo '<p><em><strong>Note: </strong> Please don\'t forget to set the \'Include Skin\' option, in the Slider\'s Admin panel, to true.</em></p>';
		
		echo '<p>';
		echo '<label for="' . $this->get_field_name('title') . '">Title: </label>';
		echo '<input type="text" value="' . $title . '" name="' . $this->get_field_name('title') . '" id="' . $this->get_field_name('title') . '" class="widefat">';
		echo '</p>';
		
		echo '<p>';
		echo '<label for="' . $this->get_field_name('slider_id') . '">Select the slider: </label>';
		echo '<select name="' . $this->get_field_name('slider_id') . '" id="' . $this->get_field_name('slider_id') . '" class="widefat">';
			foreach ($sliders as $slider) {
				$selected = $slider_id == $slider['id'] ? 'selected="selected"' : "";
				echo "<option value=". $slider['id'] ." $selected>" . stripslashes($slider['name']) . ' (' . $slider['id'] . ')' . "</option>";
			}
		echo '</select>';
		echo '</p>';
	}
	
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;		
		$instance['slider_id'] = strip_tags($new_instance['slider_id']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	
	// create the public view output
	function widget($args, $instance) {   
		extract($args, EXTR_SKIP);
		$title = apply_filters('widget_title', $instance['title']);
		
		echo $before_widget;
		
		if ($title)
			echo $before_title . $title . $after_title;
		
		echo slider_pro($instance['slider_id']);		
		echo $after_widget;
	}
}

?>