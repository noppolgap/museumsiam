<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

if (isset($_GET['enable'])) {

	$id = $_GET['p'];
	$flag = $_GET['g'];
	$subId = $_GET['a'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "Flag = $Flag";

	$sql = "UPDATE trn_digital_ach SET  " . implode(",", $update) . " WHERE DIGITAL_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: digital_view.php?p=' . $subId . '');

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];
	//$subId = $_GET['a'];
	$update = "";
	$update[] = "Flag = 2";

	$sql = "UPDATE trn_digital_ach SET  " . implode(",", $update) . " WHERE DIGITAL_ID =" . $id;

	mysql_query($sql, $conn);

	// header('Location: digital_view.php?p='.$subId.'');

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_digital_ach WHERE FLAG <>2 AND SUB_DIGITAL_ID =" . $_POST['sub_id'];
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['SUB_DIGITAL_ID'] = "'" . $_POST['sub_id'] . "'";
	$insert['DIGITAL_DESC_LOC'] = "'" . $_POST['name_th'] . "'";
	$insert['DIGITAL_DESC_ENG'] = "'" . $_POST['name_en'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['DETAIL'] = "'" . $_POST['detail'] . "'";
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO  trn_digital_ach (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);

	header('Location: digital_view.php?p=' . $_POST['sub_id'] . '');

}

if (isset($_GET['edit'])) {

	$update = "";

	$update[] = "DIGITAL_DESC_LOC = '" . $_POST['name_th'] . "'";
	$update[] = "DIGITAL_DESC_ENG = '" . $_POST['name_en'] . "'";
	$update[] = "DETAIL= '" . $_POST['detail'] . "'";
	$update[] = "USER_CREATE = 'admin'";
	$update[] = "CREATE_DATE= NOW()";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_digital_ach SET  " . implode(",", $update) . " WHERE DIGITAL_ID = " . $_POST['digi_id'];
	mysql_query($sql, $conn);

	header('Location: digital_view.php?p=' . $_POST['sub_id'] . ' ');

}
