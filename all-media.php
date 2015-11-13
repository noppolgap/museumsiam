<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

$CID = intval($_GET['CID']);
$CONID = intval($_GET['CONID']);

echo	$sql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$CONID." AND CAT_ID = ".$CID." AND ( DIV_NAME !=  'Other' OR DIV_NAME IS NULL ) AND IMG_TYPE != 5 ORDER BY DIV_NAME ASC , ORDER_ID ASC";
    $query = mysql_query($sql, $conn) or die($sql);
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/all-media.css" />

<script>
	function closeWin(){
		window.close();
	}
</script>


</head>

<body>

	<div class="container">
<?php
	$audioPlayer = false;
    while($row = mysql_fetch_array($query)){
		echo '<div class="box-row-content">';
		if($row['DIV_NAME'] == 'voice'){
			$audioPlayer = true;
			$ext = getEXT($row['IMG_PATH']);
			$path = $row['IMG_PATH'];
			if($row['IMG_TYPE'] == 2){
				$path = str_replace("../../","",$path);
			}
?>
			<div id="jquery_jplayer_<?=$row['PIC_ID']?>" class="cp-jplayer"></div>

			<div id="cp_container_<?=$row['PIC_ID']?>" class="cp-container">
				<div class="cp-buffer-holder">
					<div class="cp-buffer-1"></div>
					<div class="cp-buffer-2"></div>
				</div>
			<div class="cp-progress-holder">
				<div class="cp-progress-1"></div>
				<div class="cp-progress-2"></div>
			</div>
			<div class="cp-circle-control"></div>
				<ul class="cp-controls">
					<li><a class="cp-play" tabindex="<?=$row['PIC_ID']?>">play</a></li>
					<li><a class="cp-pause" style="display:none;" tabindex="<?=$row['PIC_ID']?>">pause</a></li>
				</ul>
			</div>
<?php
		}else if($row['DIV_NAME'] == 'video'){
			if($row['IMG_TYPE'] == 3){
				echo '<iframe width="754" height="460" src="https://www.youtube.com/embed/'.$row['IMG_PATH'].'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>'."\n\t";
			}else{
				$ext = getEXT($row['IMG_PATH']);
				$path = $row['IMG_PATH'];
				if($row['IMG_TYPE'] == 2){
					$path = str_replace("../../","",$path);
				}
				echo '<video width="754" height="460" controls>'."\n\t";
				echo '<source src="'.$path.'" type="video/'.$ext.'">'."\n\t";
				echo '</video>'."\n\t";
			}
		}else{
			$path = $row['IMG_PATH'];
			if($row['IMG_TYPE'] == 1){
				$path = str_replace("../../","",$path);
			}
			echo '<img src="' . $path . '">'."\n\t";
		}
		echo '</div>';
	}
?>
	</div>
	<div class="box-btn cf">
		<a class="btn black" onclick="closeWin(); return false;">ปิด</a>
	</div>
	<a class="btn-top" style="display: block;"></a>
<? if($audioPlayer){ ?>
<link rel="stylesheet" href="assets/plugin/circle-player/skin/circle.player.css">
<script type="text/javascript" src="assets/plugin/jplayer/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/jquery.transform2d.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/jquery.grab.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/mod.csstransforms.min.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/circle.player.js"></script>
<script type="text/javascript" src="audiolist.php?NAME=voice&amp;CID=<?=$CID?>&amp;CONID=<?=$CONID?>"></script>
<? } ?>
</body>
</html>
<? CloseDB(); ?>
