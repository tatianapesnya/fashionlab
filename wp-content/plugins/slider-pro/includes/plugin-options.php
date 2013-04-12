<div class="wrap slider-pro">
	<div class="slider-icon"></div>
	<h2><?php _e('Plugin Options', 'slider_pro'); ?></h2>
	
	<?php
	if (isset($_POST['plugin_options_update']))
    	echo '<div id="message" class="updated below-h2"><p>' . __('Plugin options updated.', 'slider_pro') . '</p></div>';
	?>
	
    <form class="plugin-options" name="plugin_options" method="post" action="">
    <?php wp_nonce_field('plugin-options-update', 'plugin-options-nonce'); ?>
    	
    	<table>
    		<tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_enable_timthumb" <?php echo get_option('slider_pro_enable_timthumb') == 1 ? 'checked="checked"' : ''; ?>>
	        		<label>Enable TimThumb</label>
	        	</td>
	        	<td>
	            	<p>This option needs to be enabled if you want the images to be dynamically resized. </p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_use_compressed_scripts" <?php echo get_option('slider_pro_use_compressed_scripts') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Use Compressed Scripts</label>
	            </td>
	        	<td>
	            	<p>You can disable this option if you want to use the uncompressed scripts, for debugging or other reasons. </p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_progress_animation" <?php echo get_option('slider_pro_progress_animation') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Progress Animation</label>
	            </td>
	        	<td>
	            	<p>If you have problems with the 'progress' animation, usually occurring when you have an older version of WordPress installed, you can disable this option.</p>
	            </td>
	        </tr>
			
			<tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_visual_editor" <?php echo get_option('slider_pro_visual_editor') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Visual Editor</label>
	            </td>
	        	<td>
	            	<p>This option will enable the TinyMCE visual editor for the Caption and Inline HTML sections. If you disable it, only a simple text area will be displayed.</p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_show_admin_bar_links" <?php echo get_option('slider_pro_show_admin_bar_links') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Show Admin Bar Links</label>
	            </td>
	        	<td>
	            	<p>If you don't want the Slider PRO links to be displayed in the admin bar, you can disable this option.</p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_enqueue_jquery" <?php echo get_option('slider_pro_enqueue_jquery') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enqueue jQuery</label>
	            </td>
	        	<td>
	            	<p>The slider will need the jQuery library but if you already load it in your theme you can disable this option.</p>
	            </td>
	        </tr>
			
			<tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_enqueue_bundled_jquery" <?php echo get_option('slider_pro_enqueue_bundled_jquery') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enqueue jQuery 1.7.2</label>
	            </td>
	        	<td>
	            	<p>You can enable this option if you have an older version of WordPress, which doesn't include at least jQuery 1.4.</p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_enqueue_jquery_easing" <?php echo get_option('slider_pro_enqueue_jquery_easing') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enqueue jQuery Easing</label>
	            </td>
	        	<td>
	            	<p>If you only use the default easing type you can disable this option.</p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_enqueue_jquery_mousewheel" <?php echo get_option('slider_pro_enqueue_jquery_mousewheel') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enqueue jQuery MouseWheel</label>
	            </td>
	        	<td>
	            	<p>If you use a different plugin for handling the mouse wheel input you can disable this option.</p>
	            </td>
	        </tr>
	        
	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_generate_xml_file" <?php echo get_option('slider_pro_generate_xml_file') == 1 ? 'checked="checked"' : ''; ?>>
	        		<label>Generate Slider XML File</label>
	            </td>
	        	<td>
	            	<p>This feature will generate an XML file for each of your sliders allowing you to export/import sliders. If your server doesn't have the DOM XML extension installed, you can disable the feature.</p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_https_to_http" <?php echo get_option('slider_pro_https_to_http') == 1 ? 'checked="checked"' : ''; ?>>
	        		<label>HTTPS to HTTP</label>
	            </td>
	        	<td>
	            	<p>If you use HTTPS for the site's dashboard and HTTP for public pages, please enable this option.</p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_multisite_path_rewrite" <?php echo get_option('slider_pro_multisite_path_rewrite') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Rewrite MultiSite Paths</label>
	            </td>
	        	<td>
	            	<p>This option needs to be enabled if you use the slider in a WordPress MultiSite environment and TimThumb is enabled. This feature will rewrite the vritual image paths that are used in Multisite to real file paths that are necessary for TimThumb.</p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_custom_media_loader" <?php echo get_option('slider_pro_custom_media_loader') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enable the Custom Media Loader</label>
	            </td>
	        	<td>
	            	<p>Since WordPress 3.5 the slider uses the default media library but you can revert to the previous custom media loader by checking this option.</p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_caption_html" <?php echo get_option('slider_pro_caption_html') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enable the Caption and Inline HTML sections</label>
	            </td>
	        	<td>
	            	<p>These fields are available by default in slider versions previous to version 3.0. In version 3.0, the Layers section was introduced and is meant to be a replacement for both the Caption and Inline HTML sections.</p>
	            </td>
	        </tr>

	        <tr>
	        	<td>
	        		<input type="checkbox" name="slider_pro_dynamic_slides_featured_filter" <?php echo get_option('slider_pro_dynamic_slides_featured_filter') == 1 ? 'checked="checked"' : ''; ?>>
	            	<label>Enable Dynamic Slides Featured filter</label>
	            </td>
	        	<td>
	            	<p>Enables an additional filter for the "Posts Content" slides, allowing you to fetch only posts that were selected from within the post's edit page.</p>
	            </td>
	        </tr>

        	<tr>
	        	<td>
	        		<select name="slider_pro_role_access">
						<?php
							global $sliderpro_role_access;
		                    foreach ($sliderpro_role_access as $key => $value) {
		                        $selected = get_option('slider_pro_role_access') == $key ? 'selected="selected"' : '';
		                        echo "<option $selected>" . $key . "</option>";
		                    }
		                ?>
		            </select>
		            <label>Role Access</label>
		        </td>
	        	<td>
            		<p>Select which role you want to have access to the Slider PRO plugin.</p>
				</td>
	        </tr>
		</table>
		
        <input type="submit" name="plugin_options_update" class="button-primary" value="Update Options"/>
    </form>
	
	
	<?php
	if (SLIDERPRO_AUTOMATIC_UPDATE === true) {
	?>
		<form class="automatic-update" name="automatic_update" method="post" action="">
		<?php wp_nonce_field('automatic-update-submit', 'automatic-update-nonce'); ?>
		
			<fieldset>
				<legend><?php _e('Enable Automatic Update', 'slider_pro'); ?></legend>
				
				<table>
					<tr>
						<td><label><?php _e('Your marketplace username', 'slider_pro'); ?></label></td>
						<td><input name="slider_pro_client_username" type="text" value="<?php echo get_option('slider_pro_client_username'); ?>"/></td>
					<tr>
					
					</tr>	
						<td><label><?php _e('Your marketplace API key', 'slider_pro'); ?></label></td>
						<td><input name="slider_pro_client_api_key" type="text" value="<?php echo get_option('slider_pro_client_api_key'); ?>"/></td>
					</tr>
					
					<tr>	
						<td><label><?php _e('Purchase code', 'slider_pro'); ?></label></td>
						<td><input name="slider_pro_item_purchase_code" type="text" value="<?php echo get_option('slider_pro_item_purchase_code'); ?>"/></td>
					</tr>
				</table>
				
				<div class="status clearfix">
					<p>
						<?php
							switch (get_option('slider_pro_automatic_update_status')) {
								case 'enabled':
									echo '* Automatic update is enabled.';
								break;
								
								case 'disabled':
									echo '* Automatic update is disabled.';
								break;
								
								case 'invalid-data':
									echo '* Automatic update is disabled. Provided data is incorrect.';
								break;
								
								default:
									echo '* Automatic update is disabled.';
								break;
							}
						?>
					</p>
					
					<input type="submit" name="automatic_update_submit" class="button-secondary" value="Submit"/>
				</div>
				
			</fieldset>
		</form>
	<?php
	}
	?>
	
</div>