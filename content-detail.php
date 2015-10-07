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
				//$(".menutop li.menu6,.menu-left li.menu4").addClass("active");

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

				$(".img-slide-show").each(function() {
					/* console.log('img '  , $(this));

					 console.log('Width ', $(this).width());
					 console.log('height ', $(this).css('height'));*/
					 
					if ($(this).width() > $(this).height())
						$(this).width(754);

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
					<?
					include ('inc/inc-breadcrumbs.php');
				?> 
				</div>
			</div>
		</div>

		<div class="box-freespace"></div>

		<div class="part-main">
			<div class="container cf">
				<div class="box-left main-content">
					<?php
					include ('inc/inc-category-menu.php');
					//include ('inc/inc-left-content-km.php');
 ?>
				</div>

				<?php
				$MID = $_GET['MID'];
				$CID = $_GET['CID'];
				$CONID = $_GET['CONID'];

				$SCID = "-1";
				if (isset($_GET['SCID']))
					$SCID = $_GET['SCID'];

					$currentPage = 1;
if (isset($_GET['PG']))
	$currentPage = $_GET['PG'];

if ($currentPage < 1)
	$currentPage = 1;
					
					
				$catName = "";

				$backPage = "all-content.php?MID=".$MID."&CID=".$CID;
				if (isset($_GET['SCID'])) {
						$backPage.= "$SCID=".$SCID ; 
					}
				$backPage.'&PG='.$currentPage ; 
				
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

			//	echo $contentSql;
				$rsContent = mysql_query($contentSql) or die(mysql_error());
				while ($rowContent = mysql_fetch_array($rsContent)) {
				
				?>
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
									echo '<img class="img-slide-show" style="max-width:754px;" src="' . callThumbListFrontEndByID($rowPic['PIC_ID'], $rowPic['CAT_ID'], true) . '">';
									echo '</div>';
								}
								?>
								
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
								<p>
									แกลเลอรี
								</p>
								<div class="box-btn">
									<a href="" class="btn black">ดูทั้งหมด</a>
								</div>
							</div>
							
									
							<div class="box-slide-small">
								<div id="sync2" class="owl-carousel" >
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
							<?=$rowContent['CONTENT_DETAIL_LOC'] ?>
							 
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
							<a href="<?=$backPage ?>" class="btn red">ย้อนกลับ</a>
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
