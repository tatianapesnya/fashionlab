<div class="dynamic-fields posts-data-fields">

	<select name="slide[<?php echo $counter;?>][settings][dynamic_posts_types][]" class="post-types-multiselect" multiple="multiple">
	
	<?php
	$selected_post_types = array();
	
	// display all the post types
	foreach ($posts_data['post_types'] as $post) {
		$selected = '';
		$values = sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_types', 'dynamic');
		
		if (strpos($values, $post['post_name']) !== false) {
			$selected = ' selected="selected"';
			
			// associate the post taxonomies with the (selected) post types
			$selected_post_types[$post['post_name']] = $post['post_taxonomies'];
		}
		
		echo SP_IND_1 . '<option value="' . $post['post_name'] . '"' . $selected . '>' . $post['post_label'] . '</option>' . PHP_EOL;
	}
	?>
	
	</select>
	
	
	<select name="slide[<?php echo $counter;?>][settings][dynamic_posts_taxonomies][]" class="post-taxonomies-multiselect" multiple="multiple">
	
	<?php
	$attached_taxonomies = array();	
	
	// get all the taxonomies attached to the selected post types
	foreach ($selected_post_types as $post_type => $post_taxonomies)
		foreach ($post_taxonomies as $key => $value)
			if (!in_array($value, $attached_taxonomies))
				array_push($attached_taxonomies, $value);
		
				
	// display the taxonomies that are attached to the selected post types
	foreach ($posts_data['taxonomies'] as $taxonomy) {
		if (!empty($taxonomy['taxonomy_terms']) && in_array($taxonomy['taxonomy_name'], $attached_taxonomies)) {
			echo SP_IND_1 . '<optgroup label="' . $taxonomy['taxonomy_label'] . '">' . PHP_EOL;
		
			foreach ($taxonomy['taxonomy_terms'] as $term) {
				$selected = '';
				$values = sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_taxonomies', 'dynamic');
				
				if (strpos($values, $term['term_complete']) !== false)
					$selected = ' selected="selected"';
			
				echo SP_IND_2 . '<option value="' . $term['term_complete'] . '"' . $selected . '>' . $term['term_name'] . '</option>' . PHP_EOL;
			}
			
			echo SP_IND_1 . '</optgroup>' . PHP_EOL;
		}
	}
	?>
	
	</select>
	
	
	<select name="slide[<?php echo $counter;?>][settings][dynamic_posts_relation]" class="relation-multiselect">
		<?php 
			$list = sliderpro_get_settings_list('dynamic_posts_relation');
			foreach ($list as $entry) {
				$selected = sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_relation', 'dynamic') == $entry ? 'selected="selected"' : "";
				echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
			}
		?>
	</select>
	
	
	<select name="slide[<?php echo $counter;?>][settings][dynamic_posts_orderby]" class="orderby-multiselect">
		<?php 
			$list = sliderpro_get_settings_list('dynamic_posts_orderby');
			foreach ($list as $entry) {
				$selected = sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_orderby', 'dynamic') == $entry ? 'selected="selected"' : "";
				echo "<option value=\"$entry\" $selected>" . sliderpro_get_settings_pretty_name($entry) . "</option>";
			}
		?>
	</select>
	
	
	<div class="spacediv"></div>
	
	
	<select name="slide[<?php echo $counter;?>][settings][dynamic_posts_order]" class="order-multiselect">
		<?php 
			$list = sliderpro_get_settings_list('dynamic_posts_order');
			foreach ($list as $entry) {
				$selected = sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_order', 'dynamic') == $entry ? 'selected="selected"' : "";
				echo "<option value=\"$entry\" $selected>" . $entry . "</option>";
			}
		?>
	</select>
	
	
	<label title="dynamic_posts_maximum"><?php _e('Maximum', 'slider_pro'); ?></label>
	<input name="slide[<?php echo $counter;?>][settings][dynamic_posts_maximum]" type="text" 
		   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_maximum', 'dynamic'); ?>"/>
	
	
	<label title="dynamic_posts_offset"><?php _e('Offset', 'slider_pro'); ?></label>
	<input name="slide[<?php echo $counter;?>][settings][dynamic_posts_offset]" type="text" 
		   value="<?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_offset', 'dynamic'); ?>"/>
	
	
	<?php if (get_option('slider_pro_dynamic_slides_featured_filter')) { ?>
		<label title="dynamic_posts_featured"><?php _e('Featured', 'slider_pro'); ?></label>
		<input name="slide[<?php echo $counter;?>][settings][dynamic_posts_featured]" type="hidden" value="0"/>
		<input name="slide[<?php echo $counter;?>][settings][dynamic_posts_featured]" type="checkbox" value="1" 
			   <?php echo sliderpro_get_slide_setting($slide_settings, 'dynamic_posts_featured', 'dynamic') == true ? 'checked="checked"' : '';?> />
	<?php } ?>
	   
</div>