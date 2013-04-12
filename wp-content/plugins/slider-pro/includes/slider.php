<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2>
    	<?php			
    		echo ($action == 'edit') ? __('Edit Slider', 'slider_pro') : __('Create a New Slider', 'slider_pro');
		?>
    </h2>
    
    <?php			
		if (isset($_GET['action'])) {
			if ($_GET['action'] == 'create')
				echo '<div id="message" class="updated below-h2"><p>' . __('Slider created.', 'slider_pro') . '</p></div>';
			else if ($_GET['action'] == 'update')
				echo '<div id="message" class="updated below-h2"><p>' . __('Slider updated.', 'slider_pro') . '</p></div>';
		}
	?>
    
    <form action="<?php echo $action == 'edit' ? admin_url('admin.php?page=slider_pro&action=update') : admin_url('admin.php?page=slider_pro&action=create'); ?>" method="post">
    	<input type="hidden" name="first_slider_field" value="first"/>
    	<?php wp_nonce_field('slider-form-submit', 'slider-form-nonce'); ?>
        <?php if ($action == 'edit') { ?> <input type="hidden" name="slider_id" value="<?php echo $slider_id; ?>"/> <?php } ?>
        <input type="hidden" name="slider_settings[slide_width]" value="<?php echo isset($slider_settings['slide_width']) ? $slider_settings['slide_width'] : '500'; ?>"/>
        <input type="hidden" name="slider_settings[slide_height]" value="<?php echo isset($slider_settings['slide_height']) ? $slider_settings['slide_height'] : '300';  ?>"/>


        <div class="metabox-holder has-right-sidebar">
            <div class="editor-wrapper meta-box-sortables">
                <div class="editor-body">
                    <div id="titlediv">
                    	<input name="name" id="title" type="text" value="<?php echo $action == 'edit' ? $slider_name : __('My Slider', 'slider_pro'); ?>"/>
                    </div>
                    
                    <div class="slideboxes ui-sortable">
                    <?php
						$posts_data = sliderpro_get_posts_data();
						
						global $sliderpro_slide_settings;
						$individual_slide_settings = sliderpro_get_individual_slide_settings();
						
						$counter = 1;
						$is_slide = false;
						$slide_content = NULL;
						$slide_settings = NULL;
								
						if ($action == 'edit')
							foreach($slides as $slide) {
								$is_slide = true;
								$slide_content = unserialize($slide['content']);
								$slide_settings = unserialize($slide['settings']);								
								include('slide.php');
								$counter++;								
							}
						else
							include('slide.php');
                    ?>
                    </div>
                    
                    <div id="slide-buttons"> 
                   		<a class="button-secondary" id="add-new-slides" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_add_new_slides"); ?>">
							<?php _e('Add New Slides', 'slider_pro'); ?>
						</a>
						<input id="add-slides-quantity" type="text" value="1"/>
						
						<a class="button-secondary" id="add-image-slides" 
						   href="<?php echo admin_url("admin-ajax.php?action=sliderpro_open_media&show_page=1&show_date=all&allow=multiple"); ?>">
							<?php _e('Add Image Slides', 'slider_pro'); ?>
						</a>
						
						<p id="processing-indicator" class="hide">
							<?php _e('Processing Request...', 'slider_pro'); ?>
						</p>
						
						<a class="button-secondary" id="apply-bulk-actions" href="#">
							<?php _e('Apply', 'slider_pro'); ?>
						</a>
						
						<select name="bulk_actions_select" id="bulk-actions-select">
							<option><?php _e('Bulk Actions', 'slider_pro'); ?></option>
							<option><?php _e('Mark All', 'slider_pro'); ?></option>
							<option><?php _e('Unmark All', 'slider_pro'); ?></option>
							<option><?php _e('Reverse marking', 'slider_pro'); ?></option>
							<option><?php _e('Delete Slides', 'slider_pro'); ?></option>
							<option><?php _e('Enable Slides', 'slider_pro'); ?></option>
							<option><?php _e('Disable Slides', 'slider_pro'); ?></option>
							<option><?php _e('Refresh Images', 'slider_pro'); ?></option>
							<option><?php _e('Refresh Thumbs', 'slider_pro'); ?></option>
						</select>
						
                    </div>
                </div>
            </div>
            
            <div class="inner-sidebar meta-box-sortables ui-sortable">
			

				<!-- PUBLISH -->
				
				<div class="postbox action">
					<div class="inside">
						
						<input type="hidden" class="panel-state" name="panels_state[publish]" 
							   value="<?php echo sliderpro_get_panels_state($slider, 'publish'); ?>"/>
						
						<input type="submit" name="submit" class="button-primary" 
							   value="<?php echo $action == 'edit' ? __('Update Slider', 'slider_pro') : __('Create Slider', 'slider_pro'); ?>"/>
						
						<?php
							if ($action == 'edit') {
								$url = wp_nonce_url(admin_url("admin.php?page=slider_pro&action=delete&id=$slider_id&name=" . $slider_name), 'delete-slider');
								$preview_params = "&id=$slider_id&name=" . $slider_name . '&width=' . $slider_settings['width'] . '&height=' . $slider_settings['height'];
						?> 		
								<a class="button preview-slider"
								   href="<?php echo admin_url("admin-ajax.php?action=sliderpro_slider_preview") . str_replace('%', 'pc', $preview_params); ?>">
								   <?php _e('Preview Slider', 'slider_pro'); ?>
								</a>
								   
								<a class="delete-slider" href="<?php echo $url; ?>"><?php _e('Delete Slider', 'slider_pro'); ?></a> 
						<?php
							}
						?>
						
					</div>
				</div>



				<!-- GENERAL -->
				
				<div class="postbox">
					<div class="handlediv"></div>
					<h3 class="hndle"><?php _e('General', 'slider_pro'); ?></h3>
					<div class="inside">
						<input type="hidden" class="panel-state" name="panels_state[general]" 
							   value="<?php echo sliderpro_get_panels_state($slider, 'general'); ?>"/>
						
						<fieldset>
							<legend><?php _e('Size', 'slider_pro'); ?></legend>
								
								<label title="width"><?php _e('Width', 'slider_pro'); ?></label>
								<input name="slider_settings[width]" type="text" value="<?php echo sliderpro_get_setting($slider_settings, 'width'); ?>" class="slider-width"/>
								
								<label title="height"><?php _e('Height', 'slider_pro'); ?></label>
								<input name="slider_settings[height]" type="text" value="<?php echo sliderpro_get_setting($slider_settings, 'height'); ?>" class="slider-height"/>
								
								<label title="responsive"><?php _e('Responsive', 'slider_pro'); ?></label>
								<input name="slider_settings[responsive]" type="hidden" value="0"/>
								<input name="slider_settings[responsive]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'responsive') == true ? 'checked="checked"' : ''; ?>/>

								<label title="aspect_ratio"><?php _e('Ratio', 'slider_pro'); ?></label>
								<input name="slider_settings[aspect_ratio]" type="text" value="<?php echo sliderpro_get_setting($slider_settings, 'aspect_ratio'); ?>" />
						
						</fieldset>

						<fieldset>
							<legend><?php _e('Style', 'slider_pro'); ?></legend>
								
								<label title="skin"><?php _e('Skin', 'slider_pro'); ?></label>
								<select name="slider_settings[skin]">
									<?php
										global $sliderpro_slider_skins;
											
										$skin_class = sliderpro_get_setting($slider_settings, 'skin') ?  sliderpro_get_setting($slider_settings, 'skin') : 'pixel';
										
										//sort the array of skins alphabetically based on the skin's name
										usort($sliderpro_slider_skins, "sliderpro_compare_skin_names");
										
										foreach ($sliderpro_slider_skins as $skin) {
											$selected = $skin['class'] == $skin_class ? 'selected="selected"' : '';
											echo "<option value=\"" . $skin['class'] . "\" $selected>" . $skin['name'] . "</option>";
										}
									?>
								</select>
								
								<label title="include_skin"><?php _e('Include Skin', 'slider_pro'); ?></label>
								<input name="slider_settings[include_skin]" type="hidden" value="0"/>
								<input name="slider_settings[include_skin]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'include_skin') == true ? 'checked="checked"' : ''; ?>/>

								<div class="spacediv"></div>

								<label title="shadow"><?php _e('3D Shadow', 'slider_pro'); ?></label>
								<input name="slider_settings[shadow]" type="hidden" value="0"/>
								<input name="slider_settings[shadow]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'shadow') == true ? 'checked="checked"' : ''; ?>/>

								<label title="border"><?php _e('Border', 'slider_pro'); ?></label>
								<input name="slider_settings[border]" type="hidden" value="0"/>
								<input name="slider_settings[border]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'border') == true ? 'checked="checked"' : ''; ?>/>

								<label title="glow"><?php _e('Glow', 'slider_pro'); ?></label>
								<input name="slider_settings[glow]" type="hidden" value="0"/>
								<input name="slider_settings[glow]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'glow') == true ? 'checked="checked"' : ''; ?>/>


						</fieldset>
						
						<div class="spacediv"></div>
						
						<fieldset>
							<legend><?php _e('Align & Scale', 'slider_pro'); ?></legend>
								
								<label title="align_type"><?php _e('Align', 'slider_pro'); ?></label>
								<select name="slider_settings[align_type]">
									<?php 
										$list = sliderpro_get_settings_list('align_type');
										foreach ($list as $entry) {
											$selected = sliderpro_get_setting($slider_settings, 'align_type') == $entry ? 'selected="selected"' : "";
											echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
										}
									?>
								</select>
								
								<label title="scale_type"><?php _e('Scale', 'slider_pro'); ?></label>
								<select name="slider_settings[scale_type]">
									<?php 
										$list = sliderpro_get_settings_list('scale_type');
										foreach ($list as $entry) {
											$selected = sliderpro_get_setting($slider_settings, 'scale_type') == $entry ? 'selected="selected"' : "";
											echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
										}
									?>
								</select>
								
								<label title="allow_scale_up"><?php _e('Scale Up', 'slider_pro'); ?></label>
								<input name="slider_settings[allow_scale_up]" type="hidden" value="0"/>
								<input name="slider_settings[allow_scale_up]" type="checkbox" value="1" 
									   <?php echo sliderpro_get_setting($slider_settings, 'allow_scale_up') == true ? 'checked="checked"' : ''; ?>/>
									   												
						</fieldset>
						
						<div class="spacediv"></div>
						
						<fieldset>
							<legend><?php _e('Slides', 'slider_pro'); ?></legend>
							
							<label title="lazy_loading"><?php _e('Lazy Loading', 'slider_pro'); ?></label>
							<input name="slider_settings[lazy_loading]" type="hidden" value="0"/>
							<input name="slider_settings[lazy_loading]" type="checkbox" value="1" 
								   <?php echo sliderpro_get_setting($slider_settings, 'lazy_loading') == true ? 'checked="checked"' : ''; ?>/>
							
							<label title="preload_nearby_images"><?php _e('Preload Nearby', 'slider_pro'); ?></label>
							<input name="slider_settings[preload_nearby_images]" type="hidden" value="0"/>
							<input name="slider_settings[preload_nearby_images]" type="checkbox" value="1" 
								   <?php echo sliderpro_get_setting($slider_settings, 'preload_nearby_images') == true ? 'checked="checked"' : ''; ?>/>
							
							<label title="shuffle"><?php _e('Shuffle', 'slider_pro'); ?></label>
							<input name="slider_settings[shuffle]" type="hidden" value="0"/>
							<input name="slider_settings[shuffle]" type="checkbox" value="1" 
								   <?php echo sliderpro_get_setting($slider_settings, 'shuffle') == true ? 'checked="checked"' : ''; ?>/> 
							
							<label title="slide_start"><?php _e('Start', 'slider_pro'); ?></label>
							<input name="slider_settings[slide_start]" type="text" value="<?php echo sliderpro_get_setting($slider_settings, 'slide_start'); ?>"/>							

						</fieldset>
					</div>
				</div> 



				<!-- MIDDLE PANELS -->
				
				<?php

				global $sliderpro_slider_settings, $sliderpro_slider_sidebar_categories;
				$sidebar_panel_settings = array();
				
				

				foreach ($sliderpro_slider_settings as $key => $value) {
					$category = $value['category'];
					$group = $value['group'];
					
					if (!isset($sidebar_panel_settings[$category]))
						$sidebar_panel_settings[$category] = array();
					
					if (!isset($sidebar_panel_settings[$category][$group]))
						$sidebar_panel_settings[$category][$group] = array();
					
					array_push($sidebar_panel_settings[$category][$group], $key);
				}
				
				unset($sidebar_panel_settings['general']);
				unset($sidebar_panel_settings['custom_js_css']);

				if (!get_option('slider_pro_caption_html'))
					unset($sidebar_panel_settings['captions']);

				foreach ($sidebar_panel_settings as $category_name => $category) {
					echo '<div class="postbox">' . PHP_EOL;
					echo SP_IND_1 . '<div class="handlediv"></div>' . PHP_EOL;
					echo SP_IND_1 . '<h3 class="hndle">' . __($sliderpro_slider_sidebar_categories[$category_name], 'slider_pro') . '</h3>' . PHP_EOL;
					echo SP_IND_1 . '<div class="inside">' . PHP_EOL;
					echo SP_IND_2 . '<input type="hidden" class="panel-state" name="panels_state[' . $category_name . ']" 
											value="' . sliderpro_get_panels_state($slider, $category_name) . '"/>' . PHP_EOL;
							
					echo SP_IND_2 . '<select class="settings-multiselect" multiple="multiple">' . PHP_EOL;
					
					$set_settings = array();
					
					foreach ($sidebar_panel_settings[$category_name] as $key => $value) {
						echo SP_IND_3 . '<optgroup label="' . $key . '">' . PHP_EOL;
						
						foreach ($sidebar_panel_settings[$category_name][$key] as $setting) {
							$value = $sliderpro_slider_settings[$setting]['default_value'];
							$selected = '';
							
							if (isset($slider_settings[$setting])) {
								$selected = ' selected="selected"';
								$set_settings[$setting] = $slider_settings[$setting];
							}
							
							if ($value === true)
								$value = 'true';
							else if ($value === false)
								$value = 'false';
							
							if ($sliderpro_slider_settings[$setting]['type'] == 'select')
								$value = sliderpro_get_settings_pretty_name($value);
							
							echo SP_IND_4 . '<option' . $selected . ' value="' . $setting . '">' . $sliderpro_slider_settings[$setting]['name'] . ': ' . $value . '</option>' . PHP_EOL;
						}
							
						echo SP_IND_3 . '</optgroup>' . PHP_EOL;
					}
					
					echo SP_IND_2 . '</select>' . PHP_EOL;
					echo SP_IND_2 . '<a class="button-secondary display" href="' . admin_url("admin-ajax.php?action=sliderpro_display_slider_settings") . '">Display</a>' . PHP_EOL;
					echo SP_IND_2 . '<table class="settings-container">' . PHP_EOL;
					
					foreach ($set_settings as $name => $value)
						echo SP_IND_3 . sliderpro_create_slider_setting_field($name, $value) . PHP_EOL;
					
					unset($set_settings);
					
					echo SP_IND_2 . '</table>' . PHP_EOL;					
					echo SP_IND_1 . '</div>' . PHP_EOL;					
					echo '</div>' . PHP_EOL . PHP_EOL;
				}

				?>
				


				<!-- SLIDES ORDER -->
				
				<div class="postbox">
					<div class="handlediv"></div>
					<h3 class="hndle"><?php _e('Slides order', 'slider_pro'); ?></h3>
					<div class="inside">
						<input type="hidden" class="panel-state" name="panels_state[slides_order]" 
							   value="<?php echo sliderpro_get_panels_state($slider, 'slides_order'); ?>"/>
										
						<div class="slides-order-container"> </div>
					
					</div>
				</div>

				
				
				<!-- Custom JS and CSS -->
				
				<div class="postbox">
					<div class="handlediv"></div>
					<h3 class="hndle"><?php _e('Custom CSS & JavaScript', 'slider_pro'); ?></h3>
					<div class="inside">
						<input type="hidden" class="panel-state" name="panels_state[custom_js_css]" 
							   value="<?php echo sliderpro_get_panels_state($slider, 'custom_js_css'); ?>"/>
						
						<?php
							if ($action == 'edit') {
						?>
						
						<table>
							<tr>
								<td>
									<label title="custom_class"><?php _e('Custom Class', 'slider_pro'); ?></label>
								</td>
								<td colspan="2">
									<input name="slider_settings[custom_class]" type="text" value="<?php echo sliderpro_get_setting($slider_settings, 'custom_class'); ?>" class="custom-class" />
								</td>
							</tr>							
							<tr>
								<td>
									<label title="enable_custom_css"><?php _e('Enable Custom CSS', 'slider_pro'); ?></label>
								</td>
								<td>
									<input name="slider_settings[enable_custom_css]" type="hidden" value="0"/>
									<input name="slider_settings[enable_custom_css]" type="checkbox" value="1" 
										   <?php echo sliderpro_get_setting($slider_settings, 'enable_custom_css') == true ? 'checked="checked"' : ''; ?>/>
								</td>
								<td>
									<a href="<?php echo admin_url("admin-ajax.php?action=sliderpro_edit_custom_js_css&id=$slider_id");?>" id="edit-custom-css">Edit custom CSS</a>
								</td>
							</tr>
							<tr>
								<td>
									<label title="enable_custom_js"><?php _e('Enable Custom JS', 'slider_pro'); ?></label>
								</td>
								<td>
									<input name="slider_settings[enable_custom_js]" type="hidden" value="0"/>
									<input name="slider_settings[enable_custom_js]" type="checkbox" value="1" 
										   <?php echo sliderpro_get_setting($slider_settings, 'enable_custom_js') == true ? 'checked="checked"' : ''; ?>/>
								</td>
								<td>
									<a href="<?php echo admin_url("admin-ajax.php?action=sliderpro_edit_custom_js_css&id=$slider_id");?>" id="edit-custom-js">Edit custom JavaScript</a>
								</td>
							</tr>
						</table>
						
						<?php
							} else {
						?>
						
						<p class="custom-js-css-note">
							The slider will need to be created before adding custom JavaScript or CSS code. You can create the current slider by clicking the 'Create Slider' button on the top.
						</p>
						
						<?php		
							}
						?>
						
					</div>
				</div>						
						
									   
            </div>
        </div>
        <input type="hidden" name="last_slider_field" value="last"/>
	</form>
</div>