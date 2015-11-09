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
				$(".menutop li.menu6,.menu-left li.menu3").addClass("active");
				if ($('.menu-left li.menu3').hasClass("active")) {
					$('.menu-left li.menu3').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="km">

		<?php
		include ('inc/inc-top-bar.php');
		include ('inc/inc-menu.php');
		if (!isset($_GET['MID']))
			$MID = $museum_data_network_module_id;
		else
			$MID = $_GET['MID'];
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
						<li class="active">
							หมวดหมู่
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

					<div class="box-category-main news">
						<div class="box-title cf ">
							<h2>ภาคเหนือ</h2>
							<div class="box-btn">
								<a href="mdn-category2.php" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

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
						</div>
					</div>
					<div class="box-category-main news">
						<div class="box-title cf ">
							<h2>ภาคใต้</h2>
							<div class="box-btn">
								<a href="mdn-category2.php" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

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
						</div>
					</div>
					<div class="box-category-main news">
						<div class="box-title cf ">
							<h2>ภาคตะวันออกเฉียงเหนือ</h2>
							<div class="box-btn">
								<a href="mdn-category2.php" class="btn gold">ดูทั้งหมด</a>
							</div>
						</div>
						<div class="box-news-main">
							<div class="box-tumb-main cf ">

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
