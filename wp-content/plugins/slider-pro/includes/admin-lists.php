<?php

// list of all values that a certain property can take
$sliderpro_slider_settings_lists = array('align_type' => array('leftTop', 'centerTop', 'rightTop', 'leftCenter', 'centerCenter', 'rightCenter', 'leftBottom', 
															   'centerBottom', 'rightBottom'),
										 
										 'scale_type' => array('noScale', 'exactFit', 'insideFit', 'outsideFit', 'proportionalFit'),
										 
										 'link_target' => array('_self', '_blank', '_parent', '_top'),
										  
										 'effect_type' => array('random', 'slide', 'fade', 'slice', 'swipe', 'none'),
										  
										 'slice_effect_type' => array('random', 'scale', 'fade', 'width', 'height', 'slide'),
										  
										 'thumbnail_type' => array('tooltip', 'scroller', 'tooltipAndScroller', 'none'),
										  
										 'slice_pattern' => array('randomPattern', 'topToBottom', 'bottomToTop', 'leftToRight', 'rightToLeft', 'topLeftToBottomRight', 
										 						  'topRightToBottomLeft', 'bottomLeftToTopRight', 'bottomRightToTopLeft', 'horizontalMarginToCenter', 
																  'horizontalCenterToMargin', 'verticalMarginToCenter', 'verticalCenterToMargin', 'skipOneTopToBottom',
																  'skipOneBottomToTop', 'skipOneLeftToRight', 'skipOneRightToLeft', 'skipOneHorizontal', 'skipOneVertical', 
																  'spiralMarginToCenterCW', 'spiralMarginToCenterCCW', 'spiralCenterToMarginCW', 'spiralCenterToMarginCCW', 
																  'random'),
										  
										 'easing' => array('swing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 
										 				   'easeInQuart', 'easeOutQuart', 'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 
														   'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 
														   'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 
														   'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce'),
										  
										 'slice_point' => array('leftTop', 'centerTop', 'rightTop', 'leftCenter', 'centerCenter', 'rightCenter', 'leftBottom', 
										 						'centerBottom', 'rightBottom'),
										  
										 'slice_start_position' => array('left', 'right', 'top', 'bottom', 'leftTop', 'rightTop', 'leftBottom', 
										 								 'rightBottom', 'horizontalAlternate', 'verticalAlternate', 'random'),
										  
										 'slide_direction' => array('random', 'autoHorizontal', 'autoVertical', 'rightToLeft', 'leftToRight', 'topToBottom', 'bottomToTop'),
										 
										 'swipe_orientation' => array('horizontal', 'vertical'),
										  
										 'slideshow_direction' => array('next', 'previous'),
										  
										 'thumbnail_orientation' => array('horizontal', 'vertical'),
										  
										 'thumbnail_caption_position' => array('bottom', 'top'),
										  
										 'thumbnail_caption_effect' => array('slide', 'fade'),
										  
										 'caption_position' => array('bottom', 'top', 'left', 'right', 'custom'),
										  
										 'caption_effect' => array('slide', 'fade'),
										  
										 'caption_slide_direction' => array('auto', 'topToBottom', 'bottomToTop', 'leftToRight', 'rightToLeft'),
										  
										 'lightbox_theme' => array('pp_default', 'light_rounded', 'dark_rounded', 'light_square', 'dark_square', 'facebook'),
										  
										 'resizing_crop' => array(0, 1, 2, 3),
										 
										 'resizing_align' => array('c', 't', 'l', 'r', 'b', 'tl', 'tr', 'bl', 'br'),
										  
										 'video_play_action' => array('stopSlideshow', 'pauseSlideshow', 'none'),
										  
										 'video_pause_action' => array('startSlideshow', 'resumeSlideshow', 'none'),
										  
										 'video_end_action' => array('resetVideo', 'replayVideo', 'startSlideshow', 'resumeSlideshow', 'nextSlide', 'none'),
										  
										 'leave_video_action' => array('stopVideo', 'pauseVideoAndBuffering', 'pauseVideo', 'removeVideo'),
										 
										 'reach_video_action' => array('none', 'playVideo'),
										 
										 'slide_types' => array('static', 'posts', 'gallery', 'flickr'),
										 
										 'dynamic_posts_relation' => array('and', 'or'),
										 
										 'dynamic_posts_orderby' => array('date', 'comment_count', 'title', 'rand'),
										 
										 'dynamic_posts_order' => array('DESC', 'ASC'),
										 
										 'dynamic_gallery_order' => array('DESC', 'ASC'),
										 
										 'dynamic_flickr_data_type' => array('set', 'username'),
										 
										 'layer_transition' => array('none', 'left', 'right', 'up', 'down'),

										 'layer_position' => array('topLeft', 'topRight', 'bottomLeft', 'bottomRight'));



// associates the properties with a shortname
$sliderpro_settings_pretty_name = array('leftTop' => __('Top Left', 'slider_pro'), 'centerTop' => __('Top Center', 'slider_pro'), 'rightTop' => __('Top Right', 'slider_pro'), 
										'leftCenter' => __('Center Left', 'slider_pro'), 'centerCenter' => __('Center Center', 'slider_pro'), 
										'rightCenter' => __('Center Right', 'slider_pro'), 'leftBottom' => __('Bottom Left', 'slider_pro'), 
										'centerBottom' => __('Bottom Center', 'slider_pro'), 'rightBottom' => __('Bottom Right', 'slider_pro'),
									  
										'topLeft' => __('Top Left', 'slider_pro'), 'topRight' => __('Top Right', 'slider_pro'), 
										'bottomLeft' => __('Bottom Left', 'slider_pro'),	'bottomRight' => __('Bottom Right', 'slider_pro'),

									   	'randomPattern' => 'Random Pattern', 'topToBottom' => 'Top To Bottom', 'bottomToTop' => 'Bottom To Top', 'leftToRight' => 'Left To Right', 
									   	'rightToLeft' => 'Right To Left', 'topLeftToBottomRight' => 'Top Left To Bottom Right', 
									   	'topRightToBottomLeft' => 'Top Right To Bottom Left', 'bottomLeftToTopRight' => 'Bottom Left To Top Right', 
									   	'bottomRightToTopLeft' => 'Bottom Right To Top Left', 'horizontalMarginToCenter' => 'Horizontal Margin To Center', 
									   	'horizontalCenterToMargin' => 'Horizontal Center To Margin', 'verticalMarginToCenter' => 'Vertical Margin To Center', 
									   	'verticalCenterToMargin' => 'Vertical Center To Margin', 'skipOneTopToBottom' => 'Skip One Top To Bottom', 
									   	'skipOneBottomToTop' => 'Skip One Bottom To Top', 'skipOneLeftToRight' => 'Skip One Left To Right', 'skipOneRightToLeft' => 'Skip One Right To Left', 
									   	'skipOneHorizontal' => 'Skip One Horizontal', 'skipOneVertical' => 'Skip One Vertical', 'spiralMarginToCenterCW' => 'Spiral Margin To Center CW', 
									   	'spiralMarginToCenterCCW' => 'Spiral Margin To Center CCW', 'spiralCenterToMarginCW' => 'Spiral Center To Margin CW', 
									   	'spiralCenterToMarginCCW' => 'Spiral Center To Margin CCW', 'random' => 'Random',
									   
									   	'swing' => 'Swing', 'easeInQuad' => 'Quad In', 'easeOutQuad' => 'Quad Out', 'easeInOutQuad' => 'Quad In Out', 'easeInCubic' => 'Cubic In', 
									   	'easeOutCubic' => 'Cubic Out', 'easeInOutCubic' => 'Cubic In Out', 'easeInQuart' => 'Quart In', 'easeOutQuart' => 'Quart Out', 
									   	'easeInOutQuart' => 'Quart In Out', 'easeInQuint' => 'Quint In', 'easeOutQuint' => 'Quint Out', 'easeInOutQuint' => 'Quint In Out', 
									   	'easeInSine' => 'Sine In', 'easeOutSine' => 'Sine Out', 'easeInOutSine' => 'Sine In Out', 'easeInExpo' => 'Expo In', 
									   	'easeOutExpo' => 'Expo Out', 'easeInOutExpo' => 'Expo In Out', 'easeInCirc' => 'Circ In', 'easeOutCirc' => 'Circ Out', 
									   	'easeInOutCirc' => 'Circ In Out', 'easeInElastic' => 'Elastic In', 'easeOutElastic' => 'Elastic Out', 'easeInOutElastic' => 'Elastic In Out', 
									   	'easeInBack' => 'Back In', 'easeOutBack' => 'Back Out', 'easeInOutBack' => 'Back In Out', 'easeInBounce' => 'Bounce In', 
									   	'easeOutBounce' => 'Bounce Out', 'easeInOutBounce' => 'Bounce In Out',
										
									   	'auto' => __('Auto', 'slider_pro'), 'autoHorizontal' => __('Auto Horizontal', 'slider_pro'), 'autoVertical' => __('Auto Vertical', 'slider_pro'),
										
									   	'left' => __('Left', 'slider_pro'), 'right' => __('Right', 'slider_pro'), 'top' => __('Top', 'slider_pro'), 'bottom' => __('Bottom', 'slider_pro'), 
									   	'up' => __('Up', 'slider_pro'), 'down' => __('Down', 'slider_pro'),
									   	'horizontalAlternate' => __('Horizontal Alternate', 'slider_pro'), 'verticalAlternate' => __('Vertical Alternate', 'slider_pro'),
										
									   	'custom' => __('Custom', 'slider_pro'),
									   
									   	'horizontal' => __('Horizontal', 'slider_pro'), 'vertical' => __('Vertical', 'slider_pro'),
									   
									   	'scroller' => __('Scroller', 'slider_pro'),  'tooltip' => __('Tooltip', 'slider_pro'),  'tooltipAndScroller' => __('Tooltip And Scroller', 'slider_pro'),
									   
									   	'pp_default' => 'Default', 'light_rounded' => 'Light Rounded', 'dark_rounded' => 'Dark Rounded', 
									   	'light_square' => 'Light Square', 'dark_square' => 'Dark Square', 'facebook' => 'Facebook',
									   
									   	'noScale' => __('No Scale', 'slider_pro'), 'exactFit' => __('Exact Fit', 'slider_pro'), 'insideFit' => __('Inside Fit', 'slider_pro'), 
										'outsideFit' => __('Outside Fit', 'slider_pro'), 'proportionalFit' => __('Proportional', 'slider_pro'),
									   
									   	'none' => __('None', 'slider_pro'), 'stopSlideshow' => __('Stop Slideshow', 'slider_pro'), 'pauseSlideshow' => __('Pause Slideshow', 'slider_pro'), 
										'startSlideshow' => __('Start Slideshow', 'slider_pro'), 'resumeSlideshow' => __('Resume Slideshow', 'slider_pro'), 'resetVideo' => __('Reset Video', 'slider_pro'), 
										'nextSlide' => __('Next Slide', 'slider_pro'), 'startVideo' => __('Start Video', 'slider_pro'), 'pauseVideo' => __('Pause Video', 'slider_pro'), 
										'stopVideo' => __('Stop Video', 'slider_pro'), 'playVideo' => __('Play Video', 'slider_pro'), 'pauseVideoAndBuffering' => __('Pause Video And Buffering', 'slider_pro'),
										'removeVideo' => __('Remove Video', 'slider_pro'),
									   
									   	'slice' => __('Slice', 'slider_pro'), 'slide' => __('Slide', 'slider_pro'), 'swipe' => __('Swipe', 'slider_pro'), 'fade' => __('Fade', 'slider_pro'), 
										'scale' => __('Scale', 'slider_pro'), 'width' => __('Width', 'slider_pro'), 'height' => __('Height', 'slider_pro'), 'random' => __('Random', 'slider_pro'),
									   
									   	'date' => __('Date', 'slider_pro'), 'comment_count' => __('Comments', 'slider_pro'), 'title' => __('Title', 'slider_pro'), 'rand' => __('Random', 'slider_pro'),
									   
									   	'and' => __('AND', 'slider_pro'), 'or' => __('OR', 'slider_pro'),
									   
									   	'static' => __('Static', 'slider_pro'), 'posts' => __('Posts Content', 'slider_pro'), 'gallery' => __('Gallery Images', 'slider_pro'), 'flickr' => __('Flickr', 'slider_pro'), 
										
										'set' => __('Set', 'slider_pro'), 'gallery' => __('Gallery', 'slider_pro'), 'username' => __('Username', 'slider_pro'), 
										
									   	'c' => __('Center', 'slider_pro'), 't' => __('Top', 'slider_pro'), 'l' => __('Left', 'slider_pro'), 'r' => __('Right', 'slider_pro'), 
										'b' => __('Bottom', 'slider_pro'), 'tl' => __('Top Left', 'slider_pro'), 'tr' => __('Top Right', 'slider_pro'), 'bl' => __('Bottom Left', 'slider_pro'), 
										'br' => __('Bottom Right', 'slider_pro'),

										'black' => __('Black', 'slider_pro'), 'white' => __('White', 'slider_pro'), 'rounded' => __('Rounded', 'slider_pro'));
									   


// contains some description for each of the available settings
$sliderpro_properties_help = array('width' => __('The total width of the slider. 
												  Can be set in percentages if the \'%\' symbol is used or in pixels if only a number is used.
												  If the slider is set to be responsive, the specified value will represent the maximum width.', 'slider_pro') .'<br/><br/><b>'. 
											  __('Setting Name: ', 'slider_pro') .'</b><i> width </i>', 
									
									'height' => __('The total height of the slider. 
													Can be set in percentages if the \'%\' symbol is used or in pixels if only a number is used.
													If the slider is set to be responsive, the specified value will represent the maximum height.', 'slider_pro') .'<br/><br/><b>'. 
												__('Setting Name: ', 'slider_pro') .'</b><i> height </i>', 
									
									'responsive' => __('Sets the slider to be responsive. The values specified for the Width and Height options will represent 
														the maximum width and height for the slider.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> responsive </i>', 

									'aspect_ratio' => __('Sets the aspect ratio of the slider. The aspect ratio defines the ratio between the width and the height of the slider. 
														  A ratio of 2 will make the slider width 2 times larger than the height. <br/>
														  The default value, -1, indicates that an aspect ratio will not be applied to the slider.', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> aspect_ratio </i>', 
												
									'shadow' => __('Indicates whether the slider shadow will be displayed.', 'slider_pro') .'<br/><br/><b>'. 
												__('Setting Name: ', 'slider_pro') .'</b><i> shadow </i>',

									'border' => __('Indicates whether a border will be displayed around the slide. This customization can also be done with CSS.', 'slider_pro') .'<br/><br/><b>'. 
												__('Setting Name: ', 'slider_pro') .'</b><i> border </i>', 

									'glow' => __('Indicates whether a glow effect will be displayed around the slide. This customization can also be done with CSS.', 'slider_pro') .'<br/><br/><b>'. 
											  __('Setting Name: ', 'slider_pro') .'</b><i> glow </i>', 
												
									'skin' => __('The Skin of the slider.', 'slider_pro') .'<br/><br/><b>'. 
											  __('Setting Name: ', 'slider_pro') .'</b><i> skin </i>', 
									
									'scrollbar_skin'  => __('The Skin of the scrollbar.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> scrollbar_skin </i>',
											  
									'include_skin' => __('You only need to check this option if you add the slider in the header, sidebar or anywhere else outside a regular post/page.', 'slider_pro'), 
														  
									'align_type' => __('Sets the alignment of the slide\'s image.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> align_type </i>',
													
									'scale_type' => __('Sets the scaling type of the image.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> scale_type </i>', 
													
									'allow_scale_up' => __('Allows the image to scale up to a size larger than the original size.', 'slider_pro') . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> allow_scale_up </i>', 
									
									'lazy_loading' => __('Indicates whether the images will be loaded only when they are requested.', 'slider_pro') . '<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> lazy_loading </i>',
													  
									'preload_nearby_images' => __('Indicates whether the images located nearby the currently opened image will be preloaded.
																   This will happen only if the nearby images are set to lazy load.', 'slider_pro') . '<br/><br/><b>'. 
													  		   __('Setting Name: ', 'slider_pro') .'</b><i> preload_nearby_images </i>',
													 
									'slide_start' => __('The index of the slide which will be visible when the slider starts.', 'slider_pro') . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> slide_start </i>', 
									
									'shuffle' => __('Indicates whether the slides will be shuffled.', 'slider_pro') .'<br/><br/><b>'. 
												 __('Setting Name: ', 'slider_pro') .'</b><i> shuffle </i>', 
									
									'fade_previous_slide' => __('Indicates whether the previous slide will fade out during transition.', 'slider_pro') . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> fade_previous_slide </i>', 
									
									'fade_previous_slide_duration' => __('Sets the fade out duration for the previous slide, when the feature is used.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> fade_previous_slide_duration </i>', 
									
									'slideshow' => __('Sets the slideshow mode.', 'slider_pro') .'<br/><br/><b>'. 
												   __('Setting Name: ', 'slider_pro') .'</b><i> slideshow </i>', 
												   
									'slideshow_loop' => __('Indicates whether the slider will loop continuously through the slides or only one time.', 'slider_pro') .'<br/><br/><b>'. 
												   		__('Setting Name: ', 'slider_pro') .'</b><i> slideshow_loop </i>', 
									
									'slideshow_delay' => __('Sets the delay, in milliseconds, for the slideshow mode.', 'slider_pro') . '<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> slideshow_delay </i>', 
									
									'slideshow_direction' => __('Sets the direction of the slideshow. If \'next\' was specified the slideshow 
																will advance to the next slide, 							
																if \'previous\' the slideshow will open the previous slide.', 'slider_pro') . '<br/><br/><b>'. 
															 __('Available Values: ', 'slider_pro') .'</b><i>Next, Previous</i>'  . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> slideshow_direction </i>', 
									
									'slideshow_controls' => __('Indicates whether the slideshow button will be displayed.', 'slider_pro') .'<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> slideshow_controls </i>', 
									
									'slideshow_controls_toggle' => __('Indicates whether the slideshow button will fade in/out on  mouse hover.', 'slider_pro') .'<br/><br/><b>'.
																   __('Setting Name: ', 'slider_pro') .'</b><i> slideshow_controls_toggle </i>', 
									
									'slideshow_controls_show_duration' => __('Sets the duration for the fade in animations of the slideshow button.', 'slider_pro') .'<br/><br/><b>'. 
																		  __('Setting Name: ', 'slider_pro') .'</b><i> slideshow_controls_show_duration </i>', 
									
									'slideshow_controls_hide_duration' => __('Sets the duration for the fade out animations of the slideshow button.', 'slider_pro') .'<br/><br/><b>'. 
																		  __('Setting Name: ', 'slider_pro') .'</b><i> slideshow_controls_hide_duration </i>', 
									
									'pause_slideshow_on_hover' => __('Indicates whether the slideshow will be paused when the mouse is over the slide.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> pause_slideshow_on_hover </i>', 
									
									'lightbox' => __('Enables the lightbox for all slides. 
													  This is an alternative for enabling the Lightbox option for each individual slide.', 'slider_pro') .'<br/><br/><b>'. 
												  __('Setting Name: ', 'slider_pro') .'</b><i> lightbox </i>',
													  
									'lightbox_theme' => __('Sets the theme of the lightbox.', 'slider_pro') .'<br/><br/><b>'. 
														__('Available Values: ', 'slider_pro') .'</b> <br/>
														   <i>Default, Light Rounded, Dark Rounded, 
														   Light Square, Dark Square, Facebook</i>' . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> lightbox_theme </i>', 
													  
									'lightbox_opacity' => __('Sets the opacity of the lightbox\'s overlay.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_opacity </i>', 
									
									'lightbox_autoplay' => __('Indicates whether the lightbox will play automatically.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_autoplay </i>', 

									'lightbox_autoplay_delay' => __('Sets the delay of the lightbox\'s autoplay function.', 'slider_pro') .'<br/><br/><b>'. 
														  		 __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_autoplay_delay </i>', 

									'lightbox_video_autoplay' => __('Indicates whether the videos in the lightbox will play automatically.', 'slider_pro') .'<br/><br/><b>'. 
														  		 __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_video_autoplay </i>', 

									'ligthbox_allow_resize' => __('Indicates whether the lightbox resize button will be visible.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_allow_resize </i>', 

									'lightbox_icon' => __('Indicate whether an overlay icon will appear when a slide or thumbnail 
														   has a lightbox attached to it.', 'slider_pro') .'<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_icon </i>', 
									
									'lightbox_icon_toggle' => __('Indicates whether the lightbox icon will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
														  	  __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_icon_toggle </i>', 
														  
									'lightbox_icon_fade_duration' => __('Sets the duration for the fade in/out animation of the lightbox icon.', 'slider_pro') .'<br/><br/><b>'. 
														  			 __('Setting Name: ', 'slider_pro') .'</b><i> lightbox_icon_fade_duration </i>', 
									
									'thumbnail_lightbox_icon' => __('Indicates whether a lightbox icon will be displayed on the thumbnail
																	 when the corresponding slide has a lightbox attached to it.' . '<br/><b>'. 
																	'Not to be confused with the possibility of having the icon displayed when 
																	 a lightbox is attached to the thumbnail itself. For this, only the \'Lightbox Icon\' 
																	 option needs to be enabled.', 'slider_pro') .'<br/><br/><b>'. 
														  		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_lightbox_icon </i>', 
																	 
									'thumbnail_lightbox_icon_toggle' => __('Indicates whether the thumbnail lightbox icon will fade in/out on hover.
																			This option is used only when the lightbox icon is enabled for the thumbnails
																			that correspond to slides that have a lightbox attached to them.', 'slider_pro') .'<br/><br/><b>'. 
														  				__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_lightbox_icon_toggle </i>',
																	 					  
									'lightbox_gallery' => __('Indicates whether the navigation controls will be enabled in the lightbox.', 'slider_pro'),
									
									'fullscreen_controls' => __('Indicates whether the fullscreen controls will be displayed.', 'slider_pro') .'<br/><br/><b>'. 
														 	 __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_controls </i>', 
									
									'fullscreen_controls_toggle' => __('Indicates whether the fullscreen controls will be displayed only when the mouse is over the slide.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_controls_toggle </i>', 
															 
									'fullscreen_controls_show_duration' => __('Sets the duration for the fade in animation of the fullscreen controls.', 'slider_pro') .'<br/><br/><b>'. 
														 	 			   __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_controls_show_duration </i>', 
																		   
									'fullscreen_controls_hide_duration' => __('Sets the duration for the fade out animation of the fullscreen controls.', 'slider_pro') .'<br/><br/><b>'. 
														 	 			   __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_controls_hide_duration </i>', 
									
									'fullscreen_thumbnail_scroller_overlay' => __('Indicates whether the thumbnail scroller, if enabled, will be displayed over the slide image.', 'slider_pro') .'<br/><br/><b>'. 
														 	 			   	   __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_thumbnail_scroller_overlay </i>', 
																		   
									'fullscreen_slide_buttons' => __('Indicates whether the slide buttons, if enabled, will be displayed. By default, the buttons will be hidden.', 'slider_pro') .'<br/><br/><b>'. 
														 	 	  __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_slide_buttons </i>', 
																		   
									'fullscreen_shadow' => __('Indicates whether the slider\'s 3D shadow, if enabled, will be displayed. By default, the shadow will be hidden.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> fullscreen_shadow </i>', 
																		   						 					 
									'timer_animation' => __('Indicates whether the timer animation will be displayed.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> timer_animation </i>', 
									
									'timer_animation_controls' => __('Indicates whether the play and pause button will be displayed inside the timer animation.', 'slider_pro') .'<br/><br/><b>'. 
														 		  __('Setting Name: ', 'slider_pro') .'</b><i> timer_animation_controls </i>', 
														 
									'timer_fade_duration' => __('Sets the duration for the fade in/out animation of the timer.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> timer_fade_duration </i>', 
									
									'timer_toggle' => __('Indicates whether the timer will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> timer_toggle </i>', 
									
									'timer_radius' => __('Sets the radius of the timer.', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> timer_radius </i>', 
											
									'timer_stroke_color1' => __('Sets the color of the timer\'s back stroke.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_color1 </i>', 
									
									'timer_stroke_color2' => __('Sets the color of the timer\'s front stroke.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_color2 </i>', 
									
									'timer_stroke_opacity1' => __('Sets the opacity of the timer\'s back stroke.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_opacity1 </i>', 
									
									'timer_stroke_opacity2' => __('Sets the opacity of the timer\'s front stroke.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_opacity2 </i>', 
									
									'timer_stroke_width1' => __('Sets the width of the timer\'s back stroke.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_width1 </i>', 
									
									'timer_stroke_width2' => __('Sets the width of the timer\'s front stroke.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> timer_stroke_width2 </i>', 
									
									'override_transition' => __('Indicates whether it\'s permitted to start 
																 a new transition while another one is in progress.', 'slider_pro') .'<br/><br/><b>'.
															 __('Setting Name: ', 'slider_pro') .'</b><i> override_transition </i>', 
									
									'effect_type' => __('Sets the transition effect type.', 'slider_pro') .'<br/><br/><b>'. 
													 __('Available Values: ', 'slider_pro') .'</b> <br/>
														<i>Fade, Slide, Swipe, <br/>
														Slice, None, Random</i>' . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> effect_type </i>',
													 
									'css3_transitions' => __('Indicates whether the transition effects 
															  will use the hardware accelerated CSS3 transition capabilities.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> css3_transitions </i>',
													 
									'slice_effect_type' => __('Sets the effect type for the "slice" transition.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	  <i>Fade, Slide, Scale, <br/>
															  Width, Height, Random</i>' . '<br/><br/><b>'. 
													 	   __('Setting Name: ', 'slider_pro') .'</b><i> slice_effect_type </i>',  
													 
									'initial_effect' => __('Indicates whether the initial slide will have a transition effect. 
															If set to false, the first slide will initially appear instantly.', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> initial_effect </i>', 
									
									'html_during_transition' => __('Indicates whether specified HTML content will be displayed while the transition is in progress. 
																	A transition which displayes HTML will be slower.', 'slider_pro') .'<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> html_during_transition </i>', 							
									
									'slide_direction' => __('Sets the direction of the slides.', 'slider_pro') . '<br/><br/><b>'.
														 __('Available Values: ', 'slider_pro') .'</b> <br/>
														 <i>Auto Horizontal, Auto Vertical, <br/>
														 Right To Left, Left To Right, <br/>
														 Top To Bottom, Bottom To Top, Random</i>' . '<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> slide_direction </i>', 
									
									'slide_loop' => __('Indicates whether the slides will run in a loop 
														when the \'auto H\' or \'auto V\' directions are used.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> slide_loop </i>', 
									
									'slide_duration' => __('Sets the duration of the transition.', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> slide_duration </i>', 
									
									'slide_easing' => __('Sets the easing of the transition effect', 'slider_pro') . '<br/><br/><b>'.
													  __('Setting Name: ', 'slider_pro') .'</b><i> slide_easing </i>', 
									
									'swipe_touch_drag' => __('Indicates whether the swipe effect will work for touch gestures.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> swipe_touch_drag </i>', 
									
									'swipe_mouse_drag' => __('Indicates whether the swipe effect will work when the mouse is used.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> swipe_mouse_drag </i>', 
														
									'swipe_orientation' => __('Sets the orientation of the slides and the direction 
															   for which the swipe gestures will work.', 'slider_pro') .'<br/><br/><b>'.
														   __('Available Values: ', 'slider_pro') .'</b><i>Horizontal, Vertical</i>' . '<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> swipe_orientation </i>', 
														
									'swipe_threshold' => __('Sets the minimum amount that the slides need to be 
															 dragged in order to navigate to the new slide.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> swipe_threshold </i>', 
														
									'swipe_duration' => __('Sets the duration of the swipe transition.', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> swipe_duration </i>', 
														
									'swipe_back_duration' => __('Sets the duration of slide\'s movement when the drag amount is below the threshold.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> swipe_back_duration </i>', 
														
									'swipe_slide_distance' => __('Sets the distance between slides.', 'slider_pro') .'<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> swipe_slide_distance </i>', 
									
									'swipe_grab_cursor' => __('Enables the grabbing cursor for the Swipe effect.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> swipe_grab_cursor </i>', 
														
									'swipe_easing' => __('Sets the easing of the transition.', 'slider_pro') .'<br/><br/><b>'.
													  __('Setting Name: ', 'slider_pro') .'</b><i> swipe_easing </i>',
																			
									'fade_in_duration' => __('Sets the duration of \'in\' transition.', 'slider_pro') .'<br/><br/><b>'. 
													 	  __('Setting Name: ', 'slider_pro') .'</b><i> fade_in_duration </i>',
														  
									'fade_in_easing' => __('Sets the easing type of \'in\' transition.', 'slider_pro') .'<br/><br/><b>'.
													 	__('Setting Name: ', 'slider_pro') .'</b><i> fade_in_easing </i>',
														  
									'fade_out_duration' => __('Sets the duration of \'out\' transition.', 'slider_pro') .'<br/><br/><b>'. 
													 	   __('Setting Name: ', 'slider_pro') .'</b><i> fade_out_duration </i>',
														  
									'fade_out_easing' => __('Sets the easing type of \'out\' transition.', 'slider_pro') .'<br/><br/><b>'.
													 	 __('Setting Name: ', 'slider_pro') .'</b><i> fade_out_easing </i>',
									
									'slice_delay' => __('Sets the delay between each slice (square) animation.', 'slider_pro') .'<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> slice_delay </i>', 
												
									'slice_duration' => __('Sets the duration of each slice animation.', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> slice_duration </i>', 
									
									'slice_easing' => __('Sets the easing of each slice animation.', 'slider_pro') .'<br/><br/><b>'.
													  __('Setting Name: ', 'slider_pro') .'</b><i> slice_easing </i>', 
									
									'horizontal_slices' => __('Sets the number of horizontal slices.', 'slider_pro').'<br/><br/><b>'.
														   __('Setting Name: ', 'slider_pro') .'</b><i> horizontal_slices </i>',
									
									'vertical_slices' => __('Sets the number of vertical slices.', 'slider_pro').'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> vertical_slices </i>', 
									
									'slice_pattern' => __('Sets the pattern in which the slices will be animated.', 'slider_pro').'<br/><br/><b>'.
													   __('Available Values: ', 'slider_pro') .'</b> <br/>
													  	  <i>Random Pattern, <br/>
													   	  Top To Bottom, Bottom To Top, <br/>
														  Left To Right, Right To Left, <br/>
														  Top Left To Bottom Right, Top Right To Bottom Left, <br/>
														  Bottom Left To Top Right, Bottom Right To Top Left, <br/>
														  Horizontal Margin To Center, <br/>
														  Horizontal Center To Margin, <br/>
														  Vertical Margin To Center, <br/>
														  Vertical Center To Margin, <br/>
														  Skip One Top To Bottom, Skip One Bottom To Top, <br/>
														  Skip One Left To Right, Skip One Right To Left, <br/>
														  Skip One Horizontal, Skip One Vertical, <br/>
														  Spiral Margin To Center CW, <br/>
														  Spiral Margin To Center CCW, <br/>
														  Spiral Center To Margin CW, <br/>
														  Spiral Center To Margin CCW</i> <br/>
														  and <i>Random</i>' . '<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> slice_pattern </i>', 
									
									'slice_point' => __('Sets the point from which the slice will begin to grow 
														when the \'scale\', \'width\' or \'height\' effects are used.', 'slider_pro').'<br/><br/><b>'.
													 __('Available Values: ', 'slider_pro') .'</b> <br/>
													 	<i>Top Left, Top Center, Top Right, <br/>
													 	Center Left, Center Center, Center Right, <br/>
													 	Bottom Left, Bottom Center, Bottom Right</i>' . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> slice_point </i>', 
									
									'slice_start_position' => __('Sets the starting position of the slice when the \'slide\' effect is used.', 'slider_pro').'<br/><br/><b>'.
															  __('Available Values: ', 'slider_pro') .'</b> <br/>
															  	 <i>Left, Right, Top, Bottom, <br/>
															  	 Left Top, Right Top, Left Bottom, Right Bottom, <br/>
															  	 Horizontal Alternate, Vertical Alternate, Random</i>' . '<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slice_start_position </i>', 
																							
									'slice_start_ratio' => __('Sets the actual distance between the starting and ending point for the \'slide\' animation. 							
															  The actual distance will be determined by multiplying 
															  the slice\'s width/height to the \'sliceStartRatio\' property.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> slice_start_ratio </i>', 
									
									'slice_fade' => __('Indicates whether the slice will start as transparent and fade in 
														when \'scale\', \'width\' or \'height\' or \'slide\' effects are used.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> slice_fade </i>', 
									
									'slide_mask' => __('Indicates whether the slices will be visible outside the slide area. 
														This effect is relevant when the \'slide\' effect is used.', 'slider_pro') .'<br/><br/><b>'.
													__('Setting Name: ', 'slider_pro') .'</b><i> slide_mask </i>', 
									
									'keyboard_navigation' => __('Indicates whether keyboard navigation will be enabled. This options allows navigation through the slides 
																 by using the left and right arrow keyboard keys. Also if you have a link attached to a slide, it\' possible
																 to open that link by pressing the \'Enter\' key.', 'slider_pro') .'<br/><br/><b>'. 
													  		 __('Setting Name: ', 'slider_pro') .'</b><i> keyboard_navigation </i>', 
															 
									'keyboard_navigation_on_focus_only' => __('Indicates whether keyboard navigation will be enabled only when 
																			   the slider has focus.', 'slider_pro') .'<br/><br/><b>'. 
																		   __('Setting Name: ', 'slider_pro') .'</b><i> keyboard_navigation_on_focus_only </i>', 
													  
									'slide_arrows' => __('Indicates whether the Left and Right arrows will be displayed for the main slide.', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> slide_arrows </i>', 
									
									'slide_arrows_toggle' => __('Indicates whether the slide arrows will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> slide_arrows_toggle </i>', 
									
									'slide_arrows_show_duration' => __('Sets the duration for the fade in animations of the slide navigation arrows.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> slide_arrows_show_duration </i>', 
									
									'slide_arrows_hide_duration' => __('Sets the duration for the fade out animations of the slide navigation arrows.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> slide_arrows_hide_duration </i>', 
									
									'slide_buttons' => __('Indicates whether the navigation buttons (bullets) will be displayed.', 'slider_pro') .'<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons </i>', 
									
									'slide_buttons_center' => __('Indicates whether the navigation buttons will be centered horizontally 
																  within the main buttons container. 							
																 If false, you can set a custom position for the buttons from within the CSS file.', 'slider_pro') .'<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_center </i>', 
									
									'slide_buttons_container_center' => __('Indicates whether the navigation buttons container will be centered horizontally. 							
																		  	If false, you can set a custom position for the 
																			container from within the CSS file.', 'slider_pro') .'<br/><br/><b>'. 
																		__('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_container_center </i>', 
									
									'slide_buttons_toggle' => __('Indicates whether the navigation buttons will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_toggle </i>', 
									
									'slide_buttons_show_duration' => __('Sets the duration for the fade in animations of the slide navigation buttons.', 'slider_pro') .'<br/><br/><b>'. 
																	 __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_show_duration </i>', 
									
									'slide_buttons_hide_duration' => __('Sets the duration for the fade out animations of the slide navigation buttons.', 'slider_pro') .'<br/><br/><b>'. 
																	 __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_hide_duration </i>', 
									
									'slide_buttons_number' => __('Indicates whether numbers will be displayed over the slide buttons.', 'slider_pro') .'<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slide_buttons_number </i>', 
									
									'auto_toggle' => __('Indicates whether the navigation controls (slide arrows, slide buttons, slideshow controls)
														will automatically hide if the mouse pointer doesn\'t move for a certain time interval,
														defined by the autoToggleDelay property. The controls will automatically hide only if the control\'s toggle property
														(for example, slideArrowsToggle) was set to true.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> auto_toggle </i>', 
															  
									'auto_toggle_delay' => __('Sets the delay, in milliseconds, after which the controls will automatically hide.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> auto_toggle_delay </i>', 
															  
									'thumbnail_slide_amount' => __('Sets the sliding amount of the thumbnail, when Thumbnails Type is set to \'tooltip\'.', 'slider_pro') .'<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_slide_amount </i>', 
									
									'thumbnail_slide_duration' => __('Sets the sliding  duration of the thumbnail, when Thumbnails Type is set to \'tooltip\'.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_slide_duration </i>', 
									
									'thumbnail_slide_easing' => __('Sets the sliding easing of the thumbnail, when Thumbnails Type is set to \'tooltip\'', 'slider_pro') .'<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_slide_easing </i>', 
									
									'thumbnail_type' => __('Indicates the way in which the thumbnails will be displayed. 
															If \'tooltip\' is used the thumbnails will fade in on top of the navigation buttons when you roll over							
															them. If \'scroller\' is used the thumbnails will appear inside the thumbnail scroller and it \'tooltipAndScroller\'
															is used the thumbnails will appear both as tooltips and inside the thumbnail scroller.', 'slider_pro') .'<br/><br/><b>'.
														__('Available Values: ', 'slider_pro') .'</b> <br/>
														   <i>Tooltip, Scroller, <br/>
														   Tooltip And Scroller, None</i>' . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_type </i>', 
														 
									'thumbnail_width' => __('Sets the width of the thumbnail', 'slider_pro') .'<br/><br/><b>'.
														 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_width </i>', 
														  
									'thumbnail_height' => __('Sets the height of the thumbnail', 'slider_pro') .'<br/><br/><b>'.
														  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_height </i>', 
									
									'thumbnail_scroller_toggle' => __('Indicates whether the thumbnail scroller will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
																   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_toggle </i>', 
									
									'thumbnail_scroller_hide_duration' => __('Sets the duration for the fade out animation of the thumbnail scroller.', 'slider_pro') .'<br/><br/><b>'. 
																		  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_hide_duration </i>', 
									
									'thumbnail_scroller_show_duration' => __('Sets the duration for the fade in animation of the thumbnail scroller.', 'slider_pro') .'<br/><br/><b>'. 
																		  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_show_duration </i>', 
									
									'thumbnail_scroller_center' => __('Indicates whether the thumbnail scroller will be centered relativelly to the slide.', 'slider_pro') .'<br/><br/><b>'. 
																   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_center </i>',
									
									'thumbnail_swipe' => __('Enables the touch swipe functionality for the thumbnail scoller.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe </i>',
									
									'thumbnail_swipe_threshold' => __('Sets the minimum amount that the thumbnail scroller needs to be dragged in order to navigate to a new thumbnail page.', 'slider_pro') .'<br/><br/><b>'. 
																   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe_threshold </i>',
									
									'thumbnail_swipe_back_duration' => __('Sets the duration of thumbnail scroller\'s movement when the drag amount is below the threshold.', 'slider_pro') .'<br/><br/><b>'. 
																	   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe_back_duration </i>',
									
									'thumbnail_swipe_mouse_drag' => __('Indicates whether the thumbnail swipe will work when the mouse is used.', 'slider_pro') .'<br/><br/><b>'. 
																    __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe_mouse_drag </i>',
									
									'thumbnail_swipe_touch_drag' => __('Indicates whether the thumbnail swipe will work for touch gestures.', 'slider_pro') .'<br/><br/><b>'. 
																    __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe_touch_drag </i>',
									
									'thumbnail_swipe_grab_cursor' => __('Enables the grabbing cursor for the thumbnail scroller.', 'slider_pro') .'<br/><br/><b>'. 
																     __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_swipe_grab_cursor </i>',

									'thumbnail_sync' => __('Indicates whether the thumbnail page will always be synchronized with the current slide.', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_sync </i>', 
									
									'thumbnail_scroller_responsive' => __('Indicates whether the thumbnail scroller will be responsive 
																		   as well if the slider\'s size is set in percentages.', 'slider_pro') .'<br/><br/><b>'. 
																	   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_responsive </i>', 
									
									'thumbnail_scroller_overlay' => __('Indicates whether the thumbnail scroller will be displayed over the slider, 
																		instead of outside the slider.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroller_overlay </i>', 
									
									'maximum_visible_thumbnails' => __('Sets the maximum number of thumbnails per page.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> maximum_visible_thumbnails </i>', 
																	
									'minimum_visible_thumbnails' => __('Sets the minimum number of thumbnails per page. 
																		This property is useful in a responsive layout.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> minimum_visible_thumbnails </i>', 
									
									'thumbnail_orientation' => __('Indicates whether the thumbnails will be arranged horizontally or vertically.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Available Values: ', 'slider_pro') .'</b> <i>Horizontal, Vertical</i>' . '<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_orientation </i>', 
									
									'thumbnail_layers' => __('Indicates the number of layers that will be used. Layers can represent either rows, when the thumbnail
															  orientation is set to \'horizontal\', or columns, when the thumbnail orientation is set to \'vertical\'. 
															  In order to use the maximum amount of layers allowed, set this option to -1.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_layers </i>', 
															   
									'thumbnail_tooltip' => __('Indicates whether the tooltip will be displayed for 
															   those thumbnails for which the tooltip content was specified.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_tooltip </i>', 
									
									'thumbnail_arrows' => __('Indicates whether the navigation thumbnails will have 
															  arrows for navigating through thumbnail pages.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_arrows </i>', 
									
									'thumbnail_arrows_toggle' => __('Indicates whether the thumbnail arrows will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
															     __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_arrows_toggle </i>',
									
									'thumbnail_scroll_duration' => __('Sets the duration of the scrolling animation when the thumbnail arrows or 
																	   thumbnail buttons are used for scrolling.', 'slider_pro') .'<br/><br/><b>'. 
																   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroll_duration </i>', 
									
									'thumbnail_scroll_easing' => __('Sets the easing of the scrolling animation when the thumbnail arrows or 
																	 thumbnail buttons are used for scrolling.', 'slider_pro') . '<br/><br/><b>'. 
																 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scroll_easing </i>', 
									
									'thumbnail_arrows_hide_duration' => __('Indicates the duration for the fade out animation of the thumbnail arrows.', 'slider_pro') .'<br/><br/><b>'. 
																		__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_arrows_hide_duration </i>', 
									
									'thumbnail_arrows_show_duration' => __('Indicates the duration for the fade in animation of the thumbnail arrows.', 'slider_pro') .'<br/><br/><b>'. 
																		__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_arrows_show_duration </i>', 
									
									'thumbnail_buttons' => __('Indicates whether the navigation thumbnails will have 
															   buttons (bullets) for navigating through thumbnail pages.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_buttons </i>', 
									
									'thumbnail_buttons_toggle' => __('Indicates whether the thumbnail buttons will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_buttons_toggle </i>', 
									
									'thumbnail_buttons_hide_duration' => __('Indicates the duration for the fade out animation of the thumbnail buttons.', 'slider_pro') .'<br/><br/><b>'. 
																		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_buttons_hide_duration </i>', 
									
									'thumbnail_buttons_show_duration' => __('Indicates the duration for the fade in animation of the thumbnail buttons.', 'slider_pro') .'<br/><br/><b>'. 
																		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_buttons_show_duration </i>', 
									
									'thumbnail_scrollbar' => __('Indicates whether the navigation thumbnails will have a scrollbar.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scrollbar </i>', 
									
									'thumbnail_scrollbar_toggle' => __('Indicates whether the thumbnail scrollbar will fade in/out on hover.', 'slider_pro') .'<br/><br/><b>'. 
																    __('Setting Name: ', 'slider_pro') .'</b><i> fade_thumbnail_scrollbar_toggle </i>', 
									
									'thumbnail_scrollbar_hide_duration' => __('Indicates the duration for the fade out animation of the thumbnail scrollbar.', 'slider_pro') .'<br/><br/><b>'. 
																		   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scrollbar_hide_duration </i>', 
									
									'thumbnail_scrollbar_show_duration' => __('Indicates the duration for the fade in animation of the thumbnail scrollbar.', 'slider_pro') .'<br/><br/><b>'. 
																		   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scrollbar_show_duration </i>', 
									
									'thumbnail_scrollbar_ease' => __('Indicates the easing amount for the scrollbar scrolling.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_scrollbar_ease </i>', 
									
									'scrollbar_arrow_scroll_amount' => __('Sets the amount, in pixels, by which the thumbnails will be scrolled 
																		   when one of the scrollbar\'s arrows is clicked.', 'slider_pro') .'<br/><br/><b>'. 
																	   __('Setting Name: ', 'slider_pro') .'</b><i> scrollbar_arrow_scroll_amount </i>', 		
									
									'thumbnail_mouse_scroll' => __('Indicates whether the thumbnails can be scrolled by moving the mouse over them.', 'slider_pro') .'<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_scroll </i>', 
									
									'thumbnail_mouse_scroll_speed' => __('Sets the speed of the thumbnail mouse scrolling.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_scroll_speed </i>', 
									
									
									'thumbnail_mouse_scroll_ease' => __('Sets the ease of the mouse scrolling when the mouse leaves the thumbnails area.', 'slider_pro') .'<br/><br/><b>'. 
																	 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_scroll_ease </i>', 
									
									'thumbnail_mouse_wheel' => __('Indicates whether the thumbnails can be scrolled using the mouse wheel.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_wheel </i>', 
									
									'thumbnail_mouse_wheel_speed' => __('Sets the speed of the thumbnail mouse wheel scrolling.', 'slider_pro') .'<br/><br/><b>'. 
																	 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_wheel_speed </i>', 
									
									'thumbnail_mouse_wheel_reverse' => __('Indicates whether the thumbnails will be scrolled 
																		   in the opposite direction when mouse wheel scrolling is used.', 'slider_pro') .'<br/><br/><b>'.
																	   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_mouse_wheel_reverse </i>', 
									
									'thumbnail_caption' => __('Indicates whether the thumbnails will display a caption. 
																The thumbnail\'s caption needs to be specified in the thumbnail\'s "Alt" field.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption </i>', 

									'thumbnail_caption_position' => __('Sets the position of the caption inside the thumbnail. 
																		Can be set to \'top\' or \'bottom\'.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Available Values: ', 'slider_pro') .'</b> <i>Top, Bottom</i>' . '<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption_position </i>', 
									
									'thumbnail_caption_toggle' => __('Indicates whether the thumbnail caption will be hidden/shown on hover.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> hide_thumbnail_caption </i>', 
									
									'thumbnail_caption_effect' => __('Sets the animation effect type for the captions.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Available Values: ', 'slider_pro') .'</b><i> Slide, Fade</i>' . '<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption_effect </i>', 
									
									'thumbnail_caption_show_duration' => __('Sets the duration of the fade/slide in animation of the caption.', 'slider_pro') .'<br/><br/><b>'. 
																		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption_show_duration </i>', 
									
									'thumbnail_caption_hide_duration' => __('Sets the duration of the fade/slide out animation of the caption.', 'slider_pro') .'<br/><br/><b>'. 
																		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption_hide_duration </i>', 
									
									'thumbnail_caption_easing' => __('Sets the easing of the caption\'s animation.', 'slider_pro') .' <br/><br/><b>'.
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_caption_easing </i>', 
									
									'tooltip_show_duration' => __('Sets the duration of the tooltip\'s fade in animation.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> tooltip_show_duration </i>', 
									
									'tooltip_hide_duration' => __('Sets the duration of the tooltip\'s fade out animation.', 'slider_pro') .'<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> tooltip_hide_duration </i>', 
									
									'caption_toggle' => __('Indicates whether the slide caption will be hidden/shown on hover.', 'slider_pro') .'<br/><br/><b>'. 
													    __('Setting Name: ', 'slider_pro') .'</b><i> caption_toggle </i>', 
														
									'caption_delay' => __('Sets the delay time for the caption\'s show effect.', 'slider_pro') .'<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> caption_delay </i>',									
									
									'caption_background_opacity' => __('Sets the caption\'s background opacity.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> caption_background_opacity </i>', 
									
									'caption_background_color' => __('Sets the caption\'s background color.', 'slider_pro') .'<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> caption_background_color </i>', 
									
									'caption_show_effect' => __('Sets the effect type for the caption\'s show animation.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Available Values: ', 'slider_pro') .'</b> <i>Slide, Fade</i>' . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> caption_show_effect </i>', 
									
									'caption_show_effect_duration' => __('Sets the duration for the caption\'s show animation.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> caption_show_effect_duration </i>', 
									
									'caption_show_effect_easing' => __('Sets the easing type for the caption\'s show animation.', 'slider_pro') .' <br/><br/>' .
																	__('Setting Name: ', 'slider_pro') .'</b><i> caption_show_effect_easing </i>', 
									
									'caption_show_slide_direction' => __('Sets the direction of the sliding for the caption\'s show animation, 
																	      when the slide effect is used.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> caption_show_slide_direction </i>', 
									
									'caption_hide_effect' => __('Sets the effect type for the caption\'s hide animation.', 'slider_pro') .'<br/><br/><b>'. 
															 __('Available Values: ', 'slider_pro') .'</b> <i>Slide, Fade</i>' . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> caption_hide_effect </i>', 
									
									'caption_hide_effect_duration' => __('Sets the duration for the caption\'s hide animation.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> caption_hide_effect_duration </i>', 
									
									'caption_hide_effect_easing' => __('Sets the easing type for the caption\'s hide animation.', 'slider_pro') .'<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> caption_hide_effect_easing </i>', 
									
									'caption_hide_slide_direction' => __('Sets the direction of the sliding for the caption\'s hide animation, 
																		  when the slide effect is used.', 'slider_pro') .'<br/><br/><b>'. 
																	  __('Setting Name: ', 'slider_pro') .'</b><i> caption_hide_slide_direction </i>', 
									
									'caption_position' => __('Sets the position of the caption inside the slide.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Available Values: ', 'slider_pro') .'</b> <br/>
														     <i>Bottom, Top, <br/>
														     Left, Right, Custom</i>' . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> caption_position </i>', 
									
									'caption_size' => __('Sets the width or height of the caption when the \'Caption Position\' option 
														 is set to \'Top\', \'Bottom\', \'Left\', \'Right\'', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> caption_size </i>', 
									
									'caption_left' => __('Sets the left position of the caption when caption\'s position is \'custom\'', 'slider_pro') .'<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> caption_left </i>', 
									
									'caption_top' => __('Sets the left position of the caption when caption\'s position is \'custom\'', 'slider_pro') .'<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> caption_top </i>', 
									
									'caption_width' => __('Sets the width of the caption when caption\'s position is \'custom\'', 'slider_pro') .'<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> caption_width </i>', 
									
									'caption_height' => __('Sets the height of the caption when caption\'s position is \'custom\'', 'slider_pro') .'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> caption_height </i>', 
									
									'image_path' => __('The path to the slide\'s image.', 'slider_pro') .'<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> image </i>', 
									
									'image_alt' => __('The ALT text for the slide\'s image. 
													   Will be used as a lightbox title if a lightbox was created for the slide.', 'slider_pro') .'<br/><br/><b>'. 
												   __('Setting Name: ', 'slider_pro') .'</b><i> alt </i>', 
									
									'image_title' => __('The title text for the current slide\'s image.', 'slider_pro') .'<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> link </i>', 
									
									'thumbnail_path' => __('Sets a custom thumbnail image for the current slide. 
															If no path is specified, a thumbnail will be automatically generated from the slide\'s main image.', 'slider_pro')
															.'<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_image </i>', 
									
									'thumbnail_alt' => __('The ALT text for the thumbnail image. 
														  Can be used either to specify a tooltip or the lightbox title 
														  if a lightbox was created for the thumbnail.', 'slider_pro') .'<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_alt </i>', 
									
									'thumbnail_title' => __('The title text for the current slide\'s thumbnail.	Will also be used as a thumbnail caption.
															The caption will be displayed only if the Thumbnails Type is 
															set to \'scroller\' or \'tooltipAndScroller\'.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_title </i>', 
									
									'slide_link_path' => __('Sets a link for the slide image. 
															 The link will be opened in a lightbox if the \'Lightbox\' checkbox is checked.', 'slider_pro') .'<br/><br/><b>'. 
														 __('Setting Name: ', 'slider_pro') .'</b><i> slide_link_path </i>', 
									
									'slide_link_target' => __('Sets the target of the link.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> slide_link_target </i>', 
									
									'slide_link_title' => __('Sets the title of the link. It will be used to specify the lightbox description 
															  if the link will be opened in a lightbox.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> slide_link_title </i>', 
									
									'slide_link_lightbox' => __('Indicates whether the link will be opened in a lightbox.', 'slider_pro') .'<br/><br/><b>'. 
														   	 __('Setting Name: ', 'slider_pro') .'</b><i> slide_link_lightbox </i>', 
									
									'thumbnail_link_path' => __('Sets a link for the thumbnail image. The link will be opened in a lightbox 
																 if the \'Lightbox\' checkbox is checked.', 'slider_pro') .'<br/><br/><b>'. 
														   	 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_link_path </i>', 
									
									'thumbnail_link_target' => __('Sets the target of the link.', 'slider_pro') .'<br/><br/><b>'. 
														   	   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_link_target </i>', 
										
									'thumbnail_link_title' => __('Sets the title of the link. It will be used to specify the lightbox description 
																  if the link will be opened in a lightbox.', 'slider_pro') .'<br/><br/><b>'. 
														   	  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_link_title </i>', 
									
									'thumbnail_link_lightbox' => __('Indicates whether the link will be opened in a lightbox.', 'slider_pro') .'<br/><br/><b>'. 
														   		 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_link_lightbox </i>', 									
																  
									'video_play_action' => __('Sets the action that will be triggered when the video starts playing.', 'slider_pro') .'<br/><br/><b>'. 
														   __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	  <i>Stop Slideshow, Pause Slideshow, None</i>' . '<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> video_play_action </i>', 
									
									'video_pause_action' => __('Sets the action that will be triggered when the video is paused.', 'slider_pro') .'<br/><br/><b>'. 
														    __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	   <i>Start Slideshow, Resume Slideshow, None</i>' . '<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> video_pause_action </i>', 
									
									'video_end_action' => __('Sets the action that will be triggered when the video end.', 'slider_pro') .'<br/><br/><b>'. 
														  __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	 <i>Reset Video, Start Slideshow,  <br/>
															 Resume Slideshow, Next Slide, none</i>' . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> video_end_action </i>', 
									
									'leave_video_action' => __('Sets the action that will be triggered when the user navigates away from the video.', 'slider_pro') .'<br/><br/><b>'. 
														    __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	   <i>Stop Video, Pause Video,<br/>
															   Pause Video And Buffering</i>' . '<br/><br/><b>'.
															__('Setting Name: ', 'slider_pro') .'</b><i> leave_video_action </i>', 
															
									'reach_video_action' => __('Sets the action that will be triggered when the user reaches a slide that contains a video.', 'slider_pro') .'<br/><br/><b>'. 
														    __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	   <i>None, Play Video</i>' . '<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> reach_video_action </i>', 
									
									'youtube_controller' => __('Enables the automatic video controller for YouTube videos.', 'slider_pro') . '<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> youtube_controller </i>', 
									
									'vimeo_controller' => __('Enables the automatic video controller for Vimeo videos.', 'slider_pro') . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> vimeo_controller </i>', 
									
									'html5_controller' => __('Enables the automatic video controller for simple HMTL5 videos.', 'slider_pro') . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> html5_controller </i>', 
									
									'videojs_controller' => __('Enables the automatic video controller for videos that use the VideoJS wrapper.', 'slider_pro') . '<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> videojs_controller </i>', 
															
									'jwplayer_controller' => __('Enables the automatic video controller for videos that use JW Player.', 'slider_pro') . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> jwplayer_controller </i>',
															 
									'jwplayer_controller' => __('Enables the automatic video controller for videos that use JW Player.', 'slider_pro') . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> jwplayer_controller </i>', 
															 
									'jwplayer_path' => __('Indicates the path to the folder that contains the JW Player source files.', 'slider_pro') . '<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> jwplayer_path </i>', 

									'jwplayer_skin' => __('Indicates the path to the JW Player skin.', 'slider_pro') . '<br/><br/><b>'. 
													   __('Setting Name: ', 'slider_pro') .'</b><i> jwplayer_path </i>', 
									
									'slide_resizing_resize' => __('Indicates whether the slide images will be resized to the specified width and height for the slide.', 'slider_pro') . '<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> slide_resizing_resize </i>', 
															  
									'slide_resizing_align' => __('Sets the align type of the resized slide image.', 'slider_pro') .'<br/><br/><b>'. 
															  __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	   	 <i>Center, Top, Bottom, <br/>
																 Left, Right, <br/>
																 Top Left, Top Right, <br/>
																 Bottom Left, Bottom Right</i>' . '<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slide_resizing_align </i>', 
																 
									'slide_resizing_crop' => __('Sets the cropping type of the resized slide image.', 'slider_pro') .'<br/><br/><b>'. 
														     __('Available Values: </b> <br/>
																0 - resize to fit specified dimensions. <br/> 
																1 - resize and crop to best fit the specified dimensions. <br/>
																2 - resize proportionally to fit entire image into specified dimenstions, and add borders if required. <br/> 
																3 - resize proportionally, adjusting the size of the scaled image so there are no borders.', 'slider_pro') . '<br/><br/><b>'. 
															 __('Setting Name: ', 'slider_pro') .'</b><i> slide_resizing_crop </i>', 
																
									'slide_resizing_quality' => __('Sets the quality of the resized slide image. 
																	100 is the maximum value but most of the times 95 is sufficient.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> slide_resizing_quality </i>', 
									
									'slide_resizing_width' => __('Sets the width to which the slide image will be resized. 
																  If the value is set to \'auto\', the image\'s width will be set to 
																  the total width of the slider specified in the \'General\' panel. ', 'slider_pro') . '<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> slide_resizing_width </i>', 
									
									'slide_resizing_height' => __('Sets the height to which the slide image will be resized.
																  If the value is set to \'auto\', the image\'s height will be set to 
																  the total height of the slider specified in the \'General\' panel. ', 'slider_pro') . '<br/><br/><b>'. 
															__('Setting Name: ', 'slider_pro') .'</b><i> reach_video_action </i>', 
									
									'thumbnail_resizing_resize' => __('Indicates whether the thumbnail images will be resized to 
																	   the specified width and height for the thumbnail.', 'slider_pro') . '<br/><br/><b>'. 
																   __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_resizing_resize </i>', 
									
									'thumbnail_resizing_align' => __('Sets the align type of the resized thumbnail image.', 'slider_pro') .'<br/><br/><b>'. 
															  	  __('Available Values: ', 'slider_pro') .'</b> <br/>
														   	   	 	 <i>Center, Top, Bottom, <br/>
																 	 Left, Right, <br/>
																 	 Top Left, Top Right, <br/>
																 	 Bottom Left, Bottom Right</i>' . '<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_resizing_align </i>', 
									
									'thumbnail_resizing_crop' => __('Sets the cropping type of the resized thumbnail image.', 'slider_pro') .'<br/><br/><b>'. 
														     	 __('Available Values: </b> <br/>
																	0 - resize to fit specified dimensions. <br/> 
																	1 - resize and crop to best fit the specified dimensions. <br/>
																	2 - resize proportionally to fit entire image into specified dimenstions, and add borders if required. <br/> 
																	3 - resize proportionally, adjusting the size of the scaled image so there are no borders.', 'slider_pro') . '<br/><br/><b>'. 
																 __('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_resizing_crop </i>', 
									
									'thumbnail_resizing_quality' => __('Sets the quality of the resized thumbnail image. 
																		100 is the maximum value but most of the times 95 is sufficient.', 'slider_pro') . '<br/><br/><b>'. 
																	__('Setting Name: ', 'slider_pro') .'</b><i> thumbnail_resizing_quality </i>', 
									
									'custom_class' => __('Sets a custom class for the slider. You can use this class to reference the slider in your custom JavaScript and CSS code.', 'slider_pro') . '<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> custom_class </i>', 
														   
									'enable_custom_js' => __('Indicates whether the custom JavaScript code will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> enable_custom_js </i>', 
									
									'enable_custom_css' => __('Indicates whether the custom CSS code will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
														   __('Setting Name: ', 'slider_pro') .'</b><i> enable_custom_css </i>', 
									
									'slide_type' => __('Indicates the type of the current slide. A slide can be static or dynamic. A dynamic slide can also be of 2 types:
														a slide that fetches data from posts, pages and custom posts types or a slide that fetches data from a post\'s gallery.', 'slider_pro') . '<br/><br/><b>'. 
													__('Setting Name: ', 'slider_pro') .'</b><i> slide_type </i>', 
									
								    'dynamic_posts_maximum' => __('Sets the maximum number of posts that will be queried. 
																   If you want to query all posts, set the option to -1.', 'slider_pro') . '<br/><br/><b>'. 
															   __('Setting Name: ', 'slider_pro') .'</b><i> dynamic_posts_maximum </i>', 
									
								    'dynamic_posts_offset' => __('Sets the offset of the posts that will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> dynamic_posts_offset </i>', 
									
								    'dynamic_posts_featured' => __('Indicates whether only posts marked to be featured will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> dynamic_posts_featured </i>', 
									
									'dynamic_gallery_post' => __('Sets the ID of the post from where the images will be loaded. If -1 is used,
																  the images will be loaded from the post where the slider is inserted.', 'slider_pro') . '<br/><br/><b>'. 
															  __('Setting Name: ', 'slider_pro') .'</b><i> dynamic_gallery_post </i>', 
									
									'dynamic_gallery_maximum' => __('Sets the maximum number of images that will be loaded.
																	 If -1 is used, all the images from the post\'s gallery will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
																 __('Setting Name: ', 'slider_pro') .'</b><i> dynamic_gallery_maximum </i>', 
									
									'dynamic_gallery_offset' => __('Sets the offset of the images that will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> dynamic_gallery_offset </i>',
									
									'dynamic_flickr_api_key' => __('The API key provided by Flickr.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> dynamic_flickr_api_key </i>',
									
									'dynamic_flickr_data_id' => __('The user ID, if Data Type is set to \'Username\', or photoset ID, of Data Type is set to \'Set\'.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> dynamic_flickr_data_id </i>',
									
									'dynamic_flickr_data_type' => __('Indicates whether photos from a certain set will be loaded or photos from a certain user.', 'slider_pro') . '<br/><br/><b>'. 
																  __('Setting Name: ', 'slider_pro') .'</b><i> dynamic_flickr_data_type </i>',
									
									'dynamic_flickr_maximum' => __('Sets the maximum number of photos that will be loaded.', 'slider_pro') . '<br/><br/><b>'. 
																__('Setting Name: ', 'slider_pro') .'</b><i> dynamic_flickr_maximum </i>',

									'layer_transition' => __('Sets the direction of the layer\'s slide in transition.
															  If \'Left\' is used, the layer will slide in from right to left.
															  If \'Up\' is used, the layer will slide in from bottom to top. ', 'slider_pro') . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> layer_transition </i>',

									'layer_offset' => __('Sets an offset for the transition.', 'slider_pro') . '<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> layer_offset </i>',
									
									'layer_easing' => __('Sets the easing type of the transition.', 'slider_pro') . '<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> layer_easing </i>',
									
									'layer_duration' => __('Sets the duration of the transition.', 'slider_pro') . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> layer_duration </i>',
									
									'layer_delay' => __('Sets the delay of the transition.', 'slider_pro') . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> layer_delay </i>',
									
									'layer_position' => __('Sets the reference point for the position of the layers.', 'slider_pro') . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> layer_position </i>',

									'layer_horizontal' => __('Sets the horizontal position of the layer. 
															  Can be set to left, center, right, a percentage value or a fixed value. 
															  This value will be relative to reference point set for the data-position attribute.', 'slider_pro') . '<br/><br/><b>'. 
														  __('Setting Name: ', 'slider_pro') .'</b><i> layer_horizontal </i>',
									
									'layer_vertical' => __('Sets the vertical position of the layer. 
															Can be set to top, center, bottom, a percentage value or a fixed value. 
															This value will be relative to reference point set for the data-position attribute.', 'slider_pro') . '<br/><br/><b>'. 
														__('Setting Name: ', 'slider_pro') .'</b><i> layer_vertical </i>',
									
									'layer_width' => __('Sets the width of the layer. Can be set to auto, a percentage value or a fixed value.', 'slider_pro') . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> layer_width </i>',
									
									'layer_height' => __('Sets the height of the layer. Can be set to auto, a percentage value or a fixed value.', 'slider_pro') . '<br/><br/><b>'. 
													  __('Setting Name: ', 'slider_pro') .'</b><i> layer_height </i>',
									
									'layer_custom_class' => __('Contains all the custom class names that will be applied to the layer.', 'slider_pro') . '<br/><br/><b>'. 
														 	__('Setting Name: ', 'slider_pro') .'</b><i> layer_custom_class </i>',

									'layer_depth' => __('Sets the depth of the layer.', 'slider_pro') . '<br/><br/><b>'. 
													 __('Setting Name: ', 'slider_pro') .'</b><i> layer_depth </i>'
									);



// sidebar categories
$sliderpro_slider_sidebar_categories = array('publish' => __('Publish', 'slider_pro'),
										 	 'general' => __('General', 'slider_pro'),
											 'slideshow' => __('Slideshow', 'slider_pro'),
											 'lightbox' => __('Lightbox', 'slider_pro'),
											 'fullscreen' => __('Fullscreen', 'slider_pro'),
											 'timer_animation' => __('Timer Animation', 'slider_pro'),
											 'slide_navigation_controls' => __('Slide Navigation Controls', 'slider_pro'),
											 'transition_effects' => __('Transition Effects', 'slider_pro'),
											 'thumbnails' => __('Thumbnails', 'slider_pro'),
											 'captions' => __('Captions', 'slider_pro'),
											 'video' => __('Video', 'slider_pro'),
											 'timthumb_resizing' => __('TimThumb Resizing', 'slider_pro'),
											 'slides_order' => __('Slides Order', 'slider_pro'));



// list of months
$sliderpro_months = array('01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', 
				   		  '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

?>