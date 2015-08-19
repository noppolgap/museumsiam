<?php
	require("../../assets/configs/config.inc.php");
	require("../../assets/configs/connectdb.inc.php");
	require("../../assets/configs/function.inc.php");
	$indexPage = "/administrator/mod_sub_module/index.php";
	$subModuleID = $_GET['SMID'] ; 
	$strSQL = "update sys_app_sub_module set ACTIVE_FLAG = 2  , LAST_UPDATE_USER = 'Test' , LAST_UPDATE_DATE = now() , LAST_FUNCTION = 'U' where SUB_MODULE_ID = ". $subModuleID ; 
	
	
	$objQuery = mysql_query($strSQL);
    if($objQuery)
    {
      echo "<script type='text/javascript'>window.location.href = '"._FULL_SITE_PATH_.$indexPage."';</script>";
    }
    else
    {
      echo "Error Save [".$strSQL."]";
    }
	

?>