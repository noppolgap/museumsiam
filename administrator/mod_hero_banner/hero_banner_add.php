<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
	<head>
		<?
		require ('../inc_meta.php');
		?>
	</head>

	<body>
		<?
		require ('../inc_header.php');
		?>
		<div class="main-container">
			<div class="main-body marginC">
				<?
				require ('../inc_side.php');
				?>

				<div class="mod-body">
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								เพิ่ม Hero Banner
							</div>
						</div>
						<div class="mod-body-main-content">
							 
							<div class="formCms" style="min-height: 500px;">

								<form action="hero_banner_action.php?add" method="post" name="formcms" enctype="multipart/form-data">

									<div>
										<div class="floatL form_name">
											URL Link ไทย
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtUrlTh" />
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											URL Link อังกฤษ
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtUrlEn" />
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											รูปภาพไทย (1920 x 500)
										</div>
										<div class="floatL form_input">

											<div class="box-input-text cf">
												<input type='file' name ="browseImgLoc" id ="browseImgLoc"  accept="image/*" />
											</div>

											<div class="thumbBoxEdit floatL p-Relative" id="img_'+res+'" data-id="'+index+'">
												<div class="thumbBoxImage">

													<div class="box-pic"><img id="imgImgLoc" >
														<input type="hidden" id = "hidImgLoc"  name = "hidImgLoc" value="" />
													</div>
													<div class="thumbBoxAction dNone p-Absolute">
														<a class="btn-delete deleteMap" data-id="ImgLoc"> <img alt="" src="../images/small-n-flat/sign-ban.svg" /> </a>
													</div>
												</div>

											</div>

										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											รูปภาพอังกฤษ (1920 x 500)
										</div>
										<div class="floatL form_input">

											<div class="box-input-text cf">
												<input type='file' name ="browseImgEng" id ="browseImgEng"  accept="image/*" />
											</div>

											<div class="thumbBoxEdit floatL p-Relative" id="img_'+res+'" data-id="'+index+'">
												<div class="thumbBoxImage">

													<div class="box-pic"><img id="imgImgEng" >
														<input type="hidden" id = "hidImgEng"  name = "hidImgEng" value="" />
													</div>
													<div class="thumbBoxAction dNone p-Absolute">
														<a class="btn-delete deleteMap" data-id="ImgEng"> <img alt="" src="../images/small-n-flat/sign-ban.svg" /> </a>
													</div>
												</div>

											</div>

										</div>
										<div class="clear"></div>
									</div>

									<div class="btn_action">
										<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'hero_banner_view.php' ">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?
		require ('../inc_footer.php');
		?>
		<div class="dNone">
			<?=$formUploadVideo ?>
		</div>
		<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
		<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
		<script type="text/javascript" src="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>
		<? logs_access('admin', 'hello'); ?>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.deleteMap').bind('click', function(e) {
					if (confirm('ต้องการลบรูปภาพหรือไม่?')) {
						$('#hid' + $(this).attr('data-id')).val('DEL');
						$('#img' + $(this).attr('data-id')).attr('src', '');
						e.preventDefault();
						e.stopPropagation();
					}
				});

				$("#browseImgEng").change(function() {
					if (this.files && this.files[0]) {
						var reader = new FileReader();
						reader.onload = imageIsLoadedImgEng;
						reader.readAsDataURL(this.files[0]);
					}
				});

				$("#browseImgLoc").change(function() {
					if (this.files && this.files[0]) {
						var reader = new FileReader();
						reader.onload = imageIsLoadedImgLoc;
						reader.readAsDataURL(this.files[0]);
					}
				});
			});

			function imageIsLoadedImgEng(e) {
				$('#imgImgEng').attr('src', e.target.result);
			};
			function imageIsLoadedImgLoc(e) {
				$('#imgImgLoc').attr('src', e.target.result);
			};
			function onValidate() {

			}
		</script>
		<style  >
			.error, .error span {
				color: red;
			}
		</style>
	</body>
</html>
