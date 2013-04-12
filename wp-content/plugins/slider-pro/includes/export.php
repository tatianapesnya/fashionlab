<?php

$name;

if (isset($_GET['name']))
	$name = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $_GET['name']);
else 
	die();
	
	
header('Content-type: application/xml');
header('Content-Disposition: attachment; filename="'. $name .'"');

$file_path = "../xml/$name";

if (file_exists($file_path))
	readfile($file_path);
else
	echo "This slider doesn't have a saved XML file." . "\n" . "Please check the Troubleshooting chapter, point 15, in the documentation.";
	
?>