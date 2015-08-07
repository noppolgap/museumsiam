<?php
/*================ FunctionDB ====================*/
$conn;
ConnectDB();
//เชื่อมฐานข้อมูล
function ConnectDB() {
	global $conn;
	
	$conn = mysql_connect(_DATA_BASE_HOST_,_DATA_BASE_USER_,_DATA_BASE_PASS_);
	if(!$conn)
		die(header('Location:'._FULL_SITE_PATH_.'404.php'));

	mysql_select_db(_DATA_BASE_NAME_,$conn)
		or die(header('Location:'._FULL_SITE_PATH_.'404.php'));
	mysql_query('set names UTF8',$conn);
	
	return $conn;
}
//เลิกติดต่อฐานข้อมูล
function CloseDB() {
	global $conn;
	mysql_close($conn);
}
?>