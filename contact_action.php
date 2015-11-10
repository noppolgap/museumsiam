<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");

	$LV = intval($_GET['LV']);
	$cID = intval($_GET['cid']);
	$MID = intval($_GET['MID']);
	$conid = intval($_GET['conid']);

	$returnPage = 'administrator/mod_category/content_view.php?cid='.$cID.'&MID='.$MID.'&LV='.$LV ;

if (isset($_GET['add'])) {

	unset($insert);
	$insert['CAT_ID'] =  "'" . $_POST['position'] . "'";
	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['txtName'] . "'";
	$insert['PLACE_DESC_LOC'] = "'" . $_POST['txtAddress'] . "'";
	$insert['PLACE_DESC_ENG'] = "'" . $_POST['txtMail'] . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['txtTel'] . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['txtText'] . "'";
	$insert['CONTENT_STATUS_FLAG'] = 2;
	$insert['USER_CREATE'] = "'".$_SESSION['user_name'] ."'";
	$insert['CREATE_DATE'] = "NOW()";



    $sql = "INSERT INTO trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);


	header('Location: contact.php');

}

if (isset($_GET['edit'])) {



	$update = "";

	$update[] = "CAT_ID = '" . $_POST['position'] . "'";
	$update[] = "CONTENT_DESC_LOC = '" . $_POST['txtName'] . "'";
	$update[] = "PLACE_DESC_LOC = '" . $_POST['txtAddress'] . "'";
	$update[] = "PLACE_DESC_ENG = '" . $_POST['txtEmail'] . "'";
	$update[] = "BRIEF_LOC = '" . $_POST['txtTel'] . "'";
	$update[] = "CONTENT_DETAIL_LOC ='" . $_POST['txtDetail'] . "'";
	$update[] = "LAST_UPDATE_USER = '".$_SESSION['user_name'] ."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";


	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " .$conid;
	mysql_query($sql, $conn);

	header('Location: '.$returnPage.'');

}
