<?php
if(isset($_GET['Embed'])){
	$MyiFrame = '<iframe width="640" height="390" src="https://www.youtube.com/embed/'.$_GET['p'].'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
}else if(isset($_GET['Link'])){
	$file = $_GET['p'];
	$ext = end(explode(".",basename($file)));
	$uploadfile = $_GET['p'];
}else{
	require ("../../assets/configs/function.inc.php");
	$file = $_GET['p'];
	$ext = end(explode(".",basename($file)));
	$uploadfile = '../../temp/'.$file;

	if(!file_exists($uploadfile)){
		$uploadfile = $file;
	}

	switch ($ext) {
		case "mp4":
		case "webm":
		case "ogv":
					$type_preview = 'video'; break;
		case "mp3":
		case "wav":
		case "ogg":
					$type_preview = 'sound'; break;
		default   : $type_preview = 'file';  break;
	}
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
<? if(isset($MyiFrame)){
	echo $MyiFrame;
}else{
	if($type_preview == 'video'){
?>
<video width="640" height="390" autoplay>
  <source src="<?=$uploadfile?>" type="video/<?=$ext?>">
	Your browser does not support the video tag.
</video>
<? }else if($type_preview == 'sound'){ ?>
<audio controls autoplay preload="auto">
  <source src="<?=$uploadfile?>" type="audio/<?=$ext?>">
  Your browser does not support the audio tag.
</audio>
<style type="text/css">
audio{
	margin: 200px 80px 0px;
	width: 480px;
}
</style>
<?
   }else{

?>
<div class="circleBase">
	<a href="<?=$uploadfile?>" target="_blank" style="background-image: url('<?=returnUploadFileExtensions($uploadfile);?>');">Download here</a>
</div>
<style type="text/css">
.circleBase {
    border-radius: 50%;
    width: 320px;
    height: 320px;
    background: #f0f0f0;
    border: 30px solid #aaa;
    margin: 20px auto 0px;
}
.circleBase a{
	text-indent: -9000px;
	width: 200px;
	height: 200px;
	background-size: 90% auto;
	background-repeat: no-repeat;
	background-position: center;
	display: block;
	margin: 60px;
}
</style>
<?
   }
}
?>
</body>
</html>
