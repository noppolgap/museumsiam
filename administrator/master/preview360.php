<?php
if(isset($_GET['page'])){
	require ("../../assets/configs/config.inc.php");
	require ("../../assets/configs/connectdb.inc.php");
	require ("../../assets/configs/function.inc.php");
}else{
	$index = 0;
	$patten = $_GET['box'];
	$check = true;
	$files = glob("../../assets/plugin/upload/three_hundred_and_sixty/files/".$patten."*");

	foreach ($files as $filename) {
		if($check){
            $extension = pathinfo($filename , PATHINFO_EXTENSION);
        }

	    $index++;
	}
    if ( $extension != "" ){
         $extension = "." . $extension;
    }
	$path = "../../assets/plugin/upload/three_hundred_and_sixty/files/";
}
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>
</head>

<body>
<section id="container">
<div class="threesixty preview">
    <div class="spinner">
        <span>0%</span>
    </div>
    <ol class="threesixty_images"></ol>
</div>
</section>
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="../../assets/plugin/threesixty/threesixty.css" media="all" />
<style>
#container {
	margin-top: 20px;
}
</style>
<script type="text/javascript" src="../../assets/plugin/threesixty/threesixty.min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>
<script>
window.onload = init;

var preview;
function init(){

    preview = $('.preview').ThreeSixty({
        totalFrames: <?=$index?>,
        endFrame: <?=$index?>,
        currentFrame: 1,
        imgList: '.threesixty_images',
        progress: '.spinner',
        imagePath:'<?=$path?>',
        filePrefix: '<?=$patten?>_',
        ext: '<?=$extension?>',
        height: 650,
        width: 650,
        navigation: true
    });

}
</script>
</body>
</html>
