<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

if (isset($_GET['enable'])) {

	$id = $_GET['proid'];
	$flag = $_GET['LV'];
	$catId = $_GET['cid'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "Flag = $Flag";

	echo $sql = "UPDATE trn_product SET  " . implode(",", $update) . " WHERE PRODUCT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: product_view.php?MID='.$_GET['MID'].'&cid='.$catId.'&LV='.$_GET['LV'].' ');

}

if (isset($_GET['delete'])) {

	$id = $_GET['proid'];
	$catId = $_GET['cid'];
	$update = "";
	$update[] = "Flag = 2";

	$sql = "UPDATE trn_product SET  " . implode(",", $update) . " WHERE PRODUCT_ID =" . $id;

	mysql_query($sql, $conn);

	//header('Location: product_view.php?p='.$catId.'');

}

if (isset($_GET['add'])) {

    $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_product WHERE FLAG <> 2 AND CAT_ID =".$_GET['cid'];
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);
	$insert['CAT_ID'] = "'" .$_GET['cid']. "'";
	$insert['PRODUCT_DESC_LOC'] = "'" . $_POST['product_name_th'] . "'";
	$insert['PRODUCT_DESC_ENG'] = "'" . $_POST['product_name_en'] . "'";
	$insert['PRICE'] = "'" . $_POST['price'] . "'";
	$insert['SALE'] = "'" . $_POST['sale'] . "'";
	$insert['DETAIL'] = "'" . $_POST['detail'] . "'";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['start']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['end']) . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['brief_name_th'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['brief_name_en'] . "'";
	$insert['ORDER_DATA'] = $max;
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

    $sql = "INSERT INTO trn_product (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql, $conn) or die($sql);
    $retrunID = mysql_insert_id();

	foreach ($_POST['photo_file'] as $k => $file) {
		$filename = admin_move_image_upload_dir('product', end(explode('/', $file)), 1000, '', false, 150, 150);

		unset($insert);
		$insert['CONTENT_ID'] = $retrunID;
		$insert['IMG_TYPE'] = "'" . getEXT($filename) . "'";
		$insert['IMG_PATH'] = "'" . $filename . "'";
		$insert['CAT_ID'] = "'" .$_GET['cid']. "'";

		$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
	}

	header('Location: product_view.php?MID='.$_GET['MID'].'&cid='.$_GET['cid'].'&LV='.$_GET['LV'].' ');

}

if (isset($_GET['edit'])) {

	$update = "";

	$update[] = "PRODUCT_ID = '" . $_POST['pro_id'] . "'";
	$update[] = "CAT_ID = '" . $_POST['cat_id'] . "'";
	$update[] = "PRODUCT_DESC_LOC = '" . $_POST['product_name_th'] . "'";
	$update[] = "PRODUCT_DESC_ENG = '" . $_POST['product_name_en'] . "'";
	$update[] = "PRICE = '" . $_POST['price'] . "'";
	$update[] = "SALE='" . $_POST['sale'] . "'";
	$update[] = "DETAIL= '" . $_POST['detail'] . "'";
	$update[] = "USER_CREATE = 'admin'";
	$update[] = "CREATE_DATE= NOW()";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_product SET  " . implode(",", $update) . " WHERE PRODUCT_ID = " . $_POST['pro_id'];
	mysql_query($sql, $conn);

	foreach ($_POST['photo_file'] as $k => $file) {
		$filename = admin_move_image_upload_dir('product', end(explode('/', $file)), 1000, '', false, 150, 150);

		unset($insert);
		$insert['CONTENT_ID'] = "'" . $_POST['cat_id'] . "'";
		$insert['IMG_TYPE'] = "'" . getEXT($filename) . "'";
		$insert['IMG_PATH'] = "'" . $filename . "'";
		$insert['CAT_ID'] = "'" .$_GET['cid']. "'";

		$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
	}

	header('Location: product_view.php?MID='.$_GET['MID'].'&cid='.$_GET['cid'].'&LV='.$_GET['LV'].' ');

}
