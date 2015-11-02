<?php
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

} else if ($_POST["type"] == "email") {
	$sql = "SELECT * FROM sys_app_user WHERE EMAIL =  '" . $_POST['email'] . "'";
	$query = mysql_query($sql, $conn);
	echo mysql_num_rows($query);
} else {
	//insert

	//Upload
	//var_dump($_FILES['fileToUpload']);

	/*
	 // Check if image file is a actual image or fake image
	 if(isset($_POST["submit"])) {
	 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	 if($check !== false) {
	 echo "File is an image - " . $check["mime"] . ".";
	 $uploadOk = 1;
	 } else {
	 echo "File is not an image.";
	 $uploadOk = 0;
	 }
	 }

	 // Check if file already exists
	 if (file_exists($target_file)) {
	 echo "Sorry, file already exists.";
	 $uploadOk = 0;
	 }
	 // Check file size
	 if ($_FILES["fileToUpload"]["size"] > 500000) {
	 echo "Sorry, your file is too large.";
	 $uploadOk = 0;
	 }

	 // Allow certain file formats
	 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	 && $imageFileType != "gif" ) {
	 echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	 $uploadOk = 0;
	 }
	 // Check if $uploadOk is set to 0 by an error
	 if ($uploadOk == 0) {
	 echo "Sorry, your file was not uploaded.";
	 // if everything is ok, try to upload file
	 } else {*/

	//}

	//End Upload
	unset($insert);

	$insert['MUSEUM_NAME_LOC'] = "'" . $_POST['txtMuseumDescLoc'] . "'";
	$insert['MUSEUM_NAME_ENG'] = "'" . $_POST['txtMuseumDescEng'] . "'";
	$insert['ADDRESS1'] = "'" . $_POST['txtMuseumAddress'] . "'";
	$insert['PROVINCE_ID'] = "'" . $_POST['province'] . "'";
	$insert['DISTRICT_ID'] = "'" . $_POST['district'] . "'";
	$insert['SUB_DISTRICT_ID'] = "'" . $_POST['sub_district'] . "'";
	$insert['POST_CODE'] = "'" . $_POST['postcode'] . "'";
	$insert['TELEPHONE'] = "'" . $_POST['telephone'] . "'";
	$insert['MOBILE_PHONE'] = "'" . $_POST['mobile'] . "'";
	$insert['FAX'] = "'" . $_POST['fax'] . "'";

	$insert['IS_GIS_MUSEUM'] = "'N'";

	$insert['USER_CREATE'] = "'" . $_SESSION['user_name'] . "'";
	$insert['CREATE_DATE'] = "now()";
	$insert['ACTIVE_FLAG'] = "1";
	$insert['APPROVE_FLAG'] = "'N'";

	$sql = "INSERT INTO  trn_museum_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

	mysql_query($sql, $conn) or die($sql);
	$retrunID = mysql_insert_id();

	if (!empty($_POST['date'])) {
		// Loop to store and display values of individual checked checkbox.
		foreach ($_POST['date'] as $selected) {
			//echo $selected . "</br>";
			//echo $_POST['startdate1'];
			//	echo $_POST['enddate1'];
			unset($insert);
			$insert['MUSEUM_ID'] = $retrunID;
			$insert['OPENNING_DAY'] = $selected;
			$keyStart = 'startdate' . $selected;
			$keyEnd = 'enddate' . $selected;
			$insert['OPENNING_START_HOUR'] = "'" . $_POST[$keyStart] . "'";
			$insert['OPENNING_END_HOUR'] = "'" . $_POST[$keyEnd] . "'";

			$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	} else {
		if (!empty($_POST['auto_open'])) {
			// Loop to store and display values of individual checked checkbox.
			foreach ($_POST['auto_open'] as $selected) {
				//echo $selected . "</br>";
				unset($insert);
				$insert['MUSEUM_ID'] = $retrunID;
				$insert['OPENNING_DAY'] = $selected;
				$insert['OPENNING_START_HOUR'] = "'" . $_POST['startdate'] . "'";
				$insert['OPENNING_END_HOUR'] = "'" . $_POST['enddate'] . "'";

				$sql = "INSERT INTO trn_museum_openning (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
				mysql_query($sql, $conn) or die($sql);

			}

		}
	}
	//echo $target_file .'<br>';
	//echo $target_save_file.'<br>';
	//echo $_FILES["fileToUpload"]["tmp_name"].'<br>';
	//insert Attachment

	$target_dir = "upload/ATTACH_FILE/";
	$target_dir_museum = $target_dir . '/' . 'MUSEUM_ID_' . $retrunID . '/';

	$target_file = $target_dir_museum . basename($_FILES["fileToUpload"]["name"]);

	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$target_save_file = $target_dir_museum . date("YmdGis") . '.' . $imageFileType;

	if (!is_dir($target_dir)) { mkdir($target_dir, 0777);
	} else { chmod($target_dir, 0777);
	}

	if (!is_dir($target_dir_museum)) { mkdir($target_dir_museum, 0777);
	} else { chmod($target_dir_museum, 0777);
	}

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_save_file)) {
		// echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		unset($insert);

		$insert['MUSEUM_ID'] = $retrunID;
		$insert['IMG_PATH'] = "'" . $target_save_file . "'";

		$sql = "INSERT INTO  trn_museum_attach_file (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
		mysql_query($sql, $conn) or die($sql);
		//echo "Move Complete";
	} else {
		//echo "Sorry, there was an error uploading your file.";
	}

	header('Location: ' . 'complete-regis.php');

}

CloseDB();
?>