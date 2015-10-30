<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$CID = $_GET['cid'];
$SCID = $_GET['SCID'];
$LV = $_GET['LV'];

$subfix = '';
if (isset($SCID) && nvl($SCID, '') != '')
	$subfix = '&SCID=' . $SCID;
$returnPage = 'main_sub_category_view.php?MID=' . $MID . '&cid=' . $CID . '&LV=' . $LV . $subfix;

if (isset($_GET['enable'])) {

	$id = $_GET['subcid'];
	$flag = $_GET['vis'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "Flag = $Flag";

	$sql = " UPDATE trn_content_sub_category SET  " . implode(",", $update) . " WHERE SUB_CONTENT_CAT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "Flag = 2";

	$sql = "UPDATE trn_content_sub_category SET  " . implode(",", $update) . " WHERE SUB_CONTENT_CAT_ID =" . $id;

	mysql_query($sql, $conn);

	//header('Location: main_km_view.php');

}

if (isset($_GET['add'])) {

	$refSubModule = 0;
	$subfixWhere = "";
	if (isset($SCID) && nvl($SCID, '') != '') {
		$refSubModule = $SCID;
		$subfixWhere = " and REF_SUB_CONTENT_CAT_ID = " . $SCID;
	}

	//$MID = $_GET['MID'];
	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_sub_category WHERE FLAG<>2 and CONTENT_CAT_ID = '" . $CID . "' " . $subfixWhere;
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	$chkHasSubCategory = $_POST['chkHasSubCategory'];
	$isLastNode = "";
	if ($chkHasSubCategory)
		$isLastNode = "N";
	else
		$isLastNode = "Y";

	unset($insert);
	$insert['CONTENT_CAT_ID'] = "'" . $CID . "'";
	$insert['SUB_CONTENT_CAT_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['SUB_CONTENT_CAT_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	$insert['FLAG'] = "0";

	$insert['REF_SUB_CONTENT_CAT_ID'] = "'" . $refSubModule . "'";
	$insert['IS_LAST_NODE'] = "'" . $isLastNode . "'";

	$sql = "INSERT INTO trn_content_sub_category (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);

}

if (isset($_GET['edit'])) {

	$update = "";

	$chkHasSubCategory = $_POST['chkHasSubCategory'];
	$isLastNode = "";
	$refSubModule = 0;
	if ($chkHasSubCategory) {
		$isLastNode = "N";
		if (isset($SCID) && nvl($SCID, '') != '')
			$refSubModule = $SCID;
	} else
		$isLastNode = "Y";

	//$update[] = "CONTENT_CAT_ID = '" . $_POST['cmbCategory'] . "'";
	$update[] = "SUB_CONTENT_CAT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "SUB_CONTENT_CAT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$update[] = "REF_SUB_CONTENT_CAT_ID = '" . $refSubModule . "'";
	$update[] = "IS_LAST_NODE = '" . $isLastNode . "'";

	$sql = "UPDATE trn_content_sub_category SET  " . implode(",", $update) . " WHERE SUB_CONTENT_CAT_ID = " . $_GET['subcid'];
	mysql_query($sql, $conn) ;

	header('Location: ' . $returnPage);

}
