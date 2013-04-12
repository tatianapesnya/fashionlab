<?php
// Set PHP memory limit
define ('MEMORY_LIMIT', '80M');

// Allow image fetching from external websites. Will check against ALLOWED_SITES if ALLOW_ALL_EXTERNAL_SITES is false
define ('ALLOW_EXTERNAL', true);

// Allow image fetching from any source. Less secure
define ('ALLOW_ALL_EXTERNAL_SITES', false);

// 10 Megs is 10485760. The max file size that will be process. 
define ('MAX_FILE_SIZE', 10485760);

// Time to cache in the browser
define ('BROWSER_CACHE_MAX_AGE', 864000);

// Use for testing if you want to disable all browser caching
define ('BROWSER_CACHE_DISABLE', false);

// Maximum image width and image height
define ('MAX_WIDTH', 15000);
define ('MAX_HEIGHT', 15000);

// If ALLOW_EXTERNAL is true and ALLOW_ALL_EXTERNAL_SITES is false, then external images will only be fetched from these domains and their subdomains. 
$ALLOWED_SITES = array (
	'flickr.com',
	'staticflickr.com',
	'picasa.com',
	'img.youtube.com',
	'upload.wikimedia.org',
	'photobucket.com',
	'imgur.com',
	'imageshack.us',
	'tinypic.com'
);

?>