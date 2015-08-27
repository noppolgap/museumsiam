<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_GET['enable'])){

  $id = $_GET['conid'];
  $flag = $_GET['flag'];
  $catID = $_GET['cid'];
   
  $Flag = "";


  if($flag == '1'){
  	 $Flag = '0';
  }
  else{
  	 $Flag = '1';
  }
  $update="";
  $update[]= "CONTENT_STATUS_FLAG = '$Flag' ";

  $sql="UPDATE trn_content_detail SET  ".implode(",",$update)." WHERE CONTENT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: km_view.php?cid='.$catID.'');
	
}

if(isset($_GET['delete'])){

  $id = $_POST['id'];
  
  $update="";
  $update[]= "CONTENT_STATUS_FLAG = '2'";

  $sql="UPDATE trn_content_detail SET  ".implode(",",$update)." WHERE CONTENT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  //header('Location: km_view.php?p='.$subId.'');
	
}

if(isset($_GET['add'])){
$catID = $_GET['cid'] ; 
  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =".$catID;
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;

  unset($insert);

  $insert['CAT_ID'] 	= "'".$catID."'";
	$insert['CONTENT_DESC_LOC'] = "'".$_POST['txtDescLoc']."'";
	$insert['CONTENT_DESC_ENG'] = "'".$_POST['txtDescEng']."'";
	$insert['ORDER_DATA']   = "'".$max."'";
	//$insert['DETAIL'] 	= "'".$_POST['detail']."'";
	
	$insert['CONTENT_DETAIL_LOC'] 	= "'".$_POST['txtDetailLoc']."'";
	$insert['CONTENT_DETAIL_ENG'] 	= "'".$_POST['txtDetailEng']."'";
	$insert['CONTENT_STATUS_FLAG'] = "'0'"; // Force Enable for Global KM
	$insert['CONTENT_VIEW_COUNT'] = "0";
	
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
					
	$insert['BRIEF_LOC'] = "'".$_POST['txtBriefLoc']."'";
	$insert['BRIEF_ENG'] = "'".$_POST['txtBriefEng']."'";
	$insert['EVENT_START_DATE'] = "now()";
	$insert['EVENT_END_DATE'] = "now()";
	$insert['MUSUEM_ID'] = "-1" ;  // Force -1 for Global KM
	$insert['APPROVE_FLAG'] = "'Y'"; // Force  = 'Y' for Global KM

    $sql = "INSERT INTO  trn_content_detail (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	
	mysql_query($sql,$conn) or die($sql);

    header('Location: km_view.php?cid='.$catID.'');
	
}

if(isset($_GET['edit'])){

 $update="";
  
	$update[]= "CONTENT_DESC_LOC = '".$_POST['txtDescLoc']."'";
	$update[]= "CONTENT_DESC_ENG = '".$_POST['txtDescEng']."'";
	
	$update[]= "CONTENT_DETAIL_LOC= '".$_POST['txtDetailLoc']."'";
	$update[]= "CONTENT_DETAIL_ENG= '".$_POST['txtDetailEng']."'";
	
	 
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
			

	$update[]= "BRIEF_LOC= '".$_POST['txtBriefLoc']."'";
	$update[]= "BRIEF_ENG= '".$_POST['txtBriefEng']."'";
  

	
    $sql= "UPDATE trn_content_detail SET  ".implode(",",$update)." WHERE CONTENT_ID = ".$_GET['conid'];
	  mysql_query($sql,$conn);
	
    header('Location: km_view.php?cid='.$_POST['txtCatID'].' ');
	
}

 