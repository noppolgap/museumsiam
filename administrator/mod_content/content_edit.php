<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('../inc_meta.php'); ?>		
</head>

<body>
<? require('../inc_header.php'); ?>		
<div class="main-container">
	<div class="main-body marginC">
		<? require('../inc_side.php'); ?>
		<div class="mod-body">
			<div class="mod-body-inner">
				<div class="mod-body-inner-header">
					<div class="floatL titleBox">แก้ไขเนื้อหา</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">
						<? $id = $_GET['conid']; ?>
						<?php
							   $sql= "SELECT * FROM trn_digital_ach d join trn_sub_digital_ach s 
										 on d.SUB_DIGITAL_ID = s.SUB_DIGITAL_ID WHERE s.FLAG <> 2 AND d.DIGITAL_ID = $id";
							   $query = mysql_query($sql,$conn);
						?>

						<form action="digital_action.php?edit&p=<?=$id?>" method="post" name="formcms">

						<? while($row = mysql_fetch_array($query)) {  ?>
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<input type="hidden" name="sub_id" value="<? echo $_GET['g']; ?>" class="w90p" />
								<input type="hidden" name="digi_id" value="<? echo $_GET['p']; ?>" class="w90p" />
									<div class="floatL form_input"><input type="text" name="sub_digi_id"  class="w90p" value="<? echo $row['SUB_DIGITAL_DESC_LOC']; ?>" />
								</div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="name_th" value="<? echo $row['DIGITAL_DESC_LOC']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="name_en" value="<? echo $row['DIGITAL_DESC_ENG']; ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="brief_name_th" class="mytextarea2 w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="brief_name_en" class="mytextarea2 w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input"><textarea name="detail" value="<? echo $row['DETAIL']; ?>" class="mytextarea w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo')?></div>
								<div class="clear"></div>
							</div>	

							<?}?>

							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'digital_view.php?p=<?=$_GET['g']?>' ">
							</div>
						</form> 
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>	
	</div>
</div>	
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/colorbox/colorbox.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/upload/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
