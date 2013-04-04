jQuery(document).ready(function($) {
	$('a.btn').html('');
	$('a.btn').append('<p>menu</p>');

	var img = $('.entry-content a');

	img.hover(function(){
		var img = $(this).find('.overlay');
		img.toggleClass('hidden');

	});
});