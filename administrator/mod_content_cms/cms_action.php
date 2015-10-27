<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

$MID = $_GET['MID'];
$CID = $_GET['cid'];
$LV = $_GET['LV'];
$SCID = $_GET['SCID'];

$returnPage = 'index.php?MID=' . $MID . '&cid=' . $CID . '&LV=' . $LV;

if (isset($SCID) && nvl($SCID, '0') != '0')
	$returnPage .= '&SCID=' . $SCID;

$scriptReturnPath = "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . "/administrator/mod_category/'" . $returnPage . ";</script>";
if (isset($_GET['enable'])) {

	$id = $_GET['conid'];
	$flag = $_GET['vis'];
	$Flag = "";

	if ($flag == 1) {
		$Flag = 0;
	} else {
		$Flag = 1;
	}
	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = $Flag";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	header('Location: ' . $returnPage);

}

if (isset($_GET['delete'])) {

	$id = $_POST['id'];

	$update = "";
	$update[] = "CONTENT_STATUS_FLAG = 2";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID =" . $id;

	mysql_query($sql, $conn);

	if (count($_POST['video_delete_gallery']) > 0) {
		foreach ($_POST['video_delete_gallery'] as $k => $file) {
			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = ' . intval($file[1]), $conn) or die($sql);
		}
		mysql_query('OPTIMIZE TABLE trn_content_picture', $conn) or die("");
	}

}

if (isset($_GET['add'])) {

	$sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2 AND CAT_ID =" . $CID;
	//$_POST['cmbCategory'];
	$subCatID = -1;
	if (isset($SCID) && nvl($SCID, '0') != '0') {//if (isset($_POST['cmbSubCategory'])) {
		$sql_max .= " AND SUB_CAT_ID =" . $SCID;
		//$_POST['cmbSubCategory'];
		$subCatID = $SCID;
		//$_POST['cmbSubCategory'];
	}

	// echo $sql_max ;

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
	$insert['MUSUEM_ID'] = "'-1'";
	$insert['APPROVE_FLAG'] = "'Y'";
	$insert['USER_CREATE'] = "'admin'";
	$insert['CREATE_DATE'] = "NOW()";
	$insert['LAST_UPDATE_USER'] = "'admin'";
	$insert['LAST_UPDATE_DATE'] = "NOW()";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['txtStartDate']) . "'";
	$insert['EVENT_END_DATE'] = "'" . ConvertDateToDB($_POST['txtEndDate']) . "'";

	$insert['PLACE_DESC_LOC'] = "'" . nvl($_POST['txtPlaceLoc'], "") . "'";
	$insert['PLACE_DESC_ENG'] = "'" . nvl($_POST['txtPlaceEng'], "") . "'";
	$insert['LAT'] = "'" . nvl($_POST['txtLat'], "") . "'";
	$insert['LON'] = "'" . nvl($_POST['txtLon'], "") . "'";
	$insert['EVENT_START_TIME'] = "'" . nvl($_POST['cmbHourStart'], '') . ':' . nvl($_POST['cmbMinuteStart'], '') . "'";
	$insert['EVENT_END_TIME'] = "'" . nvl($_POST['cmbHourEnd'], '') . ':' . nvl($_POST['cmbMinuteEnd'], '') . "'";
	$sql = "INSERT INTO  trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	if (count($_POST['photo_file']) > 0) {
		$index = 1;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $CID, end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $retrunID;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $CID . "'";
			//$_POST['cmbCategory'] . "'";
			$insert['ORDER_ID'] = "'" . $index++ . "'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

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
	header('Location: ' . $returnPage);
	//echo $scriptReturnPath ;
}

if (isset($_GET['edit'])) {

	$conid = $_GET['conid'];

	$subCatID = -1;
	//if (isset($_POST['cmbSubCategory'])) {
	if (isset($SCID) && nvl($SCID, '0') != '0') {
		$subCatID = $SCID;
		//$_POST['cmbSubCategory'];
	}

	$update = "";

	$update[] = "CONTENT_DESC_LOC = '" . $_POST['txtDescLoc'] . "'";
	$update[] = "CONTENT_DESC_ENG = '" . $_POST['txtDescEng'] . "'";
	$update[] = "CONTENT_DETAIL_LOC= '" . $_POST['txtDetailLoc'] . "'";
	$update[] = "CONTENT_DETAIL_ENG= '" . $_POST['txtDetailEng'] . "'";
	$update[] = "BRIEF_LOC= '" . $_POST['txtBriefDescLoc'] . "'";
	$update[] = "BRIEF_ENG= '" . $_POST['txtBriefDescEng'] . "'";
	$update[] = "LAST_UPDATE_USER = 'admin'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	$update[] = "CAT_ID = '" . $CID . "'";
	///$_POST['cmbCategory'] . "'";
	$update[] = "SUB_CAT_ID = '" . $subCatID . "'";

	$update[] = "EVENT_START_DATE = '" . ConvertDateToDB($_POST['txtStartDate']) . "'";
	$update[] = "EVENT_END_DATE = '" . ConvertDateToDB($_POST['txtEndDate']) . "'";

	$update[] = "PLACE_DESC_LOC = '" . nvl($_POST['txtPlaceLoc'], "") . "'";
	$update[] = "PLACE_DESC_ENG = '" . nvl($_POST['txtPlaceEng'], "") . "'";
	$update[] = "LAT = '" . nvl($_POST['txtLat'], "") . "'";
	$update[] = "LON  = '" . nvl($_POST['txtLon'], "") . "'";

	$update[] = "EVENT_START_TIME = '" . nvl($_POST['cmbHourStart'], '') . ':' . nvl($_POST['cmbMinuteStart'], '') . "'";
	$update[] = "EVENT_END_TIME = '" . nvl($_POST['cmbHourEnd'], '') . ':' . nvl($_POST['cmbMinuteEnd'], '') . "'";

	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " . $conid;
	mysql_query($sql, $conn);

	if (count($_POST['photo_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_ID) AS MAX_ORDER FROM trn_content_picture WHERE CONTENT_ID = " . $conid . " AND CAT_ID = " . $CID;
		//$_POST['cmbCategory'];
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['photo_file'] as $k => $file) {
			$filename = admin_move_image_upload_dir('content_' . $CID, end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['CONTENT_ID'] = $conid;
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = "'" . $CID . "'";
			//$_POST['cmbCategory'] . "'";
			$insert['ORDER_ID'] = $max++;

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['video_other']) > 0) {
		$CONTENT_ID = intval($conid);
		$CAT_ID = intval($CID);
		$DIV_NAME = 'other';

		$sql = "SELECT ORDER_ID FROM trn_content_picture WHERE CONTENT_ID = " . $CONTENT_ID . " AND CAT_ID = " . $CAT_ID . " AND DIV_NAME =  '" . $DIV_NAME . "' ORDER BY ORDER_ID DESC LIMIT 0 , 1";
		$query = mysql_query($sql, $conn) or die($sql);
		$row = mysql_fetch_array($query);
		$index = $row['ORDER_ID'];
		$index++;

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
			$insert['CONTENT_ID'] = $CONTENT_ID;
			/*retrunID*/
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CAT_ID;
			/* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'" . $DIV_NAME . "'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}

	if (count($_POST['video_voice']) > 0) {
		$CONTENT_ID = intval($conid);
		$CAT_ID = intval($CID);
		$DIV_NAME = 'voice';

		$sql = "SELECT ORDER_ID FROM trn_content_picture WHERE CONTENT_ID = " . $CONTENT_ID . " AND CAT_ID = " . $CAT_ID . " AND DIV_NAME =  '" . $DIV_NAME . "' ORDER BY ORDER_ID DESC LIMIT 0 , 1";
		$query = mysql_query($sql, $conn) or die($sql);
		$row = mysql_fetch_array($query);
		$index = $row['ORDER_ID'];
		$index++;

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
			$insert['CONTENT_ID'] = $CONTENT_ID;
			/*retrunID*/
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CAT_ID;
			/* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'" . $DIV_NAME . "'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}

	if (count($_POST['video_delete_voice']) > 0) {
		foreach ($_POST['video_delete_voice'] as $k => $file) {
			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = ' . intval($file[1]), $conn) or die($sql);
		}
	}

	//video action delete
	if (count($_POST['video_delete_other']) > 0) {
		foreach ($_POST['video_delete_other'] as $k => $file) {
			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = ' . intval($file[1]), $conn) or die($sql);
		}
	}

	if (count($_POST['video_video']) > 0) {
		$CONTENT_ID = intval($conid);
		$CAT_ID = intval($CID);
		$DIV_NAME = 'video';

		$sql = "SELECT ORDER_ID FROM trn_content_picture WHERE CONTENT_ID = " . $CONTENT_ID . " AND CAT_ID = " . $CAT_ID . " AND DIV_NAME =  '" . $DIV_NAME . "' ORDER BY ORDER_ID DESC LIMIT 0 , 1";
		$query = mysql_query($sql, $conn) or die($sql);
		$row = mysql_fetch_array($query);
		$index = $row['ORDER_ID'];
		$index++;

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
			$insert['CONTENT_ID'] = $CONTENT_ID;
			/*retrunID*/
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CAT_ID;
			/* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'" . $DIV_NAME . "'";
			//ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}
	//video action delete
	if (count($_POST['video_delete_video']) > 0) {
		foreach ($_POST['video_delete_video'] as $k => $file) {
			$file = explode('|@|', $file);

			if ($file[0] == 'upload') {
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = ' . intval($file[1]), $conn) or die($sql);
		}
	}

	if (count($_POST['order_position']) > 0) {

		foreach ($_POST['order_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}
	/*change position*/
	if (count($_POST['order_video_position']) > 0) {
		foreach ($_POST['order_video_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}
	if (count($_POST['order_voice_position']) > 0) {
		foreach ($_POST['order_voice_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}
	if (count($_POST['order_other_position']) > 0) {
		foreach ($_POST['order_other_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: ' . $returnPage);
}

if (isset($_POST['catID'])) {
	$subCatSql = "select sc.SUB_CONTENT_CAT_ID , sc.SUB_CONTENT_CAT_DESC_LOC , sc.SUB_CONTENT_CAT_DESC_ENG
											   from trn_content_sub_category sc
											where sc.CONTENT_CAT_ID = '$catID' and sc.flag <> 2
											ORDER BY sc.ORDER_DATA  desc  ";

	//	echo $subCatSql;
	$subCatQuery = mysql_query($subCatSql, $conn);

	$retStr = "<select id='cmbSubCategory' name = 'cmbSubCategory'>";
	$retStr .= "<option value='-1'>กรุณาเลือกหมวดหมู่ย่อย</option>";
	while ($rowSubCat = mysql_fetch_array($subCatQuery)) {
		$retStr .= "<option value='" . $rowSubCat["SUB_CONTENT_CAT_ID"] . "'  >" . $rowSubCat["SUB_CONTENT_CAT_DESC_LOC"] . "</option>";
	}mysql_free_result($subCatQuery);
	$retStr .= "</select>";

	echo $retStr;
	//echo "Come In".$catID  ;
	//return "Hello" ;
}
