<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MUID = $_GET['MUID'];

 



if (isset($_GET['approve']))
{
	$update = "";
	 
	$update[] = "APPROVE_FLAG = 'Y' ";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";
	
	$sql = "UPDATE trn_museum_detail SET  " . implode(",", $update) . " WHERE MUSEUM_DETAIL_ID = " . $MUID;
	mysql_query($sql, $conn);

	$returnPage = 'pending_museum_view.php';
	header('Location: ' . $returnPage);
}


  if(isset($_GET['deapprove']))
  {
  	$update = "";
	 
	$update[] = "APPROVE_FLAG = 'N' ";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";
	
	$sql = "UPDATE trn_museum_detail SET  " . implode(",", $update) . " WHERE MUSEUM_DETAIL_ID = " . $MUID;
	mysql_query($sql, $conn);

	$returnPage = 'approved_museum_view.php';
	header('Location: ' . $returnPage);
  }

 
