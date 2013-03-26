=== Smooth Slider ===
Contributors: internet techies, slidervilla
Tags: responsive,slideshow,featured,posts,jquery,slider,content,widget,shortcode,carousel,css,simple,thumbnail,image,post,sidebar,plugin,page,category,wpmu,site,blogs,style,home,categories,picture,flash,gallery
Donate link: http://www.clickonf5.org/go/smooth-slider/ 
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: 2.4
License: GPLv2 or later

== Description ==

Smooth Slider is a Wordpress Plugin for creating a dynamic slideshow/s for featured Posts, Pages, Media Images and Custom Post Types on a WordPress site. 

**Find advanced WordPress Slider Plugins at [SliderVilla](http://www.slidervilla.com/)**

= Features =

* Supports Responsive Design
* Six transition effects ( Fade transition supported )
* Custom Slider, Category Slider and Recent Posts Slider supported ( Template tags, Shortcode and Widget available )
* Slider Preview in admin panel 
* Search Engine Optimized Slideshow
* Full control over the looks thru the Settings Panel
* Permission setting option to restrict the users from adding posts to Smooth Slider
* The posts/pages/media library images/custom post types added to the slider can be re-ordered
* No Need Of Knowledge of PHP, HTML or CSS. But for those having knowledge of CSS, you can create your own stylesheet.
* Slides can be removed from the slider in single click thru 'Sliders' admin panel

[Plugin Home Page](http://slidervilla.com/smooth-slider/) | 
[Demo](http://www.clickonf5.org/) | 
[Plugin Documentation](http://guides.slidervilla.com/smooth-slider/) 

**Smooth Slider is now Add-ons compatible. You can check more info on Plugin Home Page (link above)**

1. Taxonomy Add-on
2. Gallery Add-on


== Installation ==
There's 3 ways to install this plugin:

= 1. The super easy way =
1. In your Admin, go to menu Plugins > Add
1. Search for Smooth Slider
1. Click to install
1. Activate the plugin
1. A new menu `Smooth Slider` will appear in your Admin

= 2. The easy way =
1. Download the plugin (.zip file) on the right column of this page
1. In your Admin, go to menu Plugins > Add
1. Select the tab "Upload"
1. Upload the .zip file you just downloaded
1. Activate the plugin
1. A new menu will appear in your Admin

= 3. The old way (FTP) =
1. Unzip the downloaded .zip file
1. Upload `smooth-slider` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. A new menu will appear in your Admin

### Usage ###

1. If you want the slideshow with all the added featured posts on your home page, open Index.php file from Dashboard by clicking on Tab Appearance / Editor and paste the following piece of code at the suitable place. 

    if ( function_exists( 'get_smooth_slider' ) ) {
       get_smooth_slider(); }

    If you want to put the slider before the list of articles on your Wordpress blog homepage, put the above piece of code before the Wordpress Loop (the code is a php code, so ensure that it is enclosed within the php tags). Wordpress loop code is shown below:

    if(have_posts()) : while(have_posts()) : the_post();

2. There is ready to use widget named 'Smooth Slider Widget - Simple', that you can directly use in your widgetized area of the theme. In case you use multiple sliders  feature you can as well select the slider name from the dropdown on the widget.

3. You can use the Smooth Slider shortcode [smoothslider] or [smoothslider id='1'] on your edit post/page panel to insert the slider anywhere on the post or page. In case you use multiple sliders feature, just replace the 'id' with your required slider's 'ID' that you would find on Sliders admin panel(settings).

4. The content in the slider can be picked up from either the post content or the post excerpt or a custom field slider_content. You can add the custom field on the Edit Post panel for each of the posts. 

5. It is very easy to select which image you want as the thumbnail for the slides. You can choose to get the image from custom field, or 'Post thumbnail' or from the post content. 

6. Almost all the fields that appear in the Smooth Slider are customizable, you can change the looks of your Slider and make it suitable for your theme. The defaults set are according to the Default Wordpress theme. Also, you can change the number of posts appearing in the slider and the pause or interval between the two consecutive posts on the slider. For making these changes, there would be  a settings page for Smooth Slider in the wp-admin screen of your blog, once you enable the plugin.

7. To get the category specific posts in reverse chronological order, use the following piece of code (template tag) at the necessary place in your theme's template file.

    if ( function_exists( 'get_smooth_slider_category' ) ) {
       get_smooth_slider_category('apple'); }
   
    where 'apple' is the slug (url friendly version of the category name) of the category from which you want to extract the posts to be shown in the slider. Replace it with your own category slug and you are done.


For more documentation go to [Smooth Slider Documentation](http://guides.slidervilla.com/smooth-slider/)

**Find More Advanced Slider Styles at [SliderVilla](http://www.slidervilla.com/)**

== Upgrade Notice ==

= Before Upgrading =

* Note the Title and Content fonts on your old Smooth Slider. 
* Go to 'Settings' panel and 'Save Changes'.
* Recheck the Slider Title, Post Title and the Slider Content fonts on the Settings Panel.

[Get older versions](http://wordpress.org/extend/plugins/smooth-slider/download/)

!!IMP!! If you have highly customized Smooth Slider, Before upgrading to 2.4, save your CSS and Settings. You may lose some CSS formatting as in the new versions the slider javascript is changed and is different from previous versions.

== Frequently Asked Questions ==

1. In case you have upgraded from previous versions (<= 2.3.2) using WordPress automatic upgradation, and the plugin is not working, please deactivate and reactivate the plugin. 
2. Also, in case you are still getting list of the entries, please go to the Smooth Slider Settings page and just 'Save' the settings. Check if the settings Miscellaneous => Smooth Slider Styles to use on other than Post/Pages is equal to default. Then save the settings.
 
Check the other FAQs on Smooth [Slider Documetation on SliderVilla](http://guides.slidervilla.com/smooth-slider/). 

== Screenshots ==

1. Demo of Smooth Slider
2. A brief view of Settings panel
3. Add post/Page to Smooth slider along with other edit panel options


== Changelog ==

Version 2.4 (09/10/2012)

1. New: Smooth Slider now Supports Responsive Design Layout
2. New: Shortcode for Category Slider
3. New: Template tag and Shortcode for Recent Posts Smooth Slider
4. New: Changes to Support Fade and a couple more transitions
5. New: Changes to Settings Panel design
6. New: Compatible with SliderVilla add-ons
7. Fix: Fixed the bug that Smooth Slider slides got jumbled up and Slider looked empty when the Chrome or Safari browser was zoomed in.
8. Fix: Now the slider_style Custom Field or Post Meta will not appear for each Post or Page saved. This field was automatically created and displayed under the Custom Fields metabox on Edit Post/Page panel inprevious version of Smooth Slider.

Version 2.3.5 (06/13/2011)

1. Fix: An extra div tag at the end of the slider html was causing the slider break on Safari in a particular case. Thanks to Michael Preisner for pointing out the issue.
2. Fix: On new pages, posts, the default slider sltysheet should be the one selected thru Smooth Slider settings and not the actual 'default' stylesheet.
3. Fix: noscript tags should have the text enclosed in 'p' tags to make Smooth Slider validate on XHTML strict. Thanks to Martin Wilcke for pointing this out.
4. Fix: The shortcode stripping was not working when there was an immediate anchor tag within the shorcodes. Rectified this bug. Thanks to Oscar of Innovacionweb for pointing this issue.
5. Fix: Using the WP Minify 1.1.6 plugin with Smooth Slider 2.3.4.1 caused a 400 Bad Request error and the resulting html page ended up with no composite CSS file since Minify failed. This was in a special case when the slider is embedded on single page or a post and you updated from the older version of Smooth Slider (2.3.2 or less) to new version. Added a fix for this. Thanks to Doug Foster of theideamechanics.com for pointing this out. 
6. New: Option to enable the 'Flash of Unstyled content' while page load, which is disable by default. By default the slider will load once complete DOm elements are loaded (html page is ready to be served). Due to this default setting, some users feel that slider is loading slow. 

Version 2.3.3 (04/24/2011)

1. Fix: Slider was not working on upgrade from older versions to version 2.3.3

Version 2.3.3 (04/16/2011)

1. Randomize the slides in Slider
2. Translation ready
3. Multiple sliders can have different titles
4. No script text option

Version 2.3.2 (10/13/2010)

Minor fix to release of version 2.3
1. Fix: Pages added to Smooth Slider were not displayed. Smooth Slider was turning empty. Fixed this issue
2. Along with posts, pages and media images, Smooth Slider now supports Custom Post Types

Version 2.3.1 (10/13/2010) 

Minor upgrade to fix small issues with 2.3

1. Plugin compltibility will be now from WordPress 2.9 i.e. you should upgrade to Version 2.3 only if you hav WordPress 2.9 and above.
2. Fixed: For those using Smooth Slider previous versions, some were facing issue with the loading of stylesheets and script specific to slider. Fixed it.
3. Fixed: For some servers content was not pulled from the posts. 

Version 2.3 (10/12/2010)

1. New - Smooth Slider Widget 
2. New - Smooth Slider Shortcode 
3. New - Slides can now be re-ordered thru the 'Slider Admin Panel'
4. New - Images existing and new images added to WordPress Media Gallery can be added to Smooth Slider along with posts and pages.
5. New - Now images in the slider can be extracted in very intelligent manner. Added support for 'Post Thumbnails (WP 2.9+)'.
6. New - Videos can be embedded in the slider. Ad can be added to the slider.
7. New - Some slides can be linked to a webpage and others can be without a link as well. 
8. New - Multiple settings to the sliders on different pages thru CSS files.
9. Fixed - Scheduled Posts issue
10. Fixed - Image Caption Issue
11. Fixed - Retain HTML tags issue
12. Fixed - Permissions issue (Who can add post/page and slides to the slider and who cannot)

Version 2.2 (12/24/2009)

1. New - Multiple Sliders can now be created from the settings page. Post/Pages can be selectively put in the slider of your choice. Also, you could decide  which post/page should display which slider (from the Edit Post/Page), though the page/single post template file contains regular Smooth Slider tag only.
2. New - Added an option to limit the content on the slider by 'words'. Previously it was only with number of characters due to which sometimes for some posts the last word on the slider was shown broken. Now you can use any of the two, either limit content by number of characters or number of words
3. Fix - Fixed the issue with get_smooth_slider_cat tag. There was a bug when this tag ws used for home page. Now it is working as per the specifications.
4. Fix - For using the custom images for navigation, there was an issue with 'getimagesize' php function for some servers. Removed this fuction and directly put options to specify the custom images height and width.
5. Fix - When the navigation numbers are used, there was some clicking issue, like the numbers needed to be douoble clicked in order to go to that slide number. This issue was observed with some installations of Smooth Slider (like on demo page). Hopefully this would get fixed with this release.
6. Fix - Changed the name of the database table from slider to smooth_slider to avoid any database conflicts and be more specific

Version 2.1.2 (11/26/2009)

1. New - Added an option to change the transition speed between two slides. Now you can control the speed with which one slide slides off and another slides in.
2. New - Added an option to enable the autostepping or autosliding or disable it.
3. Fixed - A blank slide appeared on the slider if the post which is in slider is deleted from wp-admin. Fixed the issue, now if the post which is also in slider is deleted, then it will also be removed from the slider, fixing the blank slide issue
4. Fixed - The scheduled or draft post placed into the slider will not appear on the actual slider. It will appear only in case when the post is published.
5. Fixed - WPMU issue with get_smooth_slider_wpmu_all that the post permalinks direct to a wrong url, that represents the current blog only, though the posts are pulled from other blogs. This issue is fixed in this version of Smooth Slider.

Version 2.1.1 (11/19/2009)

1. New - Added an option whether to crop images or not. This was essential after version 2.1 because, some of us use the images from other location than the wordpress installation. In that case timthumb does not operate

Version 2.1 (11/18/2009)

1. New - Now the images will not be sqashed to fit the size, rather they would be cropped properly. Used timthumb.Caution: Please use the images stored on the same domain on the slider.
2. New - A new custom field slide_redirect_url can now be specified to redirect the slide to anothr URL than the permalink
3. Fixed - Admin menu dropdown were getting stuck only on Smooth Slider settings page, fixed that issue

Version 2.0 (10/08/2009)

1. New - Now you can add pages to Smooth Slider along with posts
2. New - Images Original Size Option
3. New - Pick image from content or the custom field
4. New - New custom field implementation, to allow not to display images on selective posts
5. New - A new template tag to display Category specific posts on Smooth Slider
6. New - A new template tag for WPMU, to get slider posts from all over the WPMU site
7. New - Option to change “Read More” text and also put it in your language
8. New - Permission setting option to restrict the users from adding posts to Smooth Slider
9. New - Remove posts and pages from Smooth Slider selectively from the settings page itself
10. New - Option to retain specific html tags in the slider posts
11. New - Option to specify custom text or html in place of navigation numbers or buttons
12. Fix - Fixed issue of Smooth Slider settings page with Internet Explorer
13. New - Optimized Smooth Slider code internally
14. New - Smooth Slider complete uninstall on plugin Delete

Version 1.2 (09/22/2009)

1. New - Slider Preview in Smooth Slider setting page
2. New - Facility to set transparent background to the slider
3. New - Facility to Convert it to pure Image Slider 
4. New - Remove all the posts from Smooth Slider in one click
5. New - Custom Images in place of navigation numbers
6. Fixed - CSS id names and class name fixed, to avoid probable conflicts with theme styles and other plugin styles

Version 1.1 (09/14/2009)

1. New - Active Slide in the slideshow will now be highlighted with bolder and bigger navigation number
2. Fixed - Added No Script tag brosers not supporting JavaScript for showing the slideshow
3. Fixed - Issues with WordPress MU Smooth Slider Options update from setting page

Visit the plugin page to see the changelog and release notes.