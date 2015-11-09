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
				$(".menutop li.menu6,.menu-left li.menu1").addClass("active");
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
						<li class="active">
							ระบบเครือข่ายพิพิธภัณฑ์
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
				</div>
				<div class="box-right main-content">

					<div class="box-category-main news BBlack">
						<div class="box-title cf">
							<h2>กิจกรรมและข่าวประชาสัมพันธ์</h2>
							<div class="box-btn">
								<a href="mdn-news-event.php" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">
								<?

								if ($_SESSION['LANG'] == 'TH') {
									$LANG_SQL = 'content.CONTENT_DESC_LOC AS CONTENT_LOC , content.BRIEF_LOC AS CONTENT_BRIEF ,';
								} else if ($_SESSION['LANG'] == 'EN') {
									$LANG_SQL = 'content.CONTENT_DESC_ENG AS CONTENT_LOC , content.BRIEF_ENG AS CONTENT_BRIEF ,';
								}
								$eventSql = " SELECT " . $LANG_SQL . "content.SUB_CAT_ID,
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
AND content.SUB_CAT_ID in ( " . $museumDataNetworkEventSubCat . " , " . $museumDataNetworkNewsSubCat . " ) ORDER BY
 RAND()
LIMIT 0,
3";

								$query = mysql_query($eventSql, $conn) or die($eventSql);
								$index = 1;
								while ($row = mysql_fetch_array($query)) {

									$gap = "";
									if ($index == 2) {
										$gap = " mid ";
									}

									$date = ConvertBoxDate($row['EVENT_START_DATE']);
									/*social*/
									$path = 'mdn-event-detail.php?MID=' . $MID . '%26CID=' . $CID . '%26SID=' . $row['SUB_CAT_ID'] . '%26CONID=' . $row['CONTENT_ID'] . '';
									$fullpath = _FULL_SITE_PATH_ . '/' . $path;
									$redirect_uri = _FULL_SITE_PATH_ . '/callback.php?p=' . $row['CONTENT_ID'];
									$fb_link = 'https://www.facebook.com/dialog/share?app_id=' . _FACEBOOK_ID_ . '&display=popup&href=' . $fullpath . '&redirect_uri=' . $redirect_uri;
									$path = str_replace("%26", "&amp;", $path);

									$title = htmlspecialchars(trim($row['CONTENT_LOC']));
									$detail = strip_tags(trim($row['CONTENT_BRIEF']));
									/*social*/

									echo '<div class="box-tumb cf' . $gap . '">';

									echo '<a href="mdn-event-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '">';
									echo '<div class="box-pic">';
									echo '<img src="' . callThumbListFrontEnd($row['CONTENT_ID'], $CID, true) . '">';

									if ($row['SUB_CAT_ID'] == $museumDataNetworkEventSubCat) {
										echo '<div class="box-date-tumb">';
										echo '<p class="date">';
										echo $date[0];
										echo '</p>';
										echo '<p class="month">';
										echo $date[1];
										echo '</p>';
										echo '</div>';
									}

									echo '</div> </a>';

									echo '<div class="box-text">';
									echo '<a href="mdn-event-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '">';
									echo '<p class="text-title">';
									echo $title;
									echo '</p> </a>';
									echo '<p class="text-date">';
									echo ConvertDate($row['LAST_DATE']);
									echo '</p>';
									echo '<p class="text-des">';
									echo $detail;
									echo '</p>';
									echo '<div class="box-btn cf">';
									echo '<a href="mdn-event-detail.php?CID=' . $CID . '&SCID=' . $row['SUB_CAT_ID'] . '&CONID=' . $row['CONTENT_ID'] . '&MDNID=' . $row['MUSUEM_ID'] . '" class="btn red">อ่านเพิ่มเติม</a>';
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
						</div>
					</div>

					<div class="box-category-main news BGray">
						<div class="box-title cf ">
							<h2>มิวเซียมแนะนำ</h2>
							<div class="box-btn">
								<a href="mdn-category.php" class="btn black">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">
								<?
								if ($_SESSION['LANG'] == 'TH')
									$selectedColumn = " muse.MUSEUM_NAME_LOC as MUSEUM_NAME , muse.DESCRIPT_LOC as MUSEUM_DESCRIPT, muse.PLACE_DESC_LOC as PLACE_DESC , dist.DISTRICT_DESC_LOC as DISTRICT_DESC ,subDist.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC , province.PROVINCE_DESC_LOC  as PROVINCE_DESC , ";
								else
									$selectedColumn = " muse.MUSEUM_NAME_ENG as MUSEUM_NAME , muse.DESCRIPT_ENG as MUSEUM_DESCRIPT, muse.PLACE_DESC_ENG as PLACE_DESC , dist.DISTRICT_DESC_ENG as DISTRICT_DESC, subDist.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC , province.PROVINCE_DESC_ENG as PROVINCE_DESC , ";

								$sql = " SELECT " . $selectedColumn;
								$sql .= " muse.MUSEUM_DETAIL_ID, ";
								$sql .= " muse.MUSEUM_DISPLAY_NAME, ";
								$sql .= " muse.ADDRESS1, ";
								$sql .= " muse.DISTRICT_ID, ";
								$sql .= " muse.SUB_DISTRICT_ID, ";
								$sql .= " muse.PROVINCE_ID, ";
								$sql .= " muse.POST_CODE, ";
								$sql .= " muse.TELEPHONE, ";
								$sql .= " muse.EMAIL, ";
								$sql .= " muse.LAT, ";
								$sql .= " muse.LON, ";
								$sql .= " IFNULL( ";
								$sql .= " 	muse.LAST_UPDATE_DATE, ";
								$sql .= " 	muse.CREATE_DATE ";
								$sql .= " ) AS LAST_DATE, ";
								$sql .= " muse.MOBILE_PHONE, ";
								$sql .= " muse.FAX ";
								$sql .= " FROM ";
								$sql .= " trn_museum_detail muse ";
								$sql .= " left join mas_district dist on dist.DISTRICT_ID = muse.DISTRICT_ID ";
								$sql .= " left join mas_sub_district subDist  on subDist.SUB_DISTRICT_ID = muse.SUB_DISTRICT_ID ";
								$sql .= " LEFT JOIN mas_province province on province.PROVINCE_ID= muse.PROVINCE_ID ";
								$sql .= " WHERE ";
								$sql .= " muse.IS_GIS_MUSEUM = 'N' ";
								$sql .= " AND muse.ACTIVE_FLAG = 1 ";
								$sql .= " AND muse.APPROVE_FLAG = 'Y' ";
								$sql .= " ORDER BY VISIT_COUNT desc ,  RAND() LIMIT 0,6 ";
								$rsMDN = mysql_query($sql) or die(mysql_error());
								$idx = 1;
								while ($rowMDN = mysql_fetch_array($rsMDN)) {
									$isMid = "";
									if ($idx == 2 || $idx == 5)
										$isMid = " mid ";
									echo '<div class="box-tumb cf' . $isMid . '">';
									echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
									echo '<div class="box-pic">';
									echo '<img src="' . callMDNThumbListFrontEnd($rowMDN['MUSEUM_DETAIL_ID'], true) . '">';
									echo '</div> </a>';
									echo '<div class="box-text">';
									echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '">';
									echo '<p class="text-title TcolorRed">';
									echo $rowMDN['MUSEUM_NAME'];
									echo '</p> </a>';
									echo '<p class="text-date TcolorGray">';
									echo $rowMDN['LAST_DATE'];
									echo '</p>';
									echo '<p class="text-des TcolorBlack">';
									echo $rowMDN['MUSEUM_DESCRIPT'];
									echo '</p>';
									echo '<div class="box-btn cf">';
									echo '<a href="mdn-detail.php?MDNID=' . $rowMDN['MUSEUM_DETAIL_ID'] . '" class="btn red">อ่านเพิ่มเติม</a>';
									echo '<div class="box-btn-social cf">';
									echo '<a href="#" class="btn-socila fb"></a>';
									echo '<a href="#" class="btn-socila tw"></a>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
									echo '</div>';

									$idx++;
								}
								?>
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
