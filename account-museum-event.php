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

		<link rel="stylesheet" type="text/css" href="css/form.css" />
		<link rel="stylesheet" type="text/css" href="css/account.css" />
		<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
		<link rel="stylesheet" type="text/css" href="css/account-museum.css" />
		<link rel="stylesheet" type="text/css" href="css/styleForUploadPhoto.css" />
		<script type="text/javascript" src="js/scriptForUploadPhoto.js"></script>
		<script>
			$(document).ready(function() {
				$(".menu-left li.menu5,.menu-left li.menu5 li.submenu2").addClass("active");
				if ($('.menu-left li.menu5').hasClass("active")) {
					$('.menu-left li.menu5').children(".submenu-left").css("display", "block");
				}
			});
		</script>

	</head>

	<body id="account">

		<?php
		include ('inc/inc-top-bar.php');
		?>
		<?php
		include ('inc/inc-menu.php');
		require ('inc/inc-require-museum-admin-login.php');
		if ($_SESSION['LANG'] == 'TH') {
			$picFolder = 'th';
		} else {
			$picFolder = 'en';
		}
		?>

		<div class="part-nav-main">
			<div class="container">
				<div class="box-nav">
					<ol class="cf">
						<li>
							<a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li>
							จัดการพิพิธภัณฑ์&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;
						</li>
						<li class="active">
							กิจกรรม
						</li>
					</ol>
				</div>
			</div>
		</div>

		<div class="part-titlepage-main"  id="firstbox">
			<div class="container">
				<div class="box-titlepage">
					<p>
						<img src="images/<?=$picFolder ?>/title-accout.png" alt="ACCOUNT SETTINGS"/>
					</p>
				</div>
			</div>
		</div>

		<div class="part-account-main">
			<form id = "frmcms" method="post" action="account-museum-event-action.php?add" >
				<div class="container cf">
					<div class="box-account-left">
						<?php
						include ('inc/inc-account-menu.php');
						?>
					</div>
					<div class="box-account-right cf">
						<div class="box-title">
							<h1>จัดการพิพิธภัณฑ์ - กิจกรรม</h1>
						</div>
						<?
						$getMuseumIDSql = "select MUSEUM_DETAIL_ID from mapping_museum_admin where
						ADMIN_USER_ID = '" . $_SESSION['user_name'] . "'";
						$query_getMuseumID = mysql_query($getMuseumIDSql, $conn);
						$row_getMuseumID = mysql_fetch_array($query_getMuseumID);
						?>
						<input type="hidden" name="museumID" value="<?=$row_getMuseumID['MUSEUM_DETAIL_ID'] ?>" />
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											ชื่อกิจกรรม
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div>
												<input type="text" name="txtDescLoc"  id="txtDescLoc">
												<span class="error" >* <span id = "nameThError" style="display:none">กรุณาระบุชื่อ TH</span> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											ชื่อกิจกรรม
											<br>
											(ภาษาอังกฤษ)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div>
												<input type="text" name="txtDescEng" id="txtDescEng">
												<span class="error" >* <span id = "nameEnError" style="display:none">กรุณาระบุชื่อ EN</span> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											วันที่จัดกิจกรรม
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text date cf">
											<div>
												<input type="text"  id = "txtStartDate"  name = "txtStartDate" class="DatePicker" >
											</div>
											<div>
												<span>ถึง</span>
											</div>
											<div>
												<input type="text"  id = "txtEndDate" name = "txtEndDate" class="DatePicker" >
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<span class="error" >*<span id = "startDateError" style="display:none">กรุณาระบุวันที่เริ่มจัดกิจกรรม</span>&nbsp;&nbsp;<span id = "endDateError" style="display:none">กรุณาระบุวันที่สิ้นสุดกิจกรรม</span> </span>

								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											เวลาจัดกิจกรรม
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text time">

											<p id="timeText">
												<span class="amount-time" id="amount-time-all">8:00 - 20:00</span>
											</p>

											<div class="workingtime" data-box="all">
												<input type="hidden" name="startdate" class="startdate" value="8:00" />
												<input type="hidden" name="enddate" class="enddate" value="20:00" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											สถานที่จัดงาน
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text" >
											<div>
												<input type="text" name = "txtPlaceLoc">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											สถานที่จัดงาน
											<br>
											(ภาษาอังกฤษ)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div>
												<input type="text" name = "txtPlaceEng">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">

									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div>
												<input type="text" placeholder="Latitude" name ="txtLat">
											</div>
										</div>
										<div class="box-input-text mT">
											<div>
												<input type="text" placeholder="Longitude" name ="txtLon">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											ค่าเข้าชม
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtPriceLoc"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											ค่าเข้าชม
											<br>
											(ภาษาอังกฤษ)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtPriceEng"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											รายละเอียดย่อ
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtBriefDescLoc"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											รายละเอียดย่อ
											<br>
											(ภาษาอังกฤษ)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtBriefDescEng"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											รายละเอียด
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtDetailLoc" id="txtDetailLoc"></textarea>
												<span class="error" >* <span id = "detailThError" style="display:none">กรุณาระบุรายละเอียด TH</span> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											รายละเอียด
											<br>
											(ภาษาอังกฤษ)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea name="txtDetailEng" id="txtDetailEng"></textarea>
												<span class="error" >* <span id = "detailEnError" style="display:none">กรุณาระบุรายละเอียด EN</span> </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-line cf">
							<hr>
						</div>

						<div class="row-main cf">
							<div class="box-left addW">
								<div class="box-row cf ">
									<div class="box-left">
										<p>
											รูปภาพ
										</p>
									</div>
									<div class="box-right ">
										<div class="box-input-text cf">
											<div class="box-btn">
												<a class="btn black" id = "btnBrowseEventPic">BROWSE</a>
											</div>
											<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
										</div>
										<?echo frontend_mdn_content_upload_image_edit('EVENT_PIC', -1, $all_event_cat_id); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="box-line cf">
							<hr>
						</div>

						<div class="row-main cf">
							<div class="box-left">
								<div class="box-row cf">
									<div class="box-left">
										<p>
											Youtube Embed
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div>
												<input type="text" id="txtYouTubeAdd">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="box-right">
								<div class="box-row cf">
									<div class="box-left">
										<div class="box-input-text cf">
											<div class="box-btn">
												<a class="btn black" id = "btnYoutubeAdd">เพิ่ม</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row-main cf">
							<div class="box-left addW">
								<div class="box-row cf ">
									<div class="box-left">

									</div>
									<div class="box-right ">
										<div class="box-input-text cf youtubePreview">
											
										</div>
										<div id="divHidYoutube" style="display: none">
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-line cf">
							<hr>
						</div>

						<!-- <div class="row-main cf">
							<div class="box-left addW">
								<div class="box-row cf ">
									<div class="box-left">

									</div>
									<div class="box-right ">
										<div class="box-input-text cf">
											<div class="box-btn">
												<a class="btn black">จัดเรียงลำดับ</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<div class="box-btn-main cf">
							<div class="box-btn">
								<a class="btn black" id="btnSubmit">บันทึก</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="box-freespace"></div>

		<?php
		include ('inc/inc-footer.php');
		?>
		<script type="text/javascript" src="js/account-museum-event.js"></script>
		<script type="text/javascript" src="assets/plugin/upload/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="assets/plugin//upload/jquery.fileupload.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/plugin/colorbox/colorbox.css" media="all" >
		<script type="text/javascript" src="assets/plugin/colorbox/jquery.colorbox-min.js"></script>
		<style  >
			.error, .error span {
				color: red !important;
				display: -webkit-box;
			}
		</style>
	</body>
</html>
