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

				$MID = $_GET['MID'];
				$id = $_GET['conid'];
				$sql = "SELECT cd.*
										,cc.CONTENT_CAT_DESC_ENG
										,cc.CONTENT_CAT_DESC_LOC
										,cc.IS_LAST_NODE
										,sc.SUB_CONTENT_CAT_DESC_ENG
										,sc.SUB_CONTENT_CAT_DESC_LOC
									FROM trn_content_detail cd
									LEFT JOIN trn_content_category cc ON cc.CONTENT_CAT_ID = cd.CAT_ID
									LEFT OUTER JOIN trn_content_sub_category sc ON sc.SUB_CONTENT_CAT_ID = cd.SUB_CAT_ID
									WHERE cd.CONTENT_STATUS_FLAG <> 2
										AND cd.CONTENT_ID = $id ";
				$query = mysql_query($sql, $conn);
				//echo $sql;
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
							<div class="imageMain marginC"><img src="<?=callThumbList($id, $row['CAT_ID'], true) ?>" />
							</div>
							<div class="formCms">

							<form action="" method="post" name="formcms">

							<div>
							<div class="floatL form_name">หมวดหมู่</div>
							<div class="floatL form_input">

							<input type="text" name="txtCategory" id="txtCategory" value="<?=$row['CONTENT_CAT_DESC_LOC'] ?>" class="w90p" />

							</div>
							<div class="clear"></div>
							</div>
							<?
							$style = "display:none";
							if ($row["IS_LAST_NODE"] == "N") {
								$style = "display:block";
							}
							?>
							<div id = "divSubCat" style="<?=$style ?>">
								<div class="floatL form_name">
									หมวดหมู่ย่อย
								</div>
								<div class="floatL form_input" id="divSubCatCmbZone">

									<input type="text" name="txtSubCategory" id="txtSubCategory" style="<?=$style ?>" value="<?=$row['SUB_CONTENT_CAT_DESC_LOC'] ?>" class="w90p" />

								</div>

								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">
									ชื่อ TH
								</div>
								<div class="floatL form_input">
									<input type="text" name="txtDescLoc" id ="txtDescLoc" value="<?=$row["CONTENT_DESC_LOC"] ?>" class="w90p" />
								</div>

								<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">ชื่อ EN</div>
							<div class="floatL form_input"><input type="text" name="txtDescEng" id="txtDescEng" value="<?=$row["CONTENT_DESC_ENG"] ?>" class="w90p" /></div>

							<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">รายละเอียดย่อ TH</div>
							<div class="floatL form_input"><textarea name="txtBriefDescLoc" id = "txtBriefDescLoc" class="mytextarea2 w90p"><?=$row["BRIEF_LOC"] ?>

							</textarea></div>

							<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">รายละเอียดย่อ EN</div>
							<div class="floatL form_input"><textarea name="txtBriefDescEng" id="txtBriefDescEng" class="mytextarea2 w90p"><?=$row["BRIEF_ENG"] ?>

							</textarea></div>

							<div class="clear"></div>
							</div>
							<div class="bigForm">
							<div class="floatL form_name">รายละเอียด TH</div>
							<div class="floatL form_input"><textarea name="txtDetailLoc" id = "txtDetailLoc" value="" class="mytextarea w90p"><?=$row["CONTENT_DETAIL_LOC"] ?>

							</textarea></div>

							<div class="clear"></div>
							</div>

							<div class="bigForm">
							<div class="floatL form_name">รายละเอียด EN</div>
							<div class="floatL form_input"><textarea name="txtDetailEng" id="txtDetailEng" value="" class="mytextarea w90p"><?=$row["CONTENT_DETAIL_ENG"] ?>

							</textarea></div>

							<div class="clear"></div>
							</div>
							<div class="bigForm">
							<div class="floatL form_name">Image</div>
							<div class="floatL form_input"><?=admin_upload_image_view('photo', $row['CAT_ID'], $id) ?><
							/div>
							<div class="clear"></div>
							</div>

							<? } ?>

							<div class="btn_action">

							<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'content_view.php?MID=<?=$MID ?>' ">
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
	</body>
</html>
