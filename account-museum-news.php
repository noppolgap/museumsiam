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
				$(".menu-left li.menu5,.menu-left li.menu5 li.submenu3").addClass("active");
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
							ข่าวสาร
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
			<form id = "frmcms" method="post" action="account-museum-news-action.php?add" >
				<div class="container cf">
					<div class="box-account-left">
						<?php
						include ('inc/inc-account-menu.php');
						?>
					</div>
					<div class="box-account-right cf">
						<div class="box-title">
							<h1>จัดการพิพิธภัณฑ์ - ข่าวสาร</h1>
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
											ชื่อข่าวสาร
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
											ชื่อข่าวสาร
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
											รายละเอียดย่อ
											<br>
											(ภาษาไทย)
										</p>
									</div>
									<div class="box-right">
										<div class="box-input-text">
											<div style="height: 120px;">
												<textarea   name="txtBriefDescLoc" id="txtBriefDescLoc"></textarea>
												<span class="error" style="display:none">* <span id = "briefThError" style="display:none">กรุณาระบุรายละเอียดย่อ TH</span> </span>
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
												<textarea   name="txtBriefDescEng" id="txtBriefDescEng"></textarea>
												<span class="error"   style="display:none">* <span id = "briefEnError" style="display:none">กรุณาระบุรายละเอียดย่อ EN</span> </span>
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
												<textarea  name="txtDetailLoc" id="txtDetailLoc" class="mytextarea w90p"></textarea>
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
												<textarea   name="txtDetailEng" id="txtDetailEng" class="mytextarea"></textarea>
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
												<a class="btn black" id = "btnBrowseNewPic">BROWSE</a>
											</div>
											<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
										</div>
										<?echo frontend_mdn_content_upload_image_edit('NEWS_PIC', -1, $all_event_cat_id); ?>
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
												<input type="text" name="txtYoutubeLink" id="txtYouTubeAdd">
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
												<a class="btn black" id = "btnYoutubeAdd" >เพิ่ม</a>
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
										<div class="box-input-text cf mT youtubePreview">
											
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
		<style  >
			.error, .error span {
				color: red !important;
			}
		</style>
		<script type="text/javascript" src="assets/plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="js/account-museum-news.js"></script>
		<script type="text/javascript" src="assets/plugin/upload/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="assets/plugin//upload/jquery.fileupload.js"></script>

		<link rel="stylesheet" type="text/css" href="assets/plugin/colorbox/colorbox.css" media="all" >
		<script type="text/javascript" src="assets/plugin/colorbox/jquery.colorbox-min.js"></script>
	</body>
</html>
