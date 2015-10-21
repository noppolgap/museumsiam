<?php
$id = intval($_GET['p']);

require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");

	$SqlFile = "SELECT IMG_PATH FROM trn_content_picture WHERE PIC_ID = ".$id;
	$QueryFile = mysql_query($SqlFile) or die(mysql_error());
	$rowFile = mysql_fetch_array($QueryFile);
	$file = str_replace("../../","",$rowFile['IMG_PATH']);

CloseDB();

$quoted = sprintf('"%s"', addcslashes(basename($file), '"\\'));
$size   = filesize($file);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $quoted);
header('Content-Transfer-Encoding: binary');
header('Connection: Keep-Alive');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . $size);

readfile($file);
?>