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

  $sql=" UPDATE trn_main_digital_ach SET  ".implode(",",$update)." WHERE MAIN_DIGITAL_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: main_digital_view.php');
	
}

if(isset($_GET['delete'])){

  $id = $_GET['p'];
  $catId = $_GET['a'];
  $update="";
  $update[]= "Flag = 2";

  $sql="UPDATE trn_main_digital_ach SET  ".implode(",",$update)." WHERE MAIN_DIGITAL_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: main_digital_view.php');
	
}

if(isset($_GET['add'])){

  unset($insert);
    
	$insert['MAIN_DIGITAL_DESC_LOC'] 	= "'".$_POST['main-digital-th']."'";
	$insert['MAIN_DIGITAL_DESC_ENG'] 	= "'".$_POST['main-digital-en']."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
    $sql = "INSERT INTO trn_main_digital_ach (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

    header('Location: main_digital_view.php');
	
}

if(isset($_GET['edit'])){

 $update="";
  
	$update[]= "MAIN_DIGITAL_ID = '".$_POST['main_digital_id']."'";
	$update[]= "MAIN_DIGITAL_DESC_LOC = '".$_POST['main-digital-th']."'";
	$update[]= "MAIN_DIGITAL_DESC_ENG = '".$_POST['main-digital-en']."'";
	$update[]= "USER_CREATE = 'admin'";
	$update[]= "CREATE_DATE= NOW()";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql= "UPDATE trn_main_digital_ach SET  ".implode(",",$update)." WHERE MAIN_DIGITAL_ID = ".$_POST['main_digital_id'];
	mysql_query($sql,$conn);
	
    header('Location: main_digital_view.php');
	
}

 