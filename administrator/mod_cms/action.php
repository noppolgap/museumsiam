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
	if (count($_POST['image1_file360']) > 0) {
		$index = 1;
		foreach ($_POST['image1_file360'] as $k => $file) {
			$filename = admin_move_image360_upload_dir('preview360', end(explode('/', $file)));

			unset($insert);
			$insert['CONTENT_ID'] = 111; /*retrunID*/
			$insert['IMG_TYPE'] = 5;
			$insert['IMG_PATH'] = "'" . $filename . "'";
			$insert['CAT_ID'] = 57; /* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'".$_POST['box_image360_image1']."'"; //ตั้งตาม name
			$insert['DIV_NAME'] = "'image1'";

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);
		}
	}

}else if($_POST['action'] == 'edit'){
	echo 2;
	//video action edit
	if (count($_POST['video_gallery']) > 0) {
		$CONTENT_ID = intval(111);
		$CAT_ID		= intval(57);
		$DIV_NAME	= 'gallery';

		$sql = "SELECT ORDER_ID FROM trn_content_picture WHERE CONTENT_ID = ".$CONTENT_ID." AND CAT_ID = ".$CAT_ID." AND DIV_NAME =  '".$DIV_NAME."' ORDER BY ORDER_ID DESC LIMIT 0 , 1";
		$query = mysql_query($sql, $conn) or die($sql);
		$row = mysql_fetch_array($query);
		$index = $row['ORDER_ID'];
		$index++;

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
			$insert['CONTENT_ID'] = $CONTENT_ID; /*retrunID*/
			$insert['IMG_TYPE'] = $IMG_TYPE;
			$insert['IMG_PATH'] = "'" . $file[1] . "'";
			$insert['CAT_ID'] = $CAT_ID; /* cat ID*/
			$insert['ORDER_ID'] = "'" . $index++ . "'";
			$insert['IMG_NAME'] = "'" . $file[2] . "'";
			$insert['DIV_NAME'] = "'".$DIV_NAME."'"; //ตั้งตาม name

			$sql = "INSERT INTO trn_content_picture (" . implode(",", array_keys($insert)) . ") VALUES (" . implode(",", array_values($insert)) . ")";
			mysql_query($sql, $conn) or die($sql);

		}
	}
	//video action delete
	if (count($_POST['video_delete_gallery']) > 0) {
		foreach ($_POST['video_delete_gallery'] as $k => $file) {
			$file = explode('|@|',$file);

			if($file[0] == 'upload'){
				del_video_file($file[2]);
			}

			mysql_query('DELETE FROM trn_content_picture WHERE PIC_ID = '.intval($file[1]), $conn) or die($sql);
		}
	}

	if (count($_POST['order_gallery_position']) > 0) {
		foreach ($_POST['order_gallery_position'] as $k => $val) {
			$update = "";
			$update[] = "ORDER_ID = " . $val;

			$sql = "UPDATE trn_content_picture SET  " . implode(",", $update) . " WHERE PIC_ID =" . $k;
			mysql_query($sql, $conn) or die($sql);
		}
	}

}else if($_POST['action'] == 'del'){
	echo 3;
	//video action delete
	mysql_query('OPTIMIZE TABLE trn_content_picture', $conn) or die($sql);
}
?>