<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$returnPage =  'main_category_view.php?MID='.$MID ;

if(isset($_GET['enable'])){

  $id = $_GET['cid'];
  $flag = $_GET['vis'];
  $Flag = "";


  if($flag == 1){
  	 $Flag = 0;
  }
  else{
  	 $Flag = 1;
  }
  $update="";
  $update[]= "Flag = $Flag";

  $sql=" UPDATE trn_content_category SET  ".implode(",",$update)." WHERE CONTENT_CAT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: '.$returnPage);
	
}

if(isset($_GET['delete'])){

  $id = $_POST['id'];
  
  $update="";
  $update[]= "Flag = 2";

  $sql="UPDATE trn_content_category SET  ".implode(",",$update)." WHERE CONTENT_CAT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  //header('Location: main_km_view.php');
	
}

if(isset($_GET['add'])){

  //$MID = $_GET['MID'];
  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_category WHERE FLAG<>2 and REF_MODULE_ID = '".$MID."' ";
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;


  $chkHasSubCategory = $_POST['chkHasSubCategory'];
  $isLastNode = "" ; 
	if ($chkHasSubCategory)
		$isLastNode = "N";
	else 
		$isLastNode= "Y";
	
  unset($insert);
    
	$insert['CONTENT_CAT_DESC_LOC'] 	= "'".$_POST['txtDescLoc']."'";
	$insert['CONTENT_CAT_DESC_ENG'] 	= "'".$_POST['txtDescEng']."'";
	$insert['ORDER_DATA']   = "'".$max."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	$insert['REF_MODULE_ID'] = "'".$MID."'";
	$insert['FLAG'] = "0";
	$insert['IS_LAST_NODE'] = "'".$isLastNode."'" ; 
    $sql = "INSERT INTO trn_content_category (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

	header('Location: '.$returnPage );
    //header('Location: main_category_view.php?MID='.$MID);
	
}

if(isset($_GET['edit'])){

	$update="";
	$chkHasSubCategory = $_POST['chkHasSubCategory'];
  $isLastNode = "" ; 
	if ($chkHasSubCategory)
		$isLastNode = "N";
	else 
		$isLastNode= "Y";
	
	$update[]= "CONTENT_CAT_DESC_LOC = '".$_POST['txtDescLoc']."'";
	$update[]= "CONTENT_CAT_DESC_ENG = '".$_POST['txtDescEng']."'";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
	$update[]= "IS_LAST_NODE = '".$isLastNode."'" ; 
    $sql= "UPDATE trn_content_category SET  ".implode(",",$update)." WHERE CONTENT_CAT_ID = ".$_POST['txtCatID'];
	mysql_query($sql,$conn);
	
    header('Location: '.$returnPage);
	
}

 