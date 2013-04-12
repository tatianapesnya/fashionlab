(function($) {
 	
	// flag for AJAX requests
	var	ajaxRequestInProgress = false;
	
	
	$(document).ready(function() {		
		
		$("<link>").attr({rel: "stylesheet", 
						  type: "text/css", 
						  media: "all", 
						  href: sp_js_vars.url + '/slider-pro/css/jquery-ui.css'
					})
				   .appendTo(jQuery("head"));	
				   	
		$("<link>").attr({rel: "stylesheet", 
						  type: "text/css", 
						  media: "all", 
						  href: sp_js_vars.url + '/slider-pro/css/slider-pro-lightbox.css'
					})
				   .appendTo(jQuery("head"));
				   
		

		$('[href^=slider-pro-lightbox], [class^=slider-pro-lightbox]').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			showAjaxPreloader();
			ajaxRequestInProgress = true;
			
			
			var id,
				settings = $(this).data();
			
			if ($(this).attr('id')) {
				id = parseInt($(this).attr('id'));
			} else if ($(this).attr('class')) {
				var classSplit = $(this).attr('class').split('-');
				id = classSplit[classSplit.length - 1];
			} else if ($(this).attr('href')) {
				var classSplit = $(this).attr('href').split('-');
				id = classSplit[classSplit.length - 1];
			}



			if (settings) {
				var settings_string = '';

				$.each(settings, function(name, value) {
					if (settings_string != '')
						settings_string += '+';

					settings_string += name + '=' + value;
				});

				settings = settings_string;
			} else {
				settings = '';
			}
			
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType:'html',
				data: {action: 'sliderpro_display_lightbox_slider', id: id, settings: settings},
				complete: function(data) {
					ajaxRequestInProgress = false;
					
					var lightboxContainer = $('<div id="lightbox-container"></div>').appendTo($('body')),
						lightbox = $(data.responseText).appendTo(lightboxContainer);
						
					lightboxContainer.dialog({
						resizable:false,
						//modal:true,
						width:'auto',
						height:'auto',
						create:function() {
							hideAjaxPreloader();

							var closeButton = $('<div class="slider-pro-close-button">').appendTo($('.ui-dialog'))
																						.click(function() {
																							lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
																							lightboxContainer.dialog('destroy');
																							lightboxContainer.remove();

																							$('.slider-pro-dialog-overlay').remove();
																						});
						},
						open:function() {
							lightboxContainer.find('.advanced-slider').advancedSlider().doSliderLayout();
						},
						close:function() {
							lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
							lightboxContainer.dialog('destroy');
							lightboxContainer.remove();

							$('.slider-pro-dialog-overlay').remove();
						}});
					

					$('.ui-dialog').addClass('slider-pro-lightbox-dialog');
					$('.ui-dialog-titlebar').remove();


					$('<div class="slider-pro-dialog-overlay"></div>')
						.click(function() {
							lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
							lightboxContainer.dialog('destroy');
							lightboxContainer.remove();

							$(this).remove();
						})
						.css('height', $(document).height())
						.appendTo($('body'));
				}
			});
			
		});



		/*$('[class^=slider-pro-lightbox]').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			showAjaxPreloader();
			ajaxRequestInProgress = true;
			
			
			var id,
				settings = $(this).data();
			
			if ($(this).attr('id')) {
				id = parseInt($(this).attr('id'));
			} else {
				var classSplit = $(this).attr('class').split('-');
				id = classSplit[classSplit.length - 1];
			}


			if (settings) {
				var settings_string = '';

				$.each(settings, function(name, value) {
					if (settings_string != '')
						settings_string += '+';

					settings_string += name + '=' + value;
				});

				settings = settings_string;
			} else {
				settings = '';
			}
			
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType:'html',
				data: {action: 'sliderpro_display_lightbox_slider', id: id, settings: settings},
				complete: function(data) {
					ajaxRequestInProgress = false;
					
					var lightboxContainer = $('<div id="lightbox-container"></div>').appendTo($('body')),
						lightbox = $(data.responseText).appendTo(lightboxContainer);
						
					lightboxContainer.dialog({
						resizable:false,
						modal:true,
						width:'auto',
						height:'auto',
						create:function() {
							hideAjaxPreloader();

							var closeButton = $('<div class="slider-pro-close-button">').appendTo($('.ui-dialog'))
																						.click(function() {
																							lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
																							lightboxContainer.dialog('destroy');
																							lightboxContainer.remove();
																						})
						},
						open:function() {
							lightboxContainer.find('.advanced-slider').advancedSlider().doSliderLayout();
						},
						close:function() {
							lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
							lightboxContainer.dialog('destroy');
							lightboxContainer.remove();
						}});
					
					$('.ui-dialog').addClass('slider-pro-lightbox-dialog');
					$('.ui-dialog-titlebar').remove();
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
										   .click(function() {
												lightboxContainer.find('.advanced-slider').advancedSlider().destroy();
												lightboxContainer.dialog('destroy');
												lightboxContainer.remove();
											});
				}
			});
			
		});*/
		
	});
	
	
	
	function showAjaxPreloader() {
		var preloaderOverlay = $('<div id="ajax-preloader-overlay"></div>').appendTo($('body')),
			preloaderContainer = $('<div id="preloader-container"></div>').appendTo($('body'));
			
		preloaderOverlay.css('width', $(document).width());
		preloaderOverlay.css('height', $(document).height());
		
		var topPosition = $(document).scrollTop() + ($(window).height() - preloaderContainer.outerHeight(true)) / 2,
			leftPosition = ($(document).width() - preloaderContainer.outerWidth(true)) / 2;
			
		preloaderContainer.css({top: topPosition, left: leftPosition});
	}
	
	
	function hideAjaxPreloader() {
		$('body').find('#ajax-preloader-overlay').remove();
		$('body').find('#preloader-container').remove();
	}

})(jQuery)