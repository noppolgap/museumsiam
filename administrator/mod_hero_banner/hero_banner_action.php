<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");



$returnPage = 'hero_banner_view.php';

 

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_hero_banner/'" . $returnPage . ";</script>";
 
 
if (isset($_GET['edit'])) {

	  

	if (count($_POST['hero_banner_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_ID) AS MAX_ORDER FROM trn_hero_banner WHERE  IMG_TYPE = 1";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['hero_banner_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('hero_banner', end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert); 
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_ID'] = $max++;

			$sql = "INSERT INTO trn_hero_banner (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	

	if (count($_POST['order_position']) > 0) {

		foreach ($_POST['order_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_hero_banner SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}
	 

	header('Location: ' . $returnPage);
}

 
