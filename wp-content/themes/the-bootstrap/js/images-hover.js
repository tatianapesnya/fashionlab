jQuery(document).ready(function($) {
	$('a.btn').html('');
	$('a.btn').append('<p>menu</p>');

	var img = $('.entry-content a');

	img.hover(function(){
		var img = $(this).find('.overlay');
		img.toggleClass('hidden');

	});
	$('.tabs a').click(function(){
 	 var $this = $(this);
 	 $('.panel').hide();
 	 $('.tabs a.active').removeClass('active');
 	 $this.addClass('active').blur();
 	 var panel = $this.attr('href');
 	 $(panel).fadeIn(250);
 	 return false;
 	}); //end click
 	$('.tabs li:first a').click();
});