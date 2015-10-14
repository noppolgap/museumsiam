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

				if (isset($_SESSION['KM_PREV_PG'])){
					$backPage = $_SESSION['KM_PREV_PG'] ;
				}else {
					$backPage = "km.php?MID=".$km_module_id;
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

				if ($_SESSION['LANG'] == 'TH'){
					$LANG_SQL = "CONTENT_DESC_LOC AS CONTENT_LOC ,CONTENT_DETAIL_LOC AS CONTENT_DETAIL,BRIEF_LOC AS CONTENT_BRIEF,";
				}else if ($_SESSION['LANG'] == 'EN'){
					$LANG_SQL = "CONTENT_DESC_ENG AS CONTENT_LOC ,CONTENT_DETAIL_ENG AS CONTENT_DETAIL,BRIEF_ENG AS CONTENT_BRIEF,";
				}

				$contentSql = "SELECT
				CONTENT_ID,
				CAT_ID,
				".$LANG_SQL."
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
$sql_thumb_meta = "SELECT * FROM trn_content_picture WHERE CONTENT_ID = ".$CONID." AND IMG_TYPE = '1' AND CAT_ID = ".$CID." ORDER BY ORDER_ID ASC LIMIT 0 , 1";
$query_thumb_meta = mysql_query($sql_thumb_meta, $conn);
$row_thumb_meta = mysql_fetch_array($query_thumb_meta);
$thumb_meta = trim(str_replace("../../","",$row_thumb_meta['IMG_PATH']));

/* not work
$page_title = $title;
$page_description = $brief;
*/
$page_image = _FULL_SITE_PATH_.'/'.$thumb_meta;

unset($sql_thumb_meta);
unset($query_thumb_meta);
unset($row_thumb_meta);
unset($thumb_meta);

?>
<!doctype html>
<html>
<head>
<?
require ('inc_meta.php');
 ?>

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/news-event.css" />

<script src="js/km-detail.js"></script>

</head>

<body>

<?php
include ('inc/inc-top-bar.php');
 ?>
<?php
include ('inc/inc-menu.php');
 ?>

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<?php
				include ('inc/inc-km-breadcrumbs.php');
			?>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include ('inc/inc-left-content-km.php'); ?>
		</div>

		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf news">
				<h1><?=$catName ?></h1>
				<div class="box-btn">
					<a href="<?=$backPage ?>" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<div class="box-newsdetail-main">
				<div class="box-slide-big">
					<div id="sync1" class="owl-carousel">
					<?php
						$getPicSql = "select * from trn_content_picture where content_id = $CONID order by ORDER_ID asc ";

						$rsPic = mysql_query($getPicSql) or die(mysql_error());
						while ($rowPic = mysql_fetch_array($rsPic)) {
							echo '	<div class="slide-content"> ';
							echo '<img class="img-slide-show" style="max-width:754px;max-height: 562px" src="' . callThumbListFrontEndByID($rowPic['PIC_ID'], $rowPic['CAT_ID'], true) . '">';
							echo '</div>';
						}
					?>
					</div>
					<a class="btn-arrow-slide pev"></a>
					<a class="btn-arrow-slide next"></a>
					<div class="box-title-main">
						<div class="box-text">
							<p class="text-title">	<?=$title?></p>
							<p class="text-des pin">ชื่อสถานที่</p>
						</div>
					</div>
				</div>
				<div class="box-social-main cf">
				<?php
						$path = 'km-detail.php?MID='.$MID.'%26CID='.$CID.'%26CONID='.$CONID;
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

				<?php
				$getPicSql = "select * from trn_content_picture where content_id = $CONID order by ORDER_ID asc ";
				$rsPic = mysql_query($getPicSql) or die(mysql_error());
				$rowPicturecount = mysql_num_rows($rsPic);
				$extraStyle = "";
				if ($rowPicturecount == 1) {
					$extraStyle = " style='display:none;'";
				}
				?>

				<div class="part-tumb-main" <?=$extraStyle ?> >
					<div  class="text-title cf">
						<p>แกลเลอรี</p>
						<div class="box-btn">
							<a href="" class="btn black">ดูทั้งหมด</a>
						</div>
					</div>
					<div class="box-slide-small">
						<div id="sync2" class="owl-carousel">
							<?php

							while ($rowPic = mysql_fetch_array($rsPic)) {
								echo '	<div class="slide-content"> ';
								echo '<img  style="width:125px;height:94px;" src="' . callThumbListFrontEndByID($rowPic['PIC_ID'], $rowPic['CAT_ID'], true) . '">';
								echo '</div>';
							}
								?>
						</div>
					</div>
				</div>
				<div class="box-news-text">
					<?=$detail?>
				</div>
				<div class="box-footer-content cf">
					<div class="box-date-modified">
						วันที่แก้ไขล่าสุด :  <?= ConvertDate($rowContent['LAST_DATE']) ?>
					</div>
					<div class="box-plugin-social">
						<div class="fb-share-button" data-href="<?=$path?>" data-layout="button_count"></div>
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=$fullpath?>">Tweet</a>
						<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?=$fullpath?>"></div>
						<span>
						<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
						<script type="text/javascript">
						new media_line_me.LineButton({"pc":false,"lang":"en","type":"a","text":"<?=$path?>","withUrl":true});
						</script>
						</span>
					</div>
				</div>
			</div>
			<div class="part-btn-back">
				<div class="box-btn cf">
					<a href="<?=$backPage ?>" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<?php
include ('inc/inc-footer.php');
include('inc/inc-social-network.php');
?>
</body>
</html>
<? CloseDB(); ?>