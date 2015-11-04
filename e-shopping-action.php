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
		$address = mysql_insert_id();
}

if ($_SESSION['LANG'] == 'TH') {
	$PROVINCE_SQL = "PROVINCE_DESC_LOC";
	$DISTRICT_SQL = "DISTRICT_DESC_LOC";
	$SUB_DISTRICT_SQL = "SUB_DISTRICT_DESC_LOC";
} else if ($_SESSION['LANG'] == 'EN') {
	$PROVINCE_SQL = "PROVINCE_DESC_ENG";
	$DISTRICT_SQL = "DISTRICT_DESC_ENG";
	$SUB_DISTRICT_SQL = "SUB_DISTRICT_DESC_ENG";
}

//find address
$sql_address = "SELECT * ,
				(SELECT ".$PROVINCE_SQL." FROM mas_province WHERE mas_province.PROVINCE_ID = sys_app_address.PROVINCE_ID) AS PROVINCE ,
				(SELECT ".$DISTRICT_SQL." FROM mas_district WHERE mas_district.DISTRICT_ID = sys_app_address.DISTRICT_ID) AS DISTRICT ,
				(SELECT ".$SUB_DISTRICT_SQL." FROM mas_sub_district WHERE mas_sub_district.SUB_DISTRICT_ID = sys_app_address.SUB_DISTRICT_ID) AS SUB_DISTRICT
 			FROM sys_app_address WHERE ID = ".$address;

$query_address = mysql_query($sql_address, $conn) or die($sql_address);
$row_address = mysql_fetch_array($query_address);
$C_Address = $row_address['NAME'].' '.$row_address['ADDRESS1'].' '.$row_address['ADDRESS2'].' '.$row_address['SUB_DISTRICT'].' '.$row_address['DISTRICT'].' '.$row_address['PROVINCE'].' '.$row_address['POST_CODE'];

//add to trn order
		unset($insert);
		$insert['FLAG'] = "0";
		$insert['ADDRESS'] = "'" .$C_Address. "'";
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
$sql_cart = "SELECT PRODUCT_ID , cart.trn_shopping_cart_Quantity AS Quantity , IF(pro.SALE > 0, pro.SALE, pro.PRICE) AS pro_PRICE, CAT_ID FROM trn_shopping_cart AS cart
		LEFT JOIN trn_product AS pro ON cart.trn_shopping_cart_pID = pro.PRODUCT_ID WHERE cart.trn_shopping_cart_SSID = '".session_id()."'";
$query_cart = mysql_query($sql_cart, $conn) or die($sql_cart);
while($row_cart = mysql_fetch_array($query_cart)){

		unset($insert);
		$insert['ORDER_ID'] = "'". $order_id ."'";
		$insert['CUSTOMER_ID'] = "'". $_SESSION['UID']."'";
		$insert['QUANTITY'] = "'". $row_cart['Quantity']."'";
		$insert['PRODUCT_ID'] = "'". $row_cart['PRODUCT_ID']."'";
		$insert['CAT_ID'] = "'". $row_cart['CAT_ID']."'";
		$insert['PRICE'] = "'". $row_cart['pro_PRICE']."'";

		$sql = "INSERT INTO trn_order_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);

		$total_price += ($row_cart['Quantity'] * $row_cart['pro_PRICE']);
}

//update to trn order
mysql_query("UPDATE trn_order SET SUMPRICE = ".$total_price." WHERE ORDER_ID = ".$order_id, $conn);
mysql_query("DELETE FROM trn_shopping_cart WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_Type = 'shopping'", $conn);
mysql_query("OPTIMIZE TABLE trn_shopping_cart", $conn);

/*
	unset($insert);


	$insert_d['PRODUCT_ID'] = "'" .$_POST['proid']. "'";
	/*
	$sql_temp = "select cart.QUATITY, pro.PRICE , pro.CAT_ID, pro.PRICE, pro.PRODUCT_ID
				from trn_shopping_cart cart
				left join trn_product pro on cart.trn_shopping_cart_pID = pro.PRODUCT_ID
				where cart.trn_shopping_cart_id = '" .session_id(). "'";

	$sql_temp = "SELECT cart.trn_shopping_cart_Quantity AS QUATITY , pro.PRODUCT_ID AS PRODUCT_ID , IF(pro.SALE > 0, pro.SALE, pro.PRICE) AS PRODUCT_PRICE
				FROM trn_shopping_cart AS cart  left join trn_product AS pro on cart.trn_shopping_cart_pID = pro.PRODUCT_ID
				WHERE trn_shopping_cart_SSID = '" .session_id(). "'";
	$query_temp= mysql_query($sql_temp,$conn);

	while($row = mysql_fetch_array($query_temp)) {

		//$price = ($row['QUATITY'] *  $row['PRICE']);

	//$sql = "INSERT INTO  trn_order (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	//mysql_query($sql, $conn) or die($sql);
	//$retrunID = mysql_insert_id();

		unset($insert_o);
		//$insert_o['ORDER_ID'] = $retrunID;
		$insert_o['QUATITY'] = "'" .$row['QUATITY'] ;
		$insert_o['PRODUCT_ID'] = "'" .$_POST['PRODUCT_ID']. "'";
		$insert_o['SUMPRICE'] = "'" .$price. "'";
		$insert_o['EMS'] = "'" .$price. "'";
		$insert_o['ADDRESS'] = "'" .$retrunAddress. "'";
		$insert_o['CUSTOMER_ID'] = "'" .$_SESSION['UID']. "'";
		$insert_o['USER_CREATE'] = "'". $_SESSION['UID'];
		$insert_o['CREATE_DATE'] = "NOW()";

	$sql_o = "INSERT INTO trn_order (" . implode(",", array_keys($insert_o)) . ") VALUES (" . implode(",", array_values($insert_o)) . ")";
    //mysql_query($sql_o, $conn) or die($sql_o);

    $retrunID = mysql_insert_id();

}
		unset($insert_d);
		$insert_d['ORDER_ID'] = $retrunID;
		$insert_d['QUATITY'] = "'" .$row['QUATITY'] ;
		$insert_d['PRODUCT_ID'] = "'" .$row['QUATITY']. "'";
		$insert_d['PRICE'] = "'" .$row['QUATITY']. "'";
		$insert_d['CAT_ID'] = "'" .$row['QUATITY']. "'";
		$insert_d['CUSTOMER_ID'] = "'" .$_SESSION['UID']. "'";
		$insert_d['USER_CREATE'] = "'". $_SESSION['UID'];
		$insert_d['CREATE_DATE'] = "NOW()";


	$sql_d = "INSERT INTO trn_order_detail (" . implode(",", array_keys($insert_d)) . ") VALUES (" . implode(",", array_values($insert_d)) . ")";
    //mysql_query($sql_d, $conn) or die($sql_d);

	//header('Location: e-shopping-cart.php');
*/


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