<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
require ("../../inc/inc-cat-id-conf.php");

$MID = $_GET['MID'];
$CID = $_GET['cid'];
$LV = $_GET['LV'];
$SCID = $_GET['SCID'];
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
		<?

		$subfixAddAndEdit = '&cid=' . $CID . '&LV=' . $LV;
		if (isset($SCID) && nvl($SCID, '0') != '0') {
			$subfixAddAndEdit .= '&SCID=' . $SCID;
		}

		$navigateBackPage = '';

		$navigateBackPage = 'content_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV;

		if (nvl($SCID, '0') != '0')
			$navigateBackPage .= '&SCID=' . $SCID;
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มเนื้อหา</div>
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">



						<form action="content_action.php?add&MID=<?=$MID . $subfixAddAndEdit ?>" method="post" name="formcms">


							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" id ="txtDescLoc" value="" class="w90p" /></div>
								<span class="error" >* <span id = "nameThError" style="display:none">กรุณาระบุชื่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" id="txtDescEng" value="" class="w90p" /></div>
								<span class="error" >* <span id = "nameEnError" style="display:none">กรุณาระบุชื่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="txtBriefDescLoc" id = "txtBriefDescLoc" class="mytextarea2 w90p"></textarea></div>
								<span class="error" style="display:none">* <span id = "briefThError" style="display:none">กรุณาระบุรายละเอียดย่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="txtBriefDescEng" id="txtBriefDescEng" class="mytextarea2 w90p"></textarea></div>
								<span class="error"   style="display:none">* <span id = "briefEnError" style="display:none">กรุณาระบุรายละเอียดย่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด TH</div>
								<div class="floatL form_input"><textarea name="txtDetailLoc" id = "txtDetailLoc" value="" class="mytextarea w90p"></textarea></div>
								<span class="error" >* <span id = "detailThError" style="display:none">กรุณาระบุรายละเอียด TH</span> </span>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด EN</div>
								<div class="floatL form_input"><textarea name="txtDetailEng" id="txtDetailEng" value="" class="mytextarea w90p"></textarea></div>
								<span class="error" >* <span id = "detailEnError" style="display:none">กรุณาระบุรายละเอียด EN</span> </span>
								<div class="clear"></div>
							</div>

							<? if($MID == $new_and_event ) { ?>

								<div>
									<div class="floatL form_name">วันที่</div>
									<div class="floatL form_input"><input type="text" name="txtStartDate" id="txtStartDate" value="" class="DatePicker" /></div>
									<div class="clear"></div>
								</div>
								
							<? } else { ?>

								<div>
									<div class="floatL form_name">วันที่เริ่ม</div>
									<div class="floatL form_input"><input type="text" name="txtStartDate" id="txtStartDate" value="" class="DatePicker" /></div>
									<div class="clear"></div>
								</div>
								<div>
									<div class="floatL form_name">วันที่สิ้นสุด</div>
									<div class="floatL form_input"><input type="text" name="txtEndDate" id = "txtEndDate" value="" class="DatePicker" /></div>
									<div class="clear"></div>
								</div>
						   <? } ?>

							<div>
								<div class="floatL form_name">เวลาเริ่ม</div>
								<div class="floatL form_input">
									<select name="cmbHourStart">
									<?php
									for ($idx = 0; $idx < 24; $idx++) {
										if ($idx < 10)
											echo '<option value="0' . $idx . '">0' . $idx . '</option>';
										else
											echo '<option value="' . $idx . '">' . $idx . '</option>';
									}
									?>
									</select>
									: <select name="cmbMinuteStart">
									<?php
									for ($idx = 0; $idx < 60; $idx++) {
										if ($idx < 10)
											echo '<option value="0' . $idx . '">0' . $idx . '</option>';
										else
											echo '<option value="' . $idx . '">' . $idx . '</option>';
									}
									?>
									</select>
									</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">เวลาสิ้นสุด</div>
								<div class="floatL form_input">
									
									<select name="cmbHourEnd">
									<?php
									for ($idx = 0; $idx < 24; $idx++) {
										if ($idx < 10)
											echo '<option value="0' . $idx . '">0' . $idx . '</option>';
										else
											echo '<option value="' . $idx . '">' . $idx . '</option>';
									}
									?>
									</select>
									: <select name="cmbMinuteEnd">
									<?php
									for ($idx = 0; $idx < 60; $idx++) {
										if ($idx < 10)
											echo '<option value="0' . $idx . '">0' . $idx . '</option>';
										else
											echo '<option value="' . $idx . '">' . $idx . '</option>';
									}
									?>
									</select>
								</div>
								<div class="clear"></div>
							</div>
							
							<div>
									<div class="floatL form_name">ราคาเข้าชม (ไทย)</div>
									<div class="floatL form_input"><input type="text" name="txtPriceLoc" id = "txtPriceLoc" value=""  /></div>
									<div class="clear"></div>
								</div>
								
								<div>
									<div class="floatL form_name">ราคาเข้าชม (อังกฤษ)</div>
									<div class="floatL form_input"><input type="text" name="txtPriceEng" id = "txtPriceEng" value=""   /></div>
									<div class="clear"></div>
								</div>
								
							<div>
								<div class="floatL form_name">สถานที่ TH</div>
								<div class="floatL form_input"><input type="text" name="txtPlaceLoc" id="txtPlaceLoc" value="" class="w90p" /></div>
								<span class="error" ><span id = "placeThError" style="display:none">กรุณาระบุสถานที่ TH</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">สถานที่  EN</div>
								<div class="floatL form_input"><input type="text" name="txtPlaceEng" id="txtPlaceEng" value="" class="w90p" /></div>
								<span class="error" ><span id = "placeEnError" style="display:none">กรุณาระบุสถานที่ EN</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">Lattitude</div>
								<div class="floatL form_input"><input type="text" name="txtLat" id="txtLat" value="" class="w90p" /></div>
								<span class="error" ><span id = "lattitudeError" style="display:none">กรุณาระบุ Lattitude</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">Longtitude</div>
								<div class="floatL form_input"><input type="text" name="txtLon" id="txtLon" value="" class="w90p" /></div>
								<span class="error" ><span id = "lontitudeError" style="display:none">กรุณาระบุ Lontitude</span> </span>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo') ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Video</div>
								<div class="floatL form_input"><? $uploadvideo = admin_upload_video('video', 'video');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Sound</div>
								<div class="floatL form_input"><? $uploadvideo = admin_upload_video('voice', 'sound');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Other File</div>
								<div class="floatL form_input"><? $uploadvideo = admin_upload_video('other', 'all');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>


							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button" onclick="return onValidate();">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?=$navigateBackPage ?>' ">
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
 <div class="dNone"><?=$formUploadVideo ?></div>
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
		//divSubCatCmbZone  , divSubCat

	});

	function onValidate() {
		var ret = true;

		$('#nameThError').hide();
		$('#nameEnError').hide();
		$('#briefThError').hide();
		$('#briefEnError').hide();
		$('#detailThError').hide();
		$('#detailEnError').hide();

		if ($('#txtDescLoc').val() == '') {
			ret = false;
			$('#nameThError').show();
		}
		if ($('#txtDescEng').val() == '') {
			ret = false;
			$('#nameEnError').show();
		}

		if (tinyMCE.get('txtDetailLoc').getContent() == '') {
			ret = false;
			$('#detailThError').show();
		}
		if (tinyMCE.get('txtDetailEng').getContent() == '') {
			ret = false;
			$('#detailEnError').show();
		}
		if (ret) {
			document.getElementById("frmcms").submit();
		} else
			return false;

	}
</script>
 <style  >
	.error, .error span {
		color: red;
	}
    </style>
</body>
</html>
