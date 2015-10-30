<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$CMSID = $_GET['cmsid'];
 
$returnPage = 'index.php';

 
$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_category/'" . $returnPage . ";</script>";
   
if (isset($_GET['edit'])) {

	 
	$update = "";

	$update[] = "CMS_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CMS_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "CMS_TEXT_LOC= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "CMS_TEXT_ENG= '" . $_POST['txtDetailEng'] . "'";
	$update[] = "LAST_UPDATE_USER = '".$_SESSION['user_name']."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	

	$sql = "UPDATE trn_content_cms SET  " . implode(",", $update) . " WHERE CMS_ID = " . $CMSID;
	mysql_query($sql, $conn);

	     
	header('Location: ' . $returnPage);
}
 