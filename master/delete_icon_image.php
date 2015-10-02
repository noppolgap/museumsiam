<?php

require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$path = $_POST['pname'];
if (file_exists($path)) {
	unlink($path);
}

$path = str_replace_last('/', '/thumbnail/', $path);
if (file_exists($path)) {
	unlink($path);
}

if ($_POST['iconType'] == 'BIG')
	mysql_query("update trn_banner_pic_setting set DESKTOP_ICON_PATH = null WHERE BANNER_ID = " . $_POST['bannerid'], $conn);
else if ($_POST['iconType'] == 'SMALL')
	mysql_query("update trn_banner_pic_setting set MOBILE_ICON_PATH = null WHERE BANNER_ID = " . $_POST['bannerid'], $conn);
//mysql_query('DELETE FROM trn_banner_pic_setting WHERE BANNER_ID = ' . $_POST['bannerid'], $conn);
mysql_query('OPTIMIZE TABLE trn_banner_pic_setting', $conn);
?>