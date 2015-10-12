<?php
require("assets/configs/config.inc.php");
require("assets/configs/connectdb.inc.php");
require("assets/configs/function.inc.php");
?>
<!doctype html>
<html>
<head>
<? require('inc_meta.php'); ?>	

<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/account.css" />
<link rel="stylesheet" type="text/css" href="css/account-detail.css" />
<link rel="stylesheet" type="text/css" href="css/account-museum.css" />
<script>
	$(document).ready(function(){
		$(".menu-left li.menu5,.menu-left li.menu5 li.submenu2").addClass("active");
			if ($('.menu-left li.menu5').hasClass("active")){
				$('.menu-left li.menu5').children(".submenu-left").css("display","block");
			}
	});
</script>
	
</head>

<body id="account">
	
<?php include('inc/inc-top-bar.php'); ?>
<?php include('inc/inc-menu.php'); ?>	

<div class="part-nav-main">
	<div class="container">
		<div class="box-nav">
			<ol class="cf">
				<li><a href="index.php"><img src="images/icon-home.png"/></a>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>การตั้งค่าบัญชีผู้ใช้&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li>จัดการพิพิธภัณฑ์&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</li>
				<li class="active">กิจกรรม</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				ACCOUNT SETTINGS<br>
				<span>การต้ังค่าบัญชีผู้ใช้</span>
			</p>	
		</div>
	</div>
</div>

<div class="part-account-main">
	<div class="container cf">
		<div class="box-account-left">
			<?php include('inc/inc-account-menu.php'); ?>
		</div>
		<div class="box-account-right cf">
			<div class="box-title">
				<h1>จัดการพิพิธภัณฑ์ - กิจกรรม</h1>
			</div>
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อกิจกรรม<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ชื่อกิจกรรม<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>วันที่จัดกิจกรรม</p>
						</div>
						<div class="box-right">
							<div class="box-input-text date cf">
								<div><input type="text"></div>
								<div><span>ถึง</span></div>
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>เวลาจัดกิจกรรม</p>
						</div>
						<div class="box-right">
							<div class="box-input-text time">
								<p>Plugin</p>
								<div class="workingtime" data-box="all">
									<input type="hidden" name="startdate" class="startdate" value="">
									<input type="hidden" name="enddate" class="enddate" value="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>สถานที่จัดงาน<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>สถานที่จัดงาน<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
						
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text" placeholder="Latitude"></div>
							</div>
							<div class="box-input-text mT">
								<div><input type="text" placeholder="Longitude"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>ค่าเข้าชม <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>ค่าเข้าชม <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>รายละเอียดย่อ <br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>รายละเอียดย่อ <br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>รายละเอียด<br>(ภาษาไทย)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<p>รายละเอียด<br>(ภาษาอังกฤษ)</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div style="height: 75px;"><textarea name="address"></textarea></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		

			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							<p>รูปภาพ</p>
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">BROWES</a>
								</div>
								<span class="con">*ไฟล์ภาพที่รองรับ : .jpg / .png ขนาดไฟล์ไม่เกิน : 200 Kb</span>
							</div>
							<div class="box-input-text cf mT">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		
			
			<div class="row-main cf">
				<div class="box-left">
					<div class="box-row cf">
						<div class="box-left">
							<p>Youtube Embed</p>
						</div>
						<div class="box-right">
							<div class="box-input-text">
								<div><input type="text"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-right">
					<div class="box-row cf">
						<div class="box-left">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">เพิ่ม</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
	
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
								<div class="box-tumb"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box-line cf"><hr></div>		

			<div class="row-main cf">
				<div class="box-left addW">
					<div class="box-row cf ">
						<div class="box-left">
							
						</div>
						<div class="box-right ">
							<div class="box-input-text cf">
								<div class="box-btn">
									<a class="btn black">จัดเรียงลำดับ</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="box-btn-main cf">
				<div class="box-btn">
					<a class="btn black">บันทึก</a>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="box-freespace"></div>



<?php include('inc/inc-footer.php'); ?>	

</body>
</html>
