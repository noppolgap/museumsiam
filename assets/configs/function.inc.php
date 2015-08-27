<?php
function find_ip(){
	//ตรวจสอบ IP
	if ($_SERVER['REMOTE_ADDR']) { 
	 return $_SERVER['REMOTE_ADDR'];
	} elseif (ereg("[0-9]",$_SERVER["HTTP_X_FORWARDED_FOR"] )) { 
	 return $_SERVER["HTTP_X_FORWARDED_FOR"];
	} else { 
	 return $_SERVER["REMOTE_ADDR"];
	}
}
function checkDir($dir){
	if(!is_dir($dir)){
		mkdir($dir, 0777);
	}else{
		chmod($dir, 0777);
	}
}
function changedateformatlong($source){
	$date = new DateTime($source);
	return $date->format('j F Y H:i'); // 1 December 2012 13:30
}
function changedateformatshort($source){
	$date = new DateTime($source);
	return $date->format('j M Y H:i'); // 1 Dec 2012 13:30
}
function changedateformatdb($source){
	$date = new DateTime($source);
	return $date->format('Y-m-d H:i:s'); // 2013-02-20 13:30:59
}
function changedateformattimepicker($source){
	$date = new DateTime($source);
	return $date->format('d m Y H:i'); // 31 02 2012 13:30
}
function getEXT($file){
	return strtolower(end(explode('.', $file)));
}
function ShowDateEn($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "Jan";  break;
			case "02" : $myMonth = "Feb";  break;
			case "03" : $myMonth = "Mar"; break;
			case "04" : $myMonth = "Apr"; break;
			case "05" : $myMonth = "May";   break;
			case "06" : $myMonth = "Jun";  break;
			case "07" : $myMonth = "Jul";   break;
			case "08" : $myMonth = "Aug";  break;
			case "09" : $myMonth = "Sep";  break;
			case "10" : $myMonth = "Oct";  break;
			case "11" : $myMonth = "Nov";   break;
			case "12" : $myMonth = "Dec";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0]);
        return($myDay . " " . $myMonth . " " . substr($myYear,2,2));
}
function ShowDateShort($myDate) {
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = (sprintf("%d",$myDateArray[0])+543) - 2500;
        return($myDay . " " . $myMonth . " " . $myYear);
}
function ShowMonthYear($myDate) {
		$myDateArray=explode("-",$myDate);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "มกราคม";  break;
			case "02" : $myMonth = "กุมภาพันธ์";  break;
			case "03" : $myMonth = "มีนาคม"; break;
			case "04" : $myMonth = "เมษายน"; break;
			case "05" : $myMonth = "พฤษภาคม";   break;
			case "06" : $myMonth = "มิถุนายน";  break;
			case "07" : $myMonth = "กรกฎาคม";   break;
			case "08" : $myMonth = "สิงหาคม";  break;
			case "09" : $myMonth = "กันยายน";  break;
			case "10" : $myMonth = "ตุลาคม";  break;
			case "11" : $myMonth = "พฤษจิกายน";   break;
			case "12" : $myMonth = "ธันวาคม";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
        return($myMonth . " " . $myYear);
}
function ConvertDate($str){
	return date("d M Y", strtotime(trim($str)));
}
function ConvertDateToDB($str){
	return date("Y-m-d H:i:s", strtotime(trim($str)));
}
function logs_access($user,$msg) {
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

	chmod($FilePath,0744);
	chmod($dirPath,0744);
	chmod(_LOG_PATH_,0744);
	*/
}
function admin_move_image_upload_dir($dir,$file,$width,$height,$crop,$thumbwidth,$thumbheight){
		$path1 = '../../upload';
		$path2 = $path1.'/'.$dir;
		$path3 = $path2.'/'.date("Y_m").'/';
		$path4 = $path3.'/thumbnail/';
		$old_path1 = '../../assets/plugin/upload/php/files/';
		
		if(!is_dir($path1)) { mkdir($path1,0777); }else{ chmod($path1,0777); }
		if(!is_dir($path2)) { mkdir($path2,0777); }else{ chmod($path2,0777); }
		if(!is_dir($path3)) { mkdir($path3,0777); }else{ chmod($path3,0777); }
		if(!is_dir($path4)) { mkdir($path4,0777); }else{ chmod($path4,0777); }

		//include('../../assets/class/abeautifulsite/SimpleImage.php');
		//$img = new abeautifulsite\SimpleImage();
		
		$output = time().'_'.rand(111, 999).'.'.getEXT($file);
		$original_path = $old_path1.$file;
		$thumb_path = $old_path1.'thumbnail/'.$file;

		copy($original_path,$path3.$output);
		copy($original_path,$path4.$output);
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

		chmod($path1,0744);
		chmod($path2,0744);
		chmod($path3,0744);
		chmod($path4,0744);	

		return $path3.$output;
}
function admin_upload_image($name){
	$str = "";
	$str .= '<input class="fileupload" type="file" data-name="'.$name.'" name="files[]" data-url="../../assets/plugin/upload/php/" multiple>'."\n\t";
	$str .= '<div id="progress">'."\n\t";
	$str .= '<div class="upload_bar dNone"></div>'."\n\t";
	$str .= '</div>'."\n\t";
	$str .= '<div class="image_'.$name.'_Box image_Box dNone image_Box_add"></div>'."\n\t";
	$str .= '<div class="image_'.$name.'_data image_Data dNone"></div>'."\n\t";	
	$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="'.$name.'"></div>'."\n\t";
	return $str;
}
function admin_upload_image_edit($name,$type,$id){
	global $conn;

	$str = "";
	$str .= '<input class="fileupload" type="file" data-name="'.$name.'" name="files[]" data-url="../../assets/plugin/upload/php/" multiple>'."\n\t";
	$str .= '<div id="progress">'."\n\t";
	$str .= '<div class="upload_bar dNone"></div>'."\n\t";
	$str .= '</div>'."\n\t";
	$str .= '<div class="image_'.$name.'_Box image_Box">'."\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$id." AND CAT_ID =".$type." ORDER BY ORDER_ID ASC";
	$query = mysql_query($sql,$conn);
	$num = mysql_num_rows($query);
	while($row = mysql_fetch_array($query)) {
		$str .= '<div id="img_edit_'.$row['PIC_ID'].'" data-id="'.$row['PIC_ID'].'" class="thumbBoxEdit floatL p-Relative">'."\n\t";
		$str .= '<div class="thumbBoxImage">'."\n\t";
		$str .= '<a onclick="popupImage(\''.$row['IMG_PATH'].'\'); return false;" href="#">'."\n\t";
		$str .= '<img src="'.str_replace_last('/','/thumbnail/',$row['IMG_PATH']).'" alt="">'."\n\t";
		$str .= '</a>'."\n\t";
		$str .= '</div>'."\n\t";
		$str .= '<div class="thumbBoxAction dNone p-Absolute">'."\n\t";
		$str .= '<a onclick="delImageEdit(\''.$row['PIC_ID'].'\' , \''.$row['IMG_PATH'].'\'); return false;" href="#">'."\n\t";
		$str .= '<img src="../images/small-n-flat/sign-ban.svg" alt="">'."\n\t";
		$str .= '</a>'."\n\t";
		$str .= '</div>'."\n\t";
		$str .= '</div>'."\n\t";
	}
	$str .= '</div>'."\n\t";
	$str .= '<div class="image_'.$name.'_data image_Data dNone">'."\n\t";
	$str .= '</div>'."\n\t";
	if($num > 0){
		$str .= '<div class="p-Absolute OrderImageBtn" data-name="'.$name.'"></div>'."\n\t";
	}else{
		$str .= '<div class="p-Absolute OrderImageBtn dNone" data-name="'.$name.'"></div>'."\n\t";
	}	
	return $str;
}
function admin_upload_image_view($name,$type,$id){
	global $conn;

	$str = "";
	$str .= '<div class="image_'.$name.'_Box image_Box">'."\n\t";

	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$id." AND CAT_ID =".$type;
	$query = mysql_query($sql,$conn);
	while($row = mysql_fetch_array($query)) {
		$str .= '<div class="thumbBoxEdit floatL p-Relative">'."\n\t";
		$str .= '<div class="thumbBoxImage">'."\n\t";
		$str .= '<a onclick="popupImage(\''.$row['IMG_PATH'].'\'); return false;" href="#">'."\n\t";
		$str .= '<img src="'.str_replace_last('/','/thumbnail/',$row['IMG_PATH']).'" alt="">'."\n\t";
		$str .= '</a>'."\n\t";
		$str .= '</div>'."\n\t";
		$str .= '</div>'."\n\t";
	}
	$str .= '</div>'."\n\t";
	$str .= '<div class="image_'.$name.'_data image_Data">'."\n\t";
	$str .= '</div>'."\n\t";
	return $str;
}
function str_replace_last( $search, $replace, $subject ) {
    if ( !$search || !$replace || !$subject )
        return false;
    
    $index = strrpos( $subject, $search );
    if ( $index === false )
        return $subject;
    
    $pre = substr( $subject, 0, $index );
    
    $post = substr( $subject, $index );
    
    $post = str_replace( $search, $replace, $post );
    
    return $pre . $post;
}
?>