<?php
function __autoload($class_name){

	// Directories to look in
	$dirs = [
		'admin/',
		'css/',
		'src/',
		'helper/',
	];

	// Try to load class
	foreach($dirs as $dir) {
		$file = __DIR__."/$dir$class_name.class.php";
		if(file_exists($file)) {
			require_once($file);
			break;
		}
	}
}