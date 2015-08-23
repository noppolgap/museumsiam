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
					<div class="floatL titleBox">แก้ไขรายการ</div>					
				</div>
				<div class="mod-body-main-content">
					
					<div class="formCms">

						<?php

							$id = $_GET['p'];
						    $sql= "SELECT * FROM trn_content_detail d join trn_content_category c
								  on d.CAT_ID = c.CONTENT_CAT_ID WHERE d.CONTENT_STATUS_FLAG <> 2 AND d.CONTENT_ID = ".$id." ";
							$query = mysql_query($sql,$conn);

						?>

						<form action="actionVirsualExhib.php?edit&p=<?=$id?>" method="post" name="formcms">
							<?php while($row = mysql_fetch_array($query)) { ?>
							<input type="hidden" name="cat_id" value="<? echo $row['CAT_ID']; ?>" class="w90p" />
							<div>
								<div class="floatL form_name">หมวดหมู่</div>
								<div class="floatL form_input"><input type="text" name="cat_name" value="<? echo $row['CONTENT_CAT_DESC_LOC'] ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ th</div>
								<div class="floatL form_input"><input type="text" name="name_th" value="<? echo $row['CONTENT_DESC_LOC'] ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">ชื่อ en</div>
								<div class="floatL form_input"><input type="text" name="name_en" value="<? echo $row['CONTENT_DESC_ENG'] ?>" class="w90p" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">วันที่เริ่ม</div>
								<div class="floatL form_input"><input type="text" name="start" value="<? echo $row['EVENT_START_DATE'] ?>" class="DatetimePicker" /></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">วันที่สิ้นสุด</div>
								<div class="floatL form_input"><input type="text" name="end" value="<? echo $row['EVENT_END_DATE'] ?>" class="DatetimePicker" /></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ TH</div>
								<div class="floatL form_input"><textarea name="brief_name_th" class="mytextarea2 w90p"><? echo $row['BRIEF_LOC'] ?></textarea></div>
								<div class="clear"></div>
							</div>
							<div>
								<div class="floatL form_name">รายละเอียดย่อ EN</div>
								<div class="floatL form_input"><textarea name="brief_name_en" class="mytextarea2 w90p"><? echo $row['BRIEF_ENG'] ?></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input"><textarea name="detail" class="mytextarea2 w90p"><? echo $row['CONTENT_DESC_ENG'] ?></textarea></div>
								<div class="clear"></div>
							</div>
							<div class="bigForm">
								<div class="floatL form_name">Image</div>
								<div class="floatL form_input"><?=admin_upload_image_edit('photo',5,$_GET['p'])?></div>
								<div class="clear"></div>
							</div>		
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href ='viewVirsualExhib.php?p=<?=$row['CAT_ID']?>' ">
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
<? require('../inc_footer.php'); ?>		
<link rel="stylesheet" type="text/css" href="../../assets/font/ThaiSans-Neue/font.css" media="all" >
<link rel="stylesheet" type="text/css" href="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.css" media="all" >
<link rel="stylesheet" type="text/css" href="../master/style.css" media="all" />
<script type="text/javascript" src="../../assets/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../../assets/plugin/timepicker/jquery-ui-timepicker-addon.js"></script>	
<script type="text/javascript" src="../../assets/plugin//upload/jquery.fileupload.js"></script>
<script type="text/javascript" src="../master/script.js"></script>	
<? logs_access('admin','hello'); ?>	
</body>
</html>
