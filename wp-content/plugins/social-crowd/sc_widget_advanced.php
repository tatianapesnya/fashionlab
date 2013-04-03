<?php
/*
Social Crowd Widget Advanced
This file contains the code for the Social Crowd Sidebar Widget Advanced Version.
*/

if (!class_exists('SC_Widget_Advanced')) :

	class SC_Widget_Advanced extends WP_Widget {


		function SC_Widget_Advanced() {
									
			// Widget settings
			$widget_ops = array('classname' => 'sc-widget-advanced', 'description' => 'Display Social Crowd Stats with Advanced Controls.');

			// Create the widget
			$this->WP_Widget('sc-widget-advanced', 'Social Crowd Advanced', $widget_ops);
		}
		
		
		function widget($args, $instance) {
			
			extract($args);
			
			// User-selected settings
			$title = $instance['title'];
			$icon_set = $instance['set'];
			$format = $instance['format'];
			$style = $instance['style'];
			$newWindow = $instance['newWindow'];
			$link = $instance['link'];
			$facebook = $instance['facebook'];
			$facebook_stat = $instance['facebook_stat'];
			$facebook_link = $instance['facebook_link'];
			$google = $instance['google'];
			$google_stat = $instance['google_stat'];
			$google_link = $instance['google_link'];
			$google_type = $instance['google_type'];
			$twitter = $instance['twitter'];
			$twitter_stat = $instance['twitter_stat'];
			$twitter_link = $instance['twitter_link'];
			$twitter_type = $instance['twitter_type'];
			$linkedin = $instance['linkedin'];
			$linkedin_stat = $instance['linkedin_stat'];
			$linkedin_link = $instance['linkedin_link'];
			$youtube = $instance['youtube'];
			$youtube_stat = $instance['youtube_stat'];
			$youtube_link = $instance['youtube_link'];
			$youtube_type = $instance['youtube_type'];
			$vimeo = $instance['vimeo'];
			$vimeo_stat = $instance['vimeo_stat'];
			$vimeo_link = $instance['vimeo_link'];
			$vimeo_type = $instance['vimeo_type'];
			$feedburner = $instance['feedburner'];
			$feedburner_stat = $instance['feedburner_stat'];
			$feedburner_link = $instance['feedburner_link'];

			$stats = SocialCrowd_Stats();

			// Before widget (defined by themes)
			echo $before_widget . $before_title . $title . $after_title;


				$siteurl = get_option('siteurl');
				$img_url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/images/';
				
				?>
				
				<?php 
				if($format == "vertical"){
				//display vertical widget layout
				if($style){
				?>
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
				<?php
				}
				?>
				<ul id="scWidget">
				<?php

				$sc_options = SocialCrowd_GetOptions();	
				
				if($instance['facebook']){
					?>
						<li class="scItems"><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/facebook.png" ?>" /></a><div><span><?php echo str_replace('%s', $stats["facebook"], $facebook_stat) ?></span><br /><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $facebook_link ?></a></div></li>
					<?php
				}
				
				if($instance['google']){
					?>
					<li class="scItems"><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/google.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats[$google_type], $google_stat) ?></span><br /><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $google_link ?></a></div></li>
					<?php
				}
				
				if($instance['twitter']){
					?>
					<li class="scItems"><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/twitter.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats[$twitter_type], $twitter_stat) ?></span><br /><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $twitter_link ?></a></div></li>
					<?php
				}
				
				if($instance['linkedin']){
					?>
					<li class="scItems"><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/linkedin.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats["linkedIn"], $linkedin_stat) ?></span><br /><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $linkedin_link ?></a></div></li>
					<?php
				}
				
				if($instance['youtube']){
					?>
					<li class="scItems"><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/youtube.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats[$youtube_type], $youtube_stat) ?></span><br /><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $youtube_link ?></a></div></li>
					<?php
				}
				
				if($instance['vimeo']){
					?>
					<li class="scItems"><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/vimeo.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats[$vimeo_type], $vimeo_stat) ?></span><br /><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $vimeo_link ?></a></div></li>
					<?php
				}
				
				if($instance['feedburner']){
					?>
					<li class="scItems"><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/feed.png" ?>" /></a><div ><span><?php echo str_replace('%s', $stats["feedburner"], $feedburner_stat) ?></span><br /><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><?php echo $feedburner_link ?></a></div></li>
					<?php
				}

			?>
			</ul>
			<?php
			}else{
				//display horizontal widget layout
				if($style){
				?>
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
				<?php
				}
				?>
				<ul id="scWidget">
				<?php

				$sc_options = SocialCrowd_GetOptions();	
				
				if($instance['facebook']){
					?>
						<li class="scItems"><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/facebook.png" ?>" /></a><br /><span><?php echo $facebook_stat ?></span><br /><?php echo $stats["facebook"] ?></li>
					<?php
				}
				
				if($instance['google']){
					?>
					<li class="scItems"><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/google.png" ?>" /></a><br /><span><?php echo $google_stat ?></span><br /><?php echo $stats[$google_type] ?></li>
					<?php
				}
				
				if($instance['twitter']){
					?>
					<li class="scItems"><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/twitter.png" ?>" /></a><br /><span><?php echo $twitter_stat ?></span><br /><?php echo $stats[$twitter_type] ?></li>
					<?php
				}
				
				if($instance['linkedin']){
					?>
					<li class="scItems"><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/linkedin.png" ?>" /></a><br /><span><?php echo $linkedin_stat ?></span><br /><?php echo $stats["linkedIn"] ?></li>
					<?php
				}
				
				if($instance['youtube']){
					?>
					<li class="scItems"><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/youtube.png" ?>" /></a><br /><span><?php echo $youtube_stat ?></span><br /><?php echo $stats[$youtube_type] ?></li>
					<?php
				}
				
				if($instance['vimeo']){
					?>
					<li class="scItems"><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/vimeo.png" ?>" /></a><br /><span><?php echo $vimeo_stat ?></span><br /><?php echo $stats[$vimeo_type] ?></li>
					<?php
				}
				
				if($instance['feedburner']){
					?>
					<li class="scItems"><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US" <?php echo ($newWindow) ? 'target="_blank"' : '' ?>><img src="<?php echo $img_url."large/".$icon_set."/feed.png" ?>" /></a><br /><span><?php echo $feedburner_stat ?></span><br /><?php echo $stats["feedburner"] ?></li>
					<?php
				}

			?>
			</ul>
			<?php
			}
			echo "<div id='scBottom'>";
			if($link){
				echo "<a href='http://www.macnative.com/development/social-crowd/'>Social Stats</a> Provided By <a href='http://www.macnative.com/development/social-crowd/'>Social Crowd</a>";
			}
			echo "</div>";
			// After widget (defined by themes)
			echo $after_widget;
		}

		
		function update($new_instance, $old_instance) {
			
			$instance = $old_instance;
//change the selection to use the plugin options, so that if it is enabled in the plugin it will display it in the widget.... may make it easier...
			$instance['title'] = $new_instance['title'];
			$instance['set'] = strip_tags( $new_instance['set'] );
			$instance['style'] = $new_instance['style'];
			$instance['format'] = $new_instance['format'];
			$instance['newWindow'] = $new_instance['newWindow'];
			$instance['link'] = $new_instance['link'];
			$instance['facebook'] = $new_instance['facebook'];
			$instance['facebook_stat'] = $new_instance['facebook_stat'];
			$instance['facebook_link'] = $new_instance['facebook_link'];
			$instance['google'] = $new_instance['google'];
			$instance['google_stat'] = $new_instance['google_stat'];
			$instance['google_link'] = $new_instance['google_link'];
			$instance['google_type'] = $new_instance['google_type'];
			$instance['twitter'] = $new_instance['twitter'];
			$instance['twitter_stat'] = $new_instance['twitter_stat'];
			$instance['twitter_link'] = $new_instance['twitter_link'];
			$instance['twitter_type'] = $new_instance['twitter_type'];
			$instance['linkedin'] = $new_instance['linkedin'];
			$instance['linkedin_stat'] = $new_instance['linkedin_stat'];
			$instance['linkedin_link'] = $new_instance['linkedin_link'];
			$instance['youtube'] = $new_instance['youtube'];
			$instance['youtube_stat'] = $new_instance['youtube_stat'];
			$instance['youtube_link'] = $new_instance['youtube_link'];
			$instance['youtube_type'] = $new_instance['youtube_type'];
			$instance['vimeo'] = $new_instance['vimeo'];
			$instance['vimeo_stat'] = $new_instance['vimeo_stat'];
			$instance['vimeo_link'] = $new_instance['vimeo_link'];
			$instance['vimeo_type'] = $new_instance['vimeo_type'];
			$instance['feedburner'] = $new_instance['feedburner'];
			$instance['feedburner_stat'] = $new_instance['feedburner_stat'];
			$instance['feedburner_link'] = $new_instance['feedburner_link'];

			return $instance;
		}
		
		
		function form($instance) {

			// Set up some default widget settings
			//$defaults = array('title' => 'Latest Tweets', 'username' => '', 'posts' => 5, 'interval' => 1800, 'date' => 'j F Y', 'facebook' => true, 'twitter' => true, 'feedburner' => true, 'youtube' => true, 'vimeo' => false);
			$defaults = array('title' => 'Join The Crowd', 'set' => 'aquaticus', 'format' => 'vertical', 'style' => true, 'newWindow' => false, 'link' => true, 'facebook' => true, 'facebook_stat' => '%s Likes', 'facebook_link' => 'Like Us on Facebook', 'google' => true, 'google_stat' => 'In %s Circles', 'google_link' => 'Add us on Google+', 'google_type' => 'gplusInCircles', 'twitter' => true, 'twitter_stat' => '%s Followers', 'twitter_link' => 'Follow us on Twitter', 'twitter_type' => 'twitter', 'linkedin' => true, 'linkedin_stat' => '%s Connections', 'linkedin_link' => 'Join Us On Linked In', 'youtube' => true, 'youtube_stat' => '%s Subscribers', 'youtube_link' => 'Watch us on Youtube', 'youtube_type' => 'youtubeSubscribers', 'vimeo' => true, 'vimeo_stat' => '%s Contacts', 'vimeo_link' => 'See us on Vimeo', 'vimeo_type' => 'vimeo', 'feedburner' => true, 'feedburner_stat' => '%s Readers', 'feedburner_link' => 'Read On Feedburner');
			$instance = wp_parse_args((array) $instance, $defaults);
?>
				
				
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>">Widget Title:</label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('set'); ?>">Icon Set:</label><br />
					<?php 
					$icon_sets = array("Aquaticus Icon Set" => "aquaticus", "Elegant Media Icon Set" => "elegantmedia", "Picons Icon Set" => "picons", "Picons Inverted Icon Set" => "picons_inverted", "Social Balloon Set" => "socialballoon", "Socialize Icon Set" => "socialize", "Social.Me Icon Set" => "socialme", "Social Net Icon Set" => "socialnet");
					SocialCrowd_Make_Select($instance['set'],$icon_sets,"widefat",$this->get_field_id('set'),$this->get_field_name('set'));
					?>
					
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('format'); ?>">Layout:</label><br />
					<?php 
					$layouts = array("Horizontal" => "horizontal", "Vertical" => "vertical");
					SocialCrowd_Make_Select($instance['format'],$layouts,"widefat",$this->get_field_id('format'),$this->get_field_name('format'));
					?>
					
				</p>
				<b>Select Social Networks to Display</b><br>
				adding a '%s' in the "stats string" for any social network will cause the specific stat to be output in that position. (Only in the Vertical Layout)
				<p>
					
				<input class="checkbox" type="checkbox" <?php if ($instance['facebook']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>">
				<label for="<?php echo $this->get_field_id('facebook'); ?>">&nbsp;&nbsp;Display Facebook Stats</label><br />
				<label for="<?php echo $this->get_field_id('facebook_stat'); ?>">Facebook Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_stat'); ?>" name="<?php echo $this->get_field_name('facebook_stat'); ?>" value="<?php echo $instance['facebook_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('facebook_link'); ?>">Facebook Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" value="<?php echo $instance['facebook_link']; ?>"><br /><br />
				
				<input class="checkbox" type="checkbox" <?php if ($instance['google']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>">
				<label for="<?php echo $this->get_field_id('google'); ?>">&nbsp;&nbsp;Display Google+ (Beta) Stats</label><br />
				<label for="<?php echo $this->get_field_id('google_stat'); ?>">Google+ (Beta) Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('google_stat'); ?>" name="<?php echo $this->get_field_name('google_stat'); ?>" value="<?php echo $instance['google_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('google_link'); ?>">Google+ (Beta) Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" value="<?php echo $instance['google_link']; ?>"><br />
				<label for="<?php echo $this->get_field_id('google_type'); ?>">Which Google+ Stat To Display:</label><br />
				<?php 
				$google_circles = array("In Your Circles" => "gplusCircles", "In Others Circles" => "gplusInCircles");
				SocialCrowd_Make_Select($instance['google_type'],$google_circles,"widefat",$this->get_field_id('google_type'),$this->get_field_name('google_type'));
				?>
				<br /><br />
				
				<input class="checkbox" type="checkbox" <?php if ($instance['twitter']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>">
				<label for="<?php echo $this->get_field_id('twitter'); ?>">&nbsp;&nbsp;Display Twitter Stats</label><br />
				<label for="<?php echo $this->get_field_id('twitter_stat'); ?>">Twitter Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_stat'); ?>" name="<?php echo $this->get_field_name('twitter_stat'); ?>" value="<?php echo $instance['twitter_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('twitter_link'); ?>">Twitter Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo $instance['twitter_link']; ?>"><br />
				<label for="<?php echo $this->get_field_id('twitter_type'); ?>">Which Twitter Stat to Display:</label><br />
				<?php 
				$twitter_stats = array("Followers" => "twitter", "Following" => "twitterFriends", "Status Updates" => "twitterStatuses", "Listed Count" => "twitterListed");
				SocialCrowd_Make_Select($instance['twitter_type'],$twitter_stats,"widefat",$this->get_field_id('twitter_type'),$this->get_field_name('twitter_type'));
				?>
				<br /><br />
				
				<input class="checkbox" type="checkbox" <?php if ($instance['linkedin']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>">
				<label for="<?php echo $this->get_field_id('linkedin'); ?>">&nbsp;&nbsp;Display Linked In Stats</label><br />
				<label for="<?php echo $this->get_field_id('linkedin_stat'); ?>">Linked In Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('linkedin_stat'); ?>" name="<?php echo $this->get_field_name('linkedin_stat'); ?>" value="<?php echo $instance['linkedin_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('linkedin_link'); ?>">Linked In Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo $instance['linkedin_link']; ?>"><br /><br />
				
				<input class="checkbox" type="checkbox" <?php if ($instance['youtube']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>">
				<label for="<?php echo $this->get_field_id('youtube'); ?>">&nbsp;&nbsp;Display Youtube Stats</label><br />
				<label for="<?php echo $this->get_field_id('youtube_stat'); ?>">Youtube Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube_stat'); ?>" name="<?php echo $this->get_field_name('youtube_stat'); ?>" value="<?php echo $instance['youtube_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('youtube_link'); ?>">Youtube Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" value="<?php echo $instance['youtube_link']; ?>"><br />
				<label for="<?php echo $this->get_field_id('youtube_type'); ?>">Which Youtube Stat to Display:</label><br />
				<?php 
				$youtube_stats = array("Friends" => "youtube", "Subscribers" => "youtubeSubscribers", "Videos Viewed" => "youtubeViews", "Total Upload Views" => "youtubeUploadViews");
				SocialCrowd_Make_Select($instance['youtube_type'],$youtube_stats,"widefat",$this->get_field_id('youtube_type'),$this->get_field_name('youtube_type'));
				?><br /><br />

				<input class="checkbox" type="checkbox" <?php if ($instance['vimeo']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>">
				<label for="<?php echo $this->get_field_id('vimeo'); ?>">&nbsp;&nbsp;Display Vimeo Stats</label><br />
				<label for="<?php echo $this->get_field_id('vimeo_stat'); ?>">Vimeo Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('vimeo_stat'); ?>" name="<?php echo $this->get_field_name('vimeo_stat'); ?>" value="<?php echo $instance['vimeo_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('vimeo_link'); ?>">Vimeo Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('vimeo_link'); ?>" name="<?php echo $this->get_field_name('vimeo_link'); ?>" value="<?php echo $instance['vimeo_link']; ?>"><br />
				<label for="<?php echo $this->get_field_id('vimeo_type'); ?>">Which Vimeo Stat to Display:</label><br />
				<?php 
				$vimeo_stats = array("Contacts" => "vimeo", "Uploads" => "vimeoUploads", "Appearances" => "vimeoAppearsIn", "Videos Liked" => "vimeoLikes");
				SocialCrowd_Make_Select($instance['vimeo_type'],$vimeo_stats,"widefat",$this->get_field_id('vimeo_type'),$this->get_field_name('vimeo_type'));
				?><br /><br />
				
				<input class="checkbox" type="checkbox" <?php if ($instance['feedburner']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('feedburner'); ?>" name="<?php echo $this->get_field_name('feedburner'); ?>">
				<label for="<?php echo $this->get_field_id('feedburner'); ?>">&nbsp;&nbsp;Display Feedburner Stats</label><br />
				<label for="<?php echo $this->get_field_id('feedburner_stat'); ?>">Feedburner Stats String:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('feedburner_stat'); ?>" name="<?php echo $this->get_field_name('feedburner_stat'); ?>" value="<?php echo $instance['feedburner_stat']; ?>"><br />
				<label for="<?php echo $this->get_field_id('feedburner_link'); ?>">Feedburner Link Title:</label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('feedburner_link'); ?>" name="<?php echo $this->get_field_name('feedburner_link'); ?>" value="<?php echo $instance['feedburner_link']; ?>"><br /><br />
				
				</p>
				<p>
					
				<input class="checkbox" type="checkbox" <?php if ($instance['newWindow']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('newWindow'); ?>" name="<?php echo $this->get_field_name('newWindow'); ?>">
				<label for="<?php echo $this->get_field_id('newWindow'); ?>">&nbsp;&nbsp;Open Links in a New Window?</label><br />
				
				</p>
				<b>Custom or Default Styling?</b><br>
				<p>
					
				<input class="checkbox" type="checkbox" <?php if ($instance['style']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<label for="<?php echo $this->get_field_id('style'); ?>">&nbsp;&nbsp;Default Styling</label><br />
				Check plugin documentation for instructions on using custom styles
				
				</p>
				<b>Share the Love</b>
				<p>
				
				<input class="checkbox" type="checkbox" <?php if ($instance['link']) echo 'checked="checked" '; ?>id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>">
				<label for="<?php echo $this->get_field_id('link'); ?>">&nbsp;&nbsp;Display "Credit" Link</label>
			
			</p>
			
<?php
		}
	} 
endif;





// Register the plugin/widget
if (class_exists('SC_Widget_Advanced')) :

	function loadSCAWidget() {
		
		register_widget('SC_Widget_Advanced');
	}

	add_action('widgets_init', 'loadSCAWidget');

endif;

?>