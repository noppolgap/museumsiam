<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

if (isset($_GET['enable'])) {

	$id = $_GET['qa_id'];
	$flag = $_GET['flag'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "Flag = $Flag";

	$sql = "UPDATE trn_qa SET  " . implode(",", $update) . " WHERE QA_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: index.php');

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];
	$update = "";
	$update[] = "FLAG = 2";

	echo $sql = "UPDATE trn_qa SET  " . implode(",", $update) . " WHERE QA_ID =" . $id;

	mysql_query($sql, $conn);

	//header('Location: index.php');

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_qa WHERE FLAG <> 2 AND REF_QA_ID = 0 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);
	$insert['CONTENT'] = "'" . $_POST['question'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['FLAG'] = 0;
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO trn_qa (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);

	header('Location: index.php');

}

if (isset($_GET['edit'])) {

	$update = "";
	$id = $_GET['qa_id'];
	$update[] = "CONTENT = '" . $_POST['question'] . "'";
	$update[] = "USER_CREATE = 'admin'";
	$update[] = "CREATE_DATE= NOW()";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_qa SET  " . implode(",", $update) . " WHERE QA_ID =" . $id;
	mysql_query($sql, $conn);

	header('Location: index.php');

}

if (isset($_GET['search'])) {

	$sql = "";
	mysql_query($sql, $conn);
}
?>