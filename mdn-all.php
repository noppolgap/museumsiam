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
				$(".menutop li.menu6,.menu-left li.menu3,.menu-left li.menu3 .submenu1").addClass("active");
				if ($('.menu-left li.menu3').hasClass("active")) {
					$('.menu-left li.menu3').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="km">

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
						<li class="active">
							หมวดหมู่ย่อย
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

					//MID='.$MID.'&CID='.$CID.'&SCID='.$row['SUB_CONTENT_CAT_ID'].'&TID=
					if (!isset($_GET['MID']))
						$MID = $museum_data_network_module_id;
					else
						$MID = intval($_GET['MID']);

					if (!isset($_GET['CID'])) {
						$CID = $regionCategory;
					} else {
						$CID = intval($_GET['CID']);
					}
					$SCID = intval($_GET['SCID']);
					$TID = intval($_GET['TID']);

					if ($_SESSION['LANG'] == 'TH') {
						$selectedColumn = " SUB_CONTENT_CAT_DESC_LOC as CONTENT_SUB_CAT_DESC , ";
					} else {
						$selectedColumn = " SUB_CONTENT_CAT_DESC_ENG as CONTENT_SUB_CAT_DESC , ";
					}
					$subCategorySql = "SELECT
										SUB_CONTENT_CAT_ID, " . $selectedColumn . " IS_LAST_NODE
									   FROM
										trn_content_sub_category
									   WHERE
										flag = 0 and SUB_CONTENT_CAT_ID = " . $TID . " ORDER BY
										ORDER_DATA DESC";
					$query = mysql_query($subCategorySql, $conn) or die($subCategorySql);

					$rowCat = mysql_fetch_array($query);
					$hideTitle = "";
					if ($CID != $regionCategory) {
						$hideTitle = " style='display:none'";
					}
					?>
				</div>
				<div class="box-right main-content">
					<hr class="line-red"/>
					<div class="box-title-system cf news" <?=$hideTitle ?>>
						<h1><?=$rowCat['CONTENT_SUB_CAT_DESC'] ?></h1>
					</div>

					<div class="box-category-main news BGray">
						<div class="box-title cf">
							<h2>เชียงใหม่</h2>
							<p>
								จำนวน <span>999,999</span> แห่ง
							</p>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf">

								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">
									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf mid">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="line-gray"/>
								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf mid">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="line-gray"/>
								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf mid">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
								<div class="box-tumb cf">
									<a href="">
									<div class="box-pic">
										<img src="http://placehold.it/274x205">

									</div> </a>
									<div class="box-text">
										<a href="">
										<p class="text-title TcolorRed">
											Levitated Mass 340 Ton Giant Stone
										</p> </a>
										<p class="text-date TcolorGray">
											28 พ.ย. 2559
										</p>
										<p class="text-des TcolorBlack">
											Levitated Mass is a 2012 large scale sculpture by Michael Heizer on the campus of the Los Angeles County Museum of Art ..
										</p>
										<div class="box-btn cf">
											<a href="" class="btn red">อ่านเพิ่มเติม</a>
											<div class="box-btn-social cf">
												<a href="#" class="btn-socila fb"></a>
												<a href="#" class="btn-socila tw"></a>
											</div>
										</div>
									</div>
								</div>
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
