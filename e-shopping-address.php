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
				<li class="active">e-SHOPPING</li>
			</ol>
		</div>
	</div>
</div>

<div class="box-freespace"></div>

<div class="part-main">
	<div class="container cf">
		<div class="box-left main-content">
			<?php include('inc/inc-left-content-shopping.php'); ?>
		</div>
		<div class="box-right main-content">
			<hr class="line-red"/>
			<div class="box-title-system cf">
				<h1>e-SHOPPING</h1>
				<div class="box-btn">
					<a href="e-shopping.php" class="btn red">ย้อนกลับ</a>
				</div>
			</div>		
			<div class="box-address-main">
				<div class="box-title">
					ยืนยันการสั่งซื้อ
				</div>
				<div class="box-form-address-main">
					<div class="text-title">ที่อยู่ในการจัดส่งสินค้า</div>
					
					<div class="box-group group1">
						<input type="radio" name="address" value="address1" checked>
						<p class="">
							ชมพูนุช ซัน<br>
							96 เอกพัฒนาอพาทเมนต์ ห้อง 810 ซ.ลาดพร้าว26<br>
							แขวงลาดยาว เขตจตุจักร<br>
							กรุงเทพฯ 10200
						</p>
					</div>
					<hr class="line-gray"/>
					<div class="box-group group1">
						<input type="radio" name="address" value="address2">
						<p class="deactive">
							ชมพูนุช ซัน<br>
							96 เอกพัฒนาอพาทเมนต์ ห้อง 810 ซ.ลาดพร้าว26<br>
							แขวงลาดยาว เขตจตุจักร<br>
							กรุงเทพฯ 10200
						</p>
					</div>
					<hr class="line-gray"/>
					<div class="box-group form">
						<input type="radio" name="address" value="address_new" >
						<div class="box-form">
							
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ชื่อ-นามสกุล*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><input type="text" ></div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ที่อยู่*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><textarea></textarea></div>
									</div>
								</div>
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>จังหวัด*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item">
												เลือกจังหวัด
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
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>ตำบล/แขวง*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item">
												เลือกตำบล/แขวง
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
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>อำเภอ/เขต*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div>
											<div class="SearchMenu-item">
												เลือกอำเภอ/เขต
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
							</div>
							<div class="box-row cf">
								<div class="box-left">
									<div class="box-input-text">
										<p>รหัสไฟรษณีย์*</p>
									</div>
								</div>
								<div class="box-right">
									<div class="box-input-text">
										<div><input type="text"></div>
									</div>
								</div>
							</div>
							
							<div class="box-btn submit">
								<a  href="#" class="btnReset btn red">ยกเลิก</a>
								<a  href="#" class="btnSubmit btn red">ดำเนินการต่อ</a>
							</div>
							
						</div>
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
