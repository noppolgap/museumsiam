<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
$indexPage = "/administrator/mod_module/index.php";
?>
<!doctype html>
<html>
	<head>
		<?
		require ('../inc_meta.php');
		?>

		<script type="text/javascript">
			$(document).ready(function() {

			});

			function onValidate() {
				var ret = true;
				$('#nameLocError').hide();
				$('#nameEngError').hide();

				if ($('#txtNameLoc').val() == '') {
					$('#nameLocError').show();
					ret = false;
				}
				if ($('#txtNameEng').val() == '') {
					$('#nameEngError').show();
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

		<?php
		$moduleID = $_GET['MID'];

		$sql = "SELECT * FROM sys_app_module where MODULE_ID = '" . $moduleID . "' ";
		$rs = mysql_query($sql) or die(mysql_error());
		$rowModule = mysql_fetch_array($rs);

		$sql = "SELECT * FROM trn_banner_pic_setting where APP_MODULE_ID = '" . $moduleID . "' order by LAST_UPDATE_DATE desc Limit 0,1 ";
		$rs = mysql_query($sql) or die(mysql_error());
		$rowBanner = mysql_fetch_array($rs);

		$bannerID = $rowBanner['BANNER_ID'];
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
								แก้ไขระบบ
							</div>
						</div>
						<div class="mod-body-main-content">
							<!--<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>-->
							<div class="formCms">
								<form action="?" method="post" name="formcms" id = "frmcms" >
									<div >
										<div class="floatL form_name">
											ชื่อภาษาไทย
										</div>
										<div class="floatL form_input">
											<input id = "txtNameLoc" type="text" name="txtNameLoc"   class="w90p"  value="<?php echo $rowModule["MODULE_NAME_LOC"] ?>" />
											<span class="error" >* <span id = "nameLocError" style="display:none">กรุณาระบุชื่อภาษาไทย </span> </span>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อภาษาอังกฤษ
										</div>
										<div class="floatL form_input">
											<input  id = "txtNameEng" type="text" name="txtNameEng" value="<?php echo $rowModule["MODULE_NAME_ENG"] ?>" class="w90p" />
											<span class="error" >* <span id = "nameEngError" style="display:none">กรุณาระบุชื่อภาษาอังกฤษ </span> </span>
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											URL
										</div>
										<div class="floatL form_input">
											<input  id = "txtUrlLink" type="text" name="txtUrlLink" value="<?php echo $rowBanner['ICON_LINK'] ?>" class="w90p" />
											<span class="error" >* <span id = "urlError" style="display:none">กรุณาระบุ URL</span> </span>
										</div>
										<div class="clear"></div>
									</div>

									<div class="bigForm">
										<div class="floatL form_name">รูปภาพ Iconขนาดใหญ่</div>
										<div class="floatL form_input">
											<?=admin_upload_icon_edit('BigIcon', 'BIG', $moduleID, NULL) ?>
											</div>
										<div class="clear"></div>
									</div>	
									
									<div class="bigForm">
										<div class="floatL form_name">รูปภาพ Iconขนาดเล็ก</div>
										<div class="floatL form_input"><?=admin_upload_icon_edit('SmallIcon', 'SMALL', $moduleID, NULL) ?></div>
										<div class="clear"></div>
									</div>	

									<div>
										<div class="floatL form_name">
											&nbsp;&nbsp;
										</div>
										<div class="floatL form_input">
											<?php
											if ($rowModule['IS_LAST_NODE'] == "Y")
												echo "<input  id = 'chkHasSubModule' type='checkbox' name='chkHasSubModule' >&nbsp;มีระบบย่อย</input> ";
											else
												echo "<input  id = 'chkHasSubModule' type='checkbox' name='chkHasSubModule' checked >&nbsp;มีระบบย่อย</input> ";
											?>
										</div>
										<div class="clear"></div>
									</div>
							</div>

							<div class="btn_action">
								<input type="button" name="save" value="บันทึก" class="buttonAction emerald-flat-button"  onclick="onValidate()" >
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
							</div>
							<input type="hidden" name="action" value="submit" />
							<input type="hidden" name="MID" value="<?php echo $moduleID?>"/>
							<input type="hidden" name="bannerID" value="<?php echo $bannerID?>"/>
							<input type="hidden" name="lastestBigIcon" value="<?php echo $rowBanner["DESKTOP_ICON_PATH"]; ?>"/>
							<input type="hidden" name="lastestSmallIcon" value="<?php echo $rowBanner["MOBILE_ICON_PATH"]; ?>"/>
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
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
		<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>

		<? logs_access('admin', 'hello'); ?>

		<?php

		if (isset($_POST["action"]) && $_POST["action"] == "submit") {
			$mid = $_POST['MID'];
			$bannerID = $_POST['bannerID'];
			$txtNameLoc = $_POST['txtNameLoc'];
			$txtNameEng = $_POST['txtNameEng'];

			$txtUrlLink = $_POST['txtUrlLink'];
			$txtImg = $_POST['txtImg'];
			$chkHasSubModule = $_POST['chkHasSubModule'];

			$isLastNode = "";
			if ($chkHasSubModule)
				$isLastNode = "N";
			else
				$isLastNode = "Y";

			mysql_query("BEGIN");

			$strSQL = "update sys_app_module ";
			$strSQL .= "set MODULE_NAME_LOC = '" . $txtNameLoc . "'";
			$strSQL .= " ,MODULE_NAME_ENG = '" . $txtNameEng . "'";
			$strSQL .= " ,LAST_UPDATE_DATE = now() ";
			$strSQL .= " ,LAST_UPDATE_USER = 'Test'";
			$strSQL .= " ,LAST_FUNCTION = 'U'";
			$strSQL .= " ,IS_LAST_NODE = '" . $isLastNode . "'";
			$strSQL .= " where MODULE_ID = '" . $mid . "'";
			$objQueryAppModule = mysql_query($strSQL);

			$bigIconName = $_POST['lastestBigIcon'];
			$smallIconName = $_POST['lastestSmallIcon'];

			if (count($_POST['BigIcon_file']) > 0) {
				foreach ($_POST['BigIcon_file'] as $k => $file) {
					$bigIconName = admin_move_image_upload_dir('icon_files', end(explode('/', $file)), 1000, '', false, 150, 150);
				}
			}
			if (count($_POST['SmallIcon_file']) > 0) {
				foreach ($_POST['SmallIcon_file'] as $k => $file) {
					$smallIconName = admin_move_image_upload_dir('icon_files', end(explode('/', $file)), 1000, '', false, 150, 150);
				}
			}

			if ($bannerID == '') {
				$strSQL = "INSERT INTO trn_banner_pic_setting ";
				$strSQL .= "(APP_MODULE_ID,DESKTOP_ICON_PATH , MOBILE_ICON_PATH,ICON_LINK ,USER_CREATE , CREATE_DATE , LAST_FUNCTION) ";
				$strSQL .= " values ";
				$strSQL .= "('" . $mid . "','" . $bigIconName . "','" . $smallIconName . "','" . $txtUrlLink . "' , 'Test' , now() , 'A')";

			} else {
				$strSQL = "update trn_banner_pic_setting ";
				$strSQL .= "set DESKTOP_ICON_PATH = '" . $bigIconName . "'";
				$strSQL .= " , MOBILE_ICON_PATH = '" . $smallIconName . "'";
				$strSQL .= " , APP_MODULE_ID = '" . $mid . "'";
				$strSQL .= " ,ICON_LINK = '" . $txtUrlLink . "'";
				$strSQL .= " ,LAST_UPDATE_DATE = now() ";
				$strSQL .= " ,LAST_UPDATE_USER = 'Test'";
				$strSQL .= " ,LAST_FUNCTION = 'U'";
				$strSQL .= " where BANNER_ID = '" . $bannerID . "'";
			}
			$objQueryBannerSetting = mysql_query($strSQL);
			if (($objQueryAppModule) and ($objQueryBannerSetting)) {
				mysql_query("COMMIT");
				echo "<script type='text/javascript'>window.location.href = '" . _FULL_SITE_PATH_ . $indexPage . "';</script>";
			} else {
				mysql_query("ROLLBACK");
				echo "Error Save [" . $strSQL . "]";
			}

		}
		?>
	</body>
</html>
