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

		<!-- ScrollIt -->
		<script src="js/scrollIt.js"></script>

		<link rel="stylesheet" type="text/css" href="css/template.css" />
		<link rel="stylesheet" type="text/css" href="css/mdn.css" />

		<script>
			$(document).ready(function() {
				$(".menutop li.menu6,.menu-left li.menu3,.menu-left li.menu3 .submenu1").addClass("active");
				if ($('.menu-left li.menu3').hasClass("active")) {
					$('.menu-left li.menu3').children(".submenu-left").css("display", "block");
				}
				$.scrollIt({
					topOffset : -130 // offste (in px) for fixed top navigation
				});

				var sync1 = $("#sync1");
				var sync2 = $("#sync2");

				sync1.owlCarousel({
					singleItem : true,
					paginationSpeed : 500,
					rewindSpeed : 1000,
					navigation : false,
					pagination : false,
					afterAction : syncPosition,
					responsiveRefreshRate : 200,
					mouseDrag : false,
					rewindNav : true
				});

				sync2.owlCarousel({
					paginationSpeed : 500,
					rewindSpeed : 1000,
					items : 5,
					itemsMobile : [320, 5],
					itemsTablet : [768, 5],
					itemsDesktop : [1024, 5],
					navigation : false,
					pagination : true,
					responsiveRefreshRate : 100,
					mouseDrag : false,
					afterInit : function(el) {
						el.find(".owl-item").eq(0).addClass("synced");
					},
					rewindNav : false
				});

				function syncPosition(el) {
					var current = this.currentItem;
					$("#sync2").find(".owl-item").removeClass("synced").eq(current).addClass("synced")
					if ($("#sync2").data("owlCarousel") !== undefined) {
						center(current)
					}
				}


				$("#sync2").on("click", ".owl-item", function(e) {
					e.preventDefault();
					var number = $(this).data("owlItem");
					sync1.trigger("owl.goTo", number);
				});

				function center(number) {
					var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

					var num = number;
					var found = false;
					for (var i in sync2visible) {
						if (num === sync2visible[i]) {
							var found = true;
						}
					}

					if (found === false) {
						if (num > sync2visible[sync2visible.length - 1]) {
							sync2.trigger("owl.goTo", num - sync2visible.length + 2)
						} else {
							if (num - 1 === -1) {
								num = 0;
							}
							sync2.trigger("owl.goTo", num);
						}
					} else if (num === sync2visible[sync2visible.length - 1]) {
						sync2.trigger("owl.goTo", sync2visible[1])
					} else if (num === sync2visible[0]) {
						sync2.trigger("owl.goTo", num - 1)
					}
				}


				$(".box-slide-big a.pev").click(function() {
					$("#sync1").data('owlCarousel').prev();
				});
				$(".box-slide-big a.next").click(function() {
					$("#sync1").data('owlCarousel').next();
				});

			});
		</script>

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
							<a href="mdn-category.php">หมวดหมู่</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn-category2.php">หมวดหมู่</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="mdn-all.php">หมวดหมู่ย่อย</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							ชื่อพิพิธภัณฑ์
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
					$MDNID = intval($_GET['MDNID']);

					if ($_SESSION['LANG'] == 'TH') {
						$selectedColumn = " tmd.MUSEUM_NAME_LOC as MUSEUM_NAME , tmd.ADDRESS1 as MUSEUM_ADDRESS, tmd.MAP_IMG_PATH_LOC as MAP_PATH , tmd.PRICE_RATE_LOC as PRICE_RATE, tmd.TRANSPORTATION_LOC as TRANSPORTATION,
					tmd.STORY_LOC as STORY_DESC , tmd.PHYSICAL_LOC as PHYSICAL_DESC, tmd.LANDSCAPE_LOC as LANDSCAPE_DESC , tmd.EXHIBITION_LOC as EXHIBITION_DESC, tmd.ARCHIVE_LOC as ARCHIVE_DESC ,
					tmd.TOP_ARCHIVE_LOC as TOP_ARCHIVE_DESC , tmd.STORAGE_LOC as STORAGE_DESC , tmd.TARGET_LOC as TARGET_DESC , tmd.PUBLIC_INFOR_LOC as PUBLIC_INFOR_DESC , tmd.RESPONSIBLE_LOC  as RESPONSIBLE_DESC ,
					tmd.NEARBY_LOC as NEARBY_DESC , district.DISTRICT_DESC_LOC as DISTRICT_DESC , subDistrict.SUB_DISTRICT_DESC_LOC as SUB_DISTRICT_DESC
					, province.PROVINCE_DESC_LOC  as  PROVINCE_DESC ";
					} else {
						$selectedColumn = " tmd.MUSEUM_NAME_ENG as MUSEUM_NAME , tmd.ADDRESS2 as MUSEUM_ADDRESS , tmd.MAP_IMG_PATH_ENG as MAP_PATH, tmd.PRICE_RATE_ENG as PRICE_RATE , tmd.TRANSPORTATION_ENG as TRANSPORTATION,
					tmd.STORY_ENG as STORY_DESC, tmd.PHYSICAL_ENG as PHYSICAL_DESC , tmd.LANDSCAPE_ENG as LANDSCAPE_DESC , tmd.EXHIBITION_ENG as EXHIBITION_DESC, tmd.ARCHIVE_ENG as ARCHIVE_DESC,
					tmd.TOP_ARCHIVE_ENG as TOP_ARCHIVE_DESC , tmd.STORAGE_ENG as STORAGE_DESC , tmd.TARGET_ENG as TARGET_DESC, tmd.PUBLIC_INFOR_ENG  as PUBLIC_INFOR_DESC , tmd.RESPONSIBLE_ENG  as RESPONSIBLE_DESC,
					tmd.NEARBY_ENG as NEARBY_DESC, district.DISTRICT_DESC_ENG as DISTRICT_DESC , subDistrict.SUB_DISTRICT_DESC_ENG as SUB_DISTRICT_DESC
					, province.PROVINCE_DESC_ENG  as  PROVINCE_DESC ";
					}

					$museSql = "select  tmd.MUSEUM_DETAIL_ID , " . $selectedColumn . " , tmd.DISTRICT_ID
					,tmd.SUB_DISTRICT_ID
					,tmd.PROVINCE_ID
					,tmd.POST_CODE
					,tmd.TELEPHONE
					,tmd.EMAIL
					,tmd.LAT
					,tmd.LON
					,tmd.MOBILE_PHONE
					,tmd.FAX
					,tmd.WEBSITE_URL
					,tmd.FACEBOX_URL
					,tmd.TWITTER_URL
					,tmd.YOUTUBE_URL 
					, ifnull(tmd.LAST_UPDATE_DATE , tmd.CREATE_DATE) as LAST_DATE from trn_museum_detail tmd
					left join mas_district district on district.DISTRICT_ID =  tmd.DISTRICT_ID
					left join mas_sub_district subDistrict on subDistrict.SUB_DISTRICT_ID = tmd.SUB_DISTRICT_ID
					left join mas_province province on province.PROVINCE_ID  = tmd.PROVINCE_ID
					where
					MUSEUM_DETAIL_ID = " . $MDNID;
					$rs = mysql_query($museSql) or die(mysql_error());
					$row = mysql_fetch_array($rs);
					?>
				</div>
				<div class="box-right main-content">
					<hr class="line-red"/>
					<div class="box-title-system cf news">
						<div class="box-btn">
							<a href="" class="btn red">ย้อนกลับ</a>
						</div>
					</div>
					<div class="box-newsdetail-main">
						<div class="box-slide-big">
							<div id="sync1" class="owl-carousel">
								<div class="slide-content">
									<img src="http://placehold.it/754x562">
								</div>
								<div class="slide-content">
									<img src="http://placehold.it/754x562/ccc">
								</div>
								<div class="slide-content">
									<img src="http://placehold.it/754x562">
								</div>
								<div class="slide-content">
									<img src="http://placehold.it/754x562/ccc">
								</div>
								<div class="slide-content">
									<img src="http://placehold.it/754x562">
								</div>
								<div class="slide-content">
									<img src="http://placehold.it/754x562/ccc">
								</div>
							</div>
							<a class="btn-arrow-slide pev"></a>
							<a class="btn-arrow-slide next"></a>
							<div class="box-title-main">
								<div class="box-text">
									<p class="text-title">
										<?=$row['MUSEUM_NAME'] ?>
									</p>
									<p class="text-des pin">
										<?=$row['PROVINCE_DESC'] ?>
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
									<a href="all-media.php" class="btn black">ดูทั้งหมด</a>
								</div>
							</div>
							<div class="box-slide-small">
								<div id="sync2" class="owl-carousel">
									<div class="slide-content">
										<img src="http://placehold.it/125x94">
									</div>
									<div class="slide-content">
										<img src="images/tumb-sound.jpg">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/125x94">
									</div>
									<div class="slide-content">
										<img src="images/tumb-vdo.jpg">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/125x94">
									</div>
									<div class="slide-content">
										<img src="http://placehold.it/125x94/ccc">
									</div>
								</div>
							</div>
						</div>

						<div class="box-btn cf toBottom">
							<a class="btn red" data-scroll-nav='1'>กิจกรรมและข่าวสารของพิพิธภัณฑ์</a>
						</div>

						<div class="box-gray first">
							<h3>ที่อยู่และเบอร์ติดต่อ</h3>
							<p class="text-location">
								<?=$row['MUSEUM_ADDRESS'] . ' ' . $row['SUB_DISTRICT_DESC'] . ' ' . $row['DISTRICT_DESC'] . ' ' . $row['PROVINCE_DESC'] . ' ' . $row['POST_CODE'] ?>
							</p>
							<p class="text-tel">
								<a href="tel:<?=$row['TELEPHONE'] ?>" target="_blank"><?=$row['TELEPHONE'] ?></a>  
							</p>
							<p class="text-fax">
								<a href="<?=$row['FAX'] ?>" target="_blank"><?=$row['FAX'] ?></a>
							</p>
							<p class="text-web">
								<a href="<?=$row['WEBSITE_URL'] ?>" target="_blank"><?=$row['WEBSITE_URL'] ?></a>
							</p>
						</div>
						<div class="box-gray">
							<h3>วันและเวลาทำการ</h3>
							<p class="text-date">
								<?
								$openningSql = " select * from trn_museum_openning where MUSEUM_ID = " . $MDNID . " order by OPENNING_DAY asc";
								$rsOpenning = mysql_query($openningSql) or die(mysql_error());
								$lastOpenday = 0;
								$idx = 0;
								$rowCount = mysql_num_rows($rsOpenning);
								$dayOpenText = "";
								$dashRequire = FALSE;
								$commaRequire = FALSE;
								$timeText = "";
								while ($rowOpenning = mysql_fetch_array($rsOpenning)) {

									if ($rowOpenning['IS_CUSTOM_OPENNING'] == 'N') {
										$timeText = $rowOpenning['OPENNING_START_HOUR'] . " - " . $rowOpenning['OPENNING_END_HOUR'];
									} else {
										if ($timeText != "")
											$timeText .= " , ";
										$timeText .= $dayArr[$rowOpenning['OPENNING_DAY']] . " (" . $rowOpenning['OPENNING_START_HOUR'] . " - " . $rowOpenning['OPENNING_END_HOUR'] . ")";
									}

									//echo $rowOpenning['OPENNING_DAY'] ;
									if ($idx == 0) {
										$lastOpenday = $rowOpenning['OPENNING_DAY'];
										$dayOpenText = $dayArr[$lastOpenday];
									} else if ($lastOpenday + 1 == $rowOpenning['OPENNING_DAY']) {
										$lastOpenday = $rowOpenning['OPENNING_DAY'];
										$dashRequire = TRUE;
										$commaRequire = FALSE;
									} else {
										if ($dashRequire)
											$dayOpenText .= ' - ' . $dayArr[$lastOpenday];
										else
											$dayOpenText .= ' , ' . $dayArr[$lastOpenday];

										$lastOpenday = $rowOpenning['OPENNING_DAY'];
										$dashRequire = FALSE;
										$commaRequire = TRUE;
									}
									$idx++;
									if ($idx == $rowCount && $rowCount > 1) {
										if ($dashRequire)
											$dayOpenText .= ' - ' . $dayArr[$lastOpenday];
										else
											$dayOpenText .= ' , ' . $dayArr[$lastOpenday];
									}
								}
								echo $dayOpenText;
								?>
							</p>
							<p class="text-time">
								<?=$timeText ?>								 
							</p>
						</div>
						<div class="box-gray">
							<h3>ผู้ชมกลุ่มเป้าหมาย</h3>
							<p>
								<?=$row['TARGET_DESC'] ?>
							</p>
						</div>
						<div class="box-gray">
							<h3>ค่าเข้าชม</h3>
							<p class="text-ticket">
								<?=$row['PRICE_RATE'] ?>
							</p>
						</div>

						<div class="box-gray noIcon">
							<h3>การเดินทางถึงพิพิธภัณฑ์/แหล่งเรียนรู้</h3>
							<span>สถานที่สำคัญใกล้เคียง</span>
							<p>
							<?=$row['NEARBY_DESC'] ?>
							</p>
						</div>

						<div class="box-white">
							<h3>ประวัติความเป็นมา</h3>
							<p>
								<?=$row['STORY_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>ลักษณะทางกายภาพของพิพิธภัณฑ์/แหล่งเรียนรู้</h3>
							<p>
								<?=$row['PHYSICAL_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>

						<div class="box-white">
							<h3>ภูมิทัศน์โดยรอบ</h3>
							<p>
								<?=$row['LANDSCAPE_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>ภาพถ่ายห้องจัดแสดง</h3>
							<p>
								<?=$row['EXHIBITION_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>วัตถุจัดแสดง</h3>
							<p>
								<?=$row['ARCHIVE_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>วัตถุจัดแสดงที่มีความสำคัญ</h3>
							<p>
								<?=$row['TOP_ARCHIVE_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>การจัดเก็บ</h3>
							<p>
								<?=$row['STORAGE_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>แหล่งเรียนรู้อื่นๆในเขตพื้นที่ใกล้เคียง</h3>
							<p>
								<?=$row['NEARBY_DESC'] ?>
							</p>
							<div class="box-img cf">
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img class="right"  src="http://placehold.it/754x562"></a>
								<a href="images/mog-pic.png" class="lightbox"><img src="http://placehold.it/754x562"></a>
							</div>
						</div>
						<div class="box-white">
							<h3>ผู้ดูแลและหน่วยงานที่รับผิดชอบในปัจจุบัน</h3>
							<p>
								<?=$row['RESPONSIBLE_DESC'] ?>
							</p>
						</div>

						<div class="box-white social">
							<h3>การเผยแผร่และประชาสัมพันธ์</h3>
							<p>
								<span>Facebook</span><a href="<?=$row['FACEBOX_URL'] ?>" target="_blank"><?=$row['FACEBOX_URL'] ?></a>
							</p>
							<p>
								<span>Twitter </span><a href="<?=$row['TWITTER_URL'] ?>" target="_blank"><?=$row['TWITTER_URL'] ?></a>
							</p>
							<p>
								<span>Youtube</span><a href="<?=$row['YOUTUBE_URL'] ?>" target="_blank"><?=$row['YOUTUBE_URL'] ?></a>
							</p>
						</div>

						<div class="box-footer-content cf">
							<div class="box-date-modified">
								วันที่แก้ไขล่าสุด :  <?=ConvertDate($row['LAST_DATE']) ?>
							</div>
							<div class="box-plugin-social">
								Plugin Social
							</div>
						</div>

						<div class="box-newsevent-main cf" data-scroll-index="1">
							<div class="box-category-main news BGray box-left">
								<div class="box-title cf ">
									<h2>กิจกรรม</h2>
								</div>
								<div class="box-museum-news">
									<?
									if ($_SESSION['LANG'] == 'TH') {
										$eventSelectedColumn = "cd.CONTENT_DESC_LOC as CONTENT_DESC ,cd.CONTENT_DETAIL_LOC as CONTENT_DETAIL_DESC ,cd.BRIEF_LOC as CONTENT_BRIEF,cd.PLACE_DESC_LOC as PLACE_DESC,cd.PRICE_RATE_LOC as PRICE_RATE,";
									} else {
										$eventSelectedColumn = "cd.CONTENT_DESC_ENG as CONTENT_DESC ,cd.CONTENT_DETAIL_ENG as CONTENT_DETAIL_DESC ,cd.BRIEF_ENG as CONTENT_BRIEF,cd.PLACE_DESC_ENG as PLACE_DESC,cd.PRICE_RATE_ENG as PRICE_RATE,";
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
											WHERE
												cd.CAT_ID = " . $all_event_cat_id . " AND cd.SUB_CAT_ID = " . $museumDataNetworkEventSubCat . "	AND cd.MUSUEM_ID = " . $MDNID;
									$eventRs = mysql_query($eventSql) or die(mysql_error());

									while ($eventRow = mysql_fetch_array($eventRs)) {
										$linkTo = "mdn-event-detail.php?CID=" . $eventRow["CAT_ID"] . "&SCID=" . $eventRow["SUB_CAT_ID"] . "&CONID=" . $eventRow["CONTENT_ID"]."&MDNID=".$MDNID;
										echo '<div class="museum-news cf">';
										echo '<div class="box-pic">';
										echo '<a href="' . $linkTo . '"><img src="http://placehold.it/274x205"></a>';
										echo '</div>';
										echo '<div class="box-text">';
										echo '<a href="' . $linkTo . '">';
										echo '<p class="text-title TcolorRed">';
										echo $eventRow['CONTENT_DESC'];
										echo '</p></a>';
										echo '<p class="text-date TcolorGray">';
										echo ConvertDate($eventRow['LAST_DATE']);
										echo '</p>';
										echo '</div>';
										echo '</div>';
									}
									?>
								</div>
							</div>
							<div class="box-category-main news BGray box-right">
								<div class="box-title cf ">
									<h2>ข่าวสาร</h2>
								</div>
								<div class="box-museum-news">
									
									<?
									if ($_SESSION['LANG'] == 'TH') {
										$newsSelectedColumn = "cd.CONTENT_DESC_LOC as CONTENT_DESC ,cd.CONTENT_DETAIL_LOC as CONTENT_DETAIL_DESC ,cd.BRIEF_LOC as CONTENT_BRIEF,cd.PLACE_DESC_LOC as PLACE_DESC,cd.PRICE_RATE_LOC as PRICE_RATE,";
									} else {
										$newsSelectedColumn = "cd.CONTENT_DESC_ENG as CONTENT_DESC ,cd.CONTENT_DETAIL_ENG as CONTENT_DETAIL_DESC ,cd.BRIEF_ENG as CONTENT_BRIEF,cd.PLACE_DESC_ENG as PLACE_DESC,cd.PRICE_RATE_ENG as PRICE_RATE,";
									}
									$newsSql = "SELECT
												cd.CONTENT_ID,
												cd.CAT_ID,
												cd.SUB_CAT_ID, " . $newsSelectedColumn . "ifnull(
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
											WHERE
												cd.CAT_ID = " . $all_event_cat_id . " AND cd.SUB_CAT_ID = " . $museumDataNetworkNewsSubCat . "	AND cd.MUSUEM_ID = " . $MDNID;
									$newsRs = mysql_query($newsSql) or die(mysql_error());

									while ($newsRow = mysql_fetch_array($newsRs)) {
										$linkTo = "mdn-news-detail.php?CID=" . $newsRow["CAT_ID"] . "&SCID=" . $newsRow["SUB_CAT_ID"] . "&CONID=" . $newsRow["CONTENT_ID"]."&MDNID=".$MDNID;
										echo '<div class="museum-news cf">';
										echo '<div class="box-pic">';
										echo '<a href="' . $linkTo . '"><img src="http://placehold.it/274x205"></a>';
										echo '</div>';
										echo '<div class="box-text">';
										echo '<a href="' . $linkTo . '">';
										echo '<p class="text-title TcolorRed">';
										echo $newsRow['CONTENT_DESC'];
										echo '</p></a>';
										echo '<p class="text-date TcolorGray">';
										echo ConvertDate($newsRow['LAST_DATE']);
										echo '</p>';
										echo '</div>';
										echo '</div>';
									}
									?>
									
									 
								</div>
							</div>
						</div>

					</div>
					<div class="part-btn-back">
						<div class="box-btn cf">
							<a href="" class="btn red">ย้อนกลับ</a>
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
