<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");

if($_POST['action'] == 'add'){
	echo 1;

	//video action add
	if (count($_POST['video_gallery']) > 0) {
		$index = 1;
		foreach ($_POST['video_gallery'] as $k => $file) {

			$file = explode('|@|',$file);

			if($file[0] == 'upload'){
				$IMG_TYPE = 2;
				$file[1] = move_video_file($file[1],'gallery');
			}else if($file[0] == 'embed'){
				$IMG_TYPE = 3;
			}else if($file[0] == 'link'){
				$IMG_TYPE = 4;
			}


			unset($insert);
			$insert['CONTENT_ID'] = 111; /*retrunID*/
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = 57; /* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'gallery'"; //ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}

}else if($_POST['action'] == 'edit'){
	echo 2;
	//video action edit
}else if($_POST['action'] == 'del'){
	echo 3;
	//video action delete
}
?>