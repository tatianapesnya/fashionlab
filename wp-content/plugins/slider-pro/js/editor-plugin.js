(function() {
	
	tinymce.create('tinymce.plugins.SliderProPlugin', {
		
		createControl: function(n, cm) {
			switch(n) {
				case 'sliderpro':
					var c = cm.createSplitButton('sliderpro', {
						title: 'Slider PRO',
						image: '../wp-content/plugins/slider-pro/css/images/tm_icon.png',
						onclick: function() {
							c.showMenu();
						}
					});
					
					c.onRenderMenu.add(function(c, m) {	
						var menu = m.add({'title': 'sliderpro.menuTitle', 'class': 'mceMenuItemTitle'}).setDisabled(1);
						jQuery.ajax({
							url: 'admin-ajax.php',
							dataType: 'json',
							data: {action: 'sliderpro_tinymce_plugin'},
							success: function(data) {
								jQuery.each(data, function(i){
									m.add({'title': data[i].name + ' (' + data[i].id + ')', onclick: function(){
										tinyMCE.activeEditor.selection.setContent('[slider_pro id="' + data[i].id + '"]');
									}});
								});
							}
						});
						
						
					});
					
					return c;
			}
			
			return null;	
		}
		
	});
	
	tinymce.PluginManager.add('sliderpro', tinymce.plugins.SliderProPlugin);
	
})();