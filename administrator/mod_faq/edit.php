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
								แก้ไขรายการ
							</div>
						</div>
						<div class="mod-body-main-content">

							<div class="formCms">

								<?php

								$id = $_GET['qa_id'];
								$sql = "SELECT * FROM trn_qa WHERE FLAG <> 2  AND REF_QA_ID = 0 AND QA_ID = " . $id . " ";
								$query = mysql_query($sql, $conn);
								?>

								<form action="action.php?edit&qa_id=<?=$id ?>" method="post" name="formcms">
									<?php while($row = mysql_fetch_array($query)) {
									?>
									<div>
										<div class="floatL form_name">
											คำถาม
										</div>
										<div class="floatL form_input">
											<input type="text" name="question" value="<? echo $row['CONTENT'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>

									<div class="btn_action">
										<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
										<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
										<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
									</div>
									<? } ?>
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
		<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript" src="../master/script.js"></script>
		<script type="text/javascript" src="mod_cms.js"></script>
		<? logs_access('admin', 'hello'); ?>
	</body>
</html>
