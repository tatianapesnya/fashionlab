(function() {
	
	tinymce.create('tinymce.plugins.SliderProVideoPlugin', {
		
		createControl: function(n, cm) {
			switch(n) {
				case 'sliderprovideo':
					var c = cm.createSplitButton('sliderprovideo', {
						title: 'Slider PRO Video',
						image: '../wp-content/plugins/slider-pro/css/images/sliderpro_video_icon.png',
						onclick: function() {
							c.showMenu();
						}
					});
					
					c.onRenderMenu.add(function(c, m) {	
						var menu = m.add({'title': 'sliderprovideo.menuTitle', 'class': 'mceMenuItemTitle'}).setDisabled(1);
						
						m.add({'title': 'YouTube', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="youtube" id=""]');}});
						m.add({'title': 'YouTube Lazy Load', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="youtube" id="" mode="lazy-load" poster=""]');}});
						m.add({'title': 'Vimeo', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="vimeo" id=""]');}});
						m.add({'title': 'Vimeo Lazy Load', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="vimeo" id="" mode="lazy-load" poster=""]');}});
						m.add({'title': 'HTML5', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="html5" poster="" source1="" source2=""]');}});
						m.add({'title': 'VideoJS', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="video-js" poster="" source1="" source2=""]');}});
						m.add({'title': 'JWPlayer', onclick: function() {tinyMCE.activeEditor.selection.setContent('[slider_pro_video type="jw-player" image="" source1="" source2=""]');}});
						
					});
					
					return c;
			}
			
			return null;
		}
		
	});
	
	tinymce.PluginManager.add('sliderprovideo', tinymce.plugins.SliderProVideoPlugin);
	
})();