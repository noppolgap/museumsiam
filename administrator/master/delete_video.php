<?php

$file = $_POST['pname'];
$temppath = '../../temp/';


if(file_exists($file)){
    $path = pathinfo($file);
    $file = basename($file);
}else if(file_exists($temppath.$file)){
	$path = $temppath;
	$file = $file;
}

	chmod($path, 0777);

	if(file_exists($path.$file)){
		unlink($path.$file);
	}

	chmod($path, 0755);
?>