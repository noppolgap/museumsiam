<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_GET['enable'])){

  $id = $_GET['p'];
  $flag = $_GET['g'];
  $catId = $_GET['a'];
  $Flag = "";


  if($flag == 1){
  	 $Flag = 0;
  }
  else{
  	 $Flag = 1;
  }
  $update="";
  $update[]= "Flag = $Flag";

  $sql="UPDATE trn_product SET  ".implode(",",$update)." WHERE PRODUCT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: product_view.php?p='.$catId.' ');
	
}

if(isset($_GET['delete'])){

  $id = $_GET['p'];
  $catId = $_GET['a'];
  $update="";
  $update[]= "Flag = 2";

  $sql="UPDATE trn_product SET  ".implode(",",$update)." WHERE PRODUCT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: product_view.php?p='.$catId.'');
	
}

if(isset($_GET['add'])){

  /*unset($insert);
    $insert['CAT_ID'] 	= "'".$_POST['cat_id']."'";
	$insert['PRODUCT_DESC_LOC'] 	= "'".$_POST['product_name_th']."'";
	$insert['PRODUCT_DESC_ENG'] 	= "'".$_POST['product_name_en']."'";
	$insert['REF_MODULE_ID'] = 7;
	$insert['PRICE'] 	= "'".$_POST['price']."'";
	$insert['SALE'] 	= "'".$_POST['sale']."'";
	$insert['DETAIL'] 	= "'".$_POST['detail']."'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
    $sql = "INSERT INTO trn_product (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

    header('Location: product_view.php?p='.$_POST['cat_id'].'');*/

  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_category WHERE FLAG <> 2 AND REF_MODULE_ID = 7" ;
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;

    unset($insert);
	$insert['CONTENT_CAT_DESC_LOC'] 	= "'".$_POST['product_name_th']."'";
	$insert['CONTENT_CAT_DESC_ENG'] 	= "'".$_POST['product_name_en']."'";
	$insert['ORDER_DATA'] 	= "'".$max."'";
	$insert['REF_MODULE_ID'] 	= 5;
	$insert['FLAG'] 	= 0;
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
	$sql = "INSERT INTO trn_content_category (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	mysql_query($sql,$conn) or die($sql);

    header('Location: product_view.php?p='.$_POST['cat_id'].'');
	
}

if(isset($_GET['edit'])){

 $update="";
  
	$update[]= "PRODUCT_ID = '".$_POST['pro_id']."'";
	$update[]= "CAT_ID = '".$_POST['cat_id']."'";
	$update[]= "PRODUCT_DESC_LOC = '".$_POST['product_name_th']."'";
	$update[]= "PRODUCT_DESC_ENG = '".$_POST['product_name_en']."'";
	$update[]= "PRICE = '".$_POST['price']."'";
	$update[]= "SALE='".$_POST['sale']."'";
	$update[]= "DETAIL= '".$_POST['detail']."'";
	$update[]= "USER_CREATE = 'admin'";
	$update[]= "CREATE_DATE= NOW()";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql= "UPDATE trn_product SET  ".implode(",",$update)." WHERE PRODUCT_ID = ".$_POST['pro_id'];
	mysql_query($sql,$conn);
	
    header('Location: product_view.php?p='.$_POST['cat_id'].' ');
	
}

 