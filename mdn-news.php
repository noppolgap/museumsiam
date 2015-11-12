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

		<script>
			$(document).ready(function() {
				$(".menutop li.menu6,.menu-left li.menu2,.menu-left li.menu2 .submenu2").addClass("active");
				if ($('.menu-left li.menu2').hasClass("active")) {
					$('.menu-left li.menu2').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="km">

		<?php
		include ('inc/inc-top-bar.php');
		include ('inc/inc-menu.php');
		$CID = $all_event_cat_id;
		$MID = $new_and_event;
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
							<a href="mdn-news-event.php">กิจกรรมและข่าวสาร</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							ข่าวสาร
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

					<div class="box-category-main news">
						<div class="box-title cf ">
							<h2>ข่าวสาร</h2>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

								<?
								if ($_SESSION['LANG'] == 'TH') {
									$LANG_SQL = 'content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
								} else if ($_SESSION['LANG'] == 'EN') {
									$LANG_SQL = 'content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
								}
								$newsSql = " SELECT " . $LANG_SQL . "content.SUB_CAT_ID,
content.CONTENT_ID,
content.EVENT_START_DATE,
content.EVENT_END_DATE,
content.CREATE_DATE,
content.LAST_UPDATE_DATE,
content.MUSUEM_ID  , 
ifnull(content.LAST_UPDATE_DATE , content.CREATE_DATE ) as LAST_DATE
FROM
trn_content_detail AS content
WHERE
MUSUEM_ID <> - 1
AND content.CONTENT_STATUS_FLAG = 0
AND content.SUB_CAT_ID = " . $museumDataNetworkNewsSubCat . " ORDER BY
EVENT_START_DATE ASC
LIMIT 0,
9";

								$query = mysql_query($newsSql, $conn) or die($newsSql);
								$index = 1;
								while ($row = mysql_fetch_array($query)) {

									$gap = "";
									if ($index == 2) {
										$gap = " mid ";
									}

									$date = ConvertBoxDate($row['EVENT_START_DATE']);
									/*social*/
									$path = 'mdn-news-detail.php?MID=' . $MID . '%26CID=' . $CID . '%26SID=' . $row['SUB_CAT_ID'] . '%26CONID=' . $row['CONTENT_ID'] . '';
									$fullpath = _FULL_SITE_PATH_ . '/' . $path;
									$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row['CONTENT_ID'];
									$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
									$path = str_replace("%26", "&amp;", $path);

									$title = htmlspecialchars(trim($row['CONTENT_LOC']));
									$detail = strip_tags(trim($row['CONTENT_BRIEF']));
									/*social*/

									if ($index == 4 || $index == 7)
										echo '<hr class="line-gray"/>';
									echo '<div class="box-tumb cf' . $gap . '">';

									echo '<a href="mdn-news-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '">';
									echo '<div class="box-pic">';
									echo '<img style="max-height: 186px;height: 186px;" src="' . callThumbListFrontEnd($row['CONTENT_ID'], $CID, true) . '">';
									echo '</div> </a>';

									echo '<div class="box-text">';
									echo '<a href="mdn-news-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '">';
									echo '<p class="text-title TcolorRed">';
									echo $title;
									echo '</p> </a>';
									echo '<p class="text-date TcolorGray">';
									echo ConvertDate($row['LAST_DATE']);
									echo '</p>';
									echo '<p class="text-des TcolorBlack">';
									echo $detail;
									echo '</p>';
									echo '<div class="box-btn cf">';
									echo '<a href="mdn-news-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '" class="btn red">อ่านเพิ่มเติม</a>';
									echo '<div class="box-btn-social cf">';
									echo '<a href="' . $fb_link . '" onclick="shareFB(\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila fb"></a>';
									echo '<a href="' . $fullpath . '" onclick="shareTW(\'' . $row_row1['CONTENT_ID'] . '\',\'' . $title . '\',$(this).attr(\'href\')); return false;" class="btn-socila tw"></a>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
									$index++;

								}
								?>
							</div>
							<div class="box-pagination-main cf">
								<ul class="pagination">
									<li class="deactive">
										<a href="" class="btn-arrow-left"></a>
									</li>
									<li class="active">
										<a href="">1</a>
									</li>
									<li>
										<a href="">2</a>
									</li>
									<li>
										<a href="">3</a>
									</li>
									<li>
										<a href="">...</a>
									</li>
									<li>
										<a href="" class="btn-arrow-right"></a>
									</li>
								</ul>
							</div>
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
