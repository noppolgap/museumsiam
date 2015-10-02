<?
$uploaddir = '../../temp';
chmod($uploaddir, 0777);

$ext = strtolower(end(explode(".",basename($_FILES['my_files']['name']))));
$name = time().'_'.rand('1111','9999').'.'.$ext;
$uploadfile = $uploaddir.'/'.$name;

	if(move_uploaded_file($_FILES["my_files"]["tmp_name"],$uploadfile)){
		$staus = "parent.videoCallBack('".$_POST['my_name']."','".$name."');";
	} else {
		$staus = "parent.videoAlert('".$_POST['my_name']."');";
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