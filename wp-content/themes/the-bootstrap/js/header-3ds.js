jQuery(document).ready(function($) {

	var firstTime = false;
	if($.session.get('first_time') === undefined)
	{
		//alert ('firstTime undefined');
		$.session.set('first_time', 1);	
		firstTime = true;
		
	}	

	if(firstTime)
	{
		$('#header_3ds').css({'height':'170px'});
		$('#header_drag').addClass('active');
		$('#dsheader').show();				

		var firstMenuHide = setTimeout(function(){$('#header_drag .header_drag_toggle').trigger('click')}, 4000);
	}
	else
	{
		if($('#header_drag').hasClass('active'))
		{
			$('#header_3ds').css({'height':'21px'});
			$('#header_drag').removeClass('active');
			$('#dsheader').hide();				
		}

	}	
	
	
	//clearTimeout(firstMenuHide);
	//$('#header_3ds').css('height', '21px');

	$(document).on('click', '#header_drag .header_drag_toggle', function(){
				
		var self = $(this).parent();
		var global3ds = $('#header_3ds');
		var dsheader = $('#dsheader');
		var height = parseInt(global3ds.height());
		if(height == '21'){
		
			self.addClass('active');
			/*if(Application.Common.ipad){
				global3ds.css({'height':'165px'});				
			}else{*/
			global3ds.animate({'height':'170px'}, 500, function(){
				dsheader.show();
			});
			//}
		}else{
			/*if(Application.Common.ipad){
				global3ds.css({'height':'1px'});
				self.removeClass('active');				
			}else{*/
				global3ds.animate({'height':'21px'}, 500, function(){
					self.removeClass('active');
					dsheader.hide();
				});
				
			//}
		}
		
		return false;
	});


	var page = $('#page');
	var pagePosition = page.position();

	$(document).on('click', '.scroll-down', function(){

		$('body').animate({'scrollTop':-pagePosition.top}, 500, function(){});
		
		return false;
	});
	
});