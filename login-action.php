<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');

$getUserSql = "SELECT ID,
						USER_ID,
						`NAME`,
						LAST_NAME,
						PWD
					FROM
						sys_app_user
					WHERE
						USER_ID = '" . $_POST['txtEmail'] . "'
					and ACTIVE_FLAG = 1 ";
$query = mysql_query($getUserSql, $conn);
$validatePass = FALSE;
while ($row = mysql_fetch_array($query)) {

	if ($row['PWD'] == createPasswordHash($_POST['txtPwd'])) {
		$validatePass = TRUE;
		$_SESSION['user_name'] = $row['USER_ID'];
		$_SESSION['UID'] = $row['ID'];
	} else {
		$_SESSION['LOGIN_FAIL_MSG'] = "รหัสผ่านไม่ถูกต้อง";
	}
}
if ($validatePass) {
	unset($insert);
	$insert['USER_ID'] = "'" . $_SESSION['user_name']  . "'";
	$insert['LOGIN_DATE'] = "now()";
	$sql = "INSERT INTO log_user_login (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	//header("Location : " . $_SESSION['last_url']);
	$last_url = $_SESSION['last_url'];

	// if (strpos($last_url, 'login') !== false)
		// $last_url = '';

	if ($last_url != '') {
		//echo "<script type='text/javascript'>window.location.href = '" . $last_url . "';</script>";
			header("Location:$last_url");
	} else {
		// Redirect the user to the common menu
				header("Location:" . _FULL_SITE_PATH_);
		//echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "';</script>";
	}
} else {
	if (mysql_num_rows($query) == 0)
		$_SESSION['LOGIN_FAIL_MSG'] = "ไม่พบข้อมูลผู้ใช้งาน";

	//echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/login.php" . "';</script>";
	header("Location:" . _FULL_SITE_PATH_ . "/login.php");
}

CloseDB();
?>