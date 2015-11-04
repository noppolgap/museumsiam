<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');

if(isset($_POST['id']) && !empty($_POST['id']))
{

	extract($_POST); // extract post variables

	//check if facebook ID already exits
	//$check_user_query = "select * from tbl_users WHERE fld_facebook_id = $id";
	$check_user_sql = "SELECT USER_ID FROM sys_app_user WHERE FB_ID = '".$id."'";
	$check_user_query = mysql_query($check_user_sql, $conn);

	if(mysql_num_rows($check_user_query) == 0)
	{

		$fb_name = explode(' ',$name);

		$insert['USER_ID'] = "'" . $id . "'";
		$insert['FB_ID'] = "'" . $id . "'";
		$insert['EMAIL'] = "'" . $email . "'";
		$insert['NAME'] = "'" . $fb_name[0] . "'";
		$insert['LAST_NAME'] = "'" . end($fb_name) . "'";
		$insert['USER_CREATE'] = "'" . $id . "'";
		$insert['CREATE_DATE'] = "NOW()";
		$insert['LAST_UPDATE_USER'] = "'" . $id . "'";
		$insert['LAST_UPDATE_DATE'] = "NOW()";
		$insert['ACTIVE_FLAG'] = "'1'";

		$sql = "INSERT INTO  sys_app_user (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

		mysql_query($sql, $conn) or die($sql);
		echo json_encode($_POST);
	} else {

		unset($insert);
		$insert['USER_ID'] = "'" . $id  . "'";
		$insert['LOGIN_DATE'] = "now()";
		$sql = "INSERT INTO log_user_login (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
		echo json_encode($_POST);
	}


	$sql = "SELECT ID , USER_ID , FB_ID FROM sys_app_user WHERE FB_ID = '".$id."'";
	$query = mysql_query($sql, $conn);
	$row = mysql_fetch_array($query);

		$_SESSION['user_name'] = $name;
		$_SESSION['UID'] = $row['ID'];
		$_SESSION['FB'] = $id;

} else {
	$arr = array('error' => 1);
	echo json_encode($arr);
}

CloseDB();
?>