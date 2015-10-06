<?php
if(isset($_GET['Embed'])){
	$MyiFrame = '<iframe width="640" height="390" src="https://www.youtube.com/embed/'.$_GET['p'].'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
}else if(isset($_GET['Link'])){
	$file = $_GET['p'];
	$ext = end(explode(".",basename($file)));
	$uploadfile = $_GET['p'];
}else{
	$file = $_GET['p'];
	$ext = end(explode(".",basename($file)));
	$uploadfile = '../../temp/'.$file;

	if(!file_exists($uploadfile)){
		$uploadfile = $file;
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
}else{ ?>
<video width="640" height="390" autoplay>
  <source src="<?=$uploadfile?>" type="video/<?=$ext?>">
	Your browser does not support the video tag.
</video>
<? } ?>
</body>
</html>
