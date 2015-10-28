<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
	if($_POST['REGIS'])
	{
		unset($insert);

	$insert['EMAIL'] = "'" . $_POST['REGIS'] . "'";	 
	$insert['CREATE_DATE'] = "now()";
	
	$sql = "INSERT INTO  trn_muse_mag_request (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();
	echo '' ; //"complete : " .$retrunID;
	}
?>