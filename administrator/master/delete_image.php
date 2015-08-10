<?php
	$path = '../../assets/plugin/upload/php/files/'.$_POST['pid'];
	if (file_exists($path)) {
	   unlink($path);
	}
	$path = '../../assets/plugin/upload/php/files/thumbnail/'.$_POST['pid'];
	if (file_exists($path)) {
	   unlink($path);
	}	
?>