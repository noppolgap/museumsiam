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
		$(".menutop li.menu5,.menu-left li.menu2").addClass("active");		
	});
</script>
	
</head>

<body>
	
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
			</div>
			<div class="box-btn-cart">
				<a href="e-shopping-cart.php" class="btn-cart">ตะกร้าสินค้า 999</a>
			</div>

			<div class="box-booking-main">
				<div class="box-pic">
					<img src="http://placehold.it/880x565">
				</div>
				<div class="box-content-booking">
					<div class="box-top cf TcolorGold">
						<div class="box-text cf">
							<div class="box-left">
								อัตราค่าเข้าชม
							</div>
							<div class="box-right">
								<span>300</span> บาท/ท่าน
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>จำนวนผู้เข้าชม</p>
								<div><input type="number" name="number" value="1"></div>
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>รอบการเข้าชม</p>
								<div>
									<div class="SearchMenu-item">
										- เลือกรอบการเข้าชม -
										<select class="p-Absolute">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="box-text cf">
							<div class="box-left">
								ยอดสุทธิ
							</div>
							<div class="box-right">
								<span>-</span> บาท
							</div>
						</div>
						<div class="box-btn cf">
							<a href="e-booking-cart.php" class="btn red">ดำเนินการต่อ</a>
						</div>
						<hr class="line-gray"/>
					</div>
					<div class="box-detail">
						<p class="text-title">
							นิทรรศการ
							<span>“เรียงความประเทศไทย”</span>
						</p>
						<p class="text-des">
							เป็นการบอกเล่าถึงพัฒนาการด้านต่างๆ ของภูมิภาคอุษาคเนย์ นับตั้งแต่สมัยแผ่นดิน “สุวรรณภูมิ” (3,000 ปีก่อน)อันประกอบด้วยอารยธรรมต่างๆ
						</p>
					</div>
				</div>
			</div>		
			<div class="box-booking-main">
				<div class="box-pic">
					<img src="http://placehold.it/880x565">
				</div>
				<div class="box-content-booking">
					<div class="box-top cf TcolorGold">
						<div class="box-text cf">
							<div class="box-left">
								อัตราค่าเข้าชม
							</div>
							<div class="box-right">
								<span>300</span> บาท/ท่าน
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>จำนวนผู้เข้าชม</p>
								<div><input type="number" name="number" value="1"></div>
							</div>
						</div>
						<div class="box-row">
							<div class="box-input-text">
								<p>รอบการเข้าชม</p>
								<div>
									<div class="SearchMenu-item">
										- เลือกรอบการเข้าชม -
										<select class="p-Absolute">
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="box-text cf">
							<div class="box-left">
								ยอดสุทธิ
							</div>
							<div class="box-right">
								<span>-</span> บาท
							</div>
						</div>
						<div class="box-btn cf">
							<a href="e-booking-cart.php" class="btn red">ดำเนินการต่อ</a>
						</div>
						<hr class="line-gray"/>
					</div>
					<div class="box-detail">
						<p class="text-title">
							นิทรรศการ
							<span>“เรียงความประเทศไทย”</span>
						</p>
						<p class="text-des">
							เป็นการบอกเล่าถึงพัฒนาการด้านต่างๆ ของภูมิภาคอุษาคเนย์ นับตั้งแต่สมัยแผ่นดิน “สุวรรณภูมิ” (3,000 ปีก่อน)อันประกอบด้วยอารยธรรมต่างๆ
						</p>
					</div>
				</div>
			</div>			

		</div>
	</div>
</div>

<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
