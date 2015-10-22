<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");


					$MID = intval($_GET['MID']);
					$CID = intval($_GET['CID']);
					$SID = intval($_GET['SID']);
					$NID = intval($_GET['CONID']);

?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script src="js/event-detail.js"></script>
<script src="js/breakMedia.js"></script>

</head>

<body>

<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php">กิจกรรมและข่าวสาร</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-event-museum.php">กิจกรรมและข่าวสารของมิวเซียมสยาม</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="news-museum.php">กิจกรรมของมิวเซียมสยาม</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>

				<?
				    $sql_title = " select CONTENT_DESC_LOC from trn_content_detail where CONTENT_ID = $NID";

					$query_title = mysql_query($sql_title, $conn);


					while($row_title = mysql_fetch_array($query_title)) {
				?>

					<li class="active"><? echo $row_title['CONTENT_DESC_LOC'] ?></li>

				<? } ?>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-newsevent.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1>กิจกรรมของมิวเซียมสยาม</h1>
				<div class="box-btn">
					<a href="event-museum.php" class="btn red">กลับไปกิจกรรมของมิวเซียมสยาม</a>
				</div>
			</div>

		<?


				$sql = " SELECT ";
				if ($_SESSION['LANG'] == 'TH'){
					$sql .= 'cat.CONTENT_CAT_DESC_LOC AS CONTENT_CAT_LOC , content.CONTENT_DESC_LOC AS CONTENT_LOC , content.CONTENT_DETAIL_LOC AS CONTENT_DETAIL , content.BRIEF_LOC AS CONTENT_BRIEF';
				}else if ($_SESSION['LANG'] == 'EN'){
					$sql .= 'cat.CONTENT_CAT_DESC_ENG AS CONTENT_CAT_LOC , content.CONTENT_DESC_ENG AS CONTENT_LOC , content.CONTENT_DETAIL_ENG AS CONTENT_DETAIL , content.BRIEF_ENG AS CONTENT_BRIEF';
				}
				 	$sql .= ",
						cat.CONTENT_CAT_ID,
						content.SUB_CAT_ID,
						content.CONTENT_ID,
						content.EVENT_START_DATE,
						content.EVENT_END_DATE,
						content.CREATE_DATE ,
						content.LAST_UPDATE_DATE ,
						content.USER_CREATE,
						content.PLACE_DESC_LOC,
						IFNULL(content.LAST_UPDATE_DATE , content.CREATE_DATE) as LAST_DATE
						FROM
							trn_content_category cat
						INNER JOIN trn_content_detail content ON content.CAT_ID = cat.CONTENT_CAT_ID
						WHERE
							cat.REF_MODULE_ID = $MID
						AND cat.flag = 0
						AND cat.CONTENT_CAT_ID = $CID
						AND content.SUB_CAT_ID = $SID
						AND content.APPROVE_FLAG = 'Y'
						AND content.CONTENT_STATUS_FLAG  = 0
						AND content.CONTENT_ID = $NID
						ORDER BY content.ORDER_DATA desc ";

			$query = mysql_query($sql, $conn);

			$num_rows = mysql_num_rows($query);
			$row = mysql_fetch_array($query);

			$date = ConvertBoxDate($row['EVENT_START_DATE']);

	   ?>

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
						<div class="box-date-tumb">
							<p class="date"><?=$date[0]?></p>
							<p class="month"><?=$date[1]?></p>
						</div>
						<div class="box-text">
							<p class="text-title"><? echo $row['CONTENT_DESC_LOC'] ?></p>
							<p class="text-des">By <? echo $row['USER_CREATE'] ?></p>
						</div>
					</div>
				</div>
				<div class="box-social-main cf">
				<?php

						$path = 'event-detail.php?MID='.$MID.'%26CID='.$CID.'%26SID='.$SID.'%26CONID='.$CONID;
						$fullpath = _FULL_SITE_PATH_.'/'.$path;
						$redirect_uri = _FULL_SITE_PATH_.'/callback.php?p='.$CONID;
						$fb_link = 'https://www.facebook.com/dialog/share?app_id='._FACEBOOK_ID_.'&display=popup&href='.$fullpath.'&redirect_uri='.$redirect_uri;
						$gp_link = 'https://plus.google.com/share?url='.$fullpath;
						$tw_link = $fullpath;
						$line = 'http://line.me/R/msg/text/?'.$title.'%0D%0A'.$fullpath;
				?>
					<a href="<?=$fb_link?>" onclick="shareFB('<?=$title?>',$(this).attr('href')); return false;" class="btn fb"></a>
					<a href="<?=str_replace("%26","&amp;",$fullpath)?>" onclick="shareTW(<?=$CONID?>,'<?=$title?>',$(this).attr('href')); return false;" class="btn tw"></a>
					<a href="<?=$gp_link?>" onclick="sharegp('<?=$title?>',$(this).attr('href')); return false;" class="btn g"></a>
					<a href="<?=$line?>" target="_blank" class="btn line"></a>
				</div>
				<div class="part-tumb-main">
					<div  class="text-title cf">
						<p>แกลเลอรี</p>
						<div class="box-btn">
							<a href="" class="btn black">ดูทั้งหมด</a>
						</div>
					</div>
					<div class="box-slide-small">
						<div id="sync2" class="owl-carousel">
							<?=$thumbRender?>
						</div>
					</div>
				</div>
				<div class="box-when">
					<h3>WHEN</h3>
					<p class="text-date"><? echo ConvertDate($row['EVENT_START_DATE']) ?> - <? echo ConvertDate($row['EVENT_END_DATE']) ?></p>
					<p class="text-time">10.30 น. - 18.00 น.</p>
					<p class="text-location"><? echo $row['PLACE_DESC_LOC'] ?></p>
				</div>
				<div class="box-ticket">
					<h3>TICKET</h3>
					<p class="text-ticket">Free with Museum Admission</p>
				</div>
				<div class="box-news-text">
					<p>
						<?=nl2br(strip_tags($row['CONTENT_DETAIL'], '<p><br>')); ?>
					</p>
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
						วันที่แก้ไขล่าสุด :  <? echo ConvertDate($row['LAST_UPDATE_DATE']) ?>
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

			<div class="part-btn-back">
				<div class="box-btn cf">
					<a href="event-museum.php" class="btn red">กลับไปกิจกรรมของมิวเซียมสยาม</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php
include('inc/inc-footer.php');
include('inc/inc-social-network.php');
?>
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