<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

header('Content-type: text/html; charset=utf-8');
if (isset($_GET['edit'])) {
	$update = "";

	$update[] = "NAME = '" . $_POST['name'] . "'";
	$update[] = "LAST_NAME = '" . $_POST['surname'] . "'";
	$update[] = "ADDRESS1 = '" . $_POST['address'] . "'";
	$update[] = "DISTRICT_ID = '" . $_POST['cmbDistrict'] . "'";
	$update[] = "SUB_DISTRICT_ID = '" . $_POST['cmbSubDistrict'] . "'";
	$update[] = "PROVINCE_ID = '" . $_POST['cmbProvince'] . "'";
	$update[] = "POST_CODE = '" . $_POST['postcode'] . "'";

	$update[] = "TELEPHONE = '" . $_POST['tel'] . "'";
	$update[] = "CITIZEN_ID = '" . $_POST['citizen'] . "'";
	$update[] = "MOBILE_PHONE = '" . $_POST['mobile'] . "'";
	$update[] = "FAX = '" . $_POST['fax'] . "'";
	$update[] = "SEX = '" . $_POST['sex'] . "'";
	$update[] = "BIRTHDAY = '" . ConvertDateToDB ($_POST['birthday']) . "'";
	$update[] = "TITLE = '" . $_POST['title-name'] . "'";

	$update[] = "LAST_UPDATE_DATE = NOW()";
	$update[] = "LAST_UPDATE_USER = '" . $_SESSION['user_name'] . "'";
	 
	// echo $_POST['browseAvarta'];
	// var_dump($_POST['browseAvarta']);
	
	//echo $_FILES["browseAvarta"]["tmp_name"] ; 
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
		$update[] = "IMAGE_PATH = '../../".$target_save_file. "'";
	}
	else 
		{
	//		echo "Fail";
		}
	}
	
	$sql = "UPDATE sys_app_user SET  " . implode(",", $update) . " WHERE ID = " . $_SESSION['UID'];
	mysql_query($sql, $conn);

	header('Location: ' . 'account.php');
}
?>
