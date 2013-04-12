<form id="layer-settings-form" method="post" class="slider-pro">
	<?php wp_nonce_field('layer-settings-save', 'layer-settings-nonce'); ?>
	
	
		<fieldset>
			<legend><?php _e('Effect', 'slider-pro'); ?></legend>	
			
			<label title="layer_transition"><?php _e('Transition', 'slider-pro'); ?></label>
			<select name="layer_transition" class="layer-setting-field">
				<?php 
					$list = sliderpro_get_settings_list('layer_transition');
					foreach ($list as $entry) {
						$selected = sliderpro_get_slide_setting($layer_settings, 'layer_transition', 'layer') == $entry ? 'selected="selected"' : '';
						echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
					}
				?>
			</select>
			
			<label title="layer_offset"><?php _e('Offset', 'slider-pro'); ?></label>
			<input name="layer_offset" type="text"class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_offset', 'layer'); ?>"/>
			
			<label title=""><?php _e('Easing', 'slider-pro'); ?></label>
			<select name="layer_easing" class="layer-setting-field">
				<?php 
					$list = sliderpro_get_settings_list('easing');
					foreach ($list as $entry) {
						$selected = sliderpro_get_slide_setting($layer_settings, 'layer_easing', 'layer') == $entry ? 'selected="selected"' : '';
						echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
					}
				?>
			</select>
		
			<label title="layer_duration"><?php _e('Duration', 'slider-pro'); ?></label>
			<input name="layer_duration" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_duration', 'layer'); ?>"/>
			
			<label title="layer_delay"><?php _e('Delay', 'slider-pro'); ?></label>
			<input name="layer_delay" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_delay', 'layer'); ?>"/>
		</fieldset>
		
		
		<fieldset>
			<legend><?php _e('Size & Position', 'slider-pro'); ?></legend>
				
			<label title="layer_position"><?php _e('Position', 'slider-pro'); ?></label>
			<select name="layer_position" class="layer-setting-field">
				<?php 
					$list = sliderpro_get_settings_list('layer_position');
					foreach ($list as $entry) {
						$selected = sliderpro_get_slide_setting($layer_settings, 'layer_position', 'layer') == $entry ? 'selected="selected"' : '';
						echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
					}
				?>
			</select>

			<label title="layer_horizontal"><?php _e('Horizontal', 'slider-pro'); ?></label>		
			<input name="layer_horizontal" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_horizontal', 'layer'); ?>"/>
			
			<label title="layer_vertical"><?php _e('Vertical', 'slider-pro'); ?></label>		
			<input name="layer_vertical" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_vertical', 'layer'); ?>"/>
			
			<label title="layer_width"><?php _e('Width', 'slider-pro'); ?></label>		
			<input name="layer_width" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_width', 'layer'); ?>"/>
			
			<label title="layer_height"><?php _e('Height', 'slider-pro'); ?></label>		
			<input name="layer_height" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_height', 'layer'); ?>"/>
		</fieldset>
		
		
		<fieldset>
			<legend><?php _e('Style', 'slider-pro'); ?></legend>

			<?php
				global $sliderpro_layer_preset_styles, $sliderpro_settings_pretty_name;

				echo '<select name="layer_preset_styles" class="settings-multiselect layer-setting-field" multiple="multiple">' . PHP_EOL;

				foreach ($sliderpro_layer_preset_styles as $preset_style) {
					$selected = strpos(sliderpro_get_slide_setting($layer_settings, 'layer_preset_styles', 'layer'), $preset_style) !== false ? ' selected="selected"' : '';
					echo '<option' . $selected . ' value="' . $preset_style . '">' . $sliderpro_settings_pretty_name[$preset_style] . '</option>' . PHP_EOL;
				}

				echo '</select>';
			?>

			<label title="layer_custom_class"><?php _e('Custom Class', 'slider-pro'); ?></label>
			<input name="layer_custom_class" type="text" class="layer-setting-field custom-class" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_custom_class', 'layer'); ?>"/>
		
			<label title="layer_depth"><?php _e('Depth', 'slider-pro'); ?></label>
			<input name="layer_depth" type="text" class="layer-setting-field" value="<?php echo sliderpro_get_slide_setting($layer_settings, 'layer_depth', 'layer'); ?>"/>

		</fieldset>
		
                    
	<input type="submit" class="button-secondary apply-settings" value="<?php _e('Apply', 'slider-pro'); ?>"/>
	<input type="submit" class="button-secondary ok-settings" value="<?php _e('OK', 'slider-pro'); ?>"/>
	
</form>