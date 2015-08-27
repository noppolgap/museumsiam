<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_GET['enable'])){

  $id = $_GET['p'];
  $flag = $_GET['g'];
  $mainId = $_GET['a'];
  $Flag = "";


  if($flag == 1){
  	 $Flag = 0;
  }
  else{
  	 $Flag = 1;
  }
  $update="";
  $update[]= "Flag = $Flag";

  $sql="UPDATE trn_sub_digital_ach SET  ".implode(",",$update)." WHERE SUB_DIGITAL_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: sub_digital_view.php?p='.$mainId.' ');
	
}

if(isset($_GET['delete'])){

  $id = $_POST['id'];
  //$mainId = $_GET['a'];
  $update="";
  $update[]= "Flag = 2";

  $sql="UPDATE trn_sub_digital_ach SET  ".implode(",",$update)." WHERE SUB_DIGITAL_ID =".$id;
  
  mysql_query($sql,$conn);
	
  //header('Location: sub_digital_view.php?p='.$mainId.'');
	
}

if(isset($_GET['add'])){

  $id = $_GET['p'];
  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_sub_digital_ach WHERE FLAG<>2 AND MAIN_DIGITAL_ID =".$id;
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;


  unset($insert);
  $insert['MAIN_DIGITAL_ID'] 	= "'".$_POST['main_id']."'";
	$insert['SUB_DIGITAL_DESC_LOC'] 	= "'".$_POST['sub_name_th']."'";
	$insert['SUB_DIGITAL_DESC_ENG'] 	= "'".$_POST['sub_name_en']."'";
  $insert['ORDER_DATA']   = "'".$max."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
    $sql = "INSERT INTO trn_sub_digital_ach (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	  
    mysql_query($sql,$conn) or die($sql);

    header('Location: sub_digital_view.php?p='.$_POST['main_id'].'');
	
}

if(isset($_GET['edit'])){

	$update="";

	$update[]= "SUB_DIGITAL_DESC_LOC = '".$_POST['sub_name_th']."'";
	$update[]= "SUB_DIGITAL_DESC_ENG = '".$_POST['sub_name_en']."'";
	$update[]= "USER_CREATE = 'admin'";
	$update[]= "CREATE_DATE= NOW()";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql= "UPDATE trn_sub_digital_ach SET  ".implode(",",$update)." WHERE SUB_DIGITAL_ID = ".$_POST['sub_id'];
	mysql_query($sql,$conn);
	
    header('Location: sub_digital_view.php?p='.$_POST['main_id'].' ');
	
}

 