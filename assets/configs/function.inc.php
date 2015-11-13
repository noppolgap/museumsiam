<?php
function find_ip() {
	//ตรวจสอบ IP
	if ($_SERVER['REMOTE_ADDR']) {
		return $_SERVER['REMOTE_ADDR'];
	} elseif (ereg("[0-9]", $_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

function checkDir($dir) {
	if (!is_dir($dir)) {
		mkdir($dir, 0777);
	} else {
		chmod($dir, 0777);
	}
}

function changedateformatlong($source) {
	$date = new DateTime($source);
	return $date -> format('j F Y H:i');
	// 1 December 2012 13:30
}

function changedateformatshort($source) {
	$date = new DateTime($source);
	return $date -> format('j M Y H:i');
	// 1 Dec 2012 13:30
}

function changedateformatdb($source) {
	$date = new DateTime($source);
	return $date -> format('Y-m-d H:i:s');
	// 2013-02-20 13:30:59
}

function changedateformattimepicker($source) {
	$date = new DateTime($source);
	return $date -> format('d m Y H:i');
	// 31 02 2012 13:30
}

function getEXT($file) {
	//return strtolower(end(explode('.', $file)));
	return pathinfo($file, PATHINFO_EXTENSION);
}

function formatSizeUnits($bytes) {
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} else if ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} else if ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} else if ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} else if ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}

	return $bytes;
}

function ShowDateEn($myDate) {
	$myDateArray = explode("-", $myDate);
	$myDay = sprintf("%d", $myDateArray[2]);
	switch($myDateArray[1]) {
		case "01" :
			$myMonth = "Jan";
			break;
		case "02" :
			$myMonth = "Feb";
			break;
		case "03" :
			$myMonth = "Mar";
			break;
		case "04" :
			$myMonth = "Apr";
			break;
		case "05" :
			$myMonth = "May";
			break;
		case "06" :
			$myMonth = "Jun";
			break;
		case "07" :
			$myMonth = "Jul";
			break;
		case "08" :
			$myMonth = "Aug";
			break;
		case "09" :
			$myMonth = "Sep";
			break;
		case "10" :
			$myMonth = "Oct";
			break;
		case "11" :
			$myMonth = "Nov";
			break;
		case "12" :
			$myMonth = "Dec";
			break;
	}
	$myYear = sprintf("%d", $myDateArray[0]);
	return ($myDay . " " . $myMonth . " " . substr($myYear, 2, 2));
}

function ShowDateShort($myDate) {
	$myDateArray = explode("-", $myDate);
	$myDay = sprintf("%d", $myDateArray[2]);
	switch($myDateArray[1]) {
		case "01" :
			$myMonth = "ม.ค.";
			break;
		case "02" :
			$myMonth = "ก.พ.";
			break;
		case "03" :
			$myMonth = "มี.ค.";
			break;
		case "04" :
			$myMonth = "เม.ย.";
			break;
		case "05" :
			$myMonth = "พ.ค.";
			break;
		case "06" :
			$myMonth = "มิ.ย.";
			break;
		case "07" :
			$myMonth = "ก.ค.";
			break;
		case "08" :
			$myMonth = "ส.ค.";
			break;
		case "09" :
			$myMonth = "ก.ย.";
			break;
		case "10" :
			$myMonth = "ต.ค.";
			break;
		case "11" :
			$myMonth = "พ.ย.";
			break;
		case "12" :
			$myMonth = "ธ.ค.";
			break;
	}
	$myYear = (sprintf("%d", $myDateArray[0]) + 543) - 2500;
	return ($myDay . " " . $myMonth . " " . $myYear);
}

function ShowDateFull($myDate) {
	$myDateArray = explode("-", $myDate);
	$myDay = sprintf("%d", $myDateArray[2]);

	$myMonth = returnThaiMonth($myDateArray[1]);

	$myYear = (sprintf("%d", $myDateArray[0]) + 543) - 2500;
	return ($myDay . " " . $myMonth . " " . $myYear);
}

function ShowDateYearFull($myDate) {
	$myDateArray = explode("-", $myDate);
	$myDay = sprintf("%d", $myDateArray[2]);

	$myMonth = returnThaiMonth($myDateArray[1]);

	$myYear = (sprintf("%d", $myDateArray[0]) + 543);
	return ($myDay . " " . $myMonth . " " . $myYear);
}

function ShowMonthYear($myDate) {
	$myDateArray = explode("-", $myDate);

	$myMonth = returnThaiMonth($myDateArray[1]);

	$myYear = sprintf("%d", $myDateArray[0]) + 543;
	return ($myMonth . " " . $myYear);
}

function returnThaiMonth($str) {
	switch($str) {
		case "01" :
			$myMonth = "มกราคม";
			break;
		case "02" :
			$myMonth = "กุมภาพันธ์";
			break;
		case "03" :
			$myMonth = "มีนาคม";
			break;
		case "04" :
			$myMonth = "เมษายน";
			break;
		case "05" :
			$myMonth = "พฤษภาคม";
			break;
		case "06" :
			$myMonth = "มิถุนายน";
			break;
		case "07" :
			$myMonth = "กรกฎาคม";
			break;
		case "08" :
			$myMonth = "สิงหาคม";
			break;
		case "09" :
			$myMonth = "กันยายน";
			break;
		case "10" :
			$myMonth = "ตุลาคม";
			break;
		case "11" :
			$myMonth = "พฤศจิกายน";
			break;
		case "12" :
			$myMonth = "ธันวาคม";
			break;
	}
	return $myMonth;
}

function returnThaiShortMonth($str) {
	switch($str) {
		case "01" :
			$myMonth = "ม.ค.";
			break;
		case "02" :
			$myMonth = "ก.พ.";
			break;
		case "03" :
			$myMonth = "มี.ค.";
			break;
		case "04" :
			$myMonth = "เม.ย.";
			break;
		case "05" :
			$myMonth = "พ.ค.";
			break;
		case "06" :
			$myMonth = "มิ.ย.";
			break;
		case "07" :
			$myMonth = "ก.ค.";
			break;
		case "08" :
			$myMonth = "ส.ค.";
			break;
		case "09" :
			$myMonth = "ก.ย.";
			break;
		case "10" :
			$myMonth = "ต.ค.";
			break;
		case "11" :
			$myMonth = "พ.ย.";
			break;
		case "12" :
			$myMonth = "ธ.ค.";
			break;
	}
	return $myMonth;
}

function returnThaiDayOfWeek($str) {
	switch($str) {
		case "Sunday" :
			$myDay = "อาทิตย์";
			break;
		case "Monday" :
			$myDay = "จันทร์";
			break;
		case "Tuesday" :
			$myDay = "อังคาร";
			break;
		case "Wednesday" :
			$myDay = "พุธ";
			break;
		case "Thursday" :
			$myDay = "พฤหัสบดี";
			break;
		case "Friday" :
			$myDay = "ศุกร์";
			break;
		case "Saturday" :
			$myDay = "เสาร์";
			break;
	}
	return $myDay;
}

function ConvertDate($str) {
	if ($_SESSION['LANG'] == 'TH') {
		return ShowDateYearFull(trim($str));
	} else {
		return date("d M Y", strtotime(trim($str)));
	}
}

function ConvertDateToDB($str) {
	return date("Y-m-d H:i:s", strtotime(trim($str)));
}

function ConvertBoxDate($str) {
	if ($_SESSION['LANG'] == 'TH') {
		$strtotime = strtotime(trim($str));
		$date[0] = date("d", $strtotime);
		$date[1] = returnThaiShortMonth(date("m", $strtotime));
	} else {
		$strtotime = strtotime(trim($str));
		$date[0] = date("d", $strtotime);
		$date[1] = date("M", $strtotime);
	}
	return $date;
}

function x_week_range($date) {
	$ts = strtotime($date);
	$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
	return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next saturday', $start)));
}

function logs_access($user, $msg) {
	/*
	 if(!is_dir(_LOG_PATH_)) { mkdir(_LOG_PATH_,0777); }else{ chmod(_LOG_PATH_,0777); }

	 $dirPath = _LOG_PATH_.'/'.date("Y_m");
	 $FilePath = _LOG_PATH_.'/'.date("Y_m").'/'.date("d").".txt";

	 if(!is_dir($dirPath)) { mkdir($dirPath,0777); }else{ chmod($dirPath,0777); }

	 $myDateNow = date("Y-m-d");
	 $myTimeNow = date("H:i:s");

	 if(!is_file($FilePath)) {
	 $fp = fopen($FilePath, 'w+');
	 $text_write = "DateTime|:|Ip address|:|User|:|Log\n\n";
	 } else {
	 $fp = fopen($FilePath, 'a');
	 $text_write = '';
	 }
	 if($user == ''){
	 $user = ' - ';
	 }

	 fwrite($fp, $text_write.$myDateNow." ".$myTimeNow."|:|".find_ip()."|:|".$user."|:|".$msg."\n");
	 fclose($fp);

	 chmod($FilePath,0755);
	 chmod($dirPath,0755);
	 chmod(_LOG_PATH_,0755);
	 */
}

function admin_move_image_upload_dir($dir, $file, $width, $height, $crop, $thumbwidth, $thumbheight) {
	$path1 = '../../upload';
	$path2 = $path1 . '/' . $dir;
	$path3 = $path2 . '/' . date("Y_m") . '/';
	$path4 = $path3 . '/thumbnail/';
	$old_path1 = '../../assets/plugin/upload/php/files/';

	if (!is_dir($path1)) { mkdir($path1, 0777);
	} else { chmod($path1, 0777);
	}
	if (!is_dir($path2)) { mkdir($path2, 0777);
	} else { chmod($path2, 0777);
	}
	if (!is_dir($path3)) { mkdir($path3, 0777);
	} else { chmod($path3, 0777);
	}
	if (!is_dir($path4)) { mkdir($path4, 0777);
	} else { chmod($path4, 0777);
	}

	//include('../../assets/class/abeautifulsite/SimpleImage.php');
	//$img = new abeautifulsite\SimpleImage();

	$output = time() . '_' . rand(111, 999) . '.' . getEXT($file);
	$original_path = $old_path1 . $file;
	$thumb_path = $old_path1 . 'thumbnail/' . $file;

	copy($original_path, $path3 . $output);
	copy($original_path, $path4 . $output);
	unlink($original_path);
	unlink($thumb_path);

	/*
	 try {
	 $img->load($original_path);

	 if($crop){
	 $img->fit_to_width($width)->crop(0, 0, $width, $height);
	 }else{
	 if($width == ''){
	 $img->fit_to_height($height);
	 }else if($height == ''){
	 $img->fit_to_width($width);
	 }else{
	 $img->resize($width, $height);
	 }
	 }

	 $img->save($path3.$output);

	 $img->thumbnail($thumbwidth, $thumbheight)->save($path4.$output);

	 unlink($original_path);
	 unlink($thumb_path);

	 } catch (Exception $e) {
	 echo '<span style="color: red;">'.$e->getMessage().'</span>';
	 }
	 */

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);
	chmod($path4, 0755);

	return $path3 . $output;
}

function admin_upload_image($name) {
	$str = "";

	$str .= '<input class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box dNone image_Box_add"></div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone"></div>' . "\n\t";
	$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";

	return $str;
}

function admin_upload_image_edit($name, $type, $id) {
	global $conn;

	$str = "";

	$str .= '<input class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID =" . $type . " AND IMG_TYPE = 1 ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);

	$num = mysql_num_rows($query);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div id="img_edit_' . $row['PIC_ID'] . '" data-id="' . $row['PIC_ID'] . '" class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="thumbBoxAction dNone p-Absolute">' . "\n\t";
		$str .= '<a onclick="delImageEdit(\'' . $row['PIC_ID'] . '\' , \'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="../images/small-n-flat/sign-ban.svg" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($num > 0) {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}
	return $str;
}

function admin_upload_image_view($name, $type, $id) {
	global $conn;

	$str = "";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID =" . $type . " AND IMG_TYPE = 1 ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data">' . "\n\t";
	$str .= '</div>' . "\n\t";
	return $str;
}

function str_replace_last($search, $replace, $subject) {
	if (!$search || !$replace || !$subject)
		return false;

	$index = strrpos($subject, $search);
	if ($index === false)
		return $subject;

	$pre = substr($subject, 0, $index);

	$post = substr($subject, $index);

	$post = str_replace($search, $replace, $post);

	return $pre . $post;
}

function callThumbList($id, $type, $staus) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_content_picture WHERE IMG_TYPE = 1 AND CONTENT_ID = " . $id . " AND CAT_ID =" . $type . " ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($staus) {
			return $row['IMG_PATH'];
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '\');"';
		}

	} else {
		if ($staus) {
			return '../images/logo_thumb.jpg';
		} else {
			return '';
		}
	}

}

function deleteImageList($id, $type) {
	global $conn;
	$dir_path = '';

	$sql = "SELECT PIC_ID , IMG_PATH FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID =" . $type . " ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		if ($dir_path == '') {
			$dir_path = dirname($row['IMG_PATH']) . PHP_EOL;
			$dir_path = trim($dir_path) . '/';
			chmod($dir_path, 0777);
			chmod($dir_path . '/thumbnail', 0777);
		}
		if (file_exists($row['IMG_PATH'])) {
			chmod($row['IMG_PATH'], 0777);
			@unlink($row['IMG_PATH']);
		}
		$thumb = str_replace_last('/', '/thumbnail/', $row['IMG_PATH']);
		if (file_exists($thumb)) {
			chmod($thumb, 0777);
			@unlink($thumb);
		}

		mysql_query("DELETE FROM trn_content_picture WHERE PIC_ID = " . $row['PIC_ID'], $conn);
	}

	chmod($dir_path, 0755);
	mysql_query("OPTIMIZE TABLE trn_content_picture", $conn);
}

function Optimizeimageupload() {
	$path = '../../assets/plugin/upload/php/files/';
	$week = (7 * 24 * 60 * 60);
	chmod($path, 0777);
	if ($handle = opendir($path)) {

		while (false !== ($entry = readdir($handle))) {

			if ($entry != "." && $entry != ".." && is_file($path . $entry)) {

				$file_date = filemtime($path . $entry);
				$limit_date = time() - $week;
				if ($file_date <= $limit_date) {
					chmod($path . $entry, 0777);
					@unlink($path . $entry);
					$thumb = $path . 'thumbnail/' . $entry;
					if (file_exists($thumb)) {
						chmod($thumb, 0777);
						@unlink($thumb);
					}
				}
			}
		}

		closedir($handle);
	}
	chmod($path, 0755);
}

function nvl($originalVal, $returnWhenNull) {
	if (is_null($originalVal))
		return $returnWhenNull;
	else if ($originalVal == "")
		return $returnWhenNull;
	else
		return $originalVal;
}

function createPasswordHash($strPlainText) {
	return hash('sha512', $strPlainText);
	/*
	 if (CRYPT_SHA512 != 1) {
	 throw new Exception('Hashing mechanism not supported.');
	 }
	 return crypt($strPlainText, '$6$rounds=4567$abcdefghijklmnop$');*/
}

function admin_upload_icon_edit($name, $iconType, $moduleId, $subModuleId) {
	global $conn;

	$str = "";
	$str .= '<input class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$fieldNameToGetIcon = "";
	if ($iconType == 'BIG')
		$fieldNameToGetIcon = "DESKTOP_ICON_PATH";
	else if ($iconType == 'SMALL')
		$fieldNameToGetIcon = "MOBILE_ICON_PATH";

	if (isset($moduleId))
		$sql = "SELECT * FROM trn_banner_pic_setting WHERE APP_MODULE_ID = " . $moduleId . " order by LAST_UPDATE_DATE desc Limit 0,1 ";
	else if (isset($subModuleId))
		$sql = "SELECT * FROM trn_banner_pic_setting WHERE APP_SUB_MODULE_ID = " . $subModuleId . " order by LAST_UPDATE_DATE desc Limit 0,1 ";
	//echo $sql;
	$query = mysql_query($sql, $conn);
	$num = 0;
	// mysql_num_rows($query);
	while ($row = mysql_fetch_array($query)) {
		if (nvl($row[$fieldNameToGetIcon], '') != '') {
			$str .= '<div id="img_edit_' . $iconType . '_' . $row['BANNER_ID'] . '" data-id="' . $row['BANNER_ID'] . '" class="thumbBoxEdit floatL p-Relative">' . "\n\t";
			$str .= '<div class="thumbBoxImage">' . "\n\t";
			$str .= '<a onclick="popupImage(\'' . $row[$fieldNameToGetIcon] . '\'); return false;" href="#">' . "\n\t";
			$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row[$fieldNameToGetIcon]) . '" alt="">' . "\n\t";
			$str .= '</a>' . "\n\t";
			$str .= '</div>' . "\n\t";
			$str .= '<div class="thumbBoxAction dNone p-Absolute">' . "\n\t";
			$str .= '<a onclick="delIconImageEdit(\'' . $row['BANNER_ID'] . '\' , \'' . $iconType . '\' , \'' . $row[$fieldNameToGetIcon] . '\'); return false;" href="#">' . "\n\t";
			$str .= '<img src="../images/small-n-flat/sign-ban.svg" alt="">' . "\n\t";
			$str .= '</a>' . "\n\t";
			$str .= '</div>' . "\n\t";
			$str .= '</div>' . "\n\t";
			$num++;
		}
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($num > 0) {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}
	return $str;
}

function admin_upload_icon_image_view($name, $iconType, $moduleId, $subModuleId) {
	global $conn;

	$str = "";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$fieldNameToGetIcon = "";
	if ($iconType == 'BIG')
		$fieldNameToGetIcon = "DESKTOP_ICON_PATH";
	else if ($iconType == 'SMALL')
		$fieldNameToGetIcon = "MOBILE_ICON_PATH";

	if (isset($moduleId))
		$sql = "SELECT * FROM trn_banner_pic_setting WHERE APP_MODULE_ID = " . $moduleId . " order by LAST_UPDATE_DATE desc Limit 0,1 ";
	else if (isset($subModuleId))
		$sql = "SELECT * FROM trn_banner_pic_setting WHERE APP_SUB_MODULE_ID = " . $subModuleId . " order by LAST_UPDATE_DATE desc Limit 0,1 ";

	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row[$fieldNameToGetIcon] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row[$fieldNameToGetIcon]) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data">' . "\n\t";
	$str .= '</div>' . "\n\t";
	return $str;
}

function callIconThumbList($iconType, $moduleId, $subModuleId, $genStyleTag) {
	global $conn;

	$fieldNameToGetIcon = "";
	if ($iconType == 'BIG')
		$fieldNameToGetIcon = "DESKTOP_ICON_PATH";
	else if ($iconType == 'SMALL')
		$fieldNameToGetIcon = "MOBILE_ICON_PATH";

	$whereStatement = "";
	if (isset($moduleId))
		$whereStatement = " WHERE  APP_MODULE_ID = " . $moduleId;
	else
		$whereStatement = " WHERE  APP_SUB_MODULE_ID = " . $subModuleId;

	$sql = "SELECT " . $fieldNameToGetIcon . " FROM trn_banner_pic_setting " . $whereStatement . " order by LAST_UPDATE_DATE desc Limit 0,1";

	//echo $sql;
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($genStyleTag) {
			if ($row[$fieldNameToGetIcon] == '') {
				return '';
			} else {
				return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', $row[$fieldNameToGetIcon]) . '\');"';
			}
		} else {
			return $row[$fieldNameToGetIcon];
		}
	} else {
		if ($genStyleTag)
			return 'style="background-image: url(\'../images/logo_thumb.jpg\');"';
		else
			return '';

	}

}

function mysendMail($to, $to_name, $send, $send_name, $subject, $message) {

	require 'assets/plugin/PHPMailer/PHPMailerAutoload.php';

	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	$mail -> IsSMTP();
	$mail -> SMTPDebug = 0;
	$mail -> Debugoutput = 'html';
	$mail -> Host = _MAIL_HOST_;
	$mail -> Port = _MAIL_PORT_;
	$mail -> SMTPAuth = true;
	$mail -> Username = _MAIL_USER_;
	$mail -> Password = _MAIL_PASS_;
	$mail -> SetFrom($send, $send_name);
	$mail -> AddAddress($to, $to_name);
	$mail -> Subject = $subject;
	$mail -> Body = $message;
	$mail -> AltBody = strip_tags($message);
	$mail -> CharSet = 'UTF-8';

	//Send the message, check for errors
	if (!$mail -> Send()) {
		return false;
	} else {
		return true;
	}
}

function admin_upload_video($name, $type) {
	/*
	 $type เป็น string มี 4 แบบ
	 1. 'video' สำหรับวีดีโอเท่านัน้
	 2. 'sound' สำหรับเสียงเท่านัน้
	 3. 'flash' สำหรับไฟล์ swf เท่านัน้
	 4. 'all' ได้ video sound flash
	 */

	$str = array();

	$str[0];

	$str[0] .= '<div class="tabs">' . "\n\t";
	$str[0] .= '<ul>' . "\n\t";
	$str[0] .= '<li><a href="#tabs_' . $name . '_1">Upload</a></li>' . "\n\t";
	if ($type == 'video') {
		$str[0] .= '<li><a href="#tabs_' . $name . '_2">Embed</a></li>' . "\n\t";
	}
	$str[0] .= '<li><a href="#tabs_' . $name . '_3">Link</a></li>' . "\n\t";
	$str[0] .= '</ul>' . "\n\t";
	$str[0] .= '<div id="tabs_' . $name . '_1">' . "\n\t";
	$str[0] .= '<input class="buttonAction silver-flat-button VideoUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
	$str[0] .= '<img class="VideoUpload_loading" id="VideoUpload_loading_' . $name . '" src="../images/ajax-loader.gif" alt="loading" />' . "\n\t";
	$str[0] .= '<div class="DataBlock dNone"></div>' . "\n\t";
	$str[0] .= '</div>' . "\n\t";
	if ($type == 'video') {
		$str[0] .= '<div id="tabs_' . $name . '_2">' . "\n\t";
		$str[0] .= '<input type="text" class="Embed_input" name="Embed_input_' . $name . '" />' . "\n\t";
		$str[0] .= '<input class="buttonAction silver-flat-button EmbedUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
		$str[0] .= '<span class="video_note">* ใส่แค่รหัสวีดีโอ youtube เท่านั้น</span>' . "\n\t";
		$str[0] .= '<div class="DataBlock"></div>' . "\n\t";
		$str[0] .= '</div>' . "\n\t";
	}
	$str[0] .= '<div id="tabs_' . $name . '_3">' . "\n\t";
	$str[0] .= '<input type="text" class="Link_input" name="Link_input_' . $name . '" />' . "\n\t";
	$str[0] .= '<input class="buttonAction silver-flat-button LinkUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
	$str[0] .= '<span class="video_note">* ใส่แค่ url เท่านั้น</span>' . "\n\t";
	$str[0] .= '<div class="DataBlock"></div>' . "\n\t";
	$str[0] .= '</div>' . "\n\t";
	$str[0] .= '</div>' . "\n\t";

	$str[0] .= '<div class="dNone" id="DataBlock_' . $name . '"></div>' . "\n\t";

	switch ($type) {
		case "video" :
			$accept = 'video/*';
			break;
		case "sound" :
			$accept = 'audio/*';
			break;
		case "flash" :
			$accept = '.swf';
			break;
		case "doc" :
			$accept = '.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.txt,';
			break;
		case "all" :
			$accept = '*.*';
			break;
	}

	$str[1] = '<form action="../master/videoUpload.php" target="iframeTarget" method="post" name="form_' . $name . '" enctype="multipart/form-data">' . "\n\t";
	$str[1] .= '<input type="hidden" name="my_name" value="' . $name . '" >' . "\n\t";
	$str[1] .= '<input class="inputUploadVideo" type="file" name="my_files" data-name="' . $name . '" accept="' . $accept . '" >' . "\n\t";
	$str[1] .= '</form>' . "\n\t";

	return $str;

}

function admin_view_video($id, $cat, $name) {
	global $conn;

	$str = '';

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID = " . $cat . " AND IMG_TYPE > 1 AND DIV_NAME = '" . $name . "' ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {

		if ($row['IMG_TYPE'] == 2) {
			$path_image = $row['IMG_PATH'];
			$path_name = $row['IMG_NAME'];
			$path_type = 'Upload';
			$style = 'class="UploadVideoBox" style="background-image:url(' . returnUploadFileExtensions($row['IMG_PATH']) . ')"';
		} else if ($row['IMG_TYPE'] == 3) {
			$path_image = $row['IMG_PATH'];
			$path_name = $row['IMG_NAME'];
			$path_type = 'Embed';
			$style = ' style="background-image: url(&quot;http://img.youtube.com/vi/x6tNmen4ylw/maxresdefault.jpg&quot;);"';
		} else if ($row['IMG_TYPE'] == 4) {
			$path_image = $row['IMG_PATH'];
			$path_name = $row['IMG_NAME'];
			$path_type = 'Link';
			$style = ' class="LinkVideoBox" style="background-image:url(' . returnUploadFileExtensions($row['IMG_PATH']) . ')"';
		}

		$str .= '<div class="DataBlock DataBlockEdit">' . "\n\t";
		$str .= '<div class="' . $path_type . '_tab">' . "\n\t";
		$str .= '<a onClick="popup' . $path_type . '(\'' . $path_image . '\'); return false;" href="#">' . "\n\t";
		$str .= '<span ' . $style . '></span>' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '<input value="' . $path_name . '" class="video_edit_name" disabled name="video_name">' . "\n\t";
		$str .= '<a onClick="popup' . $path_type . '(\'' . $path_image . '\'); return false;" href="#">' . "\n\t";
		$str .= '<span class="' . $path_type . 'Action view' . $path_type . '"></span>' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	return $str;

}

function callThumbListFrontEnd($id, $type, $staus) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND CAT_ID =" . $type . " AND IMG_TYPE = 1 ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($staus) {
			return str_replace('../../', '', $row['IMG_PATH']);
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', str_replace('../../', '', $row['IMG_PATH'])) . '\');"';
		}

	} else {
		if ($staus) {
			return 'images/logo_thumb.jpg';
		} else {
			return '';
		}
	}

}

function my_substring($str, $length) {
	return mb_substr($str, 0, $length, 'UTF-8');
}

function callIconThumbListFrontend($iconType, $moduleId, $subModuleId, $genStyleTag) {
	global $conn;

	$fieldNameToGetIcon = "";
	if ($iconType == 'BIG')
		$fieldNameToGetIcon = "DESKTOP_ICON_PATH";
	else if ($iconType == 'SMALL')
		$fieldNameToGetIcon = "MOBILE_ICON_PATH";

	$whereStatement = "";
	if (isset($moduleId))
		$whereStatement = " WHERE  APP_MODULE_ID = " . $moduleId;
	else
		$whereStatement = " WHERE  APP_SUB_MODULE_ID = " . $subModuleId;

	$sql = "SELECT " . $fieldNameToGetIcon . " FROM trn_banner_pic_setting " . $whereStatement . " order by LAST_UPDATE_DATE ASC Limit 0,1";

	//echo $sql;
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($genStyleTag) {
			if ($row[$fieldNameToGetIcon] == '') {
				return '';
			} else {
				return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', str_replace('../../', '', $row[$fieldNameToGetIcon])) . '\');"';
			}
		} else {
			return str_replace('../../', '', $row[$fieldNameToGetIcon]);
		}
	} else {
		if ($genStyleTag)
			return 'style="background-image: url(\'images/logo_thumb.jpg\');"';
		else
			return 'images/logo_thumb.jpg';

	}

}

function callThumbListFrontEndByID($id, $type, $staus) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_content_picture WHERE PIC_ID = " . $id . " AND CAT_ID =" . $type . " ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($staus) {
			return str_replace('../../', '', $row['IMG_PATH']);
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', str_replace('../../', '', $row['IMG_PATH'])) . '\');"';
		}

	} else {
		if ($staus) {
			return 'images/logo_thumb.jpg';
		} else {
			return 'style="background-image: url(\'images/logo_thumb.jpg\');"';
		}
	}

}

function admin_edit_video($name, $id, $cat, $type) {
	/* เหมือนตัว add */
	global $conn;

	$str = array();

	$total = 0;

	$str[0];

	$str[0] .= '<div class="tabs">' . "\n\t";
	$str[0] .= '<ul>' . "\n\t";
	$str[0] .= '<li><a href="#tabs_' . $name . '_1">Upload</a></li>' . "\n\t";
	if ($type == 'video') {
		$str[0] .= '<li><a href="#tabs_' . $name . '_2">Embed</a></li>' . "\n\t";
	}
	$str[0] .= '<li><a href="#tabs_' . $name . '_3">Link</a></li>' . "\n\t";
	$str[0] .= '</ul>' . "\n\t";
	$str[0] .= '<div id="tabs_' . $name . '_1">' . "\n\t";
	$str[0] .= '<input class="buttonAction silver-flat-button VideoUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
	$str[0] .= '<img class="VideoUpload_loading" id="VideoUpload_loading_' . $name . '" src="../images/ajax-loader.gif" alt="loading" />' . "\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND IMG_TYPE =  '2' AND CAT_ID = " . $cat . " AND DIV_NAME =  '" . $name . "' ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn) or die($sql);
	$num = mysql_num_rows($query);
	if ($num == 0) {
		$str[0] .= '<div class="DataBlock dNone"></div>' . "\n\t";
	} else {
		$total += $num;
		$str[0] .= '<div class="DataBlock">' . "\n\t";
		while ($row = mysql_fetch_array($query)) {
			$str[0] .= '<div class="Upload_tab" data-value="' . $row['IMG_PATH'] . '">';
			$str[0] .= '<a href="#" onclick="popupUpload(\'' . $row['IMG_PATH'] . '\'); return false;">';
			$str[0] .= '<span class="UploadVideoBox" data-Name="' . $row['IMG_PATH'] . '" style="background-image:url(' . returnUploadFileExtensions($row['IMG_PATH']) . ')"></span>';
			$str[0] .= '</a>';
			$str[0] .= '<input name="video_name" class="video_edit_name" data-value="' . $row['IMG_PATH'] . '" value="' . $row['IMG_NAME'] . '" onblur="editVideoName(\'' . $row['IMG_PATH'] . '\',\'' . $name . '\', 1)" />';
			$str[0] .= '<a href="#" onclick="popupUpload(\'' . $row['IMG_PATH'] . '\'); return false;">';
			$str[0] .= '<span class="UploadAction viewUpload"></span>';
			$str[0] .= '</a>';
			$str[0] .= '<a href="#" onclick="delEditVideo(\'' . $row['IMG_PATH'] . '\',\'' . $name . '\',\'' . $row['PIC_ID'] . '\',1); return false;">';
			$str[0] .= '<span class="UploadAction delUpload"></span>';
			$str[0] .= '</a>';
			$str[0] .= '</div>';
		}
		$str[0] .= '</div>' . "\n\t";
	}
	$str[0] .= '</div>' . "\n\t";
	if ($type == 'video') {
		$str[0] .= '<div id="tabs_' . $name . '_2">' . "\n\t";
		$str[0] .= '<input type="text" class="Embed_input" name="Embed_input_' . $name . '" />' . "\n\t";
		$str[0] .= '<input class="buttonAction silver-flat-button EmbedUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
		$str[0] .= '<span class="video_note">* ใส่แค่รหัสวีดีโอ youtube เท่านั้น</span>' . "\n\t";

		$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND IMG_TYPE =  '3' AND CAT_ID = " . $cat . " AND DIV_NAME =  '" . $name . "' ORDER BY ORDER_ID ASC";
		$query = mysql_query($sql, $conn) or die($sql);
		$num = mysql_num_rows($query);
		if ($num == 0) {
			$str[0] .= '<div class="DataBlock dNone"></div>' . "\n\t";
		} else {
			$total += $num;
			$str[0] .= '<div class="DataBlock">' . "\n\t";
			while ($row = mysql_fetch_array($query)) {
				$str[0] .= '<div class="Embed_tab" data-value="' . $row['IMG_PATH'] . '">';
				$str[0] .= '<a href="#" onclick="popupEmbed(\'' . $row['IMG_PATH'] . '\'); return false;">';
				$str[0] .= '<span data-Name="' . $row['IMG_PATH'] . '" style="background-image:url(http://img.youtube.com/vi/' . $row['IMG_NAME'] . '/maxresdefault.jpg)"></span>';
				$str[0] .= '</a>';
				$str[0] .= '<input name="video_name" class="video_edit_name" data-value="' . $row['IMG_PATH'] . '" disabled value="https://youtu.be/' . $row['IMG_NAME'] . '" onblur="editVideoName2(\'' . $row['IMG_PATH'] . '\',\'' . $row['IMG_NAME'] . '\', 2)" />';
				$str[0] .= '<a href="#" onclick="popupEmbed(\'' . $row['IMG_PATH'] . '\'); return false;">';
				$str[0] .= '<span class="EmbedAction viewEmbed"></span>';
				$str[0] .= '</a>';
				$str[0] .= '<a href="#" onclick="delEditVideo(\'' . $row['IMG_PATH'] . '\',\'' . $name . '\',\'' . $row['PIC_ID'] . '\',2); return false;">';
				$str[0] .= '<span class="EmbedAction delEmbed"></span>';
				$str[0] .= '</a>';
				$str[0] .= '</div>';
			}
			$str[0] .= '</div>' . "\n\t";
		}

		$str[0] .= '</div>' . "\n\t";
	}
	$str[0] .= '<div id="tabs_' . $name . '_3">' . "\n\t";
	$str[0] .= '<input type="text" class="Link_input" name="Link_input_' . $name . '" />' . "\n\t";
	$str[0] .= '<input class="buttonAction silver-flat-button LinkUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
	$str[0] .= '<span class="video_note">* ใส่แค่ url เท่านั้น</span>' . "\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND IMG_TYPE =  '4' AND CAT_ID = " . $cat . " AND DIV_NAME =  '" . $name . "' ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn) or die($sql);
	$num = mysql_num_rows($query);
	if ($num == 0) {
		$str[0] .= '<div class="DataBlock dNone"></div>' . "\n\t";
	} else {
		$total += $num;
		$str[0] .= '<div class="DataBlock">' . "\n\t";
		while ($row = mysql_fetch_array($query)) {

			$str[0] .= '<div class="Link_tab" data-value="' . $row['IMG_PATH'] . '">';
			$str[0] .= '<a href="#" onclick="popupLink(\'' . $row['IMG_PATH'] . '\'); return false;">';
			$str[0] .= '<span class="LinkVideoBox" data-Name="' . $row['IMG_PATH'] . '" style="background-image:url(' . returnUploadFileExtensions($row['IMG_PATH']) . ')"></span>';
			$str[0] .= '</a>';
			$str[0] .= '<input name="video_name" class="video_edit_name" data-value="' . $row['IMG_PATH'] . '" value="' . $row['IMG_NAME'] . '" onblur="editVideoName2(\'' . $row['IMG_PATH'] . '\',\'' . $name . '\',\'' . $row['PIC_ID'] . '\', 3)" />';
			$str[0] .= '<a href="#" onclick="popupLink(\'' . $row['IMG_PATH'] . '\'); return false;">';
			$str[0] .= '<span class="LinkAction viewLink"></span>';
			$str[0] .= '</a>';
			$str[0] .= '<a href="#" onclick="delEditVideo(\'' . $row['IMG_PATH'] . '\',\'' . $name . '\',\'' . $row['PIC_ID'] . '\',3); return false;">';
			$str[0] .= '<span class="LinkAction delLink"></span>';
			$str[0] .= '</a>';
			$str[0] .= '</div>';
		}
		$str[0] .= '</div>' . "\n\t";
	}

	if ($total == 0) {
		$total = 'dNone';
	} else {
		$total = '';
	}
	$str[0] .= '</div>' . "\n\t";
	$str[0] .= '</div>' . "\n\t";

	$str[0] .= '<div class="p-Absolute ' . $total . ' OrderVideoBtn" data-name="' . $name . '" data-cat="' . $cat . '" data-cID="' . $id . '"></div>' . "\n\t";

	$str[0] .= '<div class="dNone" id="DataBlock_' . $name . '"></div>' . "\n\t";

	switch ($type) {
		case "video" :
			$accept = 'video/*';
			break;
		case "sound" :
			$accept = 'audio/*';
			break;
		case "flash" :
			$accept = '.swf';
			break;
		case "doc" :
			$accept = '.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.txt,';
			break;
		case "all" :
			$accept = '*.*';
			break;
	}

	$str[1] = '<form action="../master/videoUpload.php" target="iframeTarget" method="post" name="form_' . $name . '" enctype="multipart/form-data">' . "\n\t";
	$str[1] .= '<input type="hidden" name="my_name" value="' . $name . '" >' . "\n\t";
	$str[1] .= '<input class="inputUploadVideo" type="file" name="my_files" data-name="' . $name . '" accept="' . $accept . '" >' . "\n\t";
	$str[1] .= '</form>' . "\n\t";

	return $str;

}

function returnUploadFileExtensions($path) {

	switch (getEXT($path)) {
		case "mp4" :
		case "webm" :
		case "ogv" :
		case "wmv" :
		case "flv" :
			$image = '../images/video2.svg';
			break;
		case "mp3" :
		case "wav" :
		case "ogg" :
		case "m4a" :
		case "wma" :
			$image = '../images/sound.svg';
			break;
		case "swf" :
			$image = '../images/flash.svg';
			break;
		case "docx" :
		case "doc" :
			$image = '../images/word.svg';
			break;
		case "xlsx" :
		case "xls" :
			$image = '../images/excel.svg';
			break;
		case "pdf" :
			$image = '../images/pdf.svg';
			break;
		case "txt" :
			$image = '../images/txt.svg';
			break;
		case "ppt" :
		case "pptx" :
			$image = '../images/powerpoint.svg';
			break;
		case "zip" :
		case "rar" :
		case "7z" :
			$image = '../images/zip.svg';
			break;

		default :
			$image = '../images/file.svg';
			break;
	}

	return $image;
}

function returnFileType($ext) {

	switch ($ext) {
		case "mp4" :
		case "webm" :
		case "ogv" :
		case "wmv" :
		case "flv" :
			$type = 'video';
			break;
		case "mp3" :
		case "wav" :
		case "ogg" :
		case "m4a" :
		case "wma" :
			$type = 'sound';
			break;
		case "docx" :
		case "doc" :
			$type = 'word';
			break;
		case "xlsx" :
		case "xls" :
			$type = 'excel';
			break;
		case "pdf" :
			$type = 'pdf';
			break;
		case "txt" :
			$type = 'txt';
			break;
		case "swf" :
		case "fla" :
			$image = 'swf';
			break;
		case "ppt" :
		case "pptx" :
			$type = 'powerpoint';
			break;
		case "zip" :
		case "rar" :
		case "7z" :
			$type = 'zip';
			break;
		case "jpg" :
		case "jpeg" :
		case "gif" :
		case "png" :
		case "bmp" :
		case "svg" :
		case "psd" :
		case "tiff" :
		case "raw" :
			$type = 'image';
			break;
		default :
			$type = 'file';
			break;
	}

	return $type;
}

function move_video_file($original_path, $dir) {
	$path1 = '../../upload';
	$path2 = $path1 . '/' . $dir;
	$path3 = $path2 . '/' . date("Y_m");
	$path4 = '../../temp';

	if (!is_dir($path1)) { mkdir($path1, 0777);
	} else { chmod($path1, 0777);
	}
	if (!is_dir($path2)) { mkdir($path2, 0777);
	} else { chmod($path2, 0777);
	}
	if (!is_dir($path3)) { mkdir($path3, 0777);
	} else { chmod($path3, 0777);
	}
	if (!is_dir($path4)) { mkdir($path4, 0777);
	} else { chmod($path4, 0777);
	}

	copy($path4 . '/' . $original_path, $path3 . '/' . $original_path);
	unlink($path4 . '/' . $original_path);

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);
	chmod($path4, 0755);

	return $path3 . '/' . $original_path;
}

function del_video_file($filename) {
	if (file_exists($filename)) {
		$path_parts = pathinfo($filename);
		chmod($path_parts['dirname'], 0777);

		unlink($filename);

		chmod($path_parts['dirname'], 0755);
	}
}

function getModuleDescription($moduleID) {
	if (!isset($_SESSION['LANG']))
		$lang = 'TH';
	else
		$lang = $_SESSION['LANG'];
	$sql = "select MODULE_NAME_LOC , MODULE_NAME_ENG from sys_app_module where MODULE_ID = " . $moduleID;
	$rsModule = mysql_query($sql) or die(mysql_error());
	$ret = '';
	while ($rowModule = mysql_fetch_array($rsModule)) {
		if ($lang == 'TH')
			$ret = $rowModule['MODULE_NAME_LOC'];
		else
			$ret = $rowModule['MODULE_NAME_ENG'];
	}
	return $ret;
}

function getCategoryDescription($catID) {
	if (!isset($_SESSION['LANG']))
		$lang = 'TH';
	else
		$lang = $_SESSION['LANG'];
	$sql = "select CONTENT_CAT_DESC_LOC , CONTENT_CAT_DESC_ENG from trn_content_category where CONTENT_CAT_ID = " . $catID;
	$rsCat = mysql_query($sql) or die(mysql_error());
	$ret = '';
	while ($rowCat = mysql_fetch_array($rsCat)) {
		if ($lang == 'TH')
			$ret = $rowCat['CONTENT_CAT_DESC_LOC'];
		else
			$ret = $rowCat['CONTENT_CAT_DESC_ENG'];
	}
	return $ret;
}

function getSubCategoryDescription($subCatID) {
	if (!isset($_SESSION['LANG']))
		$lang = 'TH';
	else
		$lang = $_SESSION['LANG'];
	$sql = "select SUB_CONTENT_CAT_DESC_LOC , SUB_CONTENT_CAT_DESC_ENG from trn_content_sub_category where SUB_CONTENT_CAT_ID = " . $subCatID;
	$rsSubCat = mysql_query($sql) or die(mysql_error());
	$ret = '';
	while ($rowSubCat = mysql_fetch_array($rsSubCat)) {
		if ($lang == 'TH')
			$ret = $rowSubCat['SUB_CONTENT_CAT_DESC_LOC'];
		else
			$ret = $rowSubCat['SUB_CONTENT_CAT_DESC_ENG'];
	}
	return $ret;
}

function add360function($name) {
	$temp_name = time() . '_' . rand(111, 999);
	$str = "";

	$str .= '<input id="fileupload360_' . $name . '" class="fileupload360" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/three_hundred_and_sixty/?n=' . $temp_name . '" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image360_' . $name . '_Box image_Box dNone image_Box_add"></div>' . "\n\t";
	$str .= '<div class="image360_' . $name . '_data image_Data dNone"><input type="hidden" name="box_image360_' . $name . '" value="' . $temp_name . '" /></div>' . "\n\t";

	return $str;
}

function edit360function($name, $id, $cat) {
	$temp_name = time() . '_' . rand(111, 999);

	global $conn;

	$str = "\n\t";

	$sql = "SELECT IMG_PATH , IMG_NAME FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND IMG_TYPE =  '5' AND CAT_ID = " . $cat . " AND DIV_NAME =  '" . $name . "' ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn) or die($sql);
	$num = mysql_num_rows($query);
	if ($num == 0) {
		$str .= '<input id="fileupload360_' . $name . '" class="fileupload360" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/three_hundred_and_sixty/?n=' . $temp_name . '" accept="image/*" multiple>' . "\n\t";
		$str .= '<div id="progress_' . $name . '">' . "\n\t";
		$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="image360_' . $name . '_Box image_Box dNone image_Box_add"></div>' . "\n\t";
		$str .= '<div class="image360_' . $name . '_data image_Data dNone"><input type="hidden" name="box_image360_' . $name . '" value="' . $temp_name . '" /></div>' . "\n\t";
	} else {
		$row = mysql_fetch_array($query);
		list($width, $height, $type, $attr) = getimagesize($row['IMG_PATH']);

		$str .= '<input id="fileupload360_' . $name . '" class="fileupload360 dNone" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/three_hundred_and_sixty/?n=' . $temp_name . '" accept="image/*" multiple>' . "\n\t";
		$str .= '<div id="progress_' . $name . '">' . "\n\t";
		$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="image360_' . $name . '_Box image_Box image_Box_add">' . "\n\t";
		$str .= '<span id="preview360Box' . $name . '" class="p-Relative">' . "\n\t";
		$str .= '<a onclick="preview360(\'' . $name . '\',true,\'' . $id . '\',\'' . $cat . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . $row['IMG_PATH'] . '" class="dBlock image360thumb">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '<img onclick="deletePreview360(\'' . $name . '\',\'' . $row['IMG_NAME'] . '\');" class="p-Absolute image360thumbDel" src="../images/small-n-flat/sign-ban.svg" alt="" style="left: ' . ($width - 5) . 'px;">' . "\n\t";
		$str .= '</span>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="image360_' . $name . '_data image_Data dNone">' . "\n\t";
		$str .= '<input type="hidden" value="' . $temp_name . '" name="box_image360_' . $name . '">' . "\n\t";
		$str .= '</div>' . "\n\t";
	}

	return $str;
}

function view360function($name, $id, $cat) {

	global $conn;

	$str = "\n\t";

	$sql = "SELECT IMG_PATH , IMG_NAME FROM trn_content_picture WHERE CONTENT_ID = " . $id . " AND IMG_TYPE =  '5' AND CAT_ID = " . $cat . " AND DIV_NAME =  '" . $name . "' ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn) or die($sql);
	$num = mysql_num_rows($query);
	if ($num > 0) {
		$row = mysql_fetch_array($query);
		list($width, $height, $type, $attr) = getimagesize($row['IMG_PATH']);

		$str .= '<div class="image360_' . $name . '_Box image_Box image_Box_add">' . "\n\t";
		$str .= '<span id="preview360Box' . $name . '" class="p-Relative">' . "\n\t";
		$str .= '<a onclick="preview360(\'' . $name . '\',true,\'' . $id . '\',\'' . $cat . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . $row['IMG_PATH'] . '" class="dBlock image360thumb">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</span>' . "\n\t";
		$str .= '</div>' . "\n\t";

	}

	return $str;
}

function admin_move_image360_upload_dir($dir, $file) {
	$path1 = '../../upload';
	$path2 = $path1 . '/' . $dir;
	$path3 = $path2 . '/' . date("Y_m") . '/';
	$old_path1 = '../../assets/plugin/upload/three_hundred_and_sixty/files/';

	if (!is_dir($path1)) { mkdir($path1, 0777);
	} else { chmod($path1, 0777);
	}
	if (!is_dir($path2)) { mkdir($path2, 0777);
	} else { chmod($path2, 0777);
	}
	if (!is_dir($path3)) { mkdir($path3, 0777);
	} else { chmod($path3, 0777);
	}

	$original_path = $old_path1 . $file;

	copy($original_path, $path3 . $file) or die($original_path);
	unlink($original_path);

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);

	return $path3 . $file;
}

function callHeroBannerThumbList($staus) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_hero_banner WHERE IMG_TYPE = 1  ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($staus) {
			return $row['IMG_PATH'];
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '\');"';
		}

	} else {
		if ($staus) {
			return '../images/logo_thumb.jpg';
		} else {
			return '';
		}
	}

}

function admin_upload_banner_hero_edit($name) {
	global $conn;

	$str = "";

	$str .= '<input class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$sql = "SELECT * FROM trn_hero_banner WHERE  IMG_TYPE = 1 ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);

	$num = mysql_num_rows($query);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div id="img_edit_' . $row['PIC_ID'] . '" data-id="' . $row['PIC_ID'] . '" class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="thumbBoxAction dNone p-Absolute">' . "\n\t";
		$str .= '<a onclick="delHeroBannerEdit(\'' . $row['PIC_ID'] . '\' , \'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="../images/small-n-flat/sign-ban.svg" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($num > 0) {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}
	return $str;
}

function admin_upload_hero_banner_view($name) {
	global $conn;

	$str = "";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	$sql = "SELECT * FROM trn_hero_banner WHERE  IMG_TYPE = 1 ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql, $conn);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data">' . "\n\t";
	$str .= '</div>' . "\n\t";
	return $str;
}

function callHeroBannerFrontEnd($picID, $picPath, $staus) {

	if ($picPath != '') {

		if ($staus) {
			return str_replace('../../', '', $picPath);
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', str_replace('../../', '', $picPath)) . '\');"';
		}

	} else {
		if ($staus) {
			return 'images/logo_thumb.jpg';
		} else {
			return '';
		}
	}

}

function callOrgPicture($picPath) {

	if ($picPath != '') {
		return str_replace('../../', '', $picPath);
	} else {
		return 'images/account/user.jpg';
	}
}

function callOrgPictureAdmin($picPath) {

	if ($picPath != '') {
		return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', $picPath) . '\');"';

	} else {
		return 'style="background-image: url(\'' . '../../images/account/user.jpg' . '\');"';
	}
}

function admin_upload_org_image_edit($name, $imgName) {
	global $conn;

	$str = "";

	$str .= '<input class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="../../assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	if ($imgName != '') {
		$str .= '<div id="img_edit_1" data-id="1" class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $imgName . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $imgName) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '<div class="thumbBoxAction dNone p-Absolute">' . "\n\t";
		$str .= '<a onclick="delImageEdit(\'1\' , \'' . $imgName . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="../images/small-n-flat/sign-ban.svg" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($imgName != '') {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}

	return $str;
}

function admin_upload_org_image_view($name, $imgName) {
	global $conn;

	$str = "";
	$str .= '<div class="image_' . $name . '_Box image_Box">' . "\n\t";

	if ($imgName != '') {
		$str .= '<div class="thumbBoxEdit floatL p-Relative">' . "\n\t";
		$str .= '<div class="thumbBoxImage">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $imgName . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace_last('/', '/thumbnail/', $imgName) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";
		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data">' . "\n\t";
	$str .= '</div>' . "\n\t";
	return $str;
}

function ShowYear($myDate) {
	$myDateArray = explode("-", $myDate);

	//$myMonth = returnThaiMonth($myDateArray[1]);
	if ($_SESSION['LANG'] == 'TH')
		$myYear = sprintf("%d", $myDateArray[0]) + 543;
	else
		$myYear = sprintf("%d", $myDateArray[0]);
	return ($myYear);
}

function front_upload_file($name) {

	$type = 'all';

	$str = array();

	$str[0];

	$str[0] .= '<div class="tabs">' . "\n\t";
	$str[0] .= '<ul>' . "\n\t";
	$str[0] .= '<li><a href="#tabs_' . $name . '_1">Upload</a></li>' . "\n\t";

	$str[0] .= '</ul>' . "\n\t";
	$str[0] .= '<div id="tabs_' . $name . '_1">' . "\n\t";
	$str[0] .= '<input class="buttonAction silver-flat-button VideoUpload" type="button" value="แนบ" data-name="' . $name . '">' . "\n\t";
	$str[0] .= '<img class="VideoUpload_loading" id="VideoUpload_loading_' . $name . '" src="administrator/images/ajax-loader.gif" alt="loading" />' . "\n\t";
	$str[0] .= '<div class="DataBlock dNone"></div>' . "\n\t";
	$str[0] .= '</div>' . "\n\t";

	$str[0] .= '</div>' . "\n\t";
	$str[0] .= '<div class="dNone" id="DataBlock_' . $name . '"></div>' . "\n\t";

	switch ($type) {
		case "video" :
			$accept = 'video/*';
			break;
		case "sound" :
			$accept = 'audio/*';
			break;
		case "flash" :
			$accept = '.swf';
			break;
		case "doc" :
			$accept = '.doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.txt,';
			break;
		case "all" :
			$accept = '*.*';
			break;
	}

	$str[1] = '<form action="administrator/master/videoUpload.php" target="iframeTarget" method="post" name="form_' . $name . '" enctype="multipart/form-data">' . "\n\t";
	$str[1] .= '<input type="hidden" name="my_name" value="' . $name . '" >' . "\n\t";
	$str[1] .= '<input class="inputUploadVideo" type="file" name="my_files" data-name="' . $name . '" accept="' . $accept . '" >' . "\n\t";
	$str[1] .= '</form>' . "\n\t";

	return $str;

}

function displaydateformatlong($source) {
	if ($source != '') {
		if ($_SESSION['LANG'] == 'TH') {
			$myDateTime = explode(" ", $source);
			$myDateArray = explode("-", $myDateTime[0]);
			$myYear = sprintf("%d", $myDateArray[0]) + 543;
			$myMonth = returnThaiMonth($myDateArray[1]);
			$myDate = $myDateArray[2];
			return $myDate . ' ' . $myMonth . ' ' . $myYear;
			// . ' ' . $myDateTime[1];

		} else {
			$date = new DateTime($source);
			return $date -> format('j F Y');
		}
		// 1 December 2012 13:30
	}
}

function displayTime($source) {
	$date = new DateTime($source);
	return $date -> format('H:i:s');
}

function displayDate($source) {
	$myDateArray = explode("-", $source);
	$myDate = sprintf("%d", $myDateArray[2]);
	return $myDate;
}

function displayShortMonth($source) {
	$myDateArray = explode("-", $source);
	if ($_SESSION['LANG'] == 'TH') {
		$myMonth = returnThaiShortMonth($myDateArray[1]);
	} else {
		switch($myDateArray[1]) {
			case "01" :
				$myMonth = "Jan";
				break;
			case "02" :
				$myMonth = "Feb";
				break;
			case "03" :
				$myMonth = "Mar";
				break;
			case "04" :
				$myMonth = "Apr";
				break;
			case "05" :
				$myMonth = "May";
				break;
			case "06" :
				$myMonth = "Jun";
				break;
			case "07" :
				$myMonth = "Jul";
				break;
			case "08" :
				$myMonth = "Aug";
				break;
			case "09" :
				$myMonth = "Sep";
				break;
			case "10" :
				$myMonth = "Oct";
				break;
			case "11" :
				$myMonth = "Nov";
				break;
			case "12" :
				$myMonth = "Dec";
				break;
		}
	}
	return $myMonth;
}

function frontend_mdn_upload_image_edit($name, $picTypeId, $museumId) {
	global $conn;

	$str = "";

	$str .= "<div class='uploadImageZone'>";
	$str .= '<input  style="display:none" class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box box-input-text cf mT">' . "\n\t";

	$sql = "SELECT * FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $museumId . " AND IMG_TYPE =" . $picTypeId . "   ORDER BY ORDER_DATA ASC";

	$query = mysql_query($sql, $conn);

	$num = mysql_num_rows($query);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div id="img_edit_' . $row['PIC_ID'] . '" data-id="' . $row['PIC_ID'] . '" class="box-tumb museumbox-thumb">' . "\n\t";

		$str .= '<div class="box-pic">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' . $row['IMG_PATH'] . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace("../../", "",str_replace_last('/', '/thumbnail/', $row['IMG_PATH'])) . '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";

		$str .= '<a class="btn-delete" onclick="delImageEdit(\'' . $row['PIC_ID'] . '\' , \'' . str_replace("../../", "",$row['IMG_PATH'] ). '\'); return false;" href="#">' . "\n\t";

		$str .= '</a>' . "\n\t";

		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($num > 0) {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}
	$str .= "</div>";
	return $str;
}

function frontend_move_image_upload_dir($dir, $file, $width, $height, $crop, $thumbwidth, $thumbheight) {
	$path1 = 'upload';
	$path2 = $path1 . '/' . $dir;
	$path3 = $path2 . '/' . date("Y_m") . '/';
	$path4 = $path3 . '/thumbnail/';
	$old_path1 = 'assets/plugin/upload/php/files/';

	if (!is_dir($path1)) { mkdir($path1, 0777);
	} else { chmod($path1, 0777);
	}
	if (!is_dir($path2)) { mkdir($path2, 0777);
	} else { chmod($path2, 0777);
	}
	if (!is_dir($path3)) { mkdir($path3, 0777);
	} else { chmod($path3, 0777);
	}
	if (!is_dir($path4)) { mkdir($path4, 0777);
	} else { chmod($path4, 0777);
	}

	$output = time() . '_' . rand(111, 999) . '.' . getEXT($file);
	$original_path = $old_path1 . $file;
	$thumb_path = $old_path1 . 'thumbnail/' . $file;

	copy($original_path, $path3 . $output);
	copy($original_path, $path4 . $output);
	unlink($original_path);
	unlink($thumb_path);

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);
	chmod($path4, 0755);

	return '../../'.$path3 . $output;
}

function frontend_move_single_image_upload_dir($dir, $file) {
	$path1 = 'upload';
	$path2 = $path1 . '/' . $dir;
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

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);

	$target_file = $target_dir_museum . basename($file["name"]);
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$target_save_file = $path3 . time() . '_' . rand(111, 999) . '.' . $imageFileType;

	if (move_uploaded_file($file["tmp_name"], $target_save_file))
		return '../../'.$target_save_file;
	else
		return "";

}

function frontend_mdn_content_upload_image_edit($name, $conId, $catId) {
	global $conn;

	$str = "";

	$str .= "<div class='uploadImageZone'>";
	$str .= '<input  style="display:none" class="fileupload" type="file" data-name="' . $name . '" name="files[]" data-url="assets/plugin/upload/php/" accept="image/*" multiple>' . "\n\t";
	$str .= '<div id="progress_' . $name . '">' . "\n\t";
	$str .= '<div class="upload_bar dNone"></div>' . "\n\t";
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_Box image_Box box-input-text cf mT">' . "\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $conId . " AND IMG_TYPE = 1 AND CAT_ID = " . $catId . "   ORDER BY ORDER_ID ASC";

	$query = mysql_query($sql, $conn);

	$num = mysql_num_rows($query);
	while ($row = mysql_fetch_array($query)) {
		$str .= '<div id="img_edit_' . $row['PIC_ID'] . '" data-id="' . $row['PIC_ID'] . '" class="box-tumb museumbox-thumb">' . "\n\t";

		$str .= '<div class="box-pic">' . "\n\t";
		$str .= '<a onclick="popupImage(\'' .str_replace("../../", "", $row['IMG_PATH']) . '\'); return false;" href="#">' . "\n\t";
		$str .= '<img src="' . str_replace("../../", "",str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) ). '" alt="">' . "\n\t";
		$str .= '</a>' . "\n\t";
		$str .= '</div>' . "\n\t";

		$str .= '<a class="btn-delete" onclick="delImageEdit(\'' . $row['PIC_ID'] . '\' , \'' . str_replace("../../", "",$row['IMG_PATH']) . '\'); return false;" href="#">' . "\n\t";

		$str .= '</a>' . "\n\t";

		$str .= '</div>' . "\n\t";
	}
	$str .= '</div>' . "\n\t";
	$str .= '<div class="image_' . $name . '_data image_Data dNone">' . "\n\t";
	$str .= '</div>' . "\n\t";
	if ($num > 0) {
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="' . $name . '"></div>' . "\n\t";
	} else {
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="' . $name . '"></div>' . "\n\t";
	}
	$str .= "</div>";
	return $str;
}

function callMDNThumbListFrontEnd($mid, $genBgStyle) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_museum_profile_picture WHERE MUSEUM_ID = " . $mid . " AND IMG_TYPE = 8 ORDER BY ORDER_DATA ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($genBgStyle) {
			return str_replace('../../', '', $row['IMG_PATH']);
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', str_replace('../../', '', $row['IMG_PATH'])) . '\');"';
		}

	} else {
		if ($genBgStyle) {
			return 'images/logo_thumb.jpg';
		} else {
			return 'style="background-image: url(\'images/logo_thumb.jpg\');"';
		}
	}

}


function backend_move_single_image_upload_dir($dir, $file) {
	$path1 = '../../upload';
	$path2 = $path1 . '/' . $dir;
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

	chmod($path1, 0755);
	chmod($path2, 0755);
	chmod($path3, 0755);

	$target_file = $target_dir_museum . basename($file["name"]);
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$target_save_file = $path3 . time() . '_' . rand(111, 999) . '.' . $imageFileType;

	if (move_uploaded_file($file["tmp_name"], $target_save_file))
		return $target_save_file;
	else
		return "";

}

function callHeroBannerThumbListByID($picID,$staus) {
	global $conn;

	$sql = "SELECT IMG_PATH FROM trn_hero_banner WHERE PIC_ID = ".$picID." AND IMG_TYPE = 1  ORDER BY ORDER_ID ASC LIMIT 0 , 1";
	$query = mysql_query($sql, $conn);
	$num = mysql_num_rows($query);
	if ($num == 1) {
		$row = mysql_fetch_array($query);
		if ($staus) {
			return $row['IMG_PATH'];
		} else {
			return 'style="background-image: url(\'' . str_replace_last('/', '/thumbnail/', $row['IMG_PATH']) . '\');"';
		}

	} else {
		if ($staus) {
			return '../images/logo_thumb.jpg';
		} else {
			return '';
		}
	}

}
?>