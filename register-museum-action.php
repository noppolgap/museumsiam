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
				$keyStart = 'startdate'.$selected ;
				$keyEnd =  'enddate'.$selected ;
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

	header('Location: ' . 'complete-regis.php');

}

CloseDB();
?>