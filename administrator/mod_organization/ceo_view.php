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
					<div class="floatL titleBox">รายละเอียด CEO</div>
				</div>
				<?php 
						$ORGID = $_GET['orgid'];
											
		
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
					ORG_ID = ".$ORGID;
		$rs = mysql_query($sql) or die(mysql_error());
		 while($row = mysql_fetch_array($rs)) { 
		?>
				<div class="mod-body-main-content">
					
					<div class="imageMain marginC"><img src="<?=$row['IMG_PATH']?>" /></div>
							
					<div class="formCms">
						
						<form action="" method="post" name="formcms">
		
							<div>

							   

								<input type="hidden" name="txtOrgID" value="<? echo $row['ORG_ID']; ?>" class="w90p" />
								
							</div>	
							<div>
										<div class="floatL form_name">
											ชื่อ TH
										</div>
										<div class="floatL form_input">
											<?=$row['NAME_LOC']?> 
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											ชื่อ EN
										</div>
										<div class="floatL form_input">
											<?=$row['NAME_ENG']?>
										</div>
										<div class="clear"></div>
									</div>

									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง TH
										</div>
										<div class="floatL form_input">
											<?=$row['POSITION_DESC_LOC'] ?>
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											ชื่อตำแหน่ง EN
										</div>
										<div class="floatL form_input">
											<?=$row['POSITION_DESC_ENG']?>
										</div>
										<div class="clear"></div>
									</div>
									
									<div>
										<div class="floatL form_name">
											โทรศัพท์
										</div>
										<div class="floatL form_input">
											<?=$row['PHONE']?>
										</div>
										<div class="clear"></div>
									</div>
									<div>
										<div class="floatL form_name">
											Email
										</div>
										<div class="floatL form_input">
											<?=$row['EMAIL']?>
										</div>
										<div class="clear"></div>
									</div>
									<!-- <div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_org_image_view('USER_IMG', $row['IMG_PATH'])   ?></div>
								<div class="clear"></div>
							</div> -->

							<?} ?>

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
</body>
</html>
