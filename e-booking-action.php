<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");

//add to trn order
		unset($insert);
		$insert['FLAG'] = "0";
		$insert['TYPE'] = "'".$_POST['type']."'";
		$insert['CUSTOMER_ID'] = "'" .$_SESSION['UID']."'";
		$insert['USER_CREATE'] = "'". $_SESSION['UID']."'";
		$insert['CREATE_DATE'] = "NOW()";
		$insert['LAST_UPDATE_USER'] = "'". $_SESSION['UID']."'";
		$insert['LAST_UPDATE_DATE'] = "NOW()";

		$sql = "INSERT INTO trn_order (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
		$order_id = mysql_insert_id();

//add to trn order detail
$total_price = 0;
$sql_cart = "SELECT PRODUCT_ID , IF(SALE > 0, SALE, PRICE) AS pro_PRICE, CAT_ID FROM trn_product WHERE PRODUCT_ID = '".$_POST['id']."'";
$query_cart = mysql_query($sql_cart, $conn) or die($sql_cart);
while($row_cart = mysql_fetch_array($query_cart)){

		unset($insert);
		$insert['ORDER_ID'] = "'". $order_id ."'";
		$insert['CUSTOMER_ID'] = "'". $_SESSION['UID']."'";
		$insert['QUANTITY'] = "'". $_POST['person']."'";
		$insert['PRODUCT_ID'] = "'". $row_cart['PRODUCT_ID']."'";
		$insert['CAT_ID'] = "'". $row_cart['CAT_ID']."'";
		$insert['PRICE'] = "'". $row_cart['pro_PRICE']."'";

		$sql = "INSERT INTO trn_order_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);

		$total_price += ($_POST['person'] * $row_cart['pro_PRICE']);
}

//update to trn order
mysql_query("UPDATE trn_order SET SUMPRICE = ".$total_price." WHERE ORDER_ID = ".$order_id, $conn);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
</head>

<body>
<script>
alert('บันทึกคำสั่งซื้อเรียบย้อย');
</script>
</body>
</html>