<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$returnPage = 'hero_banner_view.php';

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_hero_banner/'" . $returnPage . ";</script>";

if (isset($_GET['edit'])) {

	/*
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
	 */
	$PID = $_GET['PID'];
	if (isset($_POST['hidImgEng'])) {
		if ($_POST['hidImgEng'] == 'DEL')
			$update[] = "IMG_PATH_ENG = ''";
	}
	if (isset($_POST['hidImgLoc'])) {
		if ($_POST['hidImgLoc'] == 'DEL')
			$update[] = "IMG_PATH = ''";
	}

	if (isset($_FILES['browseImgLoc'])) {
		if ($_FILES['browseImgLoc']["name"] != '') {
			$filename = backend_move_single_image_upload_dir('hero_banner' . $mid, $_FILES['browseImgLoc']);
			$update[] = "IMG_PATH = '" . $filename . "'";
		}
	}

	if (isset($_FILES['browseImgEng'])) {
		if ($_FILES['browseImgEng']["name"] != '') {
			$filename = backend_move_single_image_upload_dir('hero_banner' . $mid, $_FILES['browseImgEng']);
			$update[] = "IMG_PATH_ENG = '" . $filename . "'";
		}
	}
	$update[] = "URL_LOC = '" . $_POST['txtUrlTh'] . "'";
	$update[] = "URL_ENG = '" . $_POST['txtUrlEn'] . "'";

	$sql = "UPDATE trn_hero_banner SET  " . implode(",", $update) . " WHERE PIC_ID = " . $PID;
	mysql_query($sql, $conn) or die($sql);

	header('Location: ' . $returnPage);
} else if (isset($_GET['add'])) {
	$insert = "";

	$sql_max = "SELECT MAX( ORDER_ID ) AS MAX_ORDER FROM trn_hero_banner ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	if (isset($_POST['hidImgEng'])) {
		if ($_POST['hidImgEng'] == 'DEL')
			$insert['IMG_PATH_ENG'] = "''";
	}
	if (isset($_POST['hidImgLoc'])) {
		if ($_POST['hidImgLoc'] == 'DEL')
			$insert['IMG_PATH'] = "''";
	}

	if (isset($_FILES['browseImgLoc'])) {
		if ($_FILES['browseImgLoc']["name"] != '') {
			$filename = backend_move_single_image_upload_dir('hero_banner' . $mid, $_FILES['browseImgLoc']);
			$insert['IMG_PATH'] = "'" . $filename . "'";
		}
	}

	if (isset($_FILES['browseImgEng'])) {
		if ($_FILES['browseImgEng']["name"] != '') {
			$filename = backend_move_single_image_upload_dir('hero_banner' . $mid, $_FILES['browseImgEng']);
			$insert['IMG_PATH_ENG'] = "'" . $filename . "'";
		}
	}

	$insert['URL_LOC'] = "'" . $_POST['txtUrlTh'] . "'";
	$insert['URL_ENG'] = "'" . $_POST['txtUrlEn'] . "'";
	$insert['IMG_TYPE'] = "'1'";
	$insert['ORDER_ID'] = "'" . $max . "'";
	$sql = "INSERT INTO trn_hero_banner (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
	mysql_query($sql);
	header('Location: ' . $returnPage);
}
else if (isset($_GET['delete']))
{
	$id = $_POST['id'];

	$sql = "delete from trn_hero_banner WHERE PIC_ID =" . $id;

	mysql_query($sql, $conn);
}
