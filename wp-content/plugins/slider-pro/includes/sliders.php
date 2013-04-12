<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2><?php _e('Sliders', 'slider_pro'); ?></h2>
     
	<?php
		$message;
		
		if (isset($_GET['action']) && $_GET['action'] == 'delete') {
			$message = __('Slider deleted.', 'slider_pro');
		} else if (isset($_GET['warning']) && $_GET['warning'] == '1') {
			$link = '<a href="' . admin_url('admin.php?page=slider_pro_help') . '#troubleshooting8">Troubleshooting chapter, point 8</a>';
			$message = __('Something went wrong. You probably added more slides than the server allows. For more details about this please see the ', 'slider_pro') . $link;
		}
		
		if (isset($message)) 
			echo '<div id="message" class="updated below-h2"><p>' . $message . '</p></div>';
	?>
       
	<table class="widefat">
	<thead>
	<tr>
		<th width="5%"><?php _e('ID', 'slider_pro'); ?></th>
		<th width="39%"><?php _e('Name', 'slider_pro'); ?></th>
		<th width="13%"><?php _e('Created', 'slider_pro'); ?></th>
		<th width="13%"><?php _e('Modified', 'slider_pro'); ?></th>
		<th width="35%"><?php _e('Actions', 'slider_pro'); ?></th>
	</tr>
	</thead>
	
	<tbody>
		
	<?php
	global $wpdb;
	$prefix = $wpdb->prefix;

	$sliders = $wpdb->get_results("SELECT * FROM " . $prefix . "sliderpro_sliders ORDER BY id");
	
	if (count($sliders) == 0) {
		echo '<tr>'.
				 '<td colspan="100%">' . __('No slider created yet.', 'slider_pro') . '</td>'.
			 '</tr>';
	} else {
		foreach ($sliders as $slider) {
			$slider_name = stripslashes($slider->name);
			$slider_id = $slider->id;
			$slider_settings = unserialize($slider->settings);
			$slider_width = str_replace('%', 'pc', $slider_settings['width']);
			$slider_height = str_replace('%', 'pc', $slider_settings['height']);
			
			echo '<tr>'.
					'<td>' . $slider_id . '</td>'.
					'<td>' . $slider_name . '</td>'.
					'<td>' . $slider->created . '</td>'.
					'<td>' . $slider->modified . '</td>'.
					'<td>' .
						  '<a href="'. admin_url('admin.php?page=slider_pro&action=edit&id=' . $slider_id) . '">' . __('Edit', 'slider_pro') . '</a> | '.
						  
						  '<a class="preview-slider" href="' . admin_url('admin-ajax.php?action=sliderpro_slider_preview&id=' . $slider_id . 
						  									   '&name=' . $slider_name . '&width=' . $slider_width . '&height=' . $slider_height) . '">' . 
						  		__('Preview', 'slider_pro') . 
						  '</a> | '.
						  
						  '<a class="delete-slider" href="' . wp_nonce_url(admin_url('admin.php?page=slider_pro&action=delete&id=' . $slider_id), 'delete-slider') . '">' . 
						  		__('Delete', 'slider_pro') . 
						  '</a> | '.
						  
						  '<a class="duplicate-slider" href="' . wp_nonce_url(admin_url('admin.php?page=slider_pro&action=duplicate_slider&id=' . $slider_id), 'duplicate-slider') . '">' . 
						  		__('Duplicate', 'slider_pro') . 
						  '</a>';
						  
						  
						if (get_option('slider_pro_generate_xml_file')) {
							global $blog_id;
							
							$name = (function_exists('is_multisite') && is_multisite()) ? $slider_name . '_' . $blog_id . '-' . $slider->id . '.xml' : $slider_name . '_' . $slider->id . '.xml';
							$name = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $name);

							$link;
							
							if (file_exists(WP_PLUGIN_DIR . '/slider-pro/xml/' . $name))
								$link = '<a href="' . plugins_url('/slider-pro/includes/export.php?name=' . $name) . '">' . __('Export', 'slider_pro') . '</a>';
							else
								$link = '<a class="xml-not-available" href="#">' . __('Export N/A', 'slider_pro') . '</a>';
							  
							echo ' | ' . $link;
						  }
						  
			echo	'</td>'.
				'</tr>';
		}
	}
	?>

	</tbody>
	
	<tfoot>
	<tr>
		<th><?php _e('ID', 'slider_pro'); ?></th>
		<th><?php _e('Name', 'slider_pro'); ?></th>
		<th><?php _e('Created', 'slider_pro'); ?></th>
		<th><?php _e('Modified', 'slider_pro'); ?></th>
		<th><?php _e('Actions', 'slider_pro'); ?></th>
	</tr>
	</tfoot>
	</table>
    
    <div id="new-slider-button">    
		<a class="button-secondary" href="<?php echo admin_url('admin.php?page=slider_pro_new'); ?>"><?php _e('Create New Slider', 'slider_pro'); ?></a>
        <a class="button-secondary" id="import-slider" href="<?php echo admin_url('admin-ajax.php?action=sliderpro_slider_import'); ?>"><?php _e('Import Slider', 'slider_pro'); ?></a>
    </div>    
    
</div>