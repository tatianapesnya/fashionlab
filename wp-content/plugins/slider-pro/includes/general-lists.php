<?php

// constants used for indentation
define('SP_IND_1', "\t");
define('SP_IND_2', "\t\t");
define('SP_IND_3', "\t\t\t");
define('SP_IND_4', "\t\t\t\t");




global $sliderpro_slider_settings;

$sliderpro_slider_settings = array( // general settings
									// style settings
									'width' => array('default_value' => 500, 
												     'name' => __('Width', 'slider_pro'), 
												     'type' => 'text',
													 'category' => 'general',
													 'group' => __('Style', 'slider_pro')),

									'height' => array('default_value' => 300, 
												      'name' => __('Height', 'slider_pro'), 
												      'type' => 'text',
													  'category' => 'general',
													  'group' => __('Style', 'slider_pro')),
									
									'responsive' => array('default_value' => false, 
														  'name' => __('Responsive', 'slider_pro'), 
														  'type' => 'text',
														  'category' => 'general',
														  'group' => __('Style', 'slider_pro')),

									'aspect_ratio' => array('default_value' => -1, 
														    'name' => __('Aspect Ratio', 'slider_pro'), 
														    'type' => 'text',
														    'category' => 'general',
														    'group' => __('Style', 'slider_pro')),
													  
									'skin' => array('default_value' => 'pixel', 
												    'name' => __('Skin', 'slider_pro'), 
												    'type' => 'function',
													'function_name' => 'sliderpro_get_main_skin',
													'category' => 'general',
													'group' => __('Style', 'slider_pro')),
									
									'include_skin' => array('default_value' => false, 
													   		'name' => __('Include Skin', 'slider_pro'), 
													   		'type' => 'checkbox',
															'category' => 'general',
															'group' => __('Style', 'slider_pro')),									
									
									'scale_type' => array('default_value' => 'outsideFit', 
														  'name' => __('Scale Type', 'slider_pro'), 
														  'type' => 'select', 
														  'list' => 'scale_type',
														  'category' => 'general',
														  'group' => __('Scale and Align', 'slider_pro')),
									
									'align_type' => array('default_value' => 'centerCenter', 
														  'name' => __('Align Type', 'slider_pro'), 
														  'type' => 'select', 
														  'list' => 'align_type',
														  'category' => 'general',
														  'group' => __('Scale and Align', 'slider_pro')),
									
									'allow_scale_up' => array('default_value' => false, 
															  'name' => __('Allow Scale Up', 'slider_pro'), 
															  'type' => 'text',
															  'category' => 'general',
															  'group' => __('Scale and Align', 'slider_pro')),
									
									'shadow' => array('default_value' => true, 
													  'name' => __('Shadow', 'slider_pro'), 
													  'type' => 'checkbox',
													  'category' => 'general',
													  'group' => __('Style', 'slider_pro')),

									'border' => array('default_value' => true, 
													  'name' => __('Border', 'slider_pro'), 
													  'type' => 'checkbox',
													  'category' => 'general',
													  'group' => __('Style', 'slider_pro')),

									'glow' => array('default_value' => true, 
													'name' => __('Glow', 'slider_pro'), 
													'type' => 'checkbox',
													'category' => 'general',
													'group' => __('Style', 'slider_pro')),

									// slides settings
									'lazy_loading' => array('default_value' => false, 
															'name' => __('Lazy Loading', 'slider_pro'), 
															'type' => 'checkbox',
															'category' => 'general',
															'group' => __('Slides', 'slider_pro')),
																	 					
									'preload_nearby_images' => array('default_value' => false, 
																     'name' => __('Preload Nearby Images', 'slider_pro'), 
																     'type' => 'checkbox',
																	 'category' => 'general',
																	 'group' => __('Slides', 'slider_pro')),
									
									'slide_start' => array('default_value' => 0, 
														   'name' => __('Slide Start', 'slider_pro'), 
														   'type' => 'text',
														   'category' => 'general',
														   'group' => __('Slides', 'slider_pro')),
									
									'shuffle' => array('default_value' => false, 
													   'name' => __('Shuffle', 'slider_pro'), 
													   'type' => 'checkbox',
													   'category' => 'general',
													   'group' => __('Slides', 'slider_pro')),
											
									// custom JS and CSS
									'custom_class' => array('default_value' => '', 
														 'name' => __('Custom Class', 'slider_pro'), 
														 'type' => 'text',
														 'category' => 'custom_js_css',
														 'group' => __('Custom JS and CSS', 'slider_pro')),
														   
									'enable_custom_js' => array('default_value' => false, 
															  	'name' => __('Enable Custom JS', 'slider_pro'), 
															  	'type' => 'checkbox',
															  	'category' => 'custom_js_css',
															  	'group' => __('Custom JS and CSS', 'slider_pro')), 
									
									'enable_custom_css' => array('default_value' => false, 
															   	 'name' => __('Enable Custom CSS', 'slider_pro'), 
															   	 'type' => 'checkbox',
															   	 'category' => 'custom_js_css',
															   	 'group' => __('Custom JS and CSS', 'slider_pro')),
															   
															   
															   				   
									// slideshow settings
									'slideshow' => array('default_value' => true, 
														 'name' => __('Slideshow', 'slider_pro'), 
														 'type' => 'checkbox',
														 'category' => 'slideshow',
														 'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_delay' => array('default_value' => 5000, 
															   'name' => __('Slideshow Delay', 'slider_pro'), 
															   'type' => 'text',
															   'category' => 'slideshow',
															   'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_loop' => array('default_value' => true, 
															  'name' => __('Slideshow Loop', 'slider_pro'), 
															  'type' => 'checkbox',
															  'category' => 'slideshow',
															  'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_controls' => array('default_value' => false, 
																  'name' => __('Slideshow Controls', 'slider_pro'), 
																  'type' => 'checkbox',
																  'category' => 'slideshow',
																  'group' => __('Slideshow', 'slider_pro')),									
									
									'slideshow_controls_toggle' => array('default_value' => true, 
																		 'name' => __('Slideshow Controls Toggle', 'slider_pro'), 
																		 'type' => 'checkbox',
																		 'category' => 'slideshow',
																		 'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_controls_show_duration' => array('default_value' => 500, 
																			    'name' => __('Slideshow Controls Show Duration', 'slider_pro'), 
																			    'type' => 'text',
																				'category' => 'slideshow',
																				'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_controls_hide_duration' => array('default_value' => 500, 
																			    'name' => __('Slideshow Controls Hide Duration', 'slider_pro'), 
																			    'type' => 'text',
																				'category' => 'slideshow',
																				'group' => __('Slideshow', 'slider_pro')),
									
									'pause_slideshow_on_hover' => array('default_value' => false, 
																	    'name' => __('Pause Slideshow On Hover', 'slider_pro'), 
																	    'type' => 'checkbox',
																		'category' => 'slideshow',
																		'group' => __('Slideshow', 'slider_pro')),
									
									'slideshow_direction' => array('default_value' => 'next', 
																   'name' => __('Slideshow Direction', 'slider_pro'), 
																   'type' => 'select', 
																   'list' => 'slideshow_direction',
																   'category' => 'slideshow',
																   'group' => __('Slideshow', 'slider_pro')),
																   
																   
									
									// slide navigation controls settings
									'keyboard_navigation' => array('default_value' => false, 
																   'name' => __('Keyboard Navigation', 'slider_pro'), 
																   'type' => 'checkbox',
																   'category' => 'slide_navigation_controls',
																   'group' => __('Keyboard', 'slider_pro')),
																   
									'keyboard_navigation_on_focus_only' => array('default_value' => false, 
																			     'name' => __('Keyboard Navigation On Focus Only', 'slider_pro'), 
																			     'type' => 'checkbox',
																			     'category' => 'slide_navigation_controls',
																			     'group' => __('Keyboard', 'slider_pro')),
																   
									// slide arrows settings
									'slide_arrows' => array('default_value' => true, 
														  	'name' => __('Slide Arrows', 'slider_pro'), 
														  	'type' => 'checkbox',
															'category' => 'slide_navigation_controls',
															'group' => __('Slide Arrows', 'slider_pro')),
									
									'slide_arrows_toggle' => array('default_value' => true, 
														  		   'name' => __('Slide Arrows Toggle', 'slider_pro'), 
														  		   'type' => 'checkbox',
																   'category' => 'slide_navigation_controls',
																   'group' => __('Slide Arrows', 'slider_pro')),
									
									'slide_arrows_show_duration' => array('default_value' => 500, 
															   			  'name' => __('Slide Arrows Show Duration', 'slider_pro'), 
															   			  'type' => 'text',
																		  'category' => 'slide_navigation_controls',
																		  'group' => __('Slide Arrows', 'slider_pro')),
									
									'slide_arrows_hide_duration' => array('default_value' => 500, 
															   			  'name' => __('Slide Arrows Hide Duration', 'slider_pro'), 
															   			  'type' => 'text',
																		  'category' => 'slide_navigation_controls',
																		  'group' => __('Slide Arrows', 'slider_pro')),								
									
									// slide buttons settings
									'slide_buttons' => array('default_value' => true, 
														  	 'name' => __('Slide Buttons', 'slider_pro'), 
														  	 'type' => 'checkbox',
															 'category' => 'slide_navigation_controls',
															 'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_center' => array('default_value' => true, 
																    'name' => __('Slide Buttons Center', 'slider_pro'), 
																    'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_container_center' => array('default_value' => true, 
																			  'name' => __('Slide Buttons Container Center', 'slider_pro'), 
																			  'type' => 'checkbox',
																			  'category' => 'slide_navigation_controls',
																			  'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_toggle' => array('default_value' => false, 
																	'name' => __('Slide Buttons Toggle', 'slider_pro'), 
																	'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_show_duration' => array('default_value' => 500, 
															   			   'name' => __('Slide Buttons Show Duration', 'slider_pro'), 
															   			   'type' => 'text',
																		   'category' => 'slide_navigation_controls',
																		   'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_hide_duration' => array('default_value' => 500, 
															   			   'name' => __('Slide Buttons Hide Duration', 'slider_pro'), 
															   			   'type' => 'text',
																		   'category' => 'slide_navigation_controls',
																		   'group' => __('Slide Buttons / Dots', 'slider_pro')),
									
									'slide_buttons_number' => array('default_value' => false, 
																    'name' => __('Slide Buttons Number', 'slider_pro'), 
																    'type' => 'checkbox',
																	'category' => 'slide_navigation_controls',
																	'group' => __('Slide Buttons / Dots', 'slider_pro')),
																	
									// slide buttons settings
									'auto_toggle' => array('default_value' => false, 
														   'name' => __('Auto Toggle', 'slider_pro'), 
														   'type' => 'checkbox',
														   'category' => 'slide_navigation_controls',
														   'group' => __('Auto Toggle', 'slider_pro')),
														   
									'auto_toggle_delay' => array('default_value' => 5000, 
															     'name' => __('Auto Toggle Delay', 'slider_pro'), 
															     'type' => 'text',
															     'category' => 'slide_navigation_controls',
															     'group' => __('Auto Toggle', 'slider_pro')),
														   
														   
																	
									// lightbox settings
									'lightbox' => array('default_value' => false, 
														'name' => __('Lightbox', 'slider_pro'), 
														'type' => 'checkbox',
														'category' => 'lightbox',
														'group' => __('Lightbox', 'slider_pro')),
									
									'lightbox_gallery' => array('default_value' => true, 
															  	'name' => __('Lightbox Gallery', 'slider_pro'), 
															  	'type' => 'checkbox',
																'category' => 'lightbox',
																'group' => __('Lightbox', 'slider_pro')),
																
									'lightbox_theme' => array('default_value' => 'pp_default', 
															  'name' => __('Lightbox Theme', 'slider_pro'), 
															  'type' => 'select', 
															  'list' => 'lightbox_theme',
															  'category' => 'lightbox',
															  'group' => __('Lightbox', 'slider_pro')),
									
									'lightbox_opacity' => array('default_value' => 0.8, 
																'name' => __('Lightbox Opacity', 'slider_pro'), 
																'type' => 'text',
																'category' => 'lightbox',
																'group' => __('Lightbox', 'slider_pro')),
									
									'lightbox_autoplay' => array('default_value' => false,
															  	'name' => __('Lightbox Autoplay', 'slider_pro'),
															  	'type' => 'checkbox',
																'category' => 'lightbox',
																'group' => __('Lightbox', 'slider_pro')),

									'lightbox_autoplay_delay' => array('default_value' => 5000,
															  		   'name' => __('Lightbox Autoplay Delay', 'slider_pro'),
															  		   'type' => 'checkbox',
																	   'category' => 'lightbox',
																	   'group' => __('Lightbox', 'slider_pro')),

									'lightbox_video_autoplay' => array('default_value' => true,
															  		   'name' => __('Lightbox Video Autoplay', 'slider_pro'),
															  		   'type' => 'checkbox',
																	   'category' => 'lightbox',
																	   'group' => __('Lightbox', 'slider_pro')),

									'ligthbox_allow_resize' => array('default_value' => true,
															  		   'name' => __('Ligthbox Allow Resize', 'slider_pro'),
															  		   'type' => 'checkbox',
																	   'category' => 'lightbox',
																	   'group' => __('Lightbox', 'slider_pro')),

									'lightbox_icon' => array('default_value' => true, 
															 'name' => __('Lightbox Icon', 'slider_pro'), 
															 'type' => 'checkbox',
															 'category' => 'lightbox',
															 'group' => __('Lightbox', 'slider_pro')),
																
									'lightbox_icon_toggle' => array('default_value' => false, 
															  		'name' => __('Lightbox Icon Toggle', 'slider_pro'), 
															  		'type' => 'checkbox',
																	'category' => 'lightbox',
																	'group' => __('Lightbox', 'slider_pro')),
																
									'lightbox_icon_fade_duration' => array('default_value' => 500, 
																		   'name' => __('Lightbox Icon Fade Duration', 'slider_pro'), 
																		   'type' => 'text',
																		   'category' => 'lightbox',
																		   'group' => __('Lightbox', 'slider_pro')),
																
									'thumbnail_lightbox_icon' => array('default_value' => true,
															  		   'name' => __('Thumbnail Lightbox Icon', 'slider_pro'),
															  		   'type' => 'checkbox',
																	   'category' => 'lightbox',
																	   'group' => __('Lightbox', 'slider_pro')),
									
									'thumbnail_lightbox_icon_toggle' => array('default_value' => true,
															  				  'name' => __('Thumbnail Lightbox Icon Toggle', 'slider_pro'),
															  				  'type' => 'checkbox',
																			  'category' => 'lightbox',
																			  'group' => __('Lightbox', 'slider_pro')),
									

									// fullscreen settings
									'fullscreen_controls' => array('default_value' => false, 
																   'name' => __('Fullscreen Controls', 'slider_pro'), 
																   'type' => 'checkbox',
																   'category' => 'fullscreen',
																   'group' => __('Fullscreen', 'slider_pro')),
														  
									'fullscreen_controls_toggle' => array('default_value' => false, 
																		  'name' => __('Fullscreen Controls Toggle', 'slider_pro'), 
																	      'type' => 'checkbox',
																	      'category' => 'fullscreen',
																	      'group' => __('Fullscreen', 'slider_pro')),
														  
									'fullscreen_controls_show_duration' => array('default_value' => 500, 
																				 'name' => __('Fullscreen Controls Show Duration', 'slider_pro'), 
																				 'type' => 'text',
																				 'category' => 'fullscreen',
																				 'group' => __('Fullscreen', 'slider_pro')),
									
									'fullscreen_controls_hide_duration' => array('default_value' => 500, 
																				 'name' => __('Fullscreen Controls Hide Duration', 'slider_pro'), 
																				 'type' => 'text',
																				 'category' => 'fullscreen',
																				 'group' => __('Fullscreen', 'slider_pro')),
																			  
									'fullscreen_thumbnail_scroller_overlay' => array('default_value' => true, 
																					'name' => __('Fullscreen Thumbnail Scroller Overlay', 'slider_pro'), 
																					'type' => 'checkbox',
																					'category' => 'fullscreen',
																					'group' => __('Fullscreen', 'slider_pro')),
																		
									'fullscreen_slide_buttons' => array('default_value' => false, 
																		'name' => __('Fullscreen Slide Buttons', 'slider_pro'), 
																		'type' => 'checkbox',
																		'category' => 'fullscreen',
																		'group' => __('Fullscreen', 'slider_pro')),
																		
									'fullscreen_shadow' => array('default_value' => false, 
																 'name' => __('Fullscreen Shadow', 'slider_pro'), 
																 'type' => 'checkbox',
																 'category' => 'fullscreen',
																 'group' => __('Fullscreen', 'slider_pro')),
																		
																		
																											  
									// timer animation settings
									'timer_animation' => array('default_value' => true, 
															   'name' => __('Timer Animation', 'slider_pro'), 
															   'type' => 'checkbox',
															   'category' => 'timer_animation',
															   'group' => __('General', 'slider_pro')),
															   
									'timer_animation_controls' => array('default_value' => true, 
															   'name' => __('Timer Animation Controls', 'slider_pro'), 
															   'type' => 'checkbox',
															   'category' => 'timer_animation',
															   'group' => __('General', 'slider_pro')),
									
									'timer_toggle' => array('default_value' => false, 
															'name' => __('Timer Toggle', 'slider_pro'), 
															'type' => 'checkbox',
															'category' => 'timer_animation',
															'group' => __('General', 'slider_pro')),
															
									'timer_fade_duration' => array('default_value' => 500, 
																   'name' => __('Timer Fade Duration', 'slider_pro'), 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => __('General', 'slider_pro')),
																   
									'timer_radius' => array('default_value' => 18, 
															'name' => __('Timer Radius', 'slider_pro'), 
															'type' => 'text',
															'category' => 'timer_animation',
															'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_color1' => array('default_value' => '#000000', 
																   'name' => __('Timer Stroke Color 1', 'slider_pro'), 
																   'type' => 'color',
																   'category' => 'timer_animation',
																   'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_color2' => array('default_value' => '#FFFFFF', 
																   'name' => __('Timer Stroke Color 2', 'slider_pro'), 
																   'type' => 'color',
																   'category' => 'timer_animation',
																   'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_opacity1' => array('default_value' => 0.5, 
																   	 'name' => __('Timer Stroke Opacity 1', 'slider_pro'), 
																   	 'type' => 'text',
																	 'category' => 'timer_animation',
																	 'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_opacity2' => array('default_value' => 0.7, 
																   	 'name' => __('Timer Stroke Opacity 2', 'slider_pro'), 
																   	 'type' => 'text',
																	 'category' => 'timer_animation',
																	 'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_width1' => array('default_value' => 8, 
																   'name' => __('Timer Stroke Width 1', 'slider_pro'), 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => __('Graphic Style', 'slider_pro')),
									
									'timer_stroke_width2' => array('default_value' => 4, 
																   'name' => __('Timer Stroke Width 2', 'slider_pro'), 
																   'type' => 'text',
																   'category' => 'timer_animation',
																   'group' => __('Graphic Style', 'slider_pro')),
																   
									
									
									// transition effects settings
									'effect_type' => array('default_value' => 'random', 
														   'name' => __('Effect Type', 'slider_pro'), 
														   'type' => 'select', 
														   'list' => 'effect_type',
														   'category' => 'transition_effects',
														   'group' => __('General', 'slider_pro')),
									
									'css3_transitions' => array('default_value' => false, 
															  	'name' => __('CSS3 Transitions', 'slider_pro'), 
															  	'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => __('General', 'slider_pro')),
																
									'initial_effect' => array('default_value' => true, 
															  'name' => __('Initial Effect', 'slider_pro'), 
															  'type' => 'checkbox',
															  'category' => 'transition_effects',
															  'group' => __('General', 'slider_pro')),
									
									'html_during_transition' => array('default_value' => true, 
																	  'name' => __('HTML During Transition', 'slider_pro'), 
																	  'type' => 'checkbox',
																	  'category' => 'transition_effects',
																	  'group' => __('General', 'slider_pro')),									
									
									'override_transition' => array('default_value' => false, 
																   'name' => __('Override Transition', 'slider_pro'), 
																   'type' => 'checkbox',
																   'category' => 'transition_effects',
																   'group' => __('General', 'slider_pro')),
																   
									// slide transition
									'slide_direction' => array('default_value' => 'autoHorizontal', 
															   'name' => __('Slide Direction', 'slider_pro'), 
															   'type' => 'select', 
															   'list' => 'slide_direction',
															   'category' => 'transition_effects',
															   'group' => __('Slide Transition', 'slider_pro')),
									
									'slide_loop' => array('default_value' => false, 
														  'name' => __('Slide Loop', 'slider_pro'), 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => __('Slide Transition', 'slider_pro')),
									
									'slide_duration' => array('default_value' => 700, 
															  'name' => __('Slide Duration', 'slider_pro'), 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => __('Slide Transition', 'slider_pro')),
									
									'slide_easing' => array('default_value' => 'swing', 
															'name' => __('Slide Easing', 'slider_pro'), 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => __('Slide Transition', 'slider_pro')),														
									
									// slice transition
									'slice_effect_type' => array('default_value' => 'random', 
																 'name' => __('Slice Effect Type', 'slider_pro'), 
																 'type' => 'select', 
																 'list' => 'slice_effect_type',
																 'category' => 'transition_effects',
																 'group' => __('Slice Transition', 'slider_pro')),
									
									'horizontal_slices' => array('default_value' => 5, 
																 'name' => __('Horizontal Slices', 'slider_pro'), 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => __('Slice Transition', 'slider_pro')),
									
									'vertical_slices' => array('default_value' => 3, 
															   'name' => __('Vertical Slices', 'slider_pro'), 
															   'type' => 'text',
															   'category' => 'transition_effects',
															   'group' => __('Slice Transition', 'slider_pro')),
									
									'slice_pattern' => array('default_value' => 'random', 
															 'name' => __('Slice Pattern', 'slider_pro'), 
															 'type' => 'select', 
															 'list' => 'slice_pattern',
															 'category' => 'transition_effects',
															 'group' => __('Slice Transition', 'slider_pro')),
									
									'slice_duration' => array('default_value' => 1000, 
															  'name' => __('Slice Duration', 'slider_pro'), 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => __('Slice Transition', 'slider_pro')),
															  						 						   							 
									'slice_delay' => array('default_value' => 50, 
														   'name' => __('Slice Delay', 'slider_pro'), 
														   'type' => 'text',
														   'category' => 'transition_effects',
														   'group' => __('Slice Transition', 'slider_pro')),
									
									'slice_point' => array('default_value' => 'centerCenter', 
														   'name' => __('Slice Point', 'slider_pro'), 
														   'type' => 'select', 
														   'list' => 'slice_point',
														   'category' => 'transition_effects',
														   'group' => __('Slice Transition', 'slider_pro')),
									
									'slice_fade' => array('default_value' => true, 
														  'name' => __('Slice Fade', 'slider_pro'), 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => __('Slice Transition', 'slider_pro')),
														  
									'slice_easing' => array('default_value' => 'swing', 
															'name' => __('Slice Easing', 'slider_pro'), 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => __('Slice Transition', 'slider_pro')),									
														  
									'slice_start_position' => array('default_value' => 'left', 
																	'name' => __('Slice Start Position', 'slider_pro'), 
																	'type' => 'select', 
																	'list' => 'slice_start_position',
																	'category' => 'transition_effects',
																	'group' => __('Slice Transition', 'slider_pro')),
									
									'slice_start_ratio' => array('default_value' => 1, 
																 'name' => __('Slice Start Ratio', 'slider_pro'), 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => __('Slice Transition', 'slider_pro')),
									
									'slide_mask' => array('default_value' => false, 
														  'name' => __('Slide Mask', 'slider_pro'), 
														  'type' => 'checkbox',
														  'category' => 'transition_effects',
														  'group' => __('Slice Transition', 'slider_pro')),
									
									'fade_previous_slide' => array('default_value' => false, 
																   'name' => __('Fade Previous Slide', 'slider_pro'), 
																   'type' => 'checkbox',
																   'category' => 'transition_effects',
																   'group' => __('Slice Transition', 'slider_pro')),
									
									'fade_previous_slide_duration' => array('default_value' => 300, 
																			'name' => __('Fade Previous Slide Duration', 'slider_pro'), 
																			'type' => 'text',
																			'category' => 'transition_effects',
																			'group' => __('Slice Transition', 'slider_pro')),
									
									// fade transition
									'fade_in_duration' => array('default_value' => 700, 
																'name' => __('Fade In Duration', 'slider_pro'), 
																'type' => 'text',
																'category' => 'transition_effects',
																'group' => __('Fade Transition', 'slider_pro')),
									
									'fade_out_duration' => array('default_value' => 700, 
																 'name' => __('Fade Out Duration', 'slider_pro'), 
																 'type' => 'text',
																 'category' => 'transition_effects',
																 'group' => __('Fade Transition', 'slider_pro')),
									
									'fade_in_easing' => array('default_value' => 'swing', 
															  'name' => __('Fade In Easing', 'slider_pro'), 
															  'type' => 'select', 
															  'list' => 'easing',
															  'category' => 'transition_effects',
															  'group' => __('Fade Transition', 'slider_pro')),
									
									'fade_out_easing' => array('default_value' => 'swing', 
															   'name' => __('Fade Out Easing', 'slider_pro'), 
															   'type' => 'select', 
															   'list' => 'easing',
															   'category' => 'transition_effects',
															   'group' => __('Fade Transition', 'slider_pro')),
									
									// swipe transition
									'swipe_orientation' => array('default_value' => 'horizontal', 
															   	 'name' => __('Swipe Orientation', 'slider_pro'), 
															   	 'type' => 'select', 
															   	 'list' => 'swipe_orientation',
																 'category' => 'transition_effects',
																 'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_threshold' => array('default_value' => 50, 
															   'name' => __('Swipe Threshold', 'slider_pro'), 
															   'type' => 'text',
															   'category' => 'transition_effects',
															   'group' => __('Swipe Transition', 'slider_pro')),
															   
									'swipe_duration' => array('default_value' => 700, 
															  'name' => __('Swipe Duration', 'slider_pro'), 
															  'type' => 'text',
															  'category' => 'transition_effects',
															  'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_back_duration' => array('default_value' => 300, 
															  	   'name' => __('Swipe Back Duration', 'slider_pro'), 
															  	   'type' => 'text',
																   'category' => 'transition_effects',
																   'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_slide_distance' => array('default_value' => 10, 
																    'name' => __('Swipe Slide Distance', 'slider_pro'), 
																    'type' => 'text',
																	'category' => 'transition_effects',
																	'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_easing' => array('default_value' => 'swing', 
															'name' => __('Swipe Easing', 'slider_pro'), 
															'type' => 'select', 
															'list' => 'easing',
															'category' => 'transition_effects',
															'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_mouse_drag' => array('default_value' => true, 
														  		'name' => __('Swipe Mouse Drag', 'slider_pro'), 
														  		'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_touch_drag' => array('default_value' => true, 
														  		'name' => __('Swipe Touch Drag', 'slider_pro'), 
														  		'type' => 'checkbox',
																'category' => 'transition_effects',
																'group' => __('Swipe Transition', 'slider_pro')),
									
									'swipe_grab_cursor' => array('default_value' => true, 
														  		 'name' => __('Swipe Grab Cursor', 'slider_pro'), 
														  		 'type' => 'checkbox',
																 'category' => 'transition_effects',
																 'group' => __('Swipe Transition', 'slider_pro')),
																
																
									
									// thumbnail settings
									// thumbnail general settings
									'thumbnail_type' => array('default_value' => 'tooltip', 
															  'name' => __('Thumbnail Type', 'slider_pro'), 
															  'type' => 'select', 
															  'list' => 'thumbnail_type',
															  'category' => 'thumbnails',
															  'group' => __('General', 'slider_pro')),
															  
									'thumbnail_width' => array('default_value' => 80, 
															   'name' => __('Thumbnail Width', 'slider_pro'), 
															   'type' => 'text',
															   'category' => 'thumbnails',
															   'group' => __('General', 'slider_pro')),
									
									'thumbnail_height' => array('default_value' => 50, 
															   	'name' => __('Thumbnail Height', 'slider_pro'), 
															   	'type' => 'text',
																'category' => 'thumbnails',
																'group' => __('General', 'slider_pro')),
															  
									// tooltip thumbnails settings						  										 
									'thumbnail_slide_amount' => array('default_value' => 10, 
															   		  'name' => __('Thumbnail Slide Amount', 'slider_pro'), 
															   		  'type' => 'text',
																	  'category' => 'thumbnails',
																	  'group' => __('Tooltip Thumbnails', 'slider_pro')),
									
									'thumbnail_slide_duration' => array('default_value' => 300, 
															   			'name' => __('Thumbnail Slide Duration', 'slider_pro'), 
															   			'type' => 'text',
																		'category' => 'thumbnails',
																		'group' => __('Tooltip Thumbnails', 'slider_pro')),
									
									'thumbnail_slide_easing' => array('default_value' => 'swing', 
															   		  'name' => __('Thumbnail Slide Easing', 'slider_pro'), 
															   		  'type' => 'select',
																	  'list' => 'easing',
																	  'category' => 'thumbnails',
																	  'group' => __('Tooltip Thumbnails', 'slider_pro')),
									
									// thumbnail scroller settings
									'thumbnail_orientation' => array('default_value' => 'horizontal', 
																	 'name' => __('Thumbnail Orientation', 'slider_pro'), 
																	 'type' => 'select', 
																	 'list' => 'thumbnail_orientation',
																	 'category' => 'thumbnails',
																	 'group' => __('Thumbnail Scroller', 'slider_pro')),
																	 
									'thumbnail_layers' => array('default_value' => '1', 
																'name' => __('Thumbnail Layers', 'slider_pro'), 
																'type' => 'text',
																'category' => 'thumbnails',
																'group' => __('Thumbnail Scroller', 'slider_pro')),
																	 
									'maximum_visible_thumbnails' => array('default_value' => 5, 
																		  'name' => __('Maximum Visible Thumbnails', 'slider_pro'), 
																		  'type' => 'text',
																		  'category' => 'thumbnails',
																		  'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'minimum_visible_thumbnails' => array('default_value' => 1, 
																		  'name' => __('Minimum Visible Thumbnails', 'slider_pro'), 
																		  'type' => 'text',
																		  'category' => 'thumbnails',
																		  'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'thumbnail_scroller_responsive' => array('default_value' => false, 
																    		 'name' => __('Thumbnail Scroller Responsive', 'slider_pro'), 
																    		 'type' => 'checkbox',
																			 'category' => 'thumbnails',
																			 'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'thumbnail_scroller_overlay' => array('default_value' => false, 
																		  'name' => __('Thumbnail Scroller Overlay', 'slider_pro'), 
																		  'type' => 'checkbox',
																		  'category' => 'thumbnails',
																		  'group' => __('Thumbnail Scroller', 'slider_pro')),
																		 
									'thumbnail_sync' => array('default_value' => true, 
															  'name' => __('Thumbnail Sync', 'slider_pro'), 
															  'type' => 'checkbox',
															  'category' => 'thumbnails',
															  'group' => __('Thumbnail Scroller', 'slider_pro')),
															  								 
									'thumbnail_scroller_toggle' => array('default_value' => false, 
																    	 'name' => __('Thumbnail Scroller Toggle', 'slider_pro'), 
																    	 'type' => 'checkbox',
																		 'category' => 'thumbnails',
																		 'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'thumbnail_scroller_hide_duration' => array('default_value' => 500, 
																				'name' => __('Thumbnail Scroller Hide Duration', 'slider_pro'), 
																				'type' => 'text',
																				'category' => 'thumbnails',
																				'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'thumbnail_scroller_show_duration' => array('default_value' => 500, 
																				'name' => __('Thumbnail Scroller Show Duration', 'slider_pro'), 
																				'type' => 'text',
																				'category' => 'thumbnails',
																				'group' => __('Thumbnail Scroller', 'slider_pro')),
									
									'thumbnail_scroller_center' => array('default_value' => true, 
																    	 'name' => __('Thumbnail Scroller Center', 'slider_pro'), 
																    	 'type' => 'checkbox',
																		 'category' => 'thumbnails',
																		 'group' => __('Thumbnail Scroller', 'slider_pro')),									
									
									
									// thumbnail swipe
									'thumbnail_swipe' => array('default_value' => false, 
															   'name' => __('Thumbnail Swipe', 'slider_pro'), 
															   'type' => 'checkbox',
															   'category' => 'thumbnails',
															   'group' => __('Thumbnail Swipe', 'slider_pro')),
									
									'thumbnail_swipe_threshold' => array('default_value' => 50, 
																	     'name' => __('Thumbnail Swipe Threshold', 'slider_pro'), 
																	     'type' => 'text',
																	     'category' => 'thumbnails',
																	     'group' => __('Thumbnail Swipe', 'slider_pro')),
									
									'thumbnail_swipe_back_duration' => array('default_value' => 300, 
																	  	     'name' => __('Thumbnail Swipe Back Duration', 'slider_pro'), 
																	  	     'type' => 'text',
																		     'category' => 'thumbnails',
																		     'group' => __('Thumbnail Swipe', 'slider_pro')),
									
									'thumbnail_swipe_mouse_drag' => array('default_value' => true, 
																  		  'name' => __('Thumbnail Swipe Mouse Drag', 'slider_pro'), 
																  		  'type' => 'checkbox',
																		  'category' => 'thumbnails',
																		  'group' => __('Thumbnail Swipe', 'slider_pro')),
									
									'thumbnail_swipe_touch_drag' => array('default_value' => true, 
																  		  'name' => __('Thumbnail Swipe Touch Drag', 'slider_pro'), 
																  		  'type' => 'checkbox',
																		  'category' => 'thumbnails',
																		  'group' => __('Thumbnail Swipe', 'slider_pro')),
									
									'thumbnail_swipe_grab_cursor' => array('default_value' => true, 
																  		   'name' => __('Thumbnail Swipe Grab Cursor', 'slider_pro'), 
																  		   'type' => 'checkbox',
																		   'category' => 'thumbnails',
																		   'group' => __('Thumbnail Swipe', 'slider_pro')),

									
									// thumbnail scroll animation settings
									'thumbnail_scroll_duration' => array('default_value' => 1000, 
																		 'name' => __('Thumbnail Scroll Duration', 'slider_pro'), 
																		 'type' => 'text',
																		 'category' => 'thumbnails',
																		 'group' => __('Scrolling', 'slider_pro')),
									
									'thumbnail_scroll_easing' => array('default_value' => 'swing', 
																	   'name' => __('Thumbnail Scroll Easing', 'slider_pro'), 
																	   'type' => 'select', 
																	   'list' => 'easing',
																	   'category' => 'thumbnails',
																	   'group' => __('Scrolling', 'slider_pro')),
																	   
									// thumbnail arrow settings
									'thumbnail_arrows' => array('default_value' => true, 
																'name' => __('Thumbnail Arrows', 'slider_pro'), 
																'type' => 'checkbox',
																'category' => 'thumbnails',
																'group' => __('Arrows', 'slider_pro')),
									
									'thumbnail_arrows_toggle' => array('default_value' => false, 
															  		   'name' => __('Thumbnail Arrows Toggle', 'slider_pro'), 
															  		   'type' => 'checkbox',
																	   'category' => 'thumbnails',
																	   'group' => __('Arrows', 'slider_pro')),
									
									'thumbnail_arrows_hide_duration' => array('default_value' => 500, 
																		 	  'name' => __('Thumbnail Arrows Hide Duration', 'slider_pro'), 
																		 	  'type' => 'text',
																			  'category' => 'thumbnails',
																			  'group' => __('Arrows', 'slider_pro')),
									
									'thumbnail_arrows_show_duration' => array('default_value' => 500, 
																		 	  'name' => __('Thumbnail Arrows Show Duration', 'slider_pro'), 
																		 	  'type' => 'text',
																			  'category' => 'thumbnails',
																			  'group' => __('Arrows', 'slider_pro')),
									
									// thumbnail buttons settings
									'thumbnail_buttons' => array('default_value' => false, 
															     'name' => __('Thumbnail Buttons', 'slider_pro'), 
															     'type' => 'checkbox',
																 'category' => 'thumbnails',
																 'group' => 'Buttons'),
									
									'thumbnail_buttons_toggle' => array('default_value' => false, 
																	    'name' => __('Thumbnail Buttons Toggle', 'slider_pro'), 
																	    'type' => 'checkbox',
																		'category' => 'thumbnails',
																		'group' => 'Buttons'),
									
									'thumbnail_buttons_hide_duration' => array('default_value' => 500, 
																		 	   'name' => __('Thumbnail Buttons Hide Duration', 'slider_pro'), 
																		 	   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Buttons'),
									
									'thumbnail_buttons_show_duration' => array('default_value' => 500, 
																		 	   'name' => __('Thumbnail Buttons Show Duration', 'slider_pro'), 
																		 	   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => 'Buttons'),
									
									// thumbnail scrollbar settings
									'thumbnail_scrollbar' => array('default_value' => false, 
																   'name' => __('Thumbnail Scrollbar', 'slider_pro'), 
																   'type' => 'checkbox',
																   'category' => 'thumbnails',
																   'group' => __('Scrollbar', 'slider_pro')),									
									
									'scrollbar_skin' => array('default_value' => 'scrollbar-1', 
															  'name' => __('Scrollbar Skin', 'slider_pro'), 
															  'type' => 'function',
															  'function_name' => 'sliderpro_get_scrollbar_skin',
															  'category' => 'thumbnails',
															  'group' => __('Scrollbar', 'slider_pro')),
									
									'thumbnail_scrollbar_toggle' => array('default_value' => false, 
																		  'name' => __('Thumbnail Scrollbar Toggle', 'slider_pro'), 
																		  'type' => 'checkbox',
																		  'category' => 'thumbnails',
																		  'group' => __('Scrollbar', 'slider_pro')),
																		  						  
									'thumbnail_scrollbar_hide_duration' => array('default_value' => 500, 
																		 	   	 'name' => __('Thumbnail Scrollbar Hide Duration', 'slider_pro'), 
																		 	   	 'type' => 'text',
																				 'category' => 'thumbnails',
																				 'group' => __('Scrollbar', 'slider_pro')),
									
									'thumbnail_scrollbar_show_duration' => array('default_value' => 500, 
																		 		 'name' => __('Thumbnail Scrollbar Show Duration', 'slider_pro'), 
																		 	   	 'type' => 'text',
																				 'category' => 'thumbnails',
																				 'group' => __('Scrollbar', 'slider_pro')),
									
									'thumbnail_scrollbar_ease' => array('default_value' => 10, 
																		'name' => __('Thumbnail Scrollbar Ease', 'slider_pro'), 
																		'type' => 'text',
																		'category' => 'thumbnails',
																		'group' => __('Scrollbar', 'slider_pro')),
									
									'scrollbar_arrow_scroll_amount' => array('default_value' => 100, 
																		 	 'name' => __('Scrollbar Arrow Scroll Amount', 'slider_pro'), 
																		 	 'type' => 'text',
																			 'category' => 'thumbnails',
																			 'group' => __('Scrollbar', 'slider_pro')),
									
									// thumbnail mouse scroll settings
									'thumbnail_mouse_scroll' => array('default_value' => false, 
																	  'name' => __('Thumbnail Mouse Scroll', 'slider_pro'), 
																	  'type' => 'checkbox',
																	  'category' => 'thumbnails',
																	  'group' => __('Mouse Scroll', 'slider_pro')),
									
									'thumbnail_mouse_scroll_speed' => array('default_value' => 10, 
																			'name' => __('Thumbnail Mouse Scroll Speed', 'slider_pro'), 
																			'type' => 'text',
																			'category' => 'thumbnails',
																			'group' => __('Mouse Scroll', 'slider_pro')),
									
									'thumbnail_mouse_scroll_ease' => array('default_value' => 90, 
																		   'name' => __('Thumbnail Mouse Scroll Ease', 'slider_pro'), 
																		   'type' => 'text',
																		   'category' => 'thumbnails',
																		   'group' => __('Mouse Scroll', 'slider_pro')),
									
									// thumbnail mouse wheel settings
									'thumbnail_mouse_wheel' => array('default_value' => false, 
																     'name' => __('Thumbnail Mouse Wheel', 'slider_pro'), 
																     'type' => 'checkbox',
																	 'category' => 'thumbnails',
																	 'group' => __('Mouse Wheel', 'slider_pro')),
									
									'thumbnail_mouse_wheel_speed' => array('default_value' => 20, 
																		   'name' => __('Thumbnail Mouse Scroll Speed', 'slider_pro'), 
																		   'type' => 'text',
																		   'category' => 'thumbnails',
																		   'group' => __('Mouse Wheel', 'slider_pro')),
									
									'thumbnail_mouse_wheel_reverse' => array('default_value' => false, 
																		     'name' => __('Thumbnail Mouse Wheel Reverse', 'slider_pro'), 
																		     'type' => 'checkbox',
																			 'category' => 'thumbnails',
																			 'group' => __('Mouse Wheel', 'slider_pro')),
									
									// thumbnail caption settings
									'thumbnail_caption' => array('default_value' => true, 
																 'name' => __('Thumbnail Caption', 'slider_pro'), 
																 'type' => 'checkbox', 
																 'category' => 'thumbnails',
																 'group' => __('Caption', 'slider_pro')),

									'thumbnail_caption_position' => array('default_value' => 'bottom', 
																	   	  'name' => __('Thumbnail Caption Position', 'slider_pro'), 
																	   	  'type' => 'select', 
																	   	  'list' => 'thumbnail_caption_position',
																		  'category' => 'thumbnails',
																		  'group' => __('Caption', 'slider_pro')),
									
									'thumbnail_caption_effect' => array('default_value' => 'slide', 
																	   	'name' => __('Thumbnail Caption Effect', 'slider_pro'), 
																	   	'type' => 'select', 
																	   	'list' => 'thumbnail_caption_effect',
																		'category' => 'thumbnails',
																		'group' => __('Caption', 'slider_pro')),
									
									'thumbnail_caption_toggle' => array('default_value' => true, 
																	    'name' => __('Thumbnail Caption Toggle', 'slider_pro'), 
																	    'type' => 'checkbox',
																		'category' => 'thumbnails',
																		'group' => __('Caption', 'slider_pro')),
																		
									'thumbnail_caption_show_duration' => array('default_value' => 500, 
															 				   'name' => __('Thumbnail Caption Show Duration', 'slider_pro'), 
															 				   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => __('Caption', 'slider_pro')),
									
									'thumbnail_caption_hide_duration' => array('default_value' => 500, 
															 				   'name' => __('Thumbnail Caption Hide Duration', 'slider_pro'), 
															 				   'type' => 'text',
																			   'category' => 'thumbnails',
																			   'group' => __('Caption', 'slider_pro')),
									
									'thumbnail_caption_easing' => array('default_value' => 'swing', 
																		'name' => __('Thumbnail Caption Easing', 'slider_pro'), 
																		'type' => 'select', 
																		'list' => 'easing',
																		'category' => 'thumbnails',
																		'group' => __('Caption', 'slider_pro')),
									
									// thumbnail tooltip settings
									'thumbnail_tooltip' => array('default_value' => false, 
																 'name' => __('Thumbnail Tooltip', 'slider_pro'), 
																 'type' => 'checkbox',
																 'category' => 'thumbnails',
																 'group' => __('Tooltip', 'slider_pro')),
																 
									'tooltip_show_duration' => array('default_value' => 300, 
															 		 'name' => __('Tooltip Show Duration', 'slider_pro'), 
															 		 'type' => 'text',
																	 'category' => 'thumbnails',
																	 'group' => __('Tooltip', 'slider_pro')),
									
									'tooltip_hide_duration' => array('default_value' => 300, 
															 		 'name' => __('Tooltip Hide Duration', 'slider_pro'), 
															 		 'type' => 'text',
																	 'category' => 'thumbnails',
																	 'group' => __('Tooltip', 'slider_pro')),
									
									
									// caption settings
									// style settings
									'caption_toggle' => array('default_value' => false, 
															  'name' => __('Caption Toggle', 'slider_pro'), 
															  'type' => 'checkbox',
															  'category' => 'captions',
															  'group' => __('Style', 'slider_pro')),
									
									'caption_background_opacity' => array('default_value' => 0.5, 
																		  'name' => __('Caption Background Opacity', 'slider_pro'), 
																		  'type' => 'text',
																		  'category' => 'captions',
																		  'group' => __('Style', 'slider_pro')),
									
									'caption_background_color' => array('default_value' => '#000000', 
																		'name' => __('Caption Background Color', 'slider_pro'), 
																		'type' => 'color',
																		'category' => 'captions',
																		'group' => __('Style', 'slider_pro')),
									
									'caption_delay' => array('default_value' => 0, 
															 'name' => __('Caption Delay', 'slider_pro'), 
															 'type' => 'text',
															 'category' => 'captions',
															 'group' => __('Show Effect', 'slider_pro')),
															 
									// size and position settings
									'caption_position' => array('default_value' => 'bottom', 
																'name' => __('Caption Position', 'slider_pro'), 
																'type' => 'select', 
																'list' => 'caption_position',
																'category' => 'captions',
																'group' => __('Size and Position', 'slider_pro')),
									
									'caption_size' => array('default_value' => 70, 
															'name' => __('Caption Size', 'slider_pro'), 
															'type' => 'text',
															'category' => 'captions',
															'group' => __('Size and Position', 'slider_pro')),
									
									'caption_left' => array('default_value' => 50, 
															'name' => __('Caption Left', 'slider_pro'), 
															'type' => 'text',
															'category' => 'captions',
															'group' => __('Size and Position', 'slider_pro')),
									
									'caption_top' => array('default_value' => 50, 
														   'name' => __('Caption Top', 'slider_pro'), 
														   'type' => 'text',
														   'category' => 'captions',
														   'group' => __('Size and Position', 'slider_pro')),
									
									'caption_width' => array('default_value' => 300, 
															 'name' => __('Caption Width', 'slider_pro'), 
															 'type' => 'text',
															 'category' => 'captions',
															 'group' => __('Size and Position', 'slider_pro')),
									
									'caption_height' => array('default_value' => 100, 
															  'name' => __('Caption Height', 'slider_pro'), 
															  'type' => 'text',
															  'category' => 'captions',
															  'group' => __('Size and Position', 'slider_pro')),
															  
									// show effect settings
									'caption_show_effect' => array('default_value' => 'slide', 
																   'name' => __('Caption Show Effect', 'slider_pro'), 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'category' => 'captions',
																   'group' => __('Show Effect', 'slider_pro')),
									
									'caption_show_effect_duration' => array('default_value' => 500, 
																			'name' => __('Caption Show Effect Duration', 'slider_pro'), 
																			'type' => 'text',
																			'category' => 'captions',
																			'group' => __('Show Effect', 'slider_pro')),
									
									'caption_show_effect_easing' => array('default_value' => 'swing', 
																		  'name' => __('Caption Show Effect Easing', 'slider_pro'), 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'category' => 'captions',
																		  'group' => __('Show Effect', 'slider_pro')),
									
									'caption_show_slide_direction' => array('default_value' => 'auto', 
																			'name' => __('Caption Show Slide Direction', 'slider_pro'), 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'category' => 'captions',
																			'group' => __('Show Effect', 'slider_pro')),									
									
									// hide effect settings
									'caption_hide_effect' => array('default_value' => 'fade', 
																   'name' => __('Caption Hide Effect', 'slider_pro'), 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'category' => 'captions',
																   'group' => __('Hide Effect', 'slider_pro')),
									
									'caption_hide_effect_duration' => array('default_value' => 300, 
																			'name' => __('Caption Hide Effect Duration', 'slider_pro'), 
																			'type' => 'text',
																			'category' => 'captions',
																			'group' => __('Hide Effect', 'slider_pro')),
									
									'caption_hide_effect_easing' => array('default_value' => 'swing', 
																		  'name' => __('Caption Hide Effect Easing', 'slider_pro'), 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'category' => 'captions',
																		  'group' => __('Hide Effect', 'slider_pro')),
									
									'caption_hide_slide_direction' => array('default_value' => 'auto', 
																			'name' => __('Caption Hide Slide Direction', 'slider_pro'), 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'category' => 'captions',
																			'group' => __('Hide Effect', 'slider_pro')),
																			
											
																			
									// video settings
									// controllers settings
									/*'youtube_controller' => array('default_value' => false, 
															  	  'name' => __('Youtube Controller', 'slider_pro'), 
															  	  'type' => 'checkbox',
																  'category' => 'video',
																  'group' => __('Controllers', 'slider_pro')),
									
									'vimeo_controller' => array('default_value' => false, 
															  	'name' => __('Vimeo Controller', 'slider_pro'), 
															  	'type' => 'checkbox',
																'category' => 'video',
																'group' => __('Controllers', 'slider_pro')),
									
									'html5_controller' => array('default_value' => false, 
															  	'name' => __('HMTL5 Controller', 'slider_pro'), 
															  	'type' => 'checkbox',
																'category' => 'video',
																'group' => __('Controllers', 'slider_pro')),
									
									'videojs_controller' => array('default_value' => false, 
															  	  'name' => __('VideoJS Controller', 'slider_pro'), 
															  	  'type' => 'checkbox',
																  'category' => 'video',
																  'group' => __('Controllers', 'slider_pro')),
																  
									'jwplayer_controller' => array('default_value' => false, 
															  	   'name' => __('JWPlayer Controller', 'slider_pro'), 
															  	   'type' => 'checkbox',
																   'category' => 'video',
																   'group' => __('Controllers', 'slider_pro')),*/														  
																  
									
									// actions settings							  
									'video_play_action' => array('default_value' => 'stopSlideshow', 
																 'name' => __('Video Play Action', 'slider_pro'), 
																 'type' => 'select', 
																 'list' => 'video_play_action',
																 'category' => 'video',
																 'group' => __('Actions', 'slider_pro')),
									
									'video_pause_action' => array('default_value' => 'none', 
																  'name' => __('Video Pause Action', 'slider_pro'), 
																  'type' => 'select', 
																  'list' => 'video_pause_action',
																  'category' => 'video',
																  'group' => __('Actions', 'slider_pro')),
									
									'video_end_action' => array('default_value' => 'startSlideshow',
																'name' => __('Video End Action', 'slider_pro'), 
																'type' => 'select', 
																'list' => 'video_end_action',
																'category' => 'video',
																'group' => __('Actions', 'slider_pro')),
									
									'reach_video_action' => array('default_value' => 'none', 
																  'name' => __('Reach Video Action', 'slider_pro'), 
																  'type' => 'select', 
																  'list' => 'reach_video_action',
																  'category' => 'video',
																  'group' => __('Actions', 'slider_pro')),
									
									'leave_video_action' => array('default_value' => 'pauseVideo', 
																  'name' => __('Leave Video Action', 'slider_pro'), 
																  'type' => 'select', 
																  'list' => 'leave_video_action',
																  'category' => 'video',
																  'group' => __('Actions', 'slider_pro')),
																  
									'jwplayer_path' => array('default_value' => '', 
															 'name' => __('JW Player Path', 'slider_pro'), 
															 'type' => 'longtext',
															 'category' => 'video',
															 'group' => __('JW Player', 'slider_pro')),
									
									'jwplayer_skin' => array('default_value' => '', 
															 'name' => __('JW Player Skin', 'slider_pro'), 
															 'type' => 'longtext',
															 'category' => 'video',
															 'group' => __('JW Player', 'slider_pro')),
									
									
									// image resizing settings
									// slide resizing settings
									'slide_resizing_resize' => array('default_value' => false, 
															  		 'name' => __('Slide Resizing Resize', 'slider_pro'), 
															  		 'type' => 'checkbox',
																	 'category' => 'timthumb_resizing',
																	 'group' => __('Slide', 'slider_pro')),
									
									'slide_resizing_align' => array('default_value' => 'c', 
																  	'name' => __('Slide Resizing Align', 'slider_pro'), 
																  	'type' => 'select', 
																  	'list' => 'resizing_align',
																	'category' => 'timthumb_resizing',
																	'group' => __('Slide', 'slider_pro')),
									
									'slide_resizing_crop' => array('default_value' => 1, 
																   'name' => __('Slide Resizing Crop', 'slider_pro'), 
																   'type' => 'select',
																   'list' => 'resizing_crop',
																   'category' => 'timthumb_resizing',
																   'group' => __('Slide', 'slider_pro')),
									
									'slide_resizing_quality' => array('default_value' => 95, 
																	  'name' => __('Slide Resizing Quality', 'slider_pro'), 
																  	  'type' => 'text',
																	  'category' => 'timthumb_resizing',
																	  'group' => __('Slide', 'slider_pro')),
									
									'slide_resizing_width' => array('default_value' => 'auto', 
																  	'name' => __('Slide Resizing Width', 'slider_pro'), 
																  	'type' => 'text',
																	'category' => 'timthumb_resizing',
																	'group' => __('Slide', 'slider_pro')),
									
									'slide_resizing_height' => array('default_value' => 'auto', 
																  	 'name' => __('Slide Resizing Height', 'slider_pro'), 
																  	 'type' => 'text',
																	 'category' => 'timthumb_resizing',
																	 'group' => __('Slide', 'slider_pro')),
									
									// thumbnail resizing settings
									'thumbnail_resizing_resize' => array('default_value' => true, 
															  			 'name' => __('Thumbnail Resizing Resize', 'slider_pro'), 
															  			 'type' => 'checkbox',
																		 'category' => 'timthumb_resizing',
																		 'group' => 'Thumbnail'),
									
									'thumbnail_resizing_align' => array('default_value' => 'c', 
																  		'name' => __('Thumbnail Resizing Align', 'slider_pro'), 
																  		'type' => 'select', 
																  		'list' => 'resizing_align',
																		'category' => 'timthumb_resizing',
																		'group' => 'Thumbnail'),
									
									'thumbnail_resizing_crop' => array('default_value' => 1, 
																   	   'name' => __('Thumbnail Resizing Crop', 'slider_pro'), 
																   	   'type' => 'select',
																	   'list' => 'resizing_crop',
																	   'category' => 'timthumb_resizing',
																	   'group' => 'Thumbnail'),
									
									'thumbnail_resizing_quality' => array('default_value' => 95, 
																	  	  'name' => __('Thumbnail Resizing Quality', 'slider_pro'), 
																  	  	  'type' => 'text',
																		  'category' => 'timthumb_resizing',
																		  'group' => 'Thumbnail')
									);



// default settings that are used for the slider's slides but are not included in the JS slider
$sliderpro_slide_extra_settings = array('slide_link_target' => '_self',
										'slide_link_lightbox' => false,
										'thumbnail_link_target' => '_self',
										'thumbnail_link_lightbox' => false,
										'layers_num' => 0,
										'layers_ids' => '');



// default settings for the dynamic fields
$sliderpro_slide_dynamic_settings = array('slide_type' => 'static',

										  'dynamic_posts_types' => '',
										  'dynamic_posts_taxonomies' => '',
										  'dynamic_posts_relation' => 'or',												  
										  'dynamic_posts_orderby' => 'date',
										  'dynamic_posts_order' => 'DESC', 
										  'dynamic_posts_maximum' => 10, 
										  'dynamic_posts_offset' => 0,
										  'dynamic_posts_featured' => false,
										  
										  'dynamic_gallery_post' => '-1',
										  'dynamic_gallery_maximum' => -1, 
										  'dynamic_gallery_offset' => 0,
										  
										  'dynamic_flickr_api_key' => '',
										  'dynamic_flickr_maximum' => 500, 
										  'dynamic_flickr_data_type' => 'set',
										  'dynamic_flickr_data_id' => '');



// default settings for the slide layers
$sliderpro_layer_settings = array('layer_transition' => 'none',
								  'layer_offset' => '50',
								  'layer_easing' => 'swing',
								  'layer_duration' => '400',
								  'layer_delay' => '0',
								  'layer_position' => 'topLeft',
								  'layer_horizontal' => '0',
								  'layer_vertical' => '0',
								  'layer_width' => 'auto',
								  'layer_height' => 'auto',
								  'layer_preset_styles' => '',
								  'layer_custom_class' => '',
								  'layer_depth' => '');



// preset styles for layers
$sliderpro_layer_preset_styles = array('black', 'white', 'static', 'rounded');



// default settings for the alide
$sliderpro_slide_settings = array('align_type' => array('default_value' => 'centerCenter', 
														'name' => __('Align Type', 'slider_pro'), 
														'type' => 'select', 
														'list' => 'align_type',
														'group' => __('Miscellaneous', 'slider_pro')),
									
									'slideshow_delay' => array('default_value' => 5000, 
															   'name' => __('Slideshow Delay', 'slider_pro'), 
															   'type' => 'text',
															   'group' => __('Miscellaneous', 'slider_pro')),
									
									'thumbnail_type' => array('default_value' => 'tooltip', 
															  'name' => __('Thumbnail Type', 'slider_pro'), 
															  'type' => 'select', 
															  'list' => 'thumbnail_type',
															  'group' => __('Miscellaneous', 'slider_pro')),
									
									'effect_type' => array('default_value' => 'random', 
														   'name' => __('Effect Type', 'slider_pro'), 
														   'type' => 'select', 
														   'list' => 'effect_type',
														   'group' => __('Effects General', 'slider_pro')),
									
									'slice_effect_type' => array('default_value' => 'random', 
																 'name' => __('Slice Effect Type', 'slider_pro'), 
																 'type' => 'select', 
																 'list' => 'slice_effect_type',
																 'group' => __('Effects General', 'slider_pro')),
									
									'html_during_transition' => array('default_value' => true, 
																	  'name' => __('HTML During Transition', 'slider_pro'), 
																	  'type' => 'checkbox',
																	  'group' => __('Effects General', 'slider_pro')),
									
									'slide_direction' => array('default_value' => 'autoHorizontal', 
															   'name' => __('Slide Direction', 'slider_pro'), 
															   'type' => 'select', 
															   'list' => 'slide_direction',
															   'group' => __('Slide Effect', 'slider_pro')),
									
									'slide_loop' => array('default_value' => false, 
														  'name' => __('Slide Loop', 'slider_pro'), 
														  'type' => 'checkbox',
														  'group' => __('Slide Effect', 'slider_pro')),
									
									'slide_duration' => array('default_value' => 700, 
															  'name' => __('Slide Duration', 'slider_pro'), 
															  'type' => 'text',
															  'group' => __('Slide Effect', 'slider_pro')),
									
									'slide_easing' => array('default_value' => 'swing', 
															'name' => __('Slide Easing', 'slider_pro'), 
															'type' => 'select', 
															'list' => 'easing',
															'group' => __('Slide Effect', 'slider_pro')),
									
									'slice_delay' => array('default_value' => 50, 
														   'name' => __('Slice Delay', 'slider_pro'), 
														   'type' => 'text',
														   'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_duration' => array('default_value' => 1000, 
															  'name' => __('Slice Duration', 'slider_pro'), 
															  'type' => 'text',
															  'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_easing' => array('default_value' => 'swing', 
															'name' => __('Slice Easing', 'slider_pro'), 
															'type' => 'select', 
															'list' => 'easing',
															'group' => __('Slice Effect', 'slider_pro')),
									
									'horizontal_slices' => array('default_value' => 5,
																 'name' => __('Horizontal Slices', 'slider_pro'), 
																 'type' => 'text',
																 'group' => __('Slice Effect', 'slider_pro')),
									
									'vertical_slices' => array('default_value' => 3, 
															   'name' => __('Vertical Slices', 'slider_pro'), 
															   'type' => 'text',
															   'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_pattern' => array('default_value' => 'random', 
															 'name' => __('Slice Pattern', 'slider_pro'), 
															 'type' => 'select', 
															 'list' => 'slice_pattern',
															 'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_point' => array('default_value' => 'centerCenter', 
														   'name' => __('Slice Point', 'slider_pro'), 
														   'type' => 'select', 
														   'list' => 'slice_point',
														   'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_start_position' => array('default_value' => 'left', 
																	'name' => __('Slice Start Position', 'slider_pro'), 
																	'type' => 'select', 
																	'list' => 'slice_start_position',
																	'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_start_ratio' => array('default_value' => 1, 
																 'name' => __('Slice Start Ratio', 'slider_pro'), 
																 'type' => 'text',
																 'group' => __('Slice Effect', 'slider_pro')),
									
									'slice_fade' => array('default_value' => true, 
														  'name' => __('Slice Fade', 'slider_pro'), 
														  'type' => 'checkbox',
														  'group' => __('Slice Effect', 'slider_pro')),
									
									'slide_mask' => array('default_value' => false, 
														  'name' => __('Slide Mask', 'slider_pro'), 
														  'type' => 'checkbox',
														  'group' => __('Slice Effect', 'slider_pro')),
									
									'fade_previous_slide' => array('default_value' => false, 
																   'name' => __('Fade Previous Slide', 'slider_pro'), 
																   'type' => 'checkbox',
																   'group' => __('Slice Effect', 'slider_pro')),
									
									'fade_previous_slide_duration' => array('default_value' => 300, 
																			'name' => __('Fade Previous Slide Duration', 'slider_pro'), 
																			'type' => 'text',
																			'group' => __('Slice Effect', 'slider_pro')),
									
									'fade_in_duration' => array('default_value' => 700, 
																'name' => __('Fade In Duration', 'slider_pro'), 
																'type' => 'text',
																'group' => __('Fade Effect', 'slider_pro')),
									
									'fade_out_duration' => array('default_value' => 700, 
																 'name' => __('Fade Out Duration', 'slider_pro'), 
																 'type' => 'text',
																 'group' => __('Fade Effect', 'slider_pro')),
									
									'fade_in_easing' => array('default_value' => 'swing', 
															  'name' => __('Fade In Easing', 'slider_pro'), 
															  'type' => 'select', 
															  'list' => 'easing',
															  'group' => __('Fade Effect', 'slider_pro')),
									
									'fade_out_easing' => array('default_value' => 'swing', 
															   'name' => __('Fade Out Easing', 'slider_pro'), 
															   'type' => 'select', 
															   'list' => 'easing',
															   'group' => __('Fade Effect', 'slider_pro')),
									
									'caption_position' => array('default_value' => 'bottom', 
																'name' => __('Caption Position', 'slider_pro'), 
																'type' => 'select', 
																'list' => 'caption_position',
																'group' => __('Caption', 'slider_pro')),
									
									'caption_delay' => array('default_value' => 0, 
															 'name' => __('Caption Delay', 'slider_pro'), 
															 'type' => 'text',
															 'group' => __('Caption', 'slider_pro')),
									
									'caption_background_opacity' => array('default_value' => 0.5, 
																		  'name' => __('Caption Background Opacity', 'slider_pro'), 
																		  'type' => 'text',
																		  'group' => __('Caption', 'slider_pro')),
									
									'caption_background_color' => array('default_value' => '#000000', 
																		'name' => __('Caption Background Color', 'slider_pro'), 
																		'type' => 'color',
																		'group' => __('Caption', 'slider_pro')),
									
									'caption_show_effect' => array('default_value' => 'slide', 
																   'name' => __('Caption Show Effect', 'slider_pro'), 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'group' => __('Caption', 'slider_pro')),
									
									'caption_show_effect_duration' => array('default_value' => 500, 
																			'name' => __('Caption Show Effect Duration', 'slider_pro'), 
																			'type' => 'text',
																			'group' => __('Caption', 'slider_pro')),
									
									'caption_show_effect_easing' => array('default_value' => 'swing', 
																		  'name' => __('Caption Show Effect Easing', 'slider_pro'), 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'group' => __('Caption', 'slider_pro')),
									
									'caption_show_slide_direction' => array('default_value' => 'auto', 
																			'name' => __('Caption Show Slide Direction', 'slider_pro'), 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'group' => __('Caption', 'slider_pro')),
									
									'caption_hide_effect' => array('default_value' => 'fade', 
																   'name' => __('Caption Hide Effect', 'slider_pro'), 
																   'type' => 'select', 
																   'list' => 'caption_effect',
																   'group' => __('Caption', 'slider_pro')),
									
									'caption_hide_effect_duration' => array('default_value' => 300, 
																			'name' => __('Caption Hide Effect Duration', 'slider_pro'), 
																			'type' => 'text',
																			'group' => __('Caption', 'slider_pro')),
									
									'caption_hide_effect_easing' => array('default_value' => 'swing', 
																		  'name' => __('Caption Hide Effect Easing', 'slider_pro'), 
																		  'type' => 'select', 
																		  'list' => 'easing',
																		  'group' => __('Caption', 'slider_pro')),
									
									'caption_hide_slide_direction' => array('default_value' => 'auto', 
																			'name' => __('Caption Hide Slide Direction', 'slider_pro'), 
																			'type' => 'select', 
																			'list' => 'caption_slide_direction',
																			'group' => __('Caption', 'slider_pro')),
									
									'caption_size' => array('default_value' => 70, 
															'name' => __('Caption Size', 'slider_pro'), 
															'type' => 'text',
															'group' => __('Caption', 'slider_pro')),
									
									'caption_left' => array('default_value' => 50, 
															'name' => __('Caption Left', 'slider_pro'), 
															'type' => 'text',
															'group' => __('Caption', 'slider_pro')),
									
									'caption_top' => array('default_value' => 50, 
														   'name' => __('Caption Top', 'slider_pro'), 
														   'type' => 'text',
														   'group' => __('Caption', 'slider_pro')),
									
									'caption_width' => array('default_value' => 300, 
															 'name' => __('Caption Width', 'slider_pro'), 
															 'type' => 'text',
															 'group' => __('Caption', 'slider_pro')),
									
									'caption_height' => array('default_value' => 100, 
															  'name' => __('Caption Height', 'slider_pro'), 
															  'type' => 'text',
															  'group' => __('Caption', 'slider_pro')));
										  
										  
										  
// associates a setting with the javascript name of the property
$sliderpro_js_properties = array('width' => 'width', 
								  'height' => 'height',
								  'responsive' => 'responsive',
								  'aspect_ratio' => 'aspectRatio',
								  'skin' => 'skin', 
								  'scrollbar_skin' => 'scrollbarSkin', 								  
								  'align_type' => 'alignType', 								  							  
								  'scale_type' => 'scaleType',
								  'allow_scale_up' => 'allowScaleUp',
								  'preload_nearby_images' => 'preloadNearbyImages',
								  'shuffle' => 'shuffle',
								  'slide_start' => 'slideStart',
											
								  'slideshow' => 'slideshow', 
								  'slideshow_loop' => 'slideshowLoop',
								  'slideshow_delay' => 'slideshowDelay', 
								  'slideshow_direction' => 'slideshowDirection', 
								  'slideshow_controls' => 'slideshowControls',
								  'slideshow_controls_toggle' => 'slideshowControlsToggle',
								  'slideshow_controls_show_duration' => 'slideshowControlsShowDuration',
								  'slideshow_controls_hide_duration' => 'slideshowControlsHideDuration', 
								  'pause_slideshow_on_hover' => 'pauseSlideshowOnHover', 
								  
								  'keyboard_navigation' => 'keyboardNavigation',
								  'keyboard_navigation_on_focus_only' => 'keyboardNavigationOnFocusOnly',
								  'slide_arrows' => 'slideArrows', 
								  'slide_arrows_toggle' => 'slideArrowsToggle', 
								  'slide_arrows_show_duration' => 'slideArrowsShowDuration',
								  'slide_arrows_hide_duration' => 'slideArrowsHideDuration', 
								  'slide_buttons' => 'slideButtons', 
								  'slide_buttons_center' => 'slideButtonsCenter',									
								  'slide_buttons_container_center' => 'slideButtonsContainerCenter',									
								  'slide_buttons_toggle' => 'slideButtonsToggle',
								  'slide_buttons_show_duration' => 'slideButtonsShowDuration',
								  'slide_buttons_hide_duration' => 'slideButtonsHideDuration',
								  'slide_buttons_number' => 'slideButtonsNumber',								  
								  'auto_toggle' => 'autoToggle',	   
								  'auto_toggle_delay' => 'autoToggleDelay',
								  
								  /*'lightbox' => 'lightbox',*/
								  'lightbox_theme' => 'lightboxTheme',
								  'lightbox_opacity' => 'lightboxOpacity',
								  'lightbox_autoplay' => 'lightboxAutoplay',
								  'lightbox_autoplay_delay' => 'lightboxAutoplayDelay',
								  'lightbox_video_autoplay' => 'lightboxVideoAutoplay',
								  'ligthbox_allow_resize' => 'ligthboxAllowResize',
								  'lightbox_icon' => 'lightboxIcon',
								  'lightbox_icon_toggle' => 'lightboxIconToggle',
								  'lightbox_icon_fade_duration' => 'lightboxIconFadeDuration',
								  'thumbnail_lightbox_icon' => 'thumbnailLightboxIcon',
								  'thumbnail_lightbox_icon_toggle' => 'thumbnailLightboxIconToggle',
								  
								  'border' => 'border',
								  'glow' => 'glow',
								  'shadow' => 'shadow',
								  
								  'fullscreen_controls' => 'fullscreenControls',
								  'fullscreen_controls_toggle' => 'fullscreenControlsToggle',
								  'fullscreen_controls_show_duration' => 'fullscreenControlsShowDuration',
								  'fullscreen_controls_hide_duration' => 'fullscreenControlsHideDuration',	  
								  'fullscreen_thumbnail_scroller_overlay' => 'fullscreenThumbnailScrollerOverlay',
								  'fullscreen_slide_buttons' => 'fullscreenSlideButtons',
								  'fullscreen_shadow' => 'fullscreenShadow',
								  
								  'timer_animation' => 'timerAnimation', 
								  'timer_animation_controls' => 'timerAnimationControls',
								  'timer_fade_duration' => 'timerFadeDuration', 
								  'timer_toggle' => 'timerToggle', 
								  'timer_radius' => 'timerRadius', 
								  'timer_stroke_color1' => 'timerStrokeColor1', 
								  'timer_stroke_color2' => 'timerStrokeColor2', 
								  'timer_stroke_opacity1' => 'timerStrokeOpacity1', 
								  'timer_stroke_opacity2' => 'timerStrokeOpacity2', 
								  'timer_stroke_width1' => 'timerStrokeWidth1', 
								  'timer_stroke_width2' => 'timerStrokeWidth2', 
								  
								  'override_transition' => 'overrideTransition', 
								  'effect_type' => 'effectType',
								  'slice_effect_type' => 'sliceEffectType',
								  'initial_effect' => 'initialEffect',
								  'html_during_transition' => 'htmlDuringTransition',
								  
								  'slide_direction' => 'slideDirection', 
								  'slide_loop' => 'slideLoop', 
								  'slide_duration' => 'slideDuration', 
								  'slide_easing' => 'slideEasing', 
								 
								  'slice_delay' => 'sliceDelay', 
								  'slice_duration' => 'sliceDuration', 
								  'slice_easing' => 'sliceEasing', 
								  'horizontal_slices' => 'horizontalSlices', 
								  'vertical_slices' => 'verticalSlices', 
								  'slice_pattern' => 'slicePattern', 
								  'slice_point' => 'slicePoint', 
								  'slice_start_position' => 'sliceStartPosition', 
								  'slice_start_ratio' => 'sliceStartRatio', 
								  'slice_fade' => 'sliceFade', 
								  'slide_mask' => 'slideMask', 
								  'fade_previous_slide' => 'fadePreviousSlide',
								  'fade_previous_slide_duration' => 'fadePreviousSlideDuration',
								  
								  'fade_in_duration' => 'fadeInDuration',
								  'fade_out_duration' => 'fadeOutDuration',
								  'fade_in_easing' => 'fadeInEasing',
								  'fade_out_easing' => 'fadeOutEasing',
								
								  'swipe_orientation' => 'swipeOrientation',
								  'swipe_duration' => 'swipeDuration',
								  'swipe_back_duration' => 'swipeBackDuration',
								  'swipe_slide_distance' => 'swipeSlideDistance',
								  'swipe_easing' => 'swipeEasing',
								  'swipe_mouse_drag' => 'swipeMouseDrag',
								  'swipe_touch_drag' => 'swipeTouchDrag',
								  'swipe_grab_cursor' => 'swipeGrabCursor',
								  'swipe_threshold' => 'swipeThreshold',
								  
								  'thumbnail_slide_amount' => 'thumbnailSlideAmount', 
								  'thumbnail_slide_duration' => 'thumbnailSlideDuration', 
								  'thumbnail_slide_easing' => 'thumbnailSlideEasing',
								  'thumbnail_scroller_toggle' => 'thumbnailScrollerToggle', 
								  'thumbnail_scroller_hide_duration' => 'thumbnailScrollerHideDuration',
								  'thumbnail_scroller_show_duration' => 'thumbnailScrollerShowDuration', 
								  'thumbnail_scroller_center' => 'thumbnailScrollerCenter',
								  'thumbnail_sync' => 'thumbnailSync',
								  'thumbnail_scroller_responsive' => 'thumbnailScrollerResponsive',
								  'thumbnail_scroller_overlay' => 'thumbnailScrollerOverlay',
								  'maximum_visible_thumbnails' => 'maximumVisibleThumbnails',
								  'minimum_visible_thumbnails' => 'minimumVisibleThumbnails',
								  'thumbnail_type' => 'thumbnailType',
								  'thumbnail_width' => 'thumbnailWidth',
								  'thumbnail_height' => 'thumbnailHeight',
								  'thumbnail_orientation' => 'thumbnailOrientation', 
								  'thumbnail_layers' => 'thumbnailLayers',
								  'thumbnail_arrows' => 'thumbnailArrows', 
								  'thumbnail_arrows_toggle' => 'thumbnailArrowsToggle', 
								  'thumbnail_scroll_duration' => 'thumbnailScrollDuration', 
								  'thumbnail_scroll_easing' => 'thumbnailScrollEasing', 
								  'thumbnail_arrows_hide_duration' => 'thumbnailArrowsHideDuration', 
								  'thumbnail_arrows_show_duration' => 'thumbnailArrowsShowDuration', 
								  'thumbnail_buttons' => 'thumbnailButtons', 
								  'thumbnail_buttons_toggle' => 'thumbnailButtonsToggle',  
								  'thumbnail_buttons_hide_duration' => 'thumbnailButtonsHideDuration', 
								  'thumbnail_buttons_show_duration' => 'thumbnailButtonsShowDuration', 
								  'thumbnail_scrollbar' => 'thumbnailScrollbar', 
								  'thumbnail_scrollbar_toggle' => 'thumbnailScrollbarToggle', 
								  'thumbnail_scrollbar_hide_duration' => 'thumbnailScrollbarHideDuration',
								  'thumbnail_scrollbar_show_duration' => 'thumbnailScrollbarShowDuration', 
								  'thumbnail_scrollbar_ease' => 'thumbnailScrollbarEase',
								  'scrollbar_arrow_scroll_amount' => 'scrollbarArrowScrollAmount',								
								  'thumbnail_mouse_scroll' => 'thumbnailMouseScroll', 
								  'thumbnail_mouse_scroll_speed' => 'thumbnailMouseScrollSpeed', 
								  'thumbnail_mouse_scroll_ease' => 'thumbnailMouseScrollEase', 
								  'thumbnail_mouse_wheel' => 'thumbnailMouseWheel',
								  'thumbnail_mouse_wheel_speed' => 'thumbnailMouseWheelSpeed', 
								  'thumbnail_mouse_wheel_reverse' => 'thumbnailMouseWheelReverse',
								  'thumbnail_caption' => 'thumbnailCaption', 
								  'thumbnail_caption_position' => 'thumbnailCaptionPosition', 
								  'thumbnail_caption_toggle' => 'thumbnailCaptionToggle', 
								  'thumbnail_caption_effect' => 'thumbnailCaptionEffect', 
								  'thumbnail_caption_show_duration' => 'thumbnailCaptionShowDuration', 
								  'thumbnail_caption_hide_duration' => 'thumbnailCaptionHideDuration', 
								  'thumbnail_caption_easing' => 'thumbnailCaptionEasing', 
								  'thumbnail_tooltip' => 'thumbnailTooltip',
								  'tooltip_show_duration' => 'tooltipShowDuration', 
								  'tooltip_hide_duration' => 'tooltipHideDuration', 

								  'thumbnail_swipe' => 'thumbnailSwipe',
								  'thumbnail_swipe_back_duration' => 'thumbnailSwipeBackDuration',
								  'thumbnail_swipe_mouse_drag' => 'thumbnailSwipeMouseDrag',
								  'thumbnail_swipe_touch_drag' => 'thumbnailSwipeTouchDrag',
								  'thumbnail_swipe_grab_cursor' => 'thumbnailSwipeGrabCursor',
								  'thumbnail_swipe_threshold' => 'thumbnailSwipeThreshold',
								  
								  'caption_position' => 'captionPosition',
								  'caption_toggle' => 'captionToggle', 
								  'caption_background_opacity' => 'captionBackgroundOpacity', 
								  'caption_background_color' => 'captionBackgroundColor', 
								  'caption_show_effect' => 'captionShowEffect', 
								  'caption_show_effect_duration' => 'captionShowEffectDuration',
								  'caption_show_effect_easing' => 'captionShowEffectEasing', 
								  'caption_show_slide_direction' => 'captionShowSlideDirection', 
								  'caption_hide_effect' => 'captionHideEffect', 
								  'caption_hide_effect_duration' => 'captionHideEffectDuration',
								  'caption_hide_effect_easing' => 'captionHideEffectEasing', 
								  'caption_hide_slide_direction' => 'captionHideSlideDirection',
								  'caption_delay' => 'captionDelay', 
								  'caption_size' => 'captionSize', 
								  'caption_left' => 'captionLeft', 
								  'caption_top' => 'captionTop',
								  'caption_width' => 'captionWidth', 
								  'caption_height' => 'captionHeight',
								  
								  'video_play_action' => 'videoPlayAction',
								  'video_pause_action' => 'videoPauseAction',
								  'video_end_action' => 'videoEndAction',
								  'reach_video_action' => 'reachVideoAction',
								  'leave_video_action' => 'leaveVideoAction',
								  'jwplayer_path' => 'jwPlayerPath',
								  'jwplayer_skin' => 'jwPlayerSkin');



$sliderpro_flickr_sizes = array('square_75' => 's', 'square_150' => 'q', 'thumbnail_100' => 't', 'small_240' => 'm', 
								'small_320' => 'n', 'medium_640' => 'z', 'medium_800' => 'c', 'large_1024' => 'b');



// list with all the possible roles
$sliderpro_role_access = array(__('Administrator', 'slider_pro') => 'manage_options', __('Editor', 'slider_pro') => 'publish_pages',
							   __('Author', 'slider_pro') => 'publish_posts', __('Contributor', 'slider_pro') => 'edit_posts');



// add Super Admin to the roles list if the plugin is installed in a multisite environment
if (function_exists('is_multisite') && is_multisite())
	$sliderpro_role_access[__('Super Admin', 'slider_pro')] = 'manage_network';

?>