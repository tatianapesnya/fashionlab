<div class="dynamic-fields flickr-data-fields">
	
	<table>
		<tr>
			<td>
				<label title="dynamic_flickr_api_key"><?php _e('API Key', 'slider_pro'); ?></label>
			</td>			
			<td>
				<input name="slide[<?php echo $counter;?>][settings][dynamic_flickr_api_key]" type="text" class="flickr-api-key-field" 
					   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_flickr_api_key', 'dynamic'); ?>"/>
			</td>
		</tr>
		
		<tr>
			<td>
				<label title="dynamic_flickr_data_id"><?php _e('Data ID', 'slider_pro'); ?></label>
			</td>			
			<td>
				<input name="slide[<?php echo $counter;?>][settings][dynamic_flickr_data_id]" type="text" class="flickr-data-id-field" 
					   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_flickr_data_id', 'dynamic'); ?>"/>
			</td>
			
			<td>
				<label title="dynamic_flickr_data_type"><?php _e('Data Type', 'slider_pro'); ?></label>				
				<select name="slide[<?php echo $counter;?>][settings][dynamic_flickr_data_type]">
					<?php
						$data_type = sliderpro_get_slide_setting($slide_settings, 'dynamic_flickr_data_type', 'dynamic');
						$list = sliderpro_get_settings_list('dynamic_flickr_data_type');
						
						foreach ($list as $entry) {
							$selected = $data_type == $entry ? ' selected="selected"' : '';
							echo '<option' . $selected . ' value="' . $entry . '">' . sliderpro_get_settings_pretty_name($entry) . '</option>';
						}
					?>
				</select>
			</td>
			
			<td>
				<label title="dynamic_flickr_maximum"><?php _e('Maximum', 'slider_pro'); ?></label>
				<input name="slide[<?php echo $counter;?>][settings][dynamic_flickr_maximum]" type="text" 
					   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_flickr_maximum', 'dynamic'); ?>"/>
			</td>
		</tr>
	</table>
	
</div>