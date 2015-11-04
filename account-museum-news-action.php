<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
require("inc/inc-cat-id-conf.php");
header('Content-type: text/html; charset=utf-8');

$MID = $new_and_event;
$CID = $all_event_cat_id;
$subCatID = $museumDataNetworkNewsSubCat;
$returnPage = "account-museum-news.php";

if (isset($_GET["add"])) {
	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =" . $CID;
	$sql_max .= " AND SUB_CAT_ID =" . $subCatID;

//echo $sql_max;
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);

	$insert['CAT_ID'] = "'" . $CID . "'";
	//$_POST['cmbCategory'] . "'";
	$insert['SUB_CAT_ID'] = "'" . $subCatID . "'";

	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['txtDescLoc'] . "'";
	$insert['CONTENT_DESC_ENG'] = "'" . $_POST['txtDescEng'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['txtDetailLoc'] . "'";
	$insert['CONTENT_DETAIL_ENG'] = "'" . $_POST['txtDetailEng'] . "'";
	$insert['CONTENT_STATUS_FLAG'] = "'0'";
	$insert['CONTENT_VIEW_COUNT'] = "0";
	$insert['BRIEF_LOC'] = "'" . $_POST['txtBriefDescLoc'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['txtBriefDescEng'] . "'";
	$insert['MUSUEM_ID'] = "'".$_POST['museumID']."'";
	$insert['APPROVE_FLAG'] = "'N'";
	$insert['USER_CREATE'] = "'" . $_SESSION['user_name']."'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'" . $_SESSION['user_name']."'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	/*$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['txtStartDate']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['txtEndDate']) . "'";
	$insert['PLACE_DESC_LOC'] = "'" . nvl($_POST['txtPlaceLoc'], "") . "'";
	$insert['PLACE_DESC_ENG'] = "'" . nvl($_POST['txtPlaceEng'], "") . "'";
	$insert['LAT'] = "'" . nvl($_POST['txtLat'], "") . "'";
	$insert['LON'] = "'" . nvl($_POST['txtLon'], "") . "'";
	$insert['EVENT_START_TIME'] = "'" . nvl($_POST['cmbHourStart'], '') . ':' . nvl($_POST['cmbMinuteStart'], '') . "'";
	$insert['EVENT_END_TIME'] = "'" . nvl($_POST['cmbHourEnd'], '') . ':' . nvl($_POST['cmbMinuteEnd'], '') . "'";
	 
	 */
	$sql = "INSERT INTO  trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql .' Err : '. mysql_error());
	$retrunID = mysql_insert_id();

	if (count($_POST['photo_file']) > 0) {
		$index = 1;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_museum_' . $CID, end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $CID . "'";
			//$_POST['cmbCategory'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die();
		}
	}
/*
	if (count($_POST['video_video']) > 0) {
		$index = 1;
		foreach ($_POST['video_video'] as $k => $file) {

			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				$IMG_TYPE = 2;
				$file[1] = move_video_file($file[1], 'content_' . $CID);
			} else if ($file[0] == 'embed') {
				$IMG_TYPE = 3;
			} else if ($file[0] == 'link') {
				$IMG_TYPE = 4;
			}

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CID;
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'video'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}

	if (count($_POST['video_other']) > 0) {
		$index = 1;
		foreach ($_POST['video_other'] as $k => $file) {

			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				$IMG_TYPE = 2;
				$file[1] = move_video_file($file[1], 'content_' . $CID);
			} else if ($file[0] == 'embed') {
				$IMG_TYPE = 3;
			} else if ($file[0] == 'link') {
				$IMG_TYPE = 4;
			}

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CID;
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'other'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}

	//noppol.von 18Oct2015 add Audio File
	if (count($_POST['video_voice']) > 0) {
		$index = 1;
		foreach ($_POST['video_voice'] as $k => $file) {

			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				$IMG_TYPE = 2;
				$file[1] = move_video_file($file[1], 'content_' . $CID);
			} else if ($file[0] == 'embed') {
				$IMG_TYPE = 3;
			} else if ($file[0] == 'link') {
				$IMG_TYPE = 4;
			}

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CID;
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'voice'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}
 
 */
	header('Location: ' . $returnPage);
	//echo $scriptReturnPath ;
}
?>