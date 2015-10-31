<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

 
$secid = $_GET['secid'];
 
$returnPage = 'main_department_view.php?secid='.$secid;

 

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "ACTIVE_FLAG = 2";

	$sql = "UPDATE mas_department SET  " . implode(",", $update) . " WHERE DEPARTMENT_ID =" . $id;

	mysql_query($sql, $conn);
}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM mas_department WHERE ACTIVE_FLAG <>2 and REF_SECTION_ID = ".$secid ;
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;


	unset($insert);
	$insert['DEPARTMENT_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['DEPARTMENT_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['REF_SECTION_ID'] = $secid ; 
	$insert['REF_ORG_ID'] = "1" ;
	$insert['DEPARTMENT_BREIFT_LOC'] = "'". $_POST['txtDetailLoc']."'";
	$insert['DEPARTMENT_BREIFT_ENG'] = "'". $_POST['txtDetailEng']."'";	
	$insert['ACTIVE_FLAG'] = "1";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['USER_CREATE'] = "'".$_SESSION['user_name']."'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'".$_SESSION['user_name']."'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	 

	$sql = "INSERT INTO mas_department (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);

}

if (isset($_GET['edit'])) {

	$update = "";

	
	$update[] = "DEPARTMENT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "DEPARTMENT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "DEPARTMENT_BREIFT_LOC = '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "DEPARTMENT_BREIFT_ENG = '" . $_POST['txtDetailEng'] . "'";
	$update[] = "LAST_UPDATE_USER = '". $_SESSION['user_name']  ."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	
	
	$sql = "UPDATE mas_department SET  " . implode(",", $update) . " WHERE DEPARTMENT_ID = " . $_GET['did'];
	mysql_query($sql, $conn) ;

	header('Location: ' . $returnPage);

}
