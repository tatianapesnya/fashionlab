<div class="slider-pro-feature-box-inner">
	<?php 
		wp_nonce_field('slider-pro-feature-box-update', 'slider-pro-feature-box-nonce');
		$is_featured = '';
		$meta = get_post_meta($post->ID, '_sliderpro-featured');
		
		if ($meta)
			$is_featured = $meta[0]; 
	?>
    
    <input type="checkbox" id="slider-pro-featured-post" name="slider-pro-featured-post" value="1" <?php if ($is_featured) echo 'checked="checked"';?>/> 
	<label for="slider-pro-featured-post">Feature this post in Slider PRO</label>
</div>