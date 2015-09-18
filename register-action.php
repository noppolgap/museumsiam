<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");


if($_GET["type"] == "province"){
	$id = intval($_GET["id"]);
	if($id == 0){
		$id = 102;
	}
	
	$arr = array();
	$sql = "SELECT DISTRICT_ID , DISTRICT_DESC_LOC FROM mas_district WHERE PROVINCE_ID = ".$id." ORDER BY DISTRICT_ID ASC ";
	$query = mysql_query($sql,$conn);	
	while($row = mysql_fetch_array($query)){
		$arr[$row['DISTRICT_ID']] = $row['DISTRICT_DESC_LOC']; 	
	}
	echo json_encode($arr);		
}else if($_GET["type"] == "district"){
	$id = intval($_GET["id"]);
	if($id == 0){
		$id = 10220;
	}
	
	$arr = array();
	$sql = "SELECT SUB_DISTRICT_ID , SUB_DISTRICT_DESC_LOC FROM mas_sub_district WHERE DISTRICT_ID = ".$id." ORDER BY SUB_DISTRICT_ID ASC ";
	$query = mysql_query($sql,$conn);	
	while($row = mysql_fetch_array($query)){
		$arr[$row['SUB_DISTRICT_ID']] = $row['SUB_DISTRICT_DESC_LOC']; 	
	}
	echo json_encode($arr);		
	
}else if($_POST["type"] == "email"){
	$sql = "SELECT * FROM sys_app_user WHERE EMAIL =  '".$_POST['email']."'";
	$query = mysql_query($sql,$conn);
	echo mysql_num_rows($query);
}else{
	/*ใส่โค้ดตรงนี้นะ*/
}

CloseDB(); 
?>