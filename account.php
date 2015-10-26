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
<script>
	$(document).ready(function(){
		$(".menu-left li.menu1").addClass("active");
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
				<li class="active">ข้อมูลส่วนตัว</li>
			</ol>
		</div>
	</div>
</div>

<div class="part-titlepage-main"  id="firstbox">
	<div class="container">
		<div class="box-titlepage">
			<p>
				<img src="images/th/title-accout.png" alt="ACCOUNT SETTINGS"/>
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
				<h1>ข้อมูลส่วนตัว</h1>
			</div>
			<div class="box-left">
				<div class="box-row cf">
					<div class="box-left">
						<p>ชื่อ - นามสกุล</p>
					</div>
					<div class="box-right">
						<p>นางสาว ชมพูนุช ซัน</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>เพศ</p>
					</div>
					<div class="box-right">
						<p>หญิง</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>วันเกิด</p>
					</div>
					<div class="box-right">
						<p>9 กันยายน 2531</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรศัพท์</p>
					</div>
					<div class="box-right">
						<p>02-3456789</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรศัพท์มือถือ</p>
					</div>
					<div class="box-right">
						<p>086-6656556</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>โทรสาร</p>
					</div>
					<div class="box-right">
						<p>02-3456789</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>รหัสประจำตัวประชาชน</p>
					</div>
					<div class="box-right">
						<p>1255688954213</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ที่อยู่</p>
					</div>
					<div class="box-right">
						<p>96 เอกพัฒนาอพาทเมนต์ ห้อง 810 ซ.ลาดพร้าว26</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>ตำบล/แขวง</p>
					</div>
					<div class="box-right">
						<p>แขวงลาดยาว</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>อำเภอ/เขต</p>
					</div>
					<div class="box-right">
						<p>เขตจตุจักร</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>จังหวัด</p>
					</div>
					<div class="box-right">
						<p>กรุงเทพมหานคร</p>
					</div>
				</div>
				<div class="box-row cf">
					<div class="box-left">
						<p>รหัสไปรษณีย์</p>
					</div>
					<div class="box-right">
						<p>10220</p>
					</div>
				</div>
			</div>
			<div class="box-right">
				<div class="box-user">
					<div class="box-pic">
						<img src="images/account/user.jpg"/>
					</div>
					<div class="box-detail cf">
						<div class="box-name">
							<h2>นางสาว ชมพูนุช ซัน</h2>
						</div>
						<p>LOG IN ล่าสุด</p>
						<div class="row cf">
							<div class="box-left">
								วันที่
							</div>
							<div class="box-right">
								20 มิถุนายน 2558
							</div>
						</div>
						<div class="row cf">
							<div class="box-left">
								เวลา
							</div>
							<div class="box-right">
								14:03น.
							</div>
						</div>
					</div>
					<div class="box-btn cf">
						<div class="row cf">
							<div class="box-left">
								<a href="account-edit.php" class="ed">แก้ไขข้อมูล</a>
							</div>
							<div class="box-right">
								<a href="account-edit.php" class="lu">ออกจากระบบ</a>
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
