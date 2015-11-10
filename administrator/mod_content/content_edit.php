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
		<?
		$MID = $_GET['MID'];
		$id = $_GET['conid'];
		$sql = "SELECT cd.*
										,cc.CONTENT_CAT_DESC_ENG
										,cc.CONTENT_CAT_DESC_LOC
										,cc.IS_LAST_NODE
										,sc.SUB_CONTENT_CAT_DESC_ENG
										,sc.SUB_CONTENT_CAT_DESC_LOC
									FROM trn_content_detail cd
									LEFT JOIN trn_content_category cc ON cc.CONTENT_CAT_ID = cd.CAT_ID
									LEFT OUTER JOIN trn_content_sub_category sc ON sc.SUB_CONTENT_CAT_ID = cd.SUB_CAT_ID
									WHERE cd.CONTENT_STATUS_FLAG <> 2
										AND cd.CONTENT_ID = $id ";
		$query = mysql_query($sql, $conn);
						?>

		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">แก้ไขเนื้อหา</div>
				</div>
				<div class="mod-body-main-content">
				<? while($row = mysql_fetch_array($query)) {  ?>
					<div class="imageMain marginC"><img src="<?=callThumbList($id, $row['CAT_ID'], true) ?>" /></div>
					<div class="formCms">


						<form action="content_action.php?edit&conid=<?=$id ?>&MID=<?=$MID ?>" method="post" name="formcms">


							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<div class="floatL form_input">
									<?
									$catSql = "select cc.CONTENT_CAT_ID , cc.CONTENT_CAT_DESC_LOC , cc.CONTENT_CAT_DESC_ENG
													, cc.IS_LAST_NODE  from trn_content_category cc
													where cc.REF_MODULE_ID = $MID and cc.flag <> 2
													ORDER BY cc.ORDER_DATA  desc  ";
									$catQuery = mysql_query($catSql, $conn);

									echo "<select id='cmbCategory' name = 'cmbCategory'>";
									echo "<option value='-1'>กรุณาเลือกหมวดหมู่</option>";
									while ($rowCat = mysql_fetch_array($catQuery)) {
										if ($row["CAT_ID"] == $rowCat["CONTENT_CAT_ID"])
											echo "<option value='" . $rowCat["CONTENT_CAT_ID"] . "' data-isLastNode ='" . $rowCat["IS_LAST_NODE"] . "' selected >" . $rowCat["CONTENT_CAT_DESC_LOC"] . "</option>";
										else
											echo "<option value='" . $rowCat["CONTENT_CAT_ID"] . "' data-isLastNode ='" . $rowCat["IS_LAST_NODE"] . "' >" . $rowCat["CONTENT_CAT_DESC_LOC"] . "</option>";
									}mysql_free_result($catQuery);
									echo "</select>";
									?>
								<span class="error" >* <span id = "categoryError" style="display:none">กรุณาเลือกหมวดหมู่ </span> </span>
								</div>
								<div class="clear"></div>
							</div>
							<?
							$style = "display:none";
							if ($row["IS_LAST_NODE"] == "N") {
								$style = "display:block";
							}
							?>
							<div id = "divSubCat" style="<?=$style ?>">
								<div class="floatL form_name">หมวดหมู่ย่อย</div>
								<div class="floatL form_input" id="divSubCatCmbZone">
								<?
								if ($row["IS_LAST_NODE"] == "N") {

									$subCatSql = "select sc.SUB_CONTENT_CAT_ID , sc.SUB_CONTENT_CAT_DESC_LOC , sc.SUB_CONTENT_CAT_DESC_ENG
											   from trn_content_sub_category sc
											where sc.CONTENT_CAT_ID = '" . $row["SUB_CAT_ID"] . "' and sc.flag <> 2
											ORDER BY sc.ORDER_DATA  desc  ";

									$subCatQuery = mysql_query($subCatSql, $conn);

									echo "<select id='cmbSubCategory' name = 'cmbSubCategory'>";
									echo "<option value='-1'>กรุณาเลือกหมวดหมู่ย่อย</option>";
									while ($rowSubCat = mysql_fetch_array($subCatQuery)) {
										if ($row["SUB_CAT_ID"] == $rowSubCat["SUB_CONTENT_CAT_ID"])
											echo "<option value='" . $rowSubCat["SUB_CONTENT_CAT_ID"] . "' selected  >" . $rowSubCat["SUB_CONTENT_CAT_DESC_LOC"] . "</option>";
										else
											echo "<option value='" . $rowSubCat["SUB_CONTENT_CAT_ID"] . "'  >" . $rowSubCat["SUB_CONTENT_CAT_DESC_LOC"] . "</option>";
									}mysql_free_result($subCatQuery);
									echo "</select>";
								}
								?>
								</div>
								<span class="error" >* <span id = "subCategoryError" style="display:none">กรุณาเลือกหมวดหมู่ย่อย </span> </span>
								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" id ="txtDescLoc" value="<?=$row["CONTENT_DESC_LOC"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "nameThError" style="display:none">กรุณาระบุชื่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" id="txtDescEng" value="<?=$row["CONTENT_DESC_ENG"] ?>" class="w90p" /></div>
								<span class="error" >* <span id = "nameEnError" style="display:none">กรุณาระบุชื่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="txtBriefDescLoc" id = "txtBriefDescLoc" class="mytextarea2 w90p"><?=$row["BRIEF_LOC"] ?></textarea></div>
								<span class="error" style="display:none">* <span id = "briefThError" style="display:none">กรุณาระบุรายละเอียดย่อ TH</span> </span>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="txtBriefDescEng" id="txtBriefDescEng" class="mytextarea2 w90p"><?=$row["BRIEF_ENG"] ?></textarea></div>
								<span class="error"   style="display:none">* <span id = "briefEnError" style="display:none">กรุณาระบุรายละเอียดย่อ EN</span> </span>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด TH</div>
								<div class="floatL form_input"><textarea name="txtDetailLoc" id = "txtDetailLoc" value="" class="mytextarea w90p"><?=$row["CONTENT_DETAIL_LOC"] ?></textarea></div>
								<span class="error" >* <span id = "detailThError" style="display:none">กรุณาระบุรายละเอียด TH</span> </span>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด EN</div>
								<div class="floatL form_input"><textarea name="txtDetailEng" id="txtDetailEng" value="" class="mytextarea w90p"><?=$row["CONTENT_DETAIL_ENG"] ?></textarea></div>
								<span class="error" >* <span id = "detailEnError" style="display:none">กรุณาระบุรายละเอียด EN</span> </span>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image_edit('photo', $row['CAT_ID'], $id) ?></div>
								<div class="clear"></div>
							</div>

							<?} ?>

							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'content_view.php?MID=<?=$MID ?>' ">
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
