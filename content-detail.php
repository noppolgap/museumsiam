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
		<link rel="stylesheet" type="text/css" href="css/news-event.css" />

		<script>
			$(document).ready(function() {
				$(".menutop li.menu6,.menu-left li.menu4").addClass("active");

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
							<a href="km.php">ระบบการจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							<a href="km-exhibition.php">นิทรรศการ</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							ชื่อข่าว
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
					include ('inc/inc-left-content-km.php');
 ?>
				</div>

				<?php
				$MID = $_GET['MID'];
				$CID = $_GET['CID'];
				$CONID = $_GET['CONID'];

				$SCID = "-1";
				if (isset($_GET['SCID']))
					$SCID = $_GET['SCID'];

				$catName = "";

				$backPage = "all-content.php?MID=".$MID."&CID=".$CID;
				if (isset($_GET['SCID'])) {
						$backPage.= "$SCID=".$SCID ; 
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

				

				$contentSql = "SELECT
				CONTENT_ID,
				CAT_ID,
				CONTENT_DESC_LOC,
				CONTENT_DESC_ENG,
				CONTENT_DETAIL_LOC,
				CONTENT_DETAIL_ENG,
				CREATE_DATE,
				LAST_UPDATE_DATE,
				IFNULL(LAST_UPDATE_DATE , CREATE_DATE) as LAST_DATE ,
				EVENT_START_DATE,
				EVENT_END_DATE
				FROM
				trn_content_detail
				WHERE
				CONTENT_ID = $CONID";

				$rsContent = mysql_query($contentSql) or die(mysql_error());
				while ($rowContent = mysql_fetch_array($rsContent)) {
				
				?>
				<div class="box-right main-content">
					<hr class="line-red"/>
					<div class="box-title-system cf news">
						<h1><?=$catName ?></h1>
						<div class="box-btn">
							
							<a href="<?=$backPage?>" class="btn red">ย้อนกลับ</a>
						</div>
					</div>
					<div class="box-newsdetail-main">
						<div class="box-slide-big">
							<div id="sync1" class="owl-carousel">
								
								<?php
								$getPicSql = "select * from trn_content_picture where content_id = $CONID ";

								$rsPic = mysql_query($getPicSql) or die(mysql_error());
								while ($rowPic = mysql_fetch_array($rsPic)) {
									echo '	<div class="slide-content"> ';
									echo '<img src="' . callThumbListFrontEnd($rowPic['CONTENT_ID'], $rowPic['CAT_ID'], true) . '">';
									echo '</div>';
								}
								?>
								<!--
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
								</div> -->
							</div>
							<a class="btn-arrow-slide pev"></a>
							<a class="btn-arrow-slide next"></a>
							<div class="box-title-main">
								<div class="box-text">
									<p class="text-title">
										<?=$rowContent['CONTENT_DESC_LOC'] ?>
									</p>
									<p class="text-des pin">
										ชื่อสถานที่
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
									<?php
									$getPicSql = "select * from trn_content_picture where content_id = $CONID ";

									$rsPic = mysql_query($getPicSql) or die(mysql_error());
									while ($rowPic = mysql_fetch_array($rsPic)) {
										echo '	<div class="slide-content"> ';
										echo '<img src="' . callThumbListFrontEnd($rowPic['CONTENT_ID'], $rowPic['CAT_ID'], true) . '">';
										echo '</div>';
									}
								?>
									<!--<div class="slide-content">
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
									</div> -->
								</div>
							</div>
						</div>
						<div class="box-news-text">
							<?=$rowContent['CONTENT_DESC_LOC'] ?>
							<!--
							<p>
								Levitated Mass is a 2012 large-scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art. The installation consists of a 340-ton boulder affixed above a concrete trench through which visitors may walk. The nature, expense and scale of the installation made it an instant topic of discussion The work comprises a 21.5-foot tall boulder mounted on the walls of a 456-foot long concrete trench, surrounded by 2.5 acres of compressed decomposed granite. The boulder is bolted to two shelves affixed to the inner walls of the trench, which descends from ground level to 15 feet below the stone at its center, allowing visitors to stand directly below the megalith.
							</p>-->
						</div>
						<div class="box-footer-content cf">
							<div class="box-date-modified">
								วันที่แก้ไขล่าสุด :  <?= ConvertDate($rowContent['LAST_DATE']) ?>
							</div>
							<div class="box-plugin-social">
								Plugin Social
							</div>
						</div>
					</div>
					<div class="part-btn-back">
						<div class="box-btn cf">
							<a href="<?=$backPage?>" class="btn red">ย้อนกลับ</a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
 ?>

	</body>
</html>
