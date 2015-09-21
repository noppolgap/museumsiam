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
<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/booking.css" />

<script>
	$(document).ready(function(){
		$(".menutop li.menu6,.menu-left li.menu3").addClass("active");		
	});
</script>
	
</head>

<body id="cart">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main"  id="firstbox">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ระบบอื่นๆ ที่เกี่ยวข้อง</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li><a href="#">ONLINE SYSTEM</a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">e-BOOKINNG</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-shopping.php'); ?>
			<?php include('inc/inc-left-content-calendar.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-BOOKING</h1>
				<div class="box-btn">
					<a href="e-booking.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>		

			<div class="box-finish-main">
				<div class="text-title">
					ยืนยันการจองตั๋ว
					<span>นิทรรศการ “เรียงความประเทศไทย” เรียบร้อยแล้ว</span>
				</div>
				<div class="box-code">
					รหัสยืนยัน : <span>XXXXXXXX</span>
				</div>
				<hr class="line-gray"/>
				<div class="box-table-detail">
					<div class="box-row head">
						<div class="column">ราคา</div>
						<div class="column">จำนวน</div>
						<div class="column">รอบการเข้าชม</div>
						<div class="column">มูลค่ารวม</div>
					</div>
					<div class="box-row">
						<div class="column">999,999</div>
						<div class="column">999,999</div>
						<div class="column">วันที่ 7 ส.ค.2558<br>เวลา 14.00น.</div>
						<div class="column">999,999</div>
					</div>
				</div>
			</div>
			
			<div class="box-confident">
				<p>
					<span>กรณีผู้ที่ทำรายการสั่งจองไปรับบัตรตัวตนเอง</span>
					1. ยื่นเอกสารใบยืนยันการสั่งจอง<br>
					2. แสดงบัตรประชาชน ของผู้ที่ทำรายการสั่งจอง
				</p>
			</div>
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
