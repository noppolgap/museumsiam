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

    $sql = "UPDATE trn_product SET  " . implode(",", $update) . " WHERE PRODUCT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: product_view.php?MID='.$_GET['MID'].'&cid='.$catId.'&LV='.$_GET['LV'].' ');

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

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
	$insert['DETAIL_ENG'] = "'" . $_POST['detailEn'] . "'";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['start']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['end']) . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['brief_name_th'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['brief_name_en'] . "'";
	$insert['ORDER_DATA'] = $max;
	$insert['USER_CREATE'] = "'". $_SESSION['user_name']."'";
	$insert['CREATE_DATE'] = "NOW()";

    $sql = "INSERT INTO trn_product (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
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
			$insert['CAT_ID'] = "'" . $_GET['cid'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

		    $sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: product_view.php?MID='.$_GET['MID'].'&cid='.$_GET['cid'].'&LV='.$_GET['LV'].' ');

}

if (isset($_GET['edit'])) {

	$LV = intval($_GET['LV']);
	$cID = intval($_GET['cid']);
	$MID = intval($_GET['MID']);

	$update = "";

	$update[] = "PRODUCT_ID = '" . $_POST['pro_id'] . "'";
	$update[] = "CAT_ID = '" . $_POST['cat_id'] . "'";
	$update[] = "PRODUCT_DESC_LOC = '" . $_POST['product_name_th'] . "'";
	$update[] = "PRODUCT_DESC_ENG = '" . $_POST['product_name_en'] . "'";
	$update[] = "PRICE = '" . $_POST['price'] . "'";
	$update[] = "SALE='" . $_POST['sale'] . "'";
	$update[] = "DETAIL= '" . $_POST['detail'] . "'";
	$update[] = "DETAIL_ENG= '" . $_POST['detailEn'] . "'";

	$update[] = "LAST_UPDATE_USER = '". $_SESSION['user_name']."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$sql = "UPDATE trn_product SET  " . implode(",", $update) . " WHERE PRODUCT_ID = " . $_POST['pro_id'];
	mysql_query($sql, $conn);

	if (count($_POST['photo_file']) > 0) {
		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('product', end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = "'" . $_POST['pro_id'] . "'";
			$insert['IMG_TYPE'] = "'" . 1 . "'";
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" .$cID. "'";

			echo $sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: product_view.php?MID='.$MID.'&cid='.$cID.'&LV='.$LV);

}
