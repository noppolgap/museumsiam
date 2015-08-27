<?php
	require("../../assets/configs/config.inc.php");
	require("../../assets/configs/connectdb.inc.php");
	require("../../assets/configs/function.inc.php");

	$userID = $_POST['id'] ; 
	$strSQL = "update sys_app_user set ACTIVE_FLAG = 2 , LAST_UPDATE_USER = 'Test' , LAST_UPDATE_DATE = now() , LAST_FUNCTION = 'U' where ID = ". $userID ; 
	
	
	$objQuery = mysql_query($strSQL);
    if($objQuery)
    {
      echo "<script type='text/javascript'>window.location.href = '"._FULL_SITE_PATH_."/administrator/mod_user/index.php';</script>";
    }
    else
    {
      echo "Error Save [".$strSQL."]";
    }
	

?>