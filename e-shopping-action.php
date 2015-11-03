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

		$retrunAddress = mysql_insert_id();
}

	unset($insert);


	$insert_d['PRODUCT_ID'] = "'" .$_POST['proid']. "'";

	$sql_temp = "select cart.QUATITY, pro.PRICE , pro.CAT_ID, pro.PRICE, pro.PRODUCT_ID
				from trn_shopping_cart cart 
				left join trn_product pro on cart.trn_shopping_cart_pID = pro.PRODUCT_ID
				where cart.trn_shopping_cart_id = '" .session_id(). "'";
	$query_temp= mysql_query($sql_temp,$conn);

	while($row = mysql_fetch_array($query_temp)) { 

		$price = ($row['QUATITY'] *  $row['PRICE']);

	//$sql = "INSERT INTO  trn_order (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	//mysql_query($sql, $conn) or die($sql);
	//$retrunID = mysql_insert_id();

	unset($insert_o);
		//$insert_o['ORDER_ID'] = $retrunID;
		$insert_o['QUATITY'] = "'" .$row['QUATITY'] ;
		$insert_o['PRODUCT_ID'] = "'" .$_POST['proid']. "'";
		$insert_o['SUMPRICE'] = "'" .$price. "'";
		$insert_o['EMS'] = "'" .$price. "'";
		$insert_o['ADDRESS'] = "'" .$retrunAddress. "'";
		$insert_o['CUSTOMER_ID'] = "'" .$_SESSION['UID']. "'";
		$insert_o['USER_CREATE'] = "'". $_SESSION['UID'];
		$insert_o['CREATE_DATE'] = "NOW()";

	$sql_o = "INSERT INTO trn_order (" . implode(",", array_keys($insert_o)) . ") VALUES (" . implode(",", array_values($insert_o)) . ")";
    mysql_query($sql_o, $conn) or die($sql_o);

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
    mysql_query($sql_d, $conn) or die($sql_d);

	








	//header('Location: e-shopping-cart.php');



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