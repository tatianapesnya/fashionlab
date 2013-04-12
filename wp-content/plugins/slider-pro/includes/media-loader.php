<?php

global $wpdb;

$table_name = $wpdb->posts;


// total amount of images based on the selected month
$total_images_query = "SELECT COUNT(id) FROM $table_name WHERE post_type='attachment' AND post_mime_type LIKE 'image%'";

if ($show_date != 'all')
	$total_images_query .= " AND post_date LIKE '$show_date%'";

if ($show_keyword != '')
	$total_images_query .= "  AND post_title LIKE '%$show_keyword%'";
	
$total_images = $wpdb->get_var($total_images_query);

// if no images were found, exit the process 
if ($total_images == '0') {
	echo '<p class="no-images">No images found in the Media Library. Please upload your images using the default WordPress uploader: Media -> Add New.</p>';
	die();
}

// images to load at one time
$images_to_load = floor($images_total_height / 50);

// total pages
$total_pages = ceil($total_images / $images_to_load);

// calculate the first image displayed in the list, based on the selected page and selected month
$start_image = ($show_page - 1) * $images_to_load;

if ($start_image > $total_images)
	$start_image = ($total_pages - 1) * $images_to_load;


// get all the available dates, in order to display them in the combobox
$dates_query = "SELECT DISTINCT LEFT(post_date, 7) AS date FROM $table_name WHERE post_type='attachment' AND post_mime_type LIKE 'image%'";

if ($show_keyword != '')
	$dates_query .= " AND post_title LIKE '%$show_keyword%'";
	
$dates_query .= " ORDER BY post_date DESC";

$dates_all = $wpdb->get_results($dates_query, ARRAY_A);


// get the images that correspond to the selection
$images_query = "SELECT ID, post_title, post_date FROM $table_name WHERE post_type='attachment' AND post_mime_type LIKE 'image%'";

if ($show_date != 'all')
	$images_query .= " AND post_date LIKE '$show_date%'";

if ($show_keyword != '')
	$images_query .= " AND post_title LIKE '%$show_keyword%'";
	
$images_query .= " ORDER BY post_date DESC";
$images_query .= " LIMIT $start_image, $images_to_load";

$images = $wpdb->get_results($images_query, ARRAY_A);


// beautify the dates from 'yyyy-mm' to 'Month yyyy', and add the dates to an array
$dates = array();

global $sliderpro_months;

foreach($dates_all as $date_entry) {
	$year = substr($date_entry['date'], 0, 4);
	
	$month_raw = substr($date_entry['date'], 5, 2);	
	$month = $sliderpro_months[$month_raw];
	
	$date_raw = $year . '-' . $month_raw;
	$date = $month . ' ' . $year;
	
	$dates[$date_raw] = $date;
}

?>

<div id="media-loader-controls">
	<div id="selection-categories">
		<div class="selection-field">
			Date: 
			<select id="date-select">
				<?php 
					echo "<option value=\"all\" >All</option>";
					
					foreach($dates as $key => $value) {
						$selected = ($show_date == $key) ? 'selected="selected"' : '';
						echo "<option value=\"$key\" $selected>$value</option>";
					}
				?>
			</select>
		</div>
		
		<div class="selection-field">
			Page: 
			<select id="page-select">
				<?php 
					for ($i = 1; $i <= $total_pages; $i++) {
						$selected = ($show_page == $i) ? 'selected="selected"' : '';
						echo "<option value=\"$i\" $selected>$i</option>";
					}
				?>
			</select>
		</div>
		
		<div class="selection-field">
			Keyword: 
        	<input id="keyword" value="<?php echo $show_keyword; ?>" />
		</div>
    </div>
	
	<a class="button" id="show-interval" href="<?php echo admin_url("admin-ajax.php?action=sliderpro_open_media&allow=$allow"); ?>">Show</a>
	    
	<a class="button<?php echo $allow == 'multiple' ? '' : ' disabled' ?>" id="insert-selected<?php echo $allow == 'multiple' ? '' : '-disabled' ?>" href="#">Insert</a>
	
</div>

<table class="widefat" id="sp-media-loader">
	<thead>
		<tr>
        	<th width="10px"><?php _e('#', 'slider_pro'); ?></th>
			<th width="60px"><?php _e('Image', 'slider_pro'); ?></th>
            <th><?php _e('Name', 'slider_pro'); ?></th>
            <th><?php _e('Date', 'slider_pro'); ?></th>
            <th width="80px"><?php _e('Insert', 'slider_pro'); ?></th>
		</tr>
	</thead>
            
	<tbody>
    	<?php
		$counter = $start_image + 1;
		$timthumb_path = get_option('slider_pro_enable_timthumb') ? esc_attr(plugins_url('/slider-pro/includes/timthumb/timthumb.php')."?q=100&w=43&h=43&a=cc&src=") : '';
		$button_class = $allow == 'single' ? 'insert-image' : 'disabled';
		$button_value = $allow == 'single' ? 'Insert' : 'Select';
		
    	foreach ($images as $image) {
			$image_src = wp_get_attachment_image_src($image['ID'], 'full');
			$image_path = sliderpro_get_real_path($image_src[0]);
			
            echo '<tr>'.
					'<td>' . $counter++ . '</td>'.
					'<td><img class="thumb-image" src="' . $timthumb_path . $image_path . '" width="43" height="43"/></td>'.
					'<td>' . $image['post_title'] . '</td>'.
					'<td>' . substr($image['post_date'], 0, 10) . '</td>'.
					'<td><a class="button ' . $button_class . '" href="' . $image_path . '">' . $button_value . '</a></td>'.
				 '</tr>';
        }
		?>    	
	</tbody>
</table>