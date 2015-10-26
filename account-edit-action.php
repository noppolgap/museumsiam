<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');
if (isset($_GET['edit'])) {
	$update = "";

	$update[] = "NAME = '" . $_POST['name'] . "'";
	$update[] = "LAST_NAME = '" . $_POST['surname'] . "'";
	$update[] = "ADDRESS1 = '" . $_POST['address'] . "'";
	$update[] = "DISTRICT_ID = '" . $_POST['cmbDistrict'] . "'";
	$update[] = "SUB_DISTRICT_ID = '" . $_POST['cmbSubDistrict'] . "'";
	$update[] = "PROVINCE_ID = '" . $_POST['cmbProvince'] . "'";
	$update[] = "POST_CODE = '" . $_POST['postcode'] . "'";

	$update[] = "TELEPHONE = '" . $_POST['tel'] . "'";
	$update[] = "CITIZEN_ID = '" . $_POST['citizen'] . "'";
	$update[] = "MOBILE_PHONE = '" . $_POST['mobile'] . "'";
	$update[] = "FAX = '" . $_POST['fax'] . "'";
	$update[] = "SEX = '" . $_POST['sex'] . "'";
	$update[] = "BIRTHDAY = '" . ConvertDateToDB ($_POST['birthday']) . "'";
	$update[] = "TITLE = '" . $_POST['title-name'] . "'";

	$update[] = "LAST_UPDATE_DATE = NOW()";
	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	$sql = "UPDATE sys_app_user SET  " . implode(",", $update) . " WHERE ID = " . $_SESSION['UID'];
	mysql_query($sql, $conn);

	header('Location: ' . 'account.php');
}
?>
