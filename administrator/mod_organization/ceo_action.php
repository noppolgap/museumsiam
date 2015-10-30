<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$returnPage = 'index.php';

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "active_flag = 2";

	$sql = "UPDATE mas_org SET  " . implode(",", $update) . " WHERE ORG_ID =" . $id;

	mysql_query($sql, $conn);

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM mas_org WHERE ACTIVE_FLAG<>2 and PARENT_ORG_ID = 0 ";
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
			$filename = admin_move_image_upload_dir('USER_IMG' , end(explode('/', $file)), 1000, '', false, 150, 150);
		}
	}
	$insert['IMG_PATH'] = "'" . $filename . "'";

	$insert['USER_CREATE'] = "'".$_SESSION['user_name'] ."'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'".$_SESSION['user_name'] ."'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$insert['ACTIVE_FLAG'] = "1";
$insert['SECTION_ID'] = "1";
$insert['PARENT_ORG_ID'] = "0";
$insert['DEPARTMENT_ID'] = "-1";

	$sql = "INSERT INTO mas_org (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);

}

if (isset($_GET['edit'])) {

	$update = "";
	$chkHasSubCategory = $_POST['chkHasSubCategory'];
	$isLastNode = "";
	if ($chkHasSubCategory)
		$isLastNode = "N";
	else
		$isLastNode = "Y";

	$update[] = "CONTENT_CAT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CONTENT_CAT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";
	$update[] = "IS_LAST_NODE = '" . $isLastNode . "'";
	$sql = "UPDATE trn_content_category SET  " . implode(",", $update) . " WHERE CONTENT_CAT_ID = " . $_POST['txtCatID'];
	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);

}
