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
					<div class="floatL titleBox">เพิ่มรายการ</div>
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">
						<form action="action.php" method="post" name="formcms">
							<div>
								<div class="floatL form_name">ชื่อ</div>
								<div class="floatL form_input"><input type="text" name="name" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายการ</div>
								<div class="floatL form_input"><input type="text" name="name" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายการ</div>
								<div class="floatL form_input"><input type="text" name="name" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายการ</div>
								<div class="floatL form_input"><input type="text" name="name" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input"><textarea name="detail" class="mytextarea w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">วันที่เริ่ม</div>
								<div class="floatL form_input"><input type="text" name="start" value="" class="DatePicker" /></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">วันที่จบ</div>
								<div class="floatL form_input"><input type="text" name="end" value="" class="DatetimePicker" /></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo') ?></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Video</div>
								<div class="floatL form_input"><? $uploadvideo = admin_upload_video('gallery','all'); echo $uploadvideo[0]; $formUploadVideo .= $uploadvideo[1];  ?></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Video</div>
								<div class="floatL form_input"><? $uploadvideo = admin_upload_video('photo','video'); echo $uploadvideo[0]; $formUploadVideo .= $uploadvideo[1];  ?></div>
								<div class="clear"></div>
							</div>
							<div class="btn_action">
								<input type="hidden" name="action" value="add">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
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
<div class="dNone"><?=$formUploadVideo?></div>
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="../master/script.js"></script>
<? logs_access('admin', 'hello'); ?>
</body>
</html>
