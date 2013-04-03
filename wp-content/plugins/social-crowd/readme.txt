=== Social Crowd ===
Contributors: bdoga, tdawg2
Plugin URI: http://www.macnative.com/development/socialCrowd
Author URI: http://www.macnative.com
Donate link: http://www.macnative.com/development/donate 
Tags: social, network, networks, count, friends, crowd, clan, contacts, display, show, vanity, stats, statistics, followers, readers, facebook, google+, google plus, linkedin, linked in, twitter, feedburner, youtube, vimeo, number, raw
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: 0.8.7

Social Crowd retrieves the count/number of Friends/Followers from your favorite social networks and displays them throughout your blog

== Description ==

The Social Crowd Plugin grabs the latest counts of your Friends/Fans/Followers etc from your Favorite Social Networks and then displays them on your Blog. The counts that are reported come raw and without styling, so you can make them look and feel like your website. It is the perfect solution to encourage more users to join your network.

**Important:** This plugin **REQUIRES** the PHP Curl Module in order to function. Please make sure it is installed.

#### Supported Networks:

* Facebook
* Google+ (Alpha Support)
* Twitter
* Linked In (Alpha Support)
* Youtube
* Vimeo
* Feedburner


#### Plugin Usage

**Feedburner Instructions**
If you wish to use the Feedburner stats you must enable access by logging into your Feedburner admin panel http://feedburner.google.com, selecting the feed you want Social Crowd to access, Click on the "Publicize" tab, Select "Awareness API" from the Sidebar, and then click the "Activate" button. This will allow Social Crowd to correctly acquire your Feedburner stats and display them for you.


**Basic Usage**

After setting up the options on the 'Social Crowd Options' page in the wordpress administrator (setting the Social Networks that you want to collect stats from), you can go to the Widgets manager and enable the 'Social Crowd' widget. This widget will automatically display the networks that you have selected on the options page, with some limited customizability, and you are good to go.

**Intermediate Usage**

After configuring the options as indicated in the 'basic usage' above, you can enable the 'Social Crowd Advanced' widget in the widget administrator. This widget gives you the ability to specifically select the networks that you want to display in the widget area, and also allows you to customize the text that is displayed with the stats. 

Additionally there is a shortcode that allows you to access the stats and output them throughout your posts and pages. 
The shortcode is used as follows:

[SC_Stats type=network]

where network is the social network that you want to display stats for ie: 'facebook', 'twitter', etc... or any of the available stats listed in the 'Available Stats' list below. If you do not include a 'type' of network in the shortcode it will return your facebook stat count by default.

**Advanced (Designer/Developer) Usage**

The Social Crowd Plugin provides function calls that you can use throughout your theme files to better promote your or your clients social networks. The function documentation is as follows.
 
The Social Crowd function you will call is:

	SocialCrowd_Stats();

You have two options: 

* Calling the function with a specific network:
	1. Place the function wherever you want the data to be displayed. 
	1. Call the function with a specific network name (all lowercase):
		* SocialCrowd_Stats('facebook')
		* SocialCrowd_Stats('twitter')
		* SocialCrowd_Stats('youtube')
		* etc...
	1. Function will echo out the requested Network Stats.

* Calling the function without a specific network:
	1. Place the function anywhere you want.
	1. Call the function with no options.
		$stats = SocialCrowd_Stats()
	1. The function will return an array with the stats for all your networks.
	1. the array is an associative array that you can you can access like so:
		* $stats['facebook']
		* $stats['twitter']
		* $stats['youtube']
		* etc...


#### Available Stats

The available stats are listed in the following order: 
Type of statistic ('keyword'), use the keyowrd in the Social Crowd function to retrieve the desired content. 

* Feedburner subscriber count  (' **feedburner** ')  *Number of subscribers to your feed.*
* Facebook Friend/Like Count  (' **facebook** ')  *Number of friends or page likes.*
* Twitter Follower Count  (' **twitter** ')  *Number of followers.*
* Twitter Friend Count  (' **twitterFriends** ')  *Number of Friends you have.*
* Twitter Statuses Count  (' **twitterStatuses** ')  *Number of status updates you have sent.*
* Twitter Listed Count  (' **twitterListed** ')  *Number of lists you have been added to.*
* Youtube Friend Count  (' **youtube** ')  *Number of friends on Youtube.*
* Youtube Subscriber Count  (' **youtubeSubscribers** ')  *Number of Youtube subscribers.*
* Youtube Viewed Count  (' **youtubeViews** ')  *Number of videos you have viewed.*
* Youtube Uploaded Views Count  (' **youtubeUploadViews** ')  *Number of views your uploaded videos have had on Youtube.*
* Vimeo Friend Count  (' **vimeo** ')  *Number of friends you have on Vimeo.*
* Vimeo Uploads Count  (' **vimeoUploads** ')  *Number of videos you have uploaded to Vimeo.*
* Vimeo Appears In Count  (' **vimeoAppearsIn** ')  *Number of videos you appear in on Vimeo.*
* Vimeo Likes Count  (' **vimeoLikes** ')  *Number of videos that you have liked on Vimeo.*
* Google+ Your Circles Count  (' **gplusCircles** ')  *Number of people that you have in your circles.*
* Google+ Others Circles Count  (' **gplusInCircles** ')  *Number of people that have you in their circles.*
* Linked In Connections  (' **linkedIn** ')  *Number of Connections.*

I hope to expand this list to include your favorites ( just leave me some comments on the [plugin homepage][1] ). 

 [1]: http://www.macnative.com/development/social-crowd/

A big thanks to DeviantArt's jwloh for creating the Social.me and Aquaticus Icon Sets that is used in the plugin's Administrator and Widgets, You can check out [his work][2].

 [2]: http://jwloh.deviantart.com/

Other icons used with the Widget are:
[Elegant Media Icon Set][4]
[4]: http://www.elegantthemes.com
[Picons Icon Set][5]
[5]: http://www.picons.me
[Social Balloon Icon Set][6]
[6]: http://www.doublejdesign.co.uk/
[Socialize Sticker Icon Set][7]
[7]: http://dryicons.com/free-icons/


== Installation ==

1. Unzip and upload the Social Crowd plugin folder to wp-content/plugins/
1. Activate the plugin from your WordPress admin panel.
1. Installation finished.

== Frequently Asked Questions ==

= My Facebook stats aren't showing up what's wrong =

 Your publicly available facebook stats are only available to the plugin if your Age Restrictions are set to anything other than "Anyone (13+)" [Read More Here][8]
[8]: http://wordpress.org/support/topic/plugin-social-crowd-facebook-likes-0

= My Favorite Social Network is not currently supported/working? =

Many social networks including LinkedIn, Google+, and many others require specific authentication to get the social stats. Currently this plugin does not support those networks officially. We hope in the near future to add the features necessary to provide those stats as well. 

= How do I customize the appearance of the widget? = 

In the widget options there is a checkbox titled 'Default Styling' if you uncheck that box, you can include the following CSS in your own css file with any required changes to apply your custom look and feel to the widget.

*Vertical Styling*
	<style type="text/css">
		#scWidget {
			margin-bottom: 10px;
		}
		#scWidget li.scItems {
			padding: 0px !important;
			clear: both;
		}
		#scWidget img {
			width:48px;
			height:48px;
			float:left;
			margin: 5px 10px;
		}
		#scWidget div {
			padding-top: 10px;
			float: left;
			font-size: 14px;
		}
		#scWidget div span {
			font-weight: bold;
		}
		#scBottom {
			margin: 5px 0 5px 20px;
			clear: both;
			font-size: 8px;
		}
		#scBottom a {
			
		}
	</style>
	
*Horizontal Styling* 
	
	<style type="text/css">
		#scWidget {
			margin-bottom: 10px;
			font-size: 14px;
		}
		#scWidget li.scItems {
			list-style: none !important;
			background: none !important;
			padding: 10px !important;
			display: inline;
			text-align: center;
			float: left;
			border-radius: 5px;
		}
		#scWidget li.scItems:hover {
			background: #EEE !important;
		}
		#scWidget img {
			width:48px;
			height:48px;
			float:none;
			margin: 0 5px;
		}
		#scWidget span {
			font-weight: bold;
		}
		#scBottom {
			margin: 5px 0 5px 20px;
			clear: both;
			font-size: 8px;
		}
		#scBottom a {
			
		}
	</style>

= How do I use the Horizontal Layout Shortcode/Function Call = 

If you would like to display the Social Crowd Stats outside of the provided widget you can now simply call the following php function or the associated shortcode to display your social stats throughout your website.

The Shortcode is:
	[SC_Horiz_Stats]

Simply place this anywhere within your posts or pages to display your Social Crowd Stats. By Default this will display all of the networks that you have enabled in the plugin administrator panel.

Shortcode Options:
	icons -> Icon Set to Use ie: icons=aquaticus (aquaticus, elegantmedia, picons, picons_inverted, socialballoon, socialize, socialme, socialnet)
	networks -> Comma Delimited List of Networks to display or (all) ie: networks=all or networks=facebook,twitter,google
	desctext -> Show Description Text ie: desctext=true or desctext=none
	includecss -> Include Default CSS Style ie: includecss=true
	newwindow -> Open Links in New Window ie: newwindow=true
	facebookicon -> URL for Facebook Icon (if none given default will be used)
	facebooktext -> Text Under the Facebook Icon (if none given default will be used)
	twittericon -> URL for Twitter Icon
	twittertext -> Text Under the Twitter Icon
	googleicon -> URL for Google+ Icon
	googletext -> Text Under the Facebook Icon
	linkedinicon -> URL for LinkedIn Icon
	linkedintext -> Text Under the Facebook Icon
	youtubeicon -> URL for Youtube Icon
	youtubetext -> Text Under the Facebook Icon
	vimeoicon -> URL for Vimeo Icon
	vimeotext -> Text Under the Facebook Icon
	feedburnericon -> URL for Feedburner Icon
	feedburnertext -> Text Under the Facebook Icon
	
	Example Usage: 
	[SC_Horiz_Stats icons=socialize desctext=false networks=facebook,twitter,feedburner,vimeo facebooktext=friends facebookicon=http://www.example.com/facebookicon.png ]
	

= How do I call the function =

The function that you will call is: 

	SocialCrowd_Stats();

You have two options: 

* Calling the function with a specific network:
	1. Place the function wherever you want the data to be displayed. 
	1. Call the function with a specific network name (all lowercase):
		* `<?php echo SocialCrowd_Stats('facebook') ?>`
		* `<?php echo SocialCrowd_Stats('twitter') ?>`
		* `<?php echo SocialCrowd_Stats('youtube') ?>`
		* etc...
	1. Function will echo out the requested Network Stats.

* Calling the function without a specific network:
	1. Place the function anywhere you want.
	1. Call the function with no options.
		$stats = SocialCrowd_Stats()
	1. The function will return an array with the stats for all your networks.
	1. the array is an associative array that you can you can access like so:
		* `<?php echo $stats['facebook'] ?>`
		* `<?php echo $stats['twitter'] ?>`
		* `<?php echo $stats['youtube'] ?>`
		* etc...

= What stats can I grab? =

#### Available Stats

The available stats are listed in the following order: 
Type of statistic ('keyword'), use the keyowrd in the Social Crowd function to retrieve the desired content. 

* Feedburner subscriber count  (' **feedburner** ')  *Number of subscribers to your feed.*
* Facebook Friend/Like Count  (' **facebook** ')  *Number of friends or page likes.*
* Twitter Follower Count  (' **twitter** ')  *Number of followers.*
* Twitter Friend Count  (' **twitterFriends** ')  *Number of Friends you have.*
* Twitter Statuses Count  (' **twitterStatuses** ')  *Number of status updates you have sent.*
* Twitter Listed Count  (' **twitterListed** ')  *Number of lists you have been added to.*
* Youtube Friend Count  (' **youtube** ')  *Number of friends on Youtube.*
* Youtube Subscriber Count  (' **youtubeSubscribers** ')  *Number of Youtube subscribers.*
* Youtube Viewed Count  (' **youtubeViews** ')  *Number of videos you have viewed.*
* Youtube Uploaded Views Count  (' **youtubeUploadViews** ')  *Number of views your uploaded videos have had on Youtube.*
* Vimeo Friend Count  (' **vimeo** ')  *Number of friends you have on Vimeo.*
* Vimeo Uploads Count  (' **vimeoUploads** ')  *Number of videos you have uploaded to Vimeo.*
* Vimeo Appears In Count  (' **vimeoAppearsIn** ')  *Number of videos you appear in on Vimeo.*
* Vimeo Likes Count  (' **vimeoLikes** ')  *Number of videos that you have liked on Vimeo.*
* Google+ Your Circles Count  (' **gplusCircles** ')  *Number of people that you have in your circles.*
* Google+ Others Circles Count  (' **gplusInCircles** ')  *Number of people that have you in their circles.*
* Linked In Connections  (' **linkedIn** ')  *Number of Connections.*

I hope to expand this list to include your favorites ( just leave me some comments on the [plugin homepage][1] ).

= What if my favorite network isn't supported? =

[Drop me a line][3] and I will work on getting it added.
 [3]: http://www.macnative.com/contact-me/

== Screenshots == 

1. Admin Interface
2. Example Widget Output
3. Simple Widget Interface
4. Example Designer Custom Usage

== Changelog ==

= 0.8.7 [2012-10-16] =
* Updated for Wordpress 3.4.2
* Bugifx - Updated Twitter Stats API 

= 0.8.6 [2012-06-16] =
* Updated for Wordpress 3.4

= 0.8.5 [2012-04-25] =
* Updated for Wordpress 3.3.2

= 0.8.4 [2012-04-02] =
* Added Option to select specific stats for Google+, Twitter, Youtube, and Vimeo in the Advanced Widget
* Added feature that forces network stats update after changes made in the admin
* Changed admin menu title from "Social Crowd Options" to "Social Crowd"

= 0.8.3 [2012-03-26] =
* Added Option to open social networks in new window/tab for horizontal output shortcode

= 0.8.2 [2012-03-26] =
* Fixed a minor issue that stopped the default CSS from being removed in certain situations

= 0.8.1 [2012-03-26] =
* Added option to disable default CSS in horizontal output shortcode

= 0.8 [2012-03-07] =
* Added a much requested horizontal layout for the widgets
* Added php function call and shortcode to add the same horizontal layout throughout your site

= 0.7.4 [2012-02-25] =
* Added option in advanced widget to have social network links open in a new window.
* Added widget links to the social network icons.

= 0.7.3 [2012-02-18] =
* Bugfix for Google+ Algorithm to correct problems grabbing Google+ stats.

= 0.7.2 [2012-02-17] =
* Added new instructions on how to fix the issue many have had with Feedburner

= 0.7.1 [2012-02-2] =
* Bugfix for Linked-In Profiles - Now adding full url in admin to retrieve correct profile data
* Added Check for CURL module and indicator to show wether it is loaded

= 0.7 [2012-01-30] =
* Fix Minor UI issue in the plugin Admin.
* Added capacity to insert full url in the profile ID fields of the Admin panel, for ease of use for some users (based on feedback)

= 0.6 [2012-01-25] =
* Added Settings link on the Plugin Administration Panel for easy access
* Added (Beta) Linked In Support

= 0.5 [2012-01-19] =
* Added Shortcode to access stats more easily in posts and pages
* Added Widget to make it very easy to share your stats with others
* Added Widget with Advanced Options
* Added (Beta) Google+ support

= 0.2 [2011-06-08] =
* Added additional statistics gathering for Twitter, Youtube, and Vimeo.
* Added additional detail and information in the Readme file. 
* Small UI tweaks to the Admin.

= 0.1 [2011-05-17] = 
* Initial Release

== Upgrade Notice == 

= 0.8.4 =
Added capacity to specify the type of stats displayed in the Advanced Widget.

= 0.8 =
Added new widget layouts and a new shortcode.

