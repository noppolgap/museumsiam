<?php
	require("../../assets/configs/config.inc.php");
	require("../../assets/configs/connectdb.inc.php");
	require("../../assets/configs/function.inc.php");
	$indexPage = "/administrator/mod_module/index.php";
	$moduleID = $_GET['MID'] ; 
	$strSQL = "update sys_app_module set ACTIVE_FLAG = 2  , LAST_UPDATE_USER = 'Test' , LAST_UPDATE_DATE = now() , LAST_FUNCTION = 'U' where MODULE_ID = ". $moduleID ; 
	
	
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