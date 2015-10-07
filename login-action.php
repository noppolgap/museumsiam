<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');

$getUserSql = "SELECT
						USER_ID,
						`NAME`,
						LAST_NAME,
						PWD
					FROM
						sys_app_user
					WHERE
						USER_ID = '" . $_POST['txtEmail'] . "'
					/*ACTIVE_FLAG <> 2*/";
$query = mysql_query($getUserSql, $conn);
$validatePass = FALSE;
while ($row = mysql_fetch_array($query)) {

	if ($row['PWD'] == createPasswordHash($_POST['txtPwd'])) {
		$validatePass = TRUE;
		$_SESSION['user_name'] = $row['USER_ID'];
	}
	else 
		{
			$_SESSION['LOGIN_FAIL_MSG'] = "รหัสผ่านไม่ถูกต้อง";
		}
}
if ($validatePass) {
	//header("Location : " . $_SESSION['last_url']);
	$last_url = $_SESSION['last_url'];
	if ($last_url != '') {
		header("Location:$last_url");
	} else {
		// Redirect the user to the common menu
		header("Location:" . _FULL_SITE_PATH_);
	}
} else {
	if (mysql_num_rows($query) == 0 )
		$_SESSION['LOGIN_FAIL_MSG'] = "ไม่พบข้อมูลผู้ใช้งาน";
 
	header("Location:"._FULL_SITE_PATH_."/login.php");
}

CloseDB();
?>