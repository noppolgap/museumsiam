<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");

$MID = intval($_GET['MID']);
$CID = intval($_GET['CID']);
$CONID = intval($_GET['CONID']);

$SCID = "-1";
if (isset($_GET['SCID']))
	$SCID = intval($_GET['SCID']);

$currentPage = 1;
if (isset($_GET['PG']))
	$currentPage = intval($_GET['PG']);

if ($currentPage < 1)
	$currentPage = 1;

$catName = "";

if (isset($_SESSION['KM_PREV_PG'])) {
	$backPage = $_SESSION['KM_PREV_PG'];
} else {
	$backPage = "km.php?MID=" . $km_module_id;
	/*$backPage = "all-content.php?MID=".$MID."&CID=".$CID;
	 if (isset($_GET['SCID'])) {
	 $backPage.= "$SCID=".$SCID ;
	 }
	 $backPage.'&PG='.$currentPage ; */
}
$sqlCategory = "";
if (isset($_GET['SCID'])) {
	$sqlCategory = "select SUB_CONTENT_CAT_ID ,
											CONTENT_CAT_ID ,
											SUB_CONTENT_CAT_DESC_LOC ,
											SUB_CONTENT_CAT_DESC_ENG
											from trn_content_sub_category where SUB_CONTENT_CAT_ID = $SCID ";
	$rsCat = mysql_query($sqlCategory) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) {
		$catName = $rowCat['SUB_CONTENT_CAT_DESC_LOC'];
	}
} else {
	$sqlCategory = "select CONTENT_CAT_ID ,
											CONTENT_CAT_DESC_LOC ,
											CONTENT_CAT_DESC_ENG from trn_content_category where CONTENT_CAT_ID	= $CID ";
	$rsCat = mysql_query($sqlCategory) or die(mysql_error());
	while ($rowCat = mysql_fetch_array($rsCat)) {
		$catName = $rowCat['CONTENT_CAT_DESC_LOC'];
	}
}

if ($_SESSION['LANG'] == 'TH') {
	$LANG_SQL = "CONTENT_DESC_LOC AS CONTENT_LOC ,CONTENT_DETAIL_LOC AS CONTENT_DETAIL,BRIEF_LOC AS CONTENT_BRIEF,PLACE_DESC_LOC as PLACE_DESC , ";
} else if ($_SESSION['LANG'] == 'EN') {
	$LANG_SQL = "CONTENT_DESC_ENG AS CONTENT_LOC ,CONTENT_DETAIL_ENG AS CONTENT_DETAIL,BRIEF_ENG AS CONTENT_BRIEF,PLACE_DESC_ENG as PLACE_DESC , ";
}

$contentSql = "SELECT
				CONTENT_ID,
				CAT_ID,
				" . $LANG_SQL . "
				CREATE_DATE,
				LAST_UPDATE_DATE,
				IFNULL(LAST_UPDATE_DATE , CREATE_DATE) as LAST_DATE ,
				EVENT_START_DATE,
				EVENT_END_DATE
				FROM
				trn_content_detail
				WHERE
				CONTENT_ID = $CONID";

//	echo $contentSql;
$rsContent = mysql_query($contentSql) or die(mysql_error());
$rowContent = mysql_fetch_array($rsContent);

$title = trim(htmlspecialchars($rowContent['CONTENT_LOC']));
$detail = trim($rowContent['CONTENT_DETAIL']);
$brief = trim(preg_replace('/\s\s+/', ' ', strip_tags(htmlspecialchars($rowContent['CONTENT_BRIEF']))));

//meta site
$sql_thumb_meta = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = " . $CONID . " AND IMG_TYPE = '1' AND CAT_ID = " . $CID . " ORDER BY ORDER_ID ASC LIMIT 0 , 1";
$query_thumb_meta = mysql_query($sql_thumb_meta, $conn);
$row_thumb_meta = mysql_fetch_array($query_thumb_meta);
$thumb_meta = trim(str_replace("../../", "", $row_thumb_meta['IMG_PATH']));

/* not work
 $page_title = $title;
 $page_description = $brief;
 */
$page_image = _FULL_SITE_PATH_ . '/' . $thumb_meta;

unset($sql_thumb_meta);
unset($query_thumb_meta);
unset($row_thumb_meta);
unset($thumb_meta);
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/ve.css" />

<script src="js/ve-detail.js"></script>
<script src="js/breakMedia.js"></script>

</head>

<body id="km">

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="ve.php">ระบบจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="ve-category.php">หมวดหมู่นิทรรศการ</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">ชื่อนิทรรศการ</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-ve.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1><?=$catName ?></h1>
			</div>
			<div class="box-newsdetail-main">
				<div class="box-slide-big">
					<div id="sync1" class="owl-carousel">
					<?php
						$audioPlayer = false;
						$thumbRender = "\n\n\t";
						$extraStyle = "";
						$getPicSql = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$CONID." AND CAT_ID = ".$CID." AND ( DIV_NAME !=  'Other' OR DIV_NAME IS NULL ) ORDER BY DIV_NAME ASC , ORDER_ID ASC";

						$rsPic = mysql_query($getPicSql) or die(mysql_error());
						$rowPicturecount = mysql_num_rows($rsPic);
						if ($rowPicturecount == 1) {
							$extraStyle = " style='display:none;'";
						}
						while ($rowPic = mysql_fetch_array($rsPic)) {
							echo '	<div class="slide-content"> '."\n\t\t";
							$thumbRender .= '<div class="slide-content">'."\n\t\t";
							if($rowPic['DIV_NAME'] == 'voice'){
								$audioPlayer = true;
								$ext = getEXT($rowPic['IMG_PATH']);
								$path = $rowPic['IMG_PATH'];
								if($rowPic['IMG_TYPE'] == 2){
									$path = str_replace("../../","",$path);
								}
							?>
								<div id="jquery_jplayer_<?=$rowPic['PIC_ID'] ?>" class="cp-jplayer" data-type="sound"></div>

								<div id="cp_container_<?=$rowPic['PIC_ID'] ?>" class="cp-container">
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
										<li><a class="cp-play" tabindex="<?=$rowPic['PIC_ID'] ?>">play</a></li>
										<li><a class="cp-pause" style="display:none;" tabindex="<?=$rowPic['PIC_ID'] ?>">pause</a></li>
									</ul>
								</div>
							<?
							$thumbRender .= '<img src="images/tumb-sound.jpg">' . "\n\t";
							}else if($rowPic['DIV_NAME'] == 'video'){

							if($rowPic['IMG_TYPE'] == 3){
							echo '<iframe data-type="embed" width="754" height="460" src="https://www.youtube.com/embed/'.$rowPic['IMG_PATH'].'?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>'."\n\t";
							$thumbRender .= '<img src="http://img.youtube.com/vi/'.$rowPic['IMG_PATH'].'/maxresdefault.jpg">'."\n\t";
							}else{
							$ext = getEXT($rowPic['IMG_PATH']);
							$path = $rowPic['IMG_PATH'];
							if($rowPic['IMG_TYPE'] == 2){
							$path = str_replace("../../","",$path);
							}
							echo '<video width="754" height="460" controls data-type="video">'."\n\t";
							echo '<source src="'.$path.'" type="video/'.$ext.'">'."\n\t";
							echo '</video>'."\n\t";
							$thumbRender .= '<img src="images/tumb-vdo.jpg">'."\n\t";
							}

							}else{
							echo '<img class="img-slide-show" data-type="image" style="max-width:754px;max-height: 562px" src="' . callThumbListFrontEndByID($rowPic['PIC_ID'], $rowPic['CAT_ID'], true) . '">'."\n\t";
							$thumbRender .= '<img src="' . callThumbListFrontEndByID($rowPic['PIC_ID'], $rowPic['CAT_ID'], true) . '">'."\n\t";
							}
							echo '</div>'."\n\t";
							$thumbRender .= '</div>'."\n\t";
							}
					?>
					</div>
					<a class="btn-arrow-slide pev"></a>
					<a class="btn-arrow-slide next"></a>
					<div class="box-title-main">
						<div class="box-text">
							<p class="text-title"><?=$title ?></p>
							<p class="text-des"><?=nvl($rowContent['PLACE_DESC'], "");?></p>
						</div>
					</div>
				</div>
				<div class="box-social-main cf">
				<?php
				$path = '&CONID=detail.php?MID=' . $MID . '%26CID=' . $CID . '%26CONID=' . $CONID;
				$fullpath = _FULL_SITE_PATH_ . '/' . $path;
				$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $CONID;
				$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
				$gp_link = 'https://plus.google.com/share?url=' . $fullpath;
				$tw_link = $fullpath;
				$line = 'http://line.me/R/msg/text/?' . $title . '%0D%0A' . $fullpath;
				?>
					<a href="<?=$fb_link ?>" onclick="shareFB('<?=$title ?>',$(this).attr('href')); return false;" class="btn fb"></a>
					<a href="<?=str_replace("%26", "&amp;", $fullpath) ?>" onclick="shareTW(<?=$CONID ?>,'<?=$title ?>',$(this).attr('href')); return false;" class="btn tw"></a>
					<a href="<?=$gp_link ?>" onclick="sharegp('<?=$title ?>',$(this).attr('href')); return false;" class="btn g"></a>
					<a href="<?=$line ?>" target="_blank" class="btn line"></a>
				</div>
				<div class="part-tumb-main">
					<div  class="text-title cf">
						<p>แกลเลอรี</p>
						<div class="box-btn">
							<a target="_blank" href="all-media.php?CID=<? echo $CID ?>&CONID=<? echo $CONID ?>" class="btn black">ดูทั้งหมด</a>
						</div>
					</div>
					<div class="box-slide-small">
						<div id="sync2" class="owl-carousel">
							<?=$thumbRender ?>
						</div>
					</div>
				</div>
				<div class="box-news-text">
					<?=$detail ?>
				</div>
<?php
	$SqlFile = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$CONID." AND CAT_ID = ".$CID." AND DIV_NAME =  'Other' ORDER BY ORDER_ID ASC";
	$QueryFile = mysql_query($SqlFile) or die(mysql_error());
	$numFile = mysql_num_rows($QueryFile);
	if($numFile > 0){
?>
				<div class="box-otherfile-main">
					<div class="box-title cf">
						<h2>ไฟล์อื่นๆที่เกี่ยวข้อง</h2>
					</div>
					<div class="box-news-main gray">
					<?php
						while ($rowFile = mysql_fetch_array($QueryFile)) {
							$file = str_replace("../../","",$rowFile['IMG_PATH']);
							if((file_exists($file)) OR ($rowFile['IMG_TYPE'] == 4)){
								$ext = getEXT($file);

								if(file_exists($file)){
									$size = formatSizeUnits(filesize($file));
									$link = 'download.php?p='.$rowFile['PIC_ID'];
								}else{
									$size = 'Unknow';
									$link = $rowFile['IMG_PATH'];
								}
					?>
						<div class="box-notice iconFile <?=returnFileType($ext) ?>">
							<div class="box-text">
								<p class="text-title"><?=$rowFile['IMG_NAME'] ?></p>
								<p class="text-detail">
									<span>ประเภท: .<?=$ext ?></span>
									<span>ขนาด: <?=$size ?></span>
								</p>
							</div>
							<div class="box-btn cf">
								<a href="<?=$link ?>" target="_blank" class="btn red">ดาวน์โหลด</a>
							</div>
						</div>
					<?php } } ?>
					</div>
				</div>
<?php } ?>
				<div class="box-footer-content cf">
					<div class="box-date-modified">
						วันที่แก้ไขล่าสุด :  <?= ConvertDate($rowContent['LAST_DATE']) ?>
					</div>
					<div class="box-plugin-social">
						<div class="fb-share-button" data-href="<?=$path ?>" data-layout="button_count"></div>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=$fullpath ?>">Tweet</a>
						<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?=$fullpath ?>"></div>
						<span>
						<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
						<script type="text/javascript">
													new media_line_me.LineButton({"pc":false,"lang":"en","type":"a","text":"<?=$path ?>","withUrl":true});
						</script>
						</span>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php
include ('inc/inc-footer.php');
include ('inc/inc-social-network.php');
?>
<? if($audioPlayer){ ?>
<link rel="stylesheet" href="assets/plugin/circle-player/skin/circle.player.css">
<script type="text/javascript" src="assets/plugin/jplayer/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/jquery.transform2d.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/jquery.grab.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/mod.csstransforms.min.js"></script>
<script type="text/javascript" src="assets/plugin/circle-player/js/circle.player.js"></script>
<script type="text/javascript" src="audiolist.php?NAME=voice&amp;CID=<?=$CID ?>&amp;CONID=<?=$CONID ?>"></script>
<? } ?>
</body>
</html>
<? CloseDB(); ?>