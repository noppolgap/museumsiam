<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

 

 
$returnPage = 'main_section_view.php';

 

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "ACTIVE_FLAG = 2";

	$sql = "UPDATE mas_section SET  " . implode(",", $update) . " WHERE SECTION_ID =" . $id;

	mysql_query($sql, $conn);

	//header('Location: main_km_view.php');

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM mas_section WHERE ACTIVE_FLAG <>2 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;


	unset($insert);
	$insert['SECTION_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['SECTION_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['ACTIVE_FLAG'] = "1";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['USER_CREATE'] = "'".$_SESSION['user_name']."'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'".$_SESSION['user_name']."'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	 

	$sql = "INSERT INTO mas_section (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);

}

if (isset($_GET['edit'])) {

	$update = "";

	
	$update[] = "SECTION_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "SECTION_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER = '". $_SESSION['user_name']  ."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	
	
	$sql = "UPDATE mas_section SET  " . implode(",", $update) . " WHERE SECTION_ID = " . $_GET['secid'];
	mysql_query($sql, $conn) ;

	header('Location: ' . $returnPage);

}
