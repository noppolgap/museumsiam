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

				$CMSID = $_GET['cmsid'];
				$cmsSql = " select * from trn_content_cms where CMS_ID = " . $CMSID;
				$query = mysql_query($cmsSql, $conn);
				?>

				<div class="mod-body">
					<div class="mod-body-inner">
						<div class="mod-body-inner-header">
							<div class="floatL titleBox">
								รายละเอียดเนื้อหา
							</div>
						</div>
						<div class="mod-body-main-content">
							<? while($row = mysql_fetch_array($query)) {
							?>
							 
							<div class="formCms">

							<form action="" method="post" name="formcms">

							 
							 
							 

							<div>
								<div class="floatL form_name">
									ชื่อ TH
								</div>
								<div class="floatL form_input">
									<?=$row["CMS_DESC_LOC"] ?>
								</div>

								<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">ชื่อ EN</div>
							<div class="floatL form_input"><?=$row["CMS_DESC_ENG"] ?>
							</div>

							<div class="clear"></div>
							</div>
							 
					 
							<div class="bigForm">
							<div class="floatL form_name">รายละเอียด TH</div>
							<div class="floatL form_input"><?=$row["CMS_TEXT_LOC"] ?>

							</div>

							<div class="clear"></div>
							</div>

							<div class="bigForm">
							<div class="floatL form_name">รายละเอียด EN</div>
							<div class="floatL form_input"><?=$row["CMS_TEXT_ENG"] ?>

							</div>

							<div class="clear"></div>
							</div>

							 

							<? } ?>

							<div class="btn_action">

							<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php' ">
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

		<style  >
			.error, .error span {
				color: red;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {

				tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
			});

		</script>
	</body>
</html>
