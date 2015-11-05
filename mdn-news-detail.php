<?php
require ("assets/configs/config.inc.php");
require ("assets/configs/connectdb.inc.php");
require ("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
	<head>
		<?
		require ('inc_meta.php');
		?>

		<link rel="stylesheet" type="text/css" href="css/template.css" />
		<link rel="stylesheet" type="text/css" href="css/mdn.css" />

		<script type="text/javascript" src="js/mdn-news-detail.js"></script>

	</head>

	<body id="km">

		<?php
		include ('inc/inc-top-bar.php');
		include ('inc/inc-menu.php');

		//CID=61&SCID=142&CONID=422&MDNID=1
		$CID = intval($_GET['CID']);
		$SCID = intval($_GET['SCID']);
		$CONID = intval($_GET['CONID']);
		$MDNID = intval($_GET['MDNID']);

		if ($_SESSION['LANG'] == 'TH') {
			$eventSelectedColumn = "cd.CONTENT_DESC_LOC as CONTENT_DESC ,cd.CONTENT_DETAIL_LOC as CONTENT_DETAIL_DESC ,cd.BRIEF_LOC as CONTENT_BRIEF,cd.PLACE_DESC_LOC as PLACE_DESC,cd.PRICE_RATE_LOC as PRICE_RATE, tmd.MUSEUM_NAME_LOC as MUSEUM_NAME ,";
		} else {
			$eventSelectedColumn = "cd.CONTENT_DESC_ENG as CONTENT_DESC ,cd.CONTENT_DETAIL_ENG as CONTENT_DETAIL_DESC ,cd.BRIEF_ENG as CONTENT_BRIEF,cd.PLACE_DESC_ENG as PLACE_DESC,cd.PRICE_RATE_ENG as PRICE_RATE, tmd.MUSEUM_NAME_ENG as MUSEUM_NAME ,";
		}
		$eventSql = "SELECT
		cd.CONTENT_ID,
		cd.CAT_ID,
		cd.SUB_CAT_ID, " . $eventSelectedColumn . "ifnull(
		cd.LAST_UPDATE_DATE,
		cd.CREATE_DATE
		) AS LAST_DATE,
		cd.EVENT_START_DATE,
		cd.EVENT_END_DATE,
		cd.MUSUEM_ID,
		cd.LAT,
		cd.LON,
		cd.EVENT_START_TIME,
		cd.EVENT_END_TIME
		FROM
		trn_content_detail cd
		left join trn_museum_detail tmd on tmd.MUSEUM_DETAIL_ID = cd.MUSUEM_ID
		WHERE
		cd.CAT_ID = " . $CID . " AND cd.SUB_CAT_ID = " . $SCID . "	AND cd.MUSUEM_ID = " . $MDNID . " AND cd.CONTENT_ID = " . $CONID;
		$eventRs = mysql_query($eventSql) or die(mysql_error());

		$eventRow = mysql_fetch_array($eventRs);
		?>

		<div class="part-nav-main"  id="firstbox">
			<div class="container">
				<div class="box-nav">
					<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn.php">ระบบเครือข่ายพิพิธภัณฑ์</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn-news-event.php">กิจกรรมและข่าวประชาสัมพันธ์</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn-news.php">ข่าวประชาสัมพันธ์</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							<?=$eventRow['CONTENT_DESC'] ?>
						</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<div class="part-main">
			<div class="container cf">
				<div class="box-left main-content">
					<?php
					include ('inc/inc-left-content-mdn.php');
					?>
					<?php
					include ('inc/inc-left-content-calendar.php');
					?>
				</div>
				<div class="box-right main-content">
					<hr class="line-red"/>
					<div class="box-title-system cf news">
						<h1>ข่าวประชาสัมพันธ์ของพิพิธภัณฑ์</h1>
						<div class="box-btn">
							<a href="mdn-detail.php?MDNID=<?=$MDNID ?>" class="btn red">เข้าสู่พิพิธภัณฑ์</a>
						</div>
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
if ($rowPicturecount <= 1) {
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
									<p class="date">
										<?=displayDate($eventRow['LAST_DATE']) ?>
									</p>
									<p class="month">
										<?=displayShortMonth($eventRow['LAST_DATE']) ?>
									</p>
								</div>
								<div class="box-text">
									<p class="text-title">
										<?=$eventRow['CONTENT_DESC'] ?>
									</p>
									<p class="text-des">
										<?=$eventRow['MUSEUM_NAME'] ?>
									</p>
								</div>
							</div>
						</div>
						<div class="box-social-main cf">
							<a href="#" class="btn fb"></a>
							<a href="#" class="btn tw"></a>
							<a href="#" class="btn g"></a>
							<a href="#" class="btn line"></a>
						</div>
						<div class="part-tumb-main">
							<div  class="text-title cf">
								<p>
									แกลเลอรี
								</p>
								<div class="box-btn">
									<a href="" class="btn black">ดูทั้งหมด</a>
								</div>
							</div>
							<div class="box-slide-small">
								<div id="sync2" class="owl-carousel">
									<?=$thumbRender ?>
								</div>
							</div>
						</div>
						<div class="box-news-text">
							<p>
									<?=$eventRow['CONTENT_DETAIL_DESC'] ?>
							</p>
						</div>
						<div class="box-footer-content cf">
							<div class="box-date-modified">
								วันที่แก้ไขล่าสุด :   <?=ConvertDate($eventRow['LAST_DATE']) ?>
							</div>
							<div class="box-plugin-social">
								Plugin Social
							</div>
						</div>

					</div>
					<div class="part-btn-back">
						<div class="box-btn cf">
							<a href="mdn-detail.php?MDNID=<?=$MDNID ?>" class="btn red">กลับไปพิพิธภัณฑ์</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
		?>

	</body>
</html>
