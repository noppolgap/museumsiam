<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");

$address = intval($_POST['address']);

if($address == 0){
		$insert['NAME'] 	= "'" . $_POST['name']  . "'";
		$insert['ADDRESS1'] 	= "'" . $_POST['adds']  . "'";
		$insert['DISTRICT_ID'] 	= "'" . $_POST['district']  . "'";
		$insert['SUB_DISTRICT_ID'] = "'" . $_POST['sub_district']  . "'";
		$insert['PROVINCE_ID'] 	= "'" . $_POST['province']  . "'";
		$insert['POST_CODE'] 	= "'" . $_POST['postcode']  . "'";
		$insert['UID'] 		= "'" . $_SESSION['UID']  . "'";
		$sql = "INSERT INTO sys_app_address (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
}

if (isset($_GET['add'])) {

	unset($insert);


	$insert_d['PRODUCT_ID'] = "'" .$_POST['proid']. "'";
	$insert['USER_CREATE'] = "'BENJAWAN CHINNAPONG'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'BENJAWAN CHINNAPONG'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";

	$sql = "INSERT INTO  trn_order (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	unset($insert_d);
		$insert_d['ORDER_ID'] = $retrunID;
		$insert_d['QUATITY'] = 1 ;
		$insert_d['PRODUCT_ID'] = "'" .$_POST['proid']. "'";
		$insert_d['CAT_ID'] = "'" .$_POST['cid']. "'";
		$insert_d['PRICE'] = "'" .$_POST['price']. "'";
		$insert_d['CUSTOMER_ID'] = "'" .$_POST['cus_id']. "'";

		$sql_d = "INSERT INTO trn_order_detail (" . implode(",", array_keys($insert_d)) . ") VALUES (" . implode(",", array_values($insert_d)) . ")";
    mysql_query($sql_d, $conn) or die($sql_d);

	//header('Location: e-shopping-cart.php');

}

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