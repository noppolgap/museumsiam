<?php
require ("../../assets/configs/config.inc.php");
require ("../../assets/configs/connectdb.inc.php");
require ("../../assets/configs/function.inc.php");
require ("../../inc/inc-cat-id-conf.php");

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

				$CID = $_GET['cid'];
				$LV = $_GET['LV'];
				$SCID = $_GET['SCID'];
				$subfixAddAndEdit = '&cid=' . $CID . '&LV=' . $LV;
				if (isset($SCID) && nvl($SCID, '0') != '0') {
					$subfixAddAndEdit .= '&SCID=' . $SCID;
				}

				$navigateBackPage = '';
				$navigateBackPage = 'content_view.php?cid=' . $CID . '&MID=' . $MID . '&LV=' . $LV;
				if (nvl($SCID, '0') != '0')
					$navigateBackPage .= '&SCID=' . $SCID;

				$sql = "SELECT cd.*
										,cc.CONTENT_CAT_DESC_ENG
										,cc.CONTENT_CAT_DESC_LOC
										,cc.IS_LAST_NODE
										,sc.SUB_CONTENT_CAT_DESC_ENG
										,sc.SUB_CONTENT_CAT_DESC_LOC
									FROM trn_content_detail cd
									LEFT JOIN trn_content_category cc ON cc.CONTENT_CAT_ID = cd.CAT_ID
									LEFT OUTER JOIN trn_content_sub_category sc ON sc.SUB_CONTENT_CAT_ID = cd.SUB_CAT_ID";
									
									if($MID == $contact_us){
										$sql .= " where cd.CONTENT_STATUS_FLAG =  2 " ;
									}else{
										$sql .= " where cd.CONTENT_STATUS_FLAG <>  2 " ;
									}
										$sql .= "AND cd.CONTENT_ID = $id ";
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
							/*
							?>
							<div class="imageMain marginC"><img src="<?=callThumbList($id, $row['CAT_ID'], true) ?>" />
							</div>
							<? */ ?>
							<div class="formCms">

							<form action="" method="post" name="formcms">

							<div>
							<div class="floatL form_name">SPECIFY TYPE OF JOB ONTERESTED</div>
							<div class="floatL form_input">

							<?=$row['LAT'] ?>

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
								<div class="floatL form_input" id="divSubCatCmbZone" style="<?=$style ?>" >

									<?=$row['SUB_CONTENT_CAT_DESC_LOC'] ?>

								</div>

								<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">
									ชื่อ นามสกุล
								</div>
								<div class="floatL form_input">
									<?=$row["CONTENT_DESC_LOC"] ?>
								</div>

								<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">NAME (ENGLISH LANGUAGE)</div>
							<div class="floatL form_input"><?=$row["CONTENT_DESC_ENG"] ?> </div>

							<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">เพศ</div>
								<?
									$sex = "";
									if($row["CONTENT_DETAIL_LOC"] == "male"){
										$sex = "ชาย";
									}else{
										$sex = "หญิง";
									}
								?>
								<div class="floatL form_input"><?=$sex?></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">NATAIONLITY (สัญชาติ)</div>
								<div class="floatL form_input"><?=$row["CONTENT_DETAIL_ENG"] ?></div>
								<div class="clear"></div>
							</div>
							<div>
							<div class="floatL form_name">เบอร์โทรศัพท์</div>
							<div class="floatL form_input"><?=$row["BRIEF_LOC"] ?>

							</div>

							<div class="clear"></div>
							</div>

							<div>
								<div class="floatL form_name">วันเกิด</div>
								<div class="floatL form_input">
									
									
									<?php
									echo ConvertDate($row['EVENT_START_DATE']);
									
									?>
									</select>
									</div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">อีเมล</div>
								<div class="floatL form_input"><?=$row["PLACE_DESC_ENG"] ?></div>

								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">เบอร์โทรศัพท์มือถือ</div>
								<div class="floatL form_input"><?=$row["BRIEF_ENG"] ?></div>

								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">PRESENT ADDRESS</div>
								<div class="floatL form_input"><?=$row["PLACE_DESC_LOC"] ?></div>

								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">SALARY DESIRED</div>
								<div class="floatL form_input"><?=$row["LON"] ?></div>

								<div class="clear"></div>
							</div>

<?php
	$Sql_file = 'SELECT * FROM trn_content_picture WHERE CONTENT_ID = '.$id;
	$query_file = mysql_query($Sql_file, $conn);
	while($row_file = mysql_fetch_array($query_file)) {
		$fileRow[$row_file['IMG_NAME']] = '../../'.$row_file['IMG_PATH'];
	}
?>
						<? if (isset($fileRow['MyPhotograph'])) { ?>
							<div>
								<div class="floatL form_name">PHOTOGRAPH</div>
								<div class="floatL form_input"><a href="<?=$fileRow['MyPhotograph']?>" target="_blank">Download</a></div>

								<div class="clear"></div>
							</div>
						<?php
							}
							 if (isset($fileRow['MyResume'])) {
						?>	
							<div>
								<div class="floatL form_name">RESUME</div>
								<div class="floatL form_input"><a href="<?=$fileRow['MyResume']?>" target="_blank">Download</a></div>

								<div class="clear"></div>
							</div>
						<?php
							}
							 if (isset($fileRow['MyApplication'])) {
						?>	
							<div>
								<div class="floatL form_name">APPLICATION FORM</div>
								<div class="floatL form_input"><a href="<?=$fileRow['MyApplication']?>" target="_blank">Download</a></div>

								<div class="clear"></div>
							</div>
						<? } ?>	
<? /*
							<div class="bigForm">
							<div class="floatL form_name">PHOTOGRAPH</div>
							<div class="floatL form_input"><?=admin_upload_image_view('photo', $row['CAT_ID'], $id) ?>

							</div>
							<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">RESUME</div>
								<div class="floatL form_input"><?=admin_view_video($id, $row['CAT_ID'], 'video') ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">APPLICATION FORM</div>
								<div class="floatL form_input"><?=admin_view_video($id, $row['CAT_ID'], 'voice') ?></div>
								<div class="clear"></div>
							</div>

							<div class="bigForm">
								<div class="floatL form_name">Other File</div>
								<div class="floatL form_input"><?=admin_view_video($id, $row['CAT_ID'], 'other') ?></div>
								<div class="clear"></div>
							</div>
*/ ?>
							<? } ?>

							<div class="btn_action">

							<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = '<?= $navigateBackPage ?>' ">
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
			.form_name{
				width: 250px;
			}
			.form_input{
				width: 450px;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {

				tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
			});

		</script>
	</body>
</html>
