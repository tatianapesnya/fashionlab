<textarea class="custom-js-css-content" wrap="off"><?php echo stripslashes($initial_content); ?></textarea>

<?php if (is_writable(WP_PLUGIN_DIR . '/slider-pro/custom')) { ?>
	<a class="button-secondary save-button" 
	   href="<?php echo wp_nonce_url(admin_url("admin-ajax.php?action=sliderpro_save_custom_js_css&type=$file_type&id=$id"), 'custom-js-css-edit'); ?>">
	   Save
	</a>
<?php } else { ?>
	<div class="custom-not-writable">
		Note: You need to make the <i>slider-pro/custom</i> folder writable before you can add custom CSS and Javascript.
		More details <a target="_blank" href="<?php echo admin_url('admin.php?page=slider_pro_help#troubleshooting13'); ?>">here</a>.
	</div>
<?php } ?>