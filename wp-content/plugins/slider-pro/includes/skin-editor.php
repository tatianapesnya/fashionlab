<div class="wrap slider-pro">
    <div class="slider-icon"></div>
    <h2><?php _e('Skin Editor', 'slider_pro'); ?></h2>
    
    <form name="skin_editor" method="post" action="">
    <?php wp_nonce_field('skin-editor-update', 'skin-editor-nonce'); ?>
            
        <textarea name="skin_content" class="skin-content"><?php echo stripslashes($skin_content); ?></textarea>        
        
        <div class="skin-editor-sidebar">
        
            <label><?php _e('Select a skin to edit', 'slider_pro'); ?>
                <select name="skin_selector" onchange="this.form.submit();">
                <?php
                    global $sliderpro_all_skins;
                    
                    //sort the array of skins alphabetically based on the skin's name
                    usort($sliderpro_all_skins, "sliderpro_compare_skin_names");
                    
                    foreach ($sliderpro_all_skins as $skin) {                        
                        if ($skin['class'] == $current_skin)
                            $selected = "selected=\"selected\"";
                        else
                            $selected = ''; 
                        
                        echo "<option value=\"" . $skin['class'] ."\" $selected >" . $skin['name'] . "</option>";
                    }
                ?>
                </select>
            </label>
            
            <div class="skin-meta">
                <p><span><?php _e('Skin Name: ', 'slider_pro'); ?></span>  <?php echo $skin_name; ?></p>
                <p><span><?php _e('Skin Class: ', 'slider_pro'); ?></span>  <?php echo $current_skin; ?></p>
                <p><span><?php _e('Skin Author: ', 'slider_pro'); ?></span>  <?php echo $skin_author; ?></p>
                <p><span><?php _e('Skin Description: ', 'slider_pro'); ?></span>  <?php echo $skin_description; ?></p>
            </div>
            
            
            <input type="submit" name="update_skin" class="button-primary" value="Update Skin"/>
            
            <?php if (is_writable(WP_PLUGIN_DIR . '/slider-pro/skins/slider')) { ?>
                <a class="button-secondary" id="replicate-skin" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_replicate_skin&skin=$current_skin"); ?>">
                    <?php _e('Replicate Skin', 'slider_pro'); ?>
                </a>
            <?php } ?>
            
            <a class="button-secondary" id="refresh-all-skins" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_refresh_all_skins"); ?>">
                <?php _e('Refresh All Skins', 'slider_pro'); ?>
            </a>
            
            
            <?php if (!is_writable(WP_PLUGIN_DIR . '/slider-pro/skins/slider')) { ?>                
                <div class="skins-not-writable">
                    Note: You need to make the <i>slider-pro/skins/slider</i> folder writable before you can replicate a skin.
                    More details <a target="_blank" href="<?php echo admin_url('admin.php?page=slider_pro_help#troubleshooting13'); ?>">here</a>.
                </div>
            <?php } ?>
            
        </div> 
        
    </form>
</div>