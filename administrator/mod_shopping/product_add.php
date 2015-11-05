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
						<? $id = $_GET['cid']; ?>
						<form action="product_action.php?add&MID=<?=$_GET['MID']?>&cid=<?=$id?>&LV=<?=$_GET['LV']?>" method="post" name="formcms">
							<?php
							$sql = "SELECT CONTENT_CAT_DESC_LOC FROM trn_content_category WHERE Flag <> 2 AND  REF_MODULE_ID = ".$_GET['MID']." AND CONTENT_CAT_ID = $id";
							$query = mysql_query($sql, $conn);
							?>
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<input type="hidden" name="cat_id" value="<? echo $id; ?>" class="w90p" />

								<? while($row = mysql_fetch_array($query)) {  ?>

									<div class="floatL form_input"><input type="text" name="cat_ids" readonly="readonly"  class="w90p" value="<? echo $row['CONTENT_CAT_DESC_LOC']; ?>" />

								<?} ?>

								</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input">
									<input type="text" name="product_name_th" id="product_name_th" value="" class="w90p" />
									<span class="error" >* <span id = "nameLocError" style="display:none">กรุณาระบุชื่อภาษาไทย </span> </span>
								</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input">
									<input type="text" name="product_name_en" id="product_name_en" value="" class="w90p" />
									<span class="error" >* <span id = "nameEngError" style="display:none">กรุณาระบุชื่อภาษาอังกฤษ </span> </span>
								</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ราคาเดิม</div>
								<div class="floatL form_input">
									<input type="text" name="price" id="input_price" value="" class="w90p" />
									<span class="error" >* <span id = "namePriceError" style="display:none">กรุณาระบุราคาเดิม </span> </span>
								</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ราคาลด</div>
								<div class="floatL form_input"><input type="text" name="sale" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">วันที่เริ่ม</div>
								<div class="floatL form_input"><input type="text" name="start" value="" class="DatetimePicker" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">วันที่สิ้นสุด</div>
								<div class="floatL form_input"><input type="text" name="end" value="" class="DatetimePicker" /></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="brief_name_th" class="mytextarea2 w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="brief_name_en" class="mytextarea2 w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input"><textarea name="detail" class="mytextarea w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo') ?></div>
								<div class="clear"></div>
							</div>
							<div class="btn_action">
								<input type="button" value="บันทึก" class="buttonAction emerald-flat-button" onclick="onValidate();">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'product_view.php?MID=<?=$_GET['MID']?>&cid=<?=$_GET['cid']?>&LV=<?=$_GET['LV']?>' ">
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
<link rel="stylesheet" type="text/css" href="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="../master/script.js"></script>
<? logs_access('admin', 'hello'); ?>
<script type="text/javascript">
function onValidate() {
	var ret = true;
	$('#nameLocError').hide();
	$('#nameEngError').hide();
	$('#namePriceError').hide();

				if ($('#product_name_th').val() == '') {
					$('#nameLocError').show();
					ret = false;
				}
				if ($('#product_name_en').val() == '') {
					$('#nameEngError').show();
					ret = false;
				}
				if ($('#input_price').val() == '') {
					$('#namePriceError').show();
					ret = false;
				}


	if (ret) {
		document.getElementById("frmcms").submit();
	}
}

</script>

<style>
.error, .error span {
	color: red;
}
</style>
</body>
</html>
