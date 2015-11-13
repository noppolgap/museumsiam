<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$CID = $_GET['cid'];
$LV = $_GET['LV'];
$SCID = $_GET['SCID'];

$returnPage = 'content_view.php?MID=' . $MID . '&cid=' . $CID . '&LV=' . $LV;

if (isset($SCID) && nvl($SCID, '0') != '0')
	$returnPage .= '&SCID=' . $SCID;

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_category/'" . $returnPage . ";</script>";
if (isset($_GET['enable'])) {

	$id = $_GET['conid'];
	$flag = $_GET['vis'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = $Flag";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = 2";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	if (count($_POST['video_delete_gallery']) > 0) {
		foreach ($_POST['video_delete_gallery'] as $k => $file) {
			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = ' . intval($file[1]), $conn) or die($sql);
		}
		mysql_query('OPTIMIZE TABLE trn_content_picture', $conn) or die("");
	}

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =" . $CID;
	//$_POST['cmbCategory'];
	$subCatID = -1;
	if (isset($SCID) && nvl($SCID, '0') != '0') {
		$sql_max .= " AND SUB_CAT_ID =" . $SCID;
		$subCatID = $SCID;
	}

	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CAT_ID'] = "'" . $CID . "'";

	$insert['SUB_CAT_ID'] = "'" . $subCatID . "'";

	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['CONTENT_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['txtDetailLoc'] . "'";
	$insert['CONTENT_DETAIL_ENG'] = "'" . $_POST['txtDetailEng'] . "'";
	$insert['CONTENT_STATUS_FLAG'] = "'0'";
	$insert['CONTENT_VIEW_COUNT'] = "0";
	$insert['BRIEF_LOC'] = "'" . $_POST['txtBriefDescLoc'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['txtBriefDescEng'] . "'";
	$insert['MUSUEM_ID'] = "'" . $_POST['cmbMuseum'] . "'";
	$insert['APPROVE_FLAG'] = "'Y'";
	$insert['USER_CREATE'] = "'" . $_SESSION['user_name'] . "'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'" . $_SESSION['user_name'] . "'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['txtStartDate']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['txtEndDate']) . "'";

	$insert['PLACE_DESC_LOC'] = "'" . nvl($_POST['txtPlaceLoc'], "") . "'";
	$insert['PLACE_DESC_ENG'] = "'" . nvl($_POST['txtPlaceEng'], "") . "'";
	$insert['LAT'] = "'" . nvl($_POST['txtLat'], "") . "'";
	$insert['LON'] = "'" . nvl($_POST['txtLon'], "") . "'";
	$insert['EVENT_START_TIME'] = "'" . nvl($_POST['cmbHourStart'], '') . ':' . nvl($_POST['cmbMinuteStart'], '') . "'";
	$insert['EVENT_END_TIME'] = "'" . nvl($_POST['cmbHourEnd'], '') . ':' . nvl($_POST['cmbMinuteEnd'], '') . "'";

	$insert['PRICE_RATE_LOC'] = "'" . $_POST['txtPriceLoc'] . "'";
	$insert['PRICE_RATE_ENG'] = "'" . $_POST['txtPriceEng'] . "'";
	$sql = "INSERT INTO  trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	if (count($_POST['photo_file']) > 0) {
		$index = 1;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $CID, end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $CID . "'";
			//$_POST['cmbCategory'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if ($_POST['hidYoutube'] != "") {

		$IMG_TYPE = 3;

		unset($insert);
		$insert['CONTENT_ID'] = $retrunID;
		$insert['IMG_TYPE'] = $IMG_TYPE;
		$insert['IMG_PATH'] = "'" . $_POST['hidYoutube'] . "'";
		$insert['CAT_ID'] = $CID;
		$insert['ORDER_ID'] = "'1'";
		$insert['IMG_NAME'] = "''";
		$insert['DIV_NAME'] = "'video'";
		//ตั้งตาม name

		$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);

	}
	header('Location: ' . $returnPage);
}

if (isset($_GET['edit'])) {

	$conid = $_GET['conid'];

	$subCatID = -1;

	if (isset($SCID) && nvl($SCID, '0') != '0') {
		$subCatID = $SCID;
	}

	$update = "";

	$update[] = "CONTENT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CONTENT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "CONTENT_DETAIL_LOC= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "CONTENT_DETAIL_ENG= '" . $_POST['txtDetailEng'] . "'";
	$update[] = "BRIEF_LOC= '" . $_POST['txtBriefDescLoc'] . "'";
	$update[] = "BRIEF_ENG= '" . $_POST['txtBriefDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$update[] = "CAT_ID = '" . $CID . "'";
	$update[] = "SUB_CAT_ID = '" . $subCatID . "'";

	$update[] = "EVENT_START_DATE = '" . ConvertDateToDB($_POST['txtStartDate']) . "'";

	$update[] = "EVENT_END_DATE = '" . ConvertDateToDB($_POST['txtEndDate']) . "'";

	$update[] = "PLACE_DESC_LOC = '" . nvl($_POST['txtPlaceLoc'], "") . "'";
	$update[] = "PLACE_DESC_ENG = '" . nvl($_POST['txtPlaceEng'], "") . "'";
	$update[] = "LAT = '" . nvl($_POST['txtLat'], "") . "'";
	$update[] = "LON  = '" . nvl($_POST['txtLon'], "") . "'";

	$update[] = "EVENT_START_TIME = '" . nvl($_POST['cmbHourStart'], '') . ':' . nvl($_POST['cmbMinuteStart'], '') . "'";
	$update[] = "EVENT_END_TIME = '" . nvl($_POST['cmbHourEnd'], '') . ':' . nvl($_POST['cmbMinuteEnd'], '') . "'";

	$update[] = "PRICE_RATE_LOC = '" . $_POST['txtPriceLoc'] . "'";
	$update[] = "PRICE_RATE_ENG = '" . $_POST['txtPriceEng'] . "'";

	$update[] = "MUSUEM_ID = '" . $_POST['cmbMuseum'] . "'";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " . $conid;
	mysql_query($sql, $conn);

	if (count($_POST['photo_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_ID) AS MAX_ORDER FROM trn_content_picture WHERE CONTENT_ID = " . $conid . " AND CAT_ID = " . $CID;
		//$_POST['cmbCategory'];
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $CID, end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $conid;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $CID . "'";
			$insert['ORDER_ID'] = $max++;

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['order_position']) > 0) {

		foreach ($_POST['order_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if ($_POST['hidYoutube'] != "") {

		mysql_query('DELETE FROM trn_content_picture WHERE CONTENT_ID = ' . $conid . ' and IMG_TYPE = 3 ', $conn) or die($sql);

		$IMG_TYPE = 3;

		unset($insert);
		$insert['CONTENT_ID'] = $conid;
		$insert['IMG_TYPE'] = $IMG_TYPE;
		$insert['IMG_PATH'] = "'" . $_POST['hidYoutube'] . "'";
		$insert['CAT_ID'] = $CID;
		$insert['ORDER_ID'] = "'1'";
		$insert['IMG_NAME'] = "''";
		$insert['DIV_NAME'] = "'video'";
		//ตั้งตาม name

		$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);

	}

	header('Location: ' . $returnPage);
}
