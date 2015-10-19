<?
$uploaddir = '../../temp';
chmod($uploaddir, 0777);

$original = explode(".",basename($_FILES['my_files']['name']));
$ext = strtolower(end($original));
$name = time().'_'.rand('1111','9999').'.'.$ext;
$uploadfile = $uploaddir.'/'.$name;

if($original[0] == ''){
	$original[0] = 'untitle';
}

	if(move_uploaded_file($_FILES["my_files"]["tmp_name"],$uploadfile)){
		$staus = "parent.videoCallBack('".$_POST['my_name']."','".$name."','".str_replace(" ","_",$original[0])."');";
	} else {
		$staus = "parent.videoAlert('".$_POST['my_name']."','".str_replace(" ","_",$original[0])."');";
	}

chmod($uploaddir, 0755);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
</head>

<body onload="<?=$staus?>">
</body>
</html>