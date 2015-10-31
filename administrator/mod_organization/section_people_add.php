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
		$secid = $_GET['secid'];
		$sectionSql = "select * from mas_section where section_id = " . $secid;
		$query = mysql_query($sectionSql, $conn);
		$row = mysql_fetch_array($query);
		$sectionName = $row['SECTION_DESC_LOC'];
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
								เพิ่มบุคคลากรฝ่าย <?=$sectionName ?> 
							</div>
						</div>
						<div class="mod-body-main-content">

							<div class="formCms">
								<form action="section_people_action.php?add&secid=<?=$secid?>" method="post" name="formcms">
									<div>
										<div class="floatL form_name">
											ชื่อ TH
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtNameLoc" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อ EN
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtNameEng" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง TH
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPositionLoc" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง EN
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPositionEng" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											โทรศัพท์
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPhone" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											Email
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtEmail" value="" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('USER_IMG') ?></div>
								<div class="clear"></div>
							</div>
									<div class="btn_action">
										<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
										<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'manage_people_section.php?secid=<?=$secid?>'">
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
		<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>
		<? logs_access('admin', 'hello'); ?>
	</body>
</html>
