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
<link rel="stylesheet" type="text/css" href="css/shopping.css" />

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
				<li class="active">e-BOOKING</li>
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
							
			<div class="box-table-main">
				<div class="table-row head">
					<div class="column list">นิทรรศการ</div>
					<div class="column price">ราคา</div>
					<div class="column number">จำนวน</div>
					<div class="column total">มูลค่ารวม</div>
				</div>
				<div class="table-row list">
					<div class="column list cf">
						<div class="box-left">
							<div class="box-pic">
								<img src="http://placehold.it/194x147">
							</div>
						</div>
						<div class="box-right">
							<p class="text-title">New Look Embroidered Cami Top - Size M</p>
							<p class="text-detail">
								Top by New Look<br>
								- Lightweight wool-mix fabric<br>
								- Soft-touch finish<br>
								- All-over check design
							</p>
						</div>
					</div>
					<div class="column price">999,999</div>
					<div class="column number"><input type="number" name="number" value="1"></div>
					<div class="column total">999,999</div>
					<a href="#" class="btn-delete"><span class="bin"></span>ลบรายการสินค้า</a>
				</div>
			</div>
			
			<div class="box-total-main cf">
				<div class="box-btn box1 cf">
					<a class="btn red">คำนวณราคาใหม่</a>
				</div>
				<hr class="line-gray"/>
				<div class="box-row cf">
					<div class="box-left">
						มูลค่า
					</div>
					<div class="box-right">
						999,999 <span>บาท</span>
					</div>
				</div>
				<hr class="line-gray"/>
				
				<div class="box-row cf total">
					<div class="box-left">
						ยอดสุทธิ
					</div>
					<div class="box-right">
						999,999 <span>บาท</span>
					</div>
				</div>
				
				<div class="box-row cf box2">
					<div class="box-left">
						<div class="box-btn box1 cf">
							<a class="btn black">จองตั๋ว</a>
						</div>
					</div>
					<div class="box-right">
						<div class="box-btn box1 cf">
							<a class="btn red">ซื้อตั๋ว</a>
						</div>
					</div>
				</div>
				
			</div>
<!--
			<div class="box-btn-back">
				<div class="box-btn cf">
					<a href="e-shopping.php" class="btn red">ดูสินค้าเพิ่มเติม</a>
				</div>
			</div>
-->
			
		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
