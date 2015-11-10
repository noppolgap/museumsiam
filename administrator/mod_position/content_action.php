<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$CID = $_GET['cid'];
$LV = $_GET['LV'];
$SCID = $_GET['SCID'];

$returnPage = '../mod_category/content_view.php?MID=' . $MID . '&cid=' . $CID . '&LV=' . $LV;

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
	if (isset($SCID) && nvl($SCID, '0') != '0') {//if (isset($_POST['cmbSubCategory'])) {
		$sql_max .= " AND SUB_CAT_ID =" . $SCID;
		//$_POST['cmbSubCategory'];
		$subCatID = $SCID;
		//$_POST['cmbSubCategory'];
	}

	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CAT_ID'] = "'" . $CID . "'";
	//$_POST['cmbCategory'] . "'";
	$insert['SUB_CAT_ID'] = "'" . $subCatID . "'";

	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['CONTENT_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['txtDetailLoc'] . "'";
	$insert['CONTENT_DETAIL_ENG'] = "'" . $_POST['txtDetailEng'] . "'";
	$insert['CONTENT_STATUS_FLAG'] = "'0'";
	$insert['BRIEF_LOC'] = "'" . $_POST['txtBriefDescLoc'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['txtBriefDescEng'] . "'";
	$insert['USER_CREATE'] = "'" . $_SESSION['user_name'] . "'";
	$insert['CREATE_DATE'] = "NOW()";

	$insert['PRICE_RATE_LOC'] = "'" . $_POST['txtPriceLoc'] . "'";
	$insert['PRICE_RATE_ENG'] = "'" . $_POST['txtPriceEng'] . "'";
	$sql = "INSERT INTO  trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);


	header('Location: ' . $returnPage);
}

if (isset($_GET['edit'])) {

		$conid = $_GET['conid'];

		$subCatID = -1;
		//if (isset($_POST['cmbSubCategory'])) {
		if (isset($SCID) && nvl($SCID, '0') != '0') {
			$subCatID = $SCID;
			//$_POST['cmbSubCategory'];
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

		$update[] = "PRICE_RATE_LOC = '" . $_POST['txtPriceLoc'] . "'";
		$update[] = "PRICE_RATE_ENG = '" . $_POST['txtPriceEng'] . "'";

		$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " . $conid;
		mysql_query($sql, $conn);

		header('Location: ' . $returnPage);
	}

?>
