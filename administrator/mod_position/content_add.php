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

		$navigateBackPage = '../mod_category/content_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV;

		if (nvl($SCID, '0') != '0')
			$navigateBackPage .= '&SCID=' . $SCID;
		?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">เพิ่มเนื้อหา</div>
				</div>
				<div class="mod-body-main-content">
				
					<div class="formCms">



						<form action="content_action.php?add&MID=<?=$MID . $subfixAddAndEdit ?>" method="post" name="formcms">


							<div>
								<div class="floatL form_name">ตำแหน่งงาน TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" id ="txtDescLoc" value="" class="w90p" /></div>
								<span class="error" >* <span id = "nameThError" style="display:none">กรุณาระบุชื่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ตำแหน่งงาน EN</div>
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
							<div>
									<div class="floatL form_name">อัตรา (ไทย)</div>
									<div class="floatL form_input"><input type="text" name="txtPriceLoc" id = "txtPriceLoc" value=""  /></div>
									<div class="clear"></div>
								</div>
								
								<div>
									<div class="floatL form_name">อัตรา (อังกฤษ)</div>
									<div class="floatL form_input"><input type="text" name="txtPriceEng" id = "txtPriceEng" value=""   /></div>
									<div class="clear"></div>
								</div>
								
							<div>
 
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
