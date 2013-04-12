<?php
global $wpdb;
$prefix = $wpdb->prefix;
$table_name = $prefix . 'sliderpro_sliders';
$table_name_old = $prefix . 'sp_sliders';

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

// when the slider is activated for the first time, the tables don't exist, so we need to create them
if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name && $wpdb->get_var("SHOW TABLES LIKE '$table_name_old'") != $table_name_old) {
	$create_sliders_table = "CREATE TABLE ". $prefix . "sliderpro_sliders (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							name varchar(100) NOT NULL,
							settings text NOT NULL,
							created varchar(11) NOT NULL,
							modified varchar(11) NOT NULL,
							panels_state text NOT NULL,
							PRIMARY KEY (id)
							) DEFAULT CHARSET=utf8;";
	
	$create_slides_table = "CREATE TABLE ". $prefix . "sliderpro_slides (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							slider_id mediumint(9) NOT NULL,
							name varchar(100) NOT NULL,
							content text NOT NULL,
							settings text NOT NULL,
							position mediumint(9) NOT NULL,
							panel_state varchar(20) NOT NULL,
							selected_tab mediumint(9) NOT NULL,
							visibility varchar(20) NOT NULL,
							PRIMARY KEY (id)
							) DEFAULT CHARSET=utf8;";
	
	$create_skins_table = "CREATE TABLE ". $prefix . "sliderpro_skins (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							type varchar(100) NOT NULL,
							path text NOT NULL,
							name text NOT NULL,
							class text NOT NULL,
							description text NOT NULL,
							author text NOT NULL,
							url text NOT NULL,
							container_dir text NOT NULL,
							PRIMARY KEY (id)
							) DEFAULT CHARSET=utf8;";
	
																   						
	dbDelta($create_sliders_table);
	dbDelta($create_slides_table);
	dbDelta($create_skins_table);
	
	// add some options
	update_option('slider_pro_progress_animation', true);
	update_option('slider_pro_enable_timthumb', true);
	update_option('slider_pro_use_compressed_scripts', true);
	update_option('slider_pro_show_admin_bar_links', true);
	update_option('slider_pro_enqueue_jquery', true);
	update_option('slider_pro_enqueue_bundled_jquery', false);
	update_option('slider_pro_enqueue_jquery_easing', true);
	update_option('slider_pro_enqueue_jquery_mousewheel', true);
	update_option('slider_pro_generate_xml_file', true);
	update_option('slider_pro_visual_editor', true);
	update_option('slider_pro_role_access', 'Administrator');
	update_option('slider_pro_update_notification', true);
	update_option('slider_pro_automatic_update_status', 'disabled');
	update_option('slider_pro_multisite_path_rewrite', true);
	update_option('slider_pro_caption_html', false);
	update_option('slider_pro_dynamic_slides_featured_filter', false);
	update_option('slider_pro_custom_media_loader', false);
	update_option('slider_pro_https_to_http', false);

	// add/update skins in the database
	sliderpro_refresh_skins(array('slider', 'scrollbar'));
		
} else { // the slider's table already exist which means this activation is just for updating puposes
	
	$slider_pro_db_version = get_option('slider_pro_version');		
	
	//make modifications to the database if needed		
	if (version_compare($slider_pro_db_version, '2.0', '<')) {		
		$skins_table_name = $prefix . 'sliderpro_skins';
		
		// rename existing tables and create the skins table
		if ($wpdb->get_var("SHOW TABLES LIKE '$skins_table_name'") != $skins_table_name) {
			$wpdb->query("RENAME TABLE ". $prefix . "sp_sliders TO " . $prefix . "sliderpro_sliders");
			$wpdb->query("RENAME TABLE ". $prefix . "sp_slides TO " . $prefix . "sliderpro_slides");
		
			$create_skins_table = "CREATE TABLE ". $prefix . "sliderpro_skins (
									id mediumint(9) NOT NULL AUTO_INCREMENT,
									type varchar(100) NOT NULL,
									path text NOT NULL,
									name text NOT NULL,
									class text NOT NULL,
									description text NOT NULL,
									author text NOT NULL,
									url text NOT NULL,
									container_dir text NOT NULL,
									PRIMARY KEY (id)
									) DEFAULT CHARSET=utf8;";
	
			dbDelta($create_skins_table);
		}
		
		// add/update skins in the database
		sliderpro_refresh_skins(array('slider', 'scrollbar'));
		
		// change the charset to UTF8
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_sliders CHARACTER SET utf8");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHARACTER SET utf8");
		
		// change sliders.name charset to UTF8
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_sliders CHANGE name name varchar(100) CHARACTER SET latin1");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_sliders CHANGE name name varbinary(100)");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_sliders CHANGE name name varchar(100) CHARACTER SET utf8 NOT NULL");
		
		// change slides.name charset to UTF8
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE name name varchar(100) CHARACTER SET latin1");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE name name varbinary(100)");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE name name varchar(100) CHARACTER SET utf8 NOT NULL");
		
		// change slides.content charset to UTF8
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE content content text CHARACTER SET latin1");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE content content blob");
		$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides CHANGE content content text CHARACTER SET utf8 NOT NULL");		
		
		
		// add the 'selected_tab' column to all slides
		if (!$wpdb->query("SHOW COLUMNS FROM " . $prefix . "sliderpro_slides LIKE 'selected_tab'"))
			$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides ADD selected_tab mediumint(9) NOT NULL AFTER panel_state");
		
		//populate the 'selected_tab' column
		$wpdb->query("UPDATE ". $prefix . "sliderpro_slides SET selected_tab=0");
		
		
		// add the 'visibility' column to all slides
		if (!$wpdb->query("SHOW COLUMNS FROM " . $prefix . "sliderpro_slides LIKE 'visibility'"))
			$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_slides ADD visibility varchar(20) NOT NULL AFTER selected_tab");
		
		//populate the 'visibility' column
		$wpdb->query("UPDATE ". $prefix . "sliderpro_slides SET visibility='enabled'");
		
		
		// make modifications to the slider's global settings
		$sliders = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "sliderpro_sliders", ARRAY_A);
		
		foreach($sliders as $slider) {
			$id = $slider['id'];
			$slider_settings = unserialize($slider['settings']);
			
			// modify existing settings
			if (isset($slider['include_skin'])) {
				$slider_settings['include_skin'] = $slider['include_skin'];
				
				if ($wpdb->query("SHOW COLUMNS FROM " . $prefix . "sliderpro_sliders LIKE 'include_skin'"))
					$wpdb->query("ALTER TABLE ". $prefix . "sliderpro_sliders DROP COLUMN include_skin");
			}
			
			if (isset($slider_settings['thumbnails_type'])) {
				$slider_settings['thumbnail_type'] = $slider_settings['thumbnails_type'];
				unset($slider_settings['thumbnails_type']);
				
				if ($slider_settings['thumbnail_type'] == 'navigation')
					$slider_settings['thumbnail_type'] = 'scroller';
			}								
			
			if (isset($slider_settings['visible_thumbnails'])) {
				$slider_settings['maximum_visible_thumbnails'] = $slider_settings['visible_thumbnails'];
				unset($slider_settings['visible_thumbnails']);
			}
			
			if (isset($slider_settings['effect_type'])) {
				$slider_settings['slice_effect_type'] = 'random';
				
				if (in_array($slider_settings['effect_type'], array('fade', 'scale', 'slide', 'height', 'width'))) {
					$slider_settings['slice_effect_type'] = $slider_settings['effect_type'];
					$slider_settings['effect_type'] = 'slice';
				} else if ($slider_settings['effect_type'] == 'simpleSlide') {
					$slider_settings['effect_type'] = 'slide';
				}
			}				
			
			if (isset($slider_settings['simple_slide_direction'])) {
				$slider_settings['slide_direction'] = $slider_settings['simple_slide_direction'];
				unset($slider_settings['simple_slide_direction']);
			}
			
			if (isset($slider_settings['simple_slide_duration'])) {
				$slider_settings['slide_duration'] = $slider_settings['simple_slide_duration'];
				unset($slider_settings['simple_slide_duration']);
			}
			
			if (isset($slider_settings['simple_slide_easing'])) {
				$slider_settings['slide_easing'] = $slider_settings['simple_slide_easing'];
				unset($slider_settings['simple_slide_easing']);
			}
			
			if (isset($slider_settings['slide_start_ratio'])) {
				$slider_settings['slice_start_ratio'] = $slider_settings['slide_start_ratio'];
				unset($slider_settings['slide_start_ratio']);
			}
			
			if (isset($slider_settings['slide_start_position'])) {
				$slider_settings['slice_start_position'] = $slider_settings['slide_start_position'];
				unset($slider_settings['slide_start_position']);
			}			
			
			if (isset($slider_settings['navigation_arrows'])) {
				$slider_settings['slide_arrows'] = $slider_settings['navigation_arrows'];
				unset($slider_settings['navigation_arrows']);
			}
			
			if (isset($slider_settings['fade_navigation_arrows'])) {
				$slider_settings['slide_arrows_toggle'] = $slider_settings['fade_navigation_arrows'];
				unset($slider_settings['fade_navigation_arrows']);
			}
			
			if (isset($slider_settings['navigation_arrows_show_duration'])) {
				$slider_settings['slide_arrows_show_duration'] = $slider_settings['navigation_arrows_show_duration'];
				unset($slider_settings['navigation_arrows_show_duration']);
			}
			
			if (isset($slider_settings['navigation_arrows_hide_duration'])) {
				$slider_settings['slide_arrows_hide_duration'] = $slider_settings['navigation_arrows_hide_duration'];
				unset($slider_settings['navigation_arrows_hide_duration']);
			}
			
			if (isset($slider_settings['navigation_buttons'])) {
				$slider_settings['slide_buttons'] = $slider_settings['navigation_buttons'];
				unset($slider_settings['navigation_buttons']);
			}
			
			if (isset($slider_settings['navigation_buttons_numbers'])) {
				$slider_settings['slide_buttons_number'] = $slider_settings['navigation_buttons_numbers'];
				unset($slider_settings['navigation_buttons_numbers']);
			}
			
			if (isset($slider_settings['fade_navigation_buttons'])) {
				$slider_settings['slide_buttons_toggle'] = $slider_settings['fade_navigation_buttons'];
				unset($slider_settings['fade_navigation_buttons']);
			}
			
			if (isset($slider_settings['navigation_buttons_show_duration'])) {
				$slider_settings['slide_buttons_show_duration'] = $slider_settings['navigation_buttons_show_duration'];
				unset($slider_settings['navigation_buttons_show_duration']);
			}
			
			if (isset($slider_settings['navigation_buttons_hide_duration'])) {
				$slider_settings['slide_buttons_hide_duration'] = $slider_settings['navigation_buttons_hide_duration'];
				unset($slider_settings['navigation_buttons_hide_duration']);
			}
			
			if (isset($slider_settings['navigation_buttons_center'])) {
				$slider_settings['slide_buttons_center'] = $slider_settings['navigation_buttons_center'];
				unset($slider_settings['navigation_buttons_center']);
			}
			
			if (isset($slider_settings['navigation_buttons_container_center'])) {
				$slider_settings['slide_buttons_container_center'] = $slider_settings['navigation_buttons_container_center'];
				unset($slider_settings['navigation_buttons_container_center']);
			}
			
			if (isset($slider_settings['navigation_thumbnails_show_duration'])) {
				$slider_settings['thumbnail_scroller_show_duration'] = $slider_settings['navigation_thumbnails_show_duration'];
				unset($slider_settings['navigation_thumbnails_show_duration']);
			}
			
			if (isset($slider_settings['navigation_thumbnails_hide_duration'])) {
				$slider_settings['thumbnail_scroller_hide_duration'] = $slider_settings['navigation_thumbnails_hide_duration'];
				unset($slider_settings['navigation_thumbnails_hide_duration']);
			}
			
			if (isset($slider_settings['navigation_thumbnails_center'])) {
				$slider_settings['thumbnail_scroller_center'] = $slider_settings['navigation_thumbnails_center'];
				unset($slider_settings['navigation_thumbnails_center']);
			}
			
			if (isset($slider_settings['fade_navigation_thumbnails'])) {
				$slider_settings['thumbnail_scroller_toggle'] = $slider_settings['fade_navigation_thumbnails'];
				unset($slider_settings['fade_navigation_thumbnails']);
			}
			
			if (isset($slider_settings['hide_caption'])) {
				$slider_settings['caption_toggle'] = $slider_settings['hide_caption'];
				unset($slider_settings['hide_caption']);
			}
			
			if (isset($slider_settings['fade_slideshow_controls'])) {
				$slider_settings['slideshow_controls_toggle'] = $slider_settings['fade_slideshow_controls'];
				unset($slider_settings['fade_slideshow_controls']);
			}
			
			if (isset($slider_settings['fade_timer'])) {
				$slider_settings['timer_toggle'] = $slider_settings['fade_timer'];
				unset($slider_settings['fade_timer']);
			}
			
			if (isset($slider_settings['hide_thumbnail_caption'])) {
				$slider_settings['thumbnail_caption_toggle'] = $slider_settings['hide_thumbnail_caption'];
				unset($slider_settings['hide_thumbnail_caption']);
			}
			
			if (isset($slider_settings['fade_thumbnail_buttons'])) {
				$slider_settings['thumbnail_buttons_toggle'] = $slider_settings['fade_thumbnail_buttons'];
				unset($slider_settings['fade_thumbnail_buttons']);
			}
			
			if (isset($slider_settings['fade_thumbnail_arrows'])) {
				$slider_settings['thumbnail_arrows_toggle'] = $slider_settings['fade_thumbnail_arrows'];
				unset($slider_settings['fade_thumbnail_arrows']);
			}
			
			if (isset($slider_settings['fade_thumbnail_scrollbar'])) {
				$slider_settings['thumbnail_scrollbar_toggle'] = $slider_settings['fade_thumbnail_scrollbar'];
				unset($slider_settings['fade_thumbnail_scrollbar']);
			}
			
			if (isset($slider_settings['lightbox_navigation'])) {
				$slider_settings['lightbox_gallery'] = $slider_settings['lightbox_navigation'];
				unset($slider_settings['lightbox_navigation']);
			}
			
			
			global $sliderpro_slider_settings;
			
			foreach ($slider_settings as $name => $value) {
				if (isset($sliderpro_slider_settings[$name]))
					if ($sliderpro_slider_settings[$name]['category'] != 'general' && $value == $sliderpro_slider_settings[$name]['default_value'])
						unset($slider_settings[$name]);
			}
			
			
			$wpdb->update($wpdb->prefix . 'sliderpro_sliders', array('settings'=>serialize($slider_settings)),
																array('id'=>$id), 
																array('%s'), 
																array('%d'));
		}
		
		
		// make modifications to the individual slides
		$slides = $wpdb->get_results("SELECT id, settings, content FROM " . $wpdb->prefix . "sliderpro_slides", ARRAY_A);
		
		$slide_index = 0;
		
		foreach($slides as $slide) {
			$id = $slide['id'];
			$slide_settings = unserialize($slide['settings']);
			$slide_content = unserialize($slide['content']);
			
			foreach($slide_settings as $name => $value) {			
				if (strpos($name, '_override')) {
					if ($value == false) {
						$setting = str_replace('_override', '', $name);
						unset($slide_settings[$setting]);
					}
					
					unset($slide_settings[$name]);
				}
			}
			
			// modify existing settings
			if (isset($slide_settings['simple_slide_direction'])) {
				$slide_settings['slide_direction'] = $slide_settings['simple_slide_direction'];
				unset($slide_settings['simple_slide_direction']);
			}
			
			if (isset($slide_settings['simple_slide_duration'])) {
				$slide_settings['slide_duration'] = $slide_settings['simple_slide_duration'];
				unset($slide_settings['simple_slide_duration']);
			}
			
			if (isset($slide_settings['simple_slide_easing'])) {
				$slide_settings['slide_easing'] = $slide_settings['simple_slide_easing'];
				unset($slide_settings['simple_slide_easing']);
			}
			
			if (isset($slide_settings['slide_start_ratio'])) {
				$slide_settings['slice_start_ratio'] = $slide_settings['slide_start_ratio'];
				unset($slide_settings['slide_start_ratio']);
			}
			
			if (isset($slide_settings['slide_start_position'])) {
				$slide_settings['slice_start_position'] = $slide_settings['slide_start_position'];
				unset($slide_settings['slide_start_position']);
			}	

			if (isset($slide_settings['hide_caption'])) {
				$slide_settings['caption_toggle'] = $slide_settings['hide_caption'];
				unset($slide_settings['hide_caption']);
			}			
			
			if (isset($slide_settings['link_target'])) {
				$slide_settings['slide_link_target'] = $slide_settings['link_target'];
			} else {
				$slide_settings['slide_link_target'] = isset($slider_settings['link_target']) ? $slider_settings['link_target'] : '_self';
			}
			
			
			
			if (isset($slide_settings['dynamic_slide'])) {
				$slide_settings['slide_type'] = 'posts';
				unset($slide_settings['dynamic_slide']);
			}
			
			if (isset($slide_settings['dynamic_post_types'])) {
				$slide_settings['dynamic_posts_types'] = $slide_settings['dynamic_post_types'];
				unset($slide_settings['dynamic_post_types']);
			}
			
			if (isset($slide_settings['dynamic_taxonomies'])) {
				$slide_settings['dynamic_posts_taxonomies'] = $slide_settings['dynamic_taxonomies'];
				unset($slide_settings['dynamic_taxonomies']);
			}
			
			if (isset($slide_settings['dynamic_relation'])) {
				$slide_settings['dynamic_posts_relation'] = $slide_settings['dynamic_relation'];
				unset($slide_settings['dynamic_relation']);
			}
			
			if (isset($slide_settings['dynamic_orderby'])) {
				$slide_settings['dynamic_posts_orderby'] = $slide_settings['dynamic_orderby'];
				unset($slide_settings['dynamic_orderby']);
			}
			
			if (isset($slide_settings['dynamic_order'])) {
				$slide_settings['dynamic_posts_order'] = $slide_settings['dynamic_order'];
				unset($slide_settings['dynamic_order']);
			}
			
			if (isset($slide_settings['dynamic_maximum'])) {
				$slide_settings['dynamic_posts_maximum'] = $slide_settings['dynamic_maximum'];
				unset($slide_settings['dynamic_maximum']);
			}
			
			if (isset($slide_settings['dynamic_offset'])) {
				$slide_settings['dynamic_posts_offset'] = $slide_settings['dynamic_offset'];
				unset($slide_settings['dynamic_offset']);
			}
			
			if (isset($slide_settings['dynamic_featured'])) {
				$slide_settings['dynamic_posts_featured'] = $slide_settings['dynamic_featured'];
				unset($slide_settings['dynamic_featured']);
			}
			
			
			
			// modify existing content
			if (isset($slide_content['link'])) {
				$slide_content['slide_link_path'] = $slide_content['link'];
				unset($slide_content['link']);
			}			
			
			if (isset($slide_content['lightbox_content'])) {
				if ($slide_content['slide_link_path'] == '' && $slide_content['lightbox_content'] != '') {
					$slide_content['slide_link_path'] = $slide_content['lightbox_content'];
					$slide_settings['slide_link_lightbox'] = true;
				}
				
				unset($slide_content['lightbox_content']);
			}
			
			if (isset($slide_content['lightbox_title']) &&  $slide_content['alt'] == '') {
				$slide_content['alt'] = $slide_content['lightbox_title'];
				unset($slide_content['lightbox_title']);
			}
			
			if (isset($slide_content['lightbox_description'])) {
				$slide_content['slide_link_title'] = $slide_content['lightbox_description'];
				unset($slide_content['lightbox_description']);
			}
			
			if (isset($slide_content['thumbnail_caption'])) {
				$slide_content['thumbnail_title'] = $slide_content['thumbnail_caption'];
				unset($slide_content['thumbnail_caption']);
			}
			
			if (isset($slide_content['thumbnail_tooltip'])) {
				$slide_content['thumbnail_alt'] = $slide_content['thumbnail_tooltip'];
				unset($slide_content['thumbnail_tooltip']);
			}
			
			$slide_index++;
			$wpdb->update($wpdb->prefix . 'sliderpro_slides', array('settings' => serialize($slide_settings),
																	 'content' => serialize($slide_content)),
															   array('id'=>$id), 
															   array('%s', '%s'), 
															   array('%d'));
		}
		
		// add new plugin options
		update_option('slider_pro_progress_animation', true);
		update_option('slider_pro_use_compressed_scripts', true);
		update_option('slider_pro_enqueue_jquery', true);
		update_option('slider_pro_show_admin_bar_links', true);
		update_option('slider_pro_generate_xml_file', true);
		update_option('slider_pro_role_access', 'Administrator');
	}
	
	
	if (version_compare($slider_pro_db_version, '2.0.1', '<')) {
		update_option('slider_pro_visual_editor', true);
	}
	
	
	if (version_compare($slider_pro_db_version, '2.1', '<')) {
		update_option('slider_pro_update_notification', true);
		update_option('slider_pro_automatic_update_status', 'disabled');
	}


	if (version_compare($slider_pro_db_version, '3.0', '<')) {
		update_option('slider_pro_multisite_path_rewrite', true);
		update_option('slider_pro_caption_html', true);
		update_option('slider_pro_dynamic_slides_featured_filter', true);

		// add/update skins in the database
		sliderpro_refresh_skins(array('slider', 'scrollbar'));
	}


	if (version_compare($slider_pro_db_version, '3.5', '<')) {
		update_option('slider_pro_custom_media_loader', true);
	}
}

update_option('slider_pro_version', SLIDER_PRO_VERSION);
?>