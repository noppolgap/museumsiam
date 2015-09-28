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
						<form action="?" method="post" name="formcms">
							<div>
								<div class="floatL form_name">ชื่อ</div>
								<div class="floatL form_input"><input type="text" name="name" value="my name it musum siam" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div>
								<div class="floatL form_name">รายการ</div>
								<div class="floatL form_input"><input type="text" name="name" value="นิทรรศการถาวร" class="w90p" /></div>
								<div class="clear"></div>
							</div>	
							<div class="bigForm">
								<div class="floatL form_name">รายละเอียด</div>
								<div class="floatL form_input"><textarea name="detail" class="mytextarea w90p">
นิทรรศการ “เรียงความประเทศไทย” เป็นการบอกเล่าถึงพัฒนาการด้านต่างๆ ของภูมิภาคอุษาคเนย์ นับตั้งแต่สมัยแผ่นดิน “สุวรรณภูมิ” (3,000 ปีก่อน) อันประกอบด้วยอารยธรรมต่างๆ ก่อนการรับวัฒนธรรมจากอินเดียและจีน เรื่อยมาจนถึงกำเนิดสยามประเทศและก้าวสู่ประเทศไทยในปัจจุบัน โดยแบ่งการนำเสนอออกเป็น 3 ช่วง ดังนี้

ช่วงที่ 1 “สุวรรณภูมิ”
นำเสนอเรื่องราวของดินแดนสุวรรณภูมิและประเทศไทยในปัจจุบัน ย้อนกลับไปราว 3,000 ปีก่อนการรับพุทธศาสนาและศาสนาฮินดูเข้ามา จนกระทั่งกลายเป็นศาสนาหลักจนถึงปัจจุบัน

ช่วงที่ 2 “สยามประเทศไทย”
นำเสนอเรื่องราวการสถาปนากรุงศรีอยุธยา ซึ่งถือเป็นอาณาจักรใหญ่ที่ครอบคลุมดินแดนที่เป็นประเทศไทยในปัจจุบันเกือบทั้งหมด อีกทั้งยังเป็นจุดเปลี่ยนผ่านสำคัญในการกำเนิดขึ้นของ “สยามประเทศไทย”

ช่วงที่ 3 “ประเทศไทย”
นำเสนอพัฒนาการของดินแดน ผู้คน และสังคมจากแบบจารีตมาสู่สังคมสมัยใหม่ในปัจจุบัน

ทั้ง 3 ช่วงดังกล่าว นำเสนอโดยอธิบายลึกลงไปถึงรายละเอียด ผ่านห้องนิทรรศการจำนวน 17 ห้อง ซึ่งแต่ละห้องมีรายละเอียดสังเขปดังต่อไปนี้								
								</textarea></div>
								<div class="clear"></div>
							</div>	
							<div class="btn_action">
								<input type="submit" value="บันทึก" class="buttonAction emerald-flat-button">
								<input type="reset" value="ล้าง" class="buttonAction alizarin-flat-button">
								<input type="button" value="ย้อนกลับ" class="buttonAction peter-river-flat-button" onclick="window.location.href = 'index.php'">
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
