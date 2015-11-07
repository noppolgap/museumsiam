<?php
	require ("assets/configs/config.inc.php");
	require ("assets/configs/connectdb.inc.php");
	require ("assets/configs/function.inc.php");
	require ("inc/inc-cat-id-conf.php");

	$LV = intval($_GET['LV']);
	$cID = intval($_GET['cid']);
	$MID = intval($_GET['MID']);
	$conid = intval($_GET['conid']);

	$returnPage = 'administrator/mod_category/content_view.php?cid='.$cID.'&MID='.$MID.'&LV='.$LV ;

if (isset($_GET['add'])) {

    $sql_max = "SELECT MAX( ORDER_DATA ) AS MAX_ORDER FROM trn_content_detail WHERE CONTENT_STATUS_FLAG <>2  
	AND cat_id = ".$eapp_sub_cat." ";
	$query_max = mysql_query($sql_max, $conn);
	$row_max = mysql_fetch_array($query_max);
	$max = $row_max['MAX_ORDER'];
	$max++;

	unset($insert);
	
	$insert['CAT_ID'] = "'" .$eapp_sub_cat. "'";
	$insert['LAT'] = "'" . $_POST['jobname'] . "'";
	$insert['CONTENT_DESC_LOC'] = "'" . $_POST['name_th'] . "'";
	$insert['CONTENT_DESC_ENG'] = "'" . $_POST['name_eng'] . "'";
	$insert['EVENT_START_DATE'] = "'" . ConvertDateToDB($_POST['birthdate']) . "'";
	$insert['PLACE_DESC_ENG'] = "'" . $_POST['email'] . "'";
	$insert['PLACE_DESC_LOC'] = "'" . $_POST['address'] . "'";
	$insert['BRIEF_LOC'] = "'" . $_POST['telephone'] . "'";
	$insert['BRIEF_ENG'] = "'" . $_POST['mobile'] . "'";
	$insert['CONTENT_DETAIL_LOC'] = "'" . $_POST['sex'] . "'";
	$insert['CONTENT_DETAIL_ENG'] = "'" . $_POST['nationality'] . "'";
	$insert['LON'] = "'" . $_POST['salary'] . "'";
	$insert['ORDER_DATA'] = "'" . $max . "'";
	$insert['CONTENT_STATUS_FLAG'] = 0;
	$insert['USER_CREATE'] = "'".$_SESSION['user_name'] ."'";
	$insert['CREATE_DATE'] = "NOW()";
	

       $sql = "INSERT INTO trn_content_detail (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";

    	mysql_query($sql, $conn) or die($sql);
    	$retrunID = mysql_insert_id();


	$path1 = 'upload';
	$path2 = $path1 . '/eapplication';
	$path3 = $path2 . '/' . date("Y_m") . '/';

	if (!is_dir($path1)) { mkdir($path1, 0777);
	} else { chmod($path1, 0777);
	}
	if (!is_dir($path2)) { mkdir($path2, 0777);
	} else { chmod($path2, 0777);
	}
	if (!is_dir($path3)) { mkdir($path3, 0777);
	} else { chmod($path3, 0777);
	}

	$output1 = time() . '_' . rand(111, 999) . '.' . getEXT($_FILES["MyPhotograph"]["name"]);
	$output2 = time() . '_' . rand(111, 999) . '.' . getEXT($_FILES["MyResume"]["name"]);
	$output3 = time() . '_' . rand(111, 999) . '.' . getEXT($_FILES["MyApplication"]["name"]);

	
	if (count($_FILES['MyPhotograph']) > 0) {
		if(move_uploaded_file($_FILES["MyPhotograph"]["tmp_name"],$path3 . $output1)){

			unset($insert);
			$insert['CONTENT_ID'] = "'" .$retrunID. "'";
			$insert['IMG_TYPE'] = 1;
			$insert['IMG_PATH'] = "'" .$path3 . $output1 . "'";
			$insert['CAT_ID'] = "'" . $eapp_sub_cat . "'";
			$insert['ORDER_ID'] = "1";
			$insert['IMG_NAME'] = "'MyPhotograph'";

		   $sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
		
	}
	if (count($_FILES['MyResume']) > 0) {
		if(move_uploaded_file($_FILES["MyResume"]["tmp_name"],$path3 . $output2)){

			unset($insert);
			$insert['CONTENT_ID'] = "'" .$retrunID. "'";
			$insert['IMG_TYPE'] = 2;
			$insert['IMG_PATH'] = "'" .$path3 . $output2 . "'";
			$insert['CAT_ID'] = "'" . $eapp_sub_cat . "'";
			$insert['ORDER_ID'] = "1";
			$insert['IMG_NAME'] = "'MyResume'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}
	if (count($_FILES['MyApplication']) > 0) {
		if(move_uploaded_file($_FILES["MyApplication"]["tmp_name"],$path3 . $output3)){

			unset($insert);
			$insert['CONTENT_ID'] = "'" .$retrunID. "'";
			$insert['IMG_TYPE'] = 3;
			$insert['IMG_PATH'] = "'" .$path3 . $output3 . "'";
			$insert['CAT_ID'] = "'" . $eapp_sub_cat . "'";
			$insert['ORDER_ID'] = "1";
			$insert['IMG_NAME'] = "'MyApplication'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}	
	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);


    header('Location: contact-eapp-register.php');

}

if (isset($_GET['edit'])) {

	

	$update = "";

	$update[] = "CAT_ID = '" . $eapp_sub_cat . "'";
	$update[] = "LAT = '" . $_POST['jobname'] . "'";
	$update[] = "CONTENT_DESC_LOC = '" . $_POST['name_th'] . "'";
	$update[] = "CONTENT_DESC_ENG = '" . $_POST['name_eng'] . "'";
	$update[] = "EVENT_START_DATE = '" . ConvertDateToDB($_POST['birthdate']) . "'";
	$update[] = "PLACE_DESC_ENG ='" . $_POST['email'] . "'";
	$update[] = "PLACE_DESC_LOC = '".$_POST['address'] ."'";
	$update[] = "BRIEF_LOC = '".$_POST['telephone'] ."'";
	$update[] = "BRIEF_ENG = '".$_POST['mobile'] ."'";
	$update[] = "CONTENT_DETAIL_LOC = '".$_POST['sex'] ."'";
	$update[] = "CONTENT_DETAIL_ENG = '".$_POST['nationality'] ."'";
	$update[] = "LON = '".$_POST['salary'] ."'";
	$update[] = "LAST_UPDATE_USER = '".$_SESSION['user_name'] ."'";
	$update[] = "LAST_UPDATE_DATE = NOW()";

	
	$sql = "UPDATE trn_content_detail SET  " . implode(",", $update) . " WHERE CONTENT_ID = " .$conid;
	mysql_query($sql, $conn);

	header('Location: '.$returnPage.'');

}
