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

		<script type="text/javascript" src="../../assets/plugin/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {

			});

		</script>

		<style  >
			.error, .error span {
				color: red;
			}
		</style>
	</head>

	<body>
		<?
		require ('../inc_header.php');
		?>

		<?php
		$museumID = $_GET['MID'];

		$sql = "SELECT * FROM trn_museum_detail where MUSEUM_DETAIL_ID = '" . $museumID . "' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$rowMuseum = mysql_fetch_array($rs);
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
								กำหนดผู้ดูแลพิพิธภัณฑ์เครือข่าย
							</div>
						</div>
						<div class="mod-body-main-content">

							<div class="formCms">
								<form action="?" method="post" name="formcms" id = "frmcms" enctype="multipart/form-data">
									<div >
										<div class="floatL form_name">
											ชื่อพิพิธภัณฑ์ภาษาไทย
										</div>
										<div class="floatL form_input">
											<?php echo $rowMuseum['MUSEUM_NAME_LOC']?>
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											ที่อยู่ภาษาไทย
										</div>
										<div class="floatL form_input">
											<?php echo $rowMuseum['ADDRESS1']?>
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											ผู้ใช้งาน
										</div>
										<div class="floatL form_input">

											<select name="cmbUserName">
												<option value="-1" selected="">กรุณาเลือกผู้ใช้งานระบบ</option>
												
												<?
												$userNotAssignSql = ""
												?>
											</select>

										</div>
										<div class="clear"></div>
									</div>

									<div class="btn_action">
										<input type="button" name="save" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="onValidate()" >
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
									</div>
									<input type="hidden" name="action" value="submit" />
									<input type="hidden" name="MID" value="<?php echo $museumID?>"/>
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

		<script type="text/javascript" src="../master/script.js"></script>

		<? logs_access('admin', 'hello'); ?>

		<?php

		if (isset($_POST["action"]) && $_POST["action"] == "submit") {

			$mid = $_POST['MID'];
			$update = "";
			if (isset($_POST['hidMapEng'])) {
				if ($_POST['hidMapEng'] == 'DEL')
					$update[] = "MAP_IMG_PATH_ENG = ''";
			}
			if (isset($_POST['hidMapLoc'])) {
				if ($_POST['hidMapLoc'] == 'DEL')
					$update[] = "MAP_IMG_PATH_LOC = ''";
			}

			if (isset($_POST['hidParkingEng'])) {
				if ($_POST['hidParkingEng'] == 'DEL')
					$update[] = "PARKING_IMG_PATH_ENG = ''";
			}
			if (isset($_POST['hidParkingLoc'])) {
				if ($_POST['hidParkingLoc'] == 'DEL')
					$update[] = "PARKING_IMG_PATH_LOC = ''";
			}
			if (isset($_POST['hidTransportationEng'])) {
				if ($_POST['hidTransportationEng'] == 'DEL')
					$update[] = "TRANSPORTATION_IMG_PATH_ENG = ''";
			}
			if (isset($_POST['hidTransportationLoc'])) {
				if ($_POST['hidTransportationLoc'] == 'DEL')
					$update[] = "TRANSPORTATION_IMG_PATH_LOC = ''";
			}

			if (isset($_FILES['browseMapLoc'])) {
				if ($_FILES['browseMapLoc']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseMapLoc']);
					$update[] = "MAP_IMG_PATH_LOC = '" . $filename . "'";
				}
			}

			if (isset($_FILES['browseMapEng'])) {
				if ($_FILES['browseMapEng']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseMapEng']);
					$update[] = "MAP_IMG_PATH_ENG = '" . $filename . "'";
				}
			}

			if (isset($_FILES['browseParkingLoc'])) {
				if ($_FILES['browseParkingLoc']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseParkingLoc']);
					$update[] = "PARKING_IMG_PATH_LOC = '" . $filename . "'";
				}
			}

			if (isset($_FILES['browseParkingEng'])) {
				if ($_FILES['browseParkingEng']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseParkingEng']);
					$update[] = "PARKING_IMG_PATH_ENG = '" . $filename . "'";
				}
			}

			if (isset($_FILES['browseTransportationLoc'])) {
				if ($_FILES['browseTransportationLoc']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseTransportationLoc']);
					$update[] = "TRANSPORTATION_IMG_PATH_LOC = '" . $filename . "'";
				}
			}

			if (isset($_FILES['browseTransportationEng'])) {
				if ($_FILES['browseTransportationEng']["name"] != '') {
					$filename = backend_move_single_image_upload_dir('MUSEUM_' . $mid, $_FILES['browseTransportationEng']);
					$update[] = "TRANSPORTATION_IMG_PATH_ENG = '" . $filename . "'";
				}
			}

			$update[] = "ADDRESS2 = '" . $_POST['txtAddressEng"'] . "'";
			$update[] = "FAX = '" . $_POST['txtFax'] . "'";
			$txtNameLoc = $_POST['txtNameLoc'];
			$txtNameEng = $_POST['txtNameEng'];

			//$txtDisplayName = $_POST['txtDisplayName'];
			$txtAddress = $_POST['txtAddress'];
			$province = $_POST['cmbProvince'];
			$district = $_POST['cmbDistrict'];
			$subDistrict = $_POST['cmbSubDistrict'];
			$txtPostCode = $_POST['txtPostCode'];
			$txtTelephone = $_POST['txtTelephone'];
			$txtEmail = $_POST['txtEmail'];
			$txtLat = $_POST['txtLat'];
			$txtLon = $_POST['txtLon'];
			$txtDetailLoc = $_POST['txtDetailLoc'];
			$txtDetailEng = $_POST['txtDetailEng'];

			$strSQL = "update trn_museum_detail ";
			$strSQL .= "set MUSEUM_NAME_LOC = '" . $txtNameLoc . "'";
			$strSQL .= " ,MUSEUM_NAME_ENG = '" . $txtNameEng . "'";
			//	$strSQL .= " , MUSEUM_DISPLAY_NAME = '" . $txtDisplayName . "'";
			$strSQL .= " , ADDRESS1 = '" . $txtAddress . "'";
			$strSQL .= " ,DISTRICT_ID = '" . $district . "'";
			$strSQL .= " , SUB_DISTRICT_ID = '" . $subDistrict . "'";
			$strSQL .= " , PROVINCE_ID = '" . $province . "'";
			$strSQL .= " , POST_CODE = '" . $txtPostCode . "'";
			$strSQL .= " ,TELEPHONE = '" . $txtTelephone . "'";
			$strSQL .= " , EMAIL = '" . $txtEmail . "'";
			$strSQL .= " , LAT  = '" . $txtLat . "'";
			$strSQL .= " , LON  = '" . $txtLon . "'";
			$strSQL .= " , DESCRIPT_LOC   = '" . $txtDetailLoc . "'";
			$strSQL .= " , DESCRIPT_ENG = '" . $txtDetailEng . "' ";
			$strSQL .= " ,LAST_UPDATE_DATE = now() ";
			$strSQL .= " ,LAST_UPDATE_USER = 'Test'";
			$strSQL .= " ,LAST_FUNCTION = 'U'";
			$strSQL .= " where MUSEUM_DETAIL_ID = '" . $mid . "'";
			$objQuery = mysql_query($strSQL);

			$sql = "UPDATE trn_museum_detail SET  " . implode(",", $update) . " WHERE MUSEUM_DETAIL_ID = " . $mid;
			//	echo $sql;
			mysql_query($sql);

			$indexPage = "/administrator/mod_network_museum/editMuseum.php?MID=" . $mid;
			if ($objQuery) {

				echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . $indexPage . "';</script>";
			} else {

				echo "Error Save [" . $strSQL . "]";
			}

		}
		?>
	</body>
</html>
