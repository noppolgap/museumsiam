<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

if (isset($_GET['enable'])) {

	$id = $_GET['p'];
	$flag = $_GET['g'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = $Flag";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: viewVirsualExhib.php?p=' . $_GET['a'] . ' ');

}

if (isset($_GET['delete'])) {

	$id = intval($_POST['id']);
	$pid = intval($_GET['p']);

	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = 2";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	deleteImageList($id, $pid);

	// header('Location: viewVirsualExhib.php?p='.$_GET['a'].'');

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <> 2 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);
	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['name_th'] . "'";
	$insert['CONTENT_DESC_ENG'] = "'" . $_POST['name_en'] . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['brief_name_th'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['brief_name_en'] . "'";
	$insert['DETAIL'] = "'" . $_POST['detail'] . "'";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['start']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['end']) . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CAT_ID'] = "'" . $_GET['p'] . "'";
	$insert['CONTENT_STATUS_FLAG'] = 0;
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	if (count($_POST['photo_file']) > 0) {
		$index = 1;
		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('virsual', end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $_GET['p'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: viewVirsualExhib.php?p=' . $_GET['p'] . '');

}

if (isset($_GET['edit'])) {

	$id = $_GET['p'];
	$update = "";
	$update[] = "CONTENT_DESC_LOC = '" . $_POST['name_th'] . "'";
	$update[] = "CONTENT_DESC_ENG = '" . $_POST['name_en'] . "'";
	$update[] = "BRIEF_LOC = '" . $_POST['brief_name_th'] . "'";
	$update[] = "BRIEF_ENG = '" . $_POST['brief_name_en'] . "'";
	$update[] = "DETAIL = '" . $_POST['detail'] . "'";
	$update[] = "EVENT_START_DATE ='" . ConvertDateToDB($_POST['start']) . "'";
	$update[] = "EVENT_END_DATE ='" . ConvertDateToDB($_POST['end']) . "'";
	$update[] = "USER_CREATE = 'admin'";
	$update[] = "CREATE_DATE= NOW()";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;
	mysql_query($sql, $conn);

	if (count($_POST['photo_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_ID) AS MAX_ORDER FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID = " . $_POST['cat_id'];
		$query_max = mysql_query($sql_max, $conn);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('virsual', end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $id;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $_POST['cat_id'] . "'";
			$insert['ORDER_ID'] = $max++;

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}
	if (count($_POST['order_position']) > 0) {
		foreach ($_POST['order_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: viewVirsualExhib.php?p=' . $_POST['cat_id'] . '');

}

if (isset($_GET['search'])) {

	$sql = "";
	mysql_query($sql, $conn);
}
?>