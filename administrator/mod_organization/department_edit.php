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
							<div class="floatL titleBox">
								แก้ไขแผนก
							</div>
						</div>
						<div class="mod-body-main-content">
							<div class="formCms">
								<? $secid = $_GET['secid'];
								$depatmentId = $_GET['did'];
								?>
								<form action="department_action.php?edit&secid=<?=$secid ?>&did=<?=$depatmentId?>" method="post" name="formcms">
									<?php
									$sql = "select * from mas_department WHERE DEPARTMENT_ID = " . $depatmentId;
									$query = mysql_query($sql, $conn);
									?>
									<div>
										<? while($row = mysql_fetch_array($query)) {
										?>
									</div>

									<div>
								<div class="floatL form_name">ชื่อแผนก TH</div>
								<div class="floatL form_input"><input type="text" name="txtDescLoc" value="<?=$row['DEPARTMENT_DESC_LOC']?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อแผนก EN</div>
								<div class="floatL form_input"><input type="text" name="txtDescEng" value="<?=$row['DEPARTMENT_DESC_ENG']?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด TH</div>
								<div class="floatL form_input"><textarea name="txtDetailLoc" id = "txtDetailLoc"  class="mytextarea w90p"><?=$row['DEPARTMENT_BREIFT_LOC']?></textarea></div>
								<span class="error" >* <span id = "detailThError" style="display:none">กรุณาระบุรายละเอียด TH</span> </span>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด EN</div>
								<div class="floatL form_input"><textarea name="txtDetailEng" id="txtDetailEng"  class="mytextarea w90p"><?=$row['DEPARTMENT_BREIFT_ENG']?></textarea></div>
								<span class="error" >* <span id = "detailEnError" style="display:none">กรุณาระบุรายละเอียด EN</span> </span>
								<div class="clear"></div>
							</div> 

									<?} ?>

									<div class="btn_action">
										<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
										<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'main_department_view.php?secid=<?=$secid?>' ">
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
