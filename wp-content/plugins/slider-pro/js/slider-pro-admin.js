(function($) {
	// this will contain the segments used for sorting the slides
	var slidesOrderContainer,
	
		// flag for AJAX requests
		ajaxRequestInProgress = false,
		
		// media loader lightbox
		mediaContainer,
		
		// the total height of images that are loaded in the media loader
		mediaLoaderImagesHeight,
		
		// hold a reference to the slide for which the media loader is opened
		mediaLoaderClickedButton,
		
		// reference to the help tooltip timer
		helpTooltipTimer,
		
		// indicates whether a help tooltip is currently displayed
		isHelpTooltip,
		
		// array that holds the paths of all images that need to be loaded in the slides
		selectedImages = [],

		selectedTextarea,

		selectedScaleType,

		selectedAlignType,
		
		// contains the post types and taxonomies
		postsData = $.parseJSON((sp_js_vars.posts_data).replace(/&quot;/g, '"'));
	
	
	$(document).ready(function() {
		
		// remove the stylesheet added by WordPress for the Jquery UI Dialog
		$('link[id="wp-jquery-ui-dialog-css"]').attr('disabled', 'disabled');
		$('link[id="wp-jquery-ui-dialog-css"]').remove();
		
		// get the container of the slide tabs from the 'Slides Order' panel
		slidesOrderContainer = $(document).find('.slides-order-container');

		// get the selected value for the Scale Type option
		selectedScaleType = $('select[name="slider_settings[scale_type]"]').val();

		// get the selected value for the Align Type option
		selectedAlignType = $('select[name="slider_settings[align_type]"]').val();


		// get all the existing slide panels and prepare them
		$('.slider-pro .slidebox').each(function(index){
			prepareSlide($(this));
		});
		
		
		// make the slide panels sortable
		$('.slider-pro .ui-sortable').sortable({
				placeholder: 'sortable-placeholder',
				items: '.postbox',
				handle: '.hndle',
				cursor: 'move',
				distance: 2,
				tolerance: 'pointer',
				forcePlaceholderSize: true,
				helper: 'clone',
				opacity: 0.7,
				
				start: function(event, ui) {
					$('body').css({
						WebkitUserSelect: 'none',
						KhtmlUserSelect: 'none'
					});
					
					// remove the tinyMCE editor when a panel is being moved
					if (sp_js_vars.rich_editing)
						ui.item.find('.sp-editor').each(function() {
							var id = $(this).attr('id');
							tinyMCE.execCommand('mceRemoveControl', false, id);
						});
				},
				
				stop: function(event, ui) {
					ui.item.parent().removeClass('temp-border');
					$('body').css({
						WebkitUserSelect: '',
						KhtmlUserSelect: ''
					});

					// change the value of the 'position' class based on the current position of the slide
					ui.item.parent().find('.slidebox').each(function(index){
						$(this).find('.position').val(index + 1);
					});
					
					// add the tinyMCE editor after a panel has stopped moving
					if (sp_js_vars.rich_editing)
						ui.item.find('.sp-editor').each(function() {
							var id = $(this).attr('id');
							tinyMCE.execCommand('mceAddControl', false, id);
						});
				}
		});
		
		
		$('.slider-pro .inner-sidebar .postbox select.settings-multiselect').each(function() {
			var selectBox = $(this);
			
			selectBox.multiselect({
						noneSelectedText: 'Select options to customize',
						selectedText: 'Select options to customize',
						header: 'Select options you want to customize',
						classes: 'slider-pro slider-settings',
						minWidth: 290
					})
					.multiselectfilter();
			});
		
		
		$('.ui-multiselect-menu.slider-settings ul li label').each(function() {
			var label = $(this),
				title = label.find('input').val();
			
			label.attr('title', title);
		});
		
		
		$('.ui-multiselect-menu.slider-settings ul li label').each(function() {
			addHelpTooltip($(this));
		});
			
			
		$('.slider-pro .inner-sidebar .postbox .display').each(function() {
			addSettingRefresh($(this));
		});
		
		
		// make the slide segments from the sidebar sortable
		slidesOrderContainer.sortable({
			placeholder: 'sortable-placeholder',
			cursor: 'move',
			tolerance: 'pointer',
			forcePlaceholderSize: true,
			helper: 'clone',
			opacity: 0.7,
			
			start: function(event, ui) {
				$('body').css({
					WebkitUserSelect: 'none',
					KhtmlUserSelect: 'none'
				});
			},
			
			stop: function(event, ui) {
				ui.item.parent().removeClass('temp-border');
				$('body').css({
					WebkitUserSelect: '',
					KhtmlUserSelect: ''
				});
				
				slidesOrderContainer.find('.slide-symbol').each(function(index){
					var counter = $(this).data('counter'),
						newPosition = index + 1;
					
					// change the value of the 'position' class based on the new position of the segment
					$('.slider-pro .ui-sortable .slidebox').each(function() {
						if ($(this).find('.counter').val() == counter) {
							$(this).find('.position').val(newPosition);
						}
					});
				});
			}
		});
		
		
		// add new slide panel(s)
		$('.slider-pro #add-new-slides').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
				
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0,
				quantity = parseInt($('.slider-pro #add-slides-quantity').val());
			
			// find the index of the new panel
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));
			});
			
			counter++;
			
			if (isNaN(quantity) || quantity < 1) {
				ajaxRequestInProgress = false;
				return;
			}
			
			showProcessingIndicator();
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, counter: counter, quantity: quantity},
				complete: function(data) {
					hideProcessingIndicator();
					
					var slides = $(data.responseText).appendTo($('.slideboxes'));
					
					slides.each(function(index) {
						var slide = $(this);	
						slide.find('.position').val(position + index);
						prepareSlide(slide);
						slide.hide().fadeIn();
					});
					
					ajaxRequestInProgress = false;
				}
			});
				
		});
		
		
		$('.slider-pro #add-image-slides').click(function(event) {
			event.preventDefault();

			var button = $(this);

			if (sp_js_vars.custom_media_loader || !sp_js_vars.is_new_media_loader) {

				openMediaLoader(button);

			} else {

				// check if wordpress includes the new media loader script
				if (typeof wp != 'undefined' && wp.media && wp.media.editor) {
					wp.media.editor.send.attachment = function(props, attachment) {
						// add the image url into the 'Path' field
						button.parents('.info-input').find('.path').val(attachment.url);			
				
						// trigger the click event in order to display the iamge
						button.siblings('a.preview-button').trigger('click');

						selectedImages.push(attachment.url);
					}

					
					wp.media.editor.insert = function(prop) {
						if (ajaxRequestInProgress)
							return;
							
						ajaxRequestInProgress = true;
						
						var action = 'sliderpro_add_new_slides',
							position = parseInt($('.slider-pro .slidebox').length) + 1,
							counter = 0,
							quantity = selectedImages.length;
						
						// find the index of the new panel	
						$('.slider-pro .slidebox').each(function(index) {
							counter = Math.max(counter, parseInt($(this).find('.counter').val()));									 
						});
						
						counter++;
						
						if (isNaN(quantity) || quantity < 1) {
							ajaxRequestInProgress = false;
							return;
						}
						
						showProcessingIndicator();
						
						$.ajax({
							url: sp_js_vars.ajaxurl,
							type: 'get',
							dataType: 'html',
							data: {action: action, counter: counter, quantity: quantity},
							complete: function(data) {
								hideProcessingIndicator();
								
								var slides = $(data.responseText).appendTo($('.slideboxes'));
									
								slides.each(function(index) {
									var slide = $(this);	
									slide.find('.position').val(position + index);
									prepareSlide(slide);
									slide.hide().fadeIn();
									
									slide.find('.path').first().val(selectedImages[index]);
									
									// trigger the click event in order to display the iamge
									slide.find('.main-image-buttons a.preview-button').trigger('click');
								});
								
								selectedImages = [];
													
								ajaxRequestInProgress = false;
							}
						});
					}

					wp.media.editor.open('media-loader');
				}
			}
		});
		
		
		$('.slider-pro #apply-bulk-actions').click(function(event) {
			event.preventDefault();
			
			action = $('#bulk-actions-select').val();
			
			if (action == 'Mark All') {	
						
				var slideboxes = $('.slidebox').not('.marked');
				
				slideboxes.addClass('marked');
				slideboxes.find('.selectiondiv').removeClass('unmarkeddiv')
												.addClass('markeddiv')
												.attr('title', 'Unmark the slide');

			} else if (action == 'Unmark All') {
								
				var slideboxes = $('.slidebox.marked');
				
				slideboxes.removeClass('marked');
				slideboxes.find('.selectiondiv').removeClass('markeddiv')
												.addClass('unmarkeddiv')
												.attr('title', 'Mark the slide');
														  
			} else if (action == 'Reverse marking') {
								
				var markedSlideboxes = $('.slidebox.marked'),
					unmarkedSlideboxes = $('.slidebox').not('.marked');
				
				markedSlideboxes.removeClass('marked');
				unmarkedSlideboxes.removeClass('unmarked').addClass('marked');
				
				markedSlideboxes.find('.selectiondiv').removeClass('markeddiv')
													  .addClass('unmarkeddiv')
													  .attr('title', 'Mark the slide');

				unmarkedSlideboxes.find('.selectiondiv').removeClass('unmarkeddiv')
														.addClass('markeddiv')
														.attr('title', 'Unmark the slide');
														  
			} else if (action == 'Enable Slides') {
								
				var slideboxes = $('.slidebox.marked'); 
				
				slideboxes.find('.visibility').val('enabled');
				slideboxes.find('.visibilitydiv').removeClass('disableddiv')
											     .addClass('enableddiv')
											     .attr('title', 'Disable the slide');
														  
			}  else if (action == 'Disable Slides') {
								
				var slideboxes = $('.slidebox.marked');
				
				slideboxes.find('.visibility').val('disabled');
				slideboxes.find('.visibilitydiv').removeClass('enableddiv')
											     .addClass('disableddiv')
											     .attr('title', 'Enable the slide');

			} else if (action == 'Delete Slides' ) {
								
				var slideboxes = $('.slideboxes'),
					selectedSlideboxes = slideboxes.find('.slidebox.marked'),
					dialogBox = $('<div><span class="warning-dialog-icon"></span><p>' + sp_js_vars.delete_slides + '</p></div>'),
					buttons = {},
					selectedCounters = [],
					counter = 0;
				
				if (!selectedSlideboxes.length)
					return;
					
				buttons[sp_js_vars.yes] = function() {
					dialogBox.remove();
					
					selectedSlideboxes.animate({'opacity': 0}, function() {
						$(this).slideUp(200, function() {
							$(this).remove();
							
							counter++;
							
							if (counter == selectedSlideboxes.length) {
								slideboxes.find('.slidebox').each(function(index){
									$(this).find('.position').val(index + 1);
								});
							}
						});
					});
					
					
					selectedSlideboxes.find('.counter').each(function() {
						selectedCounters.push($(this).val());
					});
					
					
					slidesOrderContainer.find('.slide-symbol').each(function(){
						if ($.inArray($(this).data('counter'), selectedCounters) != -1) {
							$(this).remove();
						}
					});
				}

				buttons[sp_js_vars.cancel] = function() {
					dialogBox.remove();
				};
					
				dialogBox.dialog({
							resizable:false,
							modal:true,
							width:270,
							buttons: buttons});
				
				$('.ui-dialog-titlebar').remove();
				$('.ui-dialog').addClass('slider-pro-warning-dialog');
				$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
						
			} else if (action == 'Refresh Images') {
				
				$('.slidebox.marked .main-image-buttons a.preview-button').trigger('click');
				
			} else if (action == 'Refresh Thumbs') {
				
				$('.slidebox.marked .thumbnail-buttons a.preview-button').trigger('click');
			}
		});
		
			
		// preview the slider
		$('.slider-pro .preview-slider').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
				
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				id = url.param('id'),
				name = url.param('name'),
				paramWidth = url.param('width'),
				paramHeight = url.param('height'),
				fluidWidth = paramWidth.indexOf('pc') != -1,
				fluidHeight = paramHeight.indexOf('pc') != -1,
				width = fluidWidth ? 700 : parseInt(paramWidth),
				height = fluidHeight ? 500 : parseInt(paramHeight),
				modalWindow,
				previewContainer = $('<div id="preview-container"></div>').appendTo($('body')),
				sizeContainer,
				sliderElement,
				slider;
			
			
			previewContainer.dialog({
				resizable: true,
				//modal: true,
				width: width,
				height: height,
				title: name + ' - ' + sp_js_vars.preview,
				create: function() {
					modalWindow = $('.ui-dialog').addClass('slider-pro-preview-dialog');
				},
				close: function() {
					slider.destroy();
					previewContainer.dialog('destroy');
					previewContainer.remove();

					$('.slider-pro-dialog-overlay').remove();
				}
			});
			
			
			$('<div class="slider-pro-dialog-overlay"></div>')
				.click(function() {
					slider.destroy();
					previewContainer.dialog('destroy');
					previewContainer.remove();

					$(this).remove();
				})
				.css('height', $(document).height())
				.appendTo($('body'));


			sizeContainer = $('<div id="size-container"></div>').appendTo(previewContainer);
			
			sizeContainer.html('<span class="size-text">Slider Size: </span>' +
								'<input class="size-input" id="slider-width-input" type="text" value=""/>' +
								'<span class="size-text"> X </span>' +
								'<input class="size-input" id="slider-height-input" type="text" value=""/>' +
								'<a class="button" id="preview-size-button" href="#">Preview Size</a>' +
								'<a class="button" id="apply-size-button" href="#">Apply Size</a>' +
								'<br/>' +
								'<span class="size-text">Slide' + '&nbsp;&nbsp;' + 'Size: </span> ' +
								'<input class="size-input" id="slide-width-input" type="text" value=""/>' +
								'<span class="size-text"> X </span>' +
								'<input class="size-input" id="slide-height-input" type="text" value=""/>');
			
			
			var sliderWidthInput = sizeContainer.find('#slider-width-input'),
				sliderHeightInput = sizeContainer.find('#slider-height-input'),
				slideWidthInput = sizeContainer.find('#slide-width-input'),
				slideHeightInput = sizeContainer.find('#slide-height-input'),
				previewSizeButton = sizeContainer.find('#preview-size-button'),
				applySizeButton = sizeContainer.find('#apply-size-button');
			
			
			previewSizeButton.click(function(event) {
				event.preventDefault();
				
				if (!fluidWidth)
					sliderElement.css('width', sliderWidthInput.val());
				
				if (!fluidHeight)
					sliderElement.css('height', sliderHeightInput.val());
				
				slider.doSliderLayout();
				
				if (fluidWidth && !fluidHeight)
					previewContainer.dialog('option', 'height', 'auto');
				else if (fluidHeight && !fluidWidth)
					previewContainer.dialog('option', 'width', 'auto');
				else if (!fluidWidth && !fluidHeight)
					previewContainer.dialog('option', {'width': 'auto', 'height': 'auto'});
			});


			applySizeButton.click(function(event) {
				event.preventDefault();
				
				// apply the values for the slide width and height
				$('.slider-pro input[name="slider_settings[slide_width]"]').val(slideWidthInput.val());
				$('.slider-pro input[name="slider_settings[slide_height]"]').val(slideHeightInput.val());

				// resize the layers viewport
				$('.slider-pro .viewport').css({width: slideWidthInput.val(), height: slideHeightInput.val()});

				// apply the values in the Width and Height fields
				var sliderWidthField = $('.slider-pro input[name="slider_settings[width]"]'),
					sliderHeightField = $('.slider-pro input[name="slider_settings[height]"]');

				if (sliderWidthField.val().indexOf('%') == -1)
					$('.slider-pro input[name="slider_settings[width]"]').val(sliderWidthInput.val());

				if (sliderHeightField.val().indexOf('%') == -1)
					$('.slider-pro input[name="slider_settings[height]"]').val(sliderHeightInput.val());
			});
			
			
			if (fluidWidth) {
				sliderWidthInput.addClass('disabled')
								.attr('readonly', 'readonly');
				
				slideWidthInput.addClass('disabled')
							   .attr('readonly', 'readonly');
			}
			
			if (fluidHeight) {
				sliderHeightInput.addClass('disabled')
								 .attr('readonly', 'readonly');
				
				slideHeightInput.addClass('disabled')
								.attr('readonly', 'readonly');
			}
			
			
			function sizeLiveUpdate() {		
				var widthDiff = parseInt(sliderWidthInput.val()) - parseInt(slideWidthInput.val()),
					heightDiff = parseInt(sliderHeightInput.val()) - parseInt(slideHeightInput.val());
					
				
				sliderWidthInput.bind('propertychange input keyup paste', function(event) {
					slideWidthInput.val(parseInt($(this).val()) - widthDiff);
				});
				
					
				slideWidthInput.bind('propertychange input keyup paste', function(event) {
					sliderWidthInput.val(parseInt($(this).val()) + widthDiff);
				});
				
				
				sliderHeightInput.bind('propertychange input keyup paste', function(event) {
					slideHeightInput.val(parseInt($(this).val()) - heightDiff);
				});
				
				
				slideHeightInput.bind('propertychange input keyup paste', function(event) {
					sliderHeightInput.val(parseInt($(this).val()) + heightDiff);
				});
			}
			
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, id: id},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					$(data.responseText).appendTo(previewContainer);					
					sliderElement = previewContainer.find('.advanced-slider');
					slider = sliderElement.advancedSlider();					
					
					previewContainer.dialog('option', 'width', width + 80);					
					previewContainer.dialog('option', 'height', height + 170);						
					
					modalWindow.css({'left': ($(window).width() - modalWindow.width()) / 2, 'top': ($(window).height() - modalWindow.height()) / 2});
					
					slider.settings.doSliderLayout = function() {
						$('.slider-pro-preview-dialog #preview-container').css('background-image', 'none');
						
						sliderWidthInput.val(slider.getSize().sliderWidth);
						sliderHeightInput.val(slider.getSize().sliderHeight);
						slideWidthInput.val(slider.getSize().slideWidth);
						slideHeightInput.val(slider.getSize().slideHeight);
						
						sizeLiveUpdate();
					};
					
					slider.doSliderLayout();
				}
			});
			
		});
		
		
		
		// delete the slider
		$('.slider-pro .delete-slider').click(function(event) {
			event.preventDefault();
			
			var link = $(this),
				dialogBox = $('<div><div class="warning-dialog-icon"></div><p>' + sp_js_vars.delete_slider + '</p></div>'),
				buttons = {};
			
			buttons[sp_js_vars.yes] = function() { $(this).remove(); window.location = $(link).prop('href'); };
			buttons[sp_js_vars.cancel] = function() { $(this).remove(); };
			
			dialogBox.dialog({
				resizable: false,
				modal: true,
				width: 270,
				buttons: buttons
			});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-warning-dialog');
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});
		
		
		// import a slider
		$('.slider-pro #import-slider').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action');
				
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action},
				complete: function(data) {
					ajaxRequestInProgress = false;
					
					var importContainer = $('<div id="import-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(importContainer);
					
					importContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						height: 100,
						title: sp_js_vars.import_slider,
						close: function() {
							importContainer.remove();
						}});
					
					$('.ui-dialog').addClass('slider-pro-import-dialog');
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
				}
			});
		});
		
		
		// replicate skin
		$('.slider-pro #replicate-skin').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				skin = url.param('skin');
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, skin: skin},
				complete: function(data) {
					ajaxRequestInProgress = false;
					
					var replicateSkinContainer = $('<div id="replicate-skin-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(replicateSkinContainer);
					
					replicateSkinContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						height: 'auto',
						title: sp_js_vars.replicate_skin,
						close: function() {
							replicateSkinContainer.remove();
					}});
					
					
					replicateSkinContainer.find('input[type="text"]').each(function() {
						var field = $(this),
							fieldText = $(this).val();
							
						field.blur();
						
						field.focusin(function() {
							if ($(this).val() == fieldText)
								$(this).val('');
						});
						
						field.focusout(function() {
							if ($(this).val() == '')
								$(this).val(fieldText);
						});
					});
					
					
					$('.ui-dialog').addClass('slider-pro-replicate-skin-dialog');
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
				}
			});
		});
		
		
		// refresh all skins
		$('.slider-pro #refresh-all-skins').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			showAjaxPreloader();
			
			var url = $.url($(this).prop('href')),
				action = url.param('action');
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action},
				complete: function(data) {
					ajaxRequestInProgress = false;
					
					window.location = data.responseText;
				}
			});
		});
		
		
		// create window for custom JS/CSS code edit
		$('.slider-pro #edit-custom-js, .slider-pro #edit-custom-css').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			showAjaxPreloader();
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				id = url.param('id'),
				type = $(this).attr('id'),
				title = type == 'edit-custom-js' ? sp_js_vars.custom_js_title : sp_js_vars.custom_css_title;
				
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, type: type, id: id},
				complete: function(data) {
					ajaxRequestInProgress = false;
					hideAjaxPreloader();
					
					var editorContainer = $('<div id="editor-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(editorContainer);
					
					var editorTextarea = editorContainer.find('.custom-js-css-content');
					editorTextarea.css('height', $(window).height() - 300);					
					
					editorContainer.dialog({
						resizable: true,
						modal: true,
						width: 700,
						height: 'auto',
						title: title,
						close: function() {
							editorContainer.remove();
						}
					});
					
					
					$('.ui-dialog').addClass('slider-pro-custom-js-css-dialog');
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
					
					
					// save the edits using AJAX
					editorContainer.find('.save-button').click(function(event) {
						event.preventDefault();
						
						if (ajaxRequestInProgress)
							return;
						
						ajaxRequestInProgress = true;
						
						var saveButton = $(this);
							url = $.url(saveButton.prop('href')),
							action = url.param('action'),
							id = url.param('id'),
							type = url.param('type'),
							nonce = url.param('_wpnonce'),
							contentArea = editorContainer.find('.custom-js-css-content'),
							content = contentArea.val();
						
						saveButton.text('Saving...');
						contentArea.attr('disabled', 'disabled');
						
						$.ajax({
							url: sp_js_vars.ajaxurl,
							type: 'post',
							data: {action: action, type: type, id: id, content: content, _wpnonce: nonce},
							complete: function(data) {
								ajaxRequestInProgress = false;
								
								saveButton.text('Save');
								contentArea.removeAttr('disabled');
							}
						});
						
					});
					
				}
			});
		});
		
		
		$('.slider-pro .xml-not-available').click(function(event) {
			event.preventDefault();
			
			var dialogBox = $('<div><span class="warning-dialog-icon"></span><p>' + sp_js_vars.xml_not_available + '</p></div>'),
				buttons = {};
				
			buttons[sp_js_vars.cancel] = function() {
				dialogBox.remove();
			};
			
			dialogBox.dialog({
						resizable:false,
						modal:true,
						width:270,
						buttons: buttons});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-warning-dialog');
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});
		
		$('.slider-pro .inner-sidebar .handlediv').each(function() {
			addPanelSliding($(this));
		});
		
		
		$('.slider-pro .inner-sidebar .postbox').each(function() {
			setPanelState($(this));
		});
		
		
		$('.slider-pro .inner-sidebar .sp-color-picker').each(function(){
			addColorPicker($(this));
		});
		
		
		$('.slider-pro .inner-sidebar label').each(function(){
			addHelpTooltip($(this));
		});
		
	});
	
	
	
	function prepareSlide(slide) {
		
		// set the panel to opened or closed
		setPanelState(slide);
		
		// create the tabs
		slide.find('.slide-tabs').tabs({
			select: function(event, ui) {
				slide.find('.selected-tab').val(ui.index);
			},
			
			create: function() {
				$(this).tabs('select', parseInt(slide.find('.selected-tab').val()));
			}
		});
		
		// add the option to hide the panel
		addPanelSliding(slide.find('.handlediv'));
		
		// open the large image when the preview box is clicked
		slide.find('.preview-box .image').each(function() {
			addImagePreviewBox($(this));
		});
		
		
		// create a new slide segment
		var slideSymbol = $('<div class="slide-symbol"></div>').appendTo(slidesOrderContainer);
		$('<p>' + slide.find('.name').val() + '</p>').appendTo(slideSymbol);
		slideSymbol.data('counter', slide.find('.counter').val());
		
		
		// make it possible to change the name of the slide on double click on the panel's handler
		slide.find('.hndle').dblclick(function() {
			var handle = $(this);
			
			if (!handle.data('isEditing')) {
				handle.data('isEditing', true);
				
				var currentTitle = $(this).html();
				
				$(this).html('|');
				
				var	input = $('<input/>')
					.addClass('title-input')
					.attr('type', 'text')
					.val(currentTitle)
					.click(function(event) {
						event.stopPropagation();
					})
					.keypress(function(event) {
						if (event.which == 13) {
							handle.data('isEditing', false);
							var editedTitle = $(this).val();
							$(this).remove();
							handle.html(editedTitle);
																		
							var nameField = handle.parent().find('.name');
							nameField.val(editedTitle);
																		
							slideSymbol.find('p').html(editedTitle);
						}
					})
					.appendTo(handle);
			}
		});
		
		
		slide.find('.hndle').click(function() {
			if ($(this).data('isEditing')) {
				$(this).data('isEditing', false);
				
				var input = $(this).parent().find('.title-input'),
					editedTitle = input.val();
					
				input.remove();
				$(this).html(editedTitle);
				
				var nameField = $(this).parent().find('.name');
				nameField.val(editedTitle);
				
				slideSymbol.find('p').html(editedTitle);
			}
		});
		
		
		// delete the slide panel
		slide.find('.closediv').click(function() {
			var slidebox = $(this).parent(),
				dialogBox = $('<div><span class="warning-dialog-icon"></span><p>' + sp_js_vars.delete_slide + '</p></div>'),
				slideboxes = slidebox.parent(),
				buttons = {};
			
			buttons[sp_js_vars.yes] = function() {
				dialogBox.remove();
				
				slidebox.animate({'opacity': 0}, function() {
					$(this).slideUp(200, function() {
						$(this).remove();
						slideboxes.find('.slidebox').each(function(index){
							$(this).find('.position').val(index + 1);
						});
					})
				});
				
				slidesOrderContainer.find('.slide-symbol').each(function(){
					if($(this).data('counter') == slide.find('.counter').val()) {
						$(this).remove();		
					}
				});
			}
										
			buttons[sp_js_vars.cancel] = function() {
				dialogBox.remove();
			};
			
			dialogBox.dialog({
						resizable:false,
						modal:true,
						width:270,
						buttons: buttons});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-warning-dialog');
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});
		
		
		// duplicate the slide
		slide.find('.duplicatediv').click(function() {
			if (ajaxRequestInProgress)
				return;
				
			ajaxRequestInProgress = true;
				
			var action = 'sliderpro_duplicate_slide',
				id = parseInt(slide.find('.id').val()),
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0;
			
			// find the index of the new panel
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));
			});
			
			counter++;
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, counter: counter, id: id},
				complete: function(data) {
					var slide = $(data.responseText).appendTo($('.slideboxes'));
					slide.find('.position').val(position);
					prepareSlide(slide);
					ajaxRequestInProgress = false;
					slide.hide().fadeIn();
				}
			});
		});
		
		
		// enable/disable the slide
		slide.find('.visibilitydiv').click(function() {
			var isEnabled = $(this).hasClass('enableddiv');
			
			if (isEnabled) {
				$(this).removeClass('enableddiv')
						.addClass('disableddiv')
						.attr('title', 'Enable the slide');

				slide.find('.visibility').val('disabled');
			} else {
				$(this).removeClass('disableddiv')
						.addClass('enableddiv')
						.attr('title', 'Disable the slide');

				slide.find('.visibility').val('enabled');
			}
		});
		
		
		// mark/unmark the slide
		slide.find('.selectiondiv').click(function() {
			var isMarked = $(this).hasClass('markeddiv');
			
			if (isMarked) {
				$(this).removeClass('markeddiv')
						.addClass('unmarkeddiv')
						.attr('title', 'Mark the slide');
				
				if (slide.hasClass('marked'))
					slide.removeClass('marked');
					
				slide.addClass('unmarked');
			} else {
				$(this).removeClass('unmarkeddiv')
						.addClass('markeddiv')
						.attr('title', 'Unmark the slide');
				
				if (slide.hasClass('unmarked'))
					slide.removeClass('unmarked');

				slide.addClass('marked');
			}
		});
		
		
		// show the preview image
		slide.find('a.preview-button').click(function(event) {
			event.preventDefault();
			
			var imagePath = $(this).parents('.info-input').find('.path').val();
			
			if (imagePath.indexOf('[') != -1)
				return;
			
			var	box = $(this).parents('.info-input').siblings('.preview-box'),
				w = parseInt(box.css('width')),
				h = parseInt(box.css('height'));
				
				
			var fullPath = sp_js_vars.enable_timthumb == true ? (sp_js_vars.timthumb + '?src=' + imagePath + '&w=' + w + '&h=' + h + '&q=95') : imagePath;
			
			box.find('.image').remove();
			
			if (box.hasClass('no-image'))
				box.removeClass('no-image');
				
			if (box.hasClass('image-not-found'))
				box.removeClass('image-not-found');
				
			box.addClass('image-preload')
			   .one('click', function() {
					if ($(this).hasClass('image-not-found'))
						window.open(sp_js_vars.admin_url + 'admin.php?page=slider_pro_help#troubleshooting2', '_blank');
			   });
										
			$('<img class="image"/>').load(function() {
										box.removeClass('image-preload');
										$(this).hide().fadeIn().appendTo(box);
										
										addImagePreviewBox($(this));

										if (box.hasClass('main-image'))
											addViewportImage(slide.find('.viewport'), imagePath);
									 })
									 .error(function() {
										box.removeClass('image-preload')
										   .addClass('image-not-found');
									 })
									 .attr('src', fullPath);
		});
		
		
		// open the lightbox for inserting image(s)
		slide.find('a.open-media-loader').click(function(event) {
			event.preventDefault();
			
			var button = $(this);

			if (sp_js_vars.custom_media_loader || !sp_js_vars.is_new_media_loader) {

				openMediaLoader(button);

			} else {
				// compatibility with nextgen
				window.send_to_editor = function(html) {
					if (html != '') {
					    var imageUrl = $('img', html).attr('src');

					    // add the image url into the 'Path' field
						button.parents('.info-input').find('.path').val(imageUrl);			
				
						// trigger the click event in order to display the iamge
						button.siblings('a.preview-button').trigger('click');
					}
				};

				// check if wordpress includes the new media loader script
				if (typeof wp != 'undefined' && wp.media && wp.media.editor) {
					wp.media.editor.send.attachment = function(props, attachment) {
						// add the image url into the 'Path' field
						button.parents('.info-input').find('.path').val(attachment.url);			
				
						// trigger the click event in order to display the iamge
						button.siblings('a.preview-button').trigger('click');
					}

					wp.media.editor.open('media-loader');
				}
			}
		});
		
		
		// create the Layers editor
		slide.find('.layer-editor').each(function(event) {
			var editor = $(this),
				viewport = editor.find('.viewport'),
				button = editor.find('a.add-new-layer'),
				slideCounter = slide.find('.counter').val(),
				layersNum = viewport.find('.layers-num'),
				layersIds = viewport.find('.layers-ids');


			viewport.css({'width': $('.slider-pro input[name="slider_settings[slide_width]"]').val(),
						  'height': $('.slider-pro input[name="slider_settings[slide_height]"]').val()})
					.click(function(event) {
						if ($(event.target).is('.viewport')) {
							selectedTextarea = null;
							viewport.siblings('.insert-video').multiselect("disable");

							viewport.find('.textarea-focus').each(function() {
						 		var textarea = $(this),
						 			textareaValue = textarea.val();

						 		if (textareaValue.indexOf('[slider_pro_video') != -1)
						 			textareaValue = renderVideoShortcode(textareaValue);

						 		textarea.siblings('.layer-content').html(textareaValue);

								textarea.css('display', 'none')
										.removeClass('textarea-focus');
						 	});
						}
					});


			var imagePath = slide.find('.path').first().val();

			if (imagePath)
				addViewportImage(viewport, imagePath);

			
			editor.find('.layer-item').each(function() {
				createLayerItem(viewport, slideCounter, parseInt($(this).data('id')), $(this));
			});
			
			
			var layerCounter = parseInt(layersNum.val());
			
			
			button.click(function(event) {
				event.preventDefault();
				
				layerCounter++
				
				createLayerItem(viewport, slideCounter, layerCounter);
				
				if (layersIds.val() == '')
					layersIds.val('+')
				
				layersIds.val(layersIds.val() + layerCounter + '+');
				layersNum.val(layerCounter);
			});
			
		});


		// setup the video select dropdown
		slide.find('.insert-video').each(function(event) {
			var insertVideo = $(this);
			
			insertVideo.multiselect({
							noneSelectedText: 'Insert video',
							selectedText: 'Insert video',
							header: false,
							multiple: false,
							minWidth: 180,
							click: function(event, ui) {
								var videoMarkup = '';

								switch (ui.value) {
									case 'youtube':
										videoMarkup += ' [slider_pro_video type="youtube" id=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'youtube-lazy-load':
										videoMarkup += ' [slider_pro_video type="youtube" mode="lazy-load" id="" poster=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'vimeo':
										videoMarkup += ' [slider_pro_video type="vimeo" id=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'vimeo-lazy-load':
										videoMarkup += ' [slider_pro_video type="vimeo" mode="lazy-load" id="" poster=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'html5':
										videoMarkup += ' [slider_pro_video type="html5" poster="" source1="" source2=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'videojs':
										videoMarkup += ' [slider_pro_video type="video-js" poster="" source1="" source2=""] ';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;

									case 'jwplayer':
										videoMarkup += '[slider_pro_video type="jw-player" image="" source1="" source2=""]';
										selectedTextarea.insertAtCaret(videoMarkup);
									break;
								}
							}
						});

			insertVideo.multiselect("disable");
		});
		
		
		// create the tinyMCE editor
		if (sp_js_vars.rich_editing) {
			slide.find('.sp-editor').each(function() {
				$(this).tinymce({
					script_url : sp_js_vars.url + '/slider-pro/js/tinymce/tiny_mce.js',
					theme : "advanced",
					skin: "wp_theme", 
					width: "100%", 
					theme_advanced_toolbar_location: "top",
					theme_advanced_toolbar_align: "left",
					theme_advanced_statusbar_location: "bottom",
					theme_advanced_resizing: true,
					theme_advanced_resize_horizontal: false,
					plugins: "inlinepopups,spellchecker,paste,wordpress,fullscreen,wpeditimage,wpgallery,tabfocus,sliderprovideo",
					dialog_type: "modal",
					theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,bullist,numlist,blockquote,|,removeformat,|,link,unlink,|,image,charmap,|,undo,redo,|,sliderprovideo,|,wp_adv,code",
					theme_advanced_buttons2: "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,pastetext,pasteword,outdent,indent",
					theme_advanced_buttons3: "",
					valid_elements: "*[*]",
					apply_source_formatting: true,					
					verify_html: false,
					cleanup: false,
					entity_encoding: "raw",
					convert_urls: false,
					relative_urls: false,
					remove_script_host: false,
					forced_root_block: false,
					force_p_newlines: false,
					force_br_newlines: true
				});
			});
		}
		
		
		// when a label is clicked make it bold
		// a bold label will indicate that the slide setting will override the global setting
		slide.find('.slide-tabs-settings label').each(function() {
			var label = $(this),
				override = label.find('.override'),
				currentValue = parseInt(override.val());
			
			if (currentValue == 1)
				label.addClass('override-label');
			
			label.click(function(event) {
				event.preventDefault();
				
				currentValue = parseInt(override.val());
				
				if (currentValue == 0) {
					override.val(1);
					label.addClass('override-label');
				} else {
					override.val(0);
					label.removeClass('override-label');
				}
			});
		});
		
		
		slide.find('select.settings-multiselect').each(function() {
			var selectBox = $(this);
			
			selectBox.multiselect({
					  	noneSelectedText: 'Select individual options to customize',
						selectedText: 'Select individual options to customize',
						header: 'Select individual options to customize',
						classes: 'slider-pro slide-settings',
						minWidth: 320
					 })
					 .multiselectfilter();
		});
		
		
		slide.find('.display-selected-settings').each(function(){
			addSettingRefresh($(this));
		});
		
		
		// add the help functionality
		slide.find('label').each(function(){
			addHelpTooltip($(this));
		});
		
		
		// add the color picker functionality
		slide.find('.sp-color-picker').each(function(){
			addColorPicker($(this));
		});
		
		
		slide.find('.posts-data-fields').each(function(){
			setPostsDataSelectors($(this));
		});
		
		
		slide.find('.slide-type').change(function(event){
			if (ajaxRequestInProgress) {
				event.preventDefault();
				return;
			}
			
			
			var selectedSlideType = $(this).val(),
				counter = slide.find('.counter').val(),
				dynamicControlFieldsContainer = slide.find('.dynamic-control-fields-container'),
				loadingIndicator = slide.find('p.loading-controls-indicator'),
				dynamicFields = dynamicControlFieldsContainer.find('.dynamic-fields');
								
				
			if (selectedSlideType != 'static') {
				ajaxRequestInProgress = true;
				loadingIndicator.removeClass('hide').addClass('show');
				
				if (dynamicFields.length)
					dynamicFields.remove();
					
				$.ajax({
					url: sp_js_vars.ajaxurl,
					type: 'get',
					data: {action: 'sliderpro_add_dynamic_fields', counter: counter, slide_type: selectedSlideType},
					complete: function(data) {
						loadingIndicator.removeClass('show').addClass('hide');
											
						$(data.responseText).appendTo(dynamicControlFieldsContainer);
						dynamicFields = dynamicControlFieldsContainer.find('.dynamic-fields');
						
						if (selectedSlideType == 'posts')
							setPostsDataSelectors(dynamicFields);
						
						dynamicFields.find('label').each(function() {
							addHelpTooltip($(this));
						});
						
						ajaxRequestInProgress = false;
					}
				});
			} else if (dynamicFields.length) {
				dynamicFields.remove();
			}
		});
	}


	function addViewportImage(viewport, imagePath) {
		var backgroundSize = 'auto',
			backgroundPosition = 'center';

		// select the size of the background
		if (selectedScaleType == 'exactFit' || selectedScaleType == 'proportionalFit')
			backgroundSize = '100% 100%';
		else if (selectedScaleType == 'outsideFit')
			backgroundSize = 'cover';
		else if (selectedScaleType == 'insideFit')
			backgroundSize = 'contain';


		// get the selected value for the Align Type option
		var individualAlignType = viewport.parents('.slidebox').find('[name*="align_type"]'),
			alignTypeValue = individualAlignType.length ? individualAlignType.val() : selectedAlignType;

		
		// select the alignment of the background
		if (alignTypeValue == 'leftTop')
			backgroundPosition = 'left top';
		else if (alignTypeValue == 'leftCenter')
			backgroundPosition = 'left center';
		else if (alignTypeValue == 'leftBottom')
			backgroundPosition = 'left bottom';
		else if (alignTypeValue == 'centerTop')
			backgroundPosition = 'center top';
		else if (alignTypeValue == 'centerCenter')
			backgroundPosition = 'center center';
		else if (alignTypeValue == 'centerBottom')
			backgroundPosition = 'center bottom';
		else if (alignTypeValue == 'rightTop')
			backgroundPosition = 'right top';
		else if (alignTypeValue == 'rightCenter')
			backgroundPosition = 'right center';
		else if (alignTypeValue == 'rightBottom')
			backgroundPosition = 'right bottom';


		viewport.css({'background-image': 'url(' + imagePath + ')', 
					  'background-repeat': 'no-repeat',
					  'background-position': backgroundPosition,
					  'background-size': backgroundSize});
	}
	
	
	function createLayerItem(viewport, slideCounter, layerCounter, layerItemRaw) {
		var layerItem,
			layerContent,
			layerTextarea,
			layerSettings,
			layerSettingsContainer;
			
		if (layerItemRaw) {
			layerItem = layerItemRaw;
			
			layerContent = layerItem.find('.layer-content');
			
			layerTextarea = layerItem.find('.layer-textarea');
			
			layerSettings = layerItem.find('.layer-settings');
			

			// check if there is a video shortcode inside the text area and display the video container around it
			var textareaValue = layerTextarea.val();

	 		if (textareaValue.indexOf('[slider_pro_video') != -1)
				textareaValue = renderVideoShortcode(textareaValue);

	 		layerContent.html(textareaValue);


			var layerSettingsArray = layerSettings.val().split('+'),
				layerSettingsObject = {'layer_width': 'auto', 
									   'layer_height': 'auto', 
									   'layer_position': 'topLeft', 
									   'layer_horizontal': '50', 
									   'layer_vertical': '50',
									   'layer_classes': '',
									   'layer_depth': ''};

			if (layerSettingsArray.length > 1) {
				$.each(layerSettingsArray, function(index, value) {
					var layerSettingArray = value.split('=');

					layerSettingsObject[layerSettingArray[0]] = layerSettingArray[1];

					if (layerSettingArray[0] == 'layer_preset_styles' || layerSettingArray[0] == 'layer_custom_class')
						layerSettingsObject['layer_classes'] += ' ' + layerSettingArray[1];
				});
			}
			
			if (!jQuery.isEmptyObject(layerSettingsObject)) {
				renderLayerStyle(layerItem, 
								 layerSettingsObject['layer_width'], 
								 layerSettingsObject['layer_height'], 
								 layerSettingsObject['layer_position'], 
								 layerSettingsObject['layer_horizontal'], 
								 layerSettingsObject['layer_vertical'],
								 layerSettingsObject['layer_classes'],
								 layerSettingsObject['layer_depth']);
			}

		} else {
			layerItem = $('<div></div>').addClass('layer-item')
										.attr('data-id', layerCounter)
										.appendTo(viewport);
			
			layerContent = $('<div></div>').addClass('layer-content black')
										   .html('Double-click to edit content...')
										   .appendTo(layerItem);
			
			layerTextarea = $('<textarea></textarea>').addClass('layer-textarea')
													  .attr('name', 'slide[' + slideCounter + '][content][layer_' + layerCounter + '_content]')
													  .html('Double-click to edit content...')
													  .appendTo(layerItem);

			layerSettings = $('<input/>').addClass('layer-settings')
										 .attr('type', 'hidden')
										 .attr('name', 'slide[' + slideCounter + '][settings][layer_' + layerCounter + '_settings]')
										 .attr('value', 'layer_position=topLeft+layer_horizontal=50+layer_vertical=50+layer_preset_styles=black')
										 .appendTo(layerItem);
		}
		
		
		var layerControls = $('<div class="layer-controls"></div>').insertAfter(layerContent),
			layerEditContent = $('<div class="layer-edit-content"></div>').appendTo(layerControls),
			layerEditSettings = $('<div class="layer-edit-settings"></div>').appendTo(layerControls),
			layerDelete = $('<div class="layer-delete"></div>').appendTo(layerControls);


		// disable clicks on layer's content. This prevents opening links that were added to layers
		layerContent.click(function(event) {
			event.preventDefault();
		})


		layerItem.draggable({
				 	stop: function() {
				 		var layerSettingsArray = layerSettings.val().split('+'),
				 			layerSettingsString = '',
				 			position;


						if (layerSettingsArray.length > 1) {
							$.each(layerSettingsArray, function(index, value) {
								if (value.indexOf('layer_horizontal') == -1 && value.indexOf('layer_vertical') == -1)
									layerSettingsString += value + '+';

								if (value.indexOf('layer_position') != -1)
									position = value.toLowerCase();
							});
						}


						var horizontalPosition = position.indexOf('right') != -1 ? 'right' : 'left',
							verticalPosition = position.indexOf('bottom') != -1 ? 'bottom' : 'top',
							horizontalPositionValue = parseInt(layerItem.css(horizontalPosition)) + parseInt(layerItem.css('margin-' + horizontalPosition)),
							verticalPositionValue = parseInt(layerItem.css(verticalPosition)) + parseInt(layerItem.css('margin-' + verticalPosition));


						layerItem.css(horizontalPosition, horizontalPositionValue);
						layerItem.css(verticalPosition, verticalPositionValue);
						layerItem.css({'marginTop': 0, 'marginBottom': 0, 'marginLeft': 0, 'marginRight': 0});

						layerSettingsString += 'layer_horizontal=' + horizontalPositionValue + '+layer_vertical=' + verticalPositionValue;

						layerSettings.val(layerSettingsString);

						if (layerSettingsContainer) {
							layerSettingsContainer.find('[name="layer_horizontal"]').val(horizontalPositionValue);
							layerSettingsContainer.find('[name="layer_vertical"]').val(verticalPositionValue);
						}
				 	}})
				 .mousedown(function() {
					 layerItem.css('z-index', parseInt(layerItem.css('z-index')) + 1000);
				 })
				 .dblclick(function() {
				 	viewport.find('.textarea-focus').each(function() {
				 		var textarea = $(this),
							textareaValue = textarea.val();
							
						if (textareaValue.indexOf('[slider_pro_video') != -1)
						 	textareaValue = renderVideoShortcode(textareaValue);
									
				 		textarea.siblings('.layer-content').html(textareaValue);

						textarea.css('display', 'none')
								.removeClass('textarea-focus');
				 	})

					layerTextarea.addClass('textarea-focus')
								 .css('display', 'block')
								 .focus();

					selectedTextarea = layerTextarea;

					viewport.siblings('.insert-video').multiselect("enable");
				 });


		layerEditContent.click(function() {
			layerTextarea.addClass('textarea-focus')
						 .css('display', 'block')
						 .focus();

			selectedTextarea = layerTextarea;

			viewport.siblings('.insert-video').multiselect("enable");
		});
		
		
		layerEditSettings.click(function() {
			if (ajaxRequestInProgress)
				return;				
			
			ajaxRequestInProgress = true;
			
			layerSettingsContainer = $('<div class="layer-settings-container"></div>').appendTo($('body'));

			layerSettingsContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						title: sp_js_vars.layer_settings,
						close: function() {
							layerSettingsContainer.remove();
							layerSettingsContainer = null;
						}
			});
			

			var dialog = $('.ui-dialog').addClass('slider-pro-layer-settings-dialog');
			$('.ui-widget-overlay').remove();
			
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: 'sliderpro_layer_settings', slide_counter: slideCounter, layer_counter: layerCounter, layer_settings: layerSettings.val()},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					layerSettingsContainer.css('background-image', 'none')
										  .append($(data.responseText));
					
					dialog.css('left', ($(document).width() - layerSettingsContainer.outerWidth(true)) / 2);


					layerSettingsContainer.find('[name="layer_preset_styles"]').multiselect({
						selectedList: 4,
						header: false,
						minWidth: 120,
						noneSelectedText: 'Select preset styles',
						classes: 'slider-pro preset-styles'
					});


					layerSettingsContainer.find('label').each(function() {
						addHelpTooltip($(this));
					});


					layerSettingsContainer.find('.apply-settings').click(function(event) {
						event.preventDefault();
						
						var layerSettingsString = '',
							layerClasses = '';
						
						layerSettingsContainer.find('.layer-setting-field').each(function() {
							var settingField = $(this);

							if (settingField.val()) {
								if (layerSettingsString != '')
									layerSettingsString += '+';
								
								layerSettingsString += settingField.attr('name') + '=' + settingField.val();

								if (settingField.attr('name') == 'layer_preset_styles' || settingField.attr('name') == 'layer_custom_class')
									layerClasses += ' ' + settingField.val();
							}
						});

						layerSettings.val(layerSettingsString);


						var layerPosition = layerSettingsContainer.find('[name="layer_position"]').val(),
							layerHorizontal = layerSettingsContainer.find('[name="layer_horizontal"]').val(),
							layerVertical = layerSettingsContainer.find('[name="layer_vertical"]').val(),
							layerWidth = layerSettingsContainer.find('[name="layer_width"]').val(),
							layerHeight = layerSettingsContainer.find('[name="layer_height"]').val(),
							layerDepth = layerSettingsContainer.find('[name="layer_depth"]').val();
						

						renderLayerStyle(layerItem, layerWidth, layerHeight, layerPosition, layerHorizontal, layerVertical, layerClasses, layerDepth);
					});


					layerSettingsContainer.find('.ok-settings').click(function(event) {
						event.preventDefault();

						layerSettingsContainer.find('.apply-settings').trigger('click');
						layerSettingsContainer.dialog('close');
					});
				}
			});
		});
		
		
		layerDelete.click(function() {			
			var dialogBox = $('<div><div class="warning-dialog-icon"></div><p>' + sp_js_vars.delete_layer + '</p></div>'),
				buttons = {};
			
			buttons[sp_js_vars.yes] = function() { 
				var id = layerItem.data('id'),
				ids = viewport.find('.layers-ids').val();
			
				viewport.find('.layers-ids').val(ids.replace('+' + id + '+', '+'));
			
				layerItem.remove();

				$(this).remove();
			};
			
			buttons[sp_js_vars.cancel] = function() { $(this).remove(); };
			
			dialogBox.dialog({
				resizable: false,
				modal: true,
				width: 270,
				buttons: buttons
			});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-warning-dialog');
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});
		
	}
	
	
	function renderLayerStyle(layerItem, layerWidth, layerHeight, layerPosition, layerHorizontal, layerVertical, layerClasses, layerDepth) {
		
		var layerContent = layerItem.find('.layer-content');


		if (layerWidth.indexOf('%') == -1 && layerWidth != 'auto')
			layerWidth = parseFloat(layerWidth);
		
		
		if (layerHeight.indexOf('%') == -1 && layerHeight != 'auto')
			layerHeight = parseFloat(layerHeight);


		layerContent.css({'width': '100%', 'height': '100%'})
					.attr('class', 'layer-content' + layerClasses.replace(',', ' '));

		layerItem.css({'width': layerWidth, 'height': layerHeight,
					   'top': 'auto', 'bottom': 'auto', 'left': 'auto', 'right': 'auto', 
					   'marginTop': 0, 'marginBottom': 0, 'marginLeft': 0, 'marginRight': 0});

		if (layerDepth != '')
			layerItem.css('z-index', layerDepth);


		var position = layerPosition.toLowerCase(),
			horizontalPosition = position.indexOf('right') != -1 ? 'right' : 'left',
			verticalPosition = position.indexOf('bottom') != -1 ? 'bottom' : 'top';


		// set the horizontal position of the layer based on the data set
		if ((layerHorizontal == 'left' && horizontalPosition == 'left') || (layerHorizontal == 'right' && horizontalPosition == 'right')) {
			layerItem.css(horizontalPosition, 0);
		} else if ((layerHorizontal == 'right' && horizontalPosition == 'left') || (layerHorizontal == 'left' && horizontalPosition == 'right')) {
			layerItem.css('margin-' + horizontalPosition, - layerItem.outerWidth());
			layerItem.css(horizontalPosition, '100%');
		} else if (layerHorizontal == 'center') {
			layerItem.css('margin-' + horizontalPosition, - layerItem.outerWidth() * 0.5);
			layerItem.css(horizontalPosition, '50%');
		} else if (layerHorizontal.indexOf('%') == -1) {
			layerItem.css(horizontalPosition, parseFloat(layerHorizontal));
		} else {
			layerItem.css(horizontalPosition, layerHorizontal);
		}


		// set the vetical position of the layer based on the data set
		if ((layerVertical == 'top' && verticalPosition == 'top') || (layerVertical == 'bottom' && verticalPosition == 'bottom')) {
			layerItem.css(verticalPosition, 0);
		} else if ((layerVertical == 'bottom' && verticalPosition == 'top') || (layerVertical == 'top' && verticalPosition == 'bottom')) {
			layerItem.css('margin-' + verticalPosition, - layerItem.outerHeight());
			layerItem.css(verticalPosition, '100%');
		} else if (layerVertical == 'center') {
			layerItem.css('margin-' + verticalPosition, - layerItem.outerHeight() * 0.5);
			layerItem.css(verticalPosition, '50%');
		} else if (layerVertical.indexOf('%') == -1) {
			layerItem.css(verticalPosition, parseFloat(layerVertical));
		} else {
			layerItem.css(verticalPosition, layerVertical);
		}
	}


	function renderVideoShortcode(textareaValue) {
		var shortcodeStart = textareaValue.indexOf('[slider_pro_video'),
			shortcodeSubstring = textareaValue.substr(shortcodeStart),
			shortcodeEnd = shortcodeSubstring.indexOf(']') + shortcodeStart;

		var finalString = textareaValue.substr(0, shortcodeEnd + 1) + '</div>' + textareaValue.substr(shortcodeEnd + 1)

		var width = '400px',
			height = '300px';

		if (textareaValue.indexOf('width=') != -1) {
			var widthString = textareaValue.substr(textareaValue.indexOf('width=')).split('"')[1];

			if (widthString.indexOf('%') != -1)
				width = widthString;
			else
				width = widthString + 'px';
		}

		if (textareaValue.indexOf('height=') != -1) {
			var heightString = textareaValue.substr(textareaValue.indexOf('height=')).split('"')[1];

			if (heightString.indexOf('%') != -1)
				height = heightString;
			else
				height = heightString + 'px';
		}


		finalString = finalString.substr(0, shortcodeStart) + '<div class="video-shortcode-container" style="width: ' + width + '; height: ' + height + ';">' + finalString.substr(shortcodeStart);

		return finalString;
	}
	
	
	function setPostsDataSelectors(target) {
		var postTypesSelectBox,
			postTaxonomiesSelectBox,
			selectedPostTypes = [],
			selectedTerms = [],
			attachedTaxonomies = [];
		
		
		function refreshAttachedTaxonomies() {
			attachedTaxonomies = [];
			
			// get all taxonomies that need to be loaded based on the currently selected post types
			$.each(selectedPostTypes, function(index, postName) {
				var taxonomies = postsData['post_types'][postName]['post_taxonomies'];
				$.each(taxonomies, function(index, taxonomy) {
					if ($.inArray(taxonomy, attachedTaxonomies) == -1)
						attachedTaxonomies.push(taxonomy);
				});
			});
			
			// clear the selectbox
			postTaxonomiesSelectBox.empty();
			
			// display the taxonomies and terms for the selected post types
			$.each(attachedTaxonomies, function(index, taxonomyName) {
				var taxonomy = postsData['taxonomies'][taxonomyName];
				
				// check if the taxonomy contains terms
				if (!$.isEmptyObject(taxonomy['taxonomy_terms'])) {
					// create the select group
					var	taxonomyGroup = $('<optgroup label="' + taxonomy['taxonomy_label'] + '"></optgroup>').appendTo(postTaxonomiesSelectBox),
						selected;
						
					$.each(taxonomy['taxonomy_terms'], function(index, term) {
						// check if the option should be selected
						selected = $.inArray(term['term_complete'], selectedTerms) != -1 ? ' selected="selected"' : '';
						
						// create the option
						$('<option' + selected + ' value="' + term['term_complete'] + '">' + term['term_name'] + '</option>').appendTo(taxonomyGroup);
					});
				}
			});
						
			postTaxonomiesSelectBox.multiselect('refresh');
		}
		
		
		target.find('select.post-types-multiselect').each(function() {
			postTypesSelectBox = $(this);
			
			// get the initial post types
			if (postTypesSelectBox.val())
				selectedPostTypes = postTypesSelectBox.val();
				
			postTypesSelectBox.multiselect({
									header: 'Post Types',
									noneSelectedText: 'Post Types',
									classes: 'slider-pro post-types',
									height: 'auto',
									minWidth: 156,
									selectedList: 2,
									click: function(event, ui) {
										var index = $.inArray(ui.value, selectedPostTypes);
										
										if (ui.checked && index == -1)
											selectedPostTypes.push(ui.value);
										else if (!ui.checked && index != -1)
											selectedPostTypes.splice(index, 1);
										
										// get the new taxonomies for the selected posts	
										refreshAttachedTaxonomies();
									}
							  })
							  .multiselectfilter();
		});
		
		
		target.find('select.post-taxonomies-multiselect').each(function() {
			postTaxonomiesSelectBox = $(this);
			
			// get the initial taxonomy terms
			if (postTaxonomiesSelectBox.val())
				selectedTerms = postTaxonomiesSelectBox.val();
				
			postTaxonomiesSelectBox.multiselect({
										header: 'Post Taxonomies',
										noneSelectedText: 'Post Taxonomies',
										classes: 'slider-pro post-taxonomies',
										minWidth: 200,
										selectedList: 2,
										click: function(event, ui) {
											var index = $.inArray(ui.value, selectedTerms);
											
											if (ui.checked && index == -1)
												selectedTerms.push(ui.value);
											else if (!ui.checked && index != -1)
												selectedTerms.splice(index, 1);
										}
									})
									.multiselectfilter();
		});
		
		
		target.find('select.relation-multiselect').each(function() {
			$(this).multiselect({
						header: 'Relation',
						classes: 'slider-pro',
						minWidth: 94,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
		
		
		target.find('select.orderby-multiselect').each(function() {
			$(this).multiselect({
						header: 'Order By',
						classes: 'slider-pro',
						minWidth: 100,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
		
		
		target.find('select.order-multiselect').each(function() {
			$(this).multiselect({
						classes: 'slider-pro',
						header: 'Order',
						minWidth: 80,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
	}
	
	
	// close/open the panel
	function setPanelState(target) {
		if (target.find('.panel-state').val() == 'closed')
			target.find('.inside').hide();
	}
	
	
	// make the panel slideabled 
	function addPanelSliding(target) {
		target.click(function() {
			var panel = target.parent(),
				panelsState = panel.find('.panel-state');
					
			if (panelsState.val() == 'closed')
				panelsState.val('opened');
			else
				panelsState.val('closed');
				
			panel.find('.inside').slideToggle();
		});
	}
	
	
	function addSettingRefresh(target) {
		target.click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			
			var target = $(this),
				url = $.url($(this).prop('href')),
				action = url.param('action'),
				counter = url.param('counter'),
				selectBox = target.siblings('select.settings-multiselect'),
				selectedSettings = selectBox.val(),
				selectedSettingsRef = [],
				settingsContainer = target.parents('.postbox').find('.settings-container');
				
			if (selectedSettings) {
				selectedSettingsRef = selectedSettings.slice(0);
				
				$.each(selectedSettingsRef, function(index, value) {
					if (settingsContainer.find('#' + value).length ) {
						var idx = $.inArray(value, selectedSettings);
						selectedSettings.splice(idx, 1);
					}
				});
				
				settingsContainer.find('.setting-field').each(function() {
					if ($.inArray($(this).attr('id'), selectedSettingsRef) == -1)
						$(this).remove();
				});
				
				if (!selectedSettings.length) {
					ajaxRequestInProgress = false;
					return;
				}
			} else {
				settingsContainer.empty();
				ajaxRequestInProgress = false;
				return;
			}
			
			
			var data = {action: action, settings: selectedSettings.join('|')};
			
			if (counter)
				data['counter'] = counter;
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: data,
				complete: function(data) {			
					var newFields = $(data.responseText).appendTo(settingsContainer);
					
					newFields.find('.sp-color-picker').each(function() {
						addColorPicker($(this));
					});
					
					newFields.find('label').each(function() {
						addHelpTooltip($(this));
					});
					
					ajaxRequestInProgress = false;
				}
			});
		});
	}
	
	
	// open the image
	function addImagePreviewBox(target) {
		var url = $.url(target.prop('src')),
			imagePath = url.param('src') || target.attr('src');
			
		target.css('cursor', 'pointer')
			  .click(function() {
				  	showAjaxPreloader();
					
					$('<img/>').load(function() {
						var dialog = $(this).dialog({
							resizable: false,
							modal: true,
							width: 'auto',
							create: function() {
								hideAjaxPreloader();
							}
						});
						
						$('.ui-dialog').addClass('slider-pro-image-dialog');														
						$('.ui-dialog-titlebar').remove();
						$('.ui-dialog-content').css({'padding': 0});
						$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
											   .click(function() {
													dialog.dialog('close');
												});
						
						dialog.click(function() {
							dialog.remove();
						});
					})
			.attr('src', imagePath);
		});
	}
	
	
	// open the media loader
	function openMediaLoader(target) {
		if (ajaxRequestInProgress)
			return;
		
		ajaxRequestInProgress = true;
		
		showAjaxPreloader();
		
		var url = $.url(target.prop('href')),
			action = url.param('action'),
			showPage = url.param('show_page'),
			showDate = url.param('show_date'),
			allow = url.param('allow'),
			containerHeight = $(window).height() - 200;
			
		mediaLoaderImagesHeight = containerHeight - 150;
		
		mediaLoaderClickedButton = target;
		
		selectedImages = [];
		
		$.ajax({
			url: sp_js_vars.ajaxurl,
			type: 'get',
			dataType:'html',
			data: {action: action, images_total_height: mediaLoaderImagesHeight, show_page: showPage, show_date: showDate, allow: allow},
			complete: function(data) {						
				ajaxRequestInProgress = false;
					
				mediaContainer = $('<div id="media-container"></div>');
				$(data.responseText).appendTo(mediaContainer);
				
				mediaContainer.dialog({
					resizable: false,
					modal: true,
					width: 'auto',
					height: containerHeight,
					title: sp_js_vars.media_loader,
					create: function() {
						hideAjaxPreloader();
					},
					close:function() {
						mediaContainer.dialog('destroy');
						mediaContainer.remove();
					}
				});
					
				mediaLoaderProcessContent(allow);				
				
				$('.ui-dialog').addClass('slider-pro-media-dialog');
				
				$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
									   .click(function() {
											mediaContainer.dialog('destroy');
											mediaContainer.remove();
										});
			}
		});
	}
	
	
	function mediaLoaderProcessContent(allow) {
		mediaContainer.find('#show-interval').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				showPage = mediaContainer.find('#selection-categories #page-select').val(),
				showDate = mediaContainer.find('#selection-categories #date-select').val(),
				showKeyword = mediaContainer.find('#selection-categories #keyword').val();
				
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, images_total_height: mediaLoaderImagesHeight, show_page: showPage, show_date: showDate, show_keyword: showKeyword, allow: allow},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					// reload the conent	
					mediaContainer.empty();
					$(data.responseText).appendTo(mediaContainer);
					
					mediaLoaderProcessContent(allow);
				}
			});
		});
		
		
		mediaContainer.find('a.insert-image').click(function(event) {
			event.preventDefault();
			
			// add the image url into the 'Path' field
			mediaLoaderClickedButton.parents('.info-input').find('.path').val($(this).prop('href'));			
			
			// trigger the click event in order to display the iamge
			mediaLoaderClickedButton.siblings('a.preview-button').trigger('click');			
			
			// remove the lightbox
			mediaContainer.dialog('destroy');
			mediaContainer.remove();
		});
		
		
		mediaContainer.find('.thumb-image').hover(
			function() {
				var imagePath = sp_js_vars.enable_timthumb == true ? ($(this).attr('src')).split('src=')[1] : $(this).attr('src'),
					fullPath = sp_js_vars.enable_timthumb == true ? (sp_js_vars.timthumb + '?src=' + imagePath + '&w=150&h=100&q=95') : imagePath,
					imageContainer = $('<div class="media-loader-image"></div').appendTo(mediaContainer),
					positionTop = $(this).position().top - (imageContainer.outerHeight(true) - $(this).outerHeight(true))/2,
					positionLeft = $(this).position().left + $(this).outerWidth(true) + 10; 
				
				imageContainer.css({'opacity': 0, 'top': positionTop, 'left': positionLeft})
							  .animate({'opacity':1}, 500)
				
				$('<img/>').load(function() {
									imageContainer.css('background-image', 'url(' + fullPath + ')');
								 })
						   .attr('src', fullPath);
			},
			
			function() {
				var imageContainer = mediaContainer.find('.media-loader-image');
				imageContainer.animate({'opacity':0}, 300, function() {imageContainer.remove()});
			}
		);
		
		
		mediaContainer.find('#insert-selected').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
				
			ajaxRequestInProgress = true;
			
			var action = 'sliderpro_add_new_slides',
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0,
				quantity = selectedImages.length;
			
			// find the index of the new panel	
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));									 
			});
			
			counter++;
			
			if (isNaN(quantity) || quantity < 1) {
				ajaxRequestInProgress = false;
				return;
			}
			
			showProcessingIndicator();
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, counter: counter, quantity: quantity},
				complete: function(data) {
					hideProcessingIndicator();
					
					var slides = $(data.responseText).appendTo($('.slideboxes'));
						
					slides.each(function(index) {
						var slide = $(this);	
						slide.find('.position').val(position + index);
						prepareSlide(slide);
						slide.hide().fadeIn();
						
						slide.find('.path').first().val(selectedImages[index]);
						
						// trigger the click event in order to display the iamge
						slide.find('.main-image-buttons a.preview-button').trigger('click');
					});
					
					selectedImages = [];
										
					ajaxRequestInProgress = false;
				}
			});
			
			// remove the lightbox
			mediaContainer.dialog('destroy');
			mediaContainer.remove();

		});
		
		
		mediaContainer.find('.disabled').click(function(event) {
			event.preventDefault();	
		});
		
		
		if (allow == 'multiple') {
			var selected,
				selectedIndex;
			
			$('#sp-media-loader tbody tr').each(function() {
				selected = $(this).find('a.button').prop('href');
				selectedIndex = $.inArray(selected, selectedImages);
				
				if(selectedIndex != -1)
					$(this).addClass('media-loader-selected-row');
			});
			
			$('#sp-media-loader tbody tr').mousedown(function() {
				selected = $(this).find('a.button').prop('href');
				selectedIndex = $.inArray(selected, selectedImages);
				
				if(selectedIndex == -1) {
					selectedImages.push(selected);
					$(this).addClass('media-loader-selected-row');
				} else {
					selectedImages.splice(selectedIndex, 1);
					$(this).removeClass('media-loader-selected-row');
				}
			});
		}
		
	}
	
	
	/*
	* Create the help tooltip that will contain some description of the property
	*/
	function addHelpTooltip(element) {
		var hoverObject;
			
		if (element.find('span').length)
			hoverObject = element.find('span');
		else
			hoverObject = element;
		
		if (element.attr('title') != '') {
			// get the name of the setting from the title attribute
			var titleValue = element.attr('title');				
			
			hoverObject.hover(				
				function() {
					
					helpTooltipTimer = setTimeout(function() {
						isHelpTooltip = true;
						
						element.attr('title', '');
						
						// create the tooltip, add some temporary text and fade it in
						var tooltip = $('<div id="help-tooltip"> loading... </div>').hide()
																					.css('z-index', 15000)
																					.appendTo($('body'));
						
						// set the initial position of the tooltip
						var top = element.offset().top - tooltip.outerHeight(true) - 10,
							left = element.offset().left + (element.outerWidth(true) - tooltip.outerWidth(true)) / 2;
							
						if (left + tooltip.outerWidth(true) > $('body').outerWidth(true))
							left = $('body').outerWidth(true) -  tooltip.outerWidth(true);
						else if (left  < $('.slider-pro').offset().left)
							left = $('.slider-pro').offset().left;					
															
						tooltip.css({'top': top, 'left': left}).fadeIn();
						
						// load the description of the settings
						$.ajax({
							url: sp_js_vars.ajaxurl,
							type: 'get',
							data: {action: 'sliderpro_get_help_text', title: titleValue},
							complete: function(data) {
								tooltip.css('visibility', 'hidden')
									   .html(data.responseText);
								
								top = element.offset().top - tooltip.outerHeight(true) - 10;
								
								if (top < 0)
									top = element.offset().top + 30;
							
								// reset the position of the tooltip
								tooltip.css({'top': top, 'visibility': 'visible'});
							}
						});
					}, 300);
				},
				function() {
					clearTimeout(helpTooltipTimer);
					
					if (isHelpTooltip) {
						element.attr('title', titleValue);
						$('body').find('#help-tooltip').remove();
					}
				});
		}
	}
	
	
	function showAjaxPreloader() {
		if (!sp_js_vars.progress_animation)
			return;
			
		var preloaderOverlay = $('<div id="ajax-preloader-overlay"></div>').appendTo($('body')),
			preloaderContainer = $('<div id="preloader-container"></div>').appendTo($('body'));
			
		preloaderOverlay.css('width', $(document).width());
		preloaderOverlay.css('height', $(document).height());
		
		var topPosition = $(document).scrollTop() + ($(window).height() - preloaderContainer.outerHeight(true)) / 2,
			leftPosition = ($(document).width() - preloaderContainer.outerWidth(true)) / 2;
			
		preloaderContainer.css({top: topPosition, left: leftPosition});
	}
	
	
	function hideAjaxPreloader() {
		if (!sp_js_vars.progress_animation)
			return;
			
		$('body').find('#ajax-preloader-overlay').remove();	
		$('body').find('#preloader-container').remove();
	}
	
	
	function showProcessingIndicator() {
		$('.slider-pro #processing-indicator').attr('class', 'show');
	}
	
	
	function hideProcessingIndicator() {
		$('.slider-pro #processing-indicator').attr('class', 'hide');
	}
	
	
	/*
	* Create the color picker
	*/
	function addColorPicker(target) {
		var instance = target,
			colorInput = instance.prev(),
			color = rgb2hex(colorInput.val());
			
		instance.css('background-color', color);
		
		instance.ColorPicker({
			color: color,
	
			onShow: function (instance) {
				$(instance).fadeIn(300);
			},
			
			onHide: function (instance) {
				$(instance).fadeOut(300);
			},
			
			onChange: function (hsb, hex, rgb) {
				instance.css('background-color', '#' + hex);
				colorInput.val('#' + hex);
			}
		});
	}
	
	
	/*
	* Transforms an RGB value to a HEX value
	*/
	function rgb2hex(rgb) {
		 if (rgb.search("rgb") == -1) {
			  return rgb;
		 } else {
			  rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
			  function hex(x) {
				   return ("0" + parseInt(x).toString(16)).slice(-2);
			  }
			  return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
		 }
	}

})(jQuery);


jQuery.fn.extend({
	insertAtCaret: function(myValue){
		return this.each(function(i) {
			if (document.selection) {
				//For browsers like Internet Explorer
				this.focus();
				sel = document.selection.createRange();
				sel.text = myValue;
				this.focus();
			} else if (this.selectionStart || this.selectionStart == '0') {
				//For browsers like Firefox and Webkit based
				var startPos = this.selectionStart;
				var endPos = this.selectionEnd;
				var scrollTop = this.scrollTop;
				this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
				this.focus();
				this.selectionStart = startPos + myValue.length;
				this.selectionEnd = startPos + myValue.length;
				this.scrollTop = scrollTop;
			} else {
				this.value += myValue;
				this.focus();
			}
	  });
	}
});