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
					<div class="floatL titleBox">เพิ่มรายการ</div>					
				</div>
				<div class="mod-body-main-content">
					<div class="imageMain marginC"><img src="../images/logo_thumb.jpg" /></div>
					<div class="formCms">
						<? $id = $_GET['g']; ?>
						<?php
							   $sql= "SELECT * FROM  trn_sub_digital_ach  WHERE FLAG <> 2 AND SUB_DIGITAL_ID = $id";
							   $query = mysql_query($sql,$conn);
						?>

						<form action="digital_action.php?add&p=<?=$id?>" method="post" name="formcms">
					
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<input type="hidden" name="sub_id" value="<? echo $id; ?>" class="w90p" />

								<? while($row = mysql_fetch_array($query)) {  ?>
									<div class="floatL form_input"><input type="text" name="digi_id"  class="w90p" value="<? echo $row['SUB_DIGITAL_DESC_LOC']; ?>" />
								
								<?}?>
								</div>
								<div class="clear"></div>
				
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="name_th" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">ชื่อ EN</div>
								<div class="floatL form_input"><input type="text" name="name_en" value="" class="w90p" /></div>
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
								<div class="floatL form_input"><textarea name="detail" value="" class="mytextarea w90p"></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image('photo')?></div>
								<div class="clear"></div>
							</div>	
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
