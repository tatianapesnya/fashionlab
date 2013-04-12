<?php

define('SLIDERPRO_UPDATE_API', 'http://api.sliderpro.net/update/');
//define('SLIDERPRO_UPDATE_API', 'http://localhost/api/');
define('SLIDERPRO_AUTOMATIC_UPDATE', false);
//define('SLIDERPRO_ENVATO_ID', '253501');
//define('SLIDERPRO_ENVATO_ID', '221991');


// check if notifications are enabled
if (get_option('slider_pro_update_notification')) {
	add_filter('pre_set_site_transient_update_plugins', 'sliderpro_update_check');
	add_filter('plugins_api', 'sliderpro_update_info', 10, 3);
	add_action('in_plugin_update_message-slider-pro/slider-pro.php', 'sliderpro_update_notification_message');
}


/**
* When the update cycle runs, if there is any slider update available append its information
*/
function sliderpro_update_check($transient) {
	if (empty($transient->checked))
		return $transient;
	
	$slug = 'slider-pro/slider-pro.php';
	$current_version = $transient->checked[$slug];
	
	$automatic_update = (SLIDERPRO_AUTOMATIC_UPDATE === true && get_option('slider_pro_automatic_update_status') == 'enabled') ? 'enabled' : 'disabled';

	$args = array(
		'action' => 'update-check',
		'slug' => $slug,
		'automatic-update' => $automatic_update
	);

	$response = sliderpro_api_request($args);
	
	if ($response !== false && version_compare($current_version, $response->new_version, '<'))		
		$transient->response[$slug] = $response;
	
	return $transient;
}


/**
* Display the information about the slider
*/
function sliderpro_update_info($false, $action, $args) {
	$slug = 'slider-pro/slider-pro.php';
	
	// return if the slider-pro plugin info is not requested
	if (!isset($args->slug) || $args->slug != $slug)
		return false;
	
	$automatic_update = (SLIDERPRO_AUTOMATIC_UPDATE === true && get_option('slider_pro_automatic_update_status') == 'enabled') ? 'enabled' : 'disabled';

	$args = array(
		'action' => 'plugin-info',
		'slug' => $slug,
		'automatic-update' => $automatic_update
	);

	$response = sliderpro_api_request($args);
	
	if ($response !== false)		
		return $response;
	else
		return false;

}


/**
* Display the update notification message
* Appends a custom message, if any, to the default message
*/
function sliderpro_update_notification_message() {
	$message = get_transient('sliderpro_update_notification_message');
	
	// if the message has expired, interrogate the server
	if (!$message) {
		$args = array(
			'action' => 'notification-message',
			'slug' => 'slider-pro/slider-pro.php'
		);
		
		$response = sliderpro_api_request($args);
		
		if ($response !== false) {
			$message = '<span> More details <a target="_blank" href="' . admin_url('admin.php?page=slider_pro_help#updating') . '">here</a>.</span>';
			$message .= $response->notification_message;
			
			// store the message in a transient for 12 hours
			set_transient('sliderpro_update_notification_message', $message, 60 * 60 * 12);
		}
	}
	
	echo $message;
}


/**
* Makes requests to the server's update API
*/
function sliderpro_api_request($args) {
	$request = wp_remote_post(SLIDERPRO_UPDATE_API, array('body' => $args));
	
	if (is_wp_error($request) || wp_remote_retrieve_response_code($request) != 200)
		return false;
	
	$response = unserialize(wp_remote_retrieve_body($request));
	
	if (is_object($response))
		return $response;
	else
		return false;
}


/**
* Verifies the provided data againsts the marketplace API and if the data is valid, get the download URL of the item
* This functionality is disabled at the moment and the function will never be executed
*/
function sliderpro_verify_automatic_update() {
	if (get_option('slider_pro_client_username') && get_option('slider_pro_client_api_key') && get_option('slider_pro_item_purchase_code')) {
		
		// API URL for getting the download data of the item
		$api_link = 'http://marketplace.envato.com/api/v3/' . 
					get_option('slider_pro_client_username') . '/' . 
					get_option('slider_pro_client_api_key') . 
					'/download-purchase:' . get_option('slider_pro_item_purchase_code') . '.json';
		
		// set the initial automatic update status to 'invalid-data' and modify it later if the verification is successful
		update_option('slider_pro_automatic_update_status', 'invalid-data');
		
		$request = wp_remote_get($api_link);
		
		if (!is_wp_error($request) && wp_remote_retrieve_response_code($request) == 200) {
			$data = wp_remote_retrieve_body($request);
			
			if (!empty($data)) {
				$data = json_decode($data);

				if (!empty($data->{'download-purchase'}->{'download_url'})) {
					// store the download url
					$download_url = $data->{'download-purchase'}->{'download_url'};
					
					// check if the download URL contains the slider's id
					if(strpos($download_url, SLIDERPRO_ENVATO_ID) !== false) {
						// store the download URL in an option
						// update_option('slider_pro_download_url', $download_url);
						
						// change the "automatic update" status to 'enabled'
						update_option('slider_pro_automatic_update_status', 'enabled');
					}
				}
			}
		}
			
	} else {
		update_option('slider_pro_automatic_update_status', 'disabled');
	}
}
?>