<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$returnPage =  'content_view.php?MID='.$MID ;

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '"._FULL_SITE_PATH_."/administrator/mod_content/'".$returnPage.";</script>";
if(isset($_GET['enable'])){

    $id = $_GET['conid'];
	$flag = $_GET['vis'];
	$Flag = "";


  if($flag == 1){
  	 $Flag = 0;
  }
  else{
  	 $Flag = 1;
  }
  $update="";
  $update[]= "CONTENT_STATUS_FLAG = $Flag";

  $sql="UPDATE trn_content_detail SET  ".implode(",",$update)." WHERE CONTENT_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: '.$returnPage );
	
}

if(isset($_GET['delete'])){

  $id = $_POST['id'];
  
  $update="";
  $update[]= "CONTENT_STATUS_FLAG = 2";

  $sql="UPDATE trn_content_detail SET  ".implode(",",$update)." WHERE CONTENT_ID =".$id;
  
  mysql_query($sql,$conn);
		
}

if(isset($_GET['add']) ){


  $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =".$_POST['cmbCategory'];
  $subCatID = -1 ; 
  if (isset($_POST['cmbSubCategory']))
  {
	  $sql_max.= " AND SUB_CAT_ID =".$_POST['cmbSubCategory'] ; 
	  $subCatID = $_POST['cmbSubCategory'];
  }
  
 // echo $sql_max ;
  
  $query_max = mysql_query($sql_max,$conn);
  $row_max = mysql_fetch_array($query_max);
  $max = $row_max['MAX_ORDER'];
  $max++;

  unset($insert);

	$insert['CAT_ID'] 	= "'".$_POST['cmbCategory']."'";
	$insert['SUB_CAT_ID'] = "'".$subCatID."'";
	  
	$insert['CONTENT_DESC_LOC'] = "'".$_POST['txtDescLoc']."'";
	$insert['CONTENT_DESC_ENG'] = "'".$_POST['txtDescEng']."'";
	$insert['ORDER_DATA']   = "'".$max."'";
	$insert['CONTENT_DETAIL_LOC'] 	= "'".$_POST['txtDetailLoc']."'";
	$insert['CONTENT_DETAIL_ENG'] 	= "'".$_POST['txtDetailEng']."'";
	$insert['CONTENT_STATUS_FLAG'] = "'0'";
	$insert['CONTENT_VIEW_COUNT'] = "0" ; 
	$insert['BRIEF_LOC'] = "'".$_POST['txtBriefDescLoc']."'";
	$insert['BRIEF_ENG'] = "'".$_POST['txtBriefDescEng']."'";
	$insert['MUSUEM_ID'] = "'-1'" ; 
	$insert['APPROVE_FLAG'] = "'Y'";
	$insert['USER_CREATE'] 		= "'admin'";
	$insert['CREATE_DATE'] 		= "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
					
    $sql = "INSERT INTO  trn_content_detail (".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
	
	mysql_query($sql,$conn) or die($sql);

    header('Location: '.$returnPage );
	//echo $scriptReturnPath ;
}
 

if(isset($_GET['edit'])){

 $update="";
  
	$update[]= "DIGITAL_DESC_LOC = '".$_POST['name_th']."'";
	$update[]= "DIGITAL_DESC_ENG = '".$_POST['name_en']."'";
	$update[]= "DETAIL= '".$_POST['detail']."'";
	$update[]= "USER_CREATE = 'admin'";
	$update[]= "CREATE_DATE= NOW()";
	$update[]= "LAST_UPDATE_USER = 'admin'";
	$update[]= "LAST_UPDATE_DATE = NOW()";
					
    $sql= "UPDATE trn_digital_ach SET  ".implode(",",$update)." WHERE DIGITAL_ID = ".$_POST['digi_id'];
	  mysql_query($sql,$conn);
	
    header('Location: digital_view.php?p='.$_POST['sub_id'].' ');
	
	
	
}

if (isset($_POST['catID'])) {
		$subCatSql = "select sc.SUB_CONTENT_CAT_ID , sc.SUB_CONTENT_CAT_DESC_LOC , sc.SUB_CONTENT_CAT_DESC_ENG 
											   from trn_content_sub_category sc
											where sc.CONTENT_CAT_ID = '$catID' and sc.flag <> 2
											ORDER BY sc.ORDER_DATA  desc  " ;
											
										//	echo $subCatSql;
								 $subCatQuery = mysql_query($subCatSql,$conn);
								
								$retStr =  "<select id='cmbSubCategory' name = 'cmbSubCategory'>";
								$retStr.= "<option value='-1'>กรุณาเลือกหมวดหมู่ย่อย</option>";
								while($rowSubCat = mysql_fetch_array($subCatQuery)){
									$retStr.= "<option value='".$rowSubCat["SUB_CONTENT_CAT_ID"]."'  >".$rowSubCat["SUB_CONTENT_CAT_DESC_LOC"]."</option>";
								}mysql_free_result($subCatQuery);
								$retStr.= "</select>";
		
		
		echo $retStr ;
		//echo "Come In".$catID  ; 
		//return "Hello" ; 
	}

	 

    
 
	

 