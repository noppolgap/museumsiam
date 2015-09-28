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
					
					<div class="formCms">
						<form action="main_digital_action.php?add" method="post" name="formcms">
							<div>
								<div class="floatL form_name">ชื่อ TH</div>
								<div class="floatL form_input"><input type="text" name="main-digital-th" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ En</div>
								<div class="floatL form_input"><input type="text" name="main-digital-en" value="" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
								
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'main_digital_view.php'">
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
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />

<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../master/script.js"></script>		
	
<? logs_access('admin','hello'); ?>	
</body>
</html>
