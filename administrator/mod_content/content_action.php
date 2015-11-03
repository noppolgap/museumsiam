<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$returnPage = 'content_view.php?MID=' . $MID;

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_content/'" . $returnPage . ";</script>";
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

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =" . $_POST['cmbCategory'];
	$subCatID = -1;
	if (isset($_POST['cmbSubCategory'])) {
		$sql_max .= " AND SUB_CAT_ID =" . $_POST['cmbSubCategory'];
		$subCatID = $_POST['cmbSubCategory'];
	}

	// echo $sql_max ;

	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CAT_ID'] = "'" . $_POST['cmbCategory'] . "'";
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
	$insert['MUSUEM_ID'] = "'-1'";
	$insert['APPROVE_FLAG'] = "'Y'";
	$insert['USER_CREATE'] = "'". $_SESSION['UID'];
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'". $_SESSION['UID'];
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO  trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	if (count($_POST['photo_file']) > 0) {
		$index = 1;
		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $_POST['cmbCategory'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $_POST['cmbCategory'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: ' . $returnPage);
	//echo $scriptReturnPath ;
}

if (isset($_GET['edit'])) {

	$conid = $_GET['conid'];

	$subCatID = -1;
	if (isset($_POST['cmbSubCategory'])) {
		$subCatID = $_POST['cmbSubCategory'];
	}

	$update = "";

	$update[] = "CONTENT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CONTENT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "CONTENT_DETAIL_LOC= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "CONTENT_DETAIL_ENG= '" . $_POST['txtDetailEng'] . "'";
	$update[] = "BRIEF_LOC= '" . $_POST['txtBriefDescLoc'] . "'";
	$update[] = "BRIEF_ENG= '" . $_POST['txtBriefDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER ='". $_SESSION['UID'];
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$update[] = "CAT_ID = '" . $_POST['cmbCategory'] . "'";
	$update[] = "SUB_CAT_ID = '" . $subCatID . "'";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " . $conid;
	mysql_query($sql, $conn);

	if (count($_POST['photo_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_ID) AS MAX_ORDER FROM trn_content_picture WHERE CONTENT_ID = " . $conid . " AND CAT_ID = " . $_POST['cmbCategory'];
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $_POST['cmbCategory'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $conid;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $_POST['cmbCategory'] . "'";
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

	header('Location: ' . $returnPage);
}

if (isset($_POST['catID'])) {
	$subCatSql = "select sc.SUB_CONTENT_CAT_ID , sc.SUB_CONTENT_CAT_DESC_LOC , sc.SUB_CONTENT_CAT_DESC_ENG 
											   from trn_content_sub_category sc
											where sc.CONTENT_CAT_ID = '$catID' and sc.flag <> 2
											ORDER BY sc.ORDER_DATA  desc  ";

	//	echo $subCatSql;
	$subCatQuery = mysql_query($subCatSql, $conn);

	$retStr = "<select id='cmbSubCategory' name = 'cmbSubCategory'>";
	$retStr .= "<option value='-1'>กรุณาเลือกหมวดหมู่ย่อย</option>";
	while ($rowSubCat = mysql_fetch_array($subCatQuery)) {
		$retStr .= "<option value='" . $rowSubCat["SUB_CONTENT_CAT_ID"] . "'  >" . $rowSubCat["SUB_CONTENT_CAT_DESC_LOC"] . "</option>";
	}mysql_free_result($subCatQuery);
	$retStr .= "</select>";

	echo $retStr;
	//echo "Come In".$catID  ;
	//return "Hello" ;
}
