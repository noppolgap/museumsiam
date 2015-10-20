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
			$subModuleID = $_GET['SMID'];

			$sql = "SELECT sm.* , am.MODULE_NAME_LOC FROM sys_app_sub_module sm inner join sys_app_module am on sm.module_id = am.module_id where SUB_MODULE_ID = '" . $subModuleID . "' ";
			$rs = mysql_query($sql) or die(mysql_error());
			$rowModule = mysql_fetch_array($rs);

			$sql = "SELECT * FROM trn_banner_pic_setting where APP_SUB_MODULE_ID = '" . $subModuleID . "' order by LAST_UPDATE_DATE desc Limit 0,1 ";
			$rs = mysql_query($sql) or die(mysql_error());
			$rowBanner = mysql_fetch_array($rs);
			?>

			<div class="main-body marginC">
				<?
				require ('../inc_side.php');
				?>
				<div class="mod-body">
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								รายละเอียดระบบย่อย
							</div>
						</div>
						<div class="mod-body-main-content">

							<div class="formCms">
								<form action="?" method="post" name="formcms">

									<div >
										<div class="floatL form_name">
											ระบบหลัก
										</div>
										<div class="floatL form_input">
											<input id = "txtModuleDesc" type="text" name="txtModuleDesc"   class="w90p"  value="<?php echo $rowModule["MODULE_NAME_LOC"] ?>" />
											<span class="error" >* <span id = "moduleError" style="display:none">กรุณาระบุระบบหลัก </span> </span>
										</div>
										<div class="clear"></div>
									</div>

									<div >
										<div class="floatL form_name">
											ชื่อภาษาไทย
										</div>
										<div class="floatL form_input">
											<input id = "txtNameLoc" type="text" name="txtNameLoc"   class="w90p"  value="<?php echo $rowModule["SUB_MODULE_NAME_LOC"] ?>" />

										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อภาษาอังกฤษ
										</div>
										<div class="floatL form_input">
											<input  id = "txtNameEng" type="text" name="txtNameEng" value="<?php echo $rowModule["SUB_MODULE_NAME_ENG"] ?>" class="w90p" />

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
										<div class="floatL form_name">รูปภาพ Iconขนาดใหญ่ (ขนาด 209 x 218)</div>
										<div class="floatL form_input">
											<?=admin_upload_icon_image_view('BigIcon', 'BIG', NULL, $subModuleID) ?>
											</div>
										<div class="clear"></div>
									</div>	
									
									<!-- <div class="bigForm">
										<div class="floatL form_name">รูปภาพ Iconขนาดเล็ก</div>
										<div class="floatL form_input"><?=admin_upload_icon_image_view('SmallIcon', 'SMALL', NULL, $subModuleID) ?></div>
										<div class="clear"></div>
									</div>	 -->
										 
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
		
		<script type="text/javascript" src="../master/script.js"></script>
		
		<? logs_access('admin', 'hello'); ?>
	</body>
</html>
