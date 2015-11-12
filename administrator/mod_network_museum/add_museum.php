<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
$indexPage = "/administrator/mod_museum_map/index.php";
?>
<!doctype html>
<html>
	<head>
		<?
		require ('../inc_meta.php');
		?>
		<link rel="stylesheet" type="text/css" href="../../css/form.css" />
		<link rel="stylesheet" type="text/css" href="../../css/account.css" />
		<link rel="stylesheet" type="text/css" href="../../css/account-detail.css" />
		<link rel="stylesheet" type="text/css" href="../../css/account-museum.css" />
		<script type="text/javascript">
			$(document).ready(function() {
				$('#cmbProvince').val('-1');

				defaultDistrict();
				defaultSubDistrict();

				$('#cmbProvince').bind('change', function() {
					defaultDistrict();
					$('#cmbDistrict [data-ref="' + $('#cmbProvince').val() + '"]').show();

					defaultSubDistrict();
				});

				$('#cmbDistrict').bind('change', function() {
					defaultSubDistrict();
					$('#cmbSubDistrict [data-ref="' + $('#cmbDistrict').val() + '"]').show();

				});
			});

			function defaultSubDistrict() {
				$('#cmbSubDistrict').val('-1');
				$('#cmbSubDistrict option').hide();
				$('#cmbSubDistrict [value="-1"]').show();
			}

			function defaultDistrict() {
				$('#cmbDistrict').val('-1');
				$('#cmbDistrict option').hide();
				$('#cmbDistrict [value="-1"]').show();
			}

			function onValidate() {
				var ret = true;
				$('#nameLocError').hide();
				$('#nameEngError').hide();
				$('#displayNameError').hide();
				$('#addressError').hide();
				$('#provinceError').hide();
				$('#districtError').hide();
				$('#subDistrictError').hide();
				$('#postCodeError').hide();
				$('#telephoneError').hide();
				$('#emailError').hide();
				$('#detailLocError').hide();
				$('#detailEngError').hide();
				$('#latError').hide();
				$('#lonError').hide();

				if ($('#txtNameLoc').val() == '') {
					$('#nameLocError').show();
					ret = false;
				}
				if ($('#txtNameEng').val() == '') {
					$('#nameEngError').show();
					ret = false;
				}
				if ($('#txtDisplayName').val() == '') {
					$('#displayNameError').show();
					ret = false;
				}
				if ($('#txtAddress').val() == '') {
					$('#addressError').show();
					ret = false;
				}
				if ($('#txtAddressEng').val() == '') {
					$('#addressEngError').show();
					ret = false;
				}

				if ($('#cmbProvince').val() == '-1') {
					$('#provinceError').show();
					ret = false;
				}
				if ($('#cmbDistrict').val() == '-1') {
					$('#districtError').show();
					ret = false;
				}
				if ($('#cmbSubDistrict').val() == '-1') {
					$('#subDistrictError').show();
					ret = false;
				}
				if ($('#txtPostCode').val() == '') {
					$('#postCodeError').show();
					ret = false;
				}
				if ($('#txtTelephone').val() == '') {
					$('#telephoneError').show();
					ret = false;
				}

				if ($('#txtEmail').val() == '') {
					$('#emailError').show();
					ret = false;
				}
				if ($('#txtDetailLoc').val() == '') {
					$('#detailLocError').show();
					ret = false;
				}
				if ($('#txtDetailEng').val() == '') {
					$('#detailEngError').show();
					ret = false;
				}

				if (ret) {
					document.getElementById("frmcms").submit();
				}
			}

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

		<div class="main-container">
			<div class="main-body marginC">
				<?
				require ('../inc_side.php');
				?>

				<div class="mod-body">

					<div class="buttonActionBox">
						<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'all_museum_view.php'">
					</div>
					<div class="mod-body-main-content">
						<iframe width="100%"  height = "580px"  src ="<?=_FULL_SITE_PATH_ ?>/add-museum-detail.php"></iframe>
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

			$txtNameLoc = $_POST['txtNameLoc'];
			$txtNameEng = $_POST['txtNameEng'];

			$txtDisplayName = $_POST['txtDisplayName'];
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

			$strSQL = "INSERT INTO trn_museum_detail ";
			$strSQL .= "(MUSEUM_NAME_LOC,MUSEUM_NAME_ENG , MUSEUM_DISPLAY_NAME , ADDRESS1 ,DISTRICT_ID , SUB_DISTRICT_ID ";
			$strSQL .= " , PROVINCE_ID , POST_CODE ,TELEPHONE , EMAIL, LAT , LON  , DESCRIPT_LOC  , DESCRIPT_ENG ";
			$strSQL .= " , USER_CREATE , CREATE_DATE , LAST_FUNCTION , IS_GIS_MUSEUM ) ";

			$strSQL .= "VALUES ";
			$strSQL .= "('" . $txtNameLoc . "','" . $txtNameEng . "', '" . $txtDisplayName . "' ,'" . $txtAddress . "' , '" . $district . "' , '" . $subDistrict . "'";
			$strSQL .= " , '" . $province . "' , '" . $txtPostCode . "' , '" . $txtTelephone . "' , '" . $txtEmail . "' , '" . $txtLat . "' ,'" . $txtLon . "' ";
			$strSQL .= " , '" . $txtDetailLoc . "' , '" . $txtDetailEng . "' , 'admin' , now() , 'A' , 'N' )";
			$objQuery = mysql_query($strSQL);

			if ($objQuery) {
				echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . $indexPage . "';</script>";
			} else {
				echo "Error Save [" . $strSQL . "]";
			}
		}
		?>
	</body>
</html>

