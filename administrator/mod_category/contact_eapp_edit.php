<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
require ("../../inc/inc-cat-id-conf.php");
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
		$MID = $_GET['MID'];
		$id = $_GET['conid'];

		$CID = $_GET['cid'];
		$LV = $_GET['LV'];
		$SCID = $_GET['SCID'];
		$subfixAddAndEdit = '&cid=' . $CID . '&LV=' . $LV;
		if (isset($SCID) && nvl($SCID, '0') != '0') {
			$subfixAddAndEdit .= '&SCID=' . $SCID;
		}

		$navigateBackPage = '';
		$navigateBackPage = 'content_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV;
		if (nvl($SCID, '0') != '0')
			$navigateBackPage .= '&SCID=' . $SCID;

		$sql = "SELECT cd.*
										,cc.CONTENT_CAT_DESC_ENG
										,cc.CONTENT_CAT_DESC_LOC
										,cc.IS_LAST_NODE
										,sc.SUB_CONTENT_CAT_DESC_ENG
										,sc.SUB_CONTENT_CAT_DESC_LOC
									FROM trn_content_detail cd
									LEFT JOIN trn_content_category cc ON cc.CONTENT_CAT_ID = cd.CAT_ID
									LEFT OUTER JOIN trn_content_sub_category sc ON sc.SUB_CONTENT_CAT_ID = cd.SUB_CAT_ID";
									
									if($MID == $contact_us){
										$sql .= " where cd.CONTENT_STATUS_FLAG =  2 " ;
									}else{
										$sql .= " where cd.CONTENT_STATUS_FLAG <>  2 " ;
									}
									
									$sql .= "	AND cd.CONTENT_ID = $id ";
		$query = mysql_query($sql, $conn);
						?>

		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">แก้ไขเนื้อหา</div>
				</div>
				<div class="mod-body-main-content">
				<? while($row = mysql_fetch_array($query)) {  
							/*
							?>
							
					<div class="imageMain marginC"><img src="<?=callThumbList($id, $row['CAT_ID'], true) ?>" /></div>
							<? */ ?>
					<div class="formCms">


						<form action="../../e-application-action.php?edit&conid=<?=$id ?>&MID=<?=$MID . $subfixAddAndEdit ?>" method="post" name="formcms">

							
							<div>
								<div class="floatL form_name">SPECIFY TYPE OF JOB ONTERESTED</div>
								<div class="floatL form_input"><input type="text" name="jobname" id ="jobname" value="<?=$row["CONTENT_DESC_LOC"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "jobname" style="display:none">กรุณาระบุ SPECIFY TYPE OF JOB ONTERESTED</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">ชื่อ นามสกุล</div>
								<div class="floatL form_input"><input type="text" name="name_th" id ="name_th" value="<?=$row["CONTENT_DESC_LOC"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "name_th" style="display:none">กรุณาระบุชื่อ นามสกุล</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">NAME (ENGLISH LANGUAGE)</div>
								<div class="floatL form_input"><input type="text" name="name_eng" id="name_eng" value="<?=$row["CONTENT_DESC_ENG"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "name_eng" style="display:none">กรุณาระบุNAME (ENGLISH LANGUAGE)</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">เพศ</div>
								<? 
									$check = "";
									if($row["CONTENT_DESC_ENG"] == "male"){
										$check = "checked";
									}
									else{
										$check = "checked";
									}
								?>
								<div class="box-input-text radio">
									<div><input type="radio" name="sex" class="floatL" value="male" <?=$check?> >ชาย</div>
									<div><input type="radio" name="sex" class="floatL" value="female" <?=$check?> >หญิง</div>
								</div>
								<span class="error" style="display:none">* <span id = "sex" style="display:none">กรุณาระบุเพศ</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">วันที่เริ่ม</div>
								<div class="floatL form_input"><input type="text" name="txtStartDate" id="txtStartDate" value="<?=ConvertDate($row['EVENT_START_DATE']) ?>" class="DatePicker" /></div>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">NATAIONLITY (สัญชาติ)</div>
								<div class="floatL form_input"><input type="text" name="nationality" id ="nationality" value="<?=$row["CONTENT_DETAIL_ENG"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "nationality" style="display:none">กรุณาระบุสัญชาติ</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">เบอร์โทรศัพท์</div>
								<div class="floatL form_input"><input type="text" name="telephone" id ="telephone" value="<?=$row["BRIEF_LOC"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "telephone" style="display:none">กรุณาระบุเบอร์โทรศัพท์</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">อีเมล</div>
								<div class="floatL form_input"><input type="text" name="email" id ="email" value="<?=$row["PLACE_DESC_ENG"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "email" style="display:none">กรุณาระบุอีเมล</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">เบอร์โทรศัพท์มือถือ</div>
								<div class="floatL form_input"><input type="text" name="mobile" id ="mobile" value="<?=$row["BRIEF_ENG"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "mobile" style="display:none">กรุณาระบุเบอร์โทรศัพท์มือถือ</span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">PRESENT ADDRESS</div>
								<div class="floatL form_input"><input type="address" name="address" id ="address" value="<?=$row["PLACE_DESC_LOC"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "address" style="display:none">กรุณาระบุ Address</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">SALARY DESIRED</div>
								<div class="floatL form_input"><input type="address" name="salary" id ="salary" value="<?=$row["LON"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "salary" style="display:none">กรุณาระบุ salary</span> </span>
								<div class="clear"></div>
							</div>

<? /*

							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image_edit('photo', $row['CAT_ID'], $id) ?></div>
								<div class="clear"></div>
							</div>

<div class="bigForm">
								<div class="floatL form_name">Video</div>
								<div class="floatL form_input"><? $uploadvideo = admin_edit_video('video', $id, $row['CAT_ID'], 'video');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Sound</div>
								<div class="floatL form_input"><? $uploadvideo = admin_edit_video('voice', $id, $row['CAT_ID'], 'sound');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Other File</div>
								<div class="floatL form_input"><? $uploadvideo = admin_edit_video('other', $id, $row['CAT_ID'], 'all');
									echo $uploadvideo[0];
									$formUploadVideo .= $uploadvideo[1];
  ?></div>
								<div class="clear"></div>
							</div>
							<? */ } ?>

							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?= $navigateBackPage ?>' ">
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

		$('#cmbCategory').bind('change', function() {

			if ($('#cmbCategory :selected').attr('data-isLastNode') == 'N') {
				$.post('content_action.php', {
					catID : $('#cmbCategory :selected').val()
				}).done(function(data) {
					$('#divSubCat').show();
					$('#divSubCatCmbZone').html(data);
					//console.log('done : ' + data) ;
				});
			} else {
				$('#divSubCat').hide();
				$('#divSubCatCmbZone').html('');
			}
		});

	});

	function onValidate() {
		var ret = true;
		$('#categoryError').hide();
		$('#subCategoryError').hide();
		$('#nameThError').hide();
		$('#nameEnError').hide();
		$('#briefThError').hide();
		$('#briefEnError').hide();
		$('#detailThError').hide();
		$('#detailEnError').hide();

		if ($('#cmbCategory :selected').val() == '-1') {
			ret = false;
			$('#categoryError').show();
		}

		if ($('#cmbCategory :selected').attr('data-isLastNode') == 'N') {
			if ($('#cmbSubCategory :selected').val() == '-1') {
				ret = false;
				$('#subCategoryError').show();
			}
		}

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
