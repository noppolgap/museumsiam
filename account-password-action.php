<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
if (!isset($_SESSION['LANG']))
	$_SESSION['LANG'] = 'TH';
//TH , EN

if ($_SESSION['LANG'] == 'TH')
	require ("inc/inc-th-lang.php");
else if ($_SESSION['LANG'] == 'EN')
	require ("inc/inc-en-lang.php");

header('Content-type: text/html; charset=utf-8');
if (isset($_GET['edit'])) {
	$sql = "SELECT ID,USER_ID,`NAME`,LAST_NAME,PWD FROM sys_app_user where ID = '" . $_SESSION['UID'] . "' ";
	$rs = mysql_query($sql) or die(mysql_error());
	$rowUser = mysql_fetch_array($rs);
	if ($rowUser['PWD'] != createPasswordHash($_POST['oldPwd'])) {
		$_SESSION['CHANGE_PWD_ERR_MSG'] = $old_pwd_invalid;
		header("Location:" . _FULL_SITE_PATH_ . "/account-password.php");
	} else {
		// pass can update

		$update = "";

		$update[] = "PWD = '" . createPasswordHash($_POST['newPwd']) . "'";
		$update[] = "LAST_UPDATE_DATE = NOW()";
		$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
		$sql = "UPDATE sys_app_user SET  " . implode(",", $update) . " WHERE ID = " . $_SESSION['UID'];
		mysql_query($sql, $conn);

		header('Location: ' . 'account.php');

	}
}
?>