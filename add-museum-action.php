<?
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');

if ($_GET["type"] == "province") {
	$id = intval($_GET["id"]);
	if ($id == 0) {
		$id = 102;
	}

	$arr = array();
	$sql = "SELECT DISTRICT_ID , DISTRICT_DESC_LOC FROM mas_district WHERE PROVINCE_ID = " . $id . " ORDER BY DISTRICT_ID ASC ";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$arr[$row['DISTRICT_ID']] = $row['DISTRICT_DESC_LOC'];
	}
	echo json_encode($arr);
} else if ($_GET["type"] == "district") {
	$id = intval($_GET["id"]);
	if ($id == 0) {
		$id = 10220;
	}

	$arr = array();
	$sql = "SELECT SUB_DISTRICT_ID , SUB_DISTRICT_DESC_LOC FROM mas_sub_district WHERE DISTRICT_ID = " . $id . " ORDER BY SUB_DISTRICT_ID ASC ";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$arr[$row['SUB_DISTRICT_ID']] = $row['SUB_DISTRICT_DESC_LOC'];
	}
	echo json_encode($arr);

} else if (isset($_GET['edit'])) {
	//museumId
	$update = "";

	$update[] = "MUSEUM_NAME_LOC = '" . $_POST['txtNameLoc'] . "'";
	$update[] = "MUSEUM_NAME_ENG = '" . $_POST['txtNameEng'] . "'";
	$update[] = "ADDRESS1 = '" . $_POST['addressLoc'] . "'";
	$update[] = "ADDRESS2 = '" . $_POST['addressEng'] . "'";
	$update[] = "DISTRICT_ID = '" . $_POST['district'] . "'";
	$update[] = "SUB_DISTRICT_ID = '" . $_POST['subDistrict'] . "'";
	$update[] = "PROVINCE_ID = '" . $_POST['province'] . "'";
	$update[] = "POST_CODE = '" . $_POST['txtPostCode'] . "'";
	$update[] = "TELEPHONE = '" . $_POST['txtPhone'] . "'";
	$update[] = "EMAIL = '" . $_POST['txtEmail'] . "'";
	$update[] = "LAT = '" . $_POST['txtLat'] . "'";
	$update[] = "LON = '" . $_POST['txtLon'] . "'";
	//$update[] = "DESCRIPT_LOC = '" . $_POST[''] . "'";
	//$update[] = "DESCRIPT_ENG = '" . $_POST[''] . "'";

	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	$update[] = "LAST_UPDATE_DATE = now()";

	$update[] = "MOBILE_PHONE = '" . $_POST['txtMobile'] . "'";
	$update[] = "FAX = '" . $_POST['txtFax'] . "'";
	//$update[] = "PLACE_DESC_LOC = '" . $_POST[''] . "'";
	//$update[] = "PLACE_DESC_ENG = '" . $_POST[''] . "'";
	$update[] = "WEBSITE_URL = '" . $_POST['txtWebSite'] . "'";

	$update[] = "PRICE_RATE_LOC = '" . $_POST['txtRateLoc'] . "'";
	$update[] = "PRICE_RATE_ENG = '" . $_POST['txtRateEng'] . "'";
	$update[] = "TRANSPORTATION_LOC = '" . $_POST['txtTransportLoc'] . "'";
	$update[] = "TRANSPORTATION_ENG = '" . $_POST['txtTransportEng'] . "'";
	$update[] = "STORY_LOC = '" . $_POST['txtStoryLoc'] . "'";
	$update[] = "STORY_ENG = '" . $_POST['txtStoryEng'] . "'";
	$update[] = "PHYSICAL_LOC = '" . $_POST['txtPhysicalLoc'] . "'";
	$update[] = "PHYSICAL_ENG = '" . $_POST['txtPhysicalEng'] . "'";
	$update[] = "LANDSCAPE_LOC = '" . $_POST['txtLandscapeLoc'] . "'";
	$update[] = "LANDSCAPE_ENG = '" . $_POST['txtLandscapeEng'] . "'";
	$update[] = "EXHIBITION_LOC = '" . $_POST['txtExhibitionLoc'] . "'";
	$update[] = "EXHIBITION_ENG = '" . $_POST['txtExhibitionEng'] . "'";
	$update[] = "ARCHIVE_LOC = '" . $_POST['txtArchiveLoc'] . "'";
	$update[] = "ARCHIVE_ENG = '" . $_POST['txtArchiveEng'] . "'";
	$update[] = "TOP_ARCHIVE_LOC = '" . $_POST['txtTopArchiveLoc'] . "'";
	$update[] = "TOP_ARCHIVE_ENG = '" . $_POST['txtTopArchiveEng'] . "'";
	$update[] = "STORAGE_LOC = '" . $_POST['txtStorageLoc'] . "'";
	$update[] = "STORAGE_ENG = '" . $_POST['txtStorageEng'] . "'";
	$update[] = "TARGET_LOC = '" . $_POST['txtTargetLoc'] . "'";
	$update[] = "TARGET_ENG = '" . $_POST['txtTargetEng'] . "'";
	$update[] = "PUBLIC_INFOR_LOC = '" . $_POST['txtPublicInforLoc'] . "'";
	$update[] = "PUBLIC_INFOR_ENG = '" . $_POST['txtPublicInforEng'] . "'";
	$update[] = "RESPONSIBLE_LOC = '" . $_POST['txtResponsibleLoc'] . "'";
	$update[] = "RESPONSIBLE_ENG = '" . $_POST['txtResponsibleEng'] . "'";
	$update[] = "NEARBY_LOC = '" . $_POST['txtNearbyLoc'] . "'";
	$update[] = "NEARBY_ENG = '" . $_POST['txtNearbyEng'] . "'";
	$update[] = "FACEBOX_URL = '" . $_POST['txtFacebookURL'] . "'";
	$update[] = "TWITTER_URL = '" . $_POST['txtTwitterURL'] . "'";
	$update[] = "YOUTUBE_URL = '" . $_POST['txtYoutubeURL'] . "'";

	if (isset($_POST['hidMapEng'])) {
		if ($_POST['hidMapEng'] == 'DEL')
			$update[] = "MAP_IMG_PATH_ENG = ''";
	}
	if (isset($_POST['hidMapLoc'])) {
		if ($_POST['hidMapLoc'] == 'DEL')
			$update[] = "MAP_IMG_PATH_LOC = ''";
	}

	//echo 'count : ' . count($_FILES['browseMapLoc']) . ' ' . count($_FILES['browseMapEng']);
	if (isset($_FILES['browseMapLoc'])) {
		if ($_FILES['browseMapLoc']["name"] != '') {
			$filename = frontend_move_single_image_upload_dir('MUSEUM_' . $_POST['museumId'], $_FILES['browseMapLoc']);
			$update[] = "MAP_IMG_PATH_LOC = '" . $filename . "'";
		}
	}

	if (isset($_FILES['browseMapEng'])) {
		if ($_FILES['browseMapEng']["name"] != '') {
			$filename = frontend_move_single_image_upload_dir('MUSEUM_' . $_POST['museumId'], $_FILES['browseMapEng']);
			$update[] = "MAP_IMG_PATH_ENG = '" . $filename . "'";
		}
	}

	$sql = "UPDATE trn_museum_detail SET  " . implode(",", $update) . " WHERE MUSEUM_DETAIL_ID = " . $_POST['museumId'];
	//echo $sql;
	mysql_query($sql, $conn);

	$deleteOpenningSql = "delete from trn_museum_openning where MUSEUM_ID = " . $_POST['museumId'];
	mysql_query($deleteOpenningSql, $conn) or die($deleteOpenningSql);

	if (!empty($_POST['date'])) {
		// Loop to store and display values of individual checked checkbox.
		foreach ($_POST['date'] as $selected) {
			//echo $selected . "</br>";
			//echo $_POST['startdate1'];
			//	echo $_POST['enddate1'];
			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['OPENNING_DAY'] = $selected;
			$keyStart = 'startdate' . $selected;
			$keyEnd = 'enddate' . $selected;
			$insert['OPENNING_START_HOUR'] = "'" . $_POST[$keyStart] . "'";
			$insert['OPENNING_END_HOUR'] = "'" . $_POST[$keyEnd] . "'";
			$insert['IS_CUSTOM_OPENNING'] = "'Y'";
			$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	} else {
		if (!empty($_POST['auto_open'])) {
			// Loop to store and display values of individual checked checkbox.
			foreach ($_POST['auto_open'] as $selected) {
				//echo $selected . "</br>";
				unset($insert);
				$insert['MUSEUM_ID'] = $_POST['museumId'];
				$insert['OPENNING_DAY'] = $selected;
				$insert['OPENNING_START_HOUR'] = "'" . $_POST['startdate'] . "'";
				$insert['OPENNING_END_HOUR'] = "'" . $_POST['enddate'] . "'";
				$insert['IS_CUSTOM_OPENNING'] = "'N'";
				$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
				mysql_query($sql, $conn) or die($sql);
			}
		}
	}
	/*
	 ความเป็นมา Type = 1 HIS
	 กายภาพ  =2 PHY
	 ภูมิทัศน์โดยรอบ = 3 LAND
	 ห้องจัดแสดง =4 EXH
	 วัตถุจัดแสดง =5 ARC
	 วัตถุสำคัญ =6 TOP_ARC
	 การจัดเก็บ = 7 STORAGE
	 การเผยแพร่ ประชาสัมพันธ์ = 8 PUBLIC_INFO
	 แหล่งเรียนรู้ใกล้เคียง = 9 NEARBY
	 */
	//ความเป็นมา Type = 1 HIS
	if (count($_POST['HIS_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 1";
		//$_POST['cmbCategory'];
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['HIS_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['HISorder_position']) > 0) {

		foreach ($_POST['HISorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	//กายภาพ  =2 PHY
	if (count($_POST['PHY_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 2";
		//$_POST['cmbCategory'];
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['PHY_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 2;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['PHYorder_position']) > 0) {

		foreach ($_POST['PHYorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	// ภูมิทัศน์โดยรอบ = 3 LAND
	if (count($_POST['LAND_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 3";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['LAND_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 3;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['LANDorder_position']) > 0) {

		foreach ($_POST['LANDorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	//ห้องจัดแสดง =4 EXH
	if (count($_POST['EXH_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 4";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['EXH_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 4;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['EXHorder_position']) > 0) {

		foreach ($_POST['EXHorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	//วัตถุจัดแสดง =5 ARC
	if (count($_POST['ARC_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 5";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['ARC_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 5;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['ARCorder_position']) > 0) {

		foreach ($_POST['ARCorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	// วัตถุสำคัญ =6 TOP_ARC
	if (count($_POST['TOP_ARC_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 6";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['TOP_ARC_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 6;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['TOP_ARCorder_position']) > 0) {

		foreach ($_POST['TOP_ARCorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	// การจัดเก็บ = 7 STORAGE
	if (count($_POST['STORAGE_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 7";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['STORAGE_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 7;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['STORAGEorder_position']) > 0) {

		foreach ($_POST['STORAGEorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	// การเผยแพร่ ประชาสัมพันธ์ = 8 PUBLIC_INFO
	if (count($_POST['PUBLIC_INFO_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 8";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['PUBLIC_INFO_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 8;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['PUBLIC_INFOorder_position']) > 0) {

		foreach ($_POST['PUBLIC_INFOorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	// แหล่งเรียนรู้ใกล้เคียง = 9 NEARBY
	if (count($_POST['NEARBY_file']) > 0) {
		$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 9";
		$query_max = mysql_query($sql_max, $conn) or die($sql_max);
		$row_max = mysql_fetch_array($query_max);
		$max = $row_max['MAX_ORDER'];
		$max++;

		foreach ($_POST['NEARBY_file'] as $k => $file) {
			$filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);

			unset($insert);
			$insert['MUSEUM_ID'] = $_POST['museumId'];
			$insert['IMG_TYPE'] = 9;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['ORDER_DATA'] = $max++;

			$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (count($_POST['NEARBYorder_position']) > 0) {

		foreach ($_POST['NEARBYorder_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_DATA = " . $val;

			$sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

	if (isset($_POST['catMuseum'])) {
		$sql = "delete from trn_mapping_museum_category where MUSEUM_DETAIL_ID = " . $_POST['museumId'];

		mysql_query($sql, $conn) or die($sql);

		foreach ($_POST['catMuseum'] as $k => $val) {
			unset($insert);

			$arrVal = explode("|", $val);
			//echo 'val : ' . $val;
			//echo 'Arr : ' . $arrVal ;
			$insert['MUSEUM_DETAIL_ID'] = $_POST['museumId'];
			$insert['CONTENT_CAT_ID'] = nvl($arrVal[0], 0);
			$insert['CONTENT_SUB_CAT_ID'] = nvl($arrVal[1], 0);

			$sql = "INSERT INTO trn_mapping_museum_category (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

	header('Location: ' . 'account-museum-detail.php');
} else if (isset($_GET['add'])) {

	//museumId
	unset($insert);

	$insert['MUSEUM_NAME_LOC'] = "'" . $_POST['txtNameLoc'] . "'";
	$insert['MUSEUM_NAME_ENG'] = "'" . $_POST['txtNameEng'] . "'";
	$insert['ADDRESS1'] = "'" . $_POST['addressLoc'] . "'";
	$insert['ADDRESS2'] = "'" . $_POST['addressEng'] . "'";
	$insert['DISTRICT_ID'] = "'" . $_POST['district'] . "'";
	$insert['SUB_DISTRICT_ID'] = "'" . $_POST['subDistrict'] . "'";
	$insert['PROVINCE_ID'] = "'" . $_POST['province'] . "'";
	$insert['POST_CODE'] = "'" . $_POST['txtPostCode'] . "'";
	$insert['TELEPHONE'] = "'" . $_POST['txtPhone'] . "'";
	$insert['EMAIL'] = "'" . $_POST['txtEmail'] . "'";
	$insert['LAT'] = "'" . $_POST['txtLat'] . "'";
	$insert['LON'] = "'" . $_POST['txtLon'] . "'";

	$insert['IS_GIS_MUSEUM'] = "'N'";
	$insert['ACTIVE_FLAG'] = "'1'";
	$insert['APPROVE_FLAG'] = "'Y'";
	$insert['USER_CREATE'] = "'" . $_SESSION['user_name'] . "'";
	$insert['CREATE_DATE'] = "now()";
	$insert['LAST_UPDATE_USER'] = "'" . $_SESSION['user_name'] . "'";
	$insert['LAST_UPDATE_DATE'] = "now()";

	$insert['MOBILE_PHONE'] = "'" . $_POST['txtMobile'] . "'";
	$insert['FAX'] = "'" . $_POST['txtFax'] . "'";

	$insert['WEBSITE_URL'] = "'" . $_POST['txtWebSite'] . "'";

	$insert['PRICE_RATE_LOC'] = "'" . $_POST['txtRateLoc'] . "'";
	$insert['PRICE_RATE_ENG'] = "'" . $_POST['txtRateEng'] . "'";
	$insert['TRANSPORTATION_LOC'] = "'" . $_POST['txtTransportLoc'] . "'";
	$insert['TRANSPORTATION_ENG'] = "'" . $_POST['txtTransportEng'] . "'";
	$insert['STORY_LOC'] = "'" . $_POST['txtStoryLoc'] . "'";
	$insert['STORY_ENG'] = "'" . $_POST['txtStoryEng'] . "'";
	$insert['PHYSICAL_LOC'] = "'" . $_POST['txtPhysicalLoc'] . "'";
	$insert['PHYSICAL_ENG'] = "'" . $_POST['txtPhysicalEng'] . "'";
	$insert['LANDSCAPE_LOC'] = "'" . $_POST['txtLandscapeLoc'] . "'";
	$insert['LANDSCAPE_ENG'] = "'" . $_POST['txtLandscapeEng'] . "'";
	$insert['EXHIBITION_LOC'] = "'" . $_POST['txtExhibitionLoc'] . "'";
	$insert['EXHIBITION_ENG'] = "'" . $_POST['txtExhibitionEng'] . "'";
	$insert['ARCHIVE_LOC'] = "'" . $_POST['txtArchiveLoc'] . "'";
	$insert['ARCHIVE_ENG'] = "'" . $_POST['txtArchiveEng'] . "'";
	$insert['TOP_ARCHIVE_LOC'] = "'" . $_POST['txtTopArchiveLoc'] . "'";
	$insert['TOP_ARCHIVE_ENG'] = "'" . $_POST['txtTopArchiveEng'] . "'";
	$insert['STORAGE_LOC'] = "'" . $_POST['txtStorageLoc'] . "'";
	$insert['STORAGE_ENG'] = "'" . $_POST['txtStorageEng'] . "'";
	$insert['TARGET_LOC'] = "'" . $_POST['txtTargetLoc'] . "'";
	$insert['TARGET_ENG'] = "'" . $_POST['txtTargetEng'] . "'";
	$insert['PUBLIC_INFOR_LOC'] = "'" . $_POST['txtPublicInforLoc'] . "'";
	$insert['PUBLIC_INFOR_ENG'] = "'" . $_POST['txtPublicInforEng'] . "'";
	$insert['RESPONSIBLE_LOC'] = "'" . $_POST['txtResponsibleLoc'] . "'";
	$insert['RESPONSIBLE_ENG'] = "'" . $_POST['txtResponsibleEng'] . "'";
	$insert['NEARBY_LOC'] = "'" . $_POST['txtNearbyLoc'] . "'";
	$insert['NEARBY_ENG'] = "'" . $_POST['txtNearbyEng'] . "'";
	$insert['FACEBOX_URL'] = "'" . $_POST['txtFacebookURL'] . "'";
	$insert['TWITTER_URL'] = "'" . $_POST['txtTwitterURL'] . "'";
	$insert['YOUTUBE_URL'] = "'" . $_POST['txtYoutubeURL'] . "'";

	if (isset($_POST['hidMapEng'])) {
		if ($_POST['hidMapEng'] == 'DEL')
			$insert['MAP_IMG_PATH_ENG'] = "''";
	}
	if (isset($_POST['hidMapLoc'])) {
		if ($_POST['hidMapLoc'] == 'DEL')
			$insert['MAP_IMG_PATH_LOC'] = "''";
	}

	if (isset($_FILES['browseMapLoc'])) {
		if ($_FILES['browseMapLoc']["name"] != '') {
			$filename = frontend_move_single_image_upload_dir('MUSEUM_' . $_POST['museumId'], $_FILES['browseMapLoc']);
			$insert['MAP_IMG_PATH_LOC'] = "'" . $filename . "'";
		}
	}

	if (isset($_FILES['browseMapEng'])) {
		if ($_FILES['browseMapEng']["name"] != '') {
			$filename = frontend_move_single_image_upload_dir('MUSEUM_' . $_POST['museumId'], $_FILES['browseMapEng']);
			$insert['MAP_IMG_PATH_ENG'] = "'" . $filename . "'";
		}
	}

	$sql = "INSERT INTO trn_museum_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn);
	$returnID = mysql_insert_id();
	$deleteOpenningSql = "delete from trn_museum_openning where MUSEUM_ID = " . $returnID;
	mysql_query($deleteOpenningSql, $conn) or die($deleteOpenningSql);

	if (!empty($_POST['date'])) {
		// Loop to store and display values of individual checked checkbox.
		foreach ($_POST['date'] as $selected) {

			unset($insert);
			$insert['MUSEUM_ID'] = $returnID;
			$insert['OPENNING_DAY'] = $selected;
			$keyStart = 'startdate' . $selected;
			$keyEnd = 'enddate' . $selected;
			$insert['OPENNING_START_HOUR'] = "'" . $_POST[$keyStart] . "'";
			$insert['OPENNING_END_HOUR'] = "'" . $_POST[$keyEnd] . "'";
			$insert['IS_CUSTOM_OPENNING'] = "'Y'";
			$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	} else {
		if (!empty($_POST['auto_open'])) {
			// Loop to store and display values of individual checked checkbox.
			foreach ($_POST['auto_open'] as $selected) {
				//echo $selected . "</br>";
				unset($insert);
				$insert['MUSEUM_ID'] = $returnID;
				$insert['OPENNING_DAY'] = $selected;
				$insert['OPENNING_START_HOUR'] = "'" . $_POST['startdate'] . "'";
				$insert['OPENNING_END_HOUR'] = "'" . $_POST['enddate'] . "'";
				$insert['IS_CUSTOM_OPENNING'] = "'N'";
				$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
				mysql_query($sql, $conn) or die($sql);
			}
		}
	}
	/*
	 ความเป็นมา Type = 1 HIS
	 กายภาพ  =2 PHY
	 ภูมิทัศน์โดยรอบ = 3 LAND
	 ห้องจัดแสดง =4 EXH
	 วัตถุจัดแสดง =5 ARC
	 วัตถุสำคัญ =6 TOP_ARC
	 การจัดเก็บ = 7 STORAGE
	 การเผยแพร่ ประชาสัมพันธ์ = 8 PUBLIC_INFO
	 แหล่งเรียนรู้ใกล้เคียง = 9 NEARBY
	 */
	$arrPic = array("", "HIS", "PHY", "LAND", "EXH", "ARC", "TOP_ARC", "STORAGE", "PUBLIC_INFO", "NEARBY");

	for ($idx = 1; $idx <= 9; $idx++) {
		//ความเป็นมา Type = 1 HIS
		if (count($_POST[$arrPic[$idx] . '_file']) > 0) {
			$sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $returnID . " AND IMG_TYPE = ".$idx;
			//$_POST['cmbCategory'];
			$query_max = mysql_query($sql_max, $conn) or die($sql_max);
			$row_max = mysql_fetch_array($query_max);
			$max = $row_max['MAX_ORDER'];
			$max++;

			foreach ($_POST[$arrPic[$idx] . '_file'] as $k => $file) {
				$filename = frontend_move_image_upload_dir('MUSEUM_' . $returnID, end(explode('/', $file)), 1000, '', false, 150, 150);

				unset($insert);
				$insert['MUSEUM_ID'] = $returnID;
				$insert['IMG_TYPE'] = $idx;
				$insert['IMG_PATH'] = "'" . $filename . "'";
				$insert['ORDER_DATA'] = $max++;

				$sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
				mysql_query($sql, $conn) or die($sql);
			}
		}
	}
	// //ความเป็นมา Type = 1 HIS
	// if (count($_POST['HIS_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $returnID . " AND IMG_TYPE = 1";
		// //$_POST['cmbCategory'];
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['HIS_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 1;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['HISorder_position']) > 0) {
// 
		// foreach ($_POST['HISorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// //กายภาพ  =2 PHY
	// if (count($_POST['PHY_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 2";
		// //$_POST['cmbCategory'];
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['PHY_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 2;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['PHYorder_position']) > 0) {
// 
		// foreach ($_POST['PHYorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// // ภูมิทัศน์โดยรอบ = 3 LAND
	// if (count($_POST['LAND_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 3";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['LAND_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 3;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['LANDorder_position']) > 0) {
// 
		// foreach ($_POST['LANDorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// //ห้องจัดแสดง =4 EXH
	// if (count($_POST['EXH_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 4";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['EXH_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 4;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['EXHorder_position']) > 0) {
// 
		// foreach ($_POST['EXHorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// //วัตถุจัดแสดง =5 ARC
	// if (count($_POST['ARC_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 5";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['ARC_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 5;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['ARCorder_position']) > 0) {
// 
		// foreach ($_POST['ARCorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// // วัตถุสำคัญ =6 TOP_ARC
	// if (count($_POST['TOP_ARC_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 6";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['TOP_ARC_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 6;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['TOP_ARCorder_position']) > 0) {
// 
		// foreach ($_POST['TOP_ARCorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// // การจัดเก็บ = 7 STORAGE
	// if (count($_POST['STORAGE_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 7";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['STORAGE_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 7;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['STORAGEorder_position']) > 0) {
// 
		// foreach ($_POST['STORAGEorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// // การเผยแพร่ ประชาสัมพันธ์ = 8 PUBLIC_INFO
	// if (count($_POST['PUBLIC_INFO_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 8";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['PUBLIC_INFO_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 8;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['PUBLIC_INFOorder_position']) > 0) {
// 
		// foreach ($_POST['PUBLIC_INFOorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// // แหล่งเรียนรู้ใกล้เคียง = 9 NEARBY
	// if (count($_POST['NEARBY_file']) > 0) {
		// $sql_max = "SELECT MAX(ORDER_DATA) AS MAX_ORDER FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $_POST['museumId'] . " AND IMG_TYPE = 9";
		// $query_max = mysql_query($sql_max, $conn) or die($sql_max);
		// $row_max = mysql_fetch_array($query_max);
		// $max = $row_max['MAX_ORDER'];
		// $max++;
// 
		// foreach ($_POST['NEARBY_file'] as $k => $file) {
			// $filename = frontend_move_image_upload_dir('MUSEUM_' . $_POST['museumId'], end(explode('/', $file)), 1000, '', false, 150, 150);
// 
			// unset($insert);
			// $insert['MUSEUM_ID'] = $_POST['museumId'];
			// $insert['IMG_TYPE'] = 9;
			// $insert['IMG_PATH'] = "'" . $filename . "'";
			// $insert['ORDER_DATA'] = $max++;
// 
			// $sql = "INSERT INTO trn_museum_profile_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }
// 
	// if (count($_POST['NEARBYorder_position']) > 0) {
// 
		// foreach ($_POST['NEARBYorder_position'] as $k => $val) {
			// $update = "";
			// $update[] = "ORDER_DATA = " . $val;
// 
			// $sql = "UPDATE trn_museum_profile_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			// mysql_query($sql, $conn) or die($sql);
		// }
	// }

	if (isset($_POST['catMuseum'])) {
		$sql = "delete from trn_mapping_museum_category where MUSEUM_DETAIL_ID = " . $returnID;

		mysql_query($sql, $conn) or die($sql);

		foreach ($_POST['catMuseum'] as $k => $val) {
			unset($insert);

			$arrVal = explode("|", $val);
			//echo 'val : ' . $val;
			//echo 'Arr : ' . $arrVal ;
			$insert['MUSEUM_DETAIL_ID'] = $returnID;
			$insert['CONTENT_CAT_ID'] = nvl($arrVal[0], 0);
			$insert['CONTENT_SUB_CAT_ID'] = nvl($arrVal[1], 0);

			$sql = "INSERT INTO trn_mapping_museum_category (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

}
?>