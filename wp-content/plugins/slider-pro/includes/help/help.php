<div class="container slider-pro-help">	

<section id="installation">
	<div class="page-header">
	  <h1>Installation <small>Installing Slider PRO for the first time</small></h1>
	</div>
	
	<p>Read this chapter only if you're installing the plugin for the first time. If you're updating from a previous version, please skip to the 'Updating' chapter.</p>
	<p>You don't need to upload the entire zip package downloaded from CodeCanyon. Please unzip that package and inside you will find slider-pro.zip, which is the actual plugin that needs to be installed. To install the plugin, go to Plugins-&gt;Add New-&gt;Upload-&gt;Browse and select the slider-pro.zip file and then click 'Install Now'.</p>
        
  	<p>After the plugin is installed and activated, you will see the Slider PRO menu in the admin sidebar.</p>
</section>


<hr />


<section id="updating">
	<div class="page-header">
	  <h1>Updating <small>Updating from a previous version</small></h1>
	</div>
	
	<h3 id="updating1">1. Introduction</h3>
	
	<p>Slider PRO will show you update notification, just like the plugins hosted on wordpress.org. However, the automatic update functionality is disabled at the moment due to some incompatibilities with how Envato (the company behind CodeCanyon and ThemeForest) stores the download packages on their servers. In order to update your slider installation, you will need to re-download the slider from your account and install it manually using the instructions from sub-chapter 2 or 3.</p>

	<hr />
	
	<h3 id="updating2">2. Updating from version 1.x.x to the latest version</h3>

	<p>Before updating I recommend creating a backup of the current sliders by saving the sliders' XML files (slider-pro/xml) in a safe folder. In case something goes wrong during the update, you can recreate all your sliders using those XML files. You may also want to backup your skin files if you made any custom edits to them.</p>

	<p>The following steps are required when you update:</p>

	<ol>
		<li>Deactivate the plugin</li>
		<li>Use FTP to connect to your server and go to /wp-content/plugins/, and delete the 'slider-pro' folder</li>
		<li>Unzip slider-pro.zip and copy the new slider-pro folder in /wp-content/plugins/</li>
		<li>After all files have copied, activate the plugin back.</li>
	</ol>

	<p>Please note that in newer version there were introduced some modification to the name of some slider options and CSS selectors, whcih are meant to make the slider more intuitive to work with.</p>
	
	<p>One of the most important changes is the role of the 'Width' and 'Height' options. These options no longer refer to the width and height of the slide image but rather to the width and height of the whole slider, which includes controls, shadow, thumbnail scroller, etc. This modification was introduces in order to allow the slider to be responsive. When you want to determine the required width and height that you need to set the slider to, in order to have a certain width and height for the slides, you can use the Preview window. In a later chapter I will show you how to use this window in order to have the slider sized exactly as you want.</p>
	
	<h4>1. Options Modifications</h4>
	
	<p>While there are a few options which had their name slightly changed it's not important to enumerate them because the slider will automatically handle this modification.</p>	
	
	<hr>
	
	<h4>2. CSS Modifications</h4>
	
	<p>The CSS updates will need to be done manually if it's the case. The following CSS selector were changed:</p>
	
	<ul class="custom-list">
		<li>.skin-name .navigation-arrows -&gt; .skin-name .slide-arrows</li>
		<li>.skin-name .caption .background -&gt; .skin-name .caption-container .background</li>
		<li>.skin-name .caption .content -&gt; .skin-name .caption-container .caption</li>
		<li>.skin-name .navigation-buttons -&gt; .skin-name .slide-buttons</li>
		<li>.skin-name .navigation-buttons .buttons -&gt; .skin-name .slide-buttons .buttons-inner</li>
		<li>.skin-name .navigation-buttons .buttons .thumbnail -&gt; .skin-name .slide-buttons .buttons-inner .thumbnail-wrapper</li>
		<li>.skin-name .navigation-thumbnails -&gt; .skin-name .thumbnail-scroller</li>
		<li>.skin-name .navigation-thumbnails .thumbnail -&gt; .skin-name .thumbnail-scroller .thumbnail-wrapper</li>
	</ul>


	<hr />

	<h3 id="updating3">3. Updating from version 2.x.x or 3.x.x to the latest version</h3>
	
	<p>Before updating, don't forget to create backups of your custom CSS or JavaScript code, custom skins, and modified skin files.</p>
	
	<p>For updating the plugin it's recommended to follow these steps:</p>
	<ol>
		<li>Deactivate the plugin</li>
		<li>Use FTP to connect to your server and navigate to /wp-content/plugins/</li>
		<li>Unzip slider-pro.zip and copy the new slider-pro folder in /wp-content/plugins/, overwriting the existing slider files</li>
		<li>After all files have copied, activate the plugin back.</li>
	</ol>
	
	<p>As an alternative to uploading all the files, you can upload only those that were modified or added. However, if you want to use this method, please make sure you updated all the mentioned files. The changelog is presented <a href="#changelog">here</a>.</p>
	
	
	<hr />

	<div class="alert alert-info"> <strong>NOTE:</strong> If the slider seems broken after an update or you don't see the new changes, please try to clear the browser's cache.</div>

</section>


<hr />


<section id="create">
	<div class="page-header">
	  <h1>Getting started with the slider <small>Presentation of the slider's administration interface</small></h1>
	</div>
	
	<h3 id="create1">1. Creating a new slider</h3>
    <div class="row">
		<div class="span3">			
        	<p>You can create a new slider by either going to Slider PRO -> New Slider or Slider PRO -> Sliders -> Create a New Slider. The administration interface of the newly created slider will look as in the image on the right.</p>
        	<p>The slider has 2 columns: one for containing the slide panels and one for containing options panels. Also, below the slide panels, there are a few controls for adding new slides and for manipulating the current slides. I will start by presenting the sidebar options panel, then I'll present the slide panel, and finally I will present the controls.</p>
		</div>
		
		<div class="span9">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_new.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create2">2. Sidebar options panels</h3>
    <div class="row">
		<div class="span4">
			<h5>Introduction</h5>
        	<p>The slider provides over 150 options and for making it easier to find a certain option they are grouped in several categories. Each category of options has a separate panel. Most of these panels have their options initially hidden and they need to be displayed by selecting them from the dropdown menu and then click the 'Display' button. Inside the dropdown menu you can see the option's name, its default value, and if you hover over the name of the option a tooltip that describes the option will appear, as you can see in the first image on the right.</p>

        	<h5>How to set the options</h5>
        	<p>You will not be able to set an option directly from within the drop down menu. First, you need to select the option(s) you want to customize using the checkbox on the left of the option's name, and then click the 'Display' button. The selected option(s) will appear below the dropdown menu and only then you will be able to customize them. After the option fields are displayed you can still hover the options name to read the option's description. Please see the second image on the right.</p>
        	<p>I will repeat the required steps:</p>
        	<ol>
        		<li>Click on the dropdown menu</li>
        		<li>Select the options that you want to customize</li>
        		<li>Click on the 'Display' button</li>
        		<li>The option fields will appear bellow the dropdown</li>
        		<li>Customize the options</li>
        	</ol>

        	<h5>Why the current work-flow?</h5>
        	<p>In case you wonder why the setting fields are not displayed by default and you need to take an extra step in order to have them displayed, there are several reasons why this workflow was implemented. First, there are currently 150 options and more will probably be added in the future. Having 150 or more options displayed by default would make the page load slower and the interface would be too cluttered and confusing. Second, it would be pretty difficult to arrange all those options so that they are nicely aligned and don't take too much space. Third, most of the times you only want to customize a few properties, so this interface will allow you to display only those options that you have customized.</p>
		</div>
		
		<div class="span8">
			<h5>Selecting the options you want to customize</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/options_drop_down.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Customizing the selected options</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/options_selected.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Slides order</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slides_order.jpg">
		</div>
	</div>
	
	<hr />

	<h3 id="create3">3. Slide panels</h3>
    <div class="row">
		<div class="span4">			
        	<p>Inside the slide panels you will insert all the data related to the slide. Here you will add the slide's image, thumbnail, layers, caption, inline HTML content, link or lightbox, and also individual settings.</p>
        	<p>The slide panels are draggable so you can reorder the slides simply by dragging the panels in the desired position. Please note that in some browsers, like IE, this functionality doesn't work well, so you will need to use the 'Slides Order' panel for arranging slides.</p>
        	<p>If you double click the panel's handler you will be able to edit the panel's title. This is a useful feature if you want to keep a better reference of your panels. To edit the title, first double click on the handler, then enter the title you want and then just hit the Enter key or click on the handler again.</p>
        	<p>Also, if you move the mouse over a slide panel you will notice 5 icons in the upper right corner.</p> 
        	<p>The first icon allows you to mark the slide. This is useful when you want to perform an action on multiple slide panels at once. </p>
        	<p>The second icon allows you to enable or disable the slide. A disabled slide will not appear in the published slider, so if you want to temporarily remove a slide from the slider you don't have to delete it and then re-create; you will simply disable the slide.</p> 
        	<p>The third icon allows you to duplicate a slide. Duplicating a slide will create a new slide panel that has all the data of the original panel.</p>
        	<p>The fourth icon allows you to permanently delete a slide, and the fifth icon simply allows you to show or collapse the panel.</p>
		</div>
		
		<div class="span8">
			<h5>Drag&Drop slide panels</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slides_drag.jpg">
			<br/>
			<br/>
			<br/>
			<h5>Slide panel interface</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_panel.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create4">4. Slide panel - Image</h3>
    <div class="row">
		<div class="span4">			
        	<p>It's not necessary to specify a main image; maybe you will want to use only layers on a certain slide, without a background image. If you do specify an image, you can simply write its path in the 'Path' field or you can click on the 'Add Image' button, which will open the WordPress Media Library.

        	<p>Please note that you can also use external images from Flickr or other image hosting websites. If the path is correct, and TimThumb functions properly, a thumbnail of the image will appear in the left box. If you click on the thumbnail, the full image will be displayed in a modal box.</p>

        	<p>In this slide section you can also specify some text for the image's 'alt' and 'title' attributes.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_image.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create5">5. Slide panel - Thumbnail</h3>
    <div class="row">
		<div class="span4">			
        	<p>The slider also gives you the possibility of displaying thumbnails, which can be images or HTML content. You can specify the image in the Thumbnail Image section and the HTML content in the Thumbnail Content section. Also, you can reference the thumbnail image in the Thumbnail Content section using the  [sp_thumbnail_image] shortcode.</p>

        	<p>In order to enable the thumbnail scroller you will need to set the 'Thumbnail Type' option to 'Scroller'.</p>

        	<p>If the thumbnail image is not specified, the slider will automatically create a thumbnail image based on the main image set for the slide, by minimizing and cropping it.</p>

        	<p>Just like with the slide image, you can chose an image from the Media Library or you can manually insert its path. You also have the option to specify some text for the 'alt' and 'title' attribute. The specified 'alt' text will be used as a thumbnail caption and the 'title' text will be displayed in a tooltip.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_thumbnail.jpg">
		</div>
	</div>

	<div class="alert alert-info"> <strong>NOTE:</strong> If the image boxes show 'Image Not Found', that's an indication that TimThumb is not allowed to run properly. For troubleshooting this problem please refer to the 'Troubleshooting' chapter.</div>

	<div class="alert alert-info"> <strong>NOTE:</strong> The default TimThumb settings will not allow you to load external images. In order to enable this functionality, you will need to open the 'timthumb-config.php' file (/wp-content/plugins/slider-pro/includes/timthumb/timthumb-config.php), set the 'ALLOW_EXTERNAL' variable to true and then in the $ALLOWED_SITES specify the external domain where the images are located. If you want to load external image from any domain you can set the 'ALLOW_ALL_EXTERNAL_SITES' variable to true.</div>

	<hr />

	<h3 id="create6">6. Slide panel - Layers</h3>
    <div class="row">
		<div class="span4">
        	<p>One of the most important features of the slider is the possibility to add animated or static layers. The layers can contain any content: simple text, inline HTML, videos, dynamic slide tags.</p>

        	<p>When you hover over a layer you will see 3 buttons appear in the top-left corner. The first button will allow you to edit the content of the layer. The second button will allow you to customize the layer. It's possible to edit the size, position, style or transition of the layer. If you hover over the name of the option you will see a description of the option and, where available, some of the possible values that the option can take.</p>

        	<p>The slider makes it very easy to insert videos inside the layers, using the below "Insert Video" button. After you select the video, a shortcode will appear in the layer. You will then need to provide further information about the video, like the ID of YouTube or Vimeo video, or the path to the video files in case of Video JS or HTML5 videos. </p>

        	<div class="alert alert-info"> <strong>NOTE:</strong> In order to have the layers' background sized to the same size that the slide will have, please go to "Preview Slider" and then click "Apply Values". This step is necessary because the slider needs to be rendered before it can determine the final size of the slide area.</div>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_layers.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create7">7. Slide panel - Caption</h3>
    <div class="row">
		<div class="span4">
			<p>The Caption section is disabled by default because the layers can replace them. This section was used prior to version 3 and it's still available for backward compatibility.</p> 

			<p>You can enable this feature from Slider PRO -> Plugin Options -> Enable the Caption and Inline HTML sections.</p>

        	<p>Any type of HTML content can be inserted inside the caption. Although you can style the text using the provided visual editor, it's good practice to use external CSS for styling the elements. In order to insert raw HTML code in the caption, click on the HTML button (top-right) and add the code in the modal window.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_caption.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create8">8. Slide panel - Inline HTML</h3>
    <div class="row">
		<div class="span12">
			<p>The Inline HTML section, just like the Caption section, is disabled by default and you can use the layers instead.</p>

        	<p>This area offers you a visual editor just like the 'Caption' area but for complex HTML content I recommend adding the code as raw HTML code and then style it using external CSS. You can add any type of content, including videos from YouTube, Vimeo, HTML5 videos or flash movies.</p>
		</div>
	</div>

	<hr />

	<h3 id="create9">9. Slide panel - Link & Lightbox</h3>
    <div class="row">
		<div class="span4">
        	<p>The 'Link & Lightbox' area allows you to specify a link or lightbox for both the slide image and the thumbnail image. All you have to do it specify the URL of the link in the 'Path' field. If you want the link to be a lightbox, you will need to check the 'Lightbox' option.</p> 
        	<p>If you want the links to be opened in a lightbox, please note that you can load images, YouTube, Vimeo or HTML5 videos, web pages, or inline HTML content.</p> 
        	
        	<h5>Videos</h5>
        	<p>When you open a Vimeo or YouTube video, all you have to do is specify the URL of the youtube/vimeo page, and if you want to set a certain size for the video you can do this by passing a width and a height to the URL of the video: http://www.youtube.com/watch?v=JVuUwvUUPro?width=700&height=400.</p>
        	<p>You can open HTML5 videos by specifying the path to a MP4 video. Please note that HTML5 videos also need an OGG version of the same file, for playback in Firefox, so you will need to have an .ogv version of the video in the same location with the mp4 file. These files need to have the same name.</p>

        	<h5>Web page</h5>
        	<p>When you open a web page you need to pass 'iframe=true' to the URL of the page and you can also pass a width and a height: http://yahoo.com?iframe=true&width=700&height=400.</p>
        	
        	<h5>Inline Content</h5>
        	<p>For loading inline HTML content all you have to do is specify the ID attribute of the content in the 'Path' field.</p>
        	
        	<p>If you set a lightbox for the slide, the image's 'alt' text will be used as a title for the lightbox window and the link's 'title' text as a description.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_links.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create10">10. Slide panel - Settings</h3>
    <div class="row">
		<div class="span4">
        	<p>Each slide has a set of options which you can use to override the global options. You work with these options the same way you work with the global options. First, you select them from the drop down menu, click 'Display', and once the options fields appear below the drop down you can start editing their value.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_settings.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create11">11. Slide panel - Slide Type</h3>
    <div class="row">
		<div class="span4">
        	<p>A slide can be static or dynamic. A dynamic slide will automatically fetch data from your WordPress site or Flickr. There are 3 types of dynamic slide types: 'Posts Content', 'Gallery Images' and 'Flickr'.</p>
        	<ul>
        		<li>'Posts Content' will fetch data from your posts, pages, custom post types based on the criteria you select.</li>
        		<li>'Gallery Images' will fetch a gallery of images added to a certain post.</li>
        		<li>'Flickr' will fetch photos from Flickr.</li>
        	</ul>

        	<p>In the <a href="#dynamic">Dynamic Slides</a> chapter you can learn more about this feature.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_types.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create12">12. Adding new slides</h3>
    <div class="row">
		<div class="span4">
        	<p>Below the slide panels there are 2 buttons for adding new slides. You can add empty slides or image slides.</p>

        	<h5>Empty slides</h5>
        	<p>When you add empty slide you can chose how many slides will be added and when you add image slides you can select the images directly from the Media Loader.</p> 
        	<h5>Image slides</h5>
        	<p>You can select multiple images inside the Media Library and when you click the 'Insert into Post' button, the slide panels will automatically be created, one for each selected image, and the images will be loaded inside the panels.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/image_slides_library.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create13">13. Manipulating slides</h3>
    <div class="row">
		<div class="span4">
        	<p>Below the slides, in the right side you will notice a dropdown menu, which provides several options/actions. Those actions can be applied to all the marked/selected slides. For example, you can delete multiple slides at once, or disable them at once. You can also mark all slides or unmark all slides. After you select the action that you want to perform, click on the 'Apply' button.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slides_actions.jpg">
		</div>
	</div>

	<hr />

	<h3 id="create14">14. Create the slider</h3>
    <div class="row">
		<div class="span4">
        	<p>When you're done creating all the slides and adjusting the settings all you have to do is click the 'Create Slider' button.</p>
			<p>After the slider is created, the 'Preview Slider' button will become enabled and, also, the 'Delete Slider' option will become available.</p>
			<p>All the sliders will be displayed on the 'Sliders' page, as you can see in the image on the right. For each slider it is displayed the ID of the slider, some information about the date when it was created or modified, and the available actions</p>
		</div>
		
		<div class="span8">
			<h5>All Sliders</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/sliders_all.jpg">
		</div>
	</div>

	<h3 id="create15">15. Export and import sliders</h3>
    <div class="row">
		<div class="span4">
        	<p>You can move sliders between Slider PRO installations by exporting and importing them. Any slider can be exported by clicking on the 'Export' link. The exported file will be an XML file containing all the data about the slider.</p>
			<p>To import a slider all you have to do is click on the 'Import a Slider' button. The upload form will appear in a modal box.</p>
			<p>All you have to do is browse to the slider XML file and then click 'Import Slider'. After that the imported slider will appear in the list of sliders.</p>
			<p>The examples showcased on the slider's <a href="http://sliderpro.net/examples/" target="_blank">presentation site</a> can be found in the "examples" folder included in the package downloaded from CodeCanyon.</p>
		</div>
		
		<div class="span8">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/import_slider.jpg">
		</div>
	</div>
</section>


<hr />


<section id="publish">
	<div class="page-header">
	  <h1>Publish the slider</h1>
	</div>
	
	<p>There are multiple ways to insert the slider in your site, depending on where you want the slider to appear. The slider can be inserted in a regular post/page, inside the widgets area or inside you template's PHP code.</p>

	<h3 id="publish1">1. Insert the slider in regular post/page</h3>
    <div class="row">
		<div class="span6">			
        	<p>For this, you can use the slider's shortcode: [slider_pro id="n"], where 'n' is the ID of the slider. You can also generate the needed shortcode using the slider's visual editor button, as you can see in the image on the right. </p>
			
			<p>When you want to insert multiple sliders on the same page it's recommended to add a closing tag to each shortcode: [slider_pro id="n"][/slider_pro]. </p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/shortcode_generator.jpg">
		</div>
	</div>

	<hr />

	<h3 id="publish2">2. Insert the slider in the widgets area</h3>
    <div class="row">
		<div class="span6">
        	<p>Slider PRO provides you with an easy-to-use, custom widget that allows you to insert any slider into the widgets are. Please see the image on the right.</p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_widget.jpg">
		</div>
	</div>

	<hr />

	<h3 id="publish3">3. Insert the slider using PHP code</h3>
    <div class="row">
		<div class="span12">
			<p>If you want to add a slider instance from within the theme's template you can use the slider_pro(index [, attributes]) function like this:</p>		
<pre class="prettyprint linenums">
&lt;?php echo slider_pro(2); ?&gt;
</pre>

			<p>You can also specify a list of parameters, which will override the options specified in the slider's admin area:</p>		
<pre class="prettyprint linenums">
&lt;?php echo slider_pro(2, array("width"=>"100%", "height"=>150, "effect_type"=>"swipe")); ?&gt;
</pre>
		</div>
	</div>

	<div class="alert alert-info"> <strong>NOTE:</strong>  When you add a slider using PHP code it's necessary to set the slider's 'Include Skin' option, from the 'General' panel, to true.</div>

	<hr />

	<h3 id="publish4">4. Advanced shortcode use</h3>
    <div class="row">
		<div class="span4">
			<p>Slider PRO gives you the possibility to modify an existing slider by overriding some of the global settings, modifying existing slides' settings or content, adding new slides, or even create complete sliders from scratch, using only shortcodes.</p>
		    <p>When you roll over an option's name, in the slider's admin area, you can see the option's name (Setting Name) in the tooltip. You will need to use that setting name inside the shortcode.</p>
		    <p>This feature is very useful because if you need several similar sliders with minor differences, you can create a single slider in the Admin area and then override the settings that  need to be different. Please see the first example on the right.</p>
		    
		    <p>You can also override the settings or the content of the slides as you can see in the second example.</p>
		    
		    <p> You also have the option to override a slide's content, like the main image, the caption, the html content etc. In the third example on the right you can see how this is done.</p>
		    
		    <p>As you can see, all the content that you specify for a slide in the admin area can be overridden in the shortcode. As I previously mentioned, you can not only override existing settings or content but also add new content. For example, if you don't specify an index for the slide, that slide will be added to the slider at the end of the other slides, as you see in the fourth code example on the right.</p>		     
		     
		    <p>You can even create a slider from scratch if you don't specify an id. For example, the last code example on the right represents a slider with three slides, everything created just with shortcodes. Please note that when you create a slider using only shortcodes is necessary to specify a skin for that slider.</p>
		</div>

		<div class="span8">
<h5>Override global settings</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="swipe" thumbnail_width="200"]
</pre>


<h5>Override slide settings</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slice"]
    [slide index="2" horizontal_slices="4" caption_background_color="#FF0000"]
[/slider_pro]
</pre>


<h5>Override slide content</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slice"]
    [slide index="2" horizontal_slices="4" caption_background_color="#FF0000"]
        [slide_element type="image"]path/to/image.jpg[/slide_element]
        [slide_element type="alt"]second image[/slide_element]
        [slide_element type="slide_link_path"]http://bqworks.com[/slide_element]
        [slide_element type="thumbnail_image"]path/to/thumb.jpg[/slide_element]
        [slide_element type="thumbnail_title"]just a thumb image[/slide_element]          
        [slide_element type="thumbnail_alt"]Title 2[/slide_element]
        [slide_element type="layer" layer_preset_styles="black rounded" layer_vertical="center" layer_horizontal="center"]some content[/slide_element]
        [slide_element type="layer" layer_preset_styles="white static" layer_transition="left" layer_offset="200"]more content[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
        [slide_element type="html"]some inline html content[/slide_element]
    [/slide]  
[/slider_pro]
</pre>


<h5>Add new slides</h5>
<pre class="prettyprint linenums">
[slider_pro id="1" effect_type="slide"]
    [slide]
        [slide_element type="image"]path/to/image1.jpg[/slide_element]
        [slide_element type="layer" layer_preset_styles="white rounded"]more content[/slide_element]
    [/slide]
    [slide]
        [slide_element type="image"]path/to/image2.jpg[/slide_element]
        [slide_element type="caption"]main caption content[/slide_element]
    [/slide]    
[/slider_pro]
</pre>


<h5>Create slider from scratch</h5>
<pre class="prettyprint linenums">
[slider_pro width="700" height="400" thumbnail_type="scroller" skin="pixel" lightbox="true"]
    [slide effect_type="fade" caption_size="40" slide_link_lightbox="true"]
        [slide_element type="image"]path/to/image1.jpg[/slide_element]
        [slide_element type="slide_link_path"]http://sliderpro.net?iframe=true&width=900&height=500[/slide_element]
        [slide_element type="layer" layer_preset_styles="black static"]layer content[/slide_element]
    [/slide]
    [slide effect_type="slice" caption_position="top"]
        [slide_element type="image"]path/to/image2.jpg[/slide_element]
        [slide_element type="slide_link_path"]http://yahoo.com[/slide_element]
    [/slide]
    [slide effect_type="slide" slide_easing="easeInOutExpo]
        [slide_element type="image"]path/to/image3.jpg[/slide_element]
        [slide_element type="html"]some HTML content[/slide_element]
    [/slide]
[/slider_pro]
</pre>
		</div>
	</div>

	<div class="row">
		<div class="span12">
		    <p>You can also override dynamic slides using the arguments presented below. Before studying this section please read the "Dynamic slides" chapter.</p>

		    <table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="230">Name</th>
						<th>Accepted values</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>slide_type</td>
						<td>posts, gallery, flickr or static</td>
		            </tr>

					<tr>
						<td colspan="2"><h5>Posts Content slide</h5></td>
		            </tr>

		        	<tr>
						<td>dynamic_posts_types</td>
						<td>post, page or any custom post type</td>
		            </tr>
					
					<tr>
						<td>dynamic_posts_taxonomies</td>
						<td>must be composed of the taxonomy name and the term, separated by a vertical bar: "category|uncategorized"</td>
		            </tr>
		            
					<tr>
						<td>dynamic_posts_relation</td>
						<td>"or" or "and"</td>
		            </tr>
		            
					<tr>
						<td>dynamic_posts_featured</td>
						<td>"1" or "0"</td>
		            </tr>

		            <tr>
						<td>dynamic_posts_maximum</td>
						<td>any number</td>
		            </tr>

		            <tr>
						<td>dynamic_posts_offset</td>
						<td>any number</td>
		            </tr>

		            <tr>
						<td>dynamic_posts_orderby</td>
						<td>"date", "comments", "title" or "random"</td>
		            </tr>

		            <tr>
						<td>dynamic_posts_order</td>
						<td>"asc" or "desc"</td>
		            </tr>

		            <tr>
						<td colspan="2"><h5>Gallery Images slide</h5></td>
		            </tr>
		            
		        	<tr>
						<td>dynamic_gallery_post</td>
						<td>a number that indicates the ID of the post</td>
		            </tr>
					
					<tr>
						<td>dynamic_gallery_maximum</td>
						<td>any number</td>
		            </tr>
		            
					<tr>
						<td>dynamic_gallery_offset</td>
						<td>any number</td>
		            </tr>

		            <tr>
						<td colspan="2"><h5>Flickr slide</h5></td>
		            </tr>
		            
		        	<tr>
						<td>dynamic_flickr_api_key</td>
						<td>the API key provided by Flickr</td>
		            </tr>
					
					<tr>
						<td>dynamic_flickr_data_type</td>
						<td>"set" or "username"</td>
		            </tr>
		            
					<tr>
						<td>dynamic_flickr_data_id</td>
						<td>the ID of the data</td>
		            </tr>

		            <tr>
						<td>dynamic_flickr_maximum</td>
						<td>any number</td>
		            </tr>
				</tbody>
			</table>

<pre class="prettyprint linenums">
[slider_pro]
    [slide slide_type="posts" dynamic_posts_types="post;page" dynamic_posts_taxonomies="tag|design;tag|development;tag|planning" dynamic_posts_orderby="comments"]
        [slide_element type="image"][sp_image][/slide_element]
        [slide_element type="slide_link_path"][sp_link][/slide_element]
        [slide_element type="caption"][sp_content][/slide_element]
    [/slide]
    [slide slide_type="gallery" dynamic_gallery_post="12" dynamic_gallery_maximum="5"]
        [slide_element type="image"][sp_image][/slide_element]
    [/slide]
    [slide slide_type="flickr" dynamic_flickr_api_key="AS23DA423L3698435DDFTU43" dynamic_flickr_data_type="sets" dynamic_flickr_data_id="2343254235"]
        [slide_element type="image"][sp_image][/slide_element]
        [slide_element type="slide_link_path"][sp_image_set][/slide_element]
    [/slide]
[/slider_pro]
</pre>
		</div>
	</div>
</section>


<hr />


<section id="skin">
	<div class="page-header">
		<h1>Skin the slider</h1>
	</div>
	
	<h3 id="skin1">1. Introduction</h3>
	<div class="row">
		<div class="span3">			
			<p>The slider offers you several main skins to choose from and also a few skins just for the scrollbar. If you want to edit these skins, you can do so from within the Slider PRO -> Skin Editor page.</p> 
		
			<p>The CSS files are commented and the selectors are also suggestive so it should be pretty easy to customize them. Also, you are being provided with the layered PSD (or PNG in some cases) files, so that you're able to modify the size and color of the graphic elements. These PSD files are in 'skins_src'.</p>
		</div>
		
		<div class="span9"> 
       		<h4>Skin editor page</h4>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/skin_editor.jpg">
		</div>
	</div>
	
	<div class="alert alert-info"> <strong>NOTE:</strong> The information of each skin, like name, path and URL, is stored in the database, which results in a better performance of the slider. However, because the information is stored in the database, sometimes it's necessary to 'refresh' that information. For example, if you move the slider installation to a different domain or if you manually create a skin using FTP. In order to refresh the information all you need to do is click the 'Refresh All Skins' button from the 'Skin Editor' page.</div>

	<hr />
	
	<h3 id="skin2">2. Creating custom skins</h3>
	<div class="row">
		<div class="span6">
			<p>If you need to do CSS edits, it's recommended to create your own custom skin instead of modifying one of the default skins. You can duplicate one of the existing skins and then add your edits to the custom skin.</p>
     
	 		<p>To create an exact copy of a skin, click the 'Replicate Skin' button and insert some information for the new skin. This will create an exact copy of the original skin but it will modify the header information and the class selectors, according to the values provided by you. At this point, the two skins will apply the same styling, so let's start making some modifications. For example let's change the border color to red and the background color to black.</p>

	 		<p>You will be able to select this custom skin when you create or edit a slider.</p>
		</div>
		
		<div class="span6">
			
<pre class="prettyprint linenums">
/*
    Skin Name: My Custom Skin
    Class: my-custom-skin
    Description: Custom skin for Advanced Slider jQuery plugin
    Author: David
*/


/* MAIN SLIDE */

.my-custom-skin .slide-wrapper {
    background-color: #000;
    border: 8px solid #FFF;
    -moz-box-shadow: 0px 0px 10px #000;
    -webkit-box-shadow: 0px 0px 10px #000;
    box-shadow: 0px 0px 10px #000;
}
</pre>

		</div>
	</div>
	
	<hr />

	<h3 id="skin3">3. Adding custom CSS to sliders</h3>
	<div class="row">
		<div class="span6">			
			<p>Sometimes you only want to make some minor edits to a specific slider and you don't want to create a new custom skin just for a small edit. For this situation, you can add some custom CSS to that slider.</p> 

			<p>Inside the 'Custom JavaScript & CSS' sidebar panel you can click on the 'Edit custom CSS' link and a modal window will be opened where you can add your custom code. You will also need to check the 'Enable custom CSS' option in order to have the custom code applied to the slider. In the Custom Class field you will need to specify a class name, which then you will use to reference the slider in your custom CSS code.</p>

			<p>When you add custom CSS code to a slider, a CSS file containing that code will be created in /plugins/slider-pro/custom/slider-pro-ID/slider-pro-ID-css.css, where ID is the actual ID of the slider.</p>
		</div>
		
		<div class="span6"> 
       		<h5>Custom CSS panel</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/custom_css_panel.jpg">
			<br />
			<br />
			<h5>Custom CSS code window</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/custom_css_window.jpg">
		</div>
	</div>

	<hr />

	<div class="alert alert-info"> <strong>NOTE:</strong> In order to edit the skins or create custom skins, the 'skins' folder (/wp-content/plugins/slider-pro/skins/slider/) and the 'custom' folder (/wp-content/plugins/slider-pro/custom) need to be writeable. On some servers this means that the folder has to have the permission set to 755 but on other servers it has to have the permission set to 777. I recommed to check with your webhost what would be the best permission setting for making the folder writeable.</div>

</section>


<hr />


<section id="dynamic">
	<div class="page-header">
		<h1>Dynamic slides</h1>
	</div>
	
	<p>One of the most important features of Slider PRO is its ability to automatically fetch data from your posts. This allows you to create dynamic slides which update every time you insert a certain type of data. There are 3 types of dynamic slides: slides that are created by fetching data from your posts based on certain taxonomies and parameters, slides that are creating using a post's gallery of images as a source, and slides that load photos from Flickr.</p> 

	<p>For either type of dynamic slide you will first need to use the provided options to select where the content will be fetched from and then you will have to use the slider's dynamic tags to specify where the fetched data should appear. The following sub-chapters will explain each step. Whether you're trying to create a Posts Content slide or a Gallery Images slide, please read both sub-chapters because the steps for creating each of these slides are similar.</p>

	<h3 id="dynamic1">1. Posts Content slides</h3>
	<div class="row">
		<div class="span5">
			<p>To use this type of slides you need to set the 'Slide Type' option to 'Posts Content'. When you do that some controls will appear and you will use those controls to select from which posts will the data be fetched.</p>
			
			<h5>Post Types</h5>
			<p>From the 'Post Types' dropdown you can select which posts to fetch data from. Here you will see the default post types: Posts and Pages but also custom post types.</p>
			
			<h5>Post Taxonomies</h5>
			<p>Based on the selected post types, the taxonomies associated with those posts will appear in the 'Post Taxonomies' menu. Please note that the post types and taxonomies will appear only if they are attached to at least one post.</p>
			
			<h5>Relation</h5>
			<p>The 'Relation' option will allow you to specify whether the posts need to have all the selected taxonomies or at least one of the selected taxonomies.</p>
			
			<h5>Order By</h5>
			<p>The 'Order By' option allows you to sort the slides based on the selected criteria and the 'Order' option will allow you to sort the slide in ascending or descending order.</p>

			<h5>Maximum</h5>
			<p>You can use the 'Maximum' option to indicate how many posts will the data be fetched from and the 'Offset' option to indicate the index/position from where the fetching will start.</p>
			
			<h5>Featured</h5>
			<p>The 'Featured' option is disabled by default because most of the times it's not needed. You can enable it from Slider PRO -> Plugin Options. This option will allow you to fetch data only from certain posts, posts for which the 'Feature this post' option was checked in the slider's metabox that appears on all posts. This box will appear only if the option is enabled.</p>

		</div>
		
		<div class="span7">
			<h5>Posts Content</h5>
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_posts_content.jpg">
		</div>
	</div>


	<h4>IMPORTANT!</h4>

	<p>Setting the above options is the first step in creating the dynamic slide. The second step is to specify where the fetched content will be displayed. For example, you might want to have the featured image displayed as a main slide image, or you might want to display it somewhere in a layer. Also, you might want the title of the post to be used as an 'alt' attribute for the image or as a 'title' attribute.</p> 
			
	<p>The slider gives you the flexibility to choose where the fetched content will be displayed by providing you with several tags, which you will simply insert in the slide's fields. For example if you want the slide image to appear as the main slide, you will insert [sp_image] in Image -> Path or if you want the image to appear in a layer you will enter [sp_image] somewhere in the Layers section.</p>

	<h4>Dynamic tags presentation</h4>

	<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="230">Tag</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>[sp_image]</td>
						<td>Returns the URL of the featured image, if it exists for the post, or of the first image from the post. It also has a 'size' argument which can take the following values: full, large, medium, small. You can use the 'size' argument to load the full image version as the main slide image and the small image as a thumbnail. Example: [sp_image size="small"]</td>
		            </tr>
					
					<tr>
						<td>[sp_image_alt]</td>
						<td>Returns the alt text of the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_title]</td>
						<td>Returns the title of the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_caption]</td>
						<td>Returns the specified caption for the image.</td>
		            </tr>
		            
					<tr>
						<td>[sp_image_description]</td>
						<td>Returns the specified description for the image.</td>
		            </tr>
		            
		            <tr>
						<td>[sp_title]</td>
						<td>Returns the title of the post.</td>
		            </tr>

		            <tr>
						<td>[sp_link]</td>
						<td>Returns the URL of the post.</td>
		            </tr>

		            <tr>
						<td>[sp_date]</td>
						<td>Retursn the data of the post in the format specified in Settings -> General -> Date Format.</td>
		            </tr>

		            <tr>
						<td>[sp_content]</td>
						<td>Returns the content of the post. If the quicktag &lt;!--more--&gt; is used in a post to designate the "cut-off" point for the post to be excerpted, the_content() tag will only show the excerpt up to the &lt;!--more--&gt; quicktag point. You can use the 'more_text' argument to set a certain text to be displayed instead of the default 'continue reading' text. Example [sp_content more_text="Read More..."]</td>
		            </tr>

		            <tr>
						<td>[sp_excerpt]</td>
						<td>Returns the excerpt of the post. You can use the 'limit' argument to set a limit for the number of characters that will be displayed. Example [sp_excerpt limit="140"]</td>
		            </tr>

		            <tr>
						<td>[sp_author_name]</td>
						<td>Returns the name of the post's author.</td>
		            </tr>
					
					<tr>
						<td>[sp_author_posts]</td>
						<td>Returns the URL to the author's posts.</td>
		            </tr>

					<tr>
						<td>[sp_comments_number]</td>
						<td>Returns the number of comments that a post has. Be default, if there is no comment it will return 'No Comment', if there's a single comment it will return '1 Comment' and if there are more than one comment, it will return '% Comments'. However, you can specify your own custom text by using the 'zero', 'one' and 'more' arguments. Example: [sp_comments_number zero="No comments yet" one="Just a single comment" more="Plenty of comments"]</td>
		            </tr>
					
					<tr>
						<td>[sp_comments_link]</td>
						<td>Return the URL to the post's comments.</td>
		            </tr>		            

		            <tr>
						<td>[sp_custom name="property_name"]</td>
						<td>Return the value of a custom property added in the post's custom fields. Example [sp_custom name="product_price"]</td>
		            </tr>
				</tbody>
	</table>

	<h4>Dynamic tags examples:</h4>

	<p>Load the feature image as a main image for the slide and set the 'alt' and 'title' attributes for the image.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_image.jpg">
	<br />
	<br />
	<p>Insert the post title, the date of the post and the excerpt of the post in the slide's caption.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_layer.jpg">
	<br />
	<br />
	<p>Set the link of the main slide image to be the link of the post and set the link's title to the title of the post.</p>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/dynamic_slide_links.jpg">

	<p>Please note that these are just a few variations. You can use the dynamic tags in any of the slide's fields and in any combination.</p>

	<hr />

	<h3 id="dynamic2">2. Gallery Images slides</h3>
	<div class="row">
		<div class="span5">
			<p>This type of dynamic slide also provides a few controls. The 'Post' option allows you to specify the ID of the post from where images will be fetched. If you leave this option to -1, the images will be fetched from the post where the slider is inserted. This would probably be the most common use but for flexibility you can also fetch images from a different post. The 'Maximum' option sets the maximum number of images that will be loaded and the 'Offset' sets the index/position from where the fetching will start.</p>
			<p>As with 'Posts Content' slides, selecting where data should be fetched from is only the first step. Next you will need to use the slider's dynamic tags to specify where the fetched data should be displayed. Please see the previous sub-chapter for a presentation of these dynamic tags and how they should be used.</p>
			<p>The dynamic tags available for the 'Gallery Images' slides are: [sp_image], [sp_image_alt], [sp_image_title], [sp_image_caption] and [sp_image_description].</p>
		</div>
		
		<div class="span7">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_gallery_images.jpg">
		</div>
	</div>
	
	<hr />
	
	<h3 id="dynamic3">3. Flickr slides</h3>
	<div class="row">
		<div class="span5">
			<p>Slider PRO allows you to automatically load Flickr images by providing a Username ID or a Set ID. For this functionality you will need to get a Flickr API Key as instructed here: <a href="http://www.flickr.com/services/apps/create/apply/">http://www.flickr.com/services/apps/create/apply/</a>. After you receive the API Key you need to insert it in the slide's 'API Key' field. Then, in the 'Data Type' field you will need to indicate whether you want to load photos based on a Username or Set. After you indicate that, you need to set the Username/Set ID in the 'Data ID' field. You can also use the 'Maximum' field to indicate the amount of images that will be loaded.</p>
		</div>
		
		<div class="span7">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slide_flickr.jpg">
		</div>
	</div>
	
	<h4>Dynamic tags for Flickr slides</h4>
	
	<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th width="230">Tag</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>[sp_image]</td>
						<td>Returns the URL of the Flickr image. You can add the 'size' argument which can take the following values: 'square_75', 'square_150', 'thumbnail_100', 'small_240', 
						'small_320', 'medium_640', 'medium_800', 'large_1024'. You can use the 'size' argument to load the full image version as the main slide image and the small image as a thumbnail. Example: [sp_image size="medium_800"]</td>
		            </tr>
					
					<tr>
						<td>[sp_image_title]</td>
						<td>Returns the title of the image.</td>
		            </tr>

					<tr>
						<td>[sp_image_description]</td>
						<td>Returns the description of the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_image_link]</td>
						<td>Returns the link to the Flickr page of the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_image_set]</td>
						<td>Returns the link to the Flickr page of the set that contains the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_date]</td>
						<td>Returns the date when the image was uploaded.</td>
		            </tr>
					
					<tr>
						<td>[sp_user]</td>
						<td>Returns the name of the user that uploaded the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_user_link]</td>
						<td>Returns the link to the page of the user that uploaded the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_user_photos]</td>
						<td>Returns the link to the photostream page of the user that uploaded the image.</td>
		            </tr>
					
					<tr>
						<td>[sp_user_sets]</td>
						<td>Returns the link to the page that contains all the photo sets of the user that uploaded the image.</td>
		            </tr>
				</tbody>
	</table>
	
	<h4>Dynamic tags examples:</h4>
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/flickr_slide_example1.jpg">
	<br />
	<br />
	<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/flickr_slide_example2.jpg">
	<p>As mentioned before, these are just a few variations. You can use any dynamic tags in any of the slide's fields.</p>
	
</section>


<hr />


<section id="miscellaneous">
	<div class="page-header">
		<h1>Miscellaneous topics</h1>
	</div>
	
	<p>This chapter will cover several topics like how to use the preview window, how to have the videos automatically handled, how to translate the plugin to a different language, and more.</p>

	<h3 id="miscellaneous1">1. Preview window</h3>
	<div class="row">
		<div class="span5">
			<p>The preview window is a very useful feature of the slider. First, it shows you how the slide will look without having to publish it first and second, it helps you to set the size of the slide image itself to the desired values.</p>
			<p>In the image on the right you notice that in the bottom left corner you have the size for the slider and below it, the size for the slide. If you try to edit the height of the slide, the height of the slider will automatically adjust, so if you want to have a slide image with the height of 400px, you just specify this value in the size of the slide and you will immediately see the height that the slider itself needs to have. Once you have the desired size for your slider, you can simply click on the 'Apply Values' button and the values of the width and height from the preview window will be copied in the 'General' panel. You can also preview the slider at the different sizes by clicking the 'Preview Size' button.</p>
		</div>
		
		<div class="span7">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/slider_preview_window.jpg">
		</div>
	</div>

	<hr />

	<h3 id="miscellaneous2">2. Smart video</h3>
	<div class="row">
    	<div class="span3">
			<p>The slider has built-in support for YouTube videos, Vimeo videos, simple HTML5 videos, HTML5 videos enhanced with VideoJS, and JWPlayer.</p>

			<p>For YouTube and Vimeo videos you can use the "lazy-load" mode. This mode will only display a poster and a play button, and the actual video will be loaded only when the play button is pressed. It's recommended to use this mode when you load many videos or when you experience any problem with the default mode.</p>

			<p>VideoJS is a 3rd party library that will enhance the look of the HTML5 video and will provide a Flash fallback for browsers that don't support the HTML5 video element, like IE8 and below.</p> 

			<p>JWPlayer offers the possibilities that VideoJS offers and some more, as you will see later. However, the slider's support for JWPlayer doesn't include all the capabilities that JWPlayer has, which is why support for this video type is not listed in the slider's description.</p>

			<p>Videos can be inserted in layers using a simple shortcode, which I recommend, or using HTML code. When you edit the content of a layer, the "Insert Video" button will become enabled and you can chose the type of video you want to insert from the drop-down. The shortcode for the selected video will appear in the layer. You will then need to provide further information about the video, like the ID of YouTube or Vimeo video, or the path to the video files in case of Video JS or HTML5 videos. </p>
		</div>
		
		<div class="span9">
			<h5>YouTube videos</h5>
<pre class="prettyprint linenums">
[slider_pro_video type="youtube" id="msIjWthwWwI" params="rel=1&showinfo=0" width="100%" height="200"]
</pre>
			<p>The "id" argument represents the ID of the YouTube video. You can use the "params" argument to pass a list of YouTube parameters. You can find a list of all the available parameters <a href="https://developers.google.com/youtube/player_parameters">here</a>.</p>

			<h6>HTML version:</h6>
<pre class="prettyprint linenums">
&lt;iframe src="http://www.youtube.com/embed/msIjWthwWwI?rel=0&enablejsapi=1&wmode=transparent" width="580" height="380" frameborder="0"&gt;&lt;/iframe&gt;
</pre>
			
			<h5>YouTube Lazy Load</h5>
<pre class="prettyprint linenums">
[slider_pro_video type="youtube" mode="lazy-load" id="msIjWthwWwI" poster="path/to/image.jpg" params="rel=0"]
</pre>
			
			<h6>HTML version:</h6>
<pre class="prettyprint linenums">
&lt;a class="video" href="http://www.youtube.com/watch?v=msIjWthwWwI&rel=0"&gt;
     &lt;img src="http://domain.com/path/to/image.jpg" width="100%" height="200" /&gt;
&lt;/a&gt;
</pre>

			<h5>Vimeo videos</h5>
<pre class="prettyprint linenums">
[slider_pro_video type="vimeo" id="3116167" params="title=0&byline=0" width="100%" height="200"]
</pre>
			<p>The "id" argument represents the ID of the Vimeo video. You can use the "params" argument to pass a list of parameters.</p>

			<h6>HTML version:</h6>

<pre class="prettyprint linenums">
&lt;iframe src="http://player.vimeo.com/video/3116167?api=1" width="580" height="380" frameborder="0"&gt;&lt;/iframe&gt;
</pre>
			
			<h5>Vimeo Lazy Load</h5>
<pre class="prettyprint linenums">
[slider_pro_video type="vimeo" mode="lazy-load" id="3116167" poster="path/to/image.jpg" params="byline=0"]
</pre>
			
			<h6>HTML version:</h6>
<pre class="prettyprint linenums">
&lt;a class="video" href="http://vimeo.com/3116167?byline=0"&gt;
     &lt;img src="http://domain.com/path/to/image.jpg" width="100%" height="200" /&gt;
&lt;/a&gt;
</pre>


			<h5>HTML5 videos</h5>

<pre class="prettyprint linenums">
[slider_pro_video type="html5" 
                  poster="http://bqworks.com/products/assets/videos/bbb/bbb-poster.jpg" 
                  source1="http://bqworks.com/products/assets/videos/bbb/bbb-trailer.mp4" 
                  source2="http://bqworks.com/products/assets/videos/bbb/bbb-trailer.ogv"]
</pre>
			
			<h6>HTML version:</h6>

<pre class="prettyprint linenums">
&lt;video controls preload="none" width="580" height="380"
       poster="http://bqworks.com/products/assets/videos/bbb/bbb-poster.jpg"&gt;
  &lt;source src="http://bqworks.com/products/assets/videos/bbb/bbb-trailer.mp4" type="video/mp4"/&gt;
  &lt;source src="http://bqworks.com/products/assets/videos/bbb/bbb-trailer.ogg" type="video/ogg"/&gt;
&lt;/video&gt;
</pre>


			<h5>VideoJS videos</h5>

<pre class="prettyprint linenums">
[slider_pro_video type="video-js" 
                  poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg" 
                  source1="http://bqworks.com/products/assets/videos/sintel/sintel-trailer.mp4" 
                  source2="http://bqworks.com/products/assets/videos/sintel/sintel-trailer.ogv"]
</pre>

			<h6>HTML version:</h6>

<pre class="prettyprint linenums">
&lt;video id="video-1" class="video-js vjs-default-skin" controls="controls" preload="none" 
       width="580" height="380"
       poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg" data-video="{}"&gt;
  &lt;source src="http://bqworks.com/products/assets/videos/sintel/sintel-trailer.mp4" type="video/mp4"/&gt;
  &lt;source src="http://bqworks.com/products/assets/videos/sintel/sintel-trailer.ogv" type="video/ogg"/&gt;
&lt;/video&gt;
</pre>

			<h5>JW Player videos</h5>
			<p>JW Player is an advanced video player. In addition to providing both Flash and HTML5 playback, you can use JW Player to play audio files, use different video quality depending on the user's connection speed or stream videos from an RTMP server. However, please note that not all of the features available in JW Player can be used in the slider. Some of those features would be difficult to set from within the slider's admin interface and, for this reason, they are missing.</p>
			
			<h6>Setting up JW Player</h6>
			<p>JW Player is not free and if you want to use it you will first need to download it from <a href="http://www.longtailvideo.com/">http://www.longtailvideo.com/</a>. After you download the package you will need to unzip it, upload it to your server, and point the slider to that folder (which contains the player.swf and jwplayer.js files) by using the slider's "JW Player Path" option, from within the "Videos" sidebar panel.				
			<p>There are other optional attributes that you can use as well. If you want to set a custom skin, you will use the "JW Player Skin" option from the Video panel. You can find more information about using custom skins in JWPlayer <a href="http://www.longtailvideo.com/support/jw-player/jw-player-for-flash-v5/43/using-jw-player-skins">here</a>. If you want to set a provider or a streamer for the player, you will use the "data-provider" and "data-streamer" attributes.</p>

			
			<h6>Examples</h6>

<pre class="prettyprint linenums">
[slider_pro_video type="jw-player"
                  poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg"
                  width="500"
                  height="300"

                  source1="sintel-trailer.mp4"
                  source2="sintel-trailer.webm"
                  source3="sintel-trailer.ogv"]
</pre>

<pre class="prettyprint linenums">
[slider_pro_video type="jw-player"
                  width="500"
                  height="300"
                  source="http://www.youtube.com/watch?v=FcfWsj9OnsI"]
</pre>

<pre class="prettyprint linenums">
[slider_pro_video type="jw-player"
                  width="500"
                  height="300"
                  source="path/to/audio.mp3"]
</pre>

<pre class="prettyprint linenums">
[slider_pro_video type="jw-player"
                  poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg"
                  width="640"
                  height="320"
				  
                  source1="sintel-trailer.mp4" source1_mode="html5"
                  source2="sintel-trailer.webm" source2_mode="html5"
                  source3="sintel-trailer.ogv" source3_mode="html5"

                  source4="http://www.youtube.com/watch?v=FcfWsj9OnsI" source4_bitrate="400" source4_mode="flash"
                  source5="http://www.youtube.com/watch?v=izYiDDt6d8s" source4_bitrate="600" source5_mode="flash"
                  source6="http://www.youtube.com/watch?v=08fM0XxRLNI" source4_bitrate="800" source6_mode="flash"]
</pre>
			

			<h6>HTML version</h6>

<pre class="prettyprint linenums">
&lt;div id="video-1" class="jw-player" data-width="500" data-height="300" 
     data-poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg"&gt;

   &lt;div class="source" data-file="sintel-trailer.mp4"&gt;&lt;/div&gt;
   &lt;div class="source" data-file="sintel-trailer.webm"&gt;&lt;/div&gt;
   &lt;div class="source" data-file="sintel-trailer.ogv"&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>

<pre class="prettyprint linenums">
&lt;div id="video-2" class="jw-player" data-width="500" data-height="300"&gt;
   &lt;div class="source" data-file="http://www.youtube.com/watch?v=FcfWsj9OnsI"&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>

<pre class="prettyprint linenums">
&lt;div id="video-3" class="jw-player" data-width="500" data-height="300"&gt;
   &lt;div class="source" data-file="path/to/audio.mp3"&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>

<pre class="prettyprint linenums">
&lt;div id="video-0" class="jw-player" data-width="640" data-height="320" 
     data-poster="http://bqworks.com/products/assets/videos/sintel/sintel-poster.jpg"&gt;

   &lt;div class="source html5" data-file="sintel-trailer.mp4"&gt;&lt;/div&gt;
   &lt;div class="source html5" data-file="sintel-trailer.webm"&gt;&lt;/div&gt;
   &lt;div class="source html5" data-file="sintel-trailer.ogv"&gt;&lt;/div&gt;

   &lt;div class="source flash" data-bitrate="400" data-file="http://www.youtube.com/watch?v=FcfWsj9OnsI"&gt;&lt;/div&gt;
   &lt;div class="source flash" data-bitrate="600" data-file="http://www.youtube.com/watch?v=izYiDDt6d8s"&gt;&lt;/div&gt;
   &lt;div class="source flash" data-bitrate="800" data-file="http://www.youtube.com/watch?v=08fM0XxRLNI"&gt;&lt;/div&gt;
&lt;/div&gt;
</pre>			

		</div>
	</div>

	<hr />

	<h3 id="miscellaneous3">3. Responsive slider</h3>
	<div class="row">
		<div class="span12">
			<p>In order to make a slider responsive, you just have to check the "Responsive" option from the "General" sidebar panel.</p>

			<p>It's not necessary to set the Width and/or Height to percentage values. If you set fixed values for Width and Height, those will represent the default size of the slider and, at the same time, the maximum width and height of the slider.</p>

			<p>If you want the slider to take the full width, you can set the Width to 100%.</p>
		</div>
	</div>

	<hr />
	
	<h3 id="miscellaneous4">4. Responsive videos</h3>
	<div class="row">
		<div class="span12">
			<p>The videos you insert inside the slider, or any other HTML content, will not automatically be responsive. You will need to set its size to percentage values, like 100% in order to make it so. Also, you will need to make sure the video's container is responsive as well, so if you insert the video in a layer, make sure the layer's size is set to percentage values as well.</p>
		</div>
	</div>

	<hr />	

	<h3 id="miscellaneous5">5. Positioning the thumbnail scroller</h3>
	<div class="row">
		<div class="span12">
			<p>The orientation of the thumbnail scroller can be set to 'horizontal' or 'vertical'. When the orientation is horizontal, the scroller is positioned below the slider, and when the orientation is vertical, the scroller is positioned to the left of the slider. If you want to position the scroller above or to the right of slider, you will need to use some custom CSS code.</p>
			
			<h5>1. Thumbnail scroller above the slider</h5>
			
<pre class="prettyprint linenums">
.my-slider .thumbnail-scroller.horizontal {
    margin-top: 0;
    top: 0;
}

.my-slider .slider-main {
    padding-top: 100px;
}
</pre>
			
			<hr />
			
			<h5>2. Thumbnail scroller to the right of the slider</h5>
			
<pre class="prettyprint linenums">
.my-slider .thumbnail-scroller.vertical {
    margin-left: 0;
    left: 0;
}

.my-slider .slider-main {
    padding-left: 200px;
}
</pre>
			
			<p>The padding you set for the '.slider-main' element depends on the size of the thumbnail scroller. You might need to set it to a lower or higher value.</p>

		</div>
	</div>
	
	<hr />
	
	<!--
	<h3 id="miscellaneous6">6. CSS3 transitions</h3>
	<div class="row">
		<div class="span12">
			<p>The slider gives you the possibility to use CSS3 transitions by setting the 'CSS3 Transitions', from the 'Transition Effects' sidebar panel, to true. Please note that this feature requires a recent version of the jQuery library, preferably jQuery 1.7+. If you enable the feature but use an older jQuery version, the transition effects will not work.</p>
		</div>
	</div>
	-->

	<hr />

	<h3 id="miscellaneous7">7. Translating the plugin</h3>
	<div class="row">
		<div class="span6">
			<p>There are several tools for translating but I will show you how to do this using <a href="http://www.poedit.net/">Poedit</a>. First, download and install the software. Open Poedit and go to File -> Open and browse to slider-pro/languages/slider_pro.po. Then go to File -> Save As and save the file using a name that corresponds to the language in which you're translating the plugin. For example, if you translate the plugin to German, save the file as "slider_pro-de_DE"; if you're translating it to French, save the file as "slider_pro-fr_FR". After saving the file, you're ready to begin translating the plugin. All you have to do is click on the string that you want to translate, and write the translation for it in the second box, below the English version.</p>
		</div>
		
		<div class="span6">
			<img src="<?php echo plugins_url('/slider-pro/includes/help/'); ?>assets/img/translation.jpg">
		</div>
	</div>

	<hr />

	<h3 id="miscellaneous8">8. Custom JavaScript code</h3>
	<div class="row">
		<div class="span12">
			<p>You saw in a preview chapter how to use custom CSS code. There are many times when you'll use custom CSS but not so many when you need to use custom JavaScript. However, if you need this, the slider allows you to easily add the necessary code. Just like adding custom CSS, you will need to specify a unique identifier in the 'Custom Class' field, check the 'Enable custom JS' option and then insert the code by clicking on the 'Edit custom JS' link. A js file containing that code will be created in /plugins/slider-pro/custom/slider-pro-ID/slider-pro-ID-js.js, where ID is the actual ID of the slider.</p>
			<p>When you want to use custom JavaScript code, you also need to know a few things about the slider's JavaScript API. Slider PRO is built in top of Advanced Slider, a jQuery slider plugin and Advanced Slides provides you several methods/functions and callback function/events that allow you to manipulate the slider.</p>

			<h5>Public Methods</h5>
			
			<p>The public methods will allow you to manipulate the slider using external controls. This is a very useful capability if you want to integrate the slider with other applications or elements from the page.</p>

			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Method Name</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
		        	<tr>
						<td>nextSlide()</td>
						<td>Opens the next slide.</td>
		            </tr>
					
					<tr>
						<td>previousSlide()</td>
						<td>Opens the previous slide.</td>
		            </tr>
		            
					<tr>
						<td>gotoSlide(index)</td>
						<td>Opens the slide at the specified index.</td>
		            </tr>
		            
					<tr>
						<td>startSlideshow()</td>
						<td>Starts the slideshow mode.</td>
		            </tr>
		            
					<tr>
						<td>stopSlideshow()</td>
						<td>Stops the slideshow mode.</td>
		            </tr>
		            
					<tr>
						<td>pauseSlideshow()</td>
						<td>Pauses the slideshow.</td>
		            </tr>
		            
					<tr>
						<td>resumeSlideshow()</td>
						<td>Resumes the slideshow.</td>
		            </tr>
					
					<tr>
						<td>scrollToThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the specified page.</td>
		            </tr>	
				
					<tr>
						<td>scrollToNextThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the next page.</td>
		            </tr>
				
					<tr>
						<td>scrollToPreviousThumbnailPage()</td>
						<td>Moves the thumbnail scroller to the previous page.</td>
		            </tr>
				
					<tr>
						<td>startThumbnailMouseScroll()</td>
						<td>Starts the mouse scrolling functionality.</td>
		            </tr>
				
					<tr>
						<td>stopThumbnailMouseScroll()</td>
						<td>Stops the mouse scrolling functionality.</td>
		            </tr>
				
					<tr>
						<td>startThumbnailMouseWheel()</td>
						<td>Starts the mouse wheel functionality.</td>
		            </tr>
				
					<tr>
						<td>stopThumbnailMouseWheel()</td>
						<td>Stops the mouse wheel functionality.</td>
		            </tr>
				
					<tr>
						<td>doSliderLayout()</td>
						<td>Forces the slider to re-position all elements. The position of the elements depends on the specified width, height, scaleType and alignType.</td>
		            </tr>
				
					<tr>
						<td>getSlideshowState()</td>
						<td>Gets the current slideshow state. Returns 'playing', 'paused' or 'stopped'.</td>
		            </tr>
		            
					<tr>
						<td>getCurrentIndex()</td>
						<td>Gets the index of the current slide.</td>
		            </tr>
		            
					<tr>
						<td>getSlideAt(index)</td>
						<td>Gets all the data of the slide at the specified index. Returns an object that contains all the data specified for that slide.</td>
		            </tr>
		            
					<tr>
						<td>getTriggerType()</td>
						<td>Returns a string that indicates what triggered the slider to navigate to a different slide. Possible values are: 'none', 'previousButton', 'nextButton', 'button', 'slideshow' and 'thumbnail'.</td>
		            </tr>
					<tr>
						<td>isTransition()</td>
						<td>Checks if the slider is in the transition phase. Returns true or false.</td>
		            </tr>
		            
					<tr>
						<td>totalSlides()</td>
						<td>Returns the total number of slides.</td>
		            </tr>
		            
					<tr>
						<td>getSize()</td>
						<td>Returns an object that contains the width and height of both the slider and the slide. The returned object has the following properties: sliderWidth, sliderHeight, slideWidth and slideHeight.</td>
		            </tr>
					
					<tr>
						<td>destroy()</td>
						<td>Stops all running actions. It's recommended to call this method before removing the slider from the DOM.</td>
		            </tr>
				</tbody>
				
			</table>


			<p>When you want to call one of these action you need to use the unique identifier you set in the custom class field. Example: $('.my-slider').advancedSlider().nextSlide();</p>
			
			<h5>Callbacks</h5>
	
		  	<p>The callbacks, or events, are useful for detecting when certain actions take place. For example we can detect when a transition is complete or when a slide was clicked. Below is a list of all the available callbacks.</p>
			
			
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Callback Name</th>
						<th>Description</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td>sliderInit</td>
						<td>Triggered after the slider was instantiated.</td>
		            </tr>
            
		        	<tr>
						<td>transitionStart</td>
						<td>Triggered when a transition starts.</td>
		            </tr>
					
					<tr>
						<td>transitionComplete</td>
						<td>Triggered when a transition is complete.</td>
		            </tr>
		            
					<tr>
						<td>slideRequest</td>
						<td>Triggered when a slide is requested/called.</td>
		            </tr>
		            
					<tr>
						<td>slideClick</td>
						<td>Triggered when a slide is clicked.</td>
		            </tr>
		            
					<tr>
						<td>slideMouseOver</td>
						<td>Triggered when the mouse is rolled over a slide.</td>
		            </tr>
		            
					<tr>
						<td>slideMouseOut</td>
						<td>Triggered when the mouse is rolled out of a slide.</td>
		            </tr>
					
					<tr>
						<td>thumbnailClick</td>
						<td>Triggered when a thumbnail is clicked.</td>
		            </tr>
					
					<tr>
						<td>thumbnailMouseOver</td>
						<td>Triggered when the mouse is rolled over a thumbnail.</td>
		            </tr>
					
					<tr>
						<td>thumbnailMouseOut</td>
						<td>Triggered when the mouse is rolled out of a thumbnail.</td>
		            </tr>
					
					<tr>
						<td>videoPlay</td>
						<td>Triggered when a video starts playing.</td>
					</tr>
					
					<tr>
						<td>videoPause</td>
						<td>Triggered when a video is paused.</td>
					</tr>
					
					<tr>
						<td>videoEnd</td>
						<td>Triggered when a video ends.</td>
					</tr>
					
					<tr>
						<td>videoFullscreenChange</td>
						<td>Triggered when the fullscreen state of a video changes.</td>
					</tr>
					
					<tr>
						<td>xmlLoaded</td>
						<td>Triggered when the XML file is completely loaded.</td>
		            </tr>
					
					<tr>
						<td>doSliderLayout</td>
						<td>Triggered when the layout is modified.</td>
		            </tr>
				</tbody>
			</table>
					
		         
		 	<p>Most of these callback functions will return an object that contain certain information. The slide related callbacks, for example, will contain information about the slide that triggered the event. The information contained is the index of the slide(0, 2, 5 etc.), the type of event(slideClick, transitionComplete etc.) and a 'data' object that contains all the slide's information that was specified for that slide. You can use a callback function as you see in the example below:</p>

<pre class="prettyprint linenums">
jQuery(document).ready(function($) {
    $('.my-slider').advancedSlider().settings.transitionComplete = function(obj) {
        console.log('You are viewing slide ' + obj.index);
        console.log(obj.type, obj.data);
    };


    $('.my-slider').advancedSlider().settings.doSliderLayout = function(obj) {
        console.log($('.my-slider').advancedSlider().getSize());
    };
});
</pre>


			<p>The cases when you'll need to use the slider's JavaScript API are very rare because Slider PRO already offers you easier ways to achieve a lot of functionality. However, just in case you need to use the slider in a different way, not covered by the slider's easy to use features, you have access to the above API which will allow you to achieve almost any kind of functionality.</p>

		</div>
	</div>

	<div class="alert alert-info"> <strong>NOTE:</strong> In order to add custom JavaScript code, the 'custom' folder (/wp-content/plugins/slider-pro/custom) needs to be writeable. On some servers this means that the folder has to have the permission set to 755 but on other servers it has to have the permission set to 777. I recommed to check with your webhost what would be the best permission setting for making the folder writeable.</div>

	<hr />

	<h3 id="miscellaneous9">9. Transferring the slider</h3>
	<div class="row">
		<div class="span12">
			<p>When you move a slider installation from a domain to another one, you will need to update the skin's database information, by clicking the 'Refresh All Skins' button inside 'Slider PRO -> Skin Editor'.</p>
			<p>Another important thing to know is that you shouldn't manually edit the slider's database content, like image paths. The content inside the database is serialized and trying to edit it directly in the database will cause some issues. Instead, when you try to update or replace some image paths or any other content, I recommend using a specialized plugin, like <a href="http://interconnectit.com/124/search-and-replace-for-wordpress-databases/">Search Replace DB</a>. This is a smart plugin that can replace data in the database even if that data is serialized or using another format.</p>
		</div>
	</div>	
	
	<hr />

	<h3 id="miscellaneous10">10. Open the slider in a lightbox</h3>
	<div class="row">
		<div class="span7">
			<p>In order to load a slider instance in a lightbox you need to do 2 things:</p>
			<ul>
				<li>insert the [slider_pro_lightbox] shortcode in the post/page where the lightbox will be opened</li>
				<li>add the "slider-pro-lightbox-ID" class to the element that will open the lightbox. The ID from the class represents the ID of the slider</li>
			</ul>
			
			<p>If you need a PHP method to load the lightbox slider, you can use &lt;?php slider_pro_lightbox();?&gt;</p>
		</div>
		
		<div class="span5">
<pre class="prettyprint linenums">
[slider_pro_lightbox id="3"]

&lt;a class="slider-pro-lightbox-3"&gt;Click Me&lt;/a&gt;
</pre>
		</div>
	</div>

</section>


<hr />


<section id="troubleshooting">
	<div class="page-header">
		<h1>Troubleshooting <small>Answers to some of the common problems</small></h1>
	</div>
	
	<p>If something doesn't work as expected, the first thing you need is a little patience :) and the assurance that you have my free assistance for resolving the problem. Please see if the indications below help, and if they don't please kindly email me and I'll gladly help you. You can reach me at <strong>contact@bqworks.com</strong></p>
	
	
	<h4 id="troubleshooting1">1. The slider doesn't appear on the page</h4>
	
	<p>First please make sure that your theme has the wp_head() and wp_footer() calls. These calls are used by many plugins, including this slider, to insert the necessary scrips in the page.</p>
	
	<p>The wp_head() call should be in the theme's header.php call just above &lt;/head&gt; :</p>

<pre class="prettyprint linenums">
&lt;?php wp_head(); ?&gt;
&lt;/head&gt;
</pre>

	<p>The wp_footer() call should be in the theme's footer.php call just above &lt;/body&gt; :</p>

<pre class="prettyprint linenums">
&lt;?php wp_footer(); ?&gt;
&lt;/body&gt;
</pre>
	
	<p>If the slider still doesn't work it's possible that it conflicts with another plugin or theme that doesn't follow WordPress development best practices. Although, it's not the slider's fault, I can help you sort out these kind of problem. Just email me (my email address is at the top of this help file) some WordPress and FTP credentials.</p>
    
	<hr />
	
	<h4 id="troubleshooting2">2. The slider loads but doesn't respond to input</h4>
    
    <p>It can happen when you're loading an older jQuery library in the page and use CSS3 transitions at the same time. In order for the CSS3 transitions to work, you need a recent release of the jQuery library, preferably version 1.7+. If you can't use a newer jQuery library, you will need to disable the CSS3 Transitions. This option can be found inside the Transition Effects sidebar panel.</p>
    
	<hr />

    <h4 id="troubleshooting3">3. The images are not loading</h4>
    
    <p>This is most likely a TimThumb related problem. TimThumb is a popular 3rd party script used for automatically resizing images and will work out of the box on most servers but on others it requires some 'special attention'. By default, the slider uses TimThumb only for creating the thumbnail images but it's not dependent on this script, so you can disable it from within the Slider PRO -> Plugin Options page. If TimThumb is disabled and you need thumbnail images, you will need to manually create them.</p>
	
	<p>There can be various reasons why a server won't allow TimThumb to run properly. First, please make sure that the 'cache' folder (/wp-content/plugins/slider-pro/includes/timthumb/cache) has the permission set to '755' or '777' (on some servers 777 is necessary). I recommed to check with your webhost what would be the best permission setting for making the folder writeable. Also, the GD library must be installed on the server. It's a very common PHP library and most of the times it's installed but on some servers it might be missing. If that's the case, please ask your hosting provider to install the GD library.</p>

	<p>If you're using HostGator as your hosting provider, you will need to contact them and request 'mod_security whitelisting'. Please read this: http://support.hostgator.com/articles/specialized-help/technical/timthumb-basics</p>
	
	<p>If the above solutions don't work please email me (my email address is at the top of this help file) some WordPress and FTP credentials and I'll take a closer look.</p>
    
	<hr />
	
    <h4 id="troubleshooting4">4. External images don't load, only uploaded images</h4>

    <p>The default TimThumb settings will not allow you to load external images. In order to enable this functionality, you will need to open the 'timthumb-config.php' file (/wp-content/plugins/slider-pro/includes/timthumb/timthumb-config.php), set the 'ALLOW_EXTERNAL' variable to true and then in the $ALLOWED_SITES specify the external domain where the images are located. If you want to load external image from any domain you can set the 'ALLOW_ALL_EXTERNAL_SITES' variable to true.</p>
	
	<hr />

	<h4 id="troubleshooting5">5. The self-hosted, HTML5 videos don't play</h4>

    <p>It can happen if the server is not configured to deliver the types of videos you're trying to play. In order to make this possible, open the .htaccess file from your site's root folder, or create it if it doesn't exist, and add the following lines:

<pre>
AddType video/ogg .ogm
AddType video/ogg .ogv
AddType video/ogg .ogg
AddType video/webm .webm
AddType audio/webm .weba
AddType video/mp4 .mp4
AddType video/x-m4v .m4v
</pre>

	<p>If the videos still don't play, it could happen because the server is set to not read the .htaccess file. In this case, you might need to contact the hosting provider and ask them to add the above mime types for you.</p>
	
	<hr />
	
    <h4 id="troubleshooting6">6. The slider appears broken on the homepage or when it's inserted in PHP code.</h4>
    
    <p>Most likely you will have to set the 'Include Skin' property, from the 'General' panel, to true. Normally, when the slider is added to a post or page, the skin's CSS file is automatically detected and included in the header only on the slider's page, but when using the slider outside the post/page, the WordPress API doesn't give you the possibility to efficiently detect the slider instance added to a page in order to add the necessary CSS file to the header, so you need specify that you want the CSS file included by checking the 'Include Skin' option.</p>
    
	<hr />
	
    <h4 id="troubleshooting7">7. I get an error when I create or update the slider</h4>

    <p>It can happen if the xml folder (/wp-content/plugins/slider-pro/xml) is not writeable. In order to make it writeable you might have to set its permission to 777. I recommed to check with your webhost what would be the best permission setting for making the folder writeable. If you still get an error after this edit, please contact your hosting provider and ask them if the XML-DOM library is installed. This library is used by the plugin to save each slider in an XML format, which allows you to export and import sliders. You can disable this feature, if you want, from within the Slider PRO -> Plugin Options page.</p>
	
	<hr />
	
    <h4 id="troubleshooting8">8. I get a notice that "something went wrong" when the slider is updated/created.</h4>

    <p>There are 3 possible reasons why you get the notice:</p>

    <p>1. You added too many slides, like 40, 50 or above. When this happens it means that some of the server's variables are set to low values and you will need to increase them. These variables can be found in the php.ini file, in case you have access to it. If not, please contact your hosting provider and ask them to increase the value for you. These are the variables that need to be increased:
    <ul>
    	<li>max_input_vars</li>
    	<li>post_max_size</li>
    	<li>suhosin.request.max_vars and suhosin.post.max_vars, if the server has suhosin installed</li>
    </ul>

    <p>2. You added an HTML form element inside. The slider's admin interface itself is a form, and having a form inside another form is not allowed and will cause problems. A workaround for this situation is to add the form using a shorcode.</p>

    <p>3. XML-DOM library is not installed. This potential problem is more difficult to detect but when none of the above situations apply, you can consider this problem. Your hosting provider will be able to confirm if the XML-DOM library is installed. This library is used by the plugin to save each slider in an XML format, which allows you to export and import sliders. You can disable this feature, if you want, from within the Slider PRO -> Plugin Options page.</p>

    <hr />
	
    <h4 id="troubleshooting9">9. The slider's options don't work</h4>
    
    <p>Please make sure you're setting the options correctly. There is a guide on how to do this <a href="#create2">here</a>. Basically this is the process of customizing the options: Click on the dropdown menu -> Select the options that you want to customize -> Click on the 'Display' button -> The option fields will appear bellow the dropdown -> Customize the options. The reasons why this process was implemented are presented <a href="#create2">here</a>.</p>

    <hr />

    <h4 id="troubleshooting10">10. The thumbnail image disappears when I insert a caption</h4>
    
    <p>Most likely, the theme uses some faulty code which modifies the default WordPress formatting. Usually it can be solved by wrapping the slider’s shortcode within the [raw] shortcode:</p>
    <pre>[raw][slider_pro id="1"][/raw]</pre>
    
	<hr />
	
	<h4 id="troubleshooting11">11. The changes are not saved when I update the slider</h4>
	
	<p>This issue is caused by cache plugins, like W3 Total Cache. My recommandation is to disable the caching functionality while you create content on your site but if this is not possible, it will be necessary to clear the browser cache each time you make changes to the slider.</p>

	<hr />

	<h4 id="troubleshooting12">12. Skins are missing from the slider's admin area</h4>
	
	<p>First, please make sure that the skins are not missing from wp-content/plugins/slider-pro/skins/. If they are missing, please copy them in that location. Then, please go to Slider PRO -> Skin Editor and click on the "Refresh All Skins" button.</p>

	<hr />

	<h4 id="troubleshooting13">13. Skins can't be replicated or custom CSS/JavaScript can't be saved</h4>
	
	<p>It can happen if the 'skins/slider' folder (/wp-content/plugins/slider-pro/skins/slider) or  the'custom' folder (/wp-content/plugins/slider-pro/custom) are not writeable. In order to make them writeable you might neet to change their permission to 777. I recommed to check with your webhost what would be the best permission setting for making the folder writeable.</p>

	<hr />

	<h4 id="troubleshooting14">14. When I create a dynamic slider, the images are not loading</h4>
	
	<p>Please make sure you're using the slider's dynamic tags (i.e. [sp_image]) in the slider's fields. For more details please see the <a href="#dynamic">Dynamic slides</a> chapter, especially the "Dynamic tags presentation" section.</p>

	<hr />

	<h4 id="troubleshooting15">15. Slider export file is not available</h4>
	
	<p>The export file, which is an XML representation of the slider, is created when a new slider is created or when it's updated. The file will be created only if the 'xml' folder (/wp-content/plugins/slider-pro/xml) is writable. In order to make it writeable you might neet to change the permission to 777. I recommed to check with your webhost what would be the best permission setting for making the folder writeable.</p>

	<p>If you're updating from a version older than 3.1, due to some changes introduced in version 3.1, you will need to click on the slider's 'Update slider' button in order to generate a new XML file.</p>

</section>


<hr/ >


<section id="changelog">
	<div class="page-header">
		<h1>Changelog<small> Presentation of all modified scripts, in each update</small></h1>
	</div>

	<h3>Files added or modified in version 2.3</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/includes &#9660;</b></li>
		<li>slider-pro/includes/general-lists.php</li>
		<li>slider-pro/includes/admin-lists.php</li>
		<li>slider-pro/includes/help/help.php</li>
		<li><b>slider-pro/js &#9660;</b></li>
		<li>slider-pro/js/slider-pro-admin.js</li>
		<li>slider-pro/js/slider-pro-lightbox.js</li>
		<li>slider-pro/js/editor-plugin.js</li>
		<li>slider-pro/js/slider-pro-admin.js</li>
		<li>slider-pro/js/slider/jquery.advancedSlider.min.js</li>
		<li>slider-pro/js/slider/jquery.videoController.min.js</li>
		<li>slider-pro/js/slider/dev/jquery.advancedSlider.js</li>
		<li>slider-pro/js/slider/dev/jquery.videoController.js</li>
		<li>slider-pro/js/tinymce/plugins/sliderprovideo/editor_plugin.js</li>
		<li><b>slider-pro/css &#9660;</b></li>
		<li>slider-pro/css/slider-pro-admin.css</li>
		<li>slider-pro/css/slider-pro-lightbox.css</li>
		<li>slider-pro/css/slider/advanced-slider-base.css</li>
		<li>slider-pro/css/slider/images/fullscreen.png</li>
	</ul>
	
	<h3>Files added or modified in version 2.3.1</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li>slider-pro/js/slider/jquery.advancedSlider.min.js</li>
		<li>slider-pro/js/slider/dev/jquery.advancedSlider.js</li>
		<li>slider-pro/css/slider-pro-admin.css</li>
	</ul>

	<h3>Files added or modified in version 3.0.0</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/includes &#9660;</b></li>
		<li>slider-pro/includes/general-lists.php</li>
		<li>slider-pro/includes/admin-lists.php</li>
		<li>slider-pro/includes/sliders.php</li>
		<li>slider-pro/includes/slider.php</li>
		<li>slider-pro/includes/slide.php</li>
		<li>slider-pro/includes/layer-settings.php</li>
		<li>slider-pro/includes/slider-pro-widget.php</li>
		<li>slider-pro/includes/slider-activate.php</li>
		<li>slider-pro/includes/plugin-options.php</li>
		<li>slider-pro/includes/posts-data-fields.php</li>
		<li>slider-pro/includes/help/help.php</li>
		<li><b>slider-pro/js &#9660;</b></li>
		<li>slider-pro/js/slider-pro-admin.js</li>
		<li>slider-pro/js/slider-pro-lightbox.js</li>
		<li>slider-pro/js/slider/jquery.advancedSlider.min.js</li>
		<li>slider-pro/js/slider/jquery.videoController.min.js</li>
		<li>slider-pro/js/slider/dev/jquery.advancedSlider.js</li>
		<li>slider-pro/js/slider/dev/jquery.videoController.js</li>
		<li>slider-pro/js/tinymce/plugins/sliderprovideo/editor_plugin.js</li>
		<li><b>slider-pro/css &#9660;</b></li>
		<li>slider-pro/css/slider-pro-admin.css</li>
		<li>slider-pro/css/slider-pro-lightbox.css</li>
		<li>slider-pro/css/slider/advanced-slider-base.css</li>
		<li>slider-pro/css/slider/images/video_play.png</li>
		<li><b>slider-pro/languages &#9660;</b></li>
		<li>slider-pro/languages/slider_pro.po</li>
		<li>slider-pro/languages/slider_pro.mo</li>
		<li><b>slider-pro/skins/slider &#9660;</b></li>
		<li>all skins</li>
	</ul>

	<h3>Files added or modified in version 3.0.1</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/css &#9660;</b></li>
		<li>slider-pro/css/images/blank.gif</li>
	</ul>
	
	<h3>Files added or modified in version 3.0.2</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/js &#9660;</b></li>
		<li>slider-pro/js/jquery.multiselect.min.js</li>
		<li>slider-pro/js/dev/jquery.multiselect.js</li>
	</ul>

	<h3>Files added or modified in version 3.5</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/includes &#9660;</b></li>
		<li>slider-pro/includes/slider-activate.php</li>
		<li>slider-pro/includes/plugin-options.php</li>
		<li>slider-pro/includes/sliders.php</li>
		<li>slider-pro/includes/slider.php</li>
		<li>slider-pro/includes/slide.php</li>
		<li>slider-pro/includes/slider-update.php</li>
		<li>slider-pro/includes/admin-lists.php</li>
		<li>slider-pro/includes/import-slider-form.php</li>
		<li>slider-pro/includes/general-lists.php</li>
		<li>slider-pro/includes/layer-settings.php</li>
		<li>slider-pro/includes/export.php</li>
		<li>slider-pro/includes/edit-custom-js-css.php</li>
		<li>slider-pro/includes/skin-editor.php</li>
		<li>slider-pro/includes/help/help.php</li>
		<li><b>slider-pro/js &#9660;</b></li>
		<li>slider-pro/js/slider-pro-admin.js</li>
		<li>slider-pro/js/slider-pro-lightbox.js</li>		
		<li>slider-pro/js/slider/jquery.advancedSlider.min.js</li>
		<li>slider-pro/js/slider/jquery.prettyPhoto.custom.min.js</li>
		<li>slider-pro/js/slider/jquery.touchSwipe.min.js</li>
		<li>slider-pro/js/slider/dev/jquery.advancedSlider.js</li>
		<li>slider-pro/js/slider/dev/jquery.videoController.js</li>
		<li>slider-pro/js/slider/jquery.prettyPhoto.custom.js</li>
		<li>slider-pro/js/slider/jquery.touchSwipe.js</li>
		<li><b>slider-pro/css &#9660;</b></li>
		<li>slider-pro/css/slider-pro-admin.css</li>
		<li>slider-pro/css/slider-pro-lightbox.css</li>
		<li>slider-pro/css/slider/advanced-slider-base.css</li>
		<li><b>slider-pro/languages &#9660;</b></li>
		<li>slider-pro/languages/slider_pro.po</li>
		<li>slider-pro/languages/slider_pro.mo</li>
	</ul>
	
	<h3>Files added or modified in version 3.5.1</h3>
	<ul class="custom-list">
		<li>slider-pro/slider-pro.php</li>
		<li><b>slider-pro/includes &#9660;</b></li>
		<li>slider-pro/includes/help/help.php</li>
		<li><b>slider-pro/js &#9660;</b></li>
		<li>slider-pro/js/slider-pro-admin.js</li>	
		<li>slider-pro/js/slider/jquery.advancedSlider.min.js</li>
		<li>slider-pro/js/slider/dev/jquery.advancedSlider.js</li>
		<li><b>slider-pro/css &#9660;</b></li>
		<li>slider-pro/css/slider-pro-admin.css</li>
	</ul>
	
</section>

</div>