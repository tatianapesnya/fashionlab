<?php
/*
Plugin Name: Posts By Author Widget Pro
Plugin URI: http://pippinsplugins.com/posts-by-author-widget-pro-plugin
Description: Provides a widget to lists posts by a particular author, as well as the option to display more posts by the current author
Version: 1.0.1
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
*/


/**
 * Posts By Author Widget Class
 */
class pbawp_wrapper extends WP_Widget {


    /** constructor */
    function pbawp_wrapper() {
        parent::WP_Widget(false, $name = 'Posts By Author Widget Pro', array('description' => 'Lists posts by a specific author') );	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
        extract( $args );

		global $post;
		
        $title 			= apply_filters('widget_title', $instance['title']);
        $author			= apply_filters('widget_title', $instance['author']);
		$single_mode    = apply_filters('widget_title', $instance['single_mode']);
		$single_title   = apply_filters('widget_title', $instance['single_title']);
        $post_title		= apply_filters('widget_title', $instance['post_title']);
        $time			= apply_filters('widget_title', $instance['time']);
        $comments		= apply_filters('widget_title', $instance['comments']);
        $excerpt		= apply_filters('widget_title', $instance['excerpt']);
        $excerpt_length	= apply_filters('widget_title', $instance['excerpt_length']);
        $order 			= apply_filters('widget_title', $instance['order']);
        $sortby 		= apply_filters('widget_title', $instance['sortby']);
        $number 		= apply_filters('widget_title', $instance['number']);
        $offset 		= apply_filters('widget_title', $instance['offset']);
        $thumbnail_size = apply_filters('widget_title', $instance['thumbnail_size']);
        $thumbnail 		= $instance['thumbnail'];
		$current_post   = null;
		
		if(is_single() && $single_mode == true) { 
			$author_id = $post->post_author; 
			$current_post = $post->ID;
			if(isset($single_title) && $single_title != '') {
				$user = get_userdata($author_id);
				$title = str_replace('{author}', $user->display_name, $single_title);
			}
		} else { 
			$author_object 	= get_userdatabylogin($author);
			$author_id = $author_object->ID; 
		}
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="posts-by-author-widget-list">
							<?php
								global $post;
								$tmp_post = $post;
								$args = array( 'author' => $author_id, 'numberposts' => $number, 'offset'=> $offset, 'orderby' => $sortby, 'order' => $order, 'exclude' => $current_post );
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post); ?>
									<li <?php if(!empty($thumbnail_size) && has_post_thumbnail()) { $size = $thumbnail_size + 8; echo 'style="min-height: ' . $size . 'px; height: auto!important; height: 100%;list-style-type: none;"'; } ?> >
										<?php if($thumbnail == true) { ?>
											<a href="<?php the_permalink(); ?>" style="float: left; margin: 0 5px 0 0;"><?php the_post_thumbnail(array($thumbnail_size));?></a>
										<?php } ?>
										<?php if($post_title == true) { ?>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										<?php } ?>
										<?php if($comments == true) { ?> (<a href="<?php comments_link(); ?>" title="View comments on <?php echo $post->post_title; ?>"><?php comments_number('0', '1', '%'); ?></a>)<?php } ?>
										<?php if($time == true) { ?>
											<span class="time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
										<?php } ?>
										<?php if($excerpt == true) { 
											$content_excerpt = $post->post_excerpt;
											if($content_excerpt == '') {
												$content_excerpt = $post->post_content;
											}
											$content_excerpt = strip_shortcodes(strip_tags(stripslashes($content_excerpt), '<a><em><strong>'));
											if (!isset($excerpt_length)) { $excerpt_length = 10; }
											$content_excerpt = preg_split('/\b/', $content_excerpt, $excerpt_length*2+1);
											$body_excerpt_waste = array_pop($content_excerpt);
											$content_excerpt = implode($content_excerpt);
											$content_excerpt .= '...';
											echo apply_filters('the_content',$content_excerpt);
											
										} ?>
										
									</li>
								<?php endforeach; ?>
								<?php $post = $tmp_post; ?>
								
							</ul>
							<p><span class="plus"></span> See all posts from <?php the_author_posts_link(); ?></p>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['author'] 		= strip_tags($new_instance['author']);
		$instance['single_mode']	= strip_tags($new_instance['single_mode']);
		$instance['single_title']	= strip_tags($new_instance['single_title']);
		$instance['post_title'] 	= strip_tags($new_instance['post_title']);
		$instance['time'] 			= strip_tags($new_instance['time']);
		$instance['comments'] 		= strip_tags($new_instance['comments']);
		$instance['excerpt'] 		= strip_tags($new_instance['excerpt']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['order'] 			= strip_tags($new_instance['order']);
		$instance['sortby'] 		= strip_tags($new_instance['sortby']);
		$instance['number']	 		= strip_tags($new_instance['number']);
		$instance['offset'] 		= strip_tags($new_instance['offset']);
		$instance['thumbnail_size'] = strip_tags($new_instance['thumbnail_size']);
		$instance['thumbnail'] 		= $new_instance['thumbnail'];
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {	
	
        $title 			= esc_attr($instance['title']);
        $author			= esc_attr($instance['author']);
		$single_mode	= esc_attr($instance['single_mode']);
		$single_title	= esc_attr($instance['single_title']);
        $post_title		= esc_attr($instance['post_title']);
        $time			= esc_attr($instance['time']);
        $excerpt		= esc_attr($instance['excerpt']);
        $excerpt_length	= esc_attr($instance['excerpt_length']);
        $comments		= esc_attr($instance['comments']);
        $order			= esc_attr($instance['order']);
        $sortby			= esc_attr($instance['sortby']);
        $number 		= esc_attr($instance['number']);
        $offset 		= esc_attr($instance['offset']);
        $thumbnail_size = esc_attr($instance['thumbnail_size']);
        $thumbnail 		= esc_attr($instance['thumbnail']);
        ?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.pbawp_show').click(function() {
				$(this).parent().find('.pbawp_hidden').show();
				$(this).hide();
				$(this).next().show();
				return false;
			});
			$('.pbawp_hide').click(function() {
				$(this).parent().find('.pbawp_hidden').hide();
				$(this).hide();
				$(this).prev().show();
				return false;
			});
		});
		</script>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('author'); ?>"><?php _e('Choose an Author'); ?></label> 
			<select name="<?php echo $this->get_field_name('author'); ?>" id="<?php echo $this->get_field_id('author'); ?>" class="widefat">
				<?php
				$authors = pbawp_get_authors();
				foreach ($authors as $a) {
					echo '<option value="' . $a . '" id="' . $a . '"', $a == $author ? ' selected="selected"' : '', '>', $a, '</option>';
				}
				?>
			</select>	
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('single_mode'); ?>" name="<?php echo $this->get_field_name('single_mode'); ?>" type="checkbox" value="1" <?php checked( '1', $single_mode ); ?>/>
          <label for="<?php echo $this->get_field_id('single_mode'); ?>"><?php _e('Enable Single Mode?'); ?></label>
 		  <a href="#" class="pbawp_show">What is this?</a>
		  <a href="#" class="pbawp_hide" style="display: none;">Hide</a><br/>
		  <span class="pbawp_hidden" style="display:none;">This means that when on a single post, more posts by the current author will be displayed, ignoring the name selected above.</span>
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('single_title'); ?>"><?php _e('Single Mode Title:'); ?></label> 
          <a href="#" class="pbawp_show">What is this?</a>
		  <a href="#" class="pbawp_hide" style="display: none;">Hide</a><br/>
		  <span class="pbawp_hidden" style="display: none;">With Single Mode enabled, this title will overwrite the widget title above. Use {author} to display the current author's name</span>
          <input class="widefat" id="<?php echo $this->get_field_id('single_title'); ?>" name="<?php echo $this->get_field_name('single_title'); ?>" type="text" value="<?php echo $single_title; ?>" />
		</p>
		<p>
          <input id="<?php echo $this->get_field_id('post_title'); ?>" name="<?php echo $this->get_field_name('post_title'); ?>" type="checkbox" value="1" <?php checked( '1', $post_title ); ?>/>
          <label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Display Post Title?'); ?></label> 
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo $this->get_field_name('time'); ?>" type="checkbox" value="1" <?php checked( '1', $time ); ?>/>
          <label for="<?php echo $this->get_field_id('time'); ?>"><?php _e('Display Post Date?'); ?></label> 
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="checkbox" value="1" <?php checked( '1', $comments ); ?>/>
          <label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Display Comment Count?'); ?></label> 
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>" type="checkbox" value="1" <?php checked( '1', $excerpt ); ?>/>
          <label for="<?php echo $this->get_field_id('excerpt'); ?>"><?php _e('Display Post Excerpt?'); ?></label> 
        </p>
		<p>
          <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" type="text" value="<?php echo $excerpt_length; ?>" />
          <label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e('Excerpt length in words'); ?></label> 
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Choose the Order to Display Posts'); ?></label> 
			<select name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>" class="widefat">
				<?php
				$orders = array('ASC', 'DESC');
				foreach ($orders as $post_order) {
					echo '<option value="' . $post_order . '" id="' . $post_order . '"', $order == $post_order ? ' selected="selected"' : '', '>', $post_order, '</option>';
				}
				?>
			</select>	
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e('Choose the Post Sorting Method'); ?></label> 
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<?php
				$sort_options = array('title', 'post_date', 'rand');
				foreach ($sort_options as $sort) {
					echo '<option id="' . $sort . '"', $sortby == $sort ? ' selected="selected"' : '', '>', $sort, '</option>';
				}
				?>
			</select>	
        </p>
		<p>
          <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Show:'); ?></label> 
        </p>
		<p>
          <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $offset; ?>" />
          <label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Offset ( number of posts to skip):'); ?></label> 
        </p>
		<p>
          <input id="<?php echo $this->get_field_id('thumbnail'); ?>" name="<?php echo $this->get_field_name('thumbnail'); ?>" type="checkbox" value="1" <?php checked( '1', $thumbnail ); ?> class="extra-options-thumb"/>
          <label for="<?php echo $this->get_field_id('thumbnail'); ?>"><?php _e('Display Thumbnails?'); ?></label> 
        </p>
		<p>
          <input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('thumbnail_size'); ?>" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" type="text" value="<?php echo $thumbnail_size; ?>"  />
          <label for="<?php echo $this->get_field_id('thumbnail_size'); ?>" class="disabled-thumb-fields" ><?php _e('Size of the thumbnails, <br/>e.g. <em>80</em> = 80px x 80px'); ?></label> 
        </p>
	
	
        <?php 
    }


} // class pbawp_wrapper
// register Posts By Author widget
add_action('widgets_init', create_function('', 'return register_widget("pbawp_wrapper");'));


/*
* Get all admins, editors, authors, and subscribers
*/
function pbawp_get_authors(){
    //Grab wp DB 
    global $wpdb;
    //Get all users in the DB
    $wp_user_search = $wpdb->get_results("SELECT ID, user_login FROM $wpdb->users ORDER BY ID");
    
    //Blank array
    $user_array = array();
    //Loop through all users
    foreach ( $wp_user_search as $user ) {
        
		// only get users that can edit posts
        if(user_can($user->ID, 'edit_posts')) {
			//Push user ID into array
			$user_array[] = $user->user_login;
        }
    }
    return $user_array;
}