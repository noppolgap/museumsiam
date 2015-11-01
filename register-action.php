<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');

if ($_GET["type"] == "province") {
	$id = intval($_GET["id"]);
	if ($id == 0) {
		$id = 102;
	}

	$arr = array();
	$sql = "SELECT DISTRICT_ID , DISTRICT_DESC_LOC FROM mas_district WHERE PROVINCE_ID = " . $id . " ORDER BY DISTRICT_ID ASC ";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$arr[$row['DISTRICT_ID']] = $row['DISTRICT_DESC_LOC'];
	}
	echo json_encode($arr);
} else if ($_GET["type"] == "district") {
	$id = intval($_GET["id"]);
	if ($id == 0) {
		$id = 10220;
	}

	$arr = array();
	$sql = "SELECT SUB_DISTRICT_ID , SUB_DISTRICT_DESC_LOC FROM mas_sub_district WHERE DISTRICT_ID = " . $id . " ORDER BY SUB_DISTRICT_ID ASC ";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$arr[$row['SUB_DISTRICT_ID']] = $row['SUB_DISTRICT_DESC_LOC'];
	}
	echo json_encode($arr);

} else if ($_POST["type"] == "email") {
	$sql = "SELECT * FROM sys_app_user WHERE EMAIL =  '" . $_POST['email'] . "'";
	$query = mysql_query($sql, $conn);
	echo mysql_num_rows($query);
} else {
	//insert

	unset($insert);

	$insert['USER_ID'] = "'" . $_POST['email'] . "'";
	$insert['EMAIL'] = "'" . $_POST['email'] . "'";
	$insert['NAME'] = "'" . $_POST['name'] . "'";
	$insert['LAST_NAME'] = "'" . $_POST['surname'] . "'";
	$insert['SEX'] = "'" . $_POST['sex'] . "'";
	$insert['ADDRESS1'] = "'" . $_POST['address'] . "'";
	$insert['CITIZEN_ID'] = "'" . $_POST['idcard'] . "'";
	$insert['PROVINCE_ID'] = "'" . $_POST['province'] . "'";
	$insert['DISTRICT_ID'] = "'" . $_POST['district'] . "'";
	$insert['SUB_DISTRICT_ID'] = "'" . $_POST['sub_district'] . "'";
	$insert['POST_CODE'] = "'" . $_POST['postcode'] . "'";
	$insert['BIRTHDAY'] = "'" . ConvertDateToDB($_POST['birthday']) . "'";
	$insert['PWD'] = "'" . createPasswordHash($_POST['password1']) . "'";
	$insert['USER_CREATE'] = "'" . $_POST['email'] . "'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['ACTIVE_FLAG'] = "'1'";
	$insert['TELEPHONE'] = "'" . $_POST['telephone'] . "'";
	$insert['MOBILE_PHONE'] = "'" . $_POST['mobile'] . "'";
	$insert['FAX'] = "'" . $_POST['fax'] . "'";

	$sql = "INSERT INTO  sys_app_user (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	header('Location: ' . 'check-email.php');

}

CloseDB();
?>