jQuery(document).ready(function() {

	var currentWidget;
	var editText = false;

	jQuery(document).on('click', 'div.hwim', function(evt) {
		/* Display WordPress image selection tool. */
		if (jQuery(evt.originalEvent.target).hasClass('select-image')) {
			evt.preventDefault();
			currentWidget = evt.currentTarget;
			var tbHeight = Math.floor(jQuery(window).height() * 0.8);
			tb_show('HW Image Widget', 'media-upload.php?post_id=0&type=image&context=hwim&post_mime_type=image&tab=library&TB_iframe=true&width=640&height=' + tbHeight);
		}
		/* Remove image from widget. */
		if (jQuery(evt.originalEvent.target).hasClass('remove-image')) {
			evt.preventDefault();
			currentWidget = evt.currentTarget;
			jQuery('.remove-image-link', currentWidget).hide();
			jQuery('.img-thumb', currentWidget).html('');
			jQuery('.src', currentWidget).attr('value', '');
			jQuery('.display-width', currentWidget).attr('value', '');
			jQuery('.display-height', currentWidget).attr('value', '');
			jQuery('.original-width', currentWidget).attr('value', '');
			jQuery('.original-height', currentWidget).attr('value', '');
		}
		/* Display text editor */
		if (jQuery(evt.originalEvent.target).hasClass('edit-text') || editText == true) {
			evt.preventDefault();
			currentWidget = evt.currentTarget;
			tinyMCE.get('hwim-tinymce').setContent(jQuery('.text', currentWidget).attr('value'));
			jQuery('#hwim-lb').modal('show');
			editText = false;
		}
	});

	jQuery(document).on('click', 'div.hwim .edit-text', function(evt) {
		/* Make sure clicks within the text preview div triggers editor */
		if (jQuery(evt.currentTarget).hasClass('edit-text')) {
			editText = true;
		}
	});

	jQuery(document).on('click', '#hwim-lb', function(evt) {
		/* Save text to widget */
		if ( jQuery(evt.originalEvent.target).hasClass('btn-primary')) {
			jQuery('.text', currentWidget).attr('value', tinyMCE.get('hwim-tinymce').getContent());
			jQuery('.text-preview', currentWidget).html(tinyMCE.get('hwim-tinymce').getContent());
		}
	});

	jQuery(document).on('change', 'div.hwim', function(evt) {
		/* Handle display size changes */
		if ( jQuery(evt.originalEvent.target).hasClass('display-size')) {
			if (jQuery('.display-size', evt.currentTarget).attr('value') == 'fixed') {
				jQuery('div.fixed-size', evt.currentTarget).show();
			} else {
				jQuery('div.fixed-size', evt.currentTarget).hide();
			}
		}
		/* Handle target changes */
		if ( jQuery(evt.originalEvent.target).hasClass('target-option')) {
			var targetOption = jQuery('.target-option option:selected', evt.currentTarget);
			var targetName = jQuery('.target-name', evt.currentTarget);
			if (jQuery(targetOption).attr('value') == 'other') {
				jQuery(targetName).attr('value', '');
				jQuery(targetName).show();
			} else {
				jQuery(targetName).attr('value', jQuery(targetOption).attr('value'));
				jQuery(targetName).hide();
			}

		}
		/* Handle keep aspect ratio changes */
		if (jQuery(evt.originalEvent.target).hasClass('keep-aspect-ratio') && jQuery(evt.originalEvent.target).prop('checked')) {
			calcAspectRatio(evt.currentTarget, jQuery('.display-width', evt.currentTarget));
		}
	});

	jQuery(document).on('keyup', 'div.hwim', function(evt) {
		/* Handle manual width changes */
		calcAspectRatio(evt.currentTarget, evt.originalEvent.target);
	});

	/* Set selected image to placeholder */
	window.send_to_editor = function(html) {
		
		// Workaround for jQuery issue when linking external images.
		html = '<span>' + html + '</span>';
		
		var src = jQuery('img', html).attr('src');
		var title = jQuery('img', html).data('hwim-title');
		var alt = jQuery('img', html).attr('alt');
		var width = jQuery('img', html).data('hwim-w');
		var height = jQuery('img', html).data('hwim-h');

		// When linking external URL.
		if ( !!width ) { width = jQuery('img', html).attr('width'); }
		if ( !!height ) { width = jQuery('img', html).attr('height'); }
		
		jQuery('.remove-image-link', currentWidget).show();
		jQuery('.img-thumb', currentWidget).html('<img src="' + src + '" style="max-width: 100%;">');
		jQuery('.src').attr('value', src);
		jQuery('.display-width', currentWidget).attr('value', width);
		jQuery('.display-height', currentWidget).attr('value', height);
		jQuery('.original-width', currentWidget).attr('value', width);
		jQuery('.original-height', currentWidget).attr('value', height);
		jQuery('.alt', currentWidget).attr('value', alt);

		if (title != '' && jQuery('.title', currentWidget).attr('value') == '') {
			jQuery('.title', currentWidget).attr('value', title);
		}
		
		tb_remove();
	}
});

function isValidInt(val) {
	var intRegex = /^\d+$/;
	return intRegex.test(val);
}

function calcAspectRatio(currentTarget, srcElement) {
	if ((jQuery(srcElement).hasClass('display-width') || jQuery(srcElement).hasClass('display-height')) && jQuery('.keep-aspect-ratio', currentTarget).prop('checked')) {
		var display_width = jQuery('.display-width', currentTarget).attr('value');
		var display_height = jQuery('.display-height', currentTarget).attr('value');
		var original_width = jQuery('.original-width', currentTarget).attr('value');
		var original_height = jQuery('.original-height', currentTarget).attr('value');
		var aspect_ratio = 0;

		var hasClass = '';
		if (jQuery(srcElement).hasClass('display-width')) {
			hasClass = 'display-width';
		} else if (jQuery(srcElement).hasClass('display-height')) {
			hasClass = 'display-height';
		}

		if (isValidInt(display_width) && hasClass == 'display-width') {
			aspect_ratio = original_width / original_height;
			jQuery('.display-height', currentTarget).attr('value', Math.round(display_width / aspect_ratio));
		}

		if (isValidInt(display_height) && hasClass == 'display-height') {
			aspect_ratio = original_height / original_width;
			jQuery('.display-width', currentTarget).attr('value', Math.round(display_height / aspect_ratio));
		}

		if (display_width == '' && hasClass == 'display-width') {
			jQuery('.display-height', currentTarget).attr('value', '');
		}

		if (display_height == '' && hasClass == 'display-height') {
			jQuery('.display-width', currentTarget).attr('value', '');
		}
	}
}
