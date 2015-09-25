<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/template.css" />
<link rel="stylesheet" type="text/css" href="css/km.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu2").addClass("active");
	});
</script>
	
</head>

<body id="km">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="other-system.php">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="km.php">ระบบการจัดการความรู้</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">เว็บบอร์ด</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-km.php'); ?>
		</div>
		<div class="box-right main-content">
			
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>เว็บบอร์ด</h1>
				<div class="box-btn">
					<a href="#" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			<div class="box-create-topic-main cf">
				<div class="box-row cf  disible">
					<div class="box-left">
						<p>ชื่อ</p>
					</div>
					<div class="box-right">
						<p>ชื่อ และ นามสกุล</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						หัวข้อ<span>*</span>
					</div>
					<div class="box-right">
						<input type="text">
					</div>
				</div>
				<div class="box-plugin-text cf">
					Plugin Text Editer
				</div>
				<div class="condition">
					<p>
					<span>ข้อตกลง</span>
						ขอสงวนสิทธิ์ในการตรวจสอบข้อความก่อนแสดงบนหน้าเว็บและใช้ดุลพินิจที่จะลบกระทู้ใดๆ ที่มีข้อความที่ไม่เหมาะสม ไม่สุภาพหรือพาดพิงถึงลุคคลใดๆ ในการเสื่อมเสีย
					</p>
				</div>
				<div class="box-btn submit cf">
					<a href="#" class="btn red">ตั้งกระทู้</a>
					<a href="#" class="btn red">ลบ</a>
				</div>
				
			</div>
			<div class="box-pagination-main cf">
				<div class="box-btn topic">
					<a href="#" class="btn red">ย้อนกลับ</a>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
