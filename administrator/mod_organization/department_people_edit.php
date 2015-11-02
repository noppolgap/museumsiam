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
		$secid = $_GET['secid'];
		$orgid = $_GET['orgid'];
		$did = $_GET['did'];
		$departmentSql = "select * from mas_department where department_id = " . $did;
		$query = mysql_query($departmentSql, $conn);

		$num_rows = mysql_num_rows($query);

		$row = mysql_fetch_array($query);
		$departmentName = $row['DEPARTMENT_DESC_LOC'];
 ?>
		
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">	เพิ่มบุคคลากรแผนก <?=$departmentName ?></div>					
				</div>
				<div class="mod-body-main-content">
					<div class="formCms">
						 
						<form action="department_people_action.php?edit&secid=<?=$secid ?>&did=<?=$did ?>&orgid=<?=$orgid ?>" method="post" name="formcms">
							<?php
							$sql = "SELECT
					ORG_ID ,
					NAME_LOC,
					NAME_ENG,
					PHONE,
					EMAIL,
					IMG_PATH,
					POSITION_DESC_LOC,
					POSITION_DESC_ENG,
					CREATE_DATE,
					LAST_UPDATE_DATE
				FROM
					mas_org
				WHERE
					ORG_ID = " . $orgid;
							$rs = mysql_query($sql) or die(mysql_error());
		?>

							<div>

							   <? while($row = mysql_fetch_array($rs)) {  ?>
						
								<input type="hidden" name="txtOrgID" value="<? echo $row['ORG_ID']; ?>" class="w90p" />
								
							</div>	
							<div>
										<div class="floatL form_name">
											ชื่อ TH
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtNameLoc" value="<?=$row['NAME_LOC'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อ EN
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtNameEng" value="<?=$row['NAME_ENG'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง TH
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPositionLoc" value="<?=$row['POSITION_DESC_LOC'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง EN
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPositionEng" value="<?=$row['POSITION_DESC_ENG'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											โทรศัพท์
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtPhone" value="<?=$row['PHONE'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											Email
										</div>
										<div class="floatL form_input">
											<input type="text" name="txtEmail" value="<?=$row['EMAIL'] ?>" class="w90p" />
										</div>
										<div class="clear"></div>
									</div>
									<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_org_image_edit('USER_IMG', $row['IMG_PATH']) ?></div>
								<div class="clear"></div>
							</div>
								
							<?} ?>

							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'manage_people_section.php?secid=<?=$secid ?>' ">
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
