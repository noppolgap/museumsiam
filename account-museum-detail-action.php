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

} 
else if(isset($_GET['edit']))
{
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
	
	
//	$update[] = "MAP_IMG_PATH_LOC = '" . $_POST[''] . "'";
//$update[] = "MAP_IMG_PATH_ENG = '" . $_POST[''] . "'";
	if (isset($_FILES['browseAvarta'])){
	$target_dir = "upload/USER_IMG/";
	$target_dir_museum = $target_dir  . 'USER_ID_' . $_SESSION['UID'] . '/';

	$target_file = $target_dir_museum . basename($_FILES["browseAvarta"]["name"]);
//	echo $target_save_file ; 
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$target_save_file = $target_dir_museum . date("YmdGis") . '.' . $imageFileType;

	if (!is_dir($target_dir)) { mkdir($target_dir, 0777);
	} else { chmod($target_dir, 0777);
	}

	if (!is_dir($target_dir_museum)) { mkdir($target_dir_museum, 0777);
	} else { chmod($target_dir_museum, 0777);
	}

	
	if (move_uploaded_file($_FILES["browseAvarta"]["tmp_name"], $target_save_file)) {
		$update[] = "IMAGE_PATH = '".$target_save_file. "'";
	//echo "Upload Complete";
	}
	}
	$sql = "UPDATE trn_museum_detail SET  " . implode(",", $update) . " WHERE MUSEUM_DETAIL_ID = " . $_POST['museumId'];
	mysql_query($sql, $conn);

	$deleteOpenningSql = "delete from trn_museum_openning where MUSEUM_ID = ". $_POST['museumId'];
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
	
	header('Location: ' . 'account-museum-detail.php');
}




?>