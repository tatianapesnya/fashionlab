<form id="import-slider-form" action="<?php echo admin_url('admin.php?page=slider_pro'); ?>" enctype="multipart/form-data" method="post">
	<?php wp_nonce_field('import-slider-submit', 'import-slider-nonce'); ?>
	<input type="file" name="import-slider-file[]" id="import-slider-input" size="35" multiple/>
    <input type="submit" name="import-slider-submit" class="button-secondary" value="<?php _e('Import', 'slider-pro'); ?>"/>
</form> 