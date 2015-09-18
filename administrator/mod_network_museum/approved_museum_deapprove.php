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
				<?php
				$MUID = $_GET['MUID'];

				$sql = "SELECT md.*
				,district.DISTRICT_DESC_LOC
				,district.DISTRICT_DESC_ENG
				,subDistrict.SUB_DISTRICT_DESC_LOC
				,subDistrict.SUB_DISTRICT_DESC_ENG
				,province.PROVINCE_DESC_LOC
				,province.PROVINCE_DESC_ENG
			FROM trn_museum_detail md
			INNER JOIN mas_district district ON district.DISTRICT_ID = md.DISTRICT_ID
			INNER JOIN mas_sub_district subDistrict ON subDistrict.SUB_DISTRICT_ID = md.SUB_DISTRICT_ID
			INNER JOIN mas_province province ON province.PROVINCE_ID = md.PROVINCE_ID
			WHERE MUSEUM_DETAIL_ID = $MUID";

				$rs = mysql_query($sql) or die(mysql_error());
				?>
				<div class="mod-body">
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								อนุมัติพิพิธภัฑณ์เครือข่าย
							</div>
						</div>
						<div class="mod-body-main-content">
							<div class="formCms">

								<form action="museum_network_action.php?deapprove&MUID=<?=$MUID ?>" method="post" name="formcms">

									<? while($rowMuseum = mysql_fetch_array($rs)) {
									?>

									<div >
										<div class="floatL form_name">
											ชื่อพิพิธภัณฑ์ภาษาไทย
										</div>
										<div class="floatL form_input">
											<input id = "txtNameLoc" type="text" name="txtNameLoc"   class="w90p"  value="<?php echo $rowMuseum['MUSEUM_NAME_LOC']?>" />
											
										</div>
										<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									ชื่อพิพิธภัณฑ์ภาษาอังกฤษ
									</div>
									<div class="floatL form_input">
									<input  id = "txtNameEng" type="text" name="txtNameEng" value="<?php echo $rowMuseum['MUSEUM_NAME_ENG']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>

									<div>
									<div class="floatL form_name">
									ชื่อพิพิธิภัฑณ์ที่ใช้แสดง
									</div>
									<div class="floatL form_input">
									<input  id = "txtDisplayName" type="text" name="txtDisplayName" value="<?php echo $rowMuseum['MUSEUM_DISPLAY_NAME']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>

									<div  class="bigForm">
									<div class="floatL form_name">
									ที่อยู่
									</div>
									<div class="floatL form_input">
									<textarea id= "txtAddress" name="txtAddress" class="w90p mytextarea2"><?php echo $rowMuseum['ADDRESS1']?>
									</textarea>
									
									</div>
									<div class="clear"></div>
									</div>

									<div>
									<div class="floatL form_name">
									จังหวัด
									</div>
									<div class="floatL form_input">

									<input id = "txtProvince" type="text" name="txtProvince"   class="w90p"  value="<?php echo $rowMuseum['PROVINCE_DESC_LOC']?>" />
									
									</div>
									<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									อำเภอ
									</div>
									<div class="floatL form_input">
									<input id = "txtDistrict" type="text" name="txtDistrict"   class="w90p"  value="<?php echo $rowMuseum['DISTRICT_DESC_LOC']?>" />
									
									</div>
									<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									ตำบล
									</div>
									<div class="floatL form_input">
									<input id = "txtSubDistrict" type="text" name="txtSubDistrict"   class="w90p"  value="<?php echo $rowMuseum['SUB_DISTRICT_DESC_LOC']?>" />
									
									</div>
									<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									รหัสไปรษณีย์
									</div>
									<div class="floatL form_input">
									<input  id = "txtPostCode" type="text" name="txtPostCode" value="<?php echo $rowMuseum['POST_CODE']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									โทรศัพท์
									</div>
									<div class="floatL form_input">
									<input  id = "txtTelephone" type="text" name="txtTelephone" value="<?php echo $rowMuseum['TELEPHONE']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>

<div>
									<div class="floatL form_name">
									โทรศัพท์เคลื่อนที่
									</div>
									<div class="floatL form_input">
									<input  id = "txtMobilephone" type="text" name="txtMobilephone" value="<?php echo $rowMuseum['MOBILE_PHONE']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>
									
									<div>
									<div class="floatL form_name">
									แฟ็กซ์
									</div>
									<div class="floatL form_input">
									<input  id = "txtFax" type="txtFax" name="txtMobilephone" value="<?php echo $rowMuseum['FAX']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>
									
									<div>
									<div class="floatL form_name">
									Email
									</div>
									<div class="floatL form_input">
									<input  id = "txtEmail" type="text" name="txtEmail" value="<?php echo $rowMuseum['EMAIL']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>

									<div  class="bigForm">
									<div class="floatL form_name">
									คำอธิบายพิพิธภัณฑ์ภาษาไทย
									</div>
									<div class="floatL form_input">
									<textarea id= "txtDetailLoc" name="txtDetailLoc" class="w90p mytextarea2"><?php echo $rowMuseum['DESCRIPT_LOC']?>
										</textarea>
									
									</div>
									<div class="clear"></div>
									</div>

									<div  class="bigForm">
									<div class="floatL form_name">
									คำอธิบายพิพิธภัณฑ์ภาษาอังกฤษ
									</div>
									<div class="floatL form_input">
									<textarea id= "txtDetailEng" name="txtDetailEng" class="w90p mytextarea2"><?php echo $rowMuseum['DESCRIPT_ENG']?>
										</textarea>
									
									</div>
									<div class="clear"></div>
									</div>

									<div>
									<div class="floatL form_name">
									พิกัดละติจูด
									</div>
									<div class="floatL form_input">
									<input  id = "txtLat" type="text" name="txtLat" value="<?php echo $rowMuseum['LAT']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>
									<div>
									<div class="floatL form_name">
									พิกัดลองติจูด
									</div>
									<div class="floatL form_input">
									<input  id = "txtLon" type="text" name="txtLon" value="<?php echo $rowMuseum['LON']?>" class="w90p" />
									
									</div>
									<div class="clear"></div>
									</div>

									<?} ?>

									<div class="btn_action">
										<input type="submit" value="ยกเลิกการอนุมัติ" class="buttonAction emerald-flat-button" onclick="return confirm('ต้องการยกเลิกการอนุมัติหรือไม่');">
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'approved_museum_view.php' ">
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
		
		 
	</body>
</html>
