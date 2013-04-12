<form id="replicate-skin-form" method="post" action="<?php echo admin_url('admin.php?page=slider_pro_skin_editor'); ?>">
	<?php wp_nonce_field('replicate-skin-submit', 'replicate-skin-nonce'); ?>
    <input type="hidden" name="skin" value="<?php echo isset($_GET['skin']) ? $_GET['skin'] : ''; ?>"/>
    
	<table>
        <tbody>
            <tr>
                <td><label for="replicate-skin-name"><?php _e('Skin Name', 'slider_pro'); ?></label></td>
                <td><input name="replicate-skin-name" type="text" value="My Skin Name"/></td>
            </tr>
            
            <tr>
                <td><label for="replicate-skin-class"><?php _e('Class', 'slider_pro'); ?></label></td>
                <td><input name="replicate-skin-class" type="text" value="skin-class"/></td>
            </tr>
            
            <tr>
                <td><label for="replicate-skin-description"><?php _e('Description', 'slider_pro'); ?></label></td>
                <td><input name="replicate-skin-description" type="text" value="Add a short description of the skin"/></td>
            </tr>
            
            <tr>
                <td><label for="replicate-skin-author"><?php _e('Author', 'slider_pro'); ?></label></td>
                <td><input name="replicate-skin-author" type="text" value="Your name"/></td>
            </tr>
        </tbody>
    </table>
                    
    <input type="submit" name="replicate_skin" id="replicate-skin-submit" class="button-secondary" value="<?php _e('Replicate Skin', 'slider-pro'); ?>"/>
</form> 