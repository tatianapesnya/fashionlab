jQuery(document).ready(function($) {
	var firstMenuHide = setTimeout(function(){$('#header_drag .header_drag_toggle').trigger('click')}, 4000);
	
	//clearTimeout(firstMenuHide);
	//$('#header_3ds').css('height', '1px');

console.log('header 3ds');
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
});