<?php
/*
Social Crowd Widget
This file contains the code for the Social Crowd Sidebar Widget.
*/

if (!class_exists('SC_Widget')) :

	class SC_Widget extends WP_Widget {


		function SC_Widget() {
									
			// Widget settings
			$widget_ops = array('classname' => 'sc-widget', 'description' => 'Display Social Crowd Stats.');

			// Create the widget
			$this->WP_Widget('sc-widget', 'Social Crowd', $widget_ops);
		}
		
		
		function widget($args, $instance) {
			
			extract($args);
			
			// User-selected settings
			$title = $instance['title'];
			$icon_set = $instance['set'];
			$format = $instance['format'];
			$style = $instance['style'];
			$link = $instance['link'];

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
						border-radius: 5px;
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
				
				if($sc_options["get_facebook"]=='1'){
					?>
						<li class="scItems"><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/facebook.png" ?>" /></a><div><span><?php echo $stats["facebook"] ?> Likes</span><br /><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>">Like us on Facebook</a></div></li>
					<?php
				}
				
				if($sc_options["get_gplus"]=='1'){
					?>
					<li class="scItems"><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/google.png" ?>" /></a><div ><span>In <?php echo $stats["gplusInCircles"] ?> Circles</span><br /><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>">Add us on Google+</a></div></li>
					<?php
				}
				
				if($sc_options["get_twitter"]=='1'){
					?>
					<li class="scItems"><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/twitter.png" ?>" /></a><div ><span><?php echo $stats["twitter"] ?> Followers</span><br /><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>">Follow us on Twitter</a></div></li>
					<?php
				}
				
				if($sc_options["get_linkedin"]=='1'){
					?>
					<li class="scItems"><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/linkedin.png" ?>" /></a><div ><span><?php echo $stats["linkedIn"] ?> Connections</span><br /><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>">Join Us On Linked In</a></div></li>
					<?php
				}
				
				if($sc_options["get_youtube"]=='1'){
					?>
					<li class="scItems"><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/youtube.png" ?>" /></a><div ><span><?php echo $stats["youtube"] ?> Subscribers</span><br /><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>">Watch us on Youtube</a></div></li>
					<?php
				}
				
				if($sc_options["get_vimeo"]=='1'){
					?>
					<li class="scItems"><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/vimeo.png" ?>" /></a><div ><span><?php echo $stats["vimeo"] ?> Contacts</span><br /><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>">See us on Vimeo</a></div></li>
					<?php
				}
				
				if($sc_options["get_feedburner"]=='1'){
					?>
					<li class="scItems"><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US"><img src="<?php echo $img_url."large/".$icon_set."/feed.png" ?>" /></a><div ><span><?php echo $stats["feedburner"] ?> Readers</span><br /><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US">Read On Feedburner</a></div></li>
					<?php
				}

			?>
			</ul>
			<?php
			
			}else{
					//display Horizontal widget layout
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
				
				if($sc_options["get_facebook"]=='1'){
					?>
						<li class="scItems"><a href="http://www.facebook.com/<?php echo $sc_options['facebook_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/facebook.png" ?>" /></a><br /><span>Likes</span><br /><?php echo $stats["facebook"] ?></li>
					<?php
				}
				
				if($sc_options["get_gplus"]=='1'){
					?>
					<li class="scItems"><a href="http://plus.google.com/<?php echo $sc_options['gplus_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/google.png" ?>" /></a><br /><span>Circles</span><br /><?php echo $stats["gplusInCircles"] ?></li>
					<?php
				}
				
				if($sc_options["get_twitter"]=='1'){
					?>
					<li class="scItems"><a href="http://www.twitter.com/<?php echo $sc_options['twitter_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/twitter.png" ?>" /></a><br /><span>Followers</span><br /><?php echo $stats["twitter"] ?></li>
					<?php
				}
				
				if($sc_options["get_linkedin"]=='1'){
					?>
					<li class="scItems"><a href="<?php echo (stristr($sc_options["linkedin_token"],"//")) ? 'http:' : 'http://www.linkedin.com/in/'; echo $sc_options['linkedin_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/linkedin.png" ?>" /></a><br /><span>Links</span><br /><?php echo $stats["linkedIn"] ?></li>
					<?php
				}
				
				if($sc_options["get_youtube"]=='1'){
					?>
					<li class="scItems"><a href="http://www.youtube.com/<?php echo $sc_options['youtube_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/youtube.png" ?>" /></a><br /><span>Scribers</span><br /><?php echo $stats["youtubeSubscribers"] ?></li>
					<?php
				}
				
				if($sc_options["get_vimeo"]=='1'){
					?>
					<li class="scItems"><a href="http://www.vimeo.com/<?php echo $sc_options['vimeo_token'] ?>"><img src="<?php echo $img_url."large/".$icon_set."/vimeo.png" ?>" /></a><br /><span>Contacts</span><br /><?php echo $stats["vimeo"] ?></li>
					<?php
				}
				
				if($sc_options["get_feedburner"]=='1'){
					?>
					<li class="scItems"><a href="http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $sc_options['feedburner_token'] ?>&loc=en_US"><img src="<?php echo $img_url."large/".$icon_set."/feed.png" ?>" /></a><br /><span>Readers</span><br /><?php echo $stats["feedburner"] ?></li>
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
			$instance['format'] = strip_tags( $new_instance['format'] );
			$instance['style'] = $new_instance['style'];
			$instance['link'] = $new_instance['link'];

			return $instance;
		}
		
		
		function form($instance) {

			// Set up some default widget settings
			//$defaults = array('title' => 'Latest Tweets', 'username' => '', 'posts' => 5, 'interval' => 1800, 'date' => 'j F Y', 'facebook' => true, 'twitter' => true, 'feedburner' => true, 'youtube' => true, 'vimeo' => false);
			$defaults = array('title' => 'Join The Crowd', 'set' => 'aquaticus', 'format' => 'vertical', 'style' => true, 'link' => true);
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
if (class_exists('SC_Widget')) :

	function loadSCWidget() {
		
		register_widget('SC_Widget');
	}

	add_action('widgets_init', 'loadSCWidget');

endif;

?>