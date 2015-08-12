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

  $sql="UPDATE trn_category SET  ".implode(",",$update)." WHERE CAT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: index.php');
	
}

if(isset($_GET['delete'])){

  $id = $_GET['p'];
  $update="";
  $update[]= "Flag = 2";

  $sql="UPDATE trn_category SET  ".implode(",",$update)." WHERE CAT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: index.php');
	
}

if(isset($_GET['add'])){

  unset($insert);
	$insert['CAT_DESC_LOC'] 	= "'".$_POST['name-th']."'";
	$insert['CAT_DESC_ENG'] 	= "'".$_POST['name-en']."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
	$sql = "INSERT INTO trn_category (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

    header('Location: index.php');
	
}

if(isset($_GET['edit'])){

 $update="";
    $id = $_GET['p'];
	$update[]= "CAT_ID = '".$_GET['p']."'";
	$update[]= "CAT_DESC_LOC = '".$_POST['name-th']."'";
	$update[]= "CAT_DESC_ENG = '".$_POST['name-en']."'";
	$update[]= "USER_CREATE = 'admin'";
	$update[]= "CREATE_DATE= NOW()";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql="UPDATE trn_category SET  ".implode(",",$update)." WHERE CAT_ID =".$id;
	mysql_query($sql,$conn);
	
    header('Location: index.php');
	
}

if(isset($_GET['search'])){

	 $sql="";
     mysql_query($sql,$conn);


}

?>