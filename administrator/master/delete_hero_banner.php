<?php
if($_POST['type'] == 1){
	$path = '../../assets/plugin/upload/php/files/'.$_POST['pid'];
	if (file_exists($path)) {
	   unlink($path);
	}
	$path = '../../assets/plugin/upload/php/files/thumbnail/'.$_POST['pid'];
	if (file_exists($path)) {
	   unlink($path);
	}	
}else if($_POST['type'] == 2){
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

	$path = $_POST['pname'];
	if (file_exists($path)) {
	   unlink($path);
	}

	$path = str_replace_last('/','/thumbnail/',$path);
	if (file_exists($path)) {
	   unlink($path);
	}

	mysql_query('DELETE FROM trn_hero_banner WHERE PIC_ID = '.$_POST['pid'],$conn);
	mysql_query('OPTIMIZE TABLE trn_hero_banner',$conn);
}
?>