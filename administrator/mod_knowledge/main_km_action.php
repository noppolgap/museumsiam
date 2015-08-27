<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_GET['enable'])){

  $id = $_GET['p'];
  $flag = $_GET['g'];
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
	
  header('Location: main_km_view.php');
	
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

  $id = $_GET['p'];
  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_category WHERE FLAG<>2 and REF_MODULE_ID = 2 ";
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;


  unset($insert);
    
	$insert['CONTENT_CAT_DESC_LOC'] 	= "'".$_POST['txtDescLoc']."'";
	$insert['CONTENT_CAT_DESC_ENG'] 	= "'".$_POST['txtDescEng']."'";
	$insert['ORDER_DATA']   = "'".$max."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	$insert['REF_MODULE_ID'] = "2";
	$insert['FLAG'] = "0";
    $sql = "INSERT INTO trn_content_category (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

    header('Location: main_km_view.php');
	
}

if(isset($_GET['edit'])){

 $update="";
  
	//$update[]= "MAIN_DIGITAL_ID = '".$_POST['main_digital_id']."'";
	$update[]= "CONTENT_CAT_DESC_LOC = '".$_POST['txtDescLoc']."'";
	$update[]= "CONTENT_CAT_DESC_ENG = '".$_POST['txtDescEng']."'";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql= "UPDATE trn_content_category SET  ".implode(",",$update)." WHERE CONTENT_CAT_ID = ".$_POST['txtCatID'];
	mysql_query($sql,$conn);
	
    header('Location: main_km_view.php');
	
}

 