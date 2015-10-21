<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

$CID = intval($_GET['CID']);
$CONID = intval($_GET['CONID']);

$contentSql = "SELECT ";
if ($_SESSION['LANG'] == 'TH')
	$contentSql .= "CONTENT_DESC_LOC as CONTENT_DESC";
else
	$contentSql .= "CONTENT_DESC_ENG as CONTENT_DESC";
$contentSql .= " FROM trn_content_detail WHERE CONTENT_ID =  " . $CONID;
$rsContent = mysql_query($contentSql) or die(mysql_error());
$rowContent = mysql_fetch_array($rsContent);

$title = $rowContent['CONTENT_DESC'];

    $sql = "SELECT IMG_PATH , IMG_NAME FROM trn_content_picture WHERE CONTENT_ID = ".$CONID." AND IMG_TYPE =  '5' AND CAT_ID = ".$CID." ORDER BY ORDER_ID ASC";
    $query = mysql_query($sql, $conn) or die($sql);
    $index = mysql_num_rows($query);


    $row = mysql_fetch_array($query);
    $patten = $row['IMG_NAME'];

    list( $dirname, $basename, $extension, $filename ) = array_values( pathinfo($row['IMG_PATH']) );

    if ( $extension != "" ){
         $extension = "." . $extension;
    }
    $path = str_replace("../../","",$dirname).'/';


?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/view360.css" />
<script>
	function closeWin(){
		window.close();
	}
</script>

</head>

<body>

<div class="box-top">
	<div class="container">
		<div class="box-title-main cf">
			<div class="box-left">
				<img src="images/th/title-360.png"/>
			</div>
			<div class="box-right">
				<div class="box-btn cf">
					<a class="btn red"  onclick="closeWin(); return false;">ปิด</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="box-bottom">
	<div class="box-content-360">
		<div class="box-title"><?=$title?></div>
		<div class="box-plugin-360">
			<section id="container">
			<div class="threesixty preview">
			    <div class="spinner">
			        <span>0%</span>
			    </div>
			    <ol class="threesixty_images"></ol>
			</div>
			</section>
		</div>
		<div class="box-des">
			<img src="images/icon-hand.png" />กรุณาเลื่อนรูปภาพเพื่อรับชมภาพ 360&deg;
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="assets/plugin/threesixty/threesixty.css" media="all" />
<script type="text/javascript" src="assets/plugin/threesixty/threesixty.min.js"></script>
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
        height: 592,
        width: 592,
        navigation: false
    });

}
</script>
</body>
</html>
<? CloseDB(); ?>
