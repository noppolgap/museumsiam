<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE FLAG <>2 AND REF_WEBBOARD_ID= 0 AND cat_id = 17 ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);
	$insert['CAT_ID'] =  "'" . $_POST['position'] . "'"; 
	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['txtName'] . "'";
	$insert['PLACE_DESC_LOC'] = "'" . $_POST['txtAddress'] . "'";
	$insert['PLACE_DESC_ENG'] = "'" . $_POST['txtMail'] . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['txtTel'] . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['txtText'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_STATUS_FLAG'] = 2;
	$insert['USER_CREATE'] = "'".$_SESSION['user_name'] ."'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'".$_SESSION['user_name'] ."'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	

    echo $sql = "INSERT INTO trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	
	mysql_query($sql, $conn) or die($sql);


	header('Location: contact.php');

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
	$update[] = "USER_CREATE = 'admin'";
	$update[] = "CREATE_DATE= NOW()";
	$update[] = "LAST_UPDATE_USER = 'admin'";
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
