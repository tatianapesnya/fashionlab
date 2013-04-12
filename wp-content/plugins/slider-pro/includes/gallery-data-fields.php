<div class="dynamic-fields gallery-data-fields">
	
	<label title="dynamic_gallery_post"><?php _e('Post', 'slider_pro'); ?></label>
	<input name="slide[<?php echo $counter;?>][settings][dynamic_gallery_post]" type="text" 
		   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_gallery_post', 'dynamic'); ?>"/>
	
	
	<label title="dynamic_gallery_maximum"><?php _e('Maximum', 'slider_pro'); ?></label>
	<input name="slide[<?php echo $counter;?>][settings][dynamic_gallery_maximum]" type="text" 
		   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_gallery_maximum', 'dynamic'); ?>"/>
	
	
	<label title="dynamic_gallery_offset"><?php _e('Offset', 'slider_pro'); ?></label>
	<input name="slide[<?php echo $counter;?>][settings][dynamic_gallery_offset]" type="text" 
		   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_gallery_offset', 'dynamic'); ?>"/>
	
</div>