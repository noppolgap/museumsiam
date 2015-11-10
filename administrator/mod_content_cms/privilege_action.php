<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$CMSID = $_GET['cmsid'];

$returnPage = 'privilege_edit.php?cmsid=' . $CMSID;

if (isset($_GET['edit'])) {

	$update = "";

	$update[] = "CMS_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CMS_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "CMS_TEXT_LOC= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "CMS_TEXT_ENG= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_content_cms SET  " . implode(",", $update) . " WHERE CMS_ID = " . $CMSID;
	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);
}
