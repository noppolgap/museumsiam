<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");

$sql = "SELECT trn_shopping_cart_id FROM trn_shopping_cart WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_pID = ".intval($_POST['id']);
$query = mysql_query($sql, $conn) or die($sql);
if(mysql_num_rows($query) == 0){

	$insert['trn_shopping_cart_SSID'] 		= "'" . session_id() . "'";
	$insert['trn_shopping_cart_pID'] 		= "'" . $_POST['id'] . "'";
	$insert['trn_shopping_cart_Quantity'] 	= "trn_shopping_cart_Quantity + 1";
	$insert['trn_shopping_cart_CreateDate'] = "NOW()";

	$sql = "INSERT INTO trn_shopping_cart (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
}else{
	$update = "";
	$update[] = "trn_shopping_cart_Quantity = trn_shopping_cart_Quantity + 1";
	$update[] = "trn_shopping_cart_CreateDate = NOW()";

	$sql = "UPDATE trn_shopping_cart SET  " . implode(",", $update) . " WHERE trn_shopping_cart_SSID = '".session_id()."' AND trn_shopping_cart_pID = ".intval($_POST['id']);

}
	mysql_query($sql, $conn) or die($sql);

//sum
	$sql = "SELECT SUM(trn_shopping_cart_Quantity)  FROM `trn_shopping_cart` WHERE `trn_shopping_cart_SSID` = '".session_id()."'";
	$query = mysql_query($sql, $conn) or die($sql);
	$row = mysql_fetch_row($query);
	echo $row[0];

CloseDB();
?>