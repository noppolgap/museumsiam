<?php
$file = $_GET['p'];
$ext = end(explode(".",basename($file)));
$uploadfile = '../../temp/'.$file;

if(isset($_GET['pop'])){
	$script = "window.close(); window.opener.delPhoto('".$file."');";
}else{
	$script = "parent.$.colorbox.close(); parent.delPhoto('".$file."');";
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Video Preview</title>
<link rel="stylesheet" type="text/css" href="../../assets/plugin/cssreset-min.css" media="all" />
</head>

<body>
<video width="640" height="390" autoplay>
  <source src="<?=$uploadfile?>" type="video/<?=$ext?>">
	Your browser does not support the video tag.
</video>
<a style="display:block; text-align: center; padding: 5px;" href="#" onclick="DeleteMyVideo(); return false;">Delete Video</a>
<script>
function DeleteMyVideo(){
	if (confirm("คุณแน่ใจที่จะลบวีดีโอนี้นี้")){
		<?=$script?>
	}
}
</script>
</body>
</html>
