<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");



$secid = $_GET['secid'];
$did	 = $_GET['did'] ; 

$returnPage = 'manage_people_department.php?secid='.$secid.'&did='.$did;

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "active_flag = 2";

	$sql = "UPDATE mas_org SET  " . implode(",", $update) . " WHERE ORG_ID =" . $id;

	mysql_query($sql, $conn);

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM mas_org WHERE ACTIVE_FLAG<>2 and PARENT_ORG_ID <> 0 and SECTION_ID =  " . $secid." AND DEPARTMENT_ID = ".$did;
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['NAME_LOC'] = "'" . $_POST['txtNameLoc'] . "'";
	$insert['NAME_ENG'] = "'" . $_POST['txtNameEng'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['POSITION_DESC_LOC'] = "'" . $_POST['txtPositionLoc'] . "'";
	$insert['POSITION_DESC_ENG'] = "'" . $_POST['txtPositionEng'] . "'";
	$insert['PHONE'] = "'" . $_POST['txtPhone'] . "'";
	$insert['EMAIL'] = "'" . $_POST['txtEmail'] . "'";

	$filename = "";
	if (count($_POST['USER_IMG_file']) > 0) {
		$index = 1;

		foreach ($_POST['USER_IMG_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('USER_IMG', end(explode('/', $file)), 1000, '', false, 150, 150);
		}
	}
	$insert['IMG_PATH'] = "'" . $filename . "'";

	$insert['USER_CREATE'] = "'" . $_SESSION['user_name'] . "'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'" . $_SESSION['user_name'] . "'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$insert['ACTIVE_FLAG'] = "1";
	$insert['SECTION_ID'] = $secid;
	$insert['PARENT_ORG_ID'] = "1";
	$insert['DEPARTMENT_ID'] = $did ;

	$sql = "INSERT INTO mas_org (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);

}

if (isset($_GET['edit'])) {

	$update = "";

	$orgID = $_GET['orgid'];

	$update[] = "NAME_LOC = '" . $_POST['txtNameLoc'] . "'";
	$update[] = "NAME_ENG = '" . $_POST['txtNameEng'] . "'";

	$update[] = "POSITION_DESC_LOC = '" . $_POST['txtPositionLoc'] . "'";
	$update[] = "POSITION_DESC_ENG = '" . $_POST['txtPositionEng'] . "'";
	$update[] = "PHONE = '" . $_POST['txtPhone'] . "'";
	$update[] = "EMAIL = '" . $_POST['txtEmail'] . "'";

	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$filename = "";
	if (count($_POST['USER_IMG_file']) > 0) {
		$index = 1;

		foreach ($_POST['USER_IMG_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('USER_IMG', end(explode('/', $file)), 1000, '', false, 150, 150);
		}
		$update[] = "IMG_PATH = '" . $filename . "'";
	}

	

	$sql = "UPDATE mas_org SET  " . implode(",", $update) . " WHERE ORG_ID = " . $orgID;
	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);

}
