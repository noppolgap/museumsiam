<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
$indexPage = "/administrator/mod_other_link/index.php";
$moduleID = $_POST['id'];
$userLogin = $_SESSION['user_name'];
$strSQL = "update sys_app_module set ACTIVE_FLAG = 2  , LAST_UPDATE_USER = '".$userLogin."' , LAST_UPDATE_DATE = now() , LAST_FUNCTION = 'U' where MODULE_ID = " . $moduleID;

$objQuery = mysql_query($strSQL);
if ($objQuery) {
	echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . $indexPage . "';</script>";
} else {
	echo "Error Save [" . $strSQL . "]";
}
?>