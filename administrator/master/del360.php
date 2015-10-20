<?php
$name = pathinfo($_POST['name'] , PATHINFO_BASENAME);
$path = "../../assets/plugin/upload/three_hundred_and_sixty/files/".$name;

if (file_exists($path)) {
	unlink($path);
}
?>