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
function logs_access($user,$msg) {
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
}
?>