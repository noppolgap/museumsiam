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
		<style  >
			.error, .error span {
				display: none;
			}
		</style>
	</head>

	<body>
		<?
		require ('../inc_header.php');
 ?>
		<div class="main-container">
			<?php
			$userID = $_GET['UID'];

			$sql = "SELECT * FROM sys_app_user where ID = '" . $userID . "' ";
			$rs = mysql_query($sql) or die(mysql_error());
			$rowUser = mysql_fetch_array($rs);
			?>

			<div class="main-body marginC">
				<?
				require ('../inc_side.php');
				?>
				<div class="mod-body">
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								รายละเอียด
							</div>
						</div>
						<div class="mod-body-main-content">

							<div class="formCms">
								<form action="?" method="post" name="formcms">

									<div >
										<div class="floatL form_name">
											Email
										</div>
										<div class="floatL form_input">
											<input id = "txtEmail" type="text" name="txtEmail"   class="w90p"  value="<?php echo $rowUser["USER_ID"] ?>" />
											<span class="error" >* <span id = "emailError" style="display:none">กรุณาระบุE-mail </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อ
										</div>
										<div class="floatL form_input">
											<input  id = "txtName" type="text" name="txtName" value="<?php echo $rowUser["NAME"] ?>" class="w90p" />
											<span class="error" >* <span id = "nameError" style="display:none">กรุณาระบุชื่อ </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											นามสกุล
										</div>
										<div class="floatL form_input">
											<input  id = "txtLastName" type="text" name="txtLastName" value="<?php echo $rowUser["LAST_NAME"] ?>" class="w90p" />
											<span class="error" >* <span id = "lastNameError" style="display:none">กรุณาระบุนามสกุล </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											เลขที่บัตรประชาชน
										</div>
										<div class="floatL form_input">
											<input  id = "txtCitizenID" type="text" name="txtCitizenID" value="<?php echo $rowUser["CITIZEN_ID"] ?>" class="w90p" />
											<span class="error" >* <span id = "citizenError" style="display:none">กรุณาระบุเลขที่บัตรประชาชน </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div  class="bigForm">
										<div class="floatL form_name">
											ที่อยู่
										</div>
										<div class="floatL form_input">
											<textarea id= "txtAddress" name="txtAddress" class="w90p mytextarea2"><?php echo $rowUser["ADDRESS1"] ?></textarea>
											<span class="error" >* <span id = "addressError" style="display:none">กรุณาระบุที่อยู่ </span> </span>
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											จังหวัด
										</div>
										<div class="floatL form_input">

											<?php
											$sql = "SELECT province_id  , province_desc_loc , province_desc_eng FROM mas_province where province_id = '" . $rowUser["PROVINCE_ID"] . "'";
											$rs = mysql_query($sql) or die(mysql_error());
											$provinceName = "";
											while ($row = mysql_fetch_array($rs)) {
												$provinceName = $row["province_desc_loc"];
											}mysql_free_result($rs);
											?>
											<input  id = "txtProvince" type="text" name="txtProvince" value="<?php echo  $provinceName  ?>" class="w90p" />
											<span class="error" >* <span id = "provinceError" style="display:none">กรุณาระบุจังหวัด </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											อำเภอ
										</div>
										<div class="floatL form_input">
											<?php
											connectdb();
											$sql = "SELECT district_id , province_id , district_desc_loc , district_desc_eng FROM mas_district where district_id = '" . $rowUser["DISTRICT_ID"] . "' ";
											$rs = mysql_query($sql) or die(mysql_error());
											$districtName = "";
											while ($row = mysql_fetch_array($rs)) {
												$districtName = $row["district_desc_loc"];

											}mysql_free_result($rs);
											?>
											<input  id = "txtDistrict" type="text" name="txtDistrict" value="<?php echo  $districtName  ?>" class="w90p" />
											<span class="error" >* <span id = "districtError" style="display:none">กรุณาระบุอำเภอ </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ตำบล
										</div>
										<div class="floatL form_input">
											<?php
											$subDistrictName = "";
											$sql = "SELECT sub_district_id , district_id , sub_district_desc_loc , sub_district_desc_eng FROM mas_sub_district where sub_district_id = '" . $rowUser["SUB_DISTRICT_ID"] . "'";
											$rs = mysql_query($sql) or die(mysql_error());

											while ($row = mysql_fetch_array($rs)) {
												$subDistrictName = $row["sub_district_desc_loc"];

											}mysql_free_result($rs);
											?>
											<input  id = "txtSubDistrict" type="text" name="txtSubDistrict" value="<?php echo  $subDistrictName  ?>" class="w90p" />
											<span class="error" >* <span id = "subDistrictError" style="display:none">กรุณาระบุตำบล </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											รหัสไปรษณีย์
										</div>
										<div class="floatL form_input">
											<input  id = "txtPostCode" type="text" name="txtPostCode" value="<?php echo $rowUser["POST_CODE"] ?>" class="w90p" />
											<span class="error" >* <span id = "postCodeError" style="display:none">กรุณาระบุรหัสไปรษณีย์ </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											โทรศัพท์
										</div>
										<div class="floatL form_input">
											<input  id = "txtTelephone" type="text" name="txtTelephone" value="<?php echo $rowUser["TELEPHONE"] ?>" class="w90p" />
											<span class="error" >* <span id = "telephoneError" style="display:none">กรุณาระบุเบอร์โทรศัพท์</span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div class="btn_action">
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
		<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
		<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
		<link rel="stylesheet" type="text/css" href="mod_cms.css" media="all" />
		<script type="text/javascript" src="../master/script.js"></script>
		<script type="text/javascript" src="mod_cms.js"></script>
		<? logs_access('admin', 'hello'); ?>
	</body>
</html>
