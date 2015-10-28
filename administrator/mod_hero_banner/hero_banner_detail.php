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
								รายละเอียดBanner
							</div>
						</div>
						<div class="mod-body-main-content">
							<div class="imageMain marginC"><img src="<?=callHeroBannerThumbList( true) ?>" />
							</div>
							<div class="formCms">

								<form action="" method="post" name="formcms">

									<div class="bigForm">
										<div class="floatL form_name">
											Image (1263 x 500)
										</div>
										<div class="floatL form_input">
											<?=admin_upload_hero_banner_view('hero_banner') ?>
										</div>
										<div class="clear"></div>
									</div>

									<div class="btn_action">

										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'hero_banner_view.php'  ">
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
		<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
		<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
		<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>
		<? logs_access('admin', 'hello'); ?>

		<style  >
			.error, .error span {
				color: red;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {

				tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
			});

		</script>
	</body>
</html>
